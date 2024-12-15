<?php
namespace App\Http\Controllers\Client;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\CartModel;
use App\Models\BillModel;
use App\Models\BillDetailModel;
use App\Models\UserModel;

use App\Helpers\HelperProduct;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller {
  //[GET] index
  public function index(Request $req) {
    // return "ok";
    $find = [
      ['Deleted', '=', '0'],
      ['Buy_or_rent', '=', 'buy'],
      ['Status', '=', 'active']
    ];

    // Render products
    $products = ProductModel::select('Id_SP','Slug', 'Name', 'Buy_or_rent', 'Image', 'Price', 'Price_Hour', 'Price_Day','Quantity', 'Status', 'Position')
      ->where($find)
      ->take(8)
      ->orderBy('Position', 'asc')
      ->get();

    return view("client/home/index", [
      'products' => $products,
    ]);
  }

  //[GET] detail
  public function detail(Request $req) {
    $find = [
      ['Deleted', '=', '0'],
      ['Status', '=', 'active']
    ];

    if($req->slug){
      $find[] = ['Slug', '=', $req->slug];
    }
   
    $product = ProductModel::select('Id_SP', 'Slug', 'Name', 'Buy_or_rent','Image', 'Description', 'Price', 'Price_hour', 'Price_day','Quantity')
      ->where($find)
      ->first();

    // return $product;

    return view("client/home/detail", [
      'product' => $product,
    ]);
  }

  //[GET] Products
  public function productBuy(Request $req) {
    $find = [
      ['Deleted', '=', '0'],
      ['Buy_or_rent', '=', 'buy'],
      ['Status', '=', 'active']
    ];

    // Render products
    $productBuys = ProductModel::select('Id_SP', 'Slug', 'Name', 'Buy_or_rent', 'Image', 'Price', 'Price_Hour', 'Price_Day','Quantity', 'Status', 'Position')
      ->where($find)
      ->take(30)
      ->orderBy('Position', 'asc')
      ->get();
    
    return view("client/home/productBuy", [
      'products' => $productBuys,
    ]);
  }

  //[GET] CreateCart
  public function createCart(Request $req) {
    try {
      $checkSP = CartModel::select('Id_SP', 'Quantity')
        ->where([
          ['Id_KH', '=', $req->Id_KH],
          ['Id_SP', '=', $req->Id_SP]
        ])->first();

      if($checkSP != NULL){
        $ok = CartModel::where('Id_SP', $req->Id_SP)
          ->update(['Quantity' => $checkSP->Quantity + 1]);
      } else {
        $ok = CartModel::create([
          'Id_KH' => $req->Id_KH,
          'Id_SP' => $req->Id_SP
        ]);
      }

      if($ok){
        return redirect()->back()->with(['type' => 'success', 'message' => 'Đã thêm sản phẩm vào giỏ hàng']);
      } else {
        return redirect()->back()->with(['type' => 'success', 'message' => 'Thêm sản phẩm vào giỏ hàng thất bại!']);
      }
      
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  } 

  //[GET] Products
  public function cartProduct(Request $req) {
    $productCarts = DB::select("SELECT product.Id_SP, product.Name, product.Image, product.Price, cart.Quantity
    FROM cart
    JOIN product ON cart.Id_SP = product.Id_SP
    JOIN user ON cart.Id_KH = user.Id_KH
    WHERE user.Id_KH = ? AND product.Buy_or_rent = ? AND product.Deleted = 'false' ", [$req->Id_KH, 'buy']);

    return view("client/home/cart", [
      'productCarts' => $productCarts,
    ]);
  }

  //[GET] Products
  public function deleteCart(Request $req) {
    $ok = cartModel::where([
      ['Id_SP', '=', $req->Id_SP],
      ['Id_KH', '=',  $req->Id_KH],
      ])->delete();
    if($ok){
      return redirect()->back()->with(['type' => 'success', 'message' => 'Xóa sản phẩm thành công']);
    } else {
      return redirect()->back()->with(['type' => 'danger', 'message' => 'Xóa sản phẩm thất bại!']);
    }
  }
  
  // [POST] cart/checkout
  public function checkout(Request $req) {
    $keyCheckout = $req->Username."_checkout";
    
    if(session()->has('$keyCheckout')){
      session()->forget($keyCheckout);
    }

    $req->session()->put($keyCheckout, $req->data);
    
    $arrData = explode(", ", $req->data);

    $productCart = [];

    foreach ($arrData as $item){
      $parts = explode('__', $item);

      $productData = [
        'id' => $parts[0],
        'image' => $parts[1],
        'quantity' => $parts[2],
        'name' => $parts[3],
        'price' => $parts[4]
      ];

    $productCart[] = $productData;
   
    }
    // return $productCart;

    return view("client/home/checkout", [
      'productCart' => $productCart,
      'dataCheckout' => $req->data,
      'toltalCart' => $req->toltalCart
    ]);

  }

  // [POST] cart/checkoutfinal
  public function checkoutFinal(Request $req) {
    // Tạo hóa đơn
    $newBill = BillModel::create([
      'Id_KH' => $req->Id_KH, 
      'Status' => 'Chờ đặt cọc', 
      'Type_bill' => 'buy',
      'Total_price' => $req->toltalPrice
    ]);

    //End tạo hóa đơn

    $keyCheckout = $req->Username."_checkout";
    $dataCheckout = $req->session()->get($keyCheckout);

    $arrData = explode(", ", $dataCheckout);

    $productCart = [];
    $arrIdSP = []; $ArrQuantity = [];

    $idBill = $newBill->Id_HD;

    foreach ($arrData as $item){
      $parts = explode('__', $item);

      $productData = [
        'Id_HD' => $idBill,
        'Id_SP' => $parts[0], 
        'Quantity' => $parts[2], 
        'Price' => $parts[4]
      ];

      $productCart[] = $productData;

      $productModel = ProductModel::find($parts[0]);
      if($productModel){
        $productModel->Quantity -= $parts[2];
        $productModel->save();
      }
      

      $cartModel = CartModel::where([
        ['Id_SP', '=', $parts[0]],
        ['Id_KH', '=', $req->Id_KH]
        ])->delete();

    }
  
    if(session()->has($keyCheckout)){
      session()->forget($keyCheckout);
    }

    $ok = BillDetailModel::insert($productCart);

    $req->toltalPrice * 0.9;

    if($ok){
      $vnp_Amount = $req->toltalPrice * 0.1;
      $vnp_TxnRef = $idBill;

      return redirect()->route('vnpay.create')
        ->with('vnp_Amount', $vnp_Amount)
        ->with('vnp_TxnRef', $vnp_TxnRef);
    } else {
      return redirect()->back()->with(['type' => 'success', 'danger' => 'Đặt hàng thất bại!']);
    }
  }


  // [PATCH] updateUser
  public function updateUser(Request $req) {

    $addressUpdate = NULL;
    if(isset($req->provincesUD) && $req->provincesUD != "---"){
      $provinceId = $req->provincesUD; // Mã tỉnh
      // $province = Http::get("https://provinces.open-api.vn/api/p/{$provinceId}");
  
      $districtId = $req->districtUD; // Mã quận/huyện
      // $district = Http::get("https://provinces.open-api.vn/api/d/{$districtId}");
  
      $wardsId = $req->wardsUD; // Mã xã/phường
      // $wards = Http::get("https://provinces.open-api.vn/api/w/{$wardsId}");
      $addressDetail = $req->addressUD;
      
      $addressUpdate = "{$provinceId}__{$districtId}__{$wardsId}__{$addressDetail}";
    }

    $user = [
      'Name' => $req->NameUD,
      'SDT' => $req->SDTUD,
    ]; 
    
    if($addressUpdate != NULL) $user['Address'] =  $addressUpdate;

    $ok = UserModel::where('Id_KH', $req->Id_KH)->update($user);

    if($ok){
      return response()->json([
        'Alert' => "cập nhật thông tin thành công"
      ]);
    } else {
      return response()->json([
        'Alert' => "Cập nhật thông tin thất bại!"
      ]);
    }
  }

  //[GET] rent
  public function productRent(Request $req) {

    $find = [
      ['Deleted', '=', '0'],
      ['Buy_or_rent', '=', 'rent'],
      ['Status', '=', 'active']
    ];

    // Render products
    $productRents = ProductModel::select('Id_SP', 'Slug', 'Name', 'Buy_or_rent', 'Image', 'Price', 'Price_Hour', 'Price_Day','Quantity', 'Status', 'Position')
      ->where($find)
      ->take(30)
      ->orderBy('Position', 'asc')
      ->get();
    
    return view("client/home/productRent", [
      'products' => $productRents,
    ]);
  }

  //[POST] rentoder
  public function rentOder(Request $req) {
    $find = [
      ['Deleted', '=', '0'],
      ['Buy_or_rent', '=', 'rent'],
      ['Status', '=', 'active'],
      ['Id_SP','=', $req->IdSP_Rent]
    ];

    // Render products
    $productRent = ProductModel::select('Id_SP', 'Name', 'Buy_or_rent', 'Image', 'Description', 'Price_Hour', 'Price_Day','Quantity', 'Status', 'Position')
      ->where($find)
      ->first();

    return view("client/home/rentOrder", [
      'quantity' => $req->Quantity_Rent,
      'productRent' => $productRent,
    ]);
  }

  // [POST] /rentSubmit
  public function rentSubmit(Request $req) {
    // Tạo hóa đơn

    $Rental_start = Carbon::createFromFormat('H:i d/m/Y', $req->timeStartRent);
    $Rent_expectedEnd = Carbon::createFromFormat('H:i d/m/Y', $req->timeEndRent);
  
    $newBill = BillModel::create([
      'Id_KH' => $req->Id_KH, 
      'Status' => 'Chờ xác nhận',
      'Type_bill' => 'rental',
      'Total_price' => $req->ToltalPriceRent
    ]);

    //End tạo hóa đơn

    $idBill = $newBill->Id_HD;

    $productData = [
      'Id_HD' => $idBill,
      'Id_SP' => $req->IdSP, 
      'Quantity' => $req->Quantity,
      'Rental_start' => $Rental_start,
      'Rental_expectedEnd' => $Rent_expectedEnd,
      'Rental_term' => $req->rental_term
    ];

    $productModel = ProductModel::find($req->IdSP);
    if($productModel){
      $productModel->Quantity -= $req->Quantity;
      $productModel->save();
    }
  
    $ok = BillDetailModel::insert($productData);

    if($ok){
      return view("vnpay/rentalSuccess", [
        'idBill' => $idBill,
        'ToltalPriceRent' => $req->ToltalPriceRent,
        'Rental_start' => $Rental_start,
        'Rental_expectedEnd' => $Rental_start,
        'Rental_term' => $req->rental_term
      ]);
    } else {
      return redirect()->back()->with(['type' => 'success', 'danger' => 'Đặt hàng thất bại!']);
    }
  }
}
 