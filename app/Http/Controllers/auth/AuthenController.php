<?php
namespace App\Http\Controllers\auth;

use App\Models\UserModel;
use App\Models\RoleModel;

use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthenController extends Controller {
  // [GET] authen/login
  public function login(Request $req) {
    try {
      return view("auth/login");
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  }

  // [POST] authen/login
  public function loginPost(Request $req) {
    try {
      $user = UserModel::select('Id_KH', 'Username', 'Email', 'Status', 'Password', 'Token', 'Id_role')
      ->where(['Email' => $req->Email, 'Deleted' => false])->first();
      
      if($user == NULL){
        return redirect()->back()->with(['type' => 'warning', 'message' => 'Email không tồn tại!']);
      }
   
      if(!Hash::check($req->Password, $user->Password)) {
        return redirect()->back()->with(['type' => 'warning', 'message' => 'Mật khẩu sai vui lòng nhập lại!']);
      }

      if($user->Status == 'inactive'){
        return redirect()->back()->with(['type' => 'danger', 'message' => 'Tài khoản đang tạm khóa!']);
      }
      
      if($user->Id_role != 0){
        return redirect("admin/products")->cookie('Token', $user->Token, 60 * 24);
      } else {
        return redirect()->route('home.index')->cookie('Token', $user->Token, 60 * 24);
      }

    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  }

  // [GET] authen/logout
  public function logout(Request $req) {
    try {
      Cookie::queue(Cookie::forget('Token'));
      return view("auth/login");
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  }

   // [GET] authen/register
  public function register(Request $req) {
    try {
      return view("auth/register");
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  }

   // [POST] authen/register
  public function registerPost(Request $req) {
    try {
      $user = [
        'Name' => $req->Name,
        'Username' => $req->Username,
        'Password' => $req->Password_1,
        'Email' => $req->Email,
        'Deleted' => false
      ];
      
      // if($req->SDT) $user['SDT'] = $req->SDT;
  
      $ok = UserModel::create($user);
      unset($user['Password']);

      if($ok){
        return redirect(route('sendEmai.Verify', ['user' => $user]));
      } else {
        return redirect()->back()->with(['type' => 'waring', 'message' => 'Đăng kí tài khoản thất bại!']);
      }
      
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  }

   // [POST] authen/sendEmail
  public function sendEmail(Request $req) {
    try {
      $user = $req->query('user');

      $verifyCode = rand(100000, 999999); 
  
      $toEmail = $user['Email']; 
      $name = "Xin chào, <b>".$user['Name']."</b> mã xác thực tài khoản trên Bike Shop của bạn là, <b>$verifyCode</b> .Mã này sẽ hết hạn trong vòng 5 phút vui lòng không chia sẻ mã này cho bất kỳ ai.";

      $cacheKey = 'verify_code_' . $toEmail;
      Cache::put($cacheKey, $verifyCode, now()->addMinutes(5));

      $ok = Mail::to($toEmail)->send(new SendMail($name));
      if($ok){
        return redirect(route('sendOtp.Verify', ['Email' => $toEmail]));
      } else {
        return redirect()->back()->with(['type' => 'waring', 'message' => 'Gửi emai thất bại!']);
      }
     
    } catch (\Exception $e) {
        return $e->getMessage();
    }

  }

   // [GET] authen/sendOtp
  public function sendOtp(Request $req) {
    try {
      return view("auth/email/verifyotp", [ 'Email' => $req->Email ]);
    } catch (\Exception $e) {
        return $e->getMessage();
    }
  }

   // [POST] authen/sendOtp
  public function sendOtpPost(Request $req) {
    try {
      $strOtp = join('', $req->otp);
      $OtpCache = Cache::get('verify_code_'.$req->Email);

      if($strOtp == $OtpCache){
        $ok = UserModel::where('Email', $req->Email)->update(['Is_verify' => true]);
        
        if($ok){  
          Cache::forget('verify_code_'.$req->Email);
          return redirect()->route('authen.login')->with(['type' => 'success', 'message' => 'Hoàn tất việc xác thực mời bạn đăng nhập']);
        } else {
          return redirect()->route('authen.login')->with(['type' => 'danger', 'message' => 'Xách thực không thành công vui lòng thử xác thực lại']);
        }
      } else {
        return $strOtp ."==". $OtpCache;
        return redirect()->back();
      }

      
    } catch (\Exception $e) {
        return $e->getMessage();
    }
  }
}