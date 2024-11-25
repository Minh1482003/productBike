<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CategoryController;

use App\Http\Middleware\CheckCreate;
use App\Http\Middleware\HandleImage;

// [GET] /admin/productRoute.php
Route::get('/', [CategoryController::class, 'index'])->name('admin.category.index');

Route::delete('/delete/{id}', [CategoryController::class, 'deleteItem']);

Route::get('/create', [CategoryController::class, 'create']);

Route::post('/create', [CategoryController::class, 'createPost']);

Route::get('/edit/{id}', [CategoryController::class, 'edit']);

Route::patch('/edit/{id}', [CategoryController::class, 'editPatch']);