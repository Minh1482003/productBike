<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\RoleController;

// [GET] /admin/roles
Route::get('/', [RoleController::class, 'index']);

//[DELETE] /admin/roles/delete
Route::delete('/delete/{id}', [RoleController::class, 'deleteItem']);

//[GET] /admin/roles/create
Route::get('/create', [RoleController::class, 'create']);

//[POT] /admin/roles/create
Route::post('/create', [RoleController::class, 'createPost']);

//[GET] /admin/roles/edit
Route::get('/edit/{id}', [RoleController::class, 'edit']);

//[PATCH] /admin/roles/edit
Route::patch('/edit/{id}', [RoleController::class, 'editPatch']);

