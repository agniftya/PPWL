@extends('layouts.user.app') {{-- Pastikan ini mengarah ke layout khusus user/landing page --}}

@section('title', 'TokoKu - Toko Online Terpercaya')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row mb-4">
            <div class="col-12">
                <div class="card bg-primary text-white shadow-none border-0">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-white">Selamat Datang di TokoKu! 🛍️</h5>
                                <p class="mb-4">
                                    Temukan berbagai produk berkualitas dengan harga terbaik.
                                    @guest
                                        Silahkan <strong>Login</strong> untuk mulai berbelanja.
                                    @else
                                        Halo <strong>{{ Auth::user()->name }}</strong>, selamat berbelanja!
                                    @endguest
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140"
                                    alt="Illustration" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Produk /</span> Terbaru</h4>

        <div class="row">
            @forelse($products as $product)
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        {{-- Gambar Produk dari database --}}
                        <div class="text-center p-3">
                            @if($product->foto)
                                <img class="card-img-top rounded" src="{{ asset('storage/' . $product->foto) }}"
                                    alt="{{ $product->nama }}" style="height: 180px; object-fit: cover;">
                            @else
                                <img class="card-img-top rounded" src="{{ asset('assets/img/elements/1.jpg') }}" alt="Default"
                                    style="height: 180px; object-fit: cover;">
                            @endif
                        </div>

                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $product->nama }}</h5>
                            <p class="card-text text-primary fw-bold">
                                Rp {{ number_format($product->harga, 0, ',', '.') }}
                            </p>
                            <p class="card-text small text-muted text-truncate">
                                {{ $product->deskripsi }}
                            </p>
                            <div class="d-grid gap-2 mt-3">
                                <a href="#" class="btn btn-primary btn-sm">Beli Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="alert alert-secondary">Belum ada produk tersedia.</div>
                </div>
            @endforelse
        </div>
    </div>
@endsection