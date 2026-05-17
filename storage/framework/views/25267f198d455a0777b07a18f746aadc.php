<?php $__env->startSection('title','Kategori - Admin'); ?>
<?php $__env->startSection('page-title','Kategori Barang'); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <div><h6 class="mb-0 fw-bold">Daftar Kategori</h6><small class="text-muted">Total <?php echo e($categories->total()); ?> kategori</small></div>
  <a href="<?php echo e(route('admin.categories.create')); ?>" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Tambah Kategori</a>
</div>
<div class="card">
  <div class="card-body p-0">
    <table class="table mb-0">
      <thead><tr><th>#</th><th>Nama Kategori</th><th>Jumlah Barang</th><th>Dibuat</th><th>Aksi</th></tr></thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td class="text-muted"><?php echo e($categories->firstItem()+$i); ?></td>
          <td class="fw-500"><?php echo e($cat->name); ?></td>
          <td><span class="badge bg-primary bg-opacity-10 text-primary"><?php echo e($cat->items_count); ?> barang</span></td>
          <td class="text-muted small"><?php echo e($cat->created_at->format('d M Y')); ?></td>
          <td>
            <a href="<?php echo e(route('admin.categories.edit',$cat)); ?>" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
            <form action="<?php echo e(route('admin.categories.destroy',$cat)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Hapus kategori ini?')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
              <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
            </form>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="5" class="text-center text-muted py-5"><i class="bi bi-tags fs-2 d-block mb-2"></i>Belum ada kategori. <a href="<?php echo e(route('admin.categories.create')); ?>">Tambah sekarang</a></td></tr><?php endif; ?>
      </tbody>
    </table>
  </div>
  <?php if($categories->hasPages()): ?><div class="card-footer bg-white d-flex justify-content-end"><?php echo e($categories->links('pagination::bootstrap-5')); ?></div><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XAMPP\htdocs\files\tokoku\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>