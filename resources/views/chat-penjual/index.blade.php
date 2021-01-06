@extends("layouts.app-guest")

@section("content")
    <livewire:chat-penjual-index
        :penjual-id="$penjual->id"
    />
@endsection