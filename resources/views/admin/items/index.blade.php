@extends('layouts.app')
@section('title','Data Barang - Admin')
@section('page-title','Data Barang')
@section('content')
<div class="card mb-3">
  <div class="card-body py-2">
    <form action="{{ route('admin.items.index') }}" method="GET" class="d-flex flex-wrap gap-2 align-items-center">
      <input type="text" name="search" class="form-control form-control-sm" style="max-width:220px" placeholder="Cari nama barang..." value="{{ request('search') }}">
      <select name="category" class="form-select form-select-sm" style="max-width:180px">
        <option value="">Semua Kategori</option>
        @foreach($categories as $cat)<option value="{{ $cat->id }}" {{ request('category')==$cat->id?'selected':'' }}>{{ $cat->name }}</option>@endforeach
      </select>
      <button type="submit" class="btn btn-sm btn-primary"><i class="bi bi-search me-1"></i>Filter</button>
      @if(request('search')||request('category'))<a href="{{ route('admin.items.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-x-lg"></i>Reset</a>@endif
      <a href="{{ route('admin.items.create') }}" class="btn btn-sm btn-success ms-auto"><i class="bi bi-plus-lg me-1"></i>Tambah Barang</a>
    </form>
  </div>
</div>
<div class="card">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table mb-0">
        <thead><tr><th>#</th><th>Foto</th><th>Nama Barang</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr></thead>
        <tbody>
          @forelse($items as $i => $item)
          <tr class="{{ $item->isOutOfStock()?'table-danger':'' }}">
            <td class="text-muted">{{ $items->firstItem()+$i }}</td>
            <td>@if($item->image && file_exists(public_path('images/items/'.$item->image)))<img src="{{ asset('images/items/'.$item->image) }}" class="item-thumb">@else<div class="item-thumb d-flex align-items-center justify-content-center bg-light rounded"><i class="bi bi-image text-muted"></i></div>@endif</td>
            <td><span class="fw-500">{{ $item->name }}</span>@if($item->isOutOfStock())<span class="badge bg-danger ms-1">Habis</span>@endif</td>
            <td><span class="badge bg-primary bg-opacity-10 text-primary">{{ $item->category->name ?? '-' }}</span></td>
            <td class="text-primary fw-bold">{{ $item->formatted_price }}</td>
            <td>@if($item->quantity==0)<span class="badge bg-danger">0</span>@elseif($item->quantity<=5)<span class="badge bg-warning text-dark">{{ $item->quantity }}</span>@else<span class="badge bg-success">{{ $item->quantity }}</span>@endif</td>
            <td>
              <a href="{{ route('admin.items.show',$item) }}" class="btn btn-sm btn-outline-info mb-1"><i class="bi bi-eye"></i></a>
              <a href="{{ route('admin.items.edit',$item) }}" class="btn btn-sm btn-outline-warning mb-1"><i class="bi bi-pencil"></i></a>
              <form action="{{ route('admin.items.destroy',$item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus barang ini?')">@csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger mb-1"><i class="bi bi-trash"></i></button>
              </form>
            </td>
          </tr>
          @empty<tr><td colspan="7" class="text-center text-muted py-5"><i class="bi bi-box-seam fs-2 d-block mb-2"></i>Tidak ada barang.</td></tr>@endforelse
        </tbody>
      </table>
    </div>
  </div>
  @if($items->hasPages())<div class="card-footer bg-white d-flex justify-content-between align-items-center"><small class="text-muted">{{ $items->firstItem() }}-{{ $items->lastItem() }} dari {{ $items->total() }}</small>{{ $items->withQueryString()->links('pagination::bootstrap-5') }}</div>@endif
</div>
@endsection
