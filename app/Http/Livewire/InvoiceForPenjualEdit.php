<?php

namespace App\Http\Livewire;

use App\Constants\InvoiceStatus;
use App\Constants\MessageState;
use App\Constants\SessionHelper;
use App\Invoice;
use App\InvoiceItem;
use App\Penjual;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class InvoiceForPenjualEdit extends Component
{
    public Penjual $penjual;
    public Invoice $invoice;
    public array $invoice_items;

    public function submit()
    {
        $data = $this->validate([
            "invoice_items.*.id" => ["required", Rule::exists(InvoiceItem::class, "id")],
            "invoice_items.*.waktu_mulai_sewa" => ["required", "date-format:Y-m-d", "before:waktu_selesai_sewa"],
            "invoice_items.*.waktu_selesai_sewa" => ["required", "date-format:Y-m-d", "after:waktu_mulai_sewa"],
        ]);

        DB::beginTransaction();

        foreach ($data["invoice_items"] as $invoice_item_data) {
            InvoiceItem::query()
                ->where("id", $invoice_item_data["id"])
                ->update([
                    "waktu_mulai_sewa" => $invoice_item_data["waktu_mulai_sewa"],
                    "waktu_selesai_sewa" => $invoice_item_data["waktu_selesai_sewa"],
                ]);
        }

        $this->invoice->update([
            "status" => InvoiceStatus::PAID,
        ]);

        DB::commit();

        SessionHelper::flashMessage(
            __("messages.update.success"),
            MessageState::STATE_SUCCESS,
        );

        $this->redirect(route("penjual.invoice-for-penjual.show", [$this->penjual, $this->invoice]));
    }

    public function mount()
    {
        $this->invoice_items = $this->invoice
            ->items()
            ->select("*")
            ->with("produk")
            ->when($this->invoice->status === InvoiceStatus::DRAFT, function (Builder $builder) {
                $builder
                    ->join("produk", "produk.id", "=", "produk_id")
                    ->addSelect(DB::raw("produk.harga * kuantitas AS subtotal"));
            })
            ->when($this->invoice->status !== InvoiceStatus::DRAFT, function (Builder $builder) {
                $builder->addSelect(DB::raw("harga * kuantitas AS subtotal"));
            })
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.invoice-for-penjual-edit', [
            "penjual" => $this->penjual,
            "invoice" => $this->invoice,

            "invoice_items" => $this->invoice_items,

            "totalPrice" => $this->invoice
                ->items()
                ->when(true, function (Builder $builder) {
                    if ($this->invoice->status !== InvoiceStatus::DRAFT) {
                        $builder
                            ->select(DB::raw("SUM(harga * kuantitas) AS aggregate"));
                    }
                    else {
                        $builder
                            ->join("produk", "produk.id", "=", "produk_id")
                            ->select(DB::raw("SUM(produk.harga * kuantitas) AS aggregate"));
                    }
                })->value("aggregate")
        ]);
    }
}
