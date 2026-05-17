<?php $__env->startSection('title','Buat Faktur - TokoKu'); ?>
<?php $__env->startSection('page-title','Buat Faktur'); ?>
<?php $__env->startSection('content'); ?>
<div class="row g-3">
  <div class="col-lg-7">
    <div class="card">
      <div class="card-header"><i class="bi bi-geo-alt me-2"></i>Data Pengiriman</div>
      <div class="card-body">
        <form action="<?php echo e(route('user.invoice.store')); ?>" method="POST"><?php echo csrf_field(); ?>
          <div class="mb-3">
            <label class="form-label">Alamat Pengiriman <span class="text-danger">*</span></label>
            <textarea name="shipping_address" rows="3" class="form-control <?php $__errorArgs = ['shipping_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Masukkan alamat lengkap..." minlength="10" maxlength="100" required id="addr"><?php echo e(old('shipping_address')); ?></textarea>
            <?php $__errorArgs = ['shipping_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <div class="form-text d-flex justify-content-between"><span>Min 10, maks 100 karakter</span><span id="ac" class="text-muted">0/100</span></div>
          </div>
          <div class="mb-4">
            <label class="form-label">Kode Pos <span class="text-danger">*</span></label>
            <input type="text" name="postal_code" id="pc" class="form-control <?php $__errorArgs = ['postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="12345" pattern="[0-9]{5}" maxlength="5" value="<?php echo e(old('postal_code')); ?>" required>
            <?php $__errorArgs = ['postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <div class="form-text">Harus tepat 5 digit angka</div>
          </div>
          <button type="submit" class="btn btn-primary w-100 py-2 fw-bold" onclick="return confirm('Pastikan data sudah benar. Buat faktur?')"><i class="bi bi-receipt me-2"></i>Buat Faktur Sekarang</button>
        </form>
      </div>
    </div>
  </div>
  <div class="col-lg-5">
    <div class="card">
      <div class="card-header"><i class="bi bi-list-check me-2"></i>Ringkasan Pesanan</div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table mb-0">
            <thead><tr><th>Barang</th><th class="text-end">Subtotal</th></tr></thead>
            <tbody>
              <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><div class="fw-500 small"><?php echo e($item['name']); ?></div><small class="text-muted"><?php echo e($item['category_name']); ?> &bull; x<?php echo e($item['quantity']); ?> &bull; Rp. <?php echo e(number_format($item['price'],0,',','.')); ?></small></td>
                <td class="text-end fw-bold small text-nowrap">Rp. <?php echo e(number_format($item['subtotal'],0,',','.')); ?></td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot><tr class="table-light"><td class="fw-bold">Total</td><td class="text-end fw-bold text-primary fs-6 text-nowrap">Rp. <?php echo e(number_format($total,0,',','.')); ?></td></tr></tfoot>
          </table>
        </div>
      </div>
    </div>
    <div class="mt-2"><a href="<?php echo e(route('user.cart')); ?>" class="btn btn-outline-secondary w-100"><i class="bi bi-arrow-left me-1"></i>Kembali ke Keranjang</a></div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
const a=document.getElementById('addr'),ac=document.getElementById('ac');
a.addEventListener('input',()=>ac.textContent=a.value.length+'/100');
ac.textContent=a.value.length+'/100';
document.getElementById('pc').addEventListener('input',function(){this.value=this.value.replace(/\D/g,'').slice(0,5);});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\XAMPP\htdocs\files\tokoku\resources\views/user/invoice/create.blade.php ENDPATH**/ ?>