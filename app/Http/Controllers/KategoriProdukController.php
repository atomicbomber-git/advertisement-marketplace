<?php

namespace App\Http\Controllers;

use App\Constants\MessageState;
use App\Constants\SessionHelper;
use App\KategoriProduk;
use App\Providers\AuthServiceProvider;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class KategoriProdukController extends Controller
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
        $this->authorize(AuthServiceProvider::MANAGE_KATEGORI_PRODUK);
        return $this->responseFactory->view("kategori-produk.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize(AuthServiceProvider::MANAGE_KATEGORI_PRODUK);
        return $this->responseFactory->view("kategori-produk.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->authorize(AuthServiceProvider::MANAGE_KATEGORI_PRODUK);

        $data = $request->validate([
            "nama" => ["required", "string", "max:255"],
        ]);

        KategoriProduk::query()->create($data);

        SessionHelper::flashMessage(
            __("messages.create.success"),
            MessageState::STATE_SUCCESS,
        );

        return $this->responseFactory->redirectToRoute("kategori-produk.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KategoriProduk  $kategoriProduk
     * @return \Illuminate\Http\Response
     */
    public function edit(KategoriProduk $kategoriProduk)
    {
        $this->authorize(AuthServiceProvider::MANAGE_KATEGORI_PRODUK);
        return $this->responseFactory->view("kategori-produk.edit", [
            "kategori_produk" => $kategoriProduk
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KategoriProduk  $kategoriProduk
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, KategoriProduk $kategoriProduk)
    {
        $this->authorize(AuthServiceProvider::MANAGE_KATEGORI_PRODUK);

        $data = $request->validate([
            "nama" => ["required", "string", "max:255"],
        ]);

        $kategoriProduk->update($data);

        SessionHelper::flashMessage(
            __("messages.update.success"),
            MessageState::STATE_SUCCESS,
        );

        return $this->responseFactory
            ->redirectToRoute("kategori-produk.edit", $kategoriProduk);
    }
}
