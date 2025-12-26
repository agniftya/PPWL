<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\OrderProduct;
class OrderController extends Controller
{
    public function history()
    {
        // Mengambil data order_products milik user yang sedang login
        $orders = \App\Models\OrderProduct::with('product', 'order')
            ->whereHas('order', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->latest()
            ->get();

        // Pastikan mengarah ke user.riwayat
        return view('user.riwayat', compact('orders'));
    }

    // Menampilkan daftar semua pesanan untuk Admin
    public function adminIndex()
    {
        // Mengambil semua data order beserta data usernya
        $orders = \App\Models\Order::with('user')->latest()->get();

        // Mengarah ke file resources/views/admin/payments/index.blade.php
        return view('admin.payments.index', compact('orders'));
    }

    // Fungsi untuk konfirmasi pembayaran dari Admin
    public function confirmPayment($id)
    {
        $order = \App\Models\Order::findOrFail($id);
        $order->update(['status_pembayaran' => 'lunas']);

        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }
}