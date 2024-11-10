<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;

// [GET] /admin/productRoute.php
Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');

