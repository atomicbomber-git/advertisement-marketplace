@extends("layouts.app-admin")

@section("content")
    <h1 class="title is-1"> Profil Penjual </h1>


    @if($penjual->terverifikasi)

    @else
        <article class="message is-warning">
            <div class="message-body">
                <span class="icon is-small mr-1">
                    <i class="fas fa-exclamation-triangle"></i>
                </span>

                Akun Anda belum diverifikasi oleh <strong>Admin</strong>, Anda belum dapat mengakses seluruh
                fitur yang tersedia.
            </div>
        </article>
    @endif


    @include("components.messages")

    <div class="box"
    >
        <form action="{{ route("penjual-profile.update", $penjual) }}"
              method="POST"
        >
            @csrf
            @method("PUT")

            <h2 class="title is-5"> Data Penjual </h2>
            <div class="field">
                <label class="label"
                       for="seller_name"
                >Nama</label>
                <div class="control @error('seller_name') has-icons-right @enderror">
                    <input id="seller_name"
                           name="seller_name"
                           class="input @error('seller_name') is-danger @enderror"
                           type="text"
                           placeholder="Nama"
                           value="{{ old("seller_name", $penjual->nama)  }}"
                    >
                    @error('seller_name')
                    <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    @enderror
                </div>
                @error('seller_name')
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
                           type="text"
                           placeholder="No. Telepon"
                           value="{{ old("no_telepon", $penjual->no_telepon)  }}"
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
                       for="alamat"
                >Alamat</label>
                <div class="control @error('alamat') has-icons-right @enderror">
                    <textarea id="alamat"
                              name="alamat"
                              rows="4"
                              cols="30"
                              class="textarea @error('alamat') is-danger @enderror"
                              placeholder="Alamat"
                    >{{ old("alamat", $penjual->alamat) }}</textarea>
                    @error('alamat')
                    <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    @enderror
                </div>
                @error('alamat')
                <p class="help is-danger"> {{ $message }} </p>
                @enderror
            </div>

            <hr>

            <h2 class="title is-5"> Data Akun Admin </h2>

            <div class="field">
                <label class="label"
                       for="name"
                >Nama Asli Admin</label>
                <div class="control @error('name') has-icons-right @enderror">
                    <input id="name"
                           name="name"
                           class="input @error('name') is-danger @enderror"
                           type="text"
                           placeholder="Nama Asli Admin"
                           value="{{ old("name", $penjual->user->name)  }}"
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
                           value="{{ old("username", $penjual->user->username)  }}"
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
                       for="password"
                >Kata Sandi</label>
                <div class="control @error('password') has-icons-right @enderror">
                    <input id="password"
                           autocomplete="off"
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
                           autocomplete="off"
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
                    Ubah
                </button>
            </div>
        </form>
    </div>
@endsection