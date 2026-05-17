<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::with('category');
        if ($request->filled('search'))   $query->where('name', 'like', '%' . $request->search . '%');
        if ($request->filled('category')) $query->where('category_id', $request->category);
        return view('admin.items.index', [
            'items'      => $query->latest()->paginate(10)->withQueryString(),
            'categories' => Category::all(),
        ]);
    }

    public function create() { return view('admin.items.create', ['categories' => Category::all()]); }
    public function show(Item $item) { return view('admin.items.show', ['item' => $item->load('category')]); }
    public function edit(Item $item) { return view('admin.items.edit', ['item' => $item, 'categories' => Category::all()]); }

    private function validateItem(Request $request): array
    {
        return $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|min:5|max:80',
            'price'       => 'required|integer|min:0',
            'quantity'    => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'category_id.required' => 'Kategori wajib dipilih.',
            'name.required' => 'Nama barang wajib diisi.',
            'name.min'      => 'Nama barang minimal 5 huruf.',
            'name.max'      => 'Nama barang maksimal 80 huruf.',
            'price.required'    => 'Harga wajib diisi.',
            'price.integer'     => 'Harga harus berupa angka.',
            'quantity.required' => 'Jumlah wajib diisi.',
            'quantity.integer'  => 'Jumlah harus berupa angka.',
            'image.image'  => 'File harus berupa gambar.',
            'image.mimes'  => 'Format: jpg, jpeg, png, webp.',
            'image.max'    => 'Ukuran gambar maks 2MB.',
        ]);
    }

    private function handleImage(Request $request, ?string $oldImage = null): ?string
    {
        if ($request->hasFile('image')) {
            if ($oldImage && file_exists(public_path('images/items/' . $oldImage))) {
                unlink(public_path('images/items/' . $oldImage));
            }
            $file = $request->file('image');
            $name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/items'), $name);
            return $name;
        }
        return $oldImage;
    }

    public function store(Request $request)
    {
        $this->validateItem($request);
        Item::create([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'price'       => $request->price,
            'quantity'    => $request->quantity,
            'image'       => $this->handleImage($request),
        ]);
        return redirect()->route('admin.items.index')->with('success', 'Barang "' . $request->name . '" berhasil ditambahkan!');
    }

    public function update(Request $request, Item $item)
    {
        $this->validateItem($request);
        $item->update([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'price'       => $request->price,
            'quantity'    => $request->quantity,
            'image'       => $this->handleImage($request, $item->image),
        ]);
        return redirect()->route('admin.items.index')->with('success', 'Barang "' . $item->name . '" berhasil diperbarui!');
    }

    public function destroy(Item $item)
    {
        if ($item->image && file_exists(public_path('images/items/' . $item->image))) {
            unlink(public_path('images/items/' . $item->image));
        }
        $name = $item->name;
        $item->delete();
        return redirect()->route('admin.items.index')->with('success', 'Barang "' . $name . '" berhasil dihapus!');
    }
}
