@extends('layouts.user.app')

@section('title', 'TokoKu - Toko Online Terpercaya')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        {{-- 1. Hero Section / Welcome Card --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card bg-primary text-white shadow-none border-0">
                    <div class="d-flex align-items-center row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h4 class="card-title text-white">Selamat Datang di TokoKu! 🛍️</h4>
                                <p class="mb-4">
                                    Temukan berbagai produk berkualitas dengan harga terbaik.
                                    @guest
                                        <br>Silahkan <strong>Login</strong> untuk mulai berbelanja.
                                    @else
                                        <br>Halo <strong>{{ Auth::user()->name }}</strong>, selamat berbelanja!
                                    @endguest
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140"
                                    alt="Illustration" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. Navigasi Cepat (Tabs/Pills) --}}
        <div class="mb-4">
            <h5 class="fw-bold mb-3">Cari Kategori:</h5>
            <div class="d-flex gap-2 overflow-auto pb-2">
                {{-- Tombol Semua --}}
                <a href="#" class="btn btn-primary btn-sm text-nowrap">Semua</a>
                
                {{-- Looping Tombol Kategori --}}
                @foreach($categories as $category)
                    @if($category->products->count() > 0)
                        <a href="#cat-{{ $category->id }}" class="btn btn-outline-primary btn-sm text-nowrap">
                            {{ $category->nama }}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>

        {{-- 3. Daftar Produk Per Kategori --}}
        @php $hasAnyProduct = false; @endphp
        @foreach($categories as $category)
            @if($category->products->count() > 0)
                @php $hasAnyProduct = true; @endphp
                <div id="cat-{{ $category->id }}" class="category-block pt-4 mb-5">
                    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                        <h4 class="fw-bold text-dark m-0">
                            <span class="text-muted fw-light">Kategori /</span> {{ $category->nama }}
                        </h4>
                        <span class="badge bg-label-primary rounded-pill">{{ $category->products->count() }} Produk</span>
                    </div>

                    <div class="row g-4">
                        @foreach($category->products as $product)
                            <div class="col-md-6 col-lg-3">
                                <div class="card h-100 shadow-sm border-0">
                                    {{-- Gambar Produk --}}
                                    <div class="text-center p-3 position-relative">
                                        @if($product->foto)
                                            <img class="card-img-top rounded shadow-sm" src="{{ asset('storage/' . $product->foto) }}"
                                                alt="{{ $product->nama }}" style="height: 180px; width: 100%; object-fit: cover;">
                                        @else
                                            <img class="card-img-top rounded shadow-sm" src="{{ asset('assets/img/elements/1.jpg') }}"
                                                alt="Default" style="height: 180px; width: 100%; object-fit: cover;">
                                        @endif
                                        
                                        @if($product->stok <= 5)
                                            <span class="badge bg-danger position-absolute top-0 end-0 m-3">Stok Terbatas!</span>
                                        @endif
                                    </div>

                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title fw-bold text-dark mb-1">{{ $product->nama }}</h5>
                                        <p class="card-text text-primary fw-bold mb-2">
                                            Rp {{ number_format($product->harga, 0, ',', '.') }}
                                        </p>
                                        <p class="card-text small text-muted text-truncate mb-3" style="max-height: 40px;">
                                            {{ $product->deskripsi }}
                                        </p>
                                        <div class="d-grid gap-2 mt-auto">
                                            <a href="{{ route('product.detail', $product->id) }}"
                                                class="btn btn-outline-primary btn-sm">Detail Produk</a>
                                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-grid">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    <i class='bx bx-cart-add'></i> Beli Sekarang
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach

        {{-- 4. Tampilan jika tidak ada produk sama sekali --}}
        @if(!$hasAnyProduct)
            <div class="col-12 text-center py-5 mt-4">
                <div class="card p-5 border-0 shadow-sm">
                    <div class="card-body">
                        <i class='bx bx-package fs-1 text-muted mb-3'></i>
                        <h5 class="text-muted">Belum ada produk tersedia saat ini.</h5>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection