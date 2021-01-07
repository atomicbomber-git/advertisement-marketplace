@extends("layouts.app-admin")

@section("content")
    <div>
        <h1 class="title is-1">
            <a href="{{ route("penjual.invoice-for-penjual.index", $invoice->penjual_id) }}">
                Invoice
            </a>
            /
            Lihat
        </h1>

        <dl class="my-5 box">
            <dt class="has-text-weight-bold"> Penjual </dt>
            <dd class="mb-2">
                <a href="{{ route("penjual-for-pembeli.show", $invoice->penjual_id) }}">
                    {{ $invoice->penjual->nama  }}
                </a>
            </dd>

            <dt class="has-text-weight-bold"> Waktu Pemesanan </dt>
            <dd class="mb-2"> {{ $invoice->created_at ?? '-' }} </dd>

            <dt class="has-text-weight-bold"> Waktu Checkout </dt>
            <dd class="mb-2"> {{ $invoice->waktu_checkout ?? '-' }} </dd>

            <dt class="has-text-weight-bold"> Waktu Pelunasan </dt>
            <dd class="mb-2"> {{ $invoice->waktu_pelunasan ?? '-' }} </dd>

            <dt class="has-text-weight-bold"> Status </dt>
            <dd class="mb-2">
                @include("components.invoice-status", [
                    "status" => $invoice->status
                ])
            </dd>
        </dl>

        <div class="table-container box my-5">
            <h2 class="title is-3"> Daftar Produk </h2>

            @include("components.messages")

            <table class="table is-striped is-small is-fullwidth is-hoverable">
                <thead>
                <tr>
                    <th> # </th>
                    <th> Produk </th>
                    <th class="has-text-right"> Harga Satuan </th>
                    <th class="has-text-right"> Kuantitas </th>
                    <th class="has-text-centered"> Waktu Mulai Sewa </th>
                    <th class="has-text-centered"> Waktu Selesai Sewa </th>
                    <th class="has-text-centered"> Masa Sewa Selesai? </th>
                    <th class="has-text-right"> Subtotal </th>
                </tr>
                </thead>

                <tbody>
                @foreach ($invoice_items as $invoice_item)
                    <tr>
                        <td> {{ $loop->iteration }} </td>
                        <td>
                            <a href="{{ route("penjual.produk-for-pelanggan.show", [$invoice_item->produk->penjual_id, $invoice_item->produk->kode]) }}">
                                {{ $invoice_item->produk->nama }}
                            </a>
                        </td>
                        <td class="has-text-right">
                            {{ \Facades\App\Support\Formatter::currency($invoice_item->harga) }}
                        </td>
                        <td class="has-text-right">
                            {{ $invoice_item->kuantitas }}
                        </td>

                        <td class="has-text-centered"> {{ \App\Support\Formatter::dayMonthYear($invoice_item->waktu_mulai_sewa) }} </td>
                        <td class="has-text-centered"> {{ \App\Support\Formatter::dayMonthYear($invoice_item->waktu_selesai_sewa) }} </td>
                        <td class="has-text-centered">
                            <x-boolean-status
                                :value="!$invoice_item->is_still_reserved"
                            />

                        </td>

                        <td class="has-text-right">
                            {{ \Facades\App\Support\Formatter::currency($invoice_item->subtotal) }}
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
                    <td></td>
                    <td class="has-text-right has-text-weight-bold has-text-info">
                        {{ \Facades\App\Support\Formatter::currency($totalPrice) }}
                    </td>
                    <td></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

@endsection