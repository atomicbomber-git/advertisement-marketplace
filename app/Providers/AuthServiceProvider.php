<?php

namespace App\Providers;

use App\Constants\InvoiceStatus;
use App\Constants\UserLevel;
use App\Invoice;
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
    const MANAGE_OWN_PELANGGAN_INVOICES = "manage-own-pelanggan-invoices";
    const MANAGE_OWN_PRODUK = "manage-own-produk";
    const MANAGE_OWN_PENJUAL_CHATS = "manage-own-penjual-chats";
    const MANAGE_OWN_PENJUAL_INVOICES = "manage-own-penjual-invoices";
    const FINISH_PENJUAL_INVOICE = "finish-penjual-invoices";
    const CREATE_PELANGGAN_INVOICE = "create-pelanggan-invoice";
    const EDIT_PELANGGAN_INVOICE = "edit-pelanggan-invoice";
    const REGISTER_ACCOUNT = "register-account";
    const MANAGE_KATEGORI_PRODUK = "manage-kategori-produk";

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

        Gate::define(self::MANAGE_OWN_PENJUAL_INVOICES, function (User $user) {
            return true
                && $user->level === UserLevel::PENJUAL
                && $user->penjual->terverifikasi === 1
                ;
        });

        Gate::define(self::MANAGE_OWN_PRODUK, function (User $user) {
            return $user->level == UserLevel::PENJUAL
                && $user->penjual->terverifikasi == 1;
        });

        Gate::define(self::MANAGE_OWN_PENJUAL_CHATS, function (User $user) {
            return $user->level == UserLevel::PENJUAL
                && $user->penjual->terverifikasi == 1;
        });

        Gate::define(self::CREATE_PELANGGAN_INVOICE, function (User $user) {
            return $user->level === UserLevel::PELANGGAN
                && $user->pelanggan->terverifikasi === 1;
        });

        Gate::define(self::FINISH_PENJUAL_INVOICE, function (User $user, Invoice $invoice) {
            return true
                && $user->level === UserLevel::PENJUAL
                && $user->penjual->terverifikasi === 1
                && $invoice->status === InvoiceStatus::UNPAID
                ;
        });

        Gate::define(self::EDIT_PELANGGAN_INVOICE, function (User $user, Invoice $invoice) {
            return true
                && $user->level === UserLevel::PELANGGAN
                && $user->pelanggan->terverifikasi === 1
                && $user->pelanggan->id === $invoice->pelanggan_id
                && $invoice->status === InvoiceStatus::DRAFT
                ;
        });

        Gate::define(self::REGISTER_ACCOUNT, function (?User $user) {
            return $user === null;
        });

        Gate::define(self::MANAGE_KATEGORI_PRODUK, function (User $user) {
            return $user->level === UserLevel::SUPER_ADMIN;
        });
    }
}
