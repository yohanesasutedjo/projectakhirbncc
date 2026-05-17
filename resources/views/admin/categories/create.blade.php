@extends('layouts.app')
@section('title','Tambah Kategori')
@section('page-title','Tambah Kategori')
@section('content')
<div class="row justify-content-center"><div class="col-md-6">
  <div class="card"><div class="card-header"><i class="bi bi-plus-circle me-2"></i>Form Tambah Kategori</div>
  <div class="card-body">
    <form action="{{ route('admin.categories.store') }}" method="POST">@csrf
      <div class="mb-4">
        <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Contoh: Alat Tulis" value="{{ old('name') }}" required maxlength="100">
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Simpan</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
      </div>
    </form>
  </div></div>
</div></div>
@endsection
