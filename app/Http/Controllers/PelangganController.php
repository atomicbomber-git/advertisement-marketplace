<?php

namespace App\Http\Controllers;

use App\Pelanggan;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {

        $this->responseFactory = $responseFactory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->responseFactory
            ->view("pelanggan.index");
    }
}
