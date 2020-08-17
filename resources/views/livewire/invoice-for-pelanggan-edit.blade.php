<div>
    <h1 class="title is-1">
        <a href="{{ route("pelanggan.invoice-for-pelanggan.index", $this->invoice->pelanggan_id) }}">
            Invoice
        </a>
        /
        Ubah atau Checkout
    </h1>

    <dl class="my-5 box">
        <dt class="has-text-weight-bold"> Penjual</dt>
        <dd class="mb-3">
            <a href="{{ route("penjual-for-pembeli.show", $this->invoice->penjual_id) }}">
                {{ $this->invoice->penjual->nama  }}
            </a>
        </dd>

        <dt class="has-text-weight-bold"> Waktu Pemesanan </dt>
        <dd class="mb-2"> {{ $this->invoice->created_at ?? '-' }} </dd>

        <dt class="has-text-weight-bold"> Waktu Checkout </dt>
        <dd class="mb-2"> {{ $this->invoice->waktu_checkout ?? '-' }} </dd>

        <dt class="has-text-weight-bold"> Waktu Pelunasan </dt>
        <dd class="mb-2"> {{ $this->invoice->waktu_pelunasan ?? '-' }} </dd>

        <dt class="has-text-weight-bold"> Status </dt>
        <dd class="mb-2">
            @include("components.invoice-status", [
                "status" => $this->invoice->status
            ])
        </dd>
    </dl>

    <div class="table-container box my-5">
        <h2 class="title is-3"> Daftar Produk </h2>

        @include("components.messages")

        <table class="table is-striped is-small is-fullwidth is-hoverable">
            <thead>
            <tr>
                <th> #</th>
                <th> Produk</th>
                <th class="has-text-right"> Harga Satuan</th>
                <th class="has-text-right"> Kuantitas</th>
                <th class="has-text-right"> Subtotal</th>
                <th class="has-text-centered"> Kendali</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($invoiceItemsData as $invoiceItemId => $invoiceItemData)
                <tr>
                    <td> {{ $loop->iteration }} </td>
                    <td>
                        <a href="{{ route("penjual.produk-for-pelanggan.show", [$invoiceItemData["produk"]["penjual_id"], $invoiceItemData["produk"]["kode"]])  }}">
                            {{ $invoiceItemData["produk"]["nama"] }}
                        </a>
                    </td>
                    <td class="has-text-right">
                        {{ \Facades\App\Support\Formatter::currency($invoiceItemData["produk"]["harga"]) }}
                    </td>
                    <td>
                        <div class="field has-addons has-addons-right">
                            <p class="control">
                                <button
                                        class="button is-info is-small"
                                        wire:click="decrementProductQuantity({{ $invoiceItemId }})"
                                >
                                    <span class="icon">
                                        <i class="fas fa-minus"></i>
                                    </span>
                                </button>
                            </p>
                            <p class="control">
                                <label for="kuantitas">
                                    <input
                                            id="kuantitas"
                                            wire:model="invoiceItemsData.{{ $invoiceItemId }}.kuantitas"
                                            class="input is-small has-text-right"
                                            type="number"
                                            step="1"
                                            min="0"
                                            placeholder="Jumlah pembelian"
                                    />
                                </label>
                            </p>
                            <p class="control">
                                <button
                                        class="button is-info is-small"
                                        wire:click="incrementProductQuantity({{ $invoiceItemId }})"
                                >
                                    <span class="icon">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                </button>
                            </p>
                        </div>
                    </td>
                    <td class="has-text-right">
                        {{ \Facades\App\Support\Formatter::currency($invoiceItemData["kuantitas"] * $invoiceItemData["produk"]["harga"]) }}
                    </td>
                    <td class="has-text-centered">
                        <button
                                x-data="{}"
                                x-on:click="
                                    window.confirmDialog()
                                        .then(resp => {
                                            if (!resp.value) {
                                                return
                                            }
                                            window.livewire.emit('deleteInvoiceItem', {{ $invoiceItemId }})
                                        })
                                "

                                class="button is-info is-small is-danger"
                        >
                            <span class="icon is-small">
                                <i class="fas fa-trash"></i>
                            </span>
                            <span>
                                Hapus
                            </span>
                        </button>

                    </td>
                </tr>
            @endforeach
            </tbody>

            <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="has-text-right has-text-weight-bold has-text-info">
                    {{ \Facades\App\Support\Formatter::currency($this->totalPrice) }}
                </td>
                <td></td>
            </tr>
            </tfoot>
        </table>

        <div class="d:f j-c:f-e">
            <button
                    x-data="{}"
                    x-on:click="window.confirmDialog().then(response => {
                        if (!response.value) {
                            return
                        }
                        window.livewire.emit('checkoutInvoice')
                    })"
                    class="button is-info"
            >
                <span class="icon is-small">
                    <i class="fas fa-check"></i>
                </span>
                <span>
                    Check Out
                </span>
            </button>
        </div>
    </div>
</div>
