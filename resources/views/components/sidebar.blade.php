<aside class="menu column is-one-fifth">
    <p class="title is-5 is-uppercase">
        @if(auth()->user()->level === \App\Constants\UserLevel::PENJUAL)
            {{ auth()->user()->penjual->nama }}
        @else
            {{ auth()->user()->name  }}
        @endif
    </p>

    <hr>

    <p class="menu-label">
        Menu
    </p>
    <ul class="menu-list">
        <li>
            @can(\App\Providers\AuthServiceProvider::MANAGE_OWN_PENJUAL_PROFILE)
                <a
                        href="{{ route("penjual-profile.edit", auth()->user()->penjual) }}"
                        class="{{ \Illuminate\Support\Facades\Route::is("penjual-profile.*") ? "is-active" : "" }}" >
                    Profil
                </a>
            @endcan

            @can(\App\Providers\AuthServiceProvider::MANAGE_OWN_PELANGGAN_PROFILE)
                <a
                        href="{{ route("pelanggan-profile.edit", auth()->user()->pelanggan) }}"
                        class="{{ \Illuminate\Support\Facades\Route::is("pelanggan-profile.*") ? "is-active" : "" }}" >
                    Profil
                </a>
            @endcan

            @can(\App\Providers\AuthServiceProvider::MANAGE_OWN_PELANGGAN_PROFILE)
                <a
                        href="{{ route("pelanggan.invoice-for-pelanggan.index", auth()->user()->pelanggan) }}"
                        class="{{ \Illuminate\Support\Facades\Route::is("pelanggan.invoice-for-pelanggan.*") ? "is-active" : "" }}"
                >
                    Invoice
                </a>
            @endcan

            @can(\App\Providers\AuthServiceProvider::MANAGE_OWN_PENJUAL_INVOICES)
                <a
                        href="{{ route("penjual.invoice-for-penjual.index", auth()->user()->penjual) }}"
                        class="{{ \Illuminate\Support\Facades\Route::is("penjual.invoice-for-penjual.*") ? "is-active" : "" }}"
                >
                    Invoice
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

            @can(\App\Providers\AuthServiceProvider::MANAGE_ANY_PELANGGAN)
                <a
                        href="{{ route("pelanggan.index") }}"
                        class="{{ \Illuminate\Support\Facades\Route::is("pelanggan.index") ? "is-active" : "" }}" >
                    Pelanggan
                </a>
            @endcan
        </li>
    </ul>
</aside>