@extends('layouts.admin')

@section('title', 'Daftar Kategori')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- Breadcrumb agar sesuai desain --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Daftar Kategori</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Manajemen Kategori Sepatu</h5>
                <a href="{{ route('category.create') }}" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i> Tambah Kategori
                </a>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-primary alert-dismissible" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($categories as $cat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($product->category)
                                            <span class="badge bg-label-info">{{ $product->category->nama }}</span>
                                        @else
                                            <span class="badge bg-label-danger">Tanpa Kategori</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('category.edit', $cat->id) }}"
                                                class="btn btn-sm btn-outline-primary me-2">
                                                <i class="bx bx-edit-alt"></i> Edit
                                            </a>

                                            <form id="delete-form-{{ $cat->id }}"
                                                action="{{ route('category.destroy', $cat->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    onclick="deleteConfirm('{{ $cat->id }}', '{{ $cat->nama }}')">
                                                    <i class="bx bx-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Belum ada kategori.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $categories->links('pagination::bootstrap-5') }}
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
                title: 'Hapus Kategori?',
                text: "Kategori " + nama + " akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#696cff',
                cancelButtonColor: '#8592a3',
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