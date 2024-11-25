<?php
namespace App\Http\Controllers\Client;

use App\Models\ProductModel;
use App\Models\CategoryModel;

use App\Helpers\HelperProduct;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller {
  //[GET] index
  public function index(Request $req) {
    $find = [
      ['Deleted', '=', '0'],
      ['Buy_or_rent', '=', 'buy'],
      ['Status', '=', 'active']
    ];

    // Render products
    $products = ProductModel::select('Slug', 'Name', 'Buy_or_rent', 'Image', 'Price', 'Price_Hour', 'Price_Day','Quantity', 'Status', 'Position')
      ->where($find)
      ->take(8)
      ->orderBy('Position', 'asc')
      ->get();

    return view("client/home/index", [
      'products' => $products,
    ]);
  }

  //[GET] index
  public function detail(Request $req) {
    $find = [
      ['Deleted', '=', '0'],
      ['Status', '=', 'active']
    ];

    if($req->slug){
      $find[] = ['Slug', '=', $req->slug];
    }
   
    $product = ProductModel::select('Slug', 'Name', 'Image', 'Description', 'Price', 'Price_hour', 'Price_day','Quantity')
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
    $productBuys = ProductModel::select('Slug', 'Name', 'Buy_or_rent', 'Image', 'Price', 'Price_Hour', 'Price_Day','Quantity', 'Status', 'Position')
      ->where($find)
      ->take(30)
      ->orderBy('Position', 'asc')
      ->get();
    
    return view("client/home/productBuy", [
      'products' => $productBuys,
    ]);
  }

  //[POST] CreateCart
  public function createCart(Request $req) {
    try {
      return "ok";
      // $product = CategoryModel::create([
      //   'Name' => $req->Name,
      // ]);
      
      // return redirect()->back()->with(['type' => 'success', 'message' => 'Thêm sản phẩm thành công']);
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  } 

  //[GET] Products
  public function cartProduct(Request $req) {
    // $find = [
    //   ['Deleted', '=', '0'],
    //   ['Buy_or_rent', '=', 'buy'],
    //   ['Status', '=', 'active']
    // ];

    // // Render products
    // $productBuys = ProductModel::select('Slug', 'Name', 'Buy_or_rent', 'Image', 'Price', 'Price_Hour', 'Price_Day','Quantity', 'Status', 'Position')
    //   ->where($find)
    //   ->take(30)
    //   ->orderBy('Position', 'asc')
    //   ->get();
    
    return view("client/home/cart", [
      // 'products' => $productBuys,
    ]);
  }
  
}
