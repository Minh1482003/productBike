<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AccountController;

use App\Http\Middleware\CheckAccount;

use App\Http\Middleware\HandleImage;

// [GET] /admin/productRoute.php
Route::get('/', [AccountController::class, 'index'])->name('admin.account.index');

Route::delete('/delete/{id}', [AccountController::class, 'deleteItem']);

Route::patch('/change-status/{status}/{id}', [AccountController::class, 'changeStatus']);

Route::get('/create', [AccountController::class, 'create']);

Route::post('/create', [AccountController::class, 'createPost'])
  ->middleware(CheckAccount::class)
  ->middleware(HandleImage::class);

Route::get('/edit/{id}', [AccountController::class, 'edit']);

Route::patch('/edit/{id}', [AccountController::class, 'editPatch'])
  ->middleware(HandleImage::class);

//[PATCH] /admin/roles/provide-role
Route::patch('/provide-role', [AccountController::class, 'provideRole']);