<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use App\Models\Invoice;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index', [
            'totalItems'      => Item::count(),
            'totalCategories' => Category::count(),
            'totalInvoices'   => Invoice::count(),
            'totalUsers'      => User::where('role', 'user')->count(),
            'lowStockItems'   => Item::where('quantity', '<=', 5)->with('category')->get(),
            'recentItems'     => Item::with('category')->latest()->take(6)->get(),
        ]);
    }
}
