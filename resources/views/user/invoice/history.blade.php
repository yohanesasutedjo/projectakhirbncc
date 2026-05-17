@extends('layouts.app')
@section('title','Riwayat Faktur - TokoKu')
@section('page-title','Riwayat Faktur')
@section('content')
<div class="card">
  <div class="card-header d-flex align-items-center"><i class="bi bi-clock-history me-2"></i>Riwayat Faktur Saya<span class="badge bg-primary ms-2">{{ $invoices->total() }}</span></div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table mb-0">
        <thead><tr><th>#</th><th>No. Invoice</th><th>Tanggal</th><th>Jumlah Item</th><th>Total</th><th>Aksi</th></tr></thead>
        <tbody>
          @forelse($invoices as $i => $inv)
          <tr>
            <td class="text-muted">{{ $invoices->firstItem()+$i }}</td>
            <td><span class="fw-bold text-primary">{{ $inv->invoice_number }}</span></td>
            <td class="small text-muted">{{ $inv->created_at->format('d M Y, H:i') }}</td>
            <td><span class="badge bg-light text-dark border">{{ $inv->invoiceItems->count() }} item</span></td>
            <td class="fw-bold text-primary">Rp. {{ number_format($inv->total_price,0,',','.') }}</td>
            <td>
              <a href="{{ route('user.invoice.show',$inv) }}" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-eye"></i></a>
              <a href="{{ route('user.invoice.print',$inv) }}" target="_blank" class="btn btn-sm btn-outline-success"><i class="bi bi-printer"></i></a>
            </td>
          </tr>
          @empty<tr><td colspan="6" class="text-center text-muted py-5"><i class="bi bi-receipt fs-1 d-block mb-2"></i>Belum ada faktur. Mulai belanja dari <a href="{{ route('user.catalog') }}">katalog</a>.</td></tr>@endforelse
        </tbody>
      </table>
    </div>
  </div>
  @if($invoices->hasPages())<div class="card-footer bg-white d-flex justify-content-end">{{ $invoices->links('pagination::bootstrap-5') }}</div>@endif
</div>
@endsection
