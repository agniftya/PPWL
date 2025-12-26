@extends('layouts.admin') 

@section('title', 'Daftar Produk') 

@section('content') 
<div class="container-xxl flex-grow-1 container-p-y"> 

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">Daftar Produk</li>
      </ol>
    </nav>
 
    <div class="card"> 
        <div class="card-header d-flex justify-content-between align-items-center"> 
            <div>
                <h5 class="mb-0">Daftar Produk Sepatu</h5> 
                <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm mt-2">
                    <i class="bx bx-plus"></i> Tambah Produk Baru
                </a>
            </div>

            <form action="{{ route('products.index') }}" method="GET" class="d-flex" style="width: 300px;"> 
                <input type="text" name="search"  
                    class="form-control me-2"  
                    placeholder="Cari sepatu..."  
                    value="{{ request('search') }}"> 
                <button class="btn btn-outline-primary btn-sm" type="submit"> 
                    <i class="bx bx-search"></i> 
                </button> 
            </form> 
        </div> 

        <div class="card-body"> 
            @if(session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive text-nowrap"> 
                <table class="table table-hover table-bordered"> 
                    <thead class="table-light"> 
                        <tr> 
                            <th>No</th> 
                            <th>Foto</th> 
                            <th>Nama Sepatu</th> 
                            <th>Kategori</th> 
                            <th>Harga</th> 
                            <th>Stok</th> 
                            <th>Actions</th> 
                        </tr> 
                    </thead> 
                    <tbody> 
                        @forelse ($products as $product) 
                        <tr> 
                            <td>{{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}</td> 
                            <td> 
                                @if($product->foto) 
                                    <img src="{{ asset('storage/' . $product->foto) }}"  
                                         alt="{{ $product->nama }}" class="rounded" width="60" height="60" style="object-fit: cover;" /> 
                                @else
                                    <img src="{{ asset('assets/img/elements/1.jpg') }}" class="rounded" width="60" height="60" />
                                @endif 
                            </td> 
                            <td class="fw-bold">{{ $product->nama }}</td> 
                            <td>
                                <span class="badge bg-label-info">
                                    {{ $product->category ? $product->category->nama : 'Tanpa Kategori' }}
                                </span>
                            </td> 
                            <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td> 
                            <td>
                                @if($product->stok <= 5)
                                    <span class="text-danger fw-bold">{{ $product->stok }} (Limit)</span>
                                @else
                                    {{ $product->stok }}
                                @endif
                            </td> 
                            <td> 
                                <div class="d-flex">
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-icon btn-primary me-2"> 
                                        <i class="bx bx-edit"></i> 
                                    </a> 
     
                                    <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST"> 
                                        @csrf 
                                        @method('DELETE') 
                                        <button type="button" class="btn btn-sm btn-icon btn-danger" 
                                            onclick="deleteConfirm('{{ $product->id }}', '{{ $product->nama }}')"> 
                                            <i class="bx bx-trash"></i> 
                                        </button> 
                                    </form> 
                                </div>
                            </td> 
                        </tr> 
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Data produk sepatu tidak ditemukan.</td>
                        </tr>
                        @endforelse 
                    </tbody> 
                </table> 
            </div> 

            <div class="mt-4 d-flex justify-content-center"> 
                {{ $products->appends(['search' => request('search')])->links('pagination::bootstrap-5') }} 
            </div> 
        </div> 
    </div> 
</div> 
@endsection 

@push('scripts') 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<script> 
function deleteConfirm(id, nama) { 
    Swal.fire({ 
        title: 'Hapus Sepatu?', 
        text: "Kamu akan menghapus " + nama + ". Data ini tidak bisa balik lagi!", 
        icon: 'warning', 
        showCancelButton: true, 
        confirmButtonColor: '#ff3e1d', 
        cancelButtonColor: '#8592a3', 
        confirmButtonText: 'Ya, Hapus Saja!', 
        cancelButtonText: 'Batal' 
    }).then((result) => { 
        if (result.isConfirmed) { 
            document.getElementById('delete-form-' + id).submit(); 
        } 
    }); 
} 
</script> 
@endpush