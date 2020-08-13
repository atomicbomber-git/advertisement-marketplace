<?php

namespace App\Http\Livewire;

use App\Penjual;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * @property Penjual penjual
 */
class PenjualProdukForPenjualIndex extends Component
{
    use WithPagination;
    public $penjualId;

    public function mount($penjualId)
    {
        $this->penjualId = $penjualId;
    }

    public function getPenjualProperty()
    {
        return Penjual::query()->findOrFail($this->penjualId);
    }

    public function getProduksProperty()
    {
        return $this->penjual->produks()->paginate();
    }

    public function paginationView()
    {
        return "livewire.pagination.bulma";
    }

    public function render()
    {
        return view('livewire.penjual-produk-for-penjual-index');
    }
}
