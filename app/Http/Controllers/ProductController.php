<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /** * Menampilkan daftar produk (Index)
     */
    public function index(): View
    {
        $products = Product::with('category')->when(request('search'), function ($query) {
            $query->where('nama', 'like', '%' . request('search') . '%')
                ->orWhereHas('category', function ($q) {
                    $q->where('nama', 'like', '%' . request('search') . '%');
                });
        })->paginate(10);

        return view('products.index', compact('products'));
    }

    /** * Menampilkan form tambah produk (Create)
     */
    public function create(): View
    {
        $categories = \App\Models\Category::all();
        return view('products.create', compact('categories'));
    }

    /** * Menyimpan produk baru (Store)
     */
    public function store(Request $request)
    {
        // Logika Validasi sudah benar sesuai Modul 6
        $request->merge([
            'harga' => str_replace(['.', ','], '', $request->harga) // Membersihkan input
        ]);

        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'kategori_id' => 'required|exists:categories,id',
        ]);

        // 1. Simpan File Foto ke Storage
        $fotoPath = $request->file('foto')->store('foto', 'public');

        // 2. Simpan Data ke Database
        Product::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    /** * Menampilkan form edit produk (Edit)
     */
    public function edit(Product $product): View
    {
        $product = \App\Models\Product::findOrFail($product->id);
        $categories = \App\Models\Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /** * Mengupdate produk (Update)
     */
    public function update(Request $request, Product $product)
    {
        $request->merge([
            'harga' => str_replace(['.', ','], '', $request->harga),
        ]);

        // 1. Validasi Data
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori_id' => 'required|exists:categories,id',
        ]);

        $data = $request->except('foto');

        // 2. Logika Update Foto (Menggunakan Storage Facade)
        if ($request->hasFile('foto')) {

            // Hapus foto lama jika ada
            if ($product->foto && Storage::disk('public')->exists($product->foto)) {
                Storage::disk('public')->delete($product->foto);
            }

            // Simpan foto baru, menggunakan folder 'foto'
            $data['foto'] = $request->file('foto')->store('foto', 'public');
        }

        // 3. Update Data Produk
        $product->update($data);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    /** * Menghapus produk (Destroy)
     */
    public function destroy(Product $product)
    {
        // 1. Logika Hapus File Foto (Menggunakan Storage Facade)
        if ($product->foto && Storage::disk('public')->exists($product->foto)) {
            Storage::disk('public')->delete($product->foto);
        }

        // 2. Hapus Data Produk
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}