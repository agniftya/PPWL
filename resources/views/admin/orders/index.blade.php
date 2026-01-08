@extends('layouts.admin')

@section('content')
<div class="card">
    <h5 class="card-header">Daftar Semua Pesanan Pelanggan</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID Order</th>
                    <th>Pelanggan</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->user->name ?? 'User Terhapus' }}</td>
                    <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge bg-label-{{ $order->status_pembayaran == 'lunas' ? 'success' : 'warning' }}">
                            {{ strtoupper($order->status_pembayaran) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.payments.show', $order->id) }}" class="btn btn-sm btn-info">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4">Belum ada pesanan masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection