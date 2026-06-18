<?php $__env->startSection('title', 'Data Produk'); ?>
<?php $__env->startSection('page-title', 'Inventaris Produk'); ?>

<?php $__env->startSection('content'); ?>


<div class="breadcrumb-custom">
    <i class="bi bi-house" style="color:var(--text-muted)"></i>
    <span class="sep">›</span>
    <span class="current">Data Produk</span>
</div>


<div class="page-header">
    <div>
        <h2>Daftar Produk</h2>
        <p>Kelola seluruh data produk toko Anda di sini</p>
    </div>
    <a href="<?php echo e(route('products.create')); ?>" class="btn-brown">
        <i class="bi bi-plus-lg"></i>
        Tambah Produk
    </a>
</div>


<?php
    $totalProducts = $products->count();
    $totalStock    = $products->sum('stock');
    $totalValue    = $products->sum(fn($p) => $p->price * $p->stock);
?>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon brown">
                <i class="bi bi-box-seam"></i>
            </div>
            <div>
                <div class="stat-value"><?php echo e($totalProducts); ?></div>
                <div class="stat-label">Total Jenis Produk</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon green">
                <i class="bi bi-layers"></i>
            </div>
            <div>
                <div class="stat-value"><?php echo e(number_format($totalStock)); ?></div>
                <div class="stat-label">Total Unit Stok</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon amber">
                <i class="bi bi-currency-dollar"></i>
            </div>
            <div>
                <div class="stat-value" style="font-size:20px;">Rp <?php echo e(number_format($totalValue, 0, ',', '.')); ?></div>
                <div class="stat-label">Total Nilai Inventaris</div>
            </div>
        </div>
    </div>
</div>


<div class="card-custom">
    <div class="card-header-custom">
        <i class="bi bi-table"></i>
        <h5>Tabel Data Produk</h5>
        <span style="margin-left:auto;font-size:12px;color:rgba(245,245,220,.6);">
            <?php echo e($totalProducts); ?> produk terdaftar
        </span>
    </div>

    <div class="card-body-custom">
        <?php if($products->isEmpty()): ?>
            <div class="empty-state">
                <i class="bi bi-inbox"></i>
                <h5>Belum Ada Produk</h5>
                <p class="mb-3">Mulai tambahkan produk pertama Anda ke inventaris toko.</p>
                <a href="<?php echo e(route('products.create')); ?>" class="btn-brown">
                    <i class="bi bi-plus-lg"></i> Tambah Produk Pertama
                </a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table id="productsTable" class="table table-custom table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>Nama Produk</th>
                            <th width="110">Stok</th>
                            <th width="150">Harga</th>
                            <th>Deskripsi</th>
                            <th width="80">Dibuat</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($i + 1); ?></td>
                            <td>
                                <div style="font-weight:600;color:var(--dark-brown);">
                                    <?php echo e($product->name); ?>

                                </div>
                            </td>
                            <td>
                                <?php if($product->stock <= 10): ?>
                                    <span class="badge-stock-low"><?php echo e($product->stock); ?> unit</span>
                                <?php elseif($product->stock <= 30): ?>
                                    <span class="badge-stock-med"><?php echo e($product->stock); ?> unit</span>
                                <?php else: ?>
                                    <span class="badge-stock-good"><?php echo e($product->stock); ?> unit</span>
                                <?php endif; ?>
                            </td>
                            <td style="font-weight:600; color:var(--medium-brown);">
                                <?php echo e($product->formatted_price); ?>

                            </td>
                            <td>
                                <span style="color:var(--text-muted);font-size:13px;">
                                    <?php echo e($product->description ? \Str::limit($product->description, 55, '...') : '—'); ?>

                                </span>
                            </td>
                            <td style="font-size:12px;color:var(--text-muted);">
                                <?php echo e($product->created_at->format('d/m/Y')); ?>

                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="<?php echo e(route('products.edit', $product)); ?>" class="btn-edit">
                                        <i class="bi bi-pencil"></i>
                                        Edit
                                    </a>
                                    <button type="button" class="btn-delete"
                                            onclick="confirmDelete(<?php echo e($product->id); ?>, '<?php echo e(addslashes($product->name)); ?>')">
                                        <i class="bi bi-trash3"></i>
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>


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
                    Anda akan menghapus produk:<br>
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
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn-danger-custom">
                        <i class="bi bi-trash3"></i> Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Init DataTables
    $(document).ready(function () {
        $('#productsTable').DataTable({
            responsive: true,
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/id.json',
                search:         'Cari:',
                lengthMenu:     'Tampilkan _MENU_ data',
                info:           'Menampilkan _START_–_END_ dari _TOTAL_ produk',
                infoEmpty:      'Tidak ada data tersedia',
                infoFiltered:   '(difilter dari _MAX_ total data)',
                zeroRecords:    'Tidak ada produk yang cocok dengan pencarian',
                paginate: {
                    first:    '«',
                    last:     '»',
                    next:     '›',
                    previous: '‹',
                },
            },
            columnDefs: [
                { orderable: false, targets: [6] }, // Aksi column
            ],
            order: [[0, 'asc']],
            pageLength: 10,
        });
    });

    // Delete Confirmation
    function confirmDelete(id, name) {
        document.getElementById('deleteProductName').textContent = name;
        document.getElementById('deleteForm').action = '/products/' + id;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Rafaldo\Documents\TUGAS ITTP\SEMESTER 6\PRAKTIKUM ABP\Modul 11,12,13\2311102099_Rafaldo Al Maqdis\inventaris_toko\resources\views/products/index.blade.php ENDPATH**/ ?>