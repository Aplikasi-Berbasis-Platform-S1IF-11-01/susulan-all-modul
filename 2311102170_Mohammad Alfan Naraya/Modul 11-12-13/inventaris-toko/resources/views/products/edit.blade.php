<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">
    <div class="container" style="max-width: 600px;">
        <div class="card border-0 shadow-sm p-4">
            <h4 class="fw-bold mb-4 text-warning">Edit Data Produk</h4>

            @if($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-semibold">Kode Produk</label>
                    <input type="text" name="kode_produk" class="form-control" required value="{{ old('kode_produk', $product->kode_produk) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Produk</label>
                    <input type="text" name="nama_produk" class="form-control" required value="{{ old('nama_produk', $product->nama_produk) }}">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Jumlah Stok</label>
                        <input type="number" name="stok" class="form-control" required value="{{ old('stok', $product->stok) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Harga Satuan (Rp)</label>
                        <input type="number" name="harga" class="form-control" required value="{{ old('harga', $product->harga) }}">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold">Deskripsi Tambahan</label>
                    <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $product->deskripsi) }}</textarea>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning px-4">Update Produk</button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary px-3">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>