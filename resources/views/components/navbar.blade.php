<nav class="navbar is-info"
     role="navigation"
     aria-label="main navigation"
>
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item"
               href="{{ \App\Providers\RouteServiceProvider::home()  }}"
            >
                <span class="title has-text-light">
                    {{ config("app.name") }}
                </span>
            </a>

            <a role="button"
               class="navbar-burger burger"
               aria-label="menu"
               aria-expanded="false"
               data-target="navbarBasicExample"
            >
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample"
             class="navbar-menu"
        >
            <div class="navbar-start">
                {{--                <a class="navbar-item">--}}
                {{--                    Home--}}
                {{--                </a>--}}
            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    @guest
                        <div class="buttons">
                            @can(\App\Providers\AuthServiceProvider::REGISTER_ACCOUNT)
                                <a href="{{ route("pelanggan-registrasi.create") }}"
                                   class="button is-small is-primary"
                                >
                                    <strong>
                                        Daftar Pelanggan
                                    </strong>
                                </a>
                                <a href="{{ route("penjual-registrasi.create") }}"
                                   class="button is-small is-primary"
                                >
                                    <strong>
                                        Daftar Penjual
                                    </strong>
                                </a>
                            @endcan
                            <a href="{{ route("login") }}"
                               class="button is-small is-light"
                            >
                                @lang("app.login")
                            </a>
                        </div>
                    @else

                        <div class="navbar-item has-dropdown is-hoverable">
                            <a class="navbar-link">
                                {{ auth()->user()->name  }}
                            </a>

                            <div class="navbar-dropdown">
                                @can(\App\Providers\AuthServiceProvider::MANAGE_OWN_PENJUAL_PROFILE)
                                    <a href="{{ route("penjual-profile.edit", auth()->user()->penjual) }}" class="navbar-item">
                                        Profil
                                    </a>
                                @endcan

                                @can(\App\Providers\AuthServiceProvider::MANAGE_OWN_PELANGGAN_PROFILE)
                                    <a href="{{ route("pelanggan-profile.edit", auth()->user()->pelanggan) }}" class="navbar-item">
                                        Profil
                                    </a>
                                @endcan

                                @canany([
                                    \App\Providers\AuthServiceProvider::MANAGE_OWN_PENJUAL_PROFILE,
                                    \App\Providers\AuthServiceProvider::MANAGE_OWN_PELANGGAN_PROFILE
                                ])
                                    <hr class="navbar-divider">
                                @endcanany

                                <form id="logoutForm"
                                      method="POST"
                                      action="{{ route("logout") }}"
                                >
                                    @csrf
                                </form>

                                <a href="#"
                                   onclick="document.querySelector('#logoutForm').submit()"
                                   class="navbar-item"
                                >
                                    Keluar
                                </a>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</nav>