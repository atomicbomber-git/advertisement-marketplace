@extends("layouts.app-admin")

@section("content")
    <livewire:invoice-for-pelanggan-index
        pelanggan_id="{{ $pelanggan_id }}"
    />
@endsection