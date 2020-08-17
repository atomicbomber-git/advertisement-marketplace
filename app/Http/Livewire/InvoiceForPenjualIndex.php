<?php

namespace App\Http\Livewire;

use App\Constants\InvoiceStatus;
use App\Http\Livewire\Traits\WithCustomPagination;
use App\Penjual;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Livewire\Component;

/**
 * @property Penjual penjual
 */
class InvoiceForPenjualIndex extends Component
{
    use WithCustomPagination;

    const ALL_STATUS = "ALL";
    public $penjualId;
    public $status;

    public function mount($penjualId, Request $request)
    {
        $this->penjualId = $penjualId;
        $this->status = $request->query("status", InvoiceStatus::UNPAID);
    }

    public function getStatusOptionsProperty()
    {
        return [
            InvoiceStatus::DRAFT => "Belum Checkout",
            InvoiceStatus::UNPAID => "Belum Lunas",
            InvoiceStatus::PAID => "Lunas",
            InvoiceStatus::CANCELED => "Batal",
            self::ALL_STATUS => "Semua",
        ];
    }

    public function getPenjualProperty()
    {
        return Penjual::query()
            ->findOrFail($this->penjualId);
    }

    public function getInvoicesProperty()
    {
        return $this->penjual
            ->invoices()
            ->when($this->status !== self::ALL_STATUS, function (Builder $builder) {
                $builder->where("status", $this->status);
            })
            ->with([
                "pelanggan.user"
            ])
            ->orderBy("created_at")
            ->paginate();
    }

    public function render()
    {
        return view('livewire.invoice-for-penjual-index');
    }
}
