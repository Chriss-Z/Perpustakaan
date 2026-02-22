<nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">
    <div class="container">

        {{-- Toggle Mobile --}}
        <button class="navbar-toggler border-0 shadow-none"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">

            {{-- Menu --}}
            <ul class="navbar-nav me-auto gap-lg-3">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('books.*') ? 'active fw-semibold text-dark' : 'text-muted' }}"
                        href="{{ route('books.index') }}">
                        Buku
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('transactions.*') ? 'active fw-semibold text-dark' : 'text-muted' }}"
                        href="{{ route('transactions.index') }}">
                        Transaksi
                    </a>
                </li>

                @if (Auth::user()->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('users.*') ? 'active fw-semibold text-dark' : 'text-muted' }}"
                        href="{{ route('users.index') }}">
                        Kelola Anggota
                    </a>
                </li>
                @endif

            </ul>

            {{-- User Info --}}
            <div class="d-flex align-items-center gap-4">

                <div class="text-end d-none d-lg-block">
                    <div class="fw-semibold small">
                        {{ Auth::user()->name }}
                    </div>
                    <div class="text-muted small">
                        {{ Auth::user()->role == 'admin' 
                            ? 'Administrator' 
                            : Auth::user()->major . ' - ' . Auth::user()->class }}
                    </div>
                </div>

                {{-- Logout --}}
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="btn btn-outline-dark btn-sm rounded-pill px-3">
                        Logout
                    </button>
                </form>

            </div>
        </div>
    </div>
</nav>