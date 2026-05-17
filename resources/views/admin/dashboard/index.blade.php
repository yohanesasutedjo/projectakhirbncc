@extends('layouts.app')
@section('title','Dashboard Admin - TokoKu')
@section('page-title','Dashboard Admin')
@section('content')
<div class="row g-3 mb-4">
  @foreach([['totalItems','bi-box-seam','primary','Total Barang'],['totalCategories','bi-tags','success','Kategori'],['totalInvoices','bi-receipt','warning','Total Faktur'],['totalUsers','bi-people','info','Pengguna']] as [$var,$icon,$color,$label])
  <div class="col-6 col-md-3">
    <div class="stat-card">
      <div class="stat-icon bg-{{ $color }} bg-opacity-10 mb-2"><i class="bi {{ $icon }} text-{{ $color }}"></i></div>
      <div class="stat-value">{{ $$var }}</div>
      <div class="stat-label">{{ $label }}</div>
    </div>
  </div>
  @endforeach
</div>
@if($lowStockItems->count() > 0)
<div class="card mb-3">
  <div class="card-header d-flex align-items-center gap-2"><i class="bi bi-exclamation-triangle text-warning"></i>Stok Rendah<span class="badge bg-warning text-dark ms-auto">{{ $lowStockItems->count() }}</span></div>
  <div class="card-body p-0">
    <table class="table mb-0">
      <thead><tr><th>Nama Barang</th><th>Kategori</th><th>Stok</th><th>Aksi</th></tr></thead>
      <tbody>@foreach($lowStockItems as $item)<tr>
        <td class="fw-500">{{ $item->name }}</td>
        <td>{{ $item->category->name ?? '-' }}</td>
        <td>@if($item->quantity==0)<span class="badge bg-danger">Habis</span>@else<span class="badge bg-warning text-dark">{{ $item->quantity }}</span>@endif</td>
        <td><a href="{{ route('admin.items.edit',$item) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i> Edit</a></td>
      </tr>@endforeach</tbody>
    </table>
  </div>
</div>
@endif
<div class="card">
  <div class="card-header d-flex align-items-center"><i class="bi bi-clock-history me-2"></i>Barang Terbaru<a href="{{ route('admin.items.index') }}" class="btn btn-sm btn-outline-primary ms-auto">Lihat Semua</a></div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table mb-0">
        <thead><tr><th>Foto</th><th>Nama Barang</th><th>Kategori</th><th>Harga</th><th>Stok</th></tr></thead>
        <tbody>
          @forelse($recentItems as $item)
          <tr>
            <td>@if($item->image && file_exists(public_path('images/items/'.$item->image)))<img src="{{ asset('images/items/'.$item->image) }}" class="item-thumb" alt="">@else<div class="item-thumb d-flex align-items-center justify-content-center bg-light"><i class="bi bi-image text-muted"></i></div>@endif</td>
            <td class="fw-500">{{ $item->name }}</td>
            <td><span class="badge bg-primary bg-opacity-10 text-primary">{{ $item->category->name }}</span></td>
            <td class="text-primary fw-bold">{{ $item->formatted_price }}</td>
            <td>@if($item->quantity==0)<span class="badge bg-danger">Habis</span>@elseif($item->quantity<=5)<span class="badge bg-warning text-dark">{{ $item->quantity }}</span>@else<span class="badge bg-success">{{ $item->quantity }}</span>@endif</td>
          </tr>
          @empty<tr><td colspan="5" class="text-center text-muted py-4">Belum ada barang.</td></tr>@endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
