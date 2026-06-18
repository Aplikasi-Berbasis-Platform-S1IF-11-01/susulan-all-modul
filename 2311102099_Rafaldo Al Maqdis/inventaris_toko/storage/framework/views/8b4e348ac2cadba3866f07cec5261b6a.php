<?php $__env->startSection('title', 'Tambah Produk'); ?>
<?php $__env->startSection('page-title', 'Tambah Produk'); ?>

<?php $__env->startSection('content'); ?>


<div class="breadcrumb-custom">
    <i class="bi bi-house" style="color:var(--text-muted)"></i>
    <span class="sep">›</span>
    <a href="<?php echo e(route('products.index')); ?>">Data Produk</a>
    <span class="sep">›</span>
    <span class="current">Tambah Produk</span>
</div>


<div class="page-header">
    <div>
        <h2>Tambah Produk Baru</h2>
        <p>Isi formulir di bawah untuk menambah produk ke inventaris</p>
    </div>
    <a href="<?php echo e(route('products.index')); ?>" class="btn-brown-outline">
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
                <form method="POST" action="<?php echo e(route('products.store')); ?>" novalidate>
                    <?php echo csrf_field(); ?>

                    
                    <div class="mb-4">
                        <label class="form-label" for="name">
                            Nama Produk <span style="color:#dc2626">*</span>
                        </label>
                        <input type="text"
                               name="name"
                               id="name"
                               class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('name')); ?>"
                               placeholder="Contoh: Beras Premium 5kg"
                               autofocus>
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
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
                                       class="form-control <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       value="<?php echo e(old('stock', 0)); ?>"
                                       min="0"
                                       placeholder="0">
                                <span class="input-group-text">unit</span>
                                <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                                       class="form-control <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       value="<?php echo e(old('price', 0)); ?>"
                                       min="0"
                                       step="100"
                                       placeholder="0">
                                <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <small style="font-size:11.5px;color:var(--text-muted);margin-top:4px;display:block;">
                                Harga akan ditampilkan: <span id="pricePreview" style="font-weight:600;color:var(--medium-brown);">Rp 0</span>
                            </small>
                        </div>
                    </div>

                    
                    <div class="mb-4">
                        <label class="form-label" for="description">
                            Deskripsi Produk
                            <span style="font-weight:400;color:var(--text-muted)">(opsional)</span>
                        </label>
                        <textarea name="description"
                                  id="description"
                                  class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                  rows="4"
                                  placeholder="Tulis deskripsi produk, spesifikasi, atau keterangan tambahan..."><?php echo e(old('description')); ?></textarea>
                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <small style="font-size:11.5px;color:var(--text-muted);margin-top:4px;display:block;">
                            <span id="descCount">0</span>/500 karakter
                        </small>
                    </div>

                    
                    <div class="d-flex gap-2 pt-2" style="border-top:1px solid rgba(75,46,43,.08);">
                        <button type="submit" class="btn-brown">
                            <i class="bi bi-check-circle"></i>
                            Simpan Produk
                        </button>
                        <a href="<?php echo e(route('products.index')); ?>" class="btn-brown-outline">
                            <i class="bi bi-x-circle"></i>
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>

        
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

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Rafaldo\Documents\TUGAS ITTP\SEMESTER 6\PRAKTIKUM ABP\Modul 11,12,13\2311102099_Rafaldo Al Maqdis\inventaris_toko\resources\views/products/create.blade.php ENDPATH**/ ?>