@extends('layouts.app')
@section('title','Katalog Barang - TokoKu')
@section('page-title','Katalog Barang')
@section('content')
<div class="card mb-4">
  <div class="card-body py-2">
    <form action="{{ route('user.catalog') }}" method="GET" class="d-flex flex-wrap gap-2 align-items-center">
      <input type="text" name="search" class="form-control form-control-sm" style="max-width:220px" placeholder="Cari barang..." value="{{ request('search') }}">
      <select name="category" class="form-select form-select-sm" style="max-width:180px">
        <option value="">Semua Kategori</option>
        @foreach($categories as $cat)<option value="{{ $cat->id }}" {{ request('category')==$cat->id?'selected':'' }}>{{ $cat->name }}</option>@endforeach
      </select>
      <button type="submit" class="btn btn-sm btn-primary"><i class="bi bi-search me-1"></i>Cari</button>
      @if(request('search')||request('category'))<a href="{{ route('user.catalog') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-x-lg"></i>Reset</a>@endif
      <a href="{{ route('user.cart') }}" class="btn btn-sm btn-outline-primary ms-auto position-relative">
        <i class="bi bi-cart3 me-1"></i>Keranjang
        @php $cc=count(session('cart',[])); @endphp
        @if($cc>0)<span class="badge bg-danger ms-1">{{ $cc }}</span>@endif
      </a>
    </form>
  </div>
</div>

<div class="row g-3">
  @forelse($items as $item)
  <div class="col-6 col-md-4 col-lg-3">
    <div class="catalog-card card h-100">
      <div class="position-relative">
        @if($item->image && file_exists(public_path('images/items/'.$item->image)))
          <img src="{{ asset('images/items/'.$item->image) }}" class="catalog-img" alt="{{ $item->name }}">
        @else
          <div class="catalog-img d-flex align-items-center justify-content-center bg-light"><i class="bi bi-image text-muted fs-2"></i></div>
        @endif
        @if($item->isOutOfStock())
          <div class="out-of-stock-overlay"><span class="badge bg-danger fs-6 px-3 py-2"><i class="bi bi-x-circle me-1"></i>Stok Habis</span></div>
        @endif
        <span class="badge bg-primary position-absolute" style="top:8px;left:8px;opacity:.9">{{ $item->category->name }}</span>
      </div>
      <div class="card-body d-flex flex-column p-3">
        <h6 class="fw-bold mb-1 text-dark" style="font-size:.875rem;line-height:1.3">{{ $item->name }}</h6>
        <div class="catalog-price mb-1">{{ $item->formatted_price }}</div>
        <small class="mb-3">@if($item->isOutOfStock())<span class="text-danger">Stok: Habis</span>@else<span class="text-success">Stok: {{ $item->quantity }}</span>@endif</small>
        @if($item->isOutOfStock())
          <div class="alert alert-danger py-2 px-2 mb-0 text-center mt-auto" style="font-size:.78rem">
            <i class="bi bi-exclamation-triangle-fill me-1"></i>Barang sudah habis, silakan tunggu hingga barang di-restock ulang
          </div>
        @else
          <form action="{{ route('user.cart.add',$item) }}" method="POST" class="mt-auto">@csrf
            <div class="input-group input-group-sm mb-2">
              <span class="input-group-text bg-light">Qty</span>
              <input type="number" name="quantity" value="1" min="1" max="{{ $item->quantity }}" class="form-control text-center">
            </div>
            <button type="submit" class="btn btn-primary btn-sm w-100"><i class="bi bi-cart-plus me-1"></i>Tambah ke Keranjang</button>
          </form>
        @endif
      </div>
    </div>
  </div>
  @empty
  <div class="col-12"><div class="text-center py-5 text-muted"><i class="bi bi-search fs-1 d-block mb-3"></i><h5>Barang tidak ditemukan</h5><p>Coba ubah kata kunci pencarian.</p><a href="{{ route('user.catalog') }}" class="btn btn-outline-primary">Reset Pencarian</a></div></div>
  @endforelse
</div>
@if($items->hasPages())<div class="mt-4 d-flex justify-content-center">{{ $items->withQueryString()->links('pagination::bootstrap-5') }}</div>@endif
@endsection
