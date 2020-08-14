<?php

namespace App\Http\Livewire;

use App\Constants\MessageState;
use App\Constants\SessionHelper;
use App\Penjual;
use App\Produk;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * @property Penjual penjual
 */
class PenjualProdukForPenjualIndex extends Component
{
    use WithPagination;
    public $penjualId;
    public $search;

    protected $listeners = [
        "delete" => "delete",
    ];

    protected $updatesQueryString = [
        "search" => ["except" => ""],
    ];

    public function mount(Request $request, $penjualId)
    {
        $this->penjualId = $penjualId;
        $this->search = $request->query("search");
    }

    public function getPenjualProperty()
    {
        return Penjual::query()->findOrFail($this->penjualId);
    }

    private function getSearchFields()
    {
        return [
            "nama",
            "deskripsi",
            "kode"
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getProduksProperty()
    {
        return $this->penjual->produks()
            ->when($this->search, function (Builder $builder) {
                $keywords = explode(" ", $this->search);

                $builder->where(function (Builder $builder) use ($keywords) {
                    foreach ($this->getSearchFields() as $field) {
                        foreach ($keywords as $keyword) {
                            $builder->orWhere($field, "like", "{$keyword}%");
                        }
                    }
                });
            })
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
