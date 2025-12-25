@extends('layouts.admin') {{-- Menghubungkan ke Master Layout Sneat --}}

@section('title', 'Admin Dashboard')

@section('content')
    <div class="row">
        {{-- Card Selamat Datang (Sesuai Modul 4 & 10) --}}
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Selamat datang di Panel Admin! 🎉</h5>
                            <p class="mb-4">
                                Halo <strong>{{ Auth::user()->name }}</strong>, kelola produk dan kategori TokoKu di sini.
                            </p>
                            <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-primary">Kelola Produk</a>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140"
                                alt="Admin Illustration" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card Statistik (Sesuai Modul 5 & 6) --}}
        <div class="col-lg-4 col-md-4">
            <div class="row">
                <div class="col-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <span class="fw-semibold d-block mb-1">Total Produk</span>
                            <h3 class="card-title mb-2">{{ \App\Models\Product::count() }}</h3>
                            <small class="text-success fw-semibold">Aktif</small>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <span class="fw-semibold d-block mb-1">Kategori</span>
                            <h3 class="card-title mb-2">{{ \App\Models\Category::count() }}</h3>
                            <small class="text-info fw-semibold">Tersedia</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection