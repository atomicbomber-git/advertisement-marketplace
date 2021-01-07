<div>
    <h1 class="title is-1"> Percakapan </h1>

    @include("components.messages")

    <div>
        @if($this->pelanggans->isNotEmpty())
            <div class="table-responsive">
                <table class="table is-narrow is-fullwidth is-striped is-hoverable">
                    <thead>
                    <tr>
                        <th> #</th>
                        <th> Pelanggan</th>
                        <th> Kendali</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($this->pelanggans as $pelanggan)
                        <tr>
                            <td> {{ $this->pelanggans->firstItem() + $loop->index }} </td>
                            <td> {{ $pelanggan->user->name }} </td>
                            <td>
                                <a
                                        href="{{ route("chat-for-penjual.index", $pelanggan->id) }}"
                                        class="button is-primary is-small"
                                >
                                    <span class="icon is-small">
                                        <i class="fas fa-list-alt"></i>
                                    </span>
                                    <span>
                                        Chat
                                    </span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {{ $this->pelanggans->links() }}

        @else
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i>
                {{ __("messages.errors.no_data") }}
            </div>
        @endif
    </div>
</div>