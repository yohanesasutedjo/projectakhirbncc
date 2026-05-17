<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()   { return view('admin.categories.index', ['categories' => Category::withCount('items')->latest()->paginate(10)]); }
    public function create()  { return view('admin.categories.create'); }
    public function show(Category $category) { return view('admin.categories.show', compact('category')); }
    public function edit(Category $category) { return view('admin.categories.edit', compact('category')); }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:100|unique:categories,name'], ['name.required' => 'Nama kategori wajib diisi.', 'name.unique' => 'Nama kategori sudah ada.']);
        Category::create(['name' => $request->name]);
        return redirect()->route('admin.categories.index')->with('success', 'Kategori "' . $request->name . '" berhasil ditambahkan!');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate(['name' => 'required|string|max:100|unique:categories,name,' . $category->id], ['name.required' => 'Nama kategori wajib diisi.', 'name.unique' => 'Nama kategori sudah ada.']);
        $category->update(['name' => $request->name]);
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Category $category)
    {
        if ($category->items()->count() > 0) {
            return redirect()->route('admin.categories.index')->with('error', 'Kategori tidak bisa dihapus karena masih memiliki barang!');
        }
        $name = $category->name;
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Kategori "' . $name . '" berhasil dihapus!');
    }
}
