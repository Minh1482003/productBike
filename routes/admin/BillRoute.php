<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\BillController;

// [GET] /admin/productRoute.php
Route::get('/', [BillController::class, 'index'])->name('admin.Bill.index');

Route::get('detail/{id}', [BillController::class, 'BillDetail'])->name('admin.BillDetail.index');

// Route::delete('/delete/{id}', [BillController::class, 'deleteItem']);

// Route::get('/create', [BillController::class, 'create']);

// Route::post('/create', [BillController::class, 'createPost']);

// Route::get('/edit/{id}', [BillController::class, 'edit']);

// Route::patch('/edit/{id}', [BillController::class, 'editPatch']);