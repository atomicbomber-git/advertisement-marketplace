@switch($status)
    @case(\App\Constants\InvoiceStatus::DRAFT)
    <span class="tag is-light">
        Belum Checkout
    </span>
    @break
    @case(\App\Constants\InvoiceStatus::UNPAID)
    <span class="tag is-info">
        Belum Lunas
    </span>
    @break
    @case(\App\Constants\InvoiceStatus::PAID)
    <span class="tag is-success">
        Lunas
    </span>
    @break
    @case(\App\Constants\InvoiceStatus::CANCELED)
    <span class="tag is-danger">
        Dibatalkan
    </span>
    @break
    @default
    <span class="tag is-dark">
        Tidak Diketahui
    </span>
@endswitch