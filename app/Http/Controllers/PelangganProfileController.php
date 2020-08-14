<?php

namespace App\Http\Controllers;

use App\Constants\MessageState;
use App\Constants\SessionHelper;
use App\Pelanggan;
use App\User;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PelangganProfileController extends Controller
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {

        $this->responseFactory = $responseFactory;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelanggan $pelanggan)
    {
        return $this->responseFactory->view("pelanggan-profile.edit", [
            "pelanggan" => $pelanggan->load("user")
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        $data = $request->validate([
            "name" => ["required", "string"],
            "username" => ["required", "alpha_dash", Rule::unique(User::class)->ignoreModel($pelanggan->user)],
            "no_telepon" => ["required", "string"],
            "password" => ["nullable", "string", "confirmed"],
        ]);

        if (isset($data["password"])) {
            $data["password"] = Hash::make("password");
        }

        DB::beginTransaction();

        $pelanggan->update(Arr::only($data, [
            "no_telepon"
        ]));

        $pelanggan->user()->update(Arr::except($data, [
            "no_telepon"
        ]));

        DB::commit();

        SessionHelper::flashMessage(
            __("messages.update.success"),
            MessageState::STATE_SUCCESS,
        );

        return $this->responseFactory->redirectToRoute(
            "pelanggan-profile.edit",
            $pelanggan
        );
    }
}
