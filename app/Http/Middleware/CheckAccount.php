<?php
namespace App\Http\Middleware;
use App\Models\UserModel;

use Closure;
use Illuminate\Http\Request;

class CheckAccount {
  public function handle(Request $request, Closure $next) {
    // Kiểm tra Name
    if (!$request->has('Name') || strlen($request->Name) < 6) {
      return redirect()->back()->withInput()->with(['type' => 'danger', 'message' => 'Tên phải có ít nhất 6 ký tự']);
    }

    // Kiểm tra Email
    if (!$request->has('Email') || !filter_var($request->Email, FILTER_VALIDATE_EMAIL)) {
      return redirect()->back()->withInput()->with(['type' => 'danger', 'message' => 'Email không hợp lệ !']); 
    }

    $existingEmail = UserModel::select('Email')->where('Email', $request->Email)->first();

    if ($existingEmail) {
        return redirect()->back()->withInput()->with(['type' => 'danger', 'message' => 'Email đã được sử dụng']);
    }

    // Kiểm tra Username
    if (!$request->has('Username') || strlen($request->Username) < 6) {
        return redirect()->back()->withInput()->with(['type' => 'danger', 'message' => 'Username phải có ít nhất 6 ký tự']);
    }

    $existingUsername = UserModel::select('Email')->where('Username', $request->Username)->first();
    if ($existingUsername) {
      return redirect()->back()->withInput()->with(['type' => 'danger', 'message' => 'Username đã tồn tại']);
     }

    // Kiểm tra Password
    if (strlen($request->Password_1) < 6) {
      return redirect()->back()->withInput()->with(['type' => 'danger', 'message' => 'Mật khẩu phải có ít nhất 8 ký tự']);
    }

    if($request->Password_1 != $request->Password_2){
      return redirect()->back()->withInput()->with(['type' => 'danger', 'message' => 'Mật khẩu không trùng nhau']);
    }

    return $next($request);
  }
}