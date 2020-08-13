<?php

namespace App\Http\Controllers;

use App\Produk;
use Illuminate\Http\Response;

class ProdukThumbController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function show(Produk $produk)
    {
        return response()->file(
            $produk->getFirstMediaPath(
                Produk::COLLECTION_DEFAULT,
                Produk::CONVERSION_THUMB,
            ),
        );
    }
}
