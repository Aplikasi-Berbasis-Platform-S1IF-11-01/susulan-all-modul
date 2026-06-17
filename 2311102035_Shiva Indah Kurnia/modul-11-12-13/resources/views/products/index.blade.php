@extends('layouts.app')
@section('content')
<div class="card card-girly p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 style="color: #ff1493;">🛍️ Daftar Produk Tersedia</h4>
        <a href="{{ route('products.create') }}" class="btn btn-pink">+ Tambah Produk</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success rounded-pill">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover table-pink align-middle">
            <thead>
                <tr>
                    <th>No</th><th>Nama Produk</th><th>Deskripsi</th><th>Stok</th><th>Harga</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->nama_produk }}</td>
                    <td>{{ $p->deskripsi }}</td>
                    <td>{{ $p->stok }}</td>
                    <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('products.edit', $p->id) }}" class="btn btn-sm btn-warning rounded-pill text-white">Edit</a>
                        <button type="button" class="btn btn-sm btn-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $p->id }}">
                            Delete
                        </button>
                    </td>
                </tr>

                <div class="modal fade" id="deleteModal{{ $p->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" style="border-radius: 15px;">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title">Yakin ingin menghapus?</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body text-center mt-3">
                                <p>Data <strong>{{ $p->nama_produk }}</strong> akan dihapus permanen. customer nggak bisa beli ini lagi nanti!</p>
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Batal</button>
                                <form action="{{ route('products.destroy', $p->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger rounded-pill">Ya, Hapus!</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection