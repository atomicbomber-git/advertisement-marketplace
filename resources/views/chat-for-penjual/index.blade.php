@extends("layouts.app-admin")

@section("content")
    <livewire:chat-index
            :pelanggan-id="$pelanggan->id"
        :pesan-dari-pelanggan="false"
    />
@endsection
