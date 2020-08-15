@extends("layouts.app-guest")

@section("content")
    <livewire:produk-for-guest-show
        produk_id="{{ $produk->id }}"
    />
@endsection