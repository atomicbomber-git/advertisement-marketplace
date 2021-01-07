<?php

namespace App\Http\Livewire;

use App\Chat;
use App\Http\Livewire\Traits\WithCustomPagination;
use App\Pelanggan;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PercakapanForPenjualIndex extends Component
{
    use WithCustomPagination;

    public function getPelanggansProperty()
    {
        return Pelanggan::query()
            ->whereHas("chats", function (Builder $builder) {
                $builder->where("penjual_id", "=", Auth::user()->penjual->id);
            })
            ->orderBy(
                Chat::query()
                    ->select("created_at")
                    ->whereNull("read_at")
                    ->whereColumn("pelanggan_id", "=", "pelanggan.id")
                    ->orderByDesc("created_at")
                    ->limit(1)
            )
            ->paginate();
    }

    public function render()
    {
        return view('livewire.percakapan-for-penjual-index');
    }
}
