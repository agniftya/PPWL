@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            {{-- Card Selamat Datang --}}
            <div class="col-lg-8 mb-4 order-0">
                <div class="card h-100"> {{-- h-100 agar tinggi sama dengan kolom sebelah --}}
                    <div class="d-flex align-items-center row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Selamat datang admin website! 🎉</h5>
                                <p class="mb-4">
                                    Selamat bekerja, pantau terus statistik penjualan dan data pengguna TokoKu hari ini.
                                </p>
                                <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-primary">Lihat
                                    Data</a>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140"
                                    alt="Admin Illustration" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card Statistik (Data User & Sales) --}}
            <div class="col-lg-4 col-md-4 order-1">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body pb-3"> {{-- padding disesuaikan agar rapi --}}
                                <div class="card-title d-flex align-items-start justify-content-between mb-2">
                                    <div class="avatar flex-shrink-0">
                                        <span class="badge bg-label-success p-2">
                                            <i class="bx bx-user text-success"></i>
                                        </span>
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1 text-muted small">Data User</span>
                                <h5 class="card-title mb-2 text-nowrap">{{ \App\Models\User::count() }} User</h5>
                                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> Aktif</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body pb-3">
                                <div class="card-title d-flex align-items-start justify-content-between mb-2">
                                    <div class="avatar flex-shrink-0">
                                        <span class="badge bg-label-info p-2">
                                            <i class="bx bx-wallet text-info"></i>
                                        </span>
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1 text-muted small">Sales</span>
                                {{-- Gunakan h6 atau h5 agar Rp tidak keluar jalur --}}
                                <h5 class="card-title mb-2">Rp{{ number_format(4679000, 0, ',', '.') }}</h5>
                                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.4%</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection