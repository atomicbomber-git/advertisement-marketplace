<aside class="menu column is-one-fifth">
    <p class="menu-label">
        Menu
    </p>
    <ul class="menu-list">
        <li>
            <a
                    href="{{ route("penjual.index") }}"
                    class="{{ \Illuminate\Support\Facades\Route::is("penjual.index") ? "is-active" : "" }}" >
                Penjual
            </a>
        </li>
    </ul>
</aside>