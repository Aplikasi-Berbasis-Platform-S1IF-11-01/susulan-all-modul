@extends('layouts.app')

@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk')

@section('content')

{{-- Breadcrumb --}}
<div class="breadcrumb-custom">
    <i class="bi bi-house" style="color:var(--text-muted)"></i>
    <span class="sep">›</span>
    <a href="{{ route('products.index') }}">Data Produk</a>
    <span class="sep">›</span>
    <span class="current">Edit: {{ \Str::limit($product->name, 30) }}</span>
</div>

{{-- Page Header --}}
<div class="page-header">
    <div>
        <h2>Edit Produk</h2>
        <p>Perbarui data produk <strong>{{ $product->name }}</strong></p>
    </div>
    <a href="{{ route('products.index') }}" class="btn-brown-outline">
        <i class="bi bi-arrow-left"></i>
        Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">

        {{-- Product Info Badge --}}
        <div style="margin-bottom:20px;padding:14px 18px;background:var(--white);border:1px solid rgba(75,46,43,.1);border-radius:10px;display:flex;align-items:center;gap:12px;box-shadow:0 2px 8px rgba(75,46,43,.06);">
            <div style="width:42px;height:42px;background:rgba(111,78,55,.1);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0;">
                📦
            </div>
            <div>
                <div style="font-size:11px;color:var(--text-muted);text-transform:uppercase;letter-spacing:.8px;font-weight:600;">Mengedit Produk #{{ $product->id }}</div>
                <div style="font-size:15px;font-weight:700;color:var(--dark-brown);">{{ $product->name }}</div>
            </div>
            <div style="margin-left:auto;text-align:right;">
                <div style="font-size:11px;color:var(--text-muted);">Ditambahkan</div>
                <div style="font-size:13px;font-weight:600;color:var(--text-mid);">{{ $product->created_at->format('d M Y') }}</div>
            </div>
        </div>

        <div class="card-custom">
            <div class="card-header-custom">
                <i class="bi bi-pencil-square"></i>
                <h5>Formulir Edit Produk</h5>
            </div>

            <div class="card-body-custom">
                <form method="POST" action="{{ route('products.update', $product) }}" novalidate>
                    @csrf
                    @method('PUT')

                    {{-- Product Name --}}
                    <div class="mb-4">
                        <label class="form-label" for="name">
                            Nama Produk <span style="color:#dc2626">*</span>
                        </label>
                        <input type="text"
                               name="name"
                               id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $product->name) }}"
                               placeholder="Nama produk"
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
                                       value="{{ old('stock', $product->stock) }}"
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
                                       value="{{ old('price', (int) $product->price) }}"
                                       min="0"
                                       step="100"
                                       placeholder="0">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small style="font-size:11.5px;color:var(--text-muted);margin-top:4px;display:block;">
                                Harga saat ini: <span id="pricePreview" style="font-weight:600;color:var(--medium-brown);">{{ $product->formatted_price }}</span>
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
                                  placeholder="Tulis deskripsi produk...">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small style="font-size:11.5px;color:var(--text-muted);margin-top:4px;display:block;">
                            <span id="descCount">{{ strlen($product->description ?? '') }}</span>/500 karakter
                        </small>
                    </div>

                    {{-- Actions --}}
                    <div class="d-flex gap-2 pt-2" style="border-top:1px solid rgba(75,46,43,.08);">
                        <button type="submit" class="btn-brown">
                            <i class="bi bi-check-circle"></i>
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('products.index') }}" class="btn-brown-outline">
                            <i class="bi bi-x-circle"></i>
                            Batal
                        </a>

                        {{-- Quick delete from edit page --}}
                        <button type="button" class="btn-delete ms-auto"
                                onclick="confirmDelete({{ $product->id }}, '{{ addslashes($product->name) }}')">
                            <i class="bi bi-trash3"></i>
                            Hapus Produk Ini
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ── DELETE MODAL ──────────────────────────────────────────────────── --}}
<div class="modal fade modal-custom" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="modal-danger-icon">
                    <i class="bi bi-trash3-fill"></i>
                </div>
                <h5>Hapus Produk?</h5>
                <p>
                    Anda akan menghapus:<br>
                    <strong class="modal-product-name" id="deleteProductName"></strong>
                </p>
                <p class="mt-2" style="font-size:12px;color:#b91c1c;">
                    ⚠️ Tindakan ini tidak dapat dibatalkan!
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Batal
                </button>
                <form id="deleteForm" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger-custom">
                        <i class="bi bi-trash3"></i> Ya, Hapus
                    </button>
                </form>
            </div>
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

    // Description counter
    const descArea  = document.getElementById('description');
    const descCount = document.getElementById('descCount');

    descArea.addEventListener('input', () => {
        descCount.textContent = descArea.value.length;
        descCount.style.color = descArea.value.length > 500 ? '#dc2626' : 'var(--text-muted)';
    });

    // Delete modal
    function confirmDelete(id, name) {
        document.getElementById('deleteProductName').textContent = name;
        document.getElementById('deleteForm').action = '/products/' + id;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }
</script>
@endpush
