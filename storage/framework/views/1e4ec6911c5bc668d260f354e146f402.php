

<?php $__env->startSection('title', 'Detail Produk'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-primary text-white fw-bold py-3">
                    Detail Produk
                </div>
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-5 text-center mb-3 mb-md-0">
                            <?php if($produk->foto): ?>
                                <img src="<?php echo e(asset('storage/' . $produk->foto)); ?>" alt="<?php echo e($produk->nama); ?>" class="img-fluid rounded border shadow-sm" style="max-height: 250px; object-fit: cover;">
                            <?php else: ?>
                                <div class="bg-light rounded border d-flex align-items-center justify-content-center text-muted mx-auto" style="height: 200px; width: 100%;">
                                    No Image
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-7">
                            <h3 class="fw-bold text-dark mb-3"><?php echo e($produk->nama); ?></h3>
                            
                            <table class="table table-borderless align-middle mb-0">
                                <tr>
                                    <td class="text-muted fw-semibold ps-0" style="width: 35%;">Input By</td>
                                    <td>: <?php echo e($produk->user->name ?? 'N/A'); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-semibold ps-0">Harga Beli</td>
                                    <td>: <span class="text-secondary">Rp <?php echo e(number_format($produk->harga_beli, 0, ',', '.')); ?></span></td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-semibold ps-0">Harga Jual</td>
                                    <td>: <span class="fw-bold text-primary">Rp <?php echo e(number_format($produk->harga_jual, 0, ',', '.')); ?></span></td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-semibold ps-0">Stok</td>
                                    <td>: 
                                        <span class="badge <?php echo e($produk->stok > 10 ? 'bg-success' : 'bg-warning text-dark'); ?> px-3 py-2">
                                            <?php echo e($produk->stok); ?> unit
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light border-0 py-3 text-end">
                    <a href="<?php echo e(route('produk.index')); ?>" class="btn btn-secondary px-4">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pos_saca\resources\views/produk/show.blade.php ENDPATH**/ ?>