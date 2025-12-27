<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary fs-3" href="/">TokoKu</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>

                {{-- --- TAMBAHKAN IKON KERANJANG DI SINI --- --}}
                <li class="nav-item ms-lg-3">
                    <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                        <i class="bx bx-cart fs-4"></i>
                        @if(session('cart') && count(session('cart')) > 0)
                            <span class="badge rounded-pill bg-danger position-absolute top-0 start-100 translate-middle"
                                style="font-size: 0.6rem; padding: 0.35em 0.5em;">
                                {{ count(session('cart')) }}
                            </span>
                        @endif
                    </a>
                </li>
                {{-- --------------------------------------- --}}

                @auth
                    @if(Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="btn btn-warning btn-sm ms-lg-3" href="{{ route('dashboard') }}">
                                <i class="bx bx-grid-alt"></i> Panel Admin
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>

            <div class="ms-lg-3 d-flex gap-2 align-items-center">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                @else
                    <span class="navbar-text me-3">Halo, {{ Auth::user()->name }}</span>

                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                @endguest
            </div>
        </div>
    </div>
</nav>