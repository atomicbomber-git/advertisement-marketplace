@if ($paginator->hasPages())
    <nav class="pagination is-centered" role="navigation" aria-label="pagination">

        <ul class="pagination-list">

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="pagination-ellipsis">&hellip;</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <button wire:click="gotoPage({{ $page }})" class="pagination-link is-current" aria-label="Page {{ $page }}"
                                   aria-current="page">{{ $page }}</button>
                            </li>
                        @else
                            <li>
                                <button wire:click="gotoPage({{ $page }})" class="pagination-link"
                                   aria-label="Goto page {{ $page }}">{{ $page }}</button>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </ul>
    </nav>
@endif
