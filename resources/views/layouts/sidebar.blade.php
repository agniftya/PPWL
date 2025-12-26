<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link" style="text-decoration: none;">
            <span class="fw-bold fs-3" style="letter-spacing: 1px;">
                <span style="color: #696cff;">Toko</span><span style="color: #233446;">Ku</span>
            </span>
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
                <div data-i18n="Katalog Produk">Katalog Produk</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('products.index') ? 'active' : '' }}">
                    <a href="{{ route('products.index') }}" class="menu-link">
                        <div data-i18n="Daftar Produk">Daftar Produk</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('products.create') ? 'active' : '' }}">
                    <a href="{{ route('products.create') }}" class="menu-link">
                        <div data-i18n="Tambah Produk">Tambah Produk</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item {{ request()->is('category*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div data-i18n="Kategori">Kategori</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('category.index') ? 'active' : '' }}">
                    <a href="{{ route('category.index') }}" class="menu-link">
                        <div data-i18n="Daftar Kategori">Daftar Kategori</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('category.create') ? 'active' : '' }}">
                    <a href="{{ route('category.create') }}" class="menu-link">
                        <div data-i18n="Tambah Kategori">Tambah Kategori</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">TRANSAKSI</span>
        </li>

        <li class="menu-item {{ request()->routeIs('orders.history') ? 'active' : '' }}">
            <a href="{{ route('orders.history') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-list-ul"></i>
                <div data-i18n="Daftar Pesanan">Daftar Pesanan</div>
            </a>
        </li>

        <li class="menu-item {{ request()->is('admin/payments*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-credit-card"></i>
                <div data-i18n="Pembayaran">Pembayaran</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.payments.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.payments.index') }}" class="menu-link">
                        <div data-i18n="Konfirmasi Pembayaran">Konfirmasi Pembayaran</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">LAINNYA</span>
        </li>

        <li class="menu-item">
            <a href="{{ route('home') }}" class="menu-link" target="_blank">
                <i class="menu-icon tf-icons bx bx-world"></i>
                <div data-i18n="Lihat Toko">Lihat Toko (Landing Page)</div>
            </a>
        </li>
    </ul>
</aside>