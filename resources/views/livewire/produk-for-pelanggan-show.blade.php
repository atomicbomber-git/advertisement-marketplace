<div>
    <nav class="breadcrumb"
         aria-label="breadcrumbs"
    >
        <ul>
            <li>
                <a href="{{ route("home") }}">
                    Home
                </a>
            </li>
            <li>
                <a href="">
                    {{ $this->penjual->nama }}
                </a>
            </li>
            <li class="is-active">
                <a href="#"
                   aria-current="page"
                >
                    {{ $this->produk->nama }}
                </a>
            </li>
        </ul>
    </nav>

    <div class="columns">
        <div class="column is-one-third">
            <figure class="image is-4by5">
                <img
                        alt="{{ $this->produk->nama }}"
                        src="{{ route("produk-thumb.show", $this->produk->id) }}"
                >
            </figure>
        </div>

        <div class="column">
            <h1 class="title is-3"> {{ $this->produk->nama }} </h1>
            <p class="subtitle is-3 has-text-danger">
                {{ \Facades\App\Support\Formatter::currency($this->produk->harga) }}
            </p>

            <div class="my-3">
                @can(\App\Providers\AuthServiceProvider::CREATE_PELANGGAN_INVOICE)
                    @if($this->invoice === null || $this->invoiceItem === null)
                        <button wire:click="addInvoiceItem"
                                class="button is-info"
                        >
                        <span class="icon is-small">
                            <i class="fas fa-plus"></i>
                        </span>
                            <span>
                            Tambahkan ke Keranjang
                        </span>
                        </button>
                    @else
                        <div class="field has-addons has-addons-left">
                            <p class="control">

                                <button
                                        wire:click="decrementInvoiceItemQuantity"
                                        class="button is-info"
                                >
                                    <span class="icon">
                                        <i class="fas fa-minus"></i>
                                    </span>
                                </button>


                            </p>
                            <p class="control">
                                <input
                                        wire:model="invoiceItemQuantity"
                                        class="input"
                                        type="number"
                                        step="1"
                                        min="0"
                                        placeholder="Jumlah pembelian"
                                >
                            </p>
                            <p class="control">
                                <button
                                        wire:click="incrementInvoiceItemQuantity"
                                        class="button is-info"
                                >
                                    <span class="icon">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                </button>
                            </p>
                        </div>
                    @endif
                @else
                    <article class="message is-warning">
                        <div class="message-body">
                        <span class="icon">
                            <i class="fas fa-exclamation-triangle  "></i>
                        </span>
                            Anda hanya dapat melakukan aktivitas jual beli jika akun anda <strong> telah
                                terverifikasi. </strong>
                        </div>
                    </article>
                @endcan
            </div>

            <p>
                {{ $this->produk->deskripsi  }}
            </p>

        </div>
    </div>
</div>
