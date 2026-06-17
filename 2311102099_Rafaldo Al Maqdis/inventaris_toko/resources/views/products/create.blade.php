@extends('layouts.app')

@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk')

@section('content')

{{-- Breadcrumb --}}
<div class="breadcrumb-custom">
    <i class="bi bi-house" style="color:var(--text-muted)"></i>
    <span class="sep">›</span>
    <a href="{{ route('products.index') }}">Data Produk</a>
    <span class="sep">›</span>
    <span class="current">Tambah Produk</span>
</div>

{{-- Page Header --}}
<div class="page-header">
    <div>
        <h2>Tambah Produk Baru</h2>
        <p>Isi formulir di bawah untuk menambah produk ke inventaris</p>
    </div>
    <a href="{{ route('products.index') }}" class="btn-brown-outline">
        <i class="bi bi-arrow-left"></i>
        Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card-custom">
            <div class="card-header-custom">
                <i class="bi bi-plus-circle"></i>
                <h5>Formulir Produk Baru</h5>
            </div>

            <div class="card-body-custom">
                <form method="POST" action="{{ route('products.store') }}" novalidate>
                    @csrf

                    {{-- Product Name --}}
                    <div class="mb-4">
                        <label class="form-label" for="name">
                            Nama Produk <span style="color:#dc2626">*</span>
                        </label>
                        <input type="text"
                               name="name"
                               id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}"
                               placeholder="Contoh: Beras Premium 5kg"
                               autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Stock & Price row --}}
                    <div class="row g-3 mb-4">
                        <div class="col-md-5">
                            <label class="form-label" for="stock">
                                Jumlah Stok <span style="color:#dc2626">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-layers"></i></span>
                                <input type="number"
                                       name="stock"
                                       id="stock"
                                       class="form-control @error('stock') is-invalid @enderror"
                                       value="{{ old('stock', 0) }}"
                                       min="0"
                                       placeholder="0">
                                <span class="input-group-text">unit</span>
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-7">
                            <label class="form-label" for="price">
                                Harga Satuan <span style="color:#dc2626">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number"
                                       name="price"
                                       id="price"
                                       class="form-control @error('price') is-invalid @enderror"
                                       value="{{ old('price', 0) }}"
                                       min="0"
                                       step="100"
                                       placeholder="0">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small style="font-size:11.5px;color:var(--text-muted);margin-top:4px;display:block;">
                                Harga akan ditampilkan: <span id="pricePreview" style="font-weight:600;color:var(--medium-brown);">Rp 0</span>
                            </small>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <label class="form-label" for="description">
                            Deskripsi Produk
                            <span style="font-weight:400;color:var(--text-muted)">(opsional)</span>
                        </label>
                        <textarea name="description"
                                  id="description"
                                  class="form-control @error('description') is-invalid @enderror"
                                  rows="4"
                                  placeholder="Tulis deskripsi produk, spesifikasi, atau keterangan tambahan...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small style="font-size:11.5px;color:var(--text-muted);margin-top:4px;display:block;">
                            <span id="descCount">0</span>/500 karakter
                        </small>
                    </div>

                    {{-- Actions --}}
                    <div class="d-flex gap-2 pt-2" style="border-top:1px solid rgba(75,46,43,.08);">
                        <button type="submit" class="btn-brown">
                            <i class="bi bi-check-circle"></i>
                            Simpan Produk
                        </button>
                        <a href="{{ route('products.index') }}" class="btn-brown-outline">
                            <i class="bi bi-x-circle"></i>
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Helper tip --}}
        <div style="margin-top:16px;padding:14px 18px;background:rgba(166,123,91,.08);border:1px solid rgba(166,123,91,.2);border-radius:10px;">
            <p style="margin:0;font-size:12.5px;color:var(--text-muted);">
                <i class="bi bi-info-circle me-1" style="color:var(--light-brown)"></i>
                <strong style="color:var(--text-mid);">Tips:</strong>
                Field bertanda <span style="color:#dc2626;font-weight:700">*</span> wajib diisi.
                Stok dan harga harus bernilai angka positif.
            </p>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Live price formatter
    const priceInput   = document.getElementById('price');
    const pricePreview = document.getElementById('pricePreview');

    function formatRupiah(val) {
        const num = parseInt(val) || 0;
        return 'Rp ' + num.toLocaleString('id-ID');
    }

    priceInput.addEventListener('input', () => {
        pricePreview.textContent = formatRupiah(priceInput.value);
    });

    // Set initial value if old input
    if (priceInput.value) {
        pricePreview.textContent = formatRupiah(priceInput.value);
    }

    // Description character counter
    const descArea  = document.getElementById('description');
    const descCount = document.getElementById('descCount');

    descArea.addEventListener('input', () => {
        descCount.textContent = descArea.value.length;
        descCount.style.color = descArea.value.length > 500 ? '#dc2626' : 'var(--text-muted)';
    });

    if (descArea.value) descCount.textContent = descArea.value.length;
</script>
@endpush
