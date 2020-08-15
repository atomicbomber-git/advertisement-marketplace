<?php

namespace App\Http\Controllers;

use App\Penjual;
use App\Produk;
use Illuminate\Contracts\Routing\ResponseFactory;

class ProdukForPelanggan extends Controller
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {

        $this->responseFactory = $responseFactory;
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Penjual $penjual, Produk $produk)
    {
        return $this->responseFactory->view("produk-for-pelanggan.show", [
            "produk" => $produk,
        ]);
    }
}
