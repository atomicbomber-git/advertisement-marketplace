<?php

namespace App\Http\Livewire;

use App\Penjual;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PenjualIndex extends Component
{
    public function toggleVerification($penjualId)
    {
        Penjual::query()
            ->where("id", $penjualId)
            ->update([
                "terverifikasi" => DB::raw("NOT terverifikasi")
            ]);
    }

    public function render()
    {
        return view('livewire.penjual-index', [
            "penjuals" => Penjual::query()
                ->with("user")
                ->orderBy("nama")
                ->paginate()
        ]);
    }
}
