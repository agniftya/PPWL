@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            {{-- Bagian Selamat Datang --}}
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Selamat datang di Panel Admin! 🎉</h5>
                                <p class="mb-4">
                                    Halo <strong>{{ Auth::user()->name }}</strong>, hari ini Anda bisa mengelola data
                                    produk,
                                    kategori, dan memantau transaksi masuk dengan lebih mudah.
                                </p>
                                <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-primary">Kelola
                                    Produk</a>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140"
                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bagian Statistik Singkat --}}
            <div class="col-lg-4 col-md-4 order-1">
                <div class="row">
                    {{-- Total Produk --}}
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('assets/img/icons/unicons/chart-success.png') }}" alt="Produk"
                                            class="rounded" />
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Total Produk</span>
                                <h3 class="card-title mb-2">{{ \App\Models\Product::count() }}</h3>
                                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> Aktif</small>
                            </div>
                        </div>
                    </div>
                    {{-- Total Kategori --}}
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{ asset('assets/img/icons/unicons/wallet-info.png') }}" alt="Kategori"
                                            class="rounded" />
                                    </div>
                                </div>
                                <span>Kategori</span>
                                <h3 class="card-title text-nowrap mb-1">{{ \App\Models\Category::count() }}</h3>
                                <small class="text-info fw-semibold"><i class="bx bx-show-alt"></i> Dilihat</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection