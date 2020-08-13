<?php

namespace App\Http\Controllers;

use App\Penjual;
use App\Providers\AuthServiceProvider;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PenjualProdukForPenjual extends Controller
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Penjual $penjual
     * @return Response
     * @throws AuthorizationException
     */
    public function index(Penjual $penjual)
    {
        $this->authorize(AuthServiceProvider::MANAGE_OWN_PRODUK);

        return $this->responseFactory->view("produk-for-penjual.index", [
            "penjual" => $penjual,
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
     * @param  \App\Penjual  $penjual
     * @return Response
     */
    public function show(Penjual $penjual)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Penjual  $penjual
     * @return Response
     */
    public function edit(Penjual $penjual)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Penjual  $penjual
     * @return Response
     */
    public function update(Request $request, Penjual $penjual)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Penjual  $penjual
     * @return Response
     */
    public function destroy(Penjual $penjual)
    {
        //
    }
}
