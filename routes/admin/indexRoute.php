<?php
use Illuminate\Support\Facades\Route;

// [GET] admin/ product
Route::prefix('products')->group(base_path('routes/admin/productRoute.php'));

// [GET] admin/ dashboard
// Route::prefix('dashboard')->group(base_path('dashboardRoute.php')); 