<?php

namespace App\Providers;

use App\Constants\UserLevel;
use App\Pelanggan;
use App\Penjual;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    const MANAGE_ANY_PENJUAL = "manage-any-penjual";
    const MANAGE_ANY_PELANGGAN = "manage-any-pelanggan";
    const MANAGE_OWN_PENJUAL_PROFILE = "manage-own-penjual-profile";
    const MANAGE_OWN_PELANGGAN_PROFILE = "manage-own-pelanggan-profile";
    const MANAGE_OWN_PELANGGAN_INVOICES = "manage-own-invoices";
    const MANAGE_OWN_PRODUK = "manage-own-produk";
    const CREATE_PELANGGAN_INVOICE = "create-pelanggan-invoice";
    const REGISTER_ACCOUNT = "register-account";

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define(self::MANAGE_ANY_PENJUAL, function (User $user) {
            return $user->level === UserLevel::SUPER_ADMIN;
        });

        Gate::define(self::MANAGE_ANY_PELANGGAN, function (User $user) {
            return $user->level === UserLevel::SUPER_ADMIN;
        });

        Gate::define(self::MANAGE_OWN_PENJUAL_PROFILE, function (User $user) {
            return $user->level === UserLevel::PENJUAL;
        });

        Gate::define(self::MANAGE_OWN_PELANGGAN_PROFILE, function (User $user) {
            return $user->level === UserLevel::PELANGGAN;
        });

        Gate::define(self::MANAGE_OWN_PELANGGAN_INVOICES, function (User $user) {
            return $user->level === UserLevel::PELANGGAN
                && $user->pelanggan->terverifikasi === 1;
        });

        Gate::define(self::MANAGE_OWN_PRODUK, function (User $user) {
            return $user->level == UserLevel::PENJUAL
                && $user->penjual->terverifikasi == 1;
        });

        Gate::define(self::CREATE_PELANGGAN_INVOICE, function (User $user) {
            return $user->level === UserLevel::PELANGGAN
                && $user->pelanggan->terverifikasi === 1;
        });

        Gate::define(self::REGISTER_ACCOUNT, function (?User $user) {
            return $user === null;
        });
    }
}
