@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    {{-- Breadcrumb dinamis --}}
    <x-breadcrumb :items="[
        'Produk' => route('products.index'),
        'Daftar Produk' => ''
    ]" />

    {{-- Tampilkan notifikasi jika ada --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <h5 class="mb-0">Daftar Produk</h5>
                {{-- Tombol Tambah Data - mengarah ke products.create --}}
                <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">
                    <i class="bx bx-plus"></i> Tambah Data
                </a>
            </div>
            
            <form action="{{ route('products.index') }}" method="GET" class="d-flex" style="width: 300px;">
                <input type="text" name="search"
                    class="form-control form-control me-2"
                    placeholder="Cari..."
                    value="{{ request('search') }}">
                <button class="btn btn-primary btn-sm" type="submit">
                    <i class="bx bx-search"></i>
                </button>
            </form>
        </div>
        
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                {{-- Nomor Urut --}}
                                <td>{{ $loop->iteration + ($products->currentPage()-1) * $products->perPage() }}</td>
                                
                                {{-- Foto Produk --}}
                                <td>
                                    @if($product->foto)
                                        <img src="{{ $product->foto
                                            ? asset('storage/'.$product->foto)
                                            : asset('assets/img/default-product.png') }}"
                                            alt="{{ $product->nama }}" class="img-thumbnail" width="80" />
                                    @endif
                                </td>
                                
                                {{-- Detail Produk --}}
                                <td>{{ $product->nama }}</td>
                                <td>{{ $product->kategori ? $product->kategori->nama : '-' }}</td>
                                <td>{{ Str::limit($product->deskripsi, 50) }}</td>
                                <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                                <td>{{ $product->stok }}</td>
                                
                                {{-- Actions --}}
                                <td>
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">
                                        <i class="bx bx-edit"></i>
                                    </a>
                                    
                                    {{-- Tombol Delete (dengan SweetAlert) --}}
                                    <form id="delete-form-{{ $product->id }}" 
                                        action="{{ route('products.destroy', $product->id) }}" 
                                        method="POST" 
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger"
                                            onclick="deleteConfirm('{{ $product->id}}', '{{ $product->nama }}')">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3 d-flex justify-content-center">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteConfirm(id, name) {
            Swal.fire({
                title: 'Yakin mau hapus produk ini?',
                text: "Anda akan menghapus produk: " + name + "!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        } 
    </script>
@endpush