<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard RockStrand Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f6f4;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }
        .navbar-custom {
            background: linear-gradient(to right, #111, #2c2520);
            border-bottom: 3px solid #d4af37;
        }
        .bg-amber-gold {
            background-color: #f4c430;
            color: #111;
            font-weight: bold;
        }
        .card-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            background: #fff;
        }
        .table modern-table thead {
            background-color: #212529;
            color: #fff;
        }
        .btn-action {
            border-radius: 6px;
            font-weight: 500;
            transition: transform 0.2s;
        }
        .btn-action:hover {
            transform: scale(1.05);
        }
        .gitar-badge-el {
            background-color: #e3f2fd;
            color: #0d6efd;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.85rem;
        }
        .gitar-badge-ak {
            background-color: #fff3cd;
            color: #856404;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom mb-4 shadow">
        <div class="container">
            <a class="navbar-brand fw-bold text-uppercase d-flex align-items-center gap-2" href="#">
                <i class="fa-solid fa-guitar text-warning fs-3"></i> 
                <span>Jeng Jeng <span style="color: #d4af37;">Guitar Co.</span></span>
            </a>
            <form action="{{ route('logout') }}" method="POST" class="d-flex">
                @csrf
                <button class="btn btn-outline-danger btn-sm px-3 d-flex align-items-center gap-1 btn-action" type="submit">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </div>
    </nav>

    <div class="container mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-dark m-0">Guitars Vault Inventory</h2>
                <p class="text-muted m-0">Kelola stok instrumen akustik, elektrik, dan spesifikasinya di sini.</p>
            </div>
            <a href="{{ route('products.create') }}" class="btn btn-dark btn-action px-4 py-2 d-flex align-items-center gap-2 shadow-sm" style="background: #2c2520; border: 1px solid #d4af37;">
                <i class="fa-solid fa-circle-plus text-warning"></i> + Tambah Gitar Baru
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm d-flex align-items-center gap-2">
                <i class="fa-solid fa-circle-check fs-5"></i> <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="card card-custom p-4">
            <table id="gitarTable" class="table table-hover align-middle w-100">
                <thead class="table-dark">
                    <tr>
                        <th class="border-0">SKU / Kode</th>
                        <th class="border-0">Model Gitar</th>
                        <th class="border-0">Tipe</th>
                        <th class="border-0">Stok Toko</th>
                        <th class="border-0">Harga Jual</th>
                        <th class="border-0 text-center" style="width: 15%">Aksi Kontrol</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $p)
                    <tr>
                        <td class="fw-bold text-secondary">{{ $p->kode_produk }}</td>
                        <td class="fw-semibold text-dark">{{ $p->nama_produk }}</td>
                        <td>
                            @if(str_contains($p->kode_produk, 'EL'))
                                <span class="gitar-badge-el"><i class="fa-solid fa-bolt-lightning me-1"></i> Electric</span>
                            @else
                                <span class="gitar-badge-ak"><i class="fa-solid fa-tree me-1"></i> Acoustic</span>
                            @endif
                        </td>
                        <td>
                            @if($p->stok <= 5)
                                <span class="badge bg-danger">Sisa {{ $p->stok }} unit</span>
                            @else
                                <span class="badge bg-success">{{ $p->stok }} unit</span>
                            @endif
                        </td>
                        <td class="fw-bold text-success">Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('products.edit', $p->id) }}" class="btn btn-warning btn-sm btn-action text-dark px-2.5">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <button class="btn btn-danger btn-sm btn-action px-2.5" onclick="confirmDelete({{ $p->id }}, '{{ $p->nama_produk }}')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-dark text-white" style="border-bottom: 3px solid #dc3545;">
                        <h5 class="modal-title fw-bold d-flex align-items-center gap-2">
                            <i class="fa-solid fa-triangle-exclamation text-danger"></i> Hapus dari Vault?
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body py-4 text-center">
                        <i class="fa-solid fa-guitar text-muted mb-3" style="font-size: 3rem; display: block;"></i>
                        <p class="fs-6 text-muted m-0">Apakah anda yakin ingin menghapus data gitar</p>
                        <h5 id="deleteProductName" class="fw-bold text-danger my-2"></h5>
                        <p class="small text-secondary m-0">Konfirmasi tindakan ini akan menghapus entitas produk secara permanen.</p>
                    </div>
                    <div class="modal-footer bg-light border-0">
                        <button type="button" class="btn btn-secondary btn-action" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger btn-action px-4">Ya, Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#gitarTable').DataTable({
                "language": {
                    "search": "Cari Instrumen:",
                    "lengthMenu": "Display _MENU_ item",
                    "zeroRecords": "Gitar tidak ditemukan dalam katalog",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ gitar",
                    "infoEmpty": "Katalog kosong",
                    "paginate": {
                        "next": "<i class='fa-solid fa-chevron-right'></i>",
                        "previous": "<i class='fa-solid fa-chevron-left'></i>"
                    }
                }
            });
        });

        function confirmDelete(id, name) {
            $('#deleteProductName').text(name);
            $('#deleteForm').attr('action', '/products/' + id);
            var myModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            myModal.show();
        }
    </script>
</body>
</html>