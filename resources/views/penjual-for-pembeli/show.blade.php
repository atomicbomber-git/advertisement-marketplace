@extends("layouts.app-guest")

@section("content")
    <nav class="breadcrumb"
         aria-label="breadcrumbs"
    >
        <ul>
            <li>
                <a href="{{ route("home") }}">
                    Home
                </a>
            </li>
            <li class="is-active">
                <a href="#" >
                    {{ $penjual->nama }}
                </a>
            </li>
        </ul>
    </nav>

    <h1 class="title is-2">
        {{ $penjual->nama }}
    </h1>

    <p class="subtitle is-5">
        {{ $penjual->alamat }} <br>

        <span class="has-text-info has-text-weight-bold">
            <span class="icon">
                <i class="fas fa-phone"></i>
            </span>
            {{ $penjual->no_telepon }}
            ({{ $penjual->user->name }})
        </span>
    </p>
@endsection