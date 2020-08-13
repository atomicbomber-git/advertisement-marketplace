<?php

namespace App\Http\Livewire;

use App\Constants\MessageState;
use App\Constants\SessionHelper;
use App\Penjual;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PenjualIndex extends Component
{
    public $terverifikasi = "";

    const TERVERIFIKASI_OPTION_ALL = "all";
    const TERVERIFIKASI_OPTION_YES = "yes";
    const TERVERIFIKASI_OPTION_NO = "no";

    public $terverifikasiOptions = [
        self::TERVERIFIKASI_OPTION_ALL => "Semua",
        self::TERVERIFIKASI_OPTION_NO => "Tidak Terverifikasi",
        self::TERVERIFIKASI_OPTION_YES => "Terverifikasi",
    ];

    protected $updatesQueryString = [
        "terverifikasi" => ["except" => ""],
    ];

    public function mount(Request $request)
    {
        $this->fill([
            "terverifikasi" => $request->query("terverifikasi", self::TERVERIFIKASI_OPTION_ALL),
        ]);
    }

    public function toggleVerification($penjualId)
    {
        Penjual::query()
            ->where("id", $penjualId)
            ->update([
                "terverifikasi" => DB::raw("NOT terverifikasi")
            ]);

        SessionHelper::flashMessage(
            __("messages.update.success"),
            MessageState::STATE_SUCCESS
        );
    }

    public function render()
    {
        return view('livewire.penjual-index', [
            "penjuals" => Penjual::query()
                ->when($this->terverifikasi !== self::TERVERIFIKASI_OPTION_ALL, function (Builder $builder) {
                    if ($this->terverifikasi === self::TERVERIFIKASI_OPTION_YES) {
                        $builder->where("terverifikasi", 1);
                    }
                    elseif ($this->terverifikasi === self::TERVERIFIKASI_OPTION_NO) {
                        $builder->where("terverifikasi", 0);
                    }
                })
                ->with("user")
                ->orderBy("nama")
                ->paginate()
        ]);
    }
}
