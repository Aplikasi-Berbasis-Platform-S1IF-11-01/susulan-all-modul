<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Gitar Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f6f4;
            font-family: 'Segoe UI', Roboto, sans-serif;
        }
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            background: #fff;
        }
        .btn-custom {
            border-radius: 6px;
            font-weight: 500;
            transition: transform 0.2s;
        }
        .btn-custom:hover {
            transform: scale(1.02);
        }
    </style>
</head>
<body class="py-5">
    <div class="container" style="max-width: 650px;">
        <div class="card card-custom p-4 border-top border-dark border-3">
            <h4 class="fw-bold mb-1 text-dark d-flex align-items-center gap-2">
                <i class="fa-solid fa-guitar text-warning"></i> Tambah Gitar Baru
            </h4>
            <p class="text-muted small mb-4">Masukkan detail spesifikasi instrumen baru ke dalam vault toko.</p>
            
            @if($errors->any())
                <div class="alert alert-danger border-0 shadow-sm mb-4">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold small text-secondary">Tipe Instrumen</label>
                        <select id="tipeGitar" class="form-select" onchange="generateSkuHint()" required>
                            <option value="" disabled selected>-- Pilih Tipe --</option>
                            <option value="EL">Electric Guitar</option>
                            <option value="AK">Acoustic Guitar</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold small text-secondary">Kode Produk (SKU)</label>
                        <input type="text" name="kode_produk" id="kodeProduk" class="form-control" placeholder="Contoh: GTR-EL01-99" required value="{{ old('kode_produk') }}">
                        <div id="skuHelp" class="form-text small text-muted">Pilih tipe untuk melihat rekomendasi format.</div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold small text-secondary">Model / Nama Gitar</label>
                    <input type="text" name="nama_produk" class="form-control" placeholder="Contoh: Fender Stratocaster Player Series" required value="{{ old('nama_produk') }}">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold small text-secondary">Stok Awal (Unit)</label>
                        <input type="number" name="stok" class="form-control" placeholder="0" min="0" required value="{{ old('stok') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold small text-secondary">Harga Satuan (Rp)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-secondary fw-semibold small">Rp</span>
                            <input type="number" name="harga" class="form-control" placeholder="1500000" min="0" required value="{{ old('harga') }}">
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold small text-secondary">Deskripsi & Spesifikasi Tambahan</label>
                    <textarea name="deskripsi" class="form-control" rows="4" placeholder="Contoh: Konfigurasi pickup HSS, bodi Alder, warna Sunburst...">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="d-flex gap-2 justify-content-end border-top pt-3">
                    <a href="{{ route('products.index') }}" class="btn btn-light btn-custom px-4">Batal</a>
                    <button type="submit" class="btn btn-dark btn-custom px-4" style="background: #2c2520; border: 1px solid #d4af37; color: #fff;">
                        <i class="fa-solid fa-floppy-disk text-warning me-1"></i> Simpan ke Vault
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function generateSkuHint() {
            const tipe = document.getElementById('tipeGitar').value;
            const inputKode = document.getElementById('kodeProduk');
            const helpText = document.getElementById('skuHelp');
            
            if (tipe === 'EL') {
                inputKode.placeholder = 'Contoh: GTR-EL09-22';
                helpText.innerHTML = '<span class="text-primary fw-semibold"><i class="fa-solid fa-bolt-lightning"></i> Format disarankan: GTR-EL[Nomor]-[ID]</span>';
            } else if (tipe === 'AK') {
                inputKode.placeholder = 'Contoh: GTR-AK09-11';
                helpText.innerHTML = '<span class="text-success fw-semibold"><i class="fa-solid fa-tree"></i> Format disarankan: GTR-AK[Nomor]-[ID]</span>';
            }
        }
    </script>
</body>
</html>