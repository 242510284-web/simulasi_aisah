

<?php $__env->startSection('title', 'POS'); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('errors')): ?>
    <div class="alert alert-danger">
        <?php echo e(session('errors')); ?>

    </div>
<?php endif; ?>

<h4 class="mb-3">Tambah dan Edit</h4>

<div class="row">

    
    <div class="col-md-6">
        <div class="card">
            <div class="card-body" style="max-height: 70vh; overflow-y: auto;">
                <div class="mb-3">
                    <form method="GET" action="<?php echo e(route('penjualan.create')); ?>">
                        <input 
                            type="text" 
                            name="search" 
                            value="<?php echo e(request('search')); ?>" 
                            class="form-control" 
                            placeholder="Cari produk..." 
                            onkeyup="this.form.submit()"
                        >
                    </form>
                </div>
                
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <form method="POST" action="<?php echo e(route('item-penjualan.store')); ?>" class="row mb-2 align-items-center">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">

                    <div class="col-7">
                        <button type="button" class="btn btn-outline-primary w-100 text-start p-2 <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>">
                            <div class="d-flex align-items-center gap-2">
                                <img 
                                    src="<?php echo e(asset('storage/' . $product->foto)); ?>" 
                                    alt="<?php echo e($product->nama); ?>" 
                                    class="rounded-circle" 
                                    style="width: 45px; height: 45px; object-fit: cover;"
                                >
                                <div>
                                    <div class="fw-semibold"><?php echo e($product->nama); ?></div>
                                    <small class="text-muted">Rp <?php echo e(number_format($product->harga_jual, 0, ',', '.')); ?></small>
                                </div>
                            </div>
                        </button>
                    </div>

                    <div class="col-3">
                        <input 
                            type="number" 
                            name="quantity" 
                            value="1" 
                            min="1" 
                            class="form-control"
                            <?php echo e($sale->status === 'COMPLETED' ? 'readonly' : ''); ?>

                        >
                    </div>

                    <div class="col-2">
                        <button type="submit" class="btn btn-primary w-100 <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>" <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>>
                            +
                        </button>
                    </div>
                </form>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    
    <div class="col-md-6">
        <div class="card">
            <div class="table-responsive">
                <table class="table table-bordered mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th style="width: 100px;">Qty</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $sale->itemPenjualan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($item->produk->nama); ?></td>
                            <td>Rp <?php echo e(number_format($item->produk->harga_jual, 0, ',', '.')); ?></td>
                            <td>
                                <form method="POST" action="<?php echo e(route('item-penjualan.update', $item->id)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <input 
                                        type="number" 
                                        name="quantity" 
                                        value="<?php echo e($item->kuantitas); ?>" 
                                        min="1"
                                        class="form-control form-control-sm"
                                        onchange="this.form.submit()"
                                        <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>

                                    >
                                </form>
                            </td>
                            <td>Rp <?php echo e(number_format($item->subtotal, 0, ',', '.')); ?></td>
                            <td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $item)): ?>
                                <form method="POST" action="<?php echo e(route('item-penjualan.destroy', $item->id)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm" <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>>
                                        Hapus
                                    </button>
                                </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Keranjang kosong
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="fw-bold">Total Pembayaran:</span>
                    <strong class="fs-5 text-primary">Rp <?php echo e(number_format($sale->total_pembayaran ?? 0, 0, ',', '.')); ?></strong>
                </div>

                
                <form 
                    method="POST" 
                    action="<?php echo e(route('penjualan.update', $sale->id)); ?>" 
                    onsubmit="return confirm('Yakin ingin checkout?')" 
                    class="mt-2"
                >
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    
                    <select id="paymentMethod" name="payment_method" class="form-select mb-2" onchange="togglePaymentInput()" required <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>>
                        <option value="">Pilih Pembayaran</option>
                        <option value="CASH">Cash</option>
                        <option value="QRIS">QRIS</option>
                    </select>

                    
                    <div id="cashGroup" class="p-3 border rounded mb-2 bg-light" style="display: none;">
                        <div class="mb-2">
                            <label for="cashReceived" class="form-label fw-bold">Uang Diterima (Rp):</label>
                            <input 
                                type="number" 
                                id="cashReceived" 
                                name="cash_received" 
                                class="form-control" 
                                placeholder="Masukkan nominal..." 
                                oninput="calculateChange()"
                                <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>

                            >
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Kembalian:</span>
                            <span id="changeLabel" class="fw-bold text-success fs-6">Rp 0</span>
                        </div>
                    </div>

                    
                    
<div id="qrisGroup" class="p-3 border rounded mb-2 bg-light text-center" style="display: none;">
    <p class="fw-bold mb-2">Pindai QRIS untuk Pembayaran</p>
    
    <div class="d-flex justify-content-center">
        
        <img 
            src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=PAYMENT-<?php echo e($sale->id ?? time()); ?>" 
            alt="Barcode QRIS" 
            class="img-fluid border p-2 bg-white rounded" 
            style="max-width: 200px;"
        >
    </div>

    <small class="text-muted d-block mt-2">Pastikan pembayaran berhasil sebelum menekan Checkout</small>
</div>

                    <button 
                        type="submit" 
                        class="btn btn-success w-100 <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>"
                        <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>

                    >
                        Checkout
                    </button>
                </form>

                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $sale)): ?>
                <form action="<?php echo e(route('penjualan.destroy', $sale->id)); ?>" method="POST" onsubmit="return confirm('Yakin ingin membatalkan transaksi?')">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>

                    <button 
                        type="submit" 
                        class="btn btn-outline-danger w-100 mt-2 <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>"
                        <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>

                    >
                        Batalkan Transaksi
                    </button>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>


<script>
    const totalPembayaran = <?php echo e($sale->total_pembayaran ?? 0); ?>;

    function togglePaymentInput() {
        const paymentMethod = document.getElementById('paymentMethod').value;
        const cashGroup = document.getElementById('cashGroup');
        const qrisGroup = document.getElementById('qrisGroup');
        const cashInput = document.getElementById('cashReceived');

        if (paymentMethod === 'CASH') {
            cashGroup.style.display = 'block';
            qrisGroup.style.display = 'none';
            cashInput.setAttribute('required', 'required');
        } else if (paymentMethod === 'QRIS') {
            cashGroup.style.display = 'none';
            qrisGroup.style.display = 'block';
            cashInput.removeAttribute('required');
            cashInput.value = '';
            document.getElementById('changeLabel').innerText = 'Rp 0';
        } else {
            cashGroup.style.display = 'none';
            qrisGroup.style.display = 'none';
            cashInput.removeAttribute('required');
            cashInput.value = '';
            document.getElementById('changeLabel').innerText = 'Rp 0';
        }
    }

    function calculateChange() {
        const cashReceived = parseFloat(document.getElementById('cashReceived').value) || 0;
        const change = cashReceived - totalPembayaran;
        const changeLabel = document.getElementById('changeLabel');

        if (change >= 0) {
            changeLabel.innerText = 'Rp ' + change.toLocaleString('id-ID');
            changeLabel.className = 'fw-bold text-success fs-6';
        } else {
            changeLabel.innerText = 'Uang kurang Rp ' + Math.abs(change).toLocaleString('id-ID');
            changeLabel.className = 'fw-bold text-danger fs-6';
        }
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pos_saca\resources\views/penjualan/pos.blade.php ENDPATH**/ ?>