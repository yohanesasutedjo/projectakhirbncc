<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'TokoKu')</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
:root{--primary:#2563eb;--primary-d:#1d4ed8;--sw:260px}
*{font-family:'Inter',sans-serif}
body{background:#f1f5f9;min-height:100vh}

/* Sidebar */
.sidebar{position:fixed;top:0;left:0;width:var(--sw);height:100vh;background:linear-gradient(160deg,#1e293b,#0f172a);z-index:1000;overflow-y:auto;display:flex;flex-direction:column;transition:transform .3s}
.sidebar-brand{padding:1.5rem 1.25rem 1rem;border-bottom:1px solid rgba(255,255,255,.08)}
.sidebar-brand h5{color:#fff;font-weight:700;font-size:1.1rem;margin:0}
.sidebar-brand small{color:#94a3b8;font-size:.72rem}
.sidebar-menu{padding:.75rem 0;flex:1}
.sidebar-label{padding:.5rem 1.25rem .25rem;color:#475569;font-size:.7rem;text-transform:uppercase;letter-spacing:.08em;font-weight:600}
.sidebar-link{display:flex;align-items:center;gap:.75rem;padding:.6rem 1.25rem;color:#94a3b8;text-decoration:none;font-size:.875rem;font-weight:500;border-left:3px solid transparent;transition:all .2s}
.sidebar-link:hover,.sidebar-link.active{color:#fff;background:rgba(255,255,255,.06);border-left-color:var(--primary)}
.sidebar-link i{font-size:1rem;width:20px;text-align:center}
.sidebar-footer{padding:1rem 1.25rem;border-top:1px solid rgba(255,255,255,.08)}
.sidebar-avatar{width:36px;height:36px;border-radius:50%;background:var(--primary);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:.9rem;flex-shrink:0}
.sidebar-user-name{color:#e2e8f0;font-size:.83rem;font-weight:600}

/* Main */
.main-wrapper{margin-left:var(--sw);min-height:100vh}
.topbar{background:#fff;border-bottom:1px solid #e2e8f0;padding:.75rem 1.5rem;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:900}
.page-content{padding:1.5rem}

/* Cards */
.card{border:none;border-radius:12px;box-shadow:0 1px 3px rgba(0,0,0,.08)}
.card-header{background:#fff;border-bottom:1px solid #f1f5f9;border-radius:12px 12px 0 0!important;padding:1rem 1.25rem;font-weight:600;color:#1e293b}

/* Stat */
.stat-card{border-radius:12px;padding:1.25rem;border:none;background:#fff;box-shadow:0 1px 3px rgba(0,0,0,.08)}
.stat-icon{width:48px;height:48px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.4rem}
.stat-value{font-size:1.6rem;font-weight:700;color:#1e293b}
.stat-label{color:#64748b;font-size:.82rem;font-weight:500}

/* Table */
.table{font-size:.875rem}
.table thead th{background:#f8fafc;color:#64748b;font-weight:600;font-size:.78rem;text-transform:uppercase;letter-spacing:.05em;border-bottom:2px solid #e2e8f0;padding:.75rem 1rem}
.table td{padding:.75rem 1rem;vertical-align:middle}

/* Form */
.btn{border-radius:8px;font-weight:500;font-size:.875rem}
.btn-primary{background:var(--primary);border-color:var(--primary)}
.btn-primary:hover{background:var(--primary-d);border-color:var(--primary-d)}
.form-control,.form-select{border-radius:8px;font-size:.875rem;border-color:#e2e8f0}
.form-control:focus,.form-select:focus{border-color:var(--primary);box-shadow:0 0 0 3px rgba(37,99,235,.12)}
.form-label{font-weight:500;font-size:.875rem;color:#374151}

/* Item thumb */
.item-thumb{width:50px;height:50px;object-fit:cover;border-radius:8px;border:1px solid #e2e8f0}

/* Catalog */
.catalog-card{border-radius:14px;border:none;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,.08);transition:transform .2s,box-shadow .2s}
.catalog-card:hover{transform:translateY(-3px);box-shadow:0 6px 20px rgba(0,0,0,.12)}
.catalog-img{width:100%;height:180px;object-fit:cover}
.catalog-price{color:var(--primary);font-weight:700;font-size:1rem}
.out-of-stock-overlay{position:absolute;inset:0;background:rgba(0,0,0,.55);display:flex;align-items:center;justify-content:center;border-radius:14px 14px 0 0}

/* Cart badge */
.cart-count-badge{position:absolute;top:-6px;right:-6px;background:#dc2626;color:#fff;width:18px;height:18px;border-radius:50%;font-size:.65rem;font-weight:700;display:flex;align-items:center;justify-content:center}

/* Alert */
.alert{border:none;border-radius:10px;font-size:.875rem}

@media(max-width:768px){.sidebar{transform:translateX(-100%)}.sidebar.show{transform:translateX(0)}.main-wrapper{margin-left:0}}
</style>
@stack('styles')
</head>
<body>
@auth
<aside class="sidebar" id="sidebar">
  <div class="sidebar-brand">
    <h5><i class="bi bi-shop me-2"></i>TokoKu</h5>
    <small>Sistem Pendataan Barang</small>
  </div>
  <nav class="sidebar-menu">
    @if(auth()->user()->isAdmin())
      <div class="sidebar-label">Main Menu</div>
      <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
      <div class="sidebar-label mt-2">Manajemen</div>
      <a href="{{ route('admin.categories.index') }}" class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"><i class="bi bi-tags"></i> Kategori Barang</a>
      <a href="{{ route('admin.items.index') }}" class="sidebar-link {{ request()->routeIs('admin.items.*') ? 'active' : '' }}"><i class="bi bi-box-seam"></i> Data Barang</a>
      <a href="{{ route('admin.items.create') }}" class="sidebar-link"><i class="bi bi-plus-circle"></i> Tambah Barang</a>
    @else
      <div class="sidebar-label">Menu</div>
      <a href="{{ route('user.catalog') }}" class="sidebar-link {{ request()->routeIs('user.catalog') ? 'active' : '' }}"><i class="bi bi-grid"></i> Katalog Barang</a>
      <a href="{{ route('user.cart') }}" class="sidebar-link {{ request()->routeIs('user.cart') ? 'active' : '' }}">
        <i class="bi bi-cart3"></i> Keranjang
        @php $cc = count(session('cart', [])); @endphp
        @if($cc > 0)<span class="badge bg-danger ms-auto">{{ $cc }}</span>@endif
      </a>
      <a href="{{ route('user.invoice.index') }}" class="sidebar-link {{ request()->routeIs('user.invoice.index') ? 'active' : '' }}"><i class="bi bi-receipt"></i> Buat Faktur</a>
      <a href="{{ route('user.invoice.history') }}" class="sidebar-link {{ request()->routeIs('user.invoice.history') ? 'active' : '' }}"><i class="bi bi-clock-history"></i> Riwayat Faktur</a>
    @endif
  </nav>
  <div class="sidebar-footer">
    <div class="d-flex align-items-center gap-2">
      <div class="sidebar-avatar">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</div>
      <div>
        <div class="sidebar-user-name">{{ Str::limit(auth()->user()->name,18) }}</div>
        <small style="color:#94a3b8;font-size:.72rem">{{ ucfirst(auth()->user()->role) }}</small>
      </div>
    </div>
    <form action="{{ route('logout') }}" method="POST" class="mt-2">@csrf
      <button type="submit" class="btn btn-sm w-100" style="background:rgba(255,255,255,.07);color:#94a3b8;border:1px solid rgba(255,255,255,.1)"><i class="bi bi-box-arrow-left me-1"></i>Logout</button>
    </form>
  </div>
</aside>

<div class="main-wrapper">
  <div class="topbar">
    <div class="d-flex align-items-center gap-3">
      <button class="btn btn-sm d-md-none" onclick="document.getElementById('sidebar').classList.toggle('show')"><i class="bi bi-list fs-5"></i></button>
      <span style="font-weight:600;color:#1e293b">@yield('page-title','Dashboard')</span>
    </div>
    <div class="d-flex align-items-center gap-2">
      @if(auth()->user()->isUser())
        <a href="{{ route('user.cart') }}" class="btn btn-sm btn-outline-primary position-relative">
          <i class="bi bi-cart3"></i>
          @php $cc=count(session('cart',[])); @endphp
          @if($cc>0)<span class="cart-count-badge">{{ $cc }}</span>@endif
        </a>
      @endif
      <span class="badge bg-light text-dark border">{{ ucfirst(auth()->user()->role) }}</span>
    </div>
  </div>
  <div class="page-content">
    @if(session('success'))<div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-3"><i class="bi bi-check-circle-fill"></i><div>{{ session('success') }}</div><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
    @if(session('error'))<div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-3"><i class="bi bi-exclamation-triangle-fill"></i><div>{{ session('error') }}</div><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
    @if($errors->any())<div class="alert alert-danger alert-dismissible fade show mb-3"><i class="bi bi-exclamation-triangle-fill me-2"></i><strong>Terjadi kesalahan:</strong><ul class="mb-0 mt-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>@endif
    @yield('content')
  </div>
</div>
@else
@yield('content')
@endauth
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
