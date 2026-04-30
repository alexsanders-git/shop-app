<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Livewire\HomeComponent::class)->name('home');
Route::get('/product/{slug}', App\Livewire\Product\ProductComponent::class)->name('product');
Route::get('/category/{slug}', App\Livewire\Product\CategoryComponent::class)->name('category');
Route::get('/cart', \App\Livewire\Cart\CartComponent::class)->name('cart');
Route::get('/checkout', \App\Livewire\Cart\CheckoutComponent::class)->name('checkout');

Route::middleware('guest')->group(function () {
    Route::get('/login', \App\Livewire\User\LoginComponent::class)->name('login');
    Route::get('/register', \App\Livewire\User\RegisterComponent::class)->name('register');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', function () {
        auth()->logout();
        return redirect()->route('login');
    })->name('logout');
    Route::get('/account', \App\Livewire\User\AccountComponent::class)->name('account');
    Route::get('/change-account', \App\Livewire\User\ChangeAccountComponent::class)->name('change-account');
    Route::get('/orders', \App\Livewire\User\OrdersComponent::class)->name('orders');
    Route::get('/order-detail/{id}', \App\Livewire\User\OrderDetailComponent::class)->name('order-detail');
});
