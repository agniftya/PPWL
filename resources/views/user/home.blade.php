@extends('layouts.app')

@php
    use Illuminate\Support\Facades\Auth;
@endphp

@section('title', 'Toko Online - Produk Terbaru')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        
        {{-- Area Sambutan Sederhana & Navigasi Cepat --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                @auth
                                    {{-- TAMPILAN JIKA SUDAH LOGIN (USER atau ADMIN) --}}
                                    <h5 class="card-title text-primary">Halo, {{ Auth::user()->name }}! 👋</h5>
                                    
                                    <p class="mb-4">
                                        Selamat datang di halaman toko kami. Sebagai {{ Auth::user()->role }},
                                        Anda dapat mulai berbelanja.
                                        
                                        @if (Auth::user()->role === 'admin')
                                            {{-- Link ke Dashboard Admin --}}
                                            Silakan <a href="{{ route('dashboard') }}" class="fw-bold">klik di sini untuk menuju Dashboard User</a>.
                                        @endif
                                    </p>
                                    
                                    {{-- Link produk diarahkan ke daftar produk --}}
                                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-primary">Lihat Produk</a>

                                @else
                                    {{-- TAMPILAN JIKA BELUM LOGIN (GUEST) --}}
                                    <h5 class="card-title text-primary">Selamat Datang di Toko Kami!</h5>
                                    <p class="mb-4">
                                        Silakan **Login** untuk melakukan pemesanan atau Registrasi untuk membuat akun baru.
                                    </p>
                                    <a href="{{ route('login') }}" class="btn btn-sm btn-primary me-2">Login</a>
                                    <a href="{{ route('register') }}" class="btn btn-sm btn-outline-secondary">Registrasi</a>
                                @endauth
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="assets/img/illustrations/man-with-laptop-light.png" height="140"
                                    alt="Welcome Illustration" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection