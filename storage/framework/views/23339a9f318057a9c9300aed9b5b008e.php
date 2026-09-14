

<?php $__env->startSection('title', 'Penjualan'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container my-4">
    <?php if(session('errors')): ?>
        <div class="alert alert-danger rounded-3 border-0 shadow-sm">
            <?php echo e(session('errors')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger rounded-3 border-0 shadow-sm">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('success')): ?>
        <div class="alert alert-success rounded-3 border-0 shadow-sm">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark mb-0">Halaman Penjualan</h2>
        <a href="<?php echo e(route('penjualan.create')); ?>" class="btn btn-primary rounded-3 px-3">
            + Tambah Penjualan
        </a>
    </div>

    <form action="<?php echo e(route('penjualan.index')); ?>" method="GET" class="mb-4">
        <div class="input-group">
            <input 
                type="text" 
                name="search" 
                value="<?php echo e(request()->search); ?>" 
                class="form-control border-end-0" 
                placeholder="Cari transaksi atau kasir..."
            >
            <button class="btn btn-outline-secondary bg-white border-start-0" type="submit">
                Search
            </button>
        </div>
    </form>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="text-center py-3" style="width: 50px;">#</th>
                            <th scope="col" class="py-3">Tanggal Transaksi</th>
                            <th scope="col" class="py-3">Kasir</th>
                            <th scope="col" class="py-3">Total Pembayaran</th>
                            <th scope="col" class="py-3">Metode Pembayaran</th>
                            <th scope="col" class="py-3">Status</th>
                            <th scope="col" class="text-center py-3" style="width: 160px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <th scope="row" class="text-center text-muted fw-normal"><?php echo e($sales->firstItem() + $loop->index); ?></th>
                            <td><?php echo e($sale->created_at->translatedFormat('d-m-Y H:i:s')); ?></td>
                            
                            
                            <td><?php echo e($sale->user?->name ?? 'User Dihapus'); ?></td>
                            
                            <td class="fw-semibold">Rp <?php echo e(number_format($sale->total_pembayaran, 0, ',', '.')); ?></td>
                            <td><span class="text-uppercase small text-muted fw-bold"><?php echo e($sale->metode_pembayaran); ?></span></td>
                            <td>
                                
                                <?php if($sale->status == 'COMPLETED'): ?>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1">
                                        COMPLETED
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-3 py-1">
                                        OPEN
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center gap-1">
                                    
                                    <a href="<?php echo e(route('penjualan.show', $sale->id)); ?>" class="btn btn-outline-primary btn-sm px-2 py-1" title="Detail Transaksi">
                                        Detail
                                    </a>
                                    
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view', $sale)): ?>
                                        <a href="<?php echo e(route('penjualan.edit', $sale->id)); ?>" class="btn btn-outline-warning btn-sm px-2 py-1" title="Edit Transaksi">
                                            Edit
                                        </a>
                                    <?php endif; ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $sale)): ?>
                                        <form action="<?php echo e(route('penjualan.destroy', $sale->id)); ?>" method="POST" class="m-0 d-inline-block">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button class="btn btn-outline-danger btn-sm px-2 py-1" onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')" title="Hapus Transaksi">
                                                Hapus
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Data Tidak Ditemukan</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <?php echo e($sales->links()); ?>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pos_saca\resources\views/penjualan/index.blade.php ENDPATH**/ ?>