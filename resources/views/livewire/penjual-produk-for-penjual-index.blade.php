<div>
    <h1 class="title is-1"> Produk </h1>

    @include("components.messages")

    <div class="table-container my-5">
        <table class="table is-narrow is-fullwidth is-striped is-hoverable">
            <thead>
            <tr>
                <th> #</th>
                <th> Nama </th>
                <th> Deskripsi </th>
                <th> Harga </th>
                <th> Kendali </th>
            </tr>
            </thead>

            <tbody>
            @foreach($this->produks AS $produk)
                <tr>
                    <td> {{ $this->produks->firstItem() + $loop->index }} </td>
                    <td> {{ $produk->nama }} </td>
                    <td> {{ $produk->deskripsi }} </td>
                    <td> {{ $produk->harga }} </td>
                    <td>
                        <button class="button is-danger is-small" type="button">
                            <span class="icon is-small">
                                <i class="fas fa-trash  "></i>
                            </span>
                            <span> Hapus </span>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{ $this->produks->links() }}


</div>
