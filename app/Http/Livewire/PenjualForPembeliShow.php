<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithCustomPagination;
use App\Penjual;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Livewire\Component;

class PenjualForPembeliShow extends Component
{
    use WithCustomPagination;

    const PRODUKS_PER_PAGE = 6;
    const SEARCH_QUERY = "search";
    public $penjualId;
    public $search;

    protected $updatesQueryString = [
        self::SEARCH_QUERY => ["except" => ""]
    ];

    public function mount($penjualId, Request $request)
    {
        $this->penjualId = $penjualId;
        $this->search = $request->query(self::SEARCH_QUERY, "");
    }

    public function getPenjualProperty()
    {
        return Penjual::query()
            ->findOrFail($this->penjualId);
    }

    public function getProduksProperty()
    {
        return $this->penjual->produks()
            ->when($this->search, function (Builder $builder) {
                $builder->where("nama", "like", "{$this->search}%");
            })
            ->orderBy("created_at")
            ->paginate(self::PRODUKS_PER_PAGE);
    }

    public function render()
    {
        return view('livewire.penjual-for-pembeli-show');
    }
}
