<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\OrderProduct;
use App\Models\Order;
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
        // Ini akan memaksa status jadi lunas, tidak peduli sebelumnya apa
        $order->update(['status_pembayaran' => 'lunas']);

        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }
    public function showPayment($id) // Gunakan $id agar lebih aman
    {
        $order = Order::findOrFail($id);

        // Cek apakah file benar-benar ada di storage
        $path = storage_path('app/public/payment/' . $order->bukti_pembayaran);

        if (!file_exists($path)) {
            return redirect()->back()->with('error', 'File gambar tidak ditemukan di server.');
        }

        return response()->file($path); // Menampilkan gambar langsung di browser
    }
}