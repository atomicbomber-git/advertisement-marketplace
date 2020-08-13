<?php

namespace App\Http\Controllers;

use App\Constants\MessageState;
use App\Constants\SessionHelper;
use App\Constants\UserLevel;
use App\Penjual;
use App\Providers\AuthServiceProvider;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PenjualProfileController extends Controller
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     * @throws AuthorizationException
     */
    public function edit(Penjual $penjual)
    {
        $this->authorize(AuthServiceProvider::MANAGE_OWN_PENJUAL_PROFILE, $penjual);

        return $this->responseFactory->view("penjual-profile.edit", [
            "penjual" => $penjual->load("user"),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws AuthorizationException
     */
    public function update(Penjual $penjual, Request $request)
    {
        $this->authorize(AuthServiceProvider::MANAGE_OWN_PENJUAL_PROFILE, $penjual);

        $data = $request->validate([
            "seller_name" => ["required", "string", Rule::unique(Penjual::class, "nama")->ignoreModel($penjual)],
            "no_telepon" => ["required", "string"],
            "alamat" => ["required", "string"],
            "name" => ["required", "string"],
            "username" => ["required", "alpha_dash", Rule::unique(User::class)->ignore($penjual->user_id)],
            "password" => ["nullable", "string", "confirmed"],
        ]);

        $penjualData = [
            "name" => $data["name"],
            "username" => $data["username"],
        ];

        if (isset($data["password"])) {
            $penjualData["password"] = Hash::make("password");
        }

        DB::beginTransaction();

        $penjual->user()->update($penjualData);

        $penjual->update([
            "nama" => $data["seller_name"],
            "no_telepon" => $data["no_telepon"],
            "alamat" => $data["alamat"],
        ]);

        DB::commit();

        SessionHelper::flashMessage(
            __("messages.update.success"),
            MessageState::STATE_SUCCESS,
        );

        return $this->responseFactory->redirectToRoute("penjual-profile.edit", $penjual);
    }
}
