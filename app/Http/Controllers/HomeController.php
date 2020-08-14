<?php

namespace App\Http\Controllers;

use App\Produk;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    const N_PRODUKS_AT_HOME = 8;
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->responseFactory->view("home", [
            "produks" => Produk::query()
                ->inRandomOrder()
                ->with([
                    "media",
                    "penjual"
                ])
                ->limit(self::N_PRODUKS_AT_HOME)
                ->get()
        ]);
    }
}
