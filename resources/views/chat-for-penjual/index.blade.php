@extends("layouts.app-admin")

@section("content")
    <livewire:chat-penjual-index
            :pelanggan-id="$pelanggan->id"
        :pesan-dari-pelanggan="false"
    />
@endsection