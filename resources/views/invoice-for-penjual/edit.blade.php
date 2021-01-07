@extends("layouts.app-admin")

@section("content")
    <livewire:invoice-for-penjual-edit
        :penjual="$penjual"
        :invoice="$invoice"
    />
@endsection