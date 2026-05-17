@extends('layouts.app')
@section('title','Edit Barang')
@section('page-title','Edit Barang')
@section('content')
<div class="row justify-content-center"><div class="col-lg-8">
  <div class="card"><div class="card-header"><i class="bi bi-pencil me-2"></i>Edit: <strong>{{ $item->name }}</strong></div>
  <div class="card-body">
    <form action="{{ route('admin.items.update',$item) }}" method="POST" enctype="multipart/form-data">@csrf @method('PUT')
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Kategori Barang <span class="text-danger">*</span></label>
          <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach($categories as $cat)<option value="{{ $cat->id }}" {{ old('category_id',$item->category_id)==$cat->id?'selected':'' }}>{{ $cat->name }}</option>@endforeach
          </select>
          @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
          <label class="form-label">Nama Barang <span class="text-danger">*</span></label>
          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$item->name) }}" minlength="5" maxlength="80" required>
          @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
          <label class="form-label">Harga Barang <span class="text-danger">*</span></label>
          <div class="input-group">
            <span class="input-group-text bg-light fw-bold">Rp.</span>
            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price',$item->price) }}" min="0" required>
          </div>
        </div>
        <div class="col-md-6">
          <label class="form-label">Jumlah Barang (Stok) <span class="text-danger">*</span></label>
          <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity',$item->quantity) }}" min="0" required>
          @error('quantity')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-12">
          <label class="form-label">Foto Barang <small class="text-muted">(kosongkan jika tidak ingin mengubah)</small></label>
          @if($item->image && file_exists(public_path('images/items/'.$item->image)))
            <div class="mb-2"><small class="text-muted d-block mb-1">Foto saat ini:</small><img src="{{ asset('images/items/'.$item->image) }}" style="height:120px;border-radius:8px;border:1px solid #e2e8f0"></div>
          @endif
          <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/jpg,image/jpeg,image/png,image/webp" onchange="prevImg(this)">
          @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
          <div class="form-text">Format: JPG, PNG, WebP. Maks 2MB.</div>
          <div id="prevBox" class="mt-2" style="display:none"><small class="text-muted d-block mb-1">Preview baru:</small><img id="prevImg" src="#" style="max-height:180px;border-radius:10px;border:1px solid #e2e8f0"></div>
        </div>
      </div>
      <hr class="my-4">
      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-warning text-white"><i class="bi bi-check-lg me-1"></i>Perbarui Barang</button>
        <a href="{{ route('admin.items.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
      </div>
    </form>
  </div></div>
</div></div>
@endsection
@push('scripts')
<script>function prevImg(i){const b=document.getElementById('prevBox'),p=document.getElementById('prevImg');if(i.files&&i.files[0]){const r=new FileReader();r.onload=e=>{p.src=e.target.result;b.style.display='block'};r.readAsDataURL(i.files[0]);}else{b.style.display='none';}}</script>
@endpush
