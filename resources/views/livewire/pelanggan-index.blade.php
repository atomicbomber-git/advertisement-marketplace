<div>
    <h1 class="title"> Pelanggan </h1>

    <div class="select">
        <label for="terverifikasi">
            <select wire:model="terverifikasi" id="terverifikasi">
                @foreach($terverifikasiOptions AS $value => $label)
                    <option value="{{ $value }}">
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </label>
    </div>

    @include("components.messages")

    <div class="table-container my-5">
        <table class="table is-narrow is-fullwidth is-striped is-hoverable">
            <thead>
            <tr>
                <th> #</th>
                <th> Nama </th>
                <th> Nama Pengguna </th>
                <th> No. Telepon</th>
                <th class="has-text-centered"> Terverifikasi?</th>
                <th class="has-text-centered" style="width: 200px"> Kendali</th>
            </tr>
            </thead>

            <tbody>
            @foreach($pelanggans AS $pelanggan)
                <tr>
                    <td> {{ $pelanggans->firstItem() + $loop->index }} </td>
                    <td> {{ $pelanggan->user->name }} </td>
                    <td> {{ $pelanggan->user->username }} </td>
                    <td> {{ $pelanggan->no_telepon }} </td>
                    <td class="has-text-centered">
                        <span class="title is-5">
                            @if($pelanggan->terverifikasi)
                                <i class="has-text-success is-bold fas fa-check-circle"></i>
                            @else
                                <i class="has-text-danger is-bold fas fa-times-circle"></i>
                            @endif
                        </span>
                    </td>
                    <td class="has-text-centered">
                        <button
                                x-data="{}"
                                x-on:click="
                                window.confirmDialog()
                                    .then(response => {
                                        if (!response.value) {
                                            return
                                        }

                                        window.livewire.emit('toggleVerification', {{ $pelanggan->id }})
                                    })
                                "
                                class="button is-dark is-small">
                            @if($pelanggan->terverifikasi)
                                <span class="icon is-small">
                                    <i class="fas fa-times-circle"></i>
                                </span>
                                <span>
                                    Batal Verifikasi
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
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="d:f j-c:c">
        {{ $pelanggans->links() }}
    </div>
</div>
