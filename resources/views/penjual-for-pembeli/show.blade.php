@extends("layouts.app-guest")

@section("content")
    <livewire:penjual-for-pembeli-show
        penjual_id="{{ $penjual_id }}"
    ></livewire:penjual-for-pembeli-show>
@endsection