@extends('layouts.app')

@section('content')
    <div class="columns is-multiline">
        @foreach($produks as $produk)
            <div class="column is-one-quarter">
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

            </div>
        @endforeach
    </div>


@endsection
