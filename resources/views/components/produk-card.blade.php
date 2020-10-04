<a href="{{ route("penjual.produk-for-pelanggan.show", [$produk->penjual_id, $produk->kode]) }}">
    <div class="card">
        <div class="card-image"
             style="position: relative"
        >
            <figure class="image is-4by3">
                <img src="{{ route("produk-thumb.show", $produk)  }}"
                     alt="Placeholder image"
                >

                <span
                        style="position: absolute; top: 10px; right: 10px; z-index: 999"
                        class="tag is-danger is-medium"
                > {{ $produk->kategori_produk->nama }} </span>

            </figure>
        </div>
        <div class="card-content">
            <div class="content">
                <span class="is-uppercase is-block has-text-grey has-text-weight-bold">
                    {{ $produk->nama }}
                </span>
                <span class="is-block">
                    {{ $produk->lokasi  }}
                </span>

                <span class="is-block has-text-weight-bold">
                    {{ $produk->penjual->nama  }}
                </span>
                <span class="is-block has-text-weight-bold has-text-info">
                    <i class="fas fa-money-bill"></i>
                    {{ Facades\App\Support\Formatter::currency($produk->harga) }}
                </span>
                <p class="mt-3">
                    {{ $produk->deskripsi  }}
                </p>
            </div>
        </div>
    </div>
</a>
