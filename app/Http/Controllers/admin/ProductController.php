<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class ProductController extends Controller {
  public function index() {
    $products = ProductModel::all();
    return view("admin/pages/products/index");
  }
}
