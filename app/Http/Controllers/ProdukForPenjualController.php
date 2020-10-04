<?php

namespace App\Http\Controllers;

use App\Constants\MessageState;
use App\Constants\SessionHelper;
use App\KategoriProduk;
use App\Penjual;
use App\Produk;
use App\Providers\AuthServiceProvider;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProdukForPenjualController extends Controller
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
            "penjual" => $penjual,
            "kategori_produks" => KategoriProduk::query()
                ->orderBy("nama")
                ->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request, Penjual $penjual)
    {
        $data = $request->validate([
            "kategori_produk_id" => ["required", Rule::exists(KategoriProduk::class, "id")],
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
     * Show the form for editing the specified resource.
     *
     * @param Produk $produk
     * @return Response
     */
    public function edit(Produk $produk)
    {
        return $this->responseFactory->view("produk-for-penjual.edit", [
            "produk" => $produk,
            "kategori_produks" => KategoriProduk::query()
                ->orderBy("nama")
                ->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Penjual $penjual
     * @return RedirectResponse
     */
    public function update(Request $request, Produk $produk)
    {
        $data = $request->validate([
            "kategori_produk_id" => ["required", Rule::exists(KategoriProduk::class, "id")],
            "kode" => ["required", "string", Rule::unique(Produk::class)->ignoreModel($produk)],
            "nama" => ["required", "string"],
            "deskripsi" => ["required", "string"],
            "harga" => ["required", "numeric", "gte:0"],
            "image" => ["nullable", "file", "mimes:jpg,jpeg,png"],
        ]);

        DB::beginTransaction();

        $produk->update(Arr::except($data, [
            "image"
        ]));

        if ($request->hasFile("image")) {
            $produk
                ->clearMediaCollection()
                ->addMediaFromRequest("image")
                ->toMediaCollection();
        }

        DB::commit();

        SessionHelper::flashMessage(
            __("messages.update.success"),
            MessageState::STATE_SUCCESS,
        );

        return $this->responseFactory->redirectToRoute(
            "produk-for-penjual.edit",
            $produk
        );
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
