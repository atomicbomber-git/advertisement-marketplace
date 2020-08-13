@extends("layouts.app")

@section("content")
    <h1 class="title is-1">
        <a class="has-text-link" href="{{ route("penjual.produk-for-penjual.index", $penjual) }}">
            Produk
        </a>
        / Tambah
    </h1>

    <div class="box">
        <form method="POST" action="{{ route("penjual.produk-for-penjual.store", $penjual) }}">
            @csrf

            <div class="field">
                <label class="label"
                       for="kode"
                >Kode</label>
                <div class="control @error('kode') has-icons-right @enderror">
                    <input id="kode"
                           name="kode"
                           class="input @error('kode') is-danger @enderror"
                           type="text"
                           placeholder="Kode"
                           value="{{ old("kode")  }}"
                    >
                    @error('kode')
                    <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    @enderror
                </div>
                @error('kode')
                <p class="help is-danger"> {{ $message }} </p>
                @enderror
            </div>

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

            <div class="field">
                <label class="label"
                       for="deskripsi"
                >Deskripsi</label>
                <div class="control @error('deskripsi') has-icons-right @enderror">
                    <textarea id="deskripsi"
                              name="deskripsi"
                              rows="5"
                              class="textarea @error('deskripsi') is-danger @enderror"
                              placeholder="Deskripsi"
                    >{{ old("deskripsi") }}</textarea>
                    @error('deskripsi')
                    <span class="icon is-small is-right">
                        <i class="fas fa-exclamation-triangle"></i>
                    </span>
                    @enderror
                </div>
                @error('deskripsi')
                <p class="help is-danger"> {{ $message }} </p>
                @enderror
            </div>

            <div class="field">
                <label class="label"
                       for="harga"
                >Harga</label>
                <div class="control @error('harga') has-icons-right @enderror">
                    <input id="harga"
                           name="harga"
                           class="input @error('harga') is-danger @enderror"
                           type="number"
                           placeholder="Harga"
                           value="{{ old("harga")  }}"
                    >
                    @error('harga')
                    <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                    @enderror
                </div>
                @error('harga')
                <p class="help is-danger"> {{ $message }} </p>
                @enderror
            </div>


            <div class="has-text-right">
                <button class="button is-primary">
                    Tambah
                </button>
            </div>
        </form>
    </div>
@endsection
