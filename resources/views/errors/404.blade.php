@extends("layouts.app-guest")

@section("content")
    <div class="message is-danger">
        <div class="message-body">
            {{ __("messages.errors.404") }}
        </div>
    </div>
@endsection
