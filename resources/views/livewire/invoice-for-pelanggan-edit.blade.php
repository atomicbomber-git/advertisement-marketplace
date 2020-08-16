<div>
    <h1 class="title is-1">
        <a href="{{ route("pelanggan.invoice-for-pelanggan.index", $this->invoice->pelanggan_id) }}">
            Invoice
        </a>
        /
        Ubah atau Checkout
    </h1>

    <table class="table is-striped is-small is-fullwidth is-hoverable">
        <thead>
            <tr>
                <th> # </th>
                <th> Produk </th>
                <th class="has-text-right"> Harga Satuan </th>
                <th class="has-text-right"> Kuantitas </th>
                <th class="has-text-right"> Subtotal </th>
                <th> Kendali </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($invoiceItemsData as $index => $invoiceItemData)
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
                                        wire:model="invoiceItemsData.{{ $index }}.kuantitas"
                                        class="input is-small has-text-right"
                                        type="number"
                                        step="1"
                                        min="0"
                                        placeholder="Jumlah pembelian"/>
                            </label>
                        </p>
                        <p class="control">
                            <button
                                    class="button is-info is-small"
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
                <td> {{ $loop->iteration }} </td>
            @endforeach
        </tbody>
    </table>
</div>
