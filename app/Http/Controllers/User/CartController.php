<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() { return view('user.cart.index', ['cart' => session('cart', [])]); }

    public function add(Request $request, Item $item)
    {
        if ($item->isOutOfStock()) {
            return back()->with('error', "Barang \"{$item->name}\" sudah habis, silakan tunggu hingga barang di-restock ulang.");
        }

        $cart = session('cart', []);
        $qty  = max(1, (int) $request->input('quantity', 1));

        if (isset($cart[$item->id])) {
            $newQty = $cart[$item->id]['quantity'] + $qty;
            if ($newQty > $item->quantity) {
                return back()->with('error', "Stok \"{$item->name}\" tidak mencukupi. Tersedia: {$item->quantity}.");
            }
            $cart[$item->id]['quantity'] = $newQty;
            $cart[$item->id]['subtotal'] = $newQty * $item->price;
        } else {
            if ($qty > $item->quantity) {
                return back()->with('error', "Stok \"{$item->name}\" tidak mencukupi. Tersedia: {$item->quantity}.");
            }
            $cart[$item->id] = [
                'id'            => $item->id,
                'name'          => $item->name,
                'price'         => $item->price,
                'category_name' => $item->category->name ?? '-',
                'quantity'      => $qty,
                'subtotal'      => $qty * $item->price,
                'image'         => $item->image,
                'stock'         => $item->quantity,
            ];
        }

        session(['cart' => $cart]);
        return back()->with('success', "Barang \"{$item->name}\" berhasil ditambahkan ke keranjang!");
    }

    public function update(Request $request, Item $item)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);
        $cart = session('cart', []);
        $qty  = (int) $request->quantity;
        $fresh = Item::find($item->id);

        if (!isset($cart[$item->id])) return back()->with('error', 'Barang tidak ada di keranjang.');
        if ($qty > $fresh->quantity)  return back()->with('error', "Stok \"{$item->name}\" tidak mencukupi. Tersedia: {$fresh->quantity}.");

        $cart[$item->id]['quantity'] = $qty;
        $cart[$item->id]['subtotal'] = $qty * $cart[$item->id]['price'];
        $cart[$item->id]['stock']    = $fresh->quantity;

        session(['cart' => $cart]);
        return back()->with('success', 'Jumlah barang berhasil diperbarui!');
    }

    public function remove(Item $item)
    {
        $cart = session('cart', []);
        if (isset($cart[$item->id])) {
            $name = $cart[$item->id]['name'];
            unset($cart[$item->id]);
            session(['cart' => $cart]);
            return back()->with('success', "Barang \"{$name}\" dihapus dari keranjang.");
        }
        return back()->with('error', 'Barang tidak ditemukan di keranjang.');
    }

    public function clear()
    {
        session()->forget('cart');
        return back()->with('success', 'Keranjang berhasil dikosongkan.');
    }
}
