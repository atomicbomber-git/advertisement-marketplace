<?php

namespace App\Http\Controllers;

use App\Constants\MessageState;
use App\Constants\SessionHelper;
use App\Constants\UserLevel;
use App\Pelanggan;
use App\Providers\AuthServiceProvider;
use App\User;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PelangganRegistrasiController extends Controller
{
    private ResponseFactory $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {

        $this->responseFactory = $responseFactory;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize(AuthServiceProvider::REGISTER_ACCOUNT);

        return $this->responseFactory->view("pelanggan-registrasi.create");
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => ["required", "string"],
            "username" => ["required", "alpha_dash", Rule::unique(User::class)],
            "no_telepon" => ["required", "string"],
            "password" => ["required", "string", "confirmed"],
        ]);

        $data["password"] = Hash::make($data["password"]);
        $data["level"] = UserLevel::PELANGGAN;

        DB::beginTransaction();

        /** @var User $user */
        $user = User::query()->create(Arr::except($data, [
            "no_telepon"
        ]));

        $pelanggan = $user->pelanggan()->create(Arr::only($data, [
            "no_telepon"
        ]));

        DB::commit();

        SessionHelper::flashMessage(
            __("messages.create.success"),
            MessageState::STATE_SUCCESS
        );

        Auth::login($user);

        return $this->responseFactory->redirectToRoute(
            "pelanggan-profile.edit",
            $pelanggan
        );
    }
}
