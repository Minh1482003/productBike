<?php
namespace App\Http\Controllers\Admin;

use App\Models\ProductModel;
use App\Models\CategoryModel;

use App\Helpers\HelperProduct;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller {
  // [GET] admin/products
  public function index(Request $req) {
    $check = false;
    // return $req;
    foreach($req->Permissions as $item){
      if($item == "product:view") $check = true;
      
    }
    if($check == false){
      return redirect()->back()->with(['type' => 'warning', 'message' => 'Bạn không được cấp quyền xem sản phẩm!']);
    }

    $find = [
      ['Deleted', '=', '0'],
      ['Buy_or_rent', 'REGEXP', 'buy|both']
    ];
   
    // Status Filter
    $filterStatus = HelperProduct::filterStatus($req);
    if($req->status){
      $find[] = ['Status', '=', $req->status];
    }
    // End Status Filter

    // Search
    if($req->keyword){
      $find[] = ['Name', 'like', '%' . $req->keyword . '%'];
    }
    //End search

    //pagination 
    $quantity = 5;

    if($req->Quantity){
      $quantity = $req->Quantity;
    }

    $pagination = [
      'currentPage' => 1,
      'limitItem' => $quantity,
      'skipRecords' => 0
    ];
    $totalRecords = ProductModel::where($find)->count();
    HelperProduct::pagination($req, $pagination, $totalRecords);
    //End pagination
 
    //Sort 
    $sort = ['Position', 'asc'];
    if($req->sortKey && $req->sortValue){
      $sort = [];
      array_push($sort, $req->sortKey, $req->sortValue);
    }
    //End sort 

    // Render products
    $products = ProductModel::select('Id_SP', 'Name', 'Buy_or_rent', 'Image', 'Price', 'Price_Hour', 'Price_Day','Quantity', 'Status', 'Position')
      ->where($find)
      ->skip($pagination['skipRecords'])
      ->take($pagination['limitItem'])
      ->orderBy($sort[0], $sort[1])
      ->get();
    //End render products
    
    return view("admin/pages/products/index", [
      'products' => $products,
      'filterStatus' => $filterStatus,
      'keyword' => $req->keyword,
      'pagination' => $pagination
    ]);
  }
  // [GET] admin/products
  public function indexRent(Request $req) {
    $check = false;

    foreach($req->Permissions as $item){
      if($item == "product:view") $check = true;
    }
    if($check == false){
      return redirect()->back()->with(['type' => 'warning', 'message' => 'Bạn không được cấp quyền xem sản phẩm!']);
    }

    $find = [
      ['Deleted', '=', '0'],
      ['Buy_or_rent', 'REGEXP', 'rent|both']
    ];
    
    // Status Filter
    $filterStatus = HelperProduct::filterStatus($req);
    if($req->status){
      $find[] = ['Status', '=', $req->status];
    }
    // End Status Filter

    // Search
    if($req->keyword){
      $find[] = ['Name', 'like', '%' . $req->keyword . '%'];
    }
    //End search

    //Pagination
    $quantity = 5;
    if($req->Quantity){
      $quantity = $req->Quantity;
    }

    $pagination = [
      'currentPage' => 1,
      'limitItem' => $quantity,
      'skipRecords' => 0
    ];
    $totalRecords = ProductModel::where($find)->count();
    HelperProduct::pagination($req, $pagination, $totalRecords);
    //End pagination
 
    //Sort 
    $sort = ['Position', 'asc'];
    if($req->sortKey && $req->sortValue){
      $sort = [];
      array_push($sort, $req->sortKey, $req->sortValue);
    }
    //End sort 

    // Render products
    $products = ProductModel::select('Id_SP', 'Name', 'Buy_or_rent', 'Image', 'Price', 'Price_Hour', 'Price_Day','Quantity', 'Status', 'Position')
      ->where($find)
      ->skip($pagination['skipRecords'])
      ->take($pagination['limitItem'])
      ->orderBy($sort[0], $sort[1])
      ->get();
    //End render products

    return view("admin/pages/products/indexRent", [
      'products' => $products,
      'filterStatus' => $filterStatus,
      'keyword' => $req->keyword,
      'pagination' => $pagination
    ]);
  }

  // [PATCH] admin/products/change-status
  public function changeStatus(Request $req) {
    try {
      $check = false;

      foreach($req->Permissions as $item){
        if($item == "product:edit") $check = true;
      }
      if($check == false){
        return redirect()->back()->with(['type' => 'warning', 'message' => 'Bạn không được cấp quyền chỉnh sửa sản phẩm!']);
      }

      $ok = ProductModel::where('Id_SP', $req->id)->update(['Status' => $req->status]);
    
      if ($ok) {
        return redirect()->back()->with(['type' => 'success', 'message' => 'Thay đổi trạng thái thành công!']);
      } else {
        return redirect()->back()->with(['type' => 'warning', 'message' => 'Thay đổi trạng thái Thất bại!']);
      }
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  }

  // [PATCH] /admin/products/change-multi
  public function changeMulti(Request $req) {
    $check = false;

    foreach($req->Permissions as $item){
      if($item == "product:edit") $check = true;
    }
    if($check == false){
      return redirect()->back()->with(['type' => 'warning', 'message' => 'Bạn không được cấp quyền xem sản phẩm!']);
    }

    $ids = explode(", ", $req->ids);
    $type = $req->type;
    // return $req;
    switch ($type) {
      case "active" :
        ProductModel::whereIn('Id_SP', $ids)
        ->update([ 'Status' => 'active' ]);
        break;

      case "inactive" :
        ProductModel::whereIn('Id_SP', $ids)
        ->update([ 'Status' => 'inactive' ]);
        break;

      case "delete" :
        foreach($req->Permissions as $item){
          if($item == "product:delete") $check = true;
        }
        if($check == false){
          return redirect()->back()->with(['type' => 'warning', 'message' => 'Bạn không được cấp quyền xem sản phẩm!']);
        }

        ProductModel::whereIn('Id_SP', $ids)
        ->update([ 'Deleted' => true ]);
        break;
      case "change-position":
        foreach ($ids as $item) {
          list($id, $position) = explode('-', $item);
          ProductModel::where('Id_SP', $id)->update(['Position' => $position]);
        }
        break;

      default:
      break;
    }
    return redirect()->back()->with(['type' => 'success', 'message' => 'Cập nhật các sản phẩm thành công']);
  }

  // [PATCH] admin/products/deleted
  public function deleteItem(Request $req) {
    $check = true;

    foreach($req->Permissions as $item){
      if($item == "product:delete") $check = true;
    }
    if($check == false){
      return redirect()->back()->with(['type' => 'warning', 'message' => 'Bạn không được cấp quyền xóa sản phẩm!']);
    }

    try {
      $ok = ProductModel::where('Id_SP', $req->id)->update(['Deleted' => true]);
      if ($ok) {
        return redirect()->back()->with(['type' => 'success', 'message' => 'Xóa sản phẩm thành công!']);
      } else {
        return redirect()->back()->with(['type' => 'warning', 'message' => 'Xóa sản phẩm Thất bại!']);
      }
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  }

  // [GET] admin/products/create
  public function create(Request $req) {
    try {
      $check = false;

      foreach($req->Permissions as $item){
        if($item == "product:create") $check = true;
      }
      if($check == false){
        return redirect()->back()->with(['type' => 'warning', 'message' => 'Bạn không được cấp quyền tạo mới sản phẩm!']);
      }

      $categorys = CategoryModel::select('Id_DM', 'Name')
      ->where(['Deleted' => false])->get();

      return view("admin/pages/products/create", ['categorys' => $categorys]);
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  }

  // [POST] admin/products/createPost
  public function createPost(Request $req) {
    try {

      if($req->Position == NULL){
        $req->Position = ProductModel::where('Deleted', false)->count() + 1;
      }

      ProductModel::create([
        'Name' => $req->Name,
        'Image' => $req->image_name,
        'Price' => $req->Price,
        'Price_hour' => $req->PriceHour,
        'Price_day' => $req->PriceDay,
        'Quantity' => $req->Quantity,
        'Description' => $req->Description,
        'Deleted' => false, 
        'Status' => $req->Status,
        'Position' => $req->Position,
        'Buy_or_rent' => $req->Buy_or_rent,
        'Id_DM' => $req->category
      ]);
      
      return redirect()->back()->with(['type' => 'success', 'message' => 'Thêm sản phẩm thành công']);
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  }
  
  // [GET] admin/products/edit
  public function edit(Request $req) {
    try {
      $check = false;

      foreach($req->Permissions as $item){
        if($item == "product:edit") $check = true;
      }
      if($check == false){
        return redirect()->back()->with(['type' => 'warning', 'message' => 'Bạn không được cấp quyền chỉnh sửa sản phẩm!']);
      }

      $product = ProductModel::select('Id_SP', 'Name', 'Image', 'Price', 'Price_hour', 'Price_day', 'Quantity', 'Description', 'Status', 'Position', 'Buy_or_rent', 'Id_DM')
      ->where(['Id_SP' => $req['id'] , 'Deleted' => false])->first();

      $categorys = CategoryModel::select('Id_DM', 'Name')
      ->where(['Deleted' => false])->get();

      // return $products;
      return view("admin/pages/products/edit", [
        'product' => $product,
        'categorys' => $categorys
      ]);
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  }
  // [PATCH] admin/products/edit
  public function editPatch(Request $req) {
    try {
      if($req->Position == NULL){
        $req->Position = ProductModel::where('Deleted', false)->count() + 1;
      }

      $product = [
        'Name' => $req->Name,
        'Price' => $req->Price,
        'Price_hour' => $req->PriceHour,
        'Price_day' => $req->PriceDay,
        'Quantity' => $req->Quantity,
        'Description' => $req->Description,
        'Deleted' => false, 
        'Status' => $req->Status,
        'Position' => $req->Position,
        'Buy_or_rent' => $req->Buy_or_rent,
        'Id_DM' => $req->category
      ];
      
      if($req->image_name){
        $product['Image'] = $req->image_name;
      }
      ProductModel::where('Id_SP', $req->id)->update($product);
      return redirect()->back()->with(['type' => 'success', 'message' => 'Sửa sản phẩm thành công']);
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  }

}
