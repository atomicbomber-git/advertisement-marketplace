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

            [$index, $key] = explode(".", $accessorPath);
            $invoiceItemId = $this->invoiceItemsData[$index]["id"];
            $currentQuantity = $this->invoiceItemsData[$index][$key];

            try {
                throw_if(!is_numeric($currentQuantity), "Quantity has to be numeric.");
                throw_if($currentQuantity < 0, "Quantity can't be negative.");

                InvoiceItem::query()
                    ->where("id", $invoiceItemId)
                    ->update(["kuantitas" => $currentQuantity]);

            } catch (\Throwable $ex) {
                $this->invoiceItemsData = $this->oldInvoiceItemsData;
            }
        }
    }


    public function getInvoiceProperty()
    {
        return Invoice::query()
            ->findOrFail($this->invoiceId);
    }

    public function render()
    {
        return view('livewire.invoice-for-pelanggan-edit');
    }
}
