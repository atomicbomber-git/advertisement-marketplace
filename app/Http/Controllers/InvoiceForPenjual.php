<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Penjual;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class InvoiceForPenjual extends Controller
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {

        $this->responseFactory = $responseFactory;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Penjual  $penjual
     * @return \Illuminate\Http\Response
     */
    public function index($penjual)
    {
        return $this->responseFactory->view("invoice-for-penjual.index", [
            "penjual_id" => $penjual,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Penjual  $penjual
     * @return \Illuminate\Http\Response
     */
    public function create(Penjual $penjual)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Penjual  $penjual
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Penjual $penjual)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Penjual  $penjual
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Penjual $penjual, Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Penjual  $penjual
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Penjual $penjual, Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Penjual  $penjual
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penjual $penjual, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Penjual  $penjual
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penjual $penjual, Invoice $invoice)
    {
        //
    }
}
