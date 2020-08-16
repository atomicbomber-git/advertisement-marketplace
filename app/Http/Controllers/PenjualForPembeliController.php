<?php

namespace App\Http\Controllers;

use App\Penjual;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class PenjualForPembeliController extends Controller
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {

        $this->responseFactory = $responseFactory;
    }

    /**
     * Display the specified resource.
     *
     * @param Penjual $penjual
     * @return Response
     */
    public function show(Penjual $penjual)
    {
        return $this->responseFactory->view("penjual-for-pembeli.show", [
            "penjual" => $penjual,
            "produks" => $penjual
                ->produks()
                ->orderBy("created_at")
        ]);
    }
}
