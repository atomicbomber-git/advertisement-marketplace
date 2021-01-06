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
            <li>
                <a href="{{ route("penjual-for-pembeli.show", $penjual)  }}">
                    {{ $penjual->nama }}
                </a>
            </li>
            <li class="is-active">
                <a href="#">
                    Chat
                </a>
            </li>
        </ul>
    </nav>

    <h1 class="feature-title title"> Chat </h1>

    <div style="max-width: 600px">
        <div style="height: 400px; overflow-y: scroll; display: flex; flex-direction: column-reverse">
            <div class="box" wire:poll>
                @foreach ($chats as $index => $chat)
                    <div

                            style="
                                    display: flex;
                                    justify-content: {{ $chat->aligns_right ? "flex-end" : "flex-start" }};
                                    text-align: {{ $chat->aligns_right ? "right" : "left" }};
                                    "
                    >
                        <div
                                class="box has-background-light"
                                style="display: block; width: auto; margin: 10px 0 10px 0"
                        >
                            <h5 class="has-text-weight-bold"> {{ $chat->aligns_right ? $chat->penjual->user->name : $chat->pelanggan->user->name }} </h5>

                            {{ $chat->pesan }}
                        </div>
                    </div>

                    @if($chat->shows_time)
                        <div class="is-flex"
                             style="justify-content: flex-end"
                        >
                            <div>
                                {{ \App\Support\Formatter::humanDateTime($chat->created_at)  }}
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="box">
            <form wire:submit.prevent="submit">
                <div class="field">
                    <label class="label"
                           for="pesan"
                    >Pesan</label>
                    <div class="control @error('pesan') has-icons-right @enderror">
            <textarea
                    wire:model.lazy="pesan"
                    id="pesan"
                    name="pesan"
                    rows="5"
                    class="textarea @error('pesan') is-danger @enderror"
                    placeholder="Pesan"
            >{{ old("pesan") }}</textarea>
                        @error('pesan')
                        <span class="icon is-small is-right">
                <i class="fas fa-exclamation-triangle"></i>
            </span>
                        @enderror
                    </div>
                    @error('pesan')
                    <p class="help is-danger"> {{ $message }} </p>
                    @enderror
                </div>

                <div style="display: flex; justify-content: flex-end">
                    <button
                            class="button is-primary is-small"
                    >
                <span class="icon is-small">
                    <i class="fas fa-paper-plane"></i>
                </span>
                        <span>
                    Kirim
                </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
