


<nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm sticky-top">
  <div class="container-fluid">
    
    <a class="navbar-brand fw-bold d-flex align-items-center gap-2 <?php echo e(Request::is('perusahaan*') ? 'text-primary' : ''); ?>" href="<?php echo e(route('perusahaan.index')); ?>">
      <i class="bi bi-shop fs-4 text-primary"></i>
      <span>Toko Cafca</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-1">
        
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-1 <?php echo e(Request::is('dashboard') ? 'active fw-semibold' : ''); ?>" aria-current="page" href="<?php echo e(route('dashboard')); ?>">
            <i class="bi bi-speedometer2"></i> Dashboard
          </a>
        </li>

        
        <?php if(strtolower(auth()->user()->role?->name) === 'admin'): ?>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-1 <?php echo e(Request::is('admin/users*') ? 'active fw-semibold' : ''); ?>" href="<?php echo e(route('admin.users')); ?>">
            <i class="bi bi-people"></i> Users
          </a>
        </li>
        <?php endif; ?>

        
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-1 <?php echo e(Request::is('jenis-produk*') ? 'active fw-semibold' : ''); ?>" href="<?php echo e(route('jenis-produk.index')); ?>">
            <i class="bi bi-tags"></i> Jenis Produk
          </a>
        </li>

        
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-1 <?php echo e(Request::is('produk*') ? 'active fw-semibold' : ''); ?>" href="<?php echo e(route('produk.index')); ?>">
            <i class="bi bi-box-seam"></i> Produk
          </a>
        </li>

        
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-1 <?php echo e(Request::is('penjualan*') ? 'active fw-semibold' : ''); ?>" href="<?php echo e(route('penjualan.index')); ?>">
            <i class="bi bi-cart-check"></i> Penjualan
          </a>
        </li>

        
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-1 <?php echo e(Request::is('tentang*') ? 'active fw-semibold' : ''); ?>" href="<?php echo e(route('tentang.index')); ?>">
            <i class="bi bi-info-circle"></i> Tentang
          </a>
        </li>
      </ul>

      
      <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-flex">
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn btn-danger d-flex align-items-center gap-1">
          <i class="bi bi-box-arrow-right"></i> Logout
        </button>
      </form>
    </div>
  </div>
</nav>


<div class="container mt-4">
  <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3 shadow-sm">
    <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white"
         style="width:48px;height:48px;">
      <i class="bi bi-person-fill fs-4"></i>
    </div>
    <div>
      <?php if(strtolower(auth()->user()->role?->name) === 'admin'): ?>
        <span class="badge bg-primary mb-1"><i class="bi bi-shield-lock"></i> Admin</span>
        <h5 class="mb-0"><?php echo e(auth()->user()->name); ?></h5>
      <?php else: ?>
        <span class="badge bg-secondary mb-1"><i class="bi bi-person-badge"></i> Kasir</span>
        <h5 class="mb-0"><?php echo e(auth()->user()->name); ?></h5>
      <?php endif; ?>
    </div>
  </div>
</div>

<style>
.navbar-nav .nav-link {
  border-radius: 8px;
  padding: 0.5rem 0.9rem;
  transition: background-color 0.2s ease, color 0.2s ease;
}
.navbar-nav .nav-link:hover {
  background-color: rgba(13, 110, 253, 0.08);
  color: #0d6efd;
}
.navbar-nav .nav-link.active {
  background-color: rgba(13, 110, 253, 0.12);
  color: #0d6efd !important;
}
</style><?php /**PATH C:\laragon\www\pos_saca\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>