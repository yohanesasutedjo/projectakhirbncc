<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Faktur {{ $invoice->invoice_number }}</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
  *{font-family:'Courier New',Courier,monospace}
  body{background:#f5f5f5}
  .receipt-wrap{max-width:680px;margin:20px auto;background:#fff;padding:2rem;border-radius:4px;box-shadow:0 2px 10px rgba(0,0,0,.1)}
  .receipt-header{text-align:center;border-bottom:2px dashed #333;padding-bottom:1rem;margin-bottom:1rem}
  .receipt-header h4{font-size:1.4rem;font-weight:900;letter-spacing:2px;margin:0}
  .receipt-header p{margin:2px 0;font-size:.82rem;color:#555}
  .divider{border:none;border-top:1px dashed #999;margin:.75rem 0}
  .divider-solid{border:none;border-top:2px solid #333;margin:.75rem 0}
  .item-row{display:flex;justify-content:space-between;font-size:.82rem;margin-bottom:.3rem}
  .item-row .item-info{flex:1}
  .item-row .item-total{text-align:right;min-width:120px;font-weight:700}
  .total-section{border-top:2px dashed #333;padding-top:.75rem;margin-top:.5rem}
  .total-row{display:flex;justify-content:space-between;font-size:.9rem;font-weight:900}
  .receipt-footer{text-align:center;margin-top:1.5rem;border-top:2px dashed #333;padding-top:1rem;font-size:.78rem;color:#666}
  @media print{body{background:#fff}.receipt-wrap{box-shadow:none;margin:0;padding:1rem}.no-print{display:none!important}@page{margin:1cm}}
</style>
</head>
<body>
<div class="no-print text-center my-3">
  <button onclick="window.print()" class="btn btn-primary btn-sm me-2">🖨️ Cetak Struk</button>
  <a href="{{ route('user.invoice.show',$invoice) }}" class="btn btn-outline-secondary btn-sm">← Kembali</a>
</div>
<div class="receipt-wrap">
  <div class="receipt-header">
    <h4>★ TOKOKU ★</h4>
    <p>Sistem Pendataan Barang</p>
    <p>Jl. Contoh No. 123, Jakarta</p>
    <p>Telp: (021) 123-4567</p>
  </div>
  <div class="text-center mb-2">
    <div style="font-size:.78rem;font-weight:700;letter-spacing:1px">NO. INVOICE: {{ $invoice->invoice_number }}</div>
    <small style="font-size:.75rem;color:#666">Tanggal: {{ $invoice->created_at->format('d/m/Y H:i:s') }}</small>
  </div>
  <hr class="divider">
  <table style="font-size:.82rem;width:100%">
    <tr><td style="color:#555;width:130px">Pelanggan</td><td>: {{ $invoice->user->name }}</td></tr>
    <tr><td style="color:#555">No. HP</td><td>: {{ $invoice->user->phone }}</td></tr>
    <tr><td style="color:#555">Alamat</td><td>: {{ $invoice->shipping_address }}</td></tr>
    <tr><td style="color:#555">Kode Pos</td><td>: {{ $invoice->postal_code }}</td></tr>
  </table>
  <hr class="divider-solid">
  <div style="font-size:.75rem;color:#777;margin-bottom:.3rem;font-weight:700">─── DAFTAR BARANG ───</div>
  @foreach($invoice->invoiceItems as $inv)
  <div class="item-row">
    <div class="item-info">
      <div class="fw-bold">{{ $inv->item_name }}</div>
      <div style="font-size:.72rem;color:#777">Kategori: {{ $inv->category_name }}</div>
      <div style="font-size:.78rem;color:#555">{{ $inv->quantity }} x Rp. {{ number_format($inv->item_price,0,',','.') }}</div>
    </div>
    <div class="item-total">Rp. {{ number_format($inv->subtotal,0,',','.') }}</div>
  </div>
  <hr class="divider">
  @endforeach
  <div class="total-section">
    <div class="total-row"><span>TOTAL PEMBAYARAN</span><span>Rp. {{ number_format($invoice->total_price,0,',','.') }}</span></div>
  </div>
  <div style="font-size:.75rem;color:#555;margin-top:.5rem;text-align:center;font-style:italic">* Harga sudah termasuk semua biaya *</div>
  <div class="receipt-footer">
    <p style="font-weight:700;font-size:.85rem">— Terima Kasih Atas Pembelian Anda! —</p>
    <p>Simpan struk ini sebagai bukti transaksi</p>
    <p style="margin-top:.5rem;font-size:.7rem;color:#aaa">Dicetak: {{ now()->format('d/m/Y H:i:s') }}</p>
  </div>
</div>
<div class="no-print text-center mb-4"><small class="text-muted">Tekan Cetak Struk untuk mencetak atau simpan sebagai PDF</small></div>
</body>
</html>
