

<?php $__env->startSection('title', 'Jenis Produk'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-1">
        <h2 class="text-primary fw-bold mb-0">
            <i class="bi bi-tag-fill me-2"></i>Jenis produk
        </h2>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\JenisProduk::class)): ?>
            <a href="<?php echo e(route('jenis-produk.create')); ?>" class="btn btn-info text-white fw-semibold">
                + Tambah Jenis Produk
            </a>
        <?php endif; ?>
    </div>
    <p class="text-secondary mb-4">Kelola jenis produk pada aplikasi POS.</p>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-info text-white fw-bold py-3">
            Daftar Jenis Produk
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 80px;">No</th>
                        <th>Nama Jenis Produk</th>
                        <th>Diinput Oleh</th>
                        <th class="text-center" style="width: 180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $jenisProduks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="text-center"><?php echo e($index + 1); ?></td>
                            <td><?php echo e($item->nama); ?></td>
                            <td><?php echo e($item->user->name ?? 'Sistem'); ?></td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-1">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $item)): ?>
                                        <a href="<?php echo e(route('jenis-produk.edit', $item->id)); ?>" class="btn btn-info btn-sm text-white px-3 d-inline-flex align-items-center">Edit</a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $item)): ?>
                                        <form action="<?php echo e(route('jenis-produk.destroy', $item->id)); ?>" method="POST" class="m-0 d-inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger btn-sm text-white px-3">Hapus</button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="text-center py-3 text-muted">Belum ada data jenis produk</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pos_saca\resources\views/jenis_produk/index.blade.php ENDPATH**/ ?>