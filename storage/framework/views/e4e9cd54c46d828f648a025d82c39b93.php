<?php $__env->startSection('title','Data Barang - Admin'); ?>
<?php $__env->startSection('page-title','Data Barang'); ?>
<?php $__env->startSection('content'); ?>
<div class="card mb-3">
  <div class="card-body py-2">
    <form action="<?php echo e(route('admin.items.index')); ?>" method="GET" class="d-flex flex-wrap gap-2 align-items-center">
      <input type="text" name="search" class="form-control form-control-sm" style="max-width:220px" placeholder="Cari nama barang..." value="<?php echo e(request('search')); ?>">
      <select name="category" class="form-select form-select-sm" style="max-width:180px">
        <option value="">Semua Kategori</option>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($cat->id); ?>" <?php echo e(request('category')==$cat->id?'selected':''); ?>><?php echo e($cat->name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
      <button type="submit" class="btn btn-sm btn-primary"><i class="bi bi-search me-1"></i>Filter</button>
      <?php if(request('search')||request('category')): ?><a href="<?php echo e(route('admin.items.index')); ?>" class="btn btn-sm btn-outline-secondary"><i class="bi bi-x-lg"></i>Reset</a><?php endif; ?>
      <a href="<?php echo e(route('admin.items.create')); ?>" class="btn btn-sm btn-success ms-auto"><i class="bi bi-plus-lg me-1"></i>Tambah Barang</a>
    </form>
  </div>
</div>
<div class="card">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table mb-0">
        <thead><tr><th>#</th><th>Foto</th><th>Nama Barang</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr></thead>
        <tbody>
          <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr class="<?php echo e($item->isOutOfStock()?'table-danger':''); ?>">
            <td class="text-muted"><?php echo e($items->firstItem()+$i); ?></td>
            <td><?php if($item->image && file_exists(public_path('images/items/'.$item->image))): ?><img src="<?php echo e(asset('images/items/'.$item->image)); ?>" class="item-thumb"><?php else: ?><div class="item-thumb d-flex align-items-center justify-content-center bg-light rounded"><i class="bi bi-image text-muted"></i></div><?php endif; ?></td>
            <td><span class="fw-500"><?php echo e($item->name); ?></span><?php if($item->isOutOfStock()): ?><span class="badge bg-danger ms-1">Habis</span><?php endif; ?></td>
            <td><span class="badge bg-primary bg-opacity-10 text-primary"><?php echo e($item->category->name ?? '-'); ?></span></td>
            <td class="text-primary fw-bold"><?php echo e($item->formatted_price); ?></td>
            <td><?php if($item->quantity==0): ?><span class="badge bg-danger">0</span><?php elseif($item->quantity<=5): ?><span class="badge bg-warning text-dark"><?php echo e($item->quantity); ?></span><?php else: ?><span class="badge bg-success"><?php echo e($item->quantity); ?></span><?php endif; ?></td>
            <td>
              <a href="<?php echo e(route('admin.items.show',$item)); ?>" class="btn btn-sm btn-outline-info mb-1"><i class="bi bi-eye"></i></a>
              <a href="<?php echo e(route('admin.items.edit',$item)); ?>" class="btn btn-sm btn-outline-warning mb-1"><i class="bi bi-pencil"></i></a>
              <form action="<?php echo e(route('admin.items.destroy',$item)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Hapus barang ini?')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-sm btn-outline-danger mb-1"><i class="bi bi-trash"></i></button>
              </form>
            </td>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="7" class="text-center text-muted py-5"><i class="bi bi-box-seam fs-2 d-block mb-2"></i>Tidak ada barang.</td></tr><?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php if($items->hasPages()): ?><div class="card-footer bg-white d-flex justify-content-between align-items-center"><small class="text-muted"><?php echo e($items->firstItem()); ?>-<?php echo e($items->lastItem()); ?> dari <?php echo e($items->total()); ?></small><?php echo e($items->withQueryString()->links('pagination::bootstrap-5')); ?></div><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XAMPP\htdocs\files\tokoku\resources\views/admin/items/index.blade.php ENDPATH**/ ?>