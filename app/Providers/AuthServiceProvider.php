<?php

namespace App\Providers;

use App\Constants\UserLevel;
use App\Penjual;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    const MANAGE_ANY_PENJUAL = "manage-any-penjual";
    const MANAGE_OWN_PENJUAL_PROFILE = "manage-own-penjual-profile";
    const MANAGE_OWN_PRODUK = "manage-own-produk";

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

        Gate::define(self::MANAGE_OWN_PENJUAL_PROFILE, function (User $user, ?Penjual $penjual = null) {
            return $user->id === ($penjual->user_id ?? null);
        });

        Gate::define(self::MANAGE_OWN_PRODUK, function (User $user) {
            return $user->level == UserLevel::PENJUAL
                && $user->penjual->terverifikasi == 1;
        });
    }
}