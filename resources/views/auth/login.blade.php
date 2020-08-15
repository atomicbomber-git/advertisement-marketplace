@extends("layouts.app-guest")

@section('content')
<div class="container">
    <div class="box" style="max-width: 400px; margin: auto">

        <h1 class="title is-5 is-uppercase has-text-primary"> Login </h1>

        <form action="{{ route("login") }}"
              method="POST"
        >
            @csrf
            @method("POST")

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

            <div class="d:f j-c:f-e">
                <button class="button is-primary">
                    @lang("app.login")
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
