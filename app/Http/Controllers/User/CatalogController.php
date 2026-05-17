<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::with('category');
        if ($request->filled('search'))   $query->where('name', 'like', '%' . $request->search . '%');
        if ($request->filled('category')) $query->where('category_id', $request->category);
        return view('user.catalog.index', [
            'items'      => $query->latest()->paginate(12)->withQueryString(),
            'categories' => Category::all(),
            'cart'       => session('cart', []),
        ]);
    }
}
