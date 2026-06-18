@extends('layouts.app')
@section('title', 'Manajemen Produk')
@section('page-title-plain', 'Inventaris')
@section('page-title-em', 'Produk')
@section('page-sub', 'Kelola stok dan katalog gadget GadgetKita')

@section('content')
<div class="row g-4">

    {{-- KOLOM KIRI: Form Tambah --}}
    <div class="col-lg-4">
        <div class="card h-fit">
            <div class="card-header">+ Tambah Produk Baru</div>
            <div class="card-body">
                <form method="POST" action="{{ route('products.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="name" class="form-control"
                               value="{{ old('name') }}"
                               placeholder="cth. Smartphone Aurora X1" required/>
                        @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="category" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $cat)
                                <option {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-7 mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" name="price" class="form-control"
                                   value="{{ old('price') }}"
                                   placeholder="0" min="1" required/>
                            @error('price')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-5 mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" name="stock" class="form-control"
                                   value="{{ old('stock') }}"
                                   placeholder="0" min="0" required/>
                            @error('stock')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-1">Simpan Produk</button>
                </form>
            </div>
        </div>
    </div>

    {{-- KOLOM KANAN: Tabel --}}
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">Katalog Produk</div>
            <div class="card-body p-0">
                <table id="tabel" class="table mb-0" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $i => $product)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $product->name }}</td>
                            <td><span class="badge-cat">{{ $product->category }}</span></td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>
                                @if($product->stock == 0)
                                    <span class="badge-stock badge-stock-out">Habis</span>
                                @elseif($product->stock < 10)
                                    <span class="badge-stock badge-stock-low">{{ $product->stock }}</span>
                                @else
                                    <span class="badge-stock badge-stock-ok">{{ $product->stock }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-edit"
                                        data-id="{{ $product->id }}"
                                        data-name="{{ $product->name }}"
                                        data-category="{{ $product->category }}"
                                        data-price="{{ $product->price }}"
                                        data-stock="{{ $product->stock }}">Ubah</button>
                                    <button class="btn btn-del"
                                        data-id="{{ $product->id }}"
                                        data-name="{{ $product->name }}">Hapus</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

{{-- Modal Ubah --}}
<div class="modal fade" id="modalEdit" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formEdit" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" id="editName" name="name" class="form-control" required/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select id="editCategory" name="category" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $cat)
                                <option>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-7 mb-4">
                            <label class="form-label">Harga</label>
                            <input type="number" id="editPrice" name="price" class="form-control" min="1" required/>
                        </div>
                        <div class="col-5 mb-4">
                            <label class="form-label">Stok</label>
                            <input type="number" id="editStock" name="stock" class="form-control" min="0" required/>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-end">
                        <button type="button" class="btn btn-outline-secondary btn-sm"
                                data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Hapus --}}
<div class="modal fade" id="modalHapus" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center py-4">
                <div class="del-icon">⚠</div>
                <p>Hapus <strong id="namaHapus"></strong> dari katalog?</p>
                <div class="d-flex gap-2 justify-content-center mt-3">
                    <button class="btn btn-outline-secondary btn-sm"
                            data-bs-dismiss="modal">Batal</button>
                    <form id="formHapus" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('#tabel').DataTable({
        ordering: false,
        language: {
            search: 'Cari produk:',
            lengthMenu: 'Tampilkan _MENU_',
            info: '_START_–_END_ dari _TOTAL_ produk',
            paginate: { next: '›', previous: '‹' }
        },
        pageLength: 5
    });

    $(document).on('click', '.btn-edit', function () {
        const id       = $(this).data('id');
        const name     = $(this).data('name');
        const category = $(this).data('category');
        const price    = $(this).data('price');
        const stock    = $(this).data('stock');

        $('#editName').val(name);
        $('#editPrice').val(price);
        $('#editStock').val(stock);
        $('#editCategory').val(category);
        $('#formEdit').attr('action', '/products/' + id);

        new bootstrap.Modal($('#modalEdit')).show();
    });

    $(document).on('click', '.btn-del', function () {
        const id   = $(this).data('id');
        const name = $(this).data('name');

        $('#namaHapus').text(name);
        $('#formHapus').attr('action', '/products/' + id);

        new bootstrap.Modal($('#modalHapus')).show();
    });
</script>
@endsection
