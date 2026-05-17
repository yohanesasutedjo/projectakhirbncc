<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\User\CatalogController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\InvoiceController;

Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('user.catalog');
    }
    return redirect()->route('login');
});

Route::get('/login',    [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login',   [LoginController::class, 'login'])->name('login.post');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register',[RegisterController::class, 'register'])->name('register.post');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('items', ItemController::class);
});

Route::prefix('user')->name('user.')->middleware(['auth', 'role:user'])->group(function () {
    Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');

    Route::get('/cart',                     [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add/{item}',         [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{item}',     [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{item}',    [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart/clear',            [CartController::class, 'clear'])->name('cart.clear');

    Route::get('/invoice',                  [InvoiceController::class, 'index'])->name('invoice.index');
    Route::post('/invoice/store',           [InvoiceController::class, 'store'])->name('invoice.store');
    Route::get('/invoices/history',         [InvoiceController::class, 'history'])->name('invoice.history');
    Route::get('/invoice/{invoice}',        [InvoiceController::class, 'show'])->name('invoice.show');
    Route::get('/invoice/{invoice}/print',  [InvoiceController::class, 'print'])->name('invoice.print');
});
