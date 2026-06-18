@extends('layouts.app')

@section('content')
<div class="card card-girly p-4 w-75 mx-auto">
    <h4 class="mb-4 text-center" style="color: #ff1493;">🌸 Edit Produk: {{ $product->nama_produk }}</h4>
    
    @if($errors->any())
        <div class="alert alert-danger rounded-pill">
            Gagal menyimpan, pastikan semua data terisi dengan benar ya!
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control rounded-pill" value="{{ old('nama_produk', $product->nama_produk) }}" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" style="border-radius: 15px;" rows="3">{{ old('deskripsi', $product->deskripsi) }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control rounded-pill" value="{{ old('stok', $product->stok) }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Harga (Rp)</label>
                <input type="number" name="harga" class="form-control rounded-pill" value="{{ old('harga', $product->harga) }}" required>
            </div>
        </div>

        <div class="text-end">
            <a href="{{ route('products.index') }}" class="btn btn-secondary rounded-pill">Kembali</a>
            <button type="submit" class="btn btn-pink">Update Produk</button>
        </div>
    </form>
</div>
@endsection