

<?php $__env->startSection('title', 'Detail Penjualan'); ?>

<?php $__env->startSection('content'); ?>


<style>
    @media print {
        /* Sembunyikan elemen navigasi dan tombol saat dicetak */
        nav, .navbar, .btn, .no-print, header, footer {
            display: none !important;
        }

        /* Set ukuran kertas ke struk thermal 80mm */
        @page {
            size: 80mm auto;
            margin: 0;
        }

        body {
            background: #fff !important;
            font-family: 'Courier New', Courier, monospace !important;
            font-size: 10pt;
            color: #000 !important;
            padding: 4mm;
            margin: 0;
        }

        .container {
            width: 100% !important;
            max-width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .card {
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        /* Header Struk Kasir */
        .struk-header {
            text-align: center;
            margin-bottom: 8px;
            border-bottom: 1px dashed #000;
            padding-bottom: 5px;
        }

        .struk-header h4 {
            font-size: 12pt;
            font-weight: bold;
            margin: 0;
        }

        /* Tabel Struk Kasir */
        .table {
            width: 100% !important;
            border-collapse: collapse !important;
            margin-bottom: 8px !important;
        }

        .table th, .table td {
            font-size: 9pt !important;
            padding: 2px 0 !important;
            border: none !important;
            background: transparent !important;
            color: #000 !important;
        }

        .border-dashed {
            border-bottom: 1px dashed #000 !important;
        }

        .border-double {
            border-top: 1px dashed #000 !important;
            border-bottom: 3px double #000 !important;
        }
    }
</style>


<div class="no-print">
    <?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>

<div class="container my-4">

    
    <div class="d-none d-print-block struk-header">
        <h4>POS CAFCA</h4>
        <p class="mb-0" style="font-size: 8pt;">Toko Perlengkapan Olahraga</p>
        <p class="mb-0" style="font-size: 8pt;">Jl. SMKN 4 Tasikmalaya</p>
    </div>

    
    <div class="d-flex justify-content-between align-items-center mb-4 no-print">
        <h3 class="fw-bold text-primary m-0">Detail Transaksi #<?php echo e($penjualan->id); ?></h3>
        <div class="d-flex gap-2">
            <a href="<?php echo e(route('penjualan.index')); ?>" class="btn btn-secondary btn-sm rounded-3">
                ← Kembali
            </a>
            
            <button onclick="window.print()" class="btn btn-success btn-sm rounded-3 fw-bold">
                🖨️ Cetak Struk
            </button>
        </div>
    </div>

    
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <div class="row gy-3">
                <div class="col-md-3">
                    <small class="text-muted d-block">Tanggal Transaksi</small>
                    <strong class="fs-6"><?php echo e($penjualan->created_at->format('d-m-Y H:i:s')); ?></strong>
                </div>
                <div class="col-md-3">
                    <small class="text-muted d-block">Kasir</small>
                    <strong class="fs-6"><?php echo e($penjualan->user->name ?? '-'); ?></strong>
                </div>
                <div class="col-md-3">
                    <small class="text-muted d-block">Metode Pembayaran</small>
                    <span class="badge bg-info text-dark px-3 py-1 fw-bold">
                        <?php echo e($penjualan->metode_pembayaran ?? '-'); ?>

                    </span>
                </div>
                <div class="col-md-3">
                    <small class="text-muted d-block">Status</small>
                    <span class="badge <?php echo e($penjualan->status == 'COMPLETED' ? 'bg-success' : 'bg-warning text-dark'); ?> px-3 py-1">
                        <?php echo e($penjualan->status); ?>

                    </span>
                </div>
            </div>
        </div>
    </div>

    
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3 no-print">Daftar Produk</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light border-dashed">
                        <tr>
                            <th class="no-print" style="width: 40px;">#</th>
                            <th>Nama Produk</th>
                            <th class="text-end">Harga Satuan</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $penjualan->itemPenjualan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="no-print"><?php echo e($index + 1); ?></td>
                            <td><?php echo e($item->produk->nama ?? 'Produk Dihapus'); ?></td>
                            <td class="text-end">Rp <?php echo e(number_format($item->harga_satuan, 0, ',', '.')); ?></td>
                            <td class="text-center"><?php echo e($item->kuantitas); ?></td>
                            <td class="text-end fw-bold">Rp <?php echo e(number_format($item->subtotal, 0, ',', '.')); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">Tidak ada item produk pada transaksi ini.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot class="border-double">
                        <tr class="table-primary fw-bold fs-5">
                            <td colspan="3" class="text-end py-2">Total Pembayaran:</td>
                            <td colspan="2" class="text-end py-2">Rp <?php echo e(number_format($penjualan->total_pembayaran, 0, ',', '.')); ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            
            <div class="d-none d-print-block text-center mt-3 pt-2 border-dashed">
                <p class="mb-1" style="font-size: 8pt;">*** Terima Kasih ***</p>
                <p class="mb-0" style="font-size: 7pt;">Barang yang sudah dibeli tidak dapat ditukar/dikembalikan.</p>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pos_saca\resources\views/penjualan/show.blade.php ENDPATH**/ ?>