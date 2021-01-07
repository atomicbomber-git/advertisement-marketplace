<?php

namespace App\Http\Controllers;

use App\Constants\InvoiceStatus;
use App\Constants\MessageState;
use App\Constants\SessionHelper;
use App\Invoice;
use App\Penjual;
use App\Providers\AuthServiceProvider;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceForPenjualController extends Controller
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \App\Penjual $penjual
     * @return \Illuminate\Http\Response
     */
    public function index($penjual)
    {
        $this->authorize(AuthServiceProvider::MANAGE_OWN_PENJUAL_INVOICES);

        return $this->responseFactory->view("invoice-for-penjual.index", [
            "penjual_id" => $penjual,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Penjual $penjual
     * @return \Illuminate\Http\Response
     */
    public function create(Penjual $penjual)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Penjual $penjual
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Penjual $penjual)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Penjual $penjual
     * @param \App\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Penjual $penjual, Invoice $invoice)
    {
        $this->authorize(AuthServiceProvider::MANAGE_OWN_PENJUAL_INVOICES);

        return $this->responseFactory->view("invoice-for-penjual.show",
            [
                "penjual" => $penjual,
                "invoice" => $invoice,
                "invoice_items" => $invoice
                    ->items()
                    ->select("*")
                    ->with("produk")
                    ->when($invoice->status === InvoiceStatus::DRAFT, function (Builder $builder) {
                        $builder
                            ->join("produk", "produk.id", "=", "produk_id")
                            ->addSelect(DB::raw("produk.harga * kuantitas AS subtotal"));
                    })
                    ->when($invoice->status !== InvoiceStatus::DRAFT, function (Builder $builder) {
                        $builder->addSelect(DB::raw("harga * kuantitas AS subtotal"));
                    })
                    ->get(),

                "totalPrice" => $invoice
                    ->items()
                    ->when(true, function (Builder $builder) use ($invoice) {
                        if ($invoice->status !== InvoiceStatus::DRAFT) {
                            $builder
                                ->select(DB::raw("SUM(harga * kuantitas) AS aggregate"));
                        } else {
                            $builder
                                ->join("produk", "produk.id", "=", "produk_id")
                                ->select(DB::raw("SUM(produk.harga * kuantitas) AS aggregate"));
                        }
                    })->value("aggregate")
            ]
        );
    }

    public function updating($fields)
    {
        dump($fields);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Penjual $penjual
     * @param \App\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Penjual $penjual, Invoice $invoice)
    {
        $this->authorize(AuthServiceProvider::FINISH_PENJUAL_INVOICE, $invoice);

        return $this->responseFactory->view("invoice-for-penjual.edit", [
            "penjual" => $penjual,
            "invoice" => $invoice,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Penjual $penjual
     * @param \App\Invoice $invoice
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Penjual $penjual, Invoice $invoice)
    {
        $this->authorize(AuthServiceProvider::FINISH_PENJUAL_INVOICE, $invoice);

        $invoice->update([
            "status" => InvoiceStatus::PAID,
            "waktu_pelunasan" => now(),
        ]);

        SessionHelper::flashMessage(
            __("messages.update.success"),
            MessageState::STATE_SUCCESS
        );

        return $this->responseFactory->redirectToRoute("penjual.invoice-for-penjual.index", [
            "penjual" => $invoice->penjual_id,
            "status" => InvoiceStatus::PAID,
        ]);
    }
}
