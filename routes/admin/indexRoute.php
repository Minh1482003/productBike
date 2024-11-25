<?php
use Illuminate\Support\Facades\Route;

// [GET] admin/products
Route::prefix('products')->group(base_path('routes/admin/ProductRoute.php'));

// [GET] admin/category
Route::prefix('categorys')->group(base_path('routes/admin/CategoryRoute.php'));

// [GET] admin/ dashboard
// Route::prefix('dashboard')->group(base_path('dashboardRoute.php')); 

// [GET] admin/accounts
Route::prefix('accounts')->group(base_path('routes/admin/AccountRoute.php'));

// [GET] admin/roles
Route::prefix('roles')->group(base_path('routes/admin/RoleRoute.php'));