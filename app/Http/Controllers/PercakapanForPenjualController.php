<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Providers\AuthServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\Auth;

class PercakapanForPenjualController extends Controller
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize(AuthServiceProvider::MANAGE_OWN_PENJUAL_CHATS);
        return $this->responseFactory->view("percakapan-for-penjual.index");
    }
}
