<?php $__env->startSection('title','Faktur #'.$invoice->invoice_number); ?>
<?php $__env->startSection('page-title','Detail Faktur'); ?>
<?php $__env->startSection('content'); ?>
<div class="row justify-content-center"><div class="col-lg-9">
  <div class="d-flex gap-2 mb-3">
    <a href="<?php echo e(route('user.invoice.print',$invoice)); ?>" target="_blank" class="btn btn-primary"><i class="bi bi-printer me-2"></i>Cetak Faktur</a>
    <a href="<?php echo e(route('user.invoice.history')); ?>" class="btn btn-outline-secondary"><i class="bi bi-clock-history me-1"></i>Riwayat</a>
    <a href="<?php echo e(route('user.catalog')); ?>" class="btn btn-outline-primary ms-auto"><i class="bi bi-grid me-1"></i>Belanja Lagi</a>
  </div>
  <div class="card">
    <div class="card-body border-bottom" style="background:linear-gradient(135deg,#2563eb,#7c3aed);border-radius:12px 12px 0 0">
      <div class="d-flex justify-content-between align-items-start">
        <div><h5 class="text-white fw-bold mb-1"><i class="bi bi-shop me-2"></i>TokoKu</h5><small class="text-white-50">Sistem Pendataan Barang</small></div>
        <span class="badge bg-white text-primary fs-6 px-3 py-2">FAKTUR</span>
      </div>
    </div>
    <div class="card-body">
      <div class="row g-3 mb-4">
        <div class="col-sm-6"><small class="text-muted d-block mb-1 fw-500">No. Invoice</small><span class="fw-bold text-primary fs-6"><?php echo e($invoice->invoice_number); ?></span></div>
        <div class="col-sm-6 text-sm-end"><small class="text-muted d-block mb-1 fw-500">Tanggal</small><span class="fw-500"><?php echo e($invoice->created_at->format('d M Y, H:i')); ?></span></div>
        <div class="col-sm-6"><small class="text-muted d-block mb-1 fw-500">Nama Pelanggan</small><span class="fw-500"><?php echo e($invoice->user->name); ?></span></div>
        <div class="col-sm-6 text-sm-end"><small class="text-muted d-block mb-1 fw-500">No. HP</small><span class="fw-500"><?php echo e($invoice->user->phone); ?></span></div>
        <div class="col-12"><small class="text-muted d-block mb-1 fw-500">Alamat Pengiriman</small><span class="fw-500"><?php echo e($invoice->shipping_address); ?></span><span class="text-muted"> &mdash; <?php echo e($invoice->postal_code); ?></span></div>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead class="table-light"><tr><th>#</th><th>Kategori</th><th>Nama Barang</th><th class="text-center">Qty</th><th class="text-end">Harga</th><th class="text-end">Subtotal</th></tr></thead>
          <tbody>
            <?php $__currentLoopData = $invoice->invoiceItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($i+1); ?></td>
              <td><span class="badge bg-primary bg-opacity-10 text-primary"><?php echo e($inv->category_name); ?></span></td>
              <td class="fw-500"><?php echo e($inv->item_name); ?></td>
              <td class="text-center"><?php echo e($inv->quantity); ?></td>
              <td class="text-end">Rp. <?php echo e(number_format($inv->item_price,0,',','.')); ?></td>
              <td class="text-end fw-bold">Rp. <?php echo e(number_format($inv->subtotal,0,',','.')); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
          <tfoot><tr class="table-light"><td colspan="5" class="text-end fw-bold">TOTAL</td><td class="text-end fw-bold text-primary fs-5">Rp. <?php echo e(number_format($invoice->total_price,0,',','.')); ?></td></tr></tfoot>
        </table>
      </div>
    </div>
  </div>
</div></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XAMPP\htdocs\files\tokoku\resources\views/user/invoice/show.blade.php ENDPATH**/ ?>