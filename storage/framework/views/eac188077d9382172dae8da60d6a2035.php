

<?php $__env->startSection('title', 'Profil Perusahaan'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container my-4">
    
    <div class="card bg-primary text-white border-0 rounded-4 shadow-sm mb-4 overflow-hidden">
        <div class="card-body p-4 p-md-5">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <span class="badge bg-white text-primary fw-bold px-3 py-2 rounded-pill mb-3">
                        <i class="bi bi-building"></i> Profile Toko
                    </span>
                    <h1 class="display-6 fw-bold mb-2">PT Toko Olahraga Cafca</h1>
                    <p class="lead opacity-90 mb-0">
                        Mitra terpercaya penyedia alat dan perlengkapan olahraga berkualitas tinggi di Indonesia.
                    </p>
                </div>
                <div class="col-md-4 text-center text-md-end mt-3 mt-md-0">
                    <i class="bi bi-shop-window display-1 opacity-25"></i>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <h4 class="fw-bold text-dark mb-3">
                        <i class="bi bi-briefcase-fill text-primary me-2"></i>Tentang Perusahaan
                    </h4>
                    <p class="text-secondary leading-relaxed">
                        <strong>PT Toko Olahraga Cafca</strong> adalah perusahaan yang bergerak di bidang ritel dan distribusi alat-alat olahraga. Didesain untuk mendukung gaya hidup sehat masyarakat, kami menghadirkan produk original dari berbagai cabang olahraga seperti fitness, bola, atletik, dan aksesoris pendukungnya.
                    </p>

                    <hr class="my-4 text-muted opacity-25">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 h-100 border-start border-primary border-4">
                                <h5 class="fw-bold text-primary mb-2">Visi</h5>
                                <p class="small text-muted mb-0">Menjadi pusat penyedia peralatan olahraga paling lengkap, terpercaya, dan terdepan di Indonesia.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-light rounded-3 h-100 border-start border-success border-4">
                                <h5 class="fw-bold text-success mb-2">Misi</h5>
                                <ul class="small text-muted mb-0 ps-3">
                                    <li>Menyediakan produk original berstandar tinggi.</li>
                                    <li>Memberikan layanan transaksi yang cepat dan akurat.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-dark mb-3">
                        <i class="bi bi-geo-alt-fill text-danger me-2"></i>Informasi Kontak
                    </h5>
                    <ul class="list-unstyled text-secondary small">
                        <li class="mb-3">
                            <strong>Alamat:</strong><br>
                            Jl. K.h No. 123, Tasikmalaya, Jawa Barat
                        </li>
                        <li class="mb-3">
                            <strong>Email:</strong><br>
                            info@toko cafca.com
                        </li>
                        <li class="mb-3">
                            <strong>Telepon:</strong><br>
                            (0265) 1234567
                        </li>
                        <li>
                            <strong>Jam Operasional:</strong><br>
                            Senin - Sabtu: 08.00 - 20.00 WIB
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pos_saca\resources\views/perusahaan/index.blade.php ENDPATH**/ ?>