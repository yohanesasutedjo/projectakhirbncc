<?php $__env->startSection('title','Katalog Barang - TokoKu'); ?>
<?php $__env->startSection('page-title','Katalog Barang'); ?>
<?php $__env->startSection('content'); ?>
<div class="card mb-4">
  <div class="card-body py-2">
    <form action="<?php echo e(route('user.catalog')); ?>" method="GET" class="d-flex flex-wrap gap-2 align-items-center">
      <input type="text" name="search" class="form-control form-control-sm" style="max-width:220px" placeholder="Cari barang..." value="<?php echo e(request('search')); ?>">
      <select name="category" class="form-select form-select-sm" style="max-width:180px">
        <option value="">Semua Kategori</option>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($cat->id); ?>" <?php echo e(request('category')==$cat->id?'selected':''); ?>><?php echo e($cat->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
      <button type="submit" class="btn btn-sm btn-primary"><i class="bi bi-search me-1"></i>Cari</button>
      <?php if(request('search')||request('category')): ?><a href="<?php echo e(route('user.catalog')); ?>" class="btn btn-sm btn-outline-secondary"><i class="bi bi-x-lg"></i>Reset</a><?php endif; ?>
      <a href="<?php echo e(route('user.cart')); ?>" class="btn btn-sm btn-outline-primary ms-auto position-relative">
        <i class="bi bi-cart3 me-1"></i>Keranjang
        <?php $cc=count(session('cart',[])); ?>
        <?php if($cc>0): ?><span class="badge bg-danger ms-1"><?php echo e($cc); ?></span><?php endif; ?>
      </a>
    </form>
  </div>
</div>

<div class="row g-3">
  <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
  <div class="col-6 col-md-4 col-lg-3">
    <div class="catalog-card card h-100">
      <div class="position-relative">
        <?php if($item->image && file_exists(public_path('images/items/'.$item->image))): ?>
          <img src="<?php echo e(asset('images/items/'.$item->image)); ?>" class="catalog-img" alt="<?php echo e($item->name); ?>">
        <?php else: ?>
          <div class="catalog-img d-flex align-items-center justify-content-center bg-light"><i class="bi bi-image text-muted fs-2"></i></div>
        <?php endif; ?>
        <?php if($item->isOutOfStock()): ?>
          <div class="out-of-stock-overlay"><span class="badge bg-danger fs-6 px-3 py-2"><i class="bi bi-x-circle me-1"></i>Stok Habis</span></div>
        <?php endif; ?>
        <span class="badge bg-primary position-absolute" style="top:8px;left:8px;opacity:.9"><?php echo e($item->category->name); ?></span>
      </div>
      <div class="card-body d-flex flex-column p-3">
        <h6 class="fw-bold mb-1 text-dark" style="font-size:.875rem;line-height:1.3"><?php echo e($item->name); ?></h6>
        <div class="catalog-price mb-1"><?php echo e($item->formatted_price); ?></div>
        <small class="mb-3"><?php if($item->isOutOfStock()): ?><span class="text-danger">Stok: Habis</span><?php else: ?><span class="text-success">Stok: <?php echo e($item->quantity); ?></span><?php endif; ?></small>
        <?php if($item->isOutOfStock()): ?>
          <div class="alert alert-danger py-2 px-2 mb-0 text-center mt-auto" style="font-size:.78rem">
            <i class="bi bi-exclamation-triangle-fill me-1"></i>Barang sudah habis, silakan tunggu hingga barang di-restock ulang
          </div>
        <?php else: ?>
          <form action="<?php echo e(route('user.cart.add',$item)); ?>" method="POST" class="mt-auto"><?php echo csrf_field(); ?>
            <div class="input-group input-group-sm mb-2">
              <span class="input-group-text bg-light">Qty</span>
              <input type="number" name="quantity" value="1" min="1" max="<?php echo e($item->quantity); ?>" class="form-control text-center">
            </div>
            <button type="submit" class="btn btn-primary btn-sm w-100"><i class="bi bi-cart-plus me-1"></i>Tambah ke Keranjang</button>
          </form>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
  <div class="col-12"><div class="text-center py-5 text-muted"><i class="bi bi-search fs-1 d-block mb-3"></i><h5>Barang tidak ditemukan</h5><p>Coba ubah kata kunci pencarian.</p><a href="<?php echo e(route('user.catalog')); ?>" class="btn btn-outline-primary">Reset Pencarian</a></div></div>
  <?php endif; ?>
</div>
<?php if($items->hasPages()): ?><div class="mt-4 d-flex justify-content-center"><?php echo e($items->withQueryString()->links('pagination::bootstrap-5')); ?></div><?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XAMPP\htdocs\files\tokoku\resources\views/user/catalog/index.blade.php ENDPATH**/ ?>