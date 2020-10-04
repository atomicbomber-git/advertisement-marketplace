<?php

namespace App\Http\Livewire;

use App\Constants\MessageState;
use App\Constants\SessionHelper;
use App\Http\Livewire\Traits\WithCustomPagination;
use App\KategoriProduk;
use Livewire\Component;

class KategoriProdukIndex extends Component
{
    use WithCustomPagination;

    protected $listeners = [
        "kategori-produk:delete" => "deleteKategoriProduk",
    ];

    public function deleteKategoriProduk($id)
    {
        try {
            KategoriProduk::query()
                ->whereKey($id)
                ->delete();

            SessionHelper::flashMessage(
                __("messages.delete.success"),
                MessageState::STATE_SUCCESS,
            );
        } catch (\Throwable $throwable) {
            SessionHelper::flashMessage(
                __("messages.delete.failure"),
                MessageState::STATE_DANGER,
            );
        }
    }

    public function render()
    {
        return view('livewire.kategori-produk-index', [
            "kategori_produks" => KategoriProduk::query()
                ->orderBy("nama")
                ->paginate()
        ]);
    }
}
