<?php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RequireAuthenAdmin;

//Route admin
Route::prefix('admin')
  ->middleware(RequireAuthenAdmin::class)
  ->group(base_path('routes/admin/indexRoute.php'));

//Route client
require base_path('routes/client/indexRoute.php');


//Route authentication
Route::prefix('authen')->group(base_path('routes/auth/Authentication.php'));




// use Illuminate\Support\Facades\File;
// Route::get('/provinces', function () {
//     $path = base_path('node_modules/hanhchinhvn/dist/tinh_tp.json');
//     $json = File::get($path);
//     $provinces = json_decode($json, true);
//     return response()->json($provinces);
// });
