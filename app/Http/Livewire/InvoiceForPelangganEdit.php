<?php

namespace App\Http\Livewire;

use App\Invoice;
use App\InvoiceItem;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\Component;

/**
 * @property Invoice invoice
 */
class InvoiceForPelangganEdit extends Component
{
    public int $invoiceId;

    public array $invoiceItemsData;
    public $oldInvoiceItemsData;

    public function mount(int $invoiceId)
    {
        $this->invoiceId = $invoiceId;

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

    public function render()
    {
        return view('livewire.invoice-for-pelanggan-edit');
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

            InvoiceItem::query()
                ->where("id", $invoiceItemId)
                ->update(["kuantitas" => $newQuantity]);

        } catch (\Throwable $ex) {
            $this->invoiceItemsData = $this->oldInvoiceItemsData;
        }
    }
}
