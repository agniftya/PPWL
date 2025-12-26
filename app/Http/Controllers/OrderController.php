<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderProduct; // [cite: 285]

class OrderController extends Controller
{
    public function history()
    {
        // Untuk sementara kita ambil data kosong dulu agar tidak error
        $orders = OrderProduct::latest()->get(); // [cite: 290]
        return view('user.riwayat', compact('orders')); // [cite: 291]
    }
}