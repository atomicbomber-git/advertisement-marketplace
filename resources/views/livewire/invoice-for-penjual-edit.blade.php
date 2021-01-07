<div>
    <h1 class="title is-1">
        <a href="{{ route("penjual.invoice-for-penjual.index", $invoice->penjual_id) }}">
            Invoice
        </a>
        /
        Selesaikan
    </h1>

    <dl class="my-5 box">
        <dt class="has-text-weight-bold"> Penjual</dt>
        <dd class="mb-3">
            <a href="{{ route("penjual-for-pembeli.show", $invoice->penjual_id) }}">
                {{ $invoice->penjual->nama  }}
            </a>
        </dd>

        <dt class="has-text-weight-bold"> Waktu Pemesanan</dt>
        <dd> {{ $invoice->created_at }} </dd>
    </dl>

    <div class="table-container box my-5">
        <h2 class="title is-3"> Daftar Produk </h2>

        @include("components.messages")

        <form
                id="form"
                x-data="{}"
                @submit.prevent="confirmDialog().then(res => res.isConfirmed && @this.call('submit'))"
        >
            <table class="table is-striped is-small is-fullwidth is-hoverable">
                <thead>
                <tr>
                    <th> #</th>
                    <th> Produk</th>
                    <th class="has-text-right"> Harga Satuan</th>
                    <th class="has-text-right"> Kuantitas</th>
                    <th class="has-text-centered"> W. Mulai Sewa</th>
                    <th class="has-text-centered"> W. Akhir Sewa</th>
                    <th class="has-text-right"> Subtotal</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($invoice_items as $index => $invoice_item)
                    <tr wire:key="{{ $index }}">
                        <td> {{ $loop->iteration }} </td>
                        <td>
                            <a href="{{ route("penjual.produk-for-pelanggan.show", [$invoice_item["produk"]["penjual_id"], $invoice_item["produk"]["kode"]]) }}">
                                {{ $invoice_item["produk"]["nama"] }}
                            </a>
                        </td>
                        <td class="has-text-right">
                            {{ \Facades\App\Support\Formatter::currency($invoice_item["harga"]) }}
                        </td>
                        <td class="has-text-right">
                            {{ $invoice_item["kuantitas"] }}
                        </td>
                        <td>
                            <div class="field">
                                <label class="label sr-only"
                                       for="invoice_items.{{ $index }}.waktu_mulai_sewa"
                                > W. Mulai Sewa </label>
                                <div class="control @error("invoice_items.$index.waktu_mulai_sewa") has-icons-right @enderror">
                                    <input id="invoice_items.{{ $index }}.waktu_mulai_sewa"
                                           wire:model.lazy="invoice_items.{{ $index }}.waktu_mulai_sewa"
                                           name="invoice_items.{{ $index }}.waktu_mulai_sewa"
                                           class="input @error("invoice_items.$index.waktu_mulai_sewa") is-danger @enderror"
                                           type="date"
                                           placeholder=" W. Mulai Sewa "
                                           value="{{ old("invoice_items.$index.waktu_mulai_sewa")  }}"
                                    >
                                    @error("invoice_items.$index.waktu_mulai_sewa")
                                    <span class="icon is-small is-right">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </span>
                                    @enderror
                                </div>
                                @error("invoice_items.$index.waktu_mulai_sewa")
                                <p class="help is-danger"> {{ $message }} </p>
                                @enderror
                            </div>
                        </td>
                        <td>
                            <div class="field">
                                <label class="label sr-only"
                                       for="invoice_items.{{ $index }}.waktu_selesai_sewa"
                                > W. Selesai Sewa </label>
                                <div class="control @error("invoice_items.$index.waktu_selesai_sewa") has-icons-right @enderror">
                                    <input id="invoice_items.{{ $index }}.waktu_selesai_sewa"
                                           wire:model.lazy="invoice_items.{{ $index }}.waktu_selesai_sewa"
                                           name="invoice_items.{{ $index }}.waktu_selesai_sewa"
                                           class="input @error("invoice_items.$index.waktu_selesai_sewa") is-danger @enderror"
                                           type="date"
                                           placeholder=" W. Selesai Sewa "
                                           value="{{ old("invoice_items.$index.waktu_selesai_sewa")  }}"
                                    >
                                    @error("invoice_items.$index.waktu_selesai_sewa")
                                    <span class="icon is-small is-right">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </span>
                                    @enderror
                                </div>
                                @error("invoice_items.$index.waktu_selesai_sewa")
                                <p class="help is-danger"> {{ $message }} </p>
                                @enderror
                            </div>

                        </td>
                        <td class="has-text-right">
                            {{ \Facades\App\Support\Formatter::currency($invoice_item["subtotal"]) }}
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
                    <td></td>
                    <td></td>
                    <td class="has-text-right has-text-weight-bold has-text-info">
                        {{ \Facades\App\Support\Formatter::currency($totalPrice) }}
                    </td>
                    <td></td>
                </tr>
                </tfoot>
            </table>

            <div class="d:f j-c:f-e">
                <button
                        class="button is-info"
                >
                    <span class="icon is-small">
                        <i class="fas fa-check"></i>
                    </span>
                    <span>
                    Selesaikan
                </span>
                </button>
            </div>
        </form>
    </div>
</div>
