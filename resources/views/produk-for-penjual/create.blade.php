@extends("layouts.app-admin")

@section("content")
    <h1 class="title is-1">
        <a class="has-text-link"
           href="{{ route("penjual.produk-for-penjual.index", $penjual) }}"
        >
            Produk
        </a>
        / Tambah
    </h1>

    <div class="box">
        <form enctype="multipart/form-data"
              method="POST"
              action="{{ route("penjual.produk-for-penjual.store", $penjual) }}"
        >
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
                       for="kategori_produk_id"
                > Kategori </label>
                <div class="control @error('kategori_produk_id') is-danger @enderror">
                    <div class="select">
                        <select name="kategori_produk_id"
                                id="kategori_produk_id"
                        >
                            @foreach ($kategori_produks as $kategori_produk)
                                <option value="{{ $kategori_produk->id }}">
                                    {{ $kategori_produk->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @error("kategori_produk_id")
                <p class="help is-danger">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="field">
                <label class="label"
                       for="lokasi"
                >Lokasi</label>
                <div class="control @error('lokasi') has-icons-right @enderror">
                    <textarea id="lokasi"
                              name="lokasi"
                              rows="5"
                              class="textarea @error('lokasi') is-danger @enderror"
                              placeholder="Lokasi"
                    >{{ old("lokasi") }}</textarea>
                    @error('lokasi')
                    <span class="icon is-small is-right">
                        <i class="fas fa-exclamation-triangle"></i>
                    </span>
                    @enderror
                </div>
                @error('lokasi')
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

            <div class="field">
                <label class="label"
                       for="image"
                > Gambar </label>

                <div class="file is-fullwidth"
                     x-data="{ file: null }"
                >
                    <label class="file-label">
                        <input
                                x-on:input="file = $event.target.files[0]"
                                class="file-input"
                                accept="image/png,image/jpeg,image.jpg"
                                type="file"
                                name="image"
                        >
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

                @error('image')
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
