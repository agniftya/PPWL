<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link" style="text-decoration: none;">
            <span class="fw-bold fs-3 text-primary">TokoKu</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">MASTER</span>
        </li>

        <li class="menu-item {{ request()->is('products*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="Layouts">Katalog Produk</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('products.create') ? 'active' : '' }}">
                    <a href="{{ route('products.create') }}" class="menu-link">
                        <div>Tambah Data</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">TRANSAKSI</span>
        </li>

        <li class="menu-item">
            <a href="#" class="menu-link"> <i class="menu-icon tf-icons bx bx-list-ul"></i>
                <div>Daftar Pesanan</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon tf-icons bx bx-credit-card"></i>
                <div data-i18n="Basic">Pembayaran</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Lainnya</span>
        </li>

        <li class="menu-item">
            <a href="{{ route('home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-world"></i>
                <div data-i18n="Basic">Lihat Toko</div>
            </a>
        </li>
    </ul>
</aside>