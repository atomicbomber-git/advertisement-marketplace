<?php

namespace App\Http\Controllers;

use App\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory;

class ChatForPenjualController extends Controller
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, Pelanggan $pelanggan)
    {
        return $this->responseFactory->view("chat-for-penjual.index", [
            "pelanggan" => $pelanggan,
        ]);
    }
}
