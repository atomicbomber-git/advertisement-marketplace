<div>
    <h1 class="title is-1">
        Kategori Produk
    </h1>

    @include("components.messages")

    <div class="my-2 has-text-right">
        <a href="{{ route("kategori-produk.create") }}"
           class="button is-info"
        >
            <span> Tambah </span>
            <span class="icon is-small">
                <i class="fas fa-plus"></i>
            </span>
        </a>
    </div>

    <div>
        @if($kategori_produks->isNotEmpty())
            <div class="table-container my-5">
                <table class="table is-narrow is-fullwidth is-striped is-hoverable">
                    <thead>
                    <tr>
                        <th> # </th>
                        <td> Nama </td>
                        <td class="has-text-centered"> Kendali </td>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($kategori_produks as $kategori_produk)
                        <tr>
                            <td> {{ $kategori_produks->firstItem() + $loop->index }} </td>
                            <td> {{ $kategori_produk->nama }} </td>
                            <td class="has-text-centered">
                                <a href="{{ route("kategori-produk.edit", $kategori_produk)  }}"
                                   class="button is-info is-small"
                                >
                                    <span class="icon is-small">
                                        <i class="fas fa-pencil-alt"></i>
                                    </span>
                                    <span>
                                        Ubah
                                    </span>
                                </a>

                                <button
                                        x-data="{}"
                                        x-on:click="
                                        confirmDialog()
                                            .then(response => {
                                                if (!response.value) { return }
                                                window.livewire.emit('kategori-produk:delete', {{ $kategori_produk->id }})
                                            })
                                    "
                                        class="button is-danger is-small"
                                >
                                <span class="icon is-small">
                                    <i class="fas fa-trash"></i>
                                </span>
                                <span>
                                    Hapus
                                </span>
                            </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $kategori_produks->links() }}
            </div>

        @else
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i>
                {{ __("messages.errors.no_data") }}
            </div>
        @endif
    </div>
</div>
