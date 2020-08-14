<nav class="navbar is-info is-spaced"
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
                            <a href="#" class="button is-small is-primary">
                                <strong>
                                    Daftar Pelanggan
                                </strong>
                            </a>
                            <a href="{{ route("penjual-registrasi.create") }}" class="button is-small is-primary">
                                <strong>
                                    Daftar Penjual
                                </strong>
                            </a>
                            <a href="{{ route("login") }}" class="button is-small is-light">
                                @lang("app.login")
                            </a>
                        </div>
                    @else
                        <div class="buttons">
                            <form action="{{ route("logout") }}"
                                  method="POST"
                            >
                                @csrf
                                <button class="button is-small is-danger">
                                    <span class="icon is-small">
                                        <i class="fas fa-sign-out-alt"></i>
                                    </span>

                                    <span> @lang("app.logout") </span>
                                </button>
                            </form>
                        </div
                        >
                    @endguest
                </div>
            </div>
        </div>
    </div>
</nav>