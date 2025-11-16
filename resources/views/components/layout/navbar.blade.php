@php
    use Illuminate\Support\Facades\Auth;
@endphp

<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">

    {{-- Tombol Toggle Menu untuk layar kecil --}}
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <ul class="navbar-nav flex-row align-items-center ms-auto">

            {{-- LOGIKA JIKA PENGGUNA SUDAH LOGIN (@auth) --}}
            @auth
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    {{-- Dropdown Toggle: Hanya muncul jika ada user login --}}
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        {{-- Ganti path gambar dengan asset() --}}
                        <div class="avatar avatar-online">
                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt
                                                class="w-px-40 h-auto rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        {{-- Menampilkan nama dan role user yang sedang login --}}
                                        <span class="fw-semibold d-block">{{ Auth::user()->name ?? 'John Doe' }}</span>
                                        <small class="text-muted">{{ Auth::user()->role ?? 'User' }}</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            {{-- Link ke Profil --}}
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="bx bx-user me-2"></i>
                                <span class="align-middle">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bx bx-cog me-2"></i>
                                <span class="align-middle">Settings</span>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            {{-- Logika Logout menggunakan Form POST Laravel yang Aman --}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="bx bx-power-off me-2"></i>
                                    <span class="align-middle">Log Out</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
                {{-- AKHIR DARI @auth --}}

            @else
                {{-- LOGIKA JIKA PENGGUNA BELUM LOGIN (@guest) --}}
                <li class="nav-item me-2">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm">Registrasi</a>
                </li>
            @endauth

        </ul>
    </div>
</nav>