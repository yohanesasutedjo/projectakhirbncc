@extends('layouts.app')
@section('title','Buat Faktur - TokoKu')
@section('page-title','Buat Faktur')
@section('content')
<div class="row g-3">
  <div class="col-lg-7">
    <div class="card">
      <div class="card-header"><i class="bi bi-geo-alt me-2"></i>Data Pengiriman</div>
      <div class="card-body">
        <form action="{{ route('user.invoice.store') }}" method="POST">@csrf
          <div class="mb-3">
            <label class="form-label">Alamat Pengiriman <span class="text-danger">*</span></label>
            <textarea name="shipping_address" rows="3" class="form-control @error('shipping_address') is-invalid @enderror" placeholder="Masukkan alamat lengkap..." minlength="10" maxlength="100" required id="addr">{{ old('shipping_address') }}</textarea>
            @error('shipping_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
            <div class="form-text d-flex justify-content-between"><span>Min 10, maks 100 karakter</span><span id="ac" class="text-muted">0/100</span></div>
          </div>
          <div class="mb-4">
            <label class="form-label">Kode Pos <span class="text-danger">*</span></label>
            <input type="text" name="postal_code" id="pc" class="form-control @error('postal_code') is-invalid @enderror" placeholder="12345" pattern="[0-9]{5}" maxlength="5" value="{{ old('postal_code') }}" required>
            @error('postal_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
              @foreach($cart as $item)
              <tr>
                <td><div class="fw-500 small">{{ $item['name'] }}</div><small class="text-muted">{{ $item['category_name'] }} &bull; x{{ $item['quantity'] }} &bull; Rp. {{ number_format($item['price'],0,',','.') }}</small></td>
                <td class="text-end fw-bold small text-nowrap">Rp. {{ number_format($item['subtotal'],0,',','.') }}</td>
              </tr>
              @endforeach
            </tbody>
            <tfoot><tr class="table-light"><td class="fw-bold">Total</td><td class="text-end fw-bold text-primary fs-6 text-nowrap">Rp. {{ number_format($total,0,',','.') }}</td></tr></tfoot>
          </table>
        </div>
      </div>
    </div>
    <div class="mt-2"><a href="{{ route('user.cart') }}" class="btn btn-outline-secondary w-100"><i class="bi bi-arrow-left me-1"></i>Kembali ke Keranjang</a></div>
  </div>
</div>
@endsection
@push('scripts')
<script>
const a=document.getElementById('addr'),ac=document.getElementById('ac');
a.addEventListener('input',()=>ac.textContent=a.value.length+'/100');
ac.textContent=a.value.length+'/100';
document.getElementById('pc').addEventListener('input',function(){this.value=this.value.replace(/\D/g,'').slice(0,5);});
</script>
@endpush
