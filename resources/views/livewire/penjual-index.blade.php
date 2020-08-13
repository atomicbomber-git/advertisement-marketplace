<div>
    <h1 class="title"> Penjual </h1>

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
                <th> Nama Penjual </th>
                <th> Nama Admin </th>
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
                    <td> {{ $penjual->nama }} </td>
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
</div>
