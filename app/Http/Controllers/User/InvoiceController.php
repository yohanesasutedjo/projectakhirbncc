<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Item;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('user.catalog')->with('error', 'Keranjang Anda kosong.');
        }
        return view('user.invoice.create', ['cart' => $cart, 'total' => collect($cart)->sum('subtotal')]);
    }

    public function store(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) return redirect()->route('user.catalog')->with('error', 'Keranjang Anda kosong.');

        $request->validate([
            'shipping_address' => 'required|string|min:10|max:100',
            'postal_code'      => 'required|string|digits:5',
        ], [
            'shipping_address.required' => 'Alamat pengiriman wajib diisi.',
            'shipping_address.min'      => 'Alamat pengiriman minimal 10 karakter.',
            'shipping_address.max'      => 'Alamat pengiriman maksimal 100 karakter.',
            'postal_code.required'      => 'Kode pos wajib diisi.',
            'postal_code.digits'        => 'Kode pos harus tepat 5 digit angka.',
        ]);

        foreach ($cart as $itemId => $cartItem) {
            $dbItem = Item::find($itemId);
            if (!$dbItem || $dbItem->quantity < $cartItem['quantity']) {
                return back()->with('error', "Stok \"{$cartItem['name']}\" tidak mencukupi. Silakan perbarui keranjang.");
            }
        }

        $invoice = Invoice::create([
            'user_id'          => auth()->id(),
            'invoice_number'   => Invoice::generateInvoiceNumber(),
            'shipping_address' => $request->shipping_address,
            'postal_code'      => $request->postal_code,
            'total_price'      => collect($cart)->sum('subtotal'),
        ]);

        foreach ($cart as $itemId => $cartItem) {
            InvoiceItem::create([
                'invoice_id'    => $invoice->id,
                'item_id'       => $itemId,
                'item_name'     => $cartItem['name'],
                'item_price'    => $cartItem['price'],
                'category_name' => $cartItem['category_name'],
                'quantity'      => $cartItem['quantity'],
                'subtotal'      => $cartItem['subtotal'],
            ]);
            Item::where('id', $itemId)->decrement('quantity', $cartItem['quantity']);
        }

        session()->forget('cart');
        return redirect()->route('user.invoice.show', $invoice)->with('success', 'Faktur berhasil dibuat!');
    }

    public function show(Invoice $invoice)
    {
        if ($invoice->user_id !== auth()->id()) abort(403);
        return view('user.invoice.show', ['invoice' => $invoice->load('invoiceItems', 'user')]);
    }

    public function print(Invoice $invoice)
    {
        if ($invoice->user_id !== auth()->id()) abort(403);
        return view('user.invoice.print', ['invoice' => $invoice->load('invoiceItems', 'user')]);
    }

    public function history()
    {
        $invoices = Invoice::where('user_id', auth()->id())->with('invoiceItems')->latest()->paginate(10);
        return view('user.invoice.history', compact('invoices'));
    }
}
