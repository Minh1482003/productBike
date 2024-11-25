<?php
namespace App\Http\Middleware;
use App\Models\UserModel;

use Closure;
use Illuminate\Http\Request;

class CheckLogin {
  public function handle(Request $req, Closure $next) {
    // Kiểm tra Email
    if (!$req->has('Email') || !filter_var($req->Email, FILTER_VALIDATE_EMAIL)) {
      return redirect()->back()->withInput()->with(['type' => 'warning', 'message' => 'Email không hợp lệ !']); 
    }

    // Kiểm tra Password
    if (strlen($req->Password) < 6) {
      return redirect()->back()->withInput()->with(['type' => 'warning', 'message' => 'Mật khẩu phải có ít nhất 6 ký tự']);
    }

    return $next($req);
  }
}