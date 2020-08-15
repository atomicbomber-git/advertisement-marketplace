@extends("layouts.app-admin")

@section("content")
    <h1 class="title is-1">
        <a class="has-text-link" href="{{ route("penjual.produk-for-penjual.index", $produk->penjual_id) }}">
            Produk
        </a>
        / Ubah
    </h1>

    @include("components.messages")

    <div class="box">
        <form enctype="multipart/form-data" method="POST"
              action="{{ route("produk-for-penjual.update", $produk) }}">
            @csrf
            @method("PUT")

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
                           value="{{ old("kode", $produk->kode)  }}"
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
                           value="{{ old("nama", $produk->nama)  }}"
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
                    >{{ old("deskripsi", $produk->deskripsi) }}</textarea>
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
                           value="{{ old("harga", $produk->harga)  }}"
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

            <div class="field">
                <figure>
                    <img
                        src="{{ route("produk-thumb.show", $produk)  }}"
                        alt="Thumbnail of {{ $produk->nama }}">
                    <figcaption>
                        Gambar Produk Sekarang
                    </figcaption>
                </figure>
            </div>

            <div class="field">
                <label class="label"
                       for="image"
                > Gambar Baru </label>

                <div class="file is-fullwidth"
                     x-data="{ file: null }"
                >
                    <label class="file-label">
                        <input
                            x-on:input="file = $event.target.files[0]"
                            class="file-input" accept="image/png,image/jpeg,image.jpg" type="file" name="image">
                        <span class="file-cta">
                          <span class="file-icon">
                            <i class="fas fa-upload"></i>
                          </span>
                          <span class="file-label">
                            Pilih berkas gambar...
                          </span>
                        </span>
                        <span class="file-name"
                            x-text="!file ? 'Belum terdapat berkas' : file.name"
                        >
                        </span>
                    </label>
                </div>
                <p class="help">
                    Kosongkan kolom diatas jika Anda tidak ingin mengubah gambar yang telah ada
                </p>

                @error('image')
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
