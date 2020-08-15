@extends("layouts.app")

@section("main")
    <section class="section columns">
        @include('components.sidebar')

        <article class="column">
            @yield("content")
        </article>
    </section>
@endsection