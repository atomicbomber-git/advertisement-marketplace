@extends("layouts.app-admin")

@section("content")
    <livewire:penjual-produk-for-penjual-index
        penjual-id="{{ $penjual->id }}"
    />
@endsection