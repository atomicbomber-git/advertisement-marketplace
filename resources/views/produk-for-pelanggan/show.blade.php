@extends("layouts.app-guest")

@section("content")
    <livewire:produk-for-pelanggan-show
        produk_id="{{ $produk->id }}"
    />
@endsection