@extends("layouts.app-guest")

@section('content')
    <div class="columns is-multiline">
        @foreach($produks as $produk)
            <div class="column is-one-quarter">
                <a href="{{ route("penjual.produk-for-guest.show", [$produk->penjual_id, $produk->kode]) }}">
                    <div class="card">
                        <div class="card-image">
                            <figure class="image is-4by3">
                                <img src="{{ route("produk-thumb.show", $produk)  }}" alt="Placeholder image">
                            </figure>
                        </div>
                        <div class="card-content">
                            <div class="content">
                            <span class="is-uppercase is-block has-text-weight-bold">
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
@endsection
