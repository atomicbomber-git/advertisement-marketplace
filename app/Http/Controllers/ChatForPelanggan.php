<?php

namespace App\Http\Controllers;

use App\Chat;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;

class ChatForPelanggan extends Controller
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\User  $penjual
     * @return \Illuminate\Http\Response
     */
    public function index(User $penjual)
    {
        return $this->responseFactory->view("chat-penjual.index", [
            "penjual" => $penjual,
        ]);
    }
}
