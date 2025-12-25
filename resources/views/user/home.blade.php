@extends('layouts.user.app') {{-- Pastikan mengarah ke layout user, bukan layout admin --}}

@php
    use Illuminate\Support\Facades\Auth;
@endphp

@section('title', 'Toko Online - Produk Terbaru')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    
    {{-- 1. Hero Section (Sambutan) --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-primary text-white">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            @auth
                                <h5 class="card-title text-white">Halo, {{ Auth::user()->name }}! 👋</h5>
                                <p class="mb-4">
                                    Selamat datang kembali. Anda masuk sebagai <strong>{{ Auth::user()->role }}</strong>.
                                    Silahkan jelajahi produk unggulan kami dan mulailah berbelanja.
                                </p>
                                @if (Auth::user()->role === 'admin')
                                    <a href="{{ route('dashboard') }}" class="btn btn-sm btn-warning">Kembali ke Dashboard Admin</a>
                                @endif
                            @else
                                <h5 class="card-title text-white">Selamat Datang di TokoKu!</h5>
                                <p class="mb-4">
                                    Temukan berbagai produk berkualitas dengan harga terbaik. 
                                    Silahkan <strong>Login</strong> untuk melakukan pemesanan.
                                </p>
                                <a href="{{ route('login') }}" class="btn btn-sm btn-light me-2">Login</a>
                                <a href="{{ route('register') }}" class="btn btn-sm btn-outline-light">Registrasi</a>
                            @endauth
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140" alt="Welcome Illustration" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. Daftar Produk (Sesuai Modul 9) --}}
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Produk /</span> Terbaru</h4>
    
    <div class="row">
        @forelse($products as $product)
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    {{-- Menampilkan Foto Produk dari Storage --}}
                    <div class="text-center p-3">
                        @if($product->foto)
                            <img class="card-img-top rounded" src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nama }}" style="height: 180px; object-fit: cover;">
                        @else
                            <img class="card-img-top rounded" src="{{ asset('assets/img/elements/1.jpg') }}" alt="Default Image" style="height: 180px; object-fit: cover;">
                        @endif
                    </div>
                    
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-1">{{ $product->nama }}</h5>
                        <p class="card-text text-primary fw-bold mb-2">
                            Rp {{ number_format($product->harga, 0, ',', '.') }}
                        </p>
                        <p class="card-text small text-muted text-truncate">
                            {{ $product->deskripsi ?? 'Tidak ada deskripsi produk.' }}
                        </p>
                        
                        <div class="d-grid gap-2 mt-3">
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary btn-sm">
                                <i class="bx bx-show me-1"></i> Detail Produk
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="alert alert-secondary">
                    <i class="bx bx-info-circle me-1"></i> Belum ada produk yang tersedia saat ini.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection