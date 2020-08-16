@extends("layouts.app-admin")

@section("content")
    <livewire:invoice-for-pelanggan-edit
            invoice_id="{{ $invoice_id }}"
    />
@endsection