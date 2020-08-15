<?php

namespace App\Http\Livewire;

use App\Constants\MessageState;
use App\Constants\SessionHelper;
use App\Http\Livewire\Traits\WithCustomPagination;
use App\Pelanggan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PelangganIndex extends Component
{
    use WithCustomPagination;

    const TERVERIFIKASI_OPTION_ALL = "all";
    const TERVERIFIKASI_OPTION_YES = "yes";
    const TERVERIFIKASI_OPTION_NO = "no";
    public $terverifikasi = "";
    public $terverifikasiOptions = [
        self::TERVERIFIKASI_OPTION_ALL => "Semua",
        self::TERVERIFIKASI_OPTION_NO => "Tidak Terverifikasi",
        self::TERVERIFIKASI_OPTION_YES => "Terverifikasi",
    ];

    protected $updatesQueryString = [
        "terverifikasi" => ["except" => ""],
    ];

    protected $listeners = [
        "toggleVerification" => "toggleVerification",
    ];

    public function mount(Request $request)
    {
        $this->fill([
            "terverifikasi" => $request->query(
                "terverifikasi",
                self::TERVERIFIKASI_OPTION_ALL
            ),
        ]);
    }

    public function toggleVerification($pelangganId)
    {
        Pelanggan::query()
            ->where("id", $pelangganId)
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
        return view('livewire.pelanggan-index', [
            "pelanggans" => Pelanggan::query()
                ->when($this->terverifikasi !== self::TERVERIFIKASI_OPTION_ALL, function (Builder $builder) {
                    if ($this->terverifikasi === self::TERVERIFIKASI_OPTION_YES) {
                        $builder->where("terverifikasi", 1);
                    } elseif ($this->terverifikasi === self::TERVERIFIKASI_OPTION_NO) {
                        $builder->where("terverifikasi", 0);
                    }
                })
                ->with("user")
                ->paginate()
        ]);
    }
}
