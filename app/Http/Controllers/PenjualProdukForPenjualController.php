<?php

namespace App\Http\Controllers;

use App\Constants\MessageState;
use App\Constants\SessionHelper;
use App\Penjual;
use App\Produk;
use App\Providers\AuthServiceProvider;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PenjualProdukForPenjualController extends Controller
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
    public function create(Penjual $penjual)
    {
        $this->authorize(AuthServiceProvider::MANAGE_OWN_PRODUK);

        return $this->responseFactory->view("produk-for-penjual.create", [
            "penjual" => $penjual
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Penjual $penjual)
    {
        $data = $request->validate([
            "kode" => ["required", "string", Rule::unique(Produk::class)],
            "nama" => ["required", "string"],
            "deskripsi" => ["required", "string"],
            "harga" => ["required", "numeric", "gte:0"],
            "image" => ["nullable", "file", "mimes:jpg,jpeg,png"],
        ]);

        DB::beginTransaction();

        /** @var Produk $produk */
        $produk = $penjual->produks()->create(Arr::except($data, [
            "image"
        ]));

        if (isset($data["image"])) {
            $produk->addMediaFromRequest("image")
                ->toMediaCollection();
        }

        DB::commit();

        SessionHelper::flashMessage(
            __("messages.create.success"),
            MessageState::STATE_SUCCESS,
        );

        return $this->responseFactory->redirectToRoute(
            "penjual.produk-for-penjual.index",
            $penjual
        );
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
     * @param Produk $produk
     * @return Response
     */
    public function edit(Produk $produk)
    {
        return $this->responseFactory->view("produk-for-penjual.edit", [
            "produk" => $produk
        ]);
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