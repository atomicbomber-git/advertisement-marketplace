<aside class="menu column is-one-fifth">
    <p class="menu-label">
        Menu
    </p>
    <ul class="menu-list">
        <li>
            @can(\App\Providers\AuthServiceProvider::MANAGE_OWN_PENJUAL_PROFILE, auth()->user()->penjual)
                <a
                        href="{{ route("penjual-profile.edit", auth()->user()->penjual) }}"
                        class="{{ \Illuminate\Support\Facades\Route::is("penjual-profile.*") ? "is-active" : "" }}" >
                    Profil
                </a>
            @endcan

            @can(\App\Providers\AuthServiceProvider::MANAGE_OWN_PELANGGAN_PROFILE, auth()->user()->pelanggan)
                <a
                        href="{{ route("pelanggan-profile.edit", auth()->user()->pelanggan) }}"
                        class="{{ \Illuminate\Support\Facades\Route::is("pelanggan-profile.*") ? "is-active" : "" }}" >
                    Profil
                </a>
            @endcan

            @can(\App\Providers\AuthServiceProvider::MANAGE_OWN_PRODUK)
                <a
                        href="{{ route("penjual.produk-for-penjual.index", auth()->user()->penjual) }}"
                        class="{{ \Illuminate\Support\Facades\Route::is("penjual.produk-for-penjual.*") ? "is-active" : "" }}" >
                    Produk
                </a>
            @endcan

            @can(\App\Providers\AuthServiceProvider::MANAGE_ANY_PENJUAL)
                <a
                        href="{{ route("penjual.index") }}"
                        class="{{ \Illuminate\Support\Facades\Route::is("penjual.index") ? "is-active" : "" }}" >
                    Penjual
                </a>
            @endcan
        </li>
    </ul>
</aside>