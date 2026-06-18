@extends('layouts.app')
@section('content')
<div class="card card-girly p-4 w-75 mx-auto">
    <h4 class="mb-4 text-center" style="color: #ff1493;">🌸 Tambah Produk Baru</h4>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control rounded-pill" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" style="border-radius: 15px;" rows="3"></textarea>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control rounded-pill" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Harga (Rp)</label>
                <input type="number" name="harga" class="form-control rounded-pill" required>
            </div>
        </div>
        <div class="text-end">
            <a href="{{ route('products.index') }}" class="btn btn-secondary rounded-pill">Kembali</a>
            <button type="submit" class="btn btn-pink">Simpan Produk</button>
        </div>
    </form>
</div>
@endsection