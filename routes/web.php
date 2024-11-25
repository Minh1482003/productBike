<?php
use Illuminate\Support\Facades\Route;

//Route admin
Route::prefix('admin')->group(base_path('routes/admin/indexRoute.php'));

//Route client
// Route::namespace('Client')->group(base_path('routes/clientRoute.php'));

