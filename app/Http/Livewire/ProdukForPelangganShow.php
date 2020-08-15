<?php

namespace App\Http\Livewire;

use App\Constants\InvoiceStatus;
use App\Invoice;
use App\InvoiceItem;
use App\Penjual;
use App\Produk;
use App\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

/**
 * @property Produk produk
 * @property User user
 * @property Invoice invoice
 * @property InvoiceItem invoiceItem
 * @property Penjual penjual
 */
class ProdukForPelangganShow extends Component
{
    public int $produkId;
    public int $invoiceItemQuantity;

    public function mount(int $produkId)
    {
        $this->produkId = $produkId;
        $this->invoiceItemQuantity = $this->invoiceItem->kuantitas ?? 0;
    }

    public function syncInvoiceItemQuantity($newQuantity)
    {
        $this->invoiceItemQuantity = $newQuantity;

        if ($this->invoiceItemQuantity !== 0) {
            $this->invoiceItem->update([
                "kuantitas" => $this->invoiceItemQuantity
            ]);
            return;
        }

        $this->invoiceItem->delete();
        $this->invoiceItem = null;
    }

    public function updatingInvoiceItemQuantity($newQuantity)
    {
        $this->syncInvoiceItemQuantity($newQuantity);
    }

    public function incrementInvoiceItemQuantity()
    {
        $this->syncInvoiceItemQuantity($this->invoiceItemQuantity + 1);
    }

    public function decrementInvoiceItemQuantity()
    {
        $this->syncInvoiceItemQuantity($this->invoiceItemQuantity - 1);
    }

    public function getProdukProperty()
    {
        return Produk::query()
            ->findOrFail($this->produkId);
    }

    public function getUserProperty()
    {
        return Auth::user();
    }

    public function getInvoiceProperty()
    {
        return $this->user->pelanggan
            ->draft_invoice()
            ->where("penjual_id", $this->penjual->id)
            ->first();
    }

    public function getInvoiceItemProperty()
    {
        if ($this->invoice === null) {
            return null;
        }

        return $this->invoice->items()
            ->where("produk_id", $this->produkId)
            ->first();
    }

    public function getPenjualProperty()
    {
        return $this->produk->penjual()->first();
    }

    public function addInvoiceItem()
    {
        $invoice = $this->invoice;

        if ($this->invoice === null) {
            $this->invoice = $this->user->pelanggan
                ->invoices()
                ->create([
                    "penjual_id" => $this->produk->penjual_id,
                    "status" => InvoiceStatus::DRAFT,
                ]);
        }

        if ($this->invoiceItem === null) {
            $this->invoice->items()->create([
                "produk_id" => $this->produkId,
                "kuantitas" => 1,
            ]);

            $this->invoiceItemQuantity = 1;
        }
    }

    public function render()
    {
        return view('livewire.produk-for-pelanggan-show');
    }
}
