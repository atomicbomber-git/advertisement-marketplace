<?php

namespace App\Http\Controllers;

use App\Constants\MessageState;
use App\Constants\SessionHelper;
use App\Constants\UserLevel;
use App\Penjual;
use App\User;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PenjualRegistrationController extends Controller
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
        return $this->responseFactory->view(
            "penjual-registrasi.create"
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "seller_name" => ["required", "string", Rule::unique(Penjual::class, "nama")],
            "no_telepon" => ["required", "string"],
            "alamat" => ["required", "string"],
            "name" => ["required", "string"],
            "username" => ["required", "alpha_dash", Rule::unique(User::class)],
            "password" => ["required", "string", "confirmed"],
        ]);

        DB::transaction(function () use ($data) {
            $user = User::query()->create([
                "name" => $data["name"],
                "username" => $data["username"],
                "password" => $data["password"],
                "level" => UserLevel::SELLER,
            ]);

            Penjual::query()->create([
                "user_id" => $user->id,
                "nama" => $data["seller_name"],
                "no_telepon" => $data["no_telepon"],
                "alamat" => $data["alamat"],
            ]);
        });

        SessionHelper::flashMessage(
            __("messages.create.success"),
            MessageState::STATE_SUCCESS,
        );
    }
}
