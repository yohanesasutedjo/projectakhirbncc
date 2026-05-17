<?php $__env->startSection('title','Dashboard Admin - TokoKu'); ?>
<?php $__env->startSection('page-title','Dashboard Admin'); ?>
<?php $__env->startSection('content'); ?>
<div class="row g-3 mb-4">
  <?php $__currentLoopData = [['totalItems','bi-box-seam','primary','Total Barang'],['totalCategories','bi-tags','success','Kategori'],['totalInvoices','bi-receipt','warning','Total Faktur'],['totalUsers','bi-people','info','Pengguna']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$var,$icon,$color,$label]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="col-6 col-md-3">
    <div class="stat-card">
      <div class="stat-icon bg-<?php echo e($color); ?> bg-opacity-10 mb-2"><i class="bi <?php echo e($icon); ?> text-<?php echo e($color); ?>"></i></div>
      <div class="stat-value"><?php echo e($$var); ?></div>
      <div class="stat-label"><?php echo e($label); ?></div>
    </div>
  </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php if($lowStockItems->count() > 0): ?>
<div class="card mb-3">
  <div class="card-header d-flex align-items-center gap-2"><i class="bi bi-exclamation-triangle text-warning"></i>Stok Rendah<span class="badge bg-warning text-dark ms-auto"><?php echo e($lowStockItems->count()); ?></span></div>
  <div class="card-body p-0">
    <table class="table mb-0">
      <thead><tr><th>Nama Barang</th><th>Kategori</th><th>Stok</th><th>Aksi</th></tr></thead>
      <tbody><?php $__currentLoopData = $lowStockItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><tr>
        <td class="fw-500"><?php echo e($item->name); ?></td>
        <td><?php echo e($item->category->name ?? '-'); ?></td>
        <td><?php if($item->quantity==0): ?><span class="badge bg-danger">Habis</span><?php else: ?><span class="badge bg-warning text-dark"><?php echo e($item->quantity); ?></span><?php endif; ?></td>
        <td><a href="<?php echo e(route('admin.items.edit',$item)); ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i> Edit</a></td>
      </tr><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></tbody>
    </table>
  </div>
</div>
<?php endif; ?>
<div class="card">
  <div class="card-header d-flex align-items-center"><i class="bi bi-clock-history me-2"></i>Barang Terbaru<a href="<?php echo e(route('admin.items.index')); ?>" class="btn btn-sm btn-outline-primary ms-auto">Lihat Semua</a></div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table mb-0">
        <thead><tr><th>Foto</th><th>Nama Barang</th><th>Kategori</th><th>Harga</th><th>Stok</th></tr></thead>
        <tbody>
          <?php $__empty_1 = true; $__currentLoopData = $recentItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr>
            <td><?php if($item->image && file_exists(public_path('images/items/'.$item->image))): ?><img src="<?php echo e(asset('images/items/'.$item->image)); ?>" class="item-thumb" alt=""><?php else: ?><div class="item-thumb d-flex align-items-center justify-content-center bg-light"><i class="bi bi-image text-muted"></i></div><?php endif; ?></td>
            <td class="fw-500"><?php echo e($item->name); ?></td>
            <td><span class="badge bg-primary bg-opacity-10 text-primary"><?php echo e($item->category->name); ?></span></td>
            <td class="text-primary fw-bold"><?php echo e($item->formatted_price); ?></td>
            <td><?php if($item->quantity==0): ?><span class="badge bg-danger">Habis</span><?php elseif($item->quantity<=5): ?><span class="badge bg-warning text-dark"><?php echo e($item->quantity); ?></span><?php else: ?><span class="badge bg-success"><?php echo e($item->quantity); ?></span><?php endif; ?></td>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="5" class="text-center text-muted py-4">Belum ada barang.</td></tr><?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XAMPP\htdocs\files\tokoku\resources\views/admin/dashboard/index.blade.php ENDPATH**/ ?>