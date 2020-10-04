<div>
    <h1 class="title is-1"> Produk </h1>

    @include("components.messages")

    <div class="my-2 has-text-right">
        <a href="{{ route("penjual.produk-for-penjual.create", $this->penjual) }}"
           class="button is-info"
        >
            <span> Tambah </span>
            <span class="icon is-small">
                <i class="fas fa-plus"></i>
            </span>
        </a>
    </div>

    <div class="my-3">
        <label for="search">
            <input
                    wire:model="search"
                    id="search"
                    type="search"
                    class="input"
                    placeholder="Search..."
            >
        </label>
    </div>

    <div class="table-container my-5">
        <table class="table is-narrow is-fullwidth is-striped is-hoverable">
            <thead>
            <tr>
                <th> #</th>
                <th> Nama </th>
                <th> Kategori </th>
                <th> Deskripsi</th>
                <th class="has-text-right"> Harga</th>
                <th class="has-text-centered"
                    style="width: 200px"
                > Kendali
                </th>
            </tr>
            </thead>

            <tbody>
            @foreach($this->produks AS $produk)
                <tr>
                    <td> {{ $this->produks->firstItem() + $loop->index }} </td>
                    <td> {{ $produk->nama }} </td>
                    <td> {{ $produk->kategori_produk->nama ?? "-" }} </td>
                    <td> {{ $produk->deskripsi }} </td>
                    <td class="has-text-right"> {{ Facades\App\Support\Formatter::currency($produk->harga) }} </td>
                    <td class="has-text-centered">
                        <button
                                x-data="{}"
                                x-on:click="
                                window.confirmDialog()
                                    .then(response => {
                                        if (!response.value) {
                                            return
                                        }

                                        window.livewire.emit('delete', {{ $produk->id }})
                                    })
                            "
                                class="button is-danger is-small"
                                type="button"
                        >
                            <span class="icon is-small">
                                <i class="fas fa-trash  "></i>
                            </span>
                            <span> Hapus </span>
                        </button>

                        <a href="{{ route("produk-for-penjual.edit", $produk) }}"
                           class="button is-info is-small"
                        >
                            <span class="icon is-small">
                                <i class="fas fa-pencil-alt"></i>
                            </span>
                            <span>
                                Ubah
                            </span>
                        </a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{ $this->produks->links() }}
</div>
