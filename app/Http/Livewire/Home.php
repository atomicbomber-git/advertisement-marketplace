<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithCustomPagination;
use App\KategoriProduk;
use App\Produk;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Livewire\Component;

class Home extends Component
{
    use WithCustomPagination;

    const ALL_KATEGORI_PRODUK_ID = "all";

    public $kategori_produk_id;

    protected $updatesQueryString = [
        "kategori_produk_id" => ["except" => self::ALL_KATEGORI_PRODUK_ID],
    ];

    public function mount(Request $request)
    {
        $this->kategori_produk_id = $request->query("kategori_produk_id", self::ALL_KATEGORI_PRODUK_ID);
    }

    public function render()
    {
        return view('livewire.home', [
            "kategori_produks" => KategoriProduk::query()
                ->get(),
            "current_kategori_produk" => KategoriProduk::query()
                ->find($this->kategori_produk_id),
            "produks" => Produk::query()
                ->when($this->kategori_produk_id !== self::ALL_KATEGORI_PRODUK_ID, function (Builder $builder) {
                    $builder->where("kategori_produk_id", $this->kategori_produk_id);
                })
                ->paginate(8)
        ]);
    }
}
