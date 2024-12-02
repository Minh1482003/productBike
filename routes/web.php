<?php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RequireAuthenAdmin;
use Illuminate\Support\Facades\File;


//Route admin
Route::prefix('admin')
  ->middleware(RequireAuthenAdmin::class)
  ->group(base_path('routes/admin/indexRoute.php'));

//Route client
require base_path('routes/client/indexRoute.php');


//Route authentication
Route::prefix('authen')->group(base_path('routes/auth/Authentication.php'));

//Route vnpay
Route::prefix('vnpay')->group(base_path('routes/VnPay/VnPayRoute.php'));








Route::get('/provinces', function () {
  $path = base_path('node_modules/hanhchinhvn/dist/tinh_tp.json');
  $json = File::get($path);
  $provinces = json_decode($json, true);
  return response()->json($provinces);
});

Route::get('/districts/{code}', function ($code) {
  $path = base_path('node_modules/hanhchinhvn/dist/quan_huyen.json');

  $json = File::get($path);
  $districts = json_decode($json, true);

  $filteredDistricts = array_filter($districts, function ($district) use ($code) {
      return $district['parent_code'] === $code;
  });

  return response()->json($filteredDistricts);
});

Route::get('/wards/{code}', function ($code) {
  $path = base_path('node_modules/hanhchinhvn/dist/xa_phuong.json');

  $json = File::get($path);
  $wards = json_decode($json, true);
  
  $filteredWards = array_filter($wards, function ($wards) use ($code) {
    return $wards['parent_code'] === $code;
  });
  
  return response()->json($filteredWards);
});
