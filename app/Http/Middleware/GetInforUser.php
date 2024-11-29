<?php
namespace App\Http\Middleware;
use App\Models\UserModel;
use Illuminate\Support\Facades\Session;
use Closure;
use Illuminate\Http\Request;

class GetInforUser {
  public function handle(Request $req, Closure $next) {
    try {
      $Token = $req->cookie('Token'); 
      
      if($Token != NULL){
        // $sessionKey = 'user_data_'.$Token;
        
        // if (session()->has($sessionKey)) {
          // $userData = session($sessionKey);

          // $req->merge($userData->toArray());

          // view()->share('userData', $userData);
          // return $next($req);
        // }

        // dd($Token);
        // return;
        
        $user = UserModel::select('Id_KH', 'Name', 'Image','Username', 'Email', 'SDT', 'Status',	'Address')
        ->where(['Token' => $Token, 'Deleted' => false, 'Status' => 'active'])->first();

        

        if($user == NULL){
          return redirect("authen/login")->with(['type' => 'warning', 'message' => 'Tài khoản không tồn tại !']);
        } else {

          $userData = $user;

          // Lưu phiên dữ liệu đăng nhập
          // Session::put($sessionKey, $userData);
      
          $req->merge($userData->toArray());

          view()->share('userData', $userData);
        }
      }

      return $next($req);

    } catch (\Exception $e) {
      \Log::error('User Info Middleware Error: ' . $e->getMessage());
      // return redirect("authen/login")->with(['type' => 'warning', 'message' => 'Có lỗi!']);
    }
  }
}