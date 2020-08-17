@extends("layouts.app-admin")

@section("content")
    <livewire:invoice-for-penjual-index
        penjual_id="{{ $penjual_id }}"
    />
@endsection