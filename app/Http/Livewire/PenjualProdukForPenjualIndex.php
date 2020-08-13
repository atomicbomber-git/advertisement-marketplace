<?php

namespace App\Http\Livewire;

use App\Constants\MessageState;
use App\Constants\SessionHelper;
use App\Penjual;
use App\Produk;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * @property Penjual penjual
 */
class PenjualProdukForPenjualIndex extends Component
{
    use WithPagination;
    public $penjualId;

    protected $listeners = [
        "delete" => "delete",
    ];

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
        return $this->penjual->produks()
            ->orderBy("nama")
            ->paginate();
    }

    public function paginationView()
    {
        return "livewire.pagination.bulma";
    }

    public function delete($produkId)
    {
        Produk::query()
            ->where("id", $produkId)
            ->delete();

        SessionHelper::flashMessage(
            __("messages.delete.success"),
            MessageState::STATE_SUCCESS
        );
    }

    public function render()
    {
        return view('livewire.penjual-produk-for-penjual-index');
    }
}
