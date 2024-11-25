<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Middleware\GetInforUser;

// [GET] admin/home
Route::get('/', [HomeController::class, 'index'])->name('home.index')
  ->middleware(GetInforUser::class);

Route::get('/detail/{slug}', [HomeController::class, 'detail'])->name('product.detail')
  ->middleware(GetInforUser::class);

Route::get('/products', [HomeController::class, 'productBuy'])->name('product.buy')
  ->middleware(GetInforUser::class);

Route::post('/createCart', [HomeController::class, 'cartProduct'])->name('cart.create')
  ->middleware(GetInforUser::class);

Route::get('/cart', [HomeController::class, 'cartProduct'])->name('cart.product')
  ->middleware(GetInforUser::class);