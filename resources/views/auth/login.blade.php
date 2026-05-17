@extends('layouts.app')
@section('title','Login - TokoKu')
@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center" style="background:linear-gradient(135deg,#1e293b,#2563eb)">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5 col-lg-4">
        <div class="text-center mb-4">
          <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-3" style="width:64px;height:64px;box-shadow:0 4px 20px rgba(0,0,0,.2)">
            <i class="bi bi-shop text-primary fs-3"></i>
          </div>
          <h4 class="text-white fw-bold mb-0">TokoKu</h4>
          <p class="text-white-50 small">Sistem Pendataan Barang</p>
        </div>
        <div class="card shadow-lg border-0" style="border-radius:16px">
          <div class="card-body p-4">
            <h5 class="fw-bold text-center mb-1">Masuk ke Akun</h5>
            <p class="text-muted text-center small mb-4">Selamat datang kembali!</p>
            @if(session('success'))<div class="alert alert-success py-2 small"><i class="bi bi-check-circle me-1"></i>{{ session('success') }}</div>@endif
            @if($errors->any())<div class="alert alert-danger py-2 small"><i class="bi bi-exclamation-triangle me-1"></i>{{ $errors->first() }}</div>@endif
            <form action="{{ route('login.post') }}" method="POST">@csrf
              <div class="mb-3">
                <label class="form-label">Email</label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                  <input type="email" name="email" class="form-control border-start-0" placeholder="contoh@gmail.com" value="{{ old('email') }}" required>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                  <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock text-muted"></i></span>
                  <input type="password" name="password" id="pwd" class="form-control border-start-0 border-end-0" placeholder="••••••••" required>
                  <button type="button" class="input-group-text bg-light" onclick="toggleP()"><i class="bi bi-eye" id="eyeI"></i></button>
                </div>
              </div>
              <div class="mb-3"><div class="form-check"><input class="form-check-input" type="checkbox" name="remember" id="rem"><label class="form-check-label small" for="rem">Ingat saya</label></div></div>
              <button type="submit" class="btn btn-primary w-100 py-2 fw-bold"><i class="bi bi-box-arrow-in-right me-2"></i>Masuk</button>
            </form>
            <hr class="my-3">
            <p class="text-center text-muted small mb-0">Belum punya akun? <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">Daftar sekarang</a></p>
          </div>
        </div>
        <p class="text-center text-white-50 small mt-3">&copy; {{ date('Y') }} TokoKu</p>
      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script>function toggleP(){const p=document.getElementById('pwd'),i=document.getElementById('eyeI');if(p.type==='password'){p.type='text';i.className='bi bi-eye-slash';}else{p.type='password';i.className='bi bi-eye';}}</script>
@endpush
