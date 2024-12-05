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

Route::get('/cart', [HomeController::class, 'cartProduct'])->name('cart.product')
  ->middleware(GetInforUser::class);

Route::get('/cart/createCart/{Id_SP}', [HomeController::class, 'createCart'])->name('cart.create')
  ->middleware(GetInforUser::class);

Route::delete('/cart/delete/{Id_SP}', [HomeController::class, 'deleteCart'])->name('cart.delete')
  ->middleware(GetInforUser::class);

Route::post('/cart/checkout', [HomeController::class, 'checkout'])->name('cart.checkout')
  ->middleware(GetInforUser::class);

Route::post('/cart/checkoutfinal', [HomeController::class, 'checkoutFinal'])->name('cart.checkoutfinal')
  ->middleware(GetInforUser::class);

Route::patch('/updateUser', [HomeController::class, 'updateUser'])->name('update.User')
  ->middleware(GetInforUser::class);


Route::get('/rent', [HomeController::class, 'productRent'])->name('product.rent')
->middleware(GetInforUser::class);

Route::post('/rentOder', [HomeController::class, 'rentOder'])->name('rent.order')
->middleware(GetInforUser::class);

Route::post('/rentSubmit', [HomeController::class, 'rentSubmit'])->name('rent.Submit')
->middleware(GetInforUser::class);