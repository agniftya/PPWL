@extends('layouts.user.app')

@section('title', 'TokoKu - Toko Online Terpercaya')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        {{-- Hero Section / Welcome Card --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card bg-primary text-white shadow-none border-0">
                    <div class="d-flex align-items-center row"> {{-- Diubah ke align-items-center agar lebih rapi --}}
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

        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Produk /</span> Terbaru</h4>

        <div class="row g-4"> {{-- Ditambah g-4 untuk jarak antar kartu yang konsisten --}}
            @forelse($products as $product)
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 shadow-sm border-0"> {{-- border-0 agar terlihat lebih modern --}}
                        {{-- Gambar Produk --}}
                        <div class="text-center p-3">
                            @if($product->foto)
                                <img class="card-img-top rounded shadow-sm" src="{{ asset('storage/' . $product->foto) }}"
                                    alt="{{ $product->nama }}" style="height: 180px; width: 100%; object-fit: cover;">
                            @else
                                <img class="card-img-top rounded shadow-sm" src="{{ asset('assets/img/elements/1.jpg') }}"
                                    alt="Default" style="height: 180px; width: 100%; object-fit: cover;">
                            @endif
                        </div>

                        <div class="card-body d-flex flex-column"> {{-- flex-column agar tombol selalu di bawah --}}
                            <h5 class="card-title fw-bold text-dark">{{ $product->nama }}</h5>
                            <p class="card-text text-primary fw-bold mb-2">
                                Rp {{ number_format($product->harga, 0, ',', '.') }}
                            </p>
                            <p class="card-text small text-muted text-truncate mb-3" style="max-height: 40px;">
                                {{ $product->deskripsi }}
                            </p>
                            <div class="d-grid gap-2 mt-auto"> {{-- mt-auto memaksa tombol ke dasar kartu --}}
                                <a href="{{ route('product.detail', $product->id) }}" <a
                                    href="{{ route('product.detail', $product->id) }}" class="btn btn-outline-primary btn-sm">
                                    Detail Produk
                                </a> <a href="#" class="btn btn-primary btn-sm">Beli Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="alert alert-secondary">Belum ada produk tersedia saat ini.</div>
                </div>
            @endforelse
        </div>
    </div>
@endsection