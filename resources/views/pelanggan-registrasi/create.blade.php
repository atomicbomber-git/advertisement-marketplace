@extends("layouts.app-guest")

@section("content")
    <div class="box"
         style="max-width: 450px; margin: auto"
    >
        <form action="{{ route("pelanggan-registrasi.store") }}"
              method="POST">
            @csrf
            @method("POST")

            <h1 class="title is-4 has-text-primary is-uppercase"> Pendaftaran Pelanggan </h1>

            <div class="field">
                <label class="label"
                       for="name"
                >Nama Asli</label>
                <div class="control @error('name') has-icons-right @enderror">
                    <input id="name"
                           name="name"
                           class="input @error('name') is-danger @enderror"
                           type="text"
                           placeholder="Nama Asli"
                           value="{{ old("name")  }}"
                    >
                    @error('name')
                    <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    @enderror
                </div>
                @error('name')
                <p class="help is-danger"> {{ $message }} </p>
                @enderror
            </div>

            <div class="field">
                <label class="label"
                       for="username"
                >Nama Pengguna</label>
                <div class="control @error('username') has-icons-right @enderror">
                    <input id="username"
                           name="username"
                           class="input @error('username') is-danger @enderror"
                           type="text"
                           placeholder="Nama Pengguna"
                           value="{{ old("username")  }}"
                    >
                    @error('username')
                    <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    @enderror
                </div>
                @error('username')
                <p class="help is-danger"> {{ $message }} </p>
                @enderror
            </div>

            <div class="field">
                <label class="label"
                       for="no_telepon"
                >No. Telepon</label>
                <div class="control @error('no_telepon') has-icons-right @enderror">
                    <input id="no_telepon"
                           name="no_telepon"
                           class="input @error('no_telepon') is-danger @enderror"
                           type="tel"
                           placeholder="No. Telepon"
                           value="{{ old("no_telepon")  }}"
                    >
                    @error('no_telepon')
                    <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    @enderror
                </div>
                @error('no_telepon')
                <p class="help is-danger"> {{ $message }} </p>
                @enderror
            </div>

            <div class="field">
                <label class="label"
                       for="password"
                >Kata Sandi</label>
                <div class="control @error('password') has-icons-right @enderror">
                    <input id="password"
                           name="password"
                           class="input @error('password') is-danger @enderror"
                           type="password"
                           placeholder="Kata Sandi"
                           value="{{ old("password")  }}"
                    >
                    @error('password')
                    <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    @enderror
                </div>
                @error('password')
                <p class="help is-danger"> {{ $message }} </p>
                @enderror
            </div>

            <div class="field">
                <label class="label"
                       for="password_confirmation"
                >Ulangi Kata Sandi</label>
                <div class="control @error('password_confirmation') has-icons-right @enderror">
                    <input id="password_confirmation"
                           name="password_confirmation"
                           class="input @error('password_confirmation') is-danger @enderror"
                           type="password"
                           placeholder="Ulangi Kata Sandi"
                           value="{{ old("password_confirmation")  }}"
                    >
                    @error('password_confirmation')
                    <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    @enderror
                </div>
                @error('password_confirmation')
                <p class="help is-danger"> {{ $message }} </p>
                @enderror
            </div>

            <div class="has-text-right">
                <button class="button is-primary">
                    Daftar
                </button>
            </div>
        </form>
    </div>
@endsection