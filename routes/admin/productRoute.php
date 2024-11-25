<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Middleware\CheckProduct;
use App\Http\Middleware\HandleImage;

// [GET] /admin/productRoute.php
Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');

Route::get('/rent', [ProductController::class, 'indexRent'])->name('admin.products.indexRent');

Route::patch('/change-status/{status}/{id}', [ProductController::class, 'changeStatus']);

Route::patch('/change-multi', [ProductController::class, 'changeMulti']);

Route::delete('/delete/{id}', [ProductController::class, 'deleteItem']);

Route::get('/create', [ProductController::class, 'create']);

Route::post('/create', [ProductController::class, 'createPost'])
  ->middleware(CheckProduct::class)
  ->middleware(HandleImage::class);

Route::get('/edit/{id}', [ProductController::class, 'edit']);

Route::patch('/edit/{id}', [ProductController::class, 'editPatch'])
  ->middleware(CheckProduct::class)
  ->middleware(HandleImage::class);

