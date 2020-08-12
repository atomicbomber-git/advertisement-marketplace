<div>
    <h1 class="title"> Penjual </h1>

    <div class="table-container">
        <table class="table is-narrow is-fullwidth is-striped is-hoverable">
            <thead>
            <tr>
                <th> #</th>
                <th> Nama</th>
                <th> No. Telepon</th>
                <th> Alamat</th>
                <th class="has-text-centered"> Terverifikasi?</th>
                <th class="has-text-centered" style="width: 200px"> Kendali</th>
            </tr>
            </thead>

            <tbody>
            @foreach($penjuals AS $penjual)
                <tr>
                    <td> {{ $penjuals->firstItem() + $loop->index }} </td>
                    <td> {{ $penjual->user->name }} </td>
                    <td> {{ $penjual->no_telepon }} </td>
                    <td> {{ $penjual->alamat }} </td>
                    <td class="has-text-centered">
                        <span class="title is-5">
                            @if($penjual->terverifikasi)
                                <i class="has-text-success is-bold fas fa-check-circle"></i>
                            @else
                                <i class="has-text-danger is-bold fas fa-times-circle"></i>
                            @endif
                        </span>
                    </td>
                    <td class="has-text-centered">
                        <button wire:click="toggleVerification({{ $penjual->id }})" class="button is-dark is-small">
                            @if($penjual->terverifikasi)
                                <span class="icon is-small">
                                    <i class="fas fa-times-circle"></i>
                                </span>
                                <span>
                                    Btl. Verifikasi
                                </span>
                            @else
                                <span class="icon is-small">
                                    <i class="fas fa-check-circle"></i>
                                </span>
                                <span>
                                    Verifikasi
                                </span>
                            @endif
                        </button>

                        <a class="button is-primary is-small"
                           href="{{ route("penjual.edit", $penjual) }}"
                        >
                            Edit
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
