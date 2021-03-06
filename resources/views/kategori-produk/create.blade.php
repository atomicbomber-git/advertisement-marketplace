@extends("layouts.app-admin")

@section("content")
    <h1 class="title is-1">
        <a class="has-text-link" href="{{ route("kategori-produk.index") }}">
            Kategori Produk
        </a>
        / Tambah
    </h1>

    <div class="box">
        <form action="{{ route("kategori-produk.store") }}"
              method="POST"
        >
            @csrf
            @method("POST")

            <div class="field">
                <label class="label"
                       for="nama"
                >Nama</label>
                <div class="control @error('nama') has-icons-right @enderror">
                    <input id="nama"
                           name="nama"
                           class="input @error('nama') is-danger @enderror"
                           type="text"
                           placeholder="Nama"
                           value="{{ old("nama")  }}"
                    >
                    @error('nama')
                    <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    @enderror
                </div>
                @error('nama')
                <p class="help is-danger"> {{ $message }} </p>
                @enderror
            </div>

            <div class="has-text-right">
                <button class="button is-info">
                    Tambah
                </button>
            </div>
        </form>
    </div>
@endsection
