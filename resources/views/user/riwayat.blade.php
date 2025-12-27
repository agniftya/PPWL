@extends('layouts.user.app')

@section('title', 'Riwayat Pesanan')

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold m-0">Riwayat Pesanan</h2>
            <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">Lanjut Belanja</a>
        </div>

        @if($orders->isEmpty())
            <div class="card shadow-none border text-center p-5">
                <div class="card-body">
                    <i class='bx bx-cart-alt fs-1 text-muted mb-3'></i>
                    <h5 class="text-muted">Kamu belum pernah berbelanja nih.</h5>
                </div>
            </div>
        @else
            <div class="card shadow-sm border-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4">NO</th>
                                <th>NAMA PRODUK</th>
                                <th>TANGGAL</th>
                                <th>TOTAL</th>
                                <th>STATUS PEMBAYARAN</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $index => $order)
                                <tr>
                                    <td class="px-4">{{ $index + 1 }}</td>
                                    <td class="fw-semibold">{{ $order->product->nama ?? 'Produk' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($order->order->tanggal)->format('d M Y') }}</td>
                                    <td class="text-primary fw-bold">Rp {{ number_format($order->order->total, 0, ',', '.') }}</td>
                                    <td>
                                        {{-- LOGIKA STATUS BERWARNA --}}
                                        @if($order->order->status_pembayaran === 'pending')
                                            <span class="badge bg-label-danger">MENUNGGU PEMBAYARAN</span>
                                        @elseif($order->order->status_pembayaran === 'menunggu konfirmasi')
                                            <span class="badge bg-label-warning text-dark">SEDANG DIVERIFIKASI</span>
                                        @elseif($order->order->status_pembayaran === 'lunas')
                                            <span class="badge bg-label-success">LUNAS</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($order->order->status_pembayaran === 'pending')
                                            <a href="{{ route('checkout.sukses') }}" class="btn btn-primary btn-sm">Bayar Sekarang</a>
                                        @else
                                            <span class="text-muted small">No Action</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection