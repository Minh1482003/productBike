<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckProduct {
  public static function handle(Request $req, Closure $next) {

    if(strlen($req->Name) < 6){
      return redirect()->back()->with(['type' => 'danger', 'message' => 'Tiêu đề ít nhất hơn có 6 kí tự']);
    }
    else if( $req['Price'] == NULL &&  $req['PriceHour'] == NULL && $req['PriceDay'] == NULL){
      return redirect()->back()->with(['type' => 'danger', 'message' => 'Không được bỏ trống giá sản phẩm']);
    } 
    // else if ($req['image'] == NULL) {
    //   return redirect()->back()->with(['type' => 'danger', 'message' => 'Yêu cầu sản phẩm có ảnh']);
    // }

    return $next($req);
  }
}