@extends("layouts.app-guest")

@section("content")
    <livewire:chat-index
        :penjual-id="$penjual->id"
        :pesan-dari-pelanggan="true"
    />
@endsection
