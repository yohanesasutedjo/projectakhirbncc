@extends('layouts.app')
@section('title','Daftar - TokoKu')
@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center py-4" style="background:linear-gradient(135deg,#1e293b,#7c3aed)">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="text-center mb-4">
          <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-3" style="width:64px;height:64px;box-shadow:0 4px 20px rgba(0,0,0,.2)">
            <i class="bi bi-shop text-primary fs-3"></i>
          </div>
          <h4 class="text-white fw-bold mb-0">TokoKu</h4>
          <p class="text-white-50 small">Sistem Pendataan Barang</p>
        </div>
        <div class="card shadow-lg border-0" style="border-radius:16px">
          <div class="card-body p-4">
            <h5 class="fw-bold text-center mb-1">Buat Akun Baru</h5>
            <p class="text-muted text-center small mb-4">Daftar sebagai pengguna</p>
            @if($errors->any())<div class="alert alert-danger py-2 small"><i class="bi bi-exclamation-triangle me-1"></i><strong>Periksa kembali:</strong><ul class="mb-0 mt-1 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
            <form action="{{ route('register.post') }}" method="POST">@csrf
              <div class="mb-3">
                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Min 3, maks 40 huruf" value="{{ old('name') }}" minlength="3" maxlength="40" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
              <div class="mb-3">
                <label class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="contoh@gmail.com" value="{{ old('email') }}" required>
                <div class="form-text">Harus menggunakan @gmail.com</div>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
              <div class="mb-3">
                <label class="form-label">Nomor Handphone <span class="text-danger">*</span></label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="08xxxxxxxxxx" value="{{ old('phone') }}" required>
                <div class="form-text">Harus diawali dengan 08</div>
                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
              <div class="mb-3">
                <label class="form-label">Password <span class="text-danger">*</span></label>
                <div class="input-group">
                  <input type="password" name="password" id="p1" class="form-control border-end-0 @error('password') is-invalid @enderror" placeholder="6-12 karakter" minlength="6" maxlength="12" required>
                  <button type="button" class="input-group-text bg-light" onclick="toggleP('p1','e1')"><i class="bi bi-eye" id="e1"></i></button>
                  @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
              </div>
              <div class="mb-4">
                <label class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                <div class="input-group">
                  <input type="password" name="password_confirmation" id="p2" class="form-control border-end-0" placeholder="Ulangi password" minlength="6" maxlength="12" required>
                  <button type="button" class="input-group-text bg-light" onclick="toggleP('p2','e2')"><i class="bi bi-eye" id="e2"></i></button>
                </div>
              </div>
              <button type="submit" class="btn btn-primary w-100 py-2 fw-bold"><i class="bi bi-person-plus me-2"></i>Daftar Sekarang</button>
            </form>
            <hr class="my-3">
            <p class="text-center text-muted small mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Masuk di sini</a></p>
            <p class="text-center text-muted mt-1" style="font-size:.75rem"><i class="bi bi-info-circle"></i> Akun Admin hanya dibuat oleh Administrator.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script>function toggleP(id,icon){const p=document.getElementById(id),i=document.getElementById(icon);if(p.type==='password'){p.type='text';i.className='bi bi-eye-slash';}else{p.type='password';i.className='bi bi-eye';}}</script>
@endpush
