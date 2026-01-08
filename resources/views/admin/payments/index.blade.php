@extends('layouts.admin')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaksi</span>Pembayaran</h4>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <h5 class="card-header">Daftar Konfirmasi Pembayaran</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Pelanggan</th>
                            <th>Total Bayar</th>
                            <th>Bukti Transfer</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($orders as $order)
                            <tr>
                                <td>
                                    <span class="fw-bold">{{ $order->user->name }}</span>
                                </td>
                                <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                <td>
                                    @if($order->bukti_pembayaran)
                                        <a href="{{ route('admin.payments.show', $order->id) }}" target="_blank"
                                            class="btn btn-sm btn-outline-info">
                                            <i class="bx bx-show me-1"></i> Lihat Bukti
                                        </a>
                                    @else
                                        <span class="badge bg-label-secondary">Belum ada bukti</span>
                                    @endif
                                </td>
                                <td>
                                    @if($order->status_pembayaran == 'lunas')
                                        <span class="badge bg-label-success">Lunas</span>
                                    @elseif($order->bukti_pembayaran)
                                        <span class="badge bg-label-warning text-dark">Menunggu Konfirmasi</span>
                                    @else
                                        <span class="badge bg-label-danger">Belum Bayar</span>
                                    @endif
                                </td>

                                <td>
                                    @if($order->status_pembayaran == 'menunggu konfirmasi')
                                        <form action="{{ route('admin.payments.confirm', $order->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <i class="bx bx-check"></i> Konfirmasi
                                            </button>
                                        </form>
                                    @elseif($order->status_pembayaran == 'lunas')
                                        <small class="text-success">Diverifikasi</small>
                                    @else
                                        <small class="text-muted">-</small>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Belum ada data transaksi masuk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection