@extends('layouts.app')
@section('title','Kategori - Admin')
@section('page-title','Kategori Barang')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <div><h6 class="mb-0 fw-bold">Daftar Kategori</h6><small class="text-muted">Total {{ $categories->total() }} kategori</small></div>
  <a href="{{ route('admin.categories.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Tambah Kategori</a>
</div>
<div class="card">
  <div class="card-body p-0">
    <table class="table mb-0">
      <thead><tr><th>#</th><th>Nama Kategori</th><th>Jumlah Barang</th><th>Dibuat</th><th>Aksi</th></tr></thead>
      <tbody>
        @forelse($categories as $i => $cat)
        <tr>
          <td class="text-muted">{{ $categories->firstItem()+$i }}</td>
          <td class="fw-500">{{ $cat->name }}</td>
          <td><span class="badge bg-primary bg-opacity-10 text-primary">{{ $cat->items_count }} barang</span></td>
          <td class="text-muted small">{{ $cat->created_at->format('d M Y') }}</td>
          <td>
            <a href="{{ route('admin.categories.edit',$cat) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
            <form action="{{ route('admin.categories.destroy',$cat) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kategori ini?')">@csrf @method('DELETE')
              <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
            </form>
          </td>
        </tr>
        @empty<tr><td colspan="5" class="text-center text-muted py-5"><i class="bi bi-tags fs-2 d-block mb-2"></i>Belum ada kategori. <a href="{{ route('admin.categories.create') }}">Tambah sekarang</a></td></tr>@endforelse
      </tbody>
    </table>
  </div>
  @if($categories->hasPages())<div class="card-footer bg-white d-flex justify-content-end">{{ $categories->links('pagination::bootstrap-5') }}</div>@endif
</div>
@endsection
