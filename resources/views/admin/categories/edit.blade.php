@extends('layouts.app')
@section('title','Edit Kategori')
@section('page-title','Edit Kategori')
@section('content')
<div class="row justify-content-center"><div class="col-md-6">
  <div class="card"><div class="card-header"><i class="bi bi-pencil me-2"></i>Edit Kategori</div>
  <div class="card-body">
    <form action="{{ route('admin.categories.update',$category) }}" method="POST">@csrf @method('PUT')
      <div class="mb-4">
        <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$category->name) }}" required maxlength="100">
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-warning text-white"><i class="bi bi-check-lg me-1"></i>Perbarui</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
      </div>
    </form>
  </div></div>
</div></div>
@endsection
