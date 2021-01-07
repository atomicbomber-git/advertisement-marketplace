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

    <div style="max-width: 800px">
        @if($chats->isEmpty())
            <article class="message">
                <div class="message-body">
                    Belum terdapat pesan sama sekali.
                </div>
            </article>
        @endif

        @if($chats->isNotEmpty())
            <div style="height: 400px; overflow-y: scroll; display: flex; flex-direction: column-reverse">
                <div class="box"
                     wire:poll
                >
                    @foreach ($chats as $index => $chat)
                        <div
                                style="
                                        display: flex;
                                        justify-content: {{ !$chat->pesan_dari_pelanggan ? "flex-end" : "flex-start" }};
                                        text-align: {{ !$chat->pesan_dari_pelanggan ? "right" : "left" }};
                                        "
                        >
                            <div
                                    class="box {{ !$chat->pesan_dari_pelanggan ? 'has-background-light' : 'has-background-primary' }}"
                                    style="display: block; width: auto"


                            >
                                @if($chat->shows_name)
                                    <h5 class="has-text-weight-bold"> {{ !$chat->pesan_dari_pelanggan ? "Anda" : $chat->pelanggan->user->name }} </h5>
                                @endif

                                {{ $chat->pesan }}
                            </div>
                        </div>

                        @if($chat->shows_time)
                            <div class="is-flex"
                                 style="justify-content: {{ !$chat->pesan_dari_pelanggan ? "flex-end" : "flex-start" }}; margin-top: 10px"
                            >
                                <div>
                                    {{ \App\Support\Formatter::humanDateTime($chat->created_at)  }}
                                </div>
                            </div>
                        @endif

                        <div style="height: {{ $chat->shows_time ? '20px' : '0' }}">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="box"
             style="margin-top: 10px"
        >
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
