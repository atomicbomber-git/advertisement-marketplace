<div>
    <h1 class="title is-1">
        Invoice
    </h1>

    @include("components.messages")

    <div class="select">
        <label for="status">
            <select wire:model="status" id="status">
                @foreach($this->statusOptions AS $value => $label)
                    <option value="{{ $value }}">
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </label>
    </div>

    <div class="table-container my-5">
        <table class="table is-narrow is-fullwidth is-striped is-hoverable">
            <thead>
            <tr>
                <th> # </th>
                <th> Waktu Pembuatan </th>
                <th> Waktu Checkout </th>
                <th> Waktu Pelunasan </th>
                <th> Penjual </th>
                <th> Status </th>
                <th class="has-text-centered">
                    Kendali
                </th>
            </tr>
            </thead>

            <tbody>
            @foreach($this->invoices AS $invoice)
                <tr>
                    <td> {{ $this->invoices->firstItem() + $loop->index  }} </td>
                    <td> {{ $invoice->created_at }} </td>
                    <td> {{ $invoice->waktu_checkout ?? '-' }} </td>
                    <td> {{ $invoice->waktu_pelunasan ?? '-' }} </td>
                    <td> {{ $invoice->penjual->nama }} </td>
                    <td>
                        @include('components.invoice-status', [
                            "status" => $invoice->status,
                        ])
                    </td>
                    <td class="has-text-centered">
                        <a href="{{ route("pelanggan.invoice-for-pelanggan.show", [$invoice->pelanggan_id, $invoice->id]) }}"
                           class="button is-info is-small"
                        >
                                <span class="icon is-small">
                                    <i class="fas fa-list-alt"></i>
                                </span>
                            <span>
                                Lihat
                            </span>
                        </a>

                        @can(\App\Providers\AuthServiceProvider::FINISH_PENJUAL_INVOICE, $invoice)
                            <a href="{{ route("pelanggan.invoice-for-pelanggan.edit", [$invoice->pelanggan_id, $invoice]) }}"
                               class="button is-info is-small"
                            >
                                <span class="icon is-small">
                                    <i class="fas fa-pencil-alt"></i>
                                </span>
                                <span>
                                    Edit / Checkout
                                </span>
                            </a>

                            <button
                                    x-data="{}"
                                    x-on:click="
                                        confirmDialog()
                                            .then(response => {
                                                if (!response.value) { return }
                                                window.livewire.emit('cancel', {{ $invoice->id }})
                                            })
                                    "
                                    class="button is-danger is-small"
                                >
                                <span class="icon is-small">
                                    <i class="fas fa-trash"></i>
                                </span>
                                    <span>
                                    Batalkan
                                </span>
                            </button>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="d:f j-c:c">
        {{ $this->invoices->links() }}
    </div>
</div>
