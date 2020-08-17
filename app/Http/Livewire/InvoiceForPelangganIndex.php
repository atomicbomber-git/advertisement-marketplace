<?php

namespace App\Http\Livewire;

use App\Constants\InvoiceStatus;
use App\Constants\MessageState;
use App\Constants\SessionHelper;
use App\Http\Livewire\Traits\WithCustomPagination;
use App\Invoice;
use App\Pelanggan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Livewire\Component;

/**
 * @property Pelanggan pelanggan
 */
class InvoiceForPelangganIndex extends Component
{
    use WithCustomPagination;

    public $pelangganId;
    public $status;

    const ALL_STATUS = "ALL";

    protected $listeners = [
        "cancel" => "cancel",
    ];

    public function mount($pelangganId, Request $request)
    {
        $this->pelangganId = $pelangganId;
        $this->status = $request->query("status", InvoiceStatus::DRAFT);
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

    public function getPelangganProperty()
    {
        return Pelanggan::query()
            ->findOrFail($this->pelangganId);
    }

    public function cancel($invoiceId)
    {
        try {
            $invoice = Invoice::query()
                ->where(["id" => $invoiceId])
                ->firstOrFail("id");

            $invoice->update([
                "status" => InvoiceStatus::CANCELED,
            ]);

            SessionHelper::flashMessage(
                __("messages.update.success"),
                MessageState::STATE_SUCCESS,
            );

        } catch (\Exception $exception) {
            SessionHelper::flashMessage(
                __("messages.update.failure"),
                MessageState::STATE_DANGER,
            );
        }
    }

    public function getInvoicesProperty()
    {
        return $this->pelanggan
            ->invoices()
            ->when($this->status !== self::ALL_STATUS, function (Builder $builder) {
                $builder->where("status", $this->status);
            })
            ->with([
                "penjual"
            ])
            ->orderBy("created_at")
            ->paginate();
    }

    public function render()
    {
        return view('livewire.invoice-for-pelanggan-index');
    }
}
