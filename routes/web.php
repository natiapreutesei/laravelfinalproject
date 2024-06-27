<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Middleware\RedirectToHomepage;
use App\Livewire\CancelPage;
use App\Livewire\CartPage;
use App\Livewire\CategoriesPage;
use App\Livewire\CheckoutPage;
use App\Livewire\HomePage;
use App\Livewire\MyOrderDetailPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\ProductDetailPage;
use App\Livewire\ProductsPage;
use App\Livewire\SuccessPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

Route::get('/', HomePage::class)->name('home');
Route::get('categories', CategoriesPage::class)->name('categories');
Route::get('products', ProductsPage::class)->name('products');
Route::get('cart', CartPage::class)->name('cart');
Route::get('products/{slug}', ProductDetailPage::class);

// Auth Routes
Route::middleware('auth')->group(function () {
    Route::get('checkout', CheckoutPage::class)->name('checkout');
    Route::get('my-orders', MyOrdersPage::class);
    Route::get('my-orders/{order_id}', MyOrderDetailPage::class)->name('my-orders.show');

    Route::get('success', SuccessPage::class)->name('success');
    Route::get('cancel', CancelPage::class)->name('cancel');
});

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// Breeze Routes
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified', RedirectToHomepage::class])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
