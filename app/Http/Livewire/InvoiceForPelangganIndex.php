<?php

namespace App\Http\Livewire;

use Livewire\Component;

class InvoiceForPelangganIndex extends Component
{
    public $pelangganId;

    public function mount($pelangganId)
    {
        $this->pelangganId = $pelangganId;
    }

    public function render()
    {
        return view('livewire.invoice-for-pelanggan-index');
    }
}
