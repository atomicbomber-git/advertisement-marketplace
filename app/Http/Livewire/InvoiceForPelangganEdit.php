<?php

namespace App\Http\Livewire;

use App\Constants\InvoiceStatus;
use App\Constants\MessageState;
use App\Constants\SessionHelper;
use App\Invoice;
use App\InvoiceItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use Throwable;

/**
 * @property Invoice invoice
 */
class InvoiceForPelangganEdit extends Component
{
    public int $invoiceId;

    public array $invoiceItemsData;
    public $oldInvoiceItemsData;

    protected $listeners = [
        "deleteInvoiceItem" => "deleteInvoiceItem",
        "checkoutInvoice" => "checkoutInvoice",
    ];

    public function mount(int $invoiceId)
    {
        $this->invoiceId = $invoiceId;
        $this->loadInvoiceItemsData();
    }

    public function loadInvoiceItemsData()
    {
        $this->invoiceItemsData = $this->invoice->items()
            ->with("produk")
            ->get()
            ->keyBy("id")
            ->toArray();
    }

    public function updating($attributes)
    {
        $this->oldInvoiceItemsData = $this->invoiceItemsData;
    }

    public function updated($attributes)
    {
        if (Str::is("invoiceItemsData.*.kuantitas", $attributes)) {
            $accessorPath = substr($attributes, strpos($attributes, '.') + 1);

            [$invoiceItemId, $key] = explode(".", $accessorPath);
            $this->syncProductQuantity($invoiceItemId);
        }
    }

    /**
     * @param $newQuantity
     * @param $invoiceItemId
     */
    public function syncProductQuantity($invoiceItemId): void
    {
        $newQuantity = $this->invoiceItemsData[$invoiceItemId]["kuantitas"];

        try {
            throw_if(!is_numeric($newQuantity), "Quantity has to be numeric.");
            throw_if($newQuantity < 0, "Quantity can't be negative.");

            if ($newQuantity === 0) {
                $this->deleteInvoiceItem($invoiceItemId);
                return;
            }

            InvoiceItem::query()
                ->where("id", $invoiceItemId)
                ->update(["kuantitas" => $newQuantity]);

        } catch (Throwable $ex) {
            $this->invoiceItemsData = $this->oldInvoiceItemsData;
        }
    }

    public function deleteInvoiceItem($invoiceItemId)
    {
        try {
            DB::beginTransaction();

            InvoiceItem::query()
                ->where("id", $invoiceItemId)
                ->delete();

            // Also delete the invoice if we're deleting the only invoice item left
            if ($this->invoice->items()->count() === 0) {

                // Saving relevant data for redirection after deletion
                $penjualId = $this->invoice->penjual_id;

                $this->invoice->delete();

                SessionHelper::flashMessage(
                    __("messages.delete.success"),
                    MessageState::STATE_SUCCESS,
                );

                $this->redirectRoute("pelanggan.invoice-for-pelanggan.index", [
                    $penjualId
                ]);
            }

            DB::commit();
        } catch (Throwable $exception) {
            SessionHelper::flashMessage(
                __("messages.delete.failure"),
                MessageState::STATE_DANGER,
            );
        }
    }

    public function getInvoiceProperty()
    {
        return Invoice::query()
            ->findOrFail($this->invoiceId)
            ->load("penjual");
    }

    public function getTotalPriceProperty()
    {
        return array_reduce($this->invoiceItemsData, function ($current, $next) {
            return $current + ($next["kuantitas"] * $next["produk"]["harga"]);
        }, 0);
    }

    public function incrementProductQuantity($productId)
    {
        $this->oldInvoiceItemsData = $this->invoiceItemsData;
        ++$this->invoiceItemsData[$productId]["kuantitas"];

        $this->syncProductQuantity($productId);
    }

    public function decrementProductQuantity($productId)
    {
        $this->oldInvoiceItemsData = $this->invoiceItemsData;
        --$this->invoiceItemsData[$productId]["kuantitas"];

        $this->syncProductQuantity($productId);
    }

    public function checkoutInvoice()
    {
        try {
            DB::beginTransaction();

            $this->invoice->update([
                "status" => InvoiceStatus::UNPAID,
                "waktu_checkout" => now(),
            ]);

            $this->invoice->items()
                ->join("produk", "produk.id", "=", "invoice_item.produk_id")
                ->update([
                    "invoice_item.harga" => DB::raw("produk.harga"),
                ]);

            $this->redirectRoute("pelanggan.invoice-for-pelanggan.show", [
                $this->invoice->pelanggan_id,
                $this->invoice->id,
            ]);

            DB::commit();

            SessionHelper::flashMessage(
                __("messages.update.success"),
                MessageState::STATE_SUCCESS
            );
        } catch (Throwable $exception) {
            SessionHelper::flashMessage(
                __("messages.update.failure"),
                MessageState::STATE_DANGER
            );
        }
    }

    public function render()
    {
        $this->loadInvoiceItemsData();
        return view('livewire.invoice-for-pelanggan-edit');
    }
}
