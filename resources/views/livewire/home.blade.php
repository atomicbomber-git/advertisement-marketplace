<div>
    <!-- Main container -->
    <nav class="box level">
        <!-- Left side -->
        <div class="level-left">
            <div class="level-item">
                <label for="kategori_produk_id"
                       class="mr-2"
                >
                    Kategori
                </label>

                <div class="select">
                    <select wire:model.lazy="kategori_produk_id"
                            id="kategori_produk_id"
                    >
                        <option value="{{ \App\Http\Livewire\Home::ALL_KATEGORI_PRODUK_ID  }}">
                            ---- Semua ----
                        </option>

                        @foreach ($kategori_produks as $kategori_produk)
                            <option value="{{ $kategori_produk->id }}">
                                {{ $kategori_produk->nama }}
                            </option>
                        @endforeach
                    </select>


                </div>
            </div>
        </div>

        <!-- Right side -->
        <div class="level-right">
        </div>
    </nav>

    <article class="message is-info">
        <div class="message-body">
            Menampilkan seluruh produk
            @if($current_kategori_produk)
                dengan kategori <strong> {{ $current_kategori_produk->nama }} </strong>
            @endif
        </div>
    </article>

    <div class="columns is-multiline">
        @foreach($produks as $produk)
            <div class="column is-one-quarter">
                <a href="{{ route("penjual.produk-for-pelanggan.show", [$produk->penjual_id, $produk->kode]) }}">
                    <div class="card">
                        <div class="card-image" style="position: relative">
                            <figure class="image is-4by3">
                                <img src="{{ route("produk-thumb.show", $produk)  }}"
                                     alt="Placeholder image"
                                >

                                <span
                                        style="position: absolute; top: 10px; right: 10px; z-index: 999"
                                        class="tag is-danger is-medium"> {{ $produk->kategori_produk->nama }} </span>

                            </figure>
                        </div>
                        <div class="card-content">
                            <div class="content">
                                <span class="is-uppercase is-block has-text-grey has-text-weight-bold">
                                {{ $produk->nama }}
                            </span>
                                <span class="is-block has-text-weight-bold">
                                {{ $produk->penjual->nama  }}
                            </span>
                                <span class="is-block has-text-weight-bold has-text-info">
                                <i class="fas fa-money-bill"></i> {{ Facades\App\Support\Formatter::currency($produk->harga) }}
                            </span>
                                <p class="mt-3">
                                    {{ $produk->deskripsi  }}
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <div class="my-3"
         style="width: 100%; display: flex; justify-content: center"
    >
        {{ $produks->links() }}
    </div>
</div>
