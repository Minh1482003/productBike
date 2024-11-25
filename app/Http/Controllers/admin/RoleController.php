<?php
namespace App\Http\Controllers\Admin;
use App\Models\RoleModel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller {
  // [GET] admin/products
  public function index(Request $req) {
    try {
      $check = false;
      foreach($req->Permissions as $item) if($item == "role:view") $check = true;

      if($check == false){
        return redirect()->back()->with(['type' => 'warning', 'message' => 'Bạn không có quyền hạn xem quyền!']);
      }

      $roles = RoleModel::select('Id_role', 'Name', 'Description')
        ->where(['Deleted' => false])->orderBy('Id_role', 'desc')->get();

      return view("admin/pages/roles/index", ['roles' => $roles]);
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  }

  // [GET] admin/roles/delete
  public function deleteItem(Request $req) {
    try {
      $check = false;
      foreach($req->Permissions as $item) if($item == "role:delete") $check = true;

      if($check == false){
        return redirect()->back()->with(['type' => 'warning', 'message' => 'Bạn không quyền hạn xóa quyền!']);
      }

      $ok = RoleModel::where('Id_role', $req->id)->update(['Deleted' => true]);
   
      if ($ok) {
        return redirect()->back()->with(['type' => 'success', 'message' => 'Xóa quyền thành công']);
      } else {
        return redirect()->back()->with(['type' => 'warning', 'message' => 'Xóa quyền thất bại!']);
      }
      
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  }

  // [GET] admin/roles/create
  public function create(Request $req) {
    try {
      $check = false;
      foreach($req->Permissions as $item) if($item == "role:create") $check = true;

      if($check == false){
        return redirect()->back()->with(['type' => 'warning', 'message' => 'Bạn không có quyền hạn tạo mới quyền!']);
      }

      return view("admin/pages/roles/create");
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  } 

  // [GET] admin/roles/create
  public function createPost(Request $req) {
    try {
      
      $data = $req->CreatePermissions;

      $permissions = NULL;
      // return $req;
      if($data) $permissions = implode('__', $data);
  
      $ok = RoleModel::create([
        'Name' => $req->Name,
        'Description' => $req->Description,
        'Permission' => $permissions
      ]);
      if ($ok) {
        return redirect()->back()->with(['type' => 'success', 'message' => 'Thêm mới quyền thành công!']);
      } else {
        return redirect()->back()->with(['type' => 'warning', 'message' => 'Thêm mới quyền Thất bại!']);
      } 
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  } 

  // [GET] admin/categorys/edit
  public function edit(Request $req) {
    try {
      $check = false;
      foreach($req->Permissions as $item) if($item == "role:edit") $check = true;

      if($check == false){
        return redirect()->back()->with(['type' => 'warning', 'message' => 'Bạn không có quyền hạn chỉnh sửa quyền!']);
      }

      $roles = RoleModel::select('Id_role', 'Name' ,'Description', 'Permission')
      ->where(['Id_role' => $req->id , 'Deleted' => false])->get();

      $arrPermissions = [];

      if($roles[0]->Permission){
        $arrPermissions = explode("__", $roles[0]->Permission); //Tách chuỗi thành mảng
      } 
  
      return view("admin/pages/roles/edit", [
        'arrPermissions' => $arrPermissions,
        'roles' => $roles
      ]);
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  }

  // [PTACH] admin/categorys/edit
  public function editPatch(Request $req) {
    try {
      $data = $req->UpdatePermissions;
      $permissions = NULL;

      if($data) $permissions = implode('__', $data);

      $ok = RoleModel::where('Id_role', $req->id)->update([
        'Name' => $req->Name,
        'Description' => $req->Description,
        'Permission' => $permissions
      ]);
      if ($ok) {
        return redirect()->back()->with(['type' => 'success', 'message' => 'Sửa quyền thành công!']);
      } else {
        return redirect()->back()->with(['type' => 'warning', 'message' => 'Sửa quyền Thất bại!']);
      }
      
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  }

}