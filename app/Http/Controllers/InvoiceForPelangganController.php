<?php

namespace App\Http\Controllers;

use App\Constants\InvoiceStatus;
use App\Invoice;
use App\Pelanggan;
use App\Providers\AuthServiceProvider;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class InvoiceForPelangganController extends Controller
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($pelanggan)
    {
        $this->authorize(AuthServiceProvider::MANAGE_OWN_PELANGGAN_INVOICES);

        return $this->responseFactory->view("invoice-for-pelanggan.index", [
            "pelanggan_id" => $pelanggan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Invoice $invoice
     * @return Response
     */
    public function show(Pelanggan $pelanggan, Invoice $invoice)
    {
        return $this->responseFactory->view("invoice-for-pelanggan.show", [
            "pelanggan" => $pelanggan,
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
                ->when(true, function (Builder $builder) use($invoice) {
                    if ($invoice->status !== InvoiceStatus::DRAFT) {
                        $builder
                            ->select(DB::raw("SUM(harga * kuantitas) AS aggregate"));
                    }
                    else {
                        $builder
                            ->join("produk", "produk.id", "=", "produk_id")
                            ->select(DB::raw("SUM(produk.harga * kuantitas) AS aggregate"));
                    }
                })->value("aggregate")
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Invoice $invoice
     * @return Response
     */
    public function edit($pelanggan, Invoice $invoice)
    {
        $this->authorize(AuthServiceProvider::EDIT_PELANGGAN_INVOICE, $invoice);

        return $this->responseFactory->view("invoice-for-pelanggan.edit", [
            "invoice_id" => $invoice->id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Invoice $invoice
     * @return Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Invoice $invoice
     * @return Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
