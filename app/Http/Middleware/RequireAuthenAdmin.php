<?php
namespace App\Http\Middleware;
use App\Models\UserModel;
use App\Models\RoleModel;

use Illuminate\Support\Facades\Cache;
use Closure;
use Illuminate\Http\Request;

class RequireAuthenAdmin {
  public function handle(Request $req, Closure $next) {

    $Token = $req->cookie('Token'); 
    if($Token == NULL){
      return redirect("authen/login")->with(['type' => 'warning', 'message' => 'Vui lòng đăng nhập trước !']);
    }

    try {
      // $cacheKey = 'user_data_'. $Token;
       
      // if (Cache::has($cacheKey)) {
      //   $userData = Cache::get($cacheKey);
      //   view()->share($userData);
        
      //   $req->merge($userData);
        
      //   return $next($req);
      // }

      $user = UserModel::select('Name', 'Image','Username', 'Id_role')
      ->where(['Token' => $Token, 'Deleted' => false, 'Status' => 'active'])->first();
   
      if($user->Id_role == 0){
        return redirect()->back()->withInput()->with(['type' => 'danger', 'message' => 'Bạn không được cấp quyền vào đây!']);
      }

      if($user == NULL){
        return redirect("authen/login")->with(['type' => 'warning', 'message' => 'Vui lòng đăng nhập trước !']);
      } else {

        $role = RoleModel::select('Name', 'Description', 'Permission')
        ->where(['Id_role' => $user->Id_role, 'Deleted' => false])->first();

        $arrPermissions = [];

        if($role && $role->Permission){
          $arrPermissions = explode("__", $role->Permission);
        } 

        $userData = [
          'User' => $user,
          'Permissions' => $arrPermissions
        ];

        // Cache data trong 20 phút
        // Cache::put($cacheKey, $userData, now()->addMinutes(20));
        
        view()->share($userData);

        $req->merge($userData);
      }
      
      return $next($req);

    } catch (\Exception $e) {
      return redirect("authen/login")->with(['type' => 'warning', 'message' => 'Có lỗi xảy ra với đăng nhập!']);
    }
  }
}