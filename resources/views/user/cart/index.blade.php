@extends('layouts.app')
@section('title','Keranjang - TokoKu')
@section('page-title','Keranjang Belanja')
@section('content')
@if(empty($cart))
<div class="text-center py-5"><i class="bi bi-cart-x fs-1 text-muted d-block mb-3"></i><h5 class="text-muted">Keranjang Kosong</h5><p class="text-muted">Tambahkan barang dari katalog terlebih dahulu.</p><a href="{{ route('user.catalog') }}" class="btn btn-primary"><i class="bi bi-grid me-2"></i>Lihat Katalog</a></div>
@else
<div class="row g-3">
  <div class="col-lg-8">
    <div class="card">
      <div class="card-header d-flex align-items-center"><i class="bi bi-cart3 me-2"></i>Item Keranjang<span class="badge bg-primary ms-2">{{ count($cart) }}</span>
        <form action="{{ route('user.cart.clear') }}" method="POST" class="ms-auto" onsubmit="return confirm('Kosongkan keranjang?')">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash me-1"></i>Kosongkan</button></form>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table mb-0">
            <thead><tr><th>Barang</th><th>Harga</th><th width="130">Qty</th><th>Subtotal</th><th width="60"></th></tr></thead>
            <tbody>
              @foreach($cart as $id => $item)
              <tr>
                <td>
                  <div class="d-flex align-items-center gap-2">
                    @if($item['image'] && file_exists(public_path('images/items/'.$item['image'])))<img src="{{ asset('images/items/'.$item['image']) }}" class="item-thumb">@else<div class="item-thumb d-flex align-items-center justify-content-center bg-light rounded"><i class="bi bi-image text-muted"></i></div>@endif
                    <div><div class="fw-500 small">{{ $item['name'] }}</div><small class="text-muted">{{ $item['category_name'] }}</small></div>
                  </div>
                </td>
                <td class="text-primary fw-bold small">Rp. {{ number_format($item['price'],0,',','.') }}</td>
                <td>
                  <form action="{{ route('user.cart.update',$id) }}" method="POST" class="d-flex gap-1">@csrf @method('PATCH')
                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="{{ $item['stock'] }}" class="form-control form-control-sm text-center" style="width:60px">
                    <button type="submit" class="btn btn-sm btn-outline-primary"><i class="bi bi-check2"></i></button>
                  </form>
                </td>
                <td class="fw-bold small">Rp. {{ number_format($item['subtotal'],0,',','.') }}</td>
                <td><form action="{{ route('user.cart.remove',$id) }}" method="POST">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-x-lg"></i></button></form></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card">
      <div class="card-header"><i class="bi bi-calculator me-2"></i>Ringkasan</div>
      <div class="card-body">
        @php $total=collect($cart)->sum('subtotal'); @endphp
        <table class="table table-borderless table-sm">
          @foreach($cart as $item)<tr><td class="text-muted small">{{ Str::limit($item['name'],22) }} x{{ $item['quantity'] }}</td><td class="text-end small fw-500">Rp. {{ number_format($item['subtotal'],0,',','.') }}</td></tr>@endforeach
          <tr><td colspan="2"><hr class="my-1"></td></tr>
          <tr><td class="fw-bold">Total</td><td class="text-end fw-bold text-primary fs-6">Rp. {{ number_format($total,0,',','.') }}</td></tr>
        </table>
        <a href="{{ route('user.invoice.index') }}" class="btn btn-primary w-100 mt-2"><i class="bi bi-receipt me-2"></i>Proses ke Faktur</a>
        <a href="{{ route('user.catalog') }}" class="btn btn-outline-secondary w-100 mt-2"><i class="bi bi-arrow-left me-1"></i>Lanjut Belanja</a>
      </div>
    </div>
  </div>
</div>
@endif
@endsection
