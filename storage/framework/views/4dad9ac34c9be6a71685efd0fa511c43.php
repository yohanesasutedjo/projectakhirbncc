<?php $__env->startSection('title','Riwayat Faktur - TokoKu'); ?>
<?php $__env->startSection('page-title','Riwayat Faktur'); ?>
<?php $__env->startSection('content'); ?>
<div class="card">
  <div class="card-header d-flex align-items-center"><i class="bi bi-clock-history me-2"></i>Riwayat Faktur Saya<span class="badge bg-primary ms-2"><?php echo e($invoices->total()); ?></span></div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table mb-0">
        <thead><tr><th>#</th><th>No. Invoice</th><th>Tanggal</th><th>Jumlah Item</th><th>Total</th><th>Aksi</th></tr></thead>
        <tbody>
          <?php $__empty_1 = true; $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr>
            <td class="text-muted"><?php echo e($invoices->firstItem()+$i); ?></td>
            <td><span class="fw-bold text-primary"><?php echo e($inv->invoice_number); ?></span></td>
            <td class="small text-muted"><?php echo e($inv->created_at->format('d M Y, H:i')); ?></td>
            <td><span class="badge bg-light text-dark border"><?php echo e($inv->invoiceItems->count()); ?> item</span></td>
            <td class="fw-bold text-primary">Rp. <?php echo e(number_format($inv->total_price,0,',','.')); ?></td>
            <td>
              <a href="<?php echo e(route('user.invoice.show',$inv)); ?>" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-eye"></i></a>
              <a href="<?php echo e(route('user.invoice.print',$inv)); ?>" target="_blank" class="btn btn-sm btn-outline-success"><i class="bi bi-printer"></i></a>
            </td>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><tr><td colspan="6" class="text-center text-muted py-5"><i class="bi bi-receipt fs-1 d-block mb-2"></i>Belum ada faktur. Mulai belanja dari <a href="<?php echo e(route('user.catalog')); ?>">katalog</a>.</td></tr><?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php if($invoices->hasPages()): ?><div class="card-footer bg-white d-flex justify-content-end"><?php echo e($invoices->links('pagination::bootstrap-5')); ?></div><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XAMPP\htdocs\files\tokoku\resources\views/user/invoice/history.blade.php ENDPATH**/ ?>