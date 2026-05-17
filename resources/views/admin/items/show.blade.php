@extends('layouts.app')
@section('title','Detail Barang')
@section('page-title','Detail Barang')
@section('content')
<div class="row justify-content-center"><div class="col-lg-8">
  <div class="card">
    <div class="card-header d-flex align-items-center"><i class="bi bi-info-circle me-2"></i>Detail Barang
      <div class="ms-auto d-flex gap-2">
        <a href="{{ route('admin.items.edit',$item) }}" class="btn btn-sm btn-warning text-white"><i class="bi bi-pencil me-1"></i>Edit</a>
        <form action="{{ route('admin.items.destroy',$item) }}" method="POST" onsubmit="return confirm('Hapus barang?')">@csrf @method('DELETE')
          <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash me-1"></i>Hapus</button>
        </form>
      </div>
    </div>
    <div class="card-body">
      <div class="row g-4">
        <div class="col-md-5 text-center">
          @if($item->image && file_exists(public_path('images/items/'.$item->image)))
            <img src="{{ asset('images/items/'.$item->image) }}" style="width:100%;max-height:250px;object-fit:cover;border-radius:10px">
          @else
            <div class="d-flex align-items-center justify-content-center bg-light rounded" style="height:200px"><div class="text-center text-muted"><i class="bi bi-image fs-1 d-block mb-2"></i><small>Tidak ada foto</small></div></div>
          @endif
        </div>
        <div class="col-md-7">
          <table class="table table-borderless">
            <tr><td class="text-muted fw-500" width="130">Nama Barang</td><td><strong>{{ $item->name }}</strong></td></tr>
            <tr><td class="text-muted fw-500">Kategori</td><td><span class="badge bg-primary bg-opacity-10 text-primary">{{ $item->category->name ?? '-' }}</span></td></tr>
            <tr><td class="text-muted fw-500">Harga</td><td class="text-primary fw-bold fs-5">{{ $item->formatted_price }}</td></tr>
            <tr><td class="text-muted fw-500">Stok</td><td>@if($item->quantity==0)<span class="badge bg-danger fs-6">Habis</span>@elseif($item->quantity<=5)<span class="badge bg-warning text-dark fs-6">{{ $item->quantity }}</span>@else<span class="badge bg-success fs-6">{{ $item->quantity }}</span>@endif</td></tr>
            <tr><td class="text-muted fw-500">Ditambahkan</td><td>{{ $item->created_at->format('d M Y, H:i') }}</td></tr>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="mt-3"><a href="{{ route('admin.items.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a></div>
</div></div>
@endsection
