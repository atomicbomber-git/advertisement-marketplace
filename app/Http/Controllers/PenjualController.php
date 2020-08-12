<?php

namespace App\Http\Controllers;

use App\Penjual;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PenjualController extends Controller
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->responseFactory->view(
            "penjual.index"
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Penjual $penjual
     * @return Response
     */
    public function show(Penjual $penjual)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Penjual $penjual
     * @return Response
     */
    public function edit(Penjual $penjual)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Penjual $penjual
     * @return Response
     */
    public function update(Request $request, Penjual $penjual)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Penjual $penjual
     * @return Response
     */
    public function destroy(Penjual $penjual)
    {
        //
    }
}
