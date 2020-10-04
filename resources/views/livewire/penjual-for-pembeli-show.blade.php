<div>
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
                    {{ $this->penjual->nama }}
                </a>
            </li>
        </ul>
    </nav>

    <h1 class="title is-2">
        {{ $this->penjual->nama }}
    </h1>

    <p class="subtitle is-5">
        {{ $this->penjual->alamat }} <br>

        <span class="has-text-info has-text-weight-bold">
            <span class="icon">
                <i class="fas fa-phone"></i>
            </span>
            {{ $this->penjual->no_telepon }}
            ({{ $this->penjual->user->name }})
        </span>
    </p>

    <div class="my-3">
        <label for="search">
            <input
                    class="input"
                    wire:model="search"
                    placeholder="Cari produk..."
                    type="text">
        </label>
    </div>

    <div class="columns is-multiline">
        @forelse ($this->produks as $produk)
            <div class="column is-one-third">
                @include('components.produk-card', [
                    "produk" => $produk
                ])
            </div>
        @empty
            <div class="column">
                <div class="message is-info">
                    <div class="message-body">
                        Maaf, tidak terdapat produk dengan nama yang mengandung teks "{{ $search }}"
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <div class="d:f j-c:c">
        {{ $this->produks->links() }}
    </div>
</div>
