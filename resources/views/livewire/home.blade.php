<div>
    <!-- Main container -->
    <nav class="box columns m:0">
        <div class="column is-narrow is-flex" style="align-items: center">
            <label for="kategori_produk_id"
                   class="label mr-2"
            >
                Kategori
            </label>

            <div class="select">
                <select wire:model.lazy="kategori_produk_id"
                        id="kategori_produk_id"
                >
                    <option value="{{ \App\Http\Livewire\Home::ALL_KATEGORI_PRODUK_ID  }}">
                        ---- Semua ----
                    </option>

                    @foreach ($kategori_produks as $kategori_produk)
                        <option value="{{ $kategori_produk->id }}">
                            {{ $kategori_produk->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="column is-flex" style="justify-content: flex-end; align-items: center">
            <label class="label mr-2"
                   for="filter"
            >Filter</label>
            <div class="control @error('filter') has-icons-right @enderror" style="flex: 1">
                <input id="filter"
                       wire:model.debounce.500ms="filter"
                       class="input @error('filter') is-danger @enderror"
                       type="text"
                       placeholder="Filter"
                       value="{{ old("filter")  }}"
                >
                @error('filter')
                <span class="icon is-small is-right">
                                <i class="fas fa-exclamation-triangle"></i>
                            </span>
                @enderror
            </div>
        </div>
    </nav>

    <article class="message is-info">
        <div class="message-body">
            Menampilkan seluruh produk
            @if($current_kategori_produk)
                dengan kategori <strong> {{ $current_kategori_produk->nama }} </strong>
            @endif
        </div>
    </article>

    <div class="columns is-multiline">
        @foreach($produks as $produk)
            <div class="column is-one-quarter">
                @include('components.produk-card', [
                    "produk" => $produk
                ])
            </div>
        @endforeach
    </div>

    <div class="my-3"
         style="width: 100%; display: flex; justify-content: center"
    >
        {{ $produks->links() }}
    </div>
</div>
