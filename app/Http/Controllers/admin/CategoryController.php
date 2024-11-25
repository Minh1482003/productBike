<?php
namespace App\Http\Controllers\Admin;
use App\Models\CategoryModel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller {
  // [GET] admin/categorys
  public function index(Request $req) {
    try {
      $check = false;
      foreach($req->Permissions as $item) if($item == "category:view") $check = true;

      if($check == false){
        return redirect()->back()->with(['type' => 'warning', 'message' => 'Bạn không có quyền hạn xem danh mục!']);
      }

      $categorys = CategoryModel::select('Id_DM', 'Name')
      ->where(['Deleted' => false])->get();

      return view("admin/pages/categorys/index", ['categorys' => $categorys]);
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  }

  // [GET] admin/categorys/delete
  public function deleteItem(Request $req) {
    try {
      $check = false;
      foreach($req->Permissions as $item) if($item == "category:delete") $check = true;

      if($check == false){
        return redirect()->back()->with(['type' => 'warning', 'message' => 'Bạn không có quyền hạn xóa danh mục!']);
      }
      CategoryModel::where('Id_DM', $req->id)->update(['Deleted' => true]);
      return redirect()->back()->with(['type' => 'success', 'message' => 'Xóa danh mục thành công']);
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  }
  
  // [GET] admin/categorys/create
  public function create(Request $req) {
    try {
      $check = false;
      foreach($req->Permissions as $item) if($item == "category:create") $check = true;

      if($check == false){
        return redirect()->back()->with(['type' => 'warning', 'message' => 'Bạn không có quyền hạn tạo mới danh mục!']);
      }
      return view("admin/pages/categorys/create");
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  } 

  // [POST] admin/categorys/create
  public function createPost(Request $req) {
    try {
      $product = CategoryModel::create([
        'Name' => $req->Name,
      ]);
      
      return redirect()->back()->with(['type' => 'success', 'message' => 'Thêm sản phẩm thành công']);
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  } 

  // [GET] admin/categorys/edit
  public function edit(Request $req) {
    try {
      $check = false;
      foreach($req->Permissions as $item) if($item == "category:edit") $check = true;

      if($check == false){
        return redirect()->back()->with(['type' => 'warning', 'message' => 'Bạn không có quyền chỉnh sửa xem danh mục!']);
      }

      $categorys = CategoryModel::select('Id_DM', 'Name')
      ->where(['Id_DM' => $req->id , 'Deleted' => false])->get();

      return view("admin/pages/categorys/edit", ['categorys' => $categorys]);
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  }

  // [PTACH] admin/categorys/edit
  public function editPatch(Request $req) {
    try {
      CategoryModel::where('Id_DM', $req->id)->update(['Name' => $req->Name]);
      return redirect()->back()->with(['type' => 'success', 'message' => 'Sửa danh mục thành công']);
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  }
}
