<?php
namespace App\Http\Controllers\Admin;
use App\Models\UserModel;
use App\Models\RoleModel;
use App\Helpers\HelperProduct;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller {
  // [GET] admin/accounts
  public function index(Request $req) {
    $check = false;
    
    foreach($req->Permissions as $item){
      if($item == "user:view") $check = true;
      
    }
    if($check == false){
      return redirect()->back()->with(['type' => 'warning', 'message' => 'Bạn không được cấp quyền xem tài khoản!']);
    }

    $find = [
      ['Deleted', '=', '0'],
    ];
    
    // Status Filter
    $filterStatus = HelperProduct::filterStatus($req);
    if($req->status){
      $find[] = ['Status', '=', $req->status];
    }
    
    try {
      $accounts = UserModel::select('Id_KH', 'Name', 'Image','Username', 'Email', 'SDT', 'Status',	'Address', 'createdAt', 'Id_role')
      ->where(['Deleted' => false])->get();

      $roles = RoleModel::select('Id_role', 'Name', 'Description')
        ->where(['Deleted' => false])->get();

      return view("admin/pages/accounts/index", [
        'accounts' => $accounts, 
        'filterStatus' => $filterStatus,
        'roles' => $roles
      ]);
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  }

  // [PATCH] admin/accounts/deleted
  public function deleteItem(Request $req) {
    try {
      $check = false;
    
      foreach($req->Permissions as $item){
        if($item == "user:delete") $check = true;
        
      }
      if($check == false){
        return redirect()->back()->with(['type' => 'warning', 'message' => 'Bạn không được cấp quyền xem tài khoản!']);
      }

      UserModel::where('Id_KH', $req->id)->update(['Deleted' => true]);
      return redirect()->back()->with(['type' => 'success', 'message' => 'Xóa khách hàng thành công']);
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  }

  // [PATCH] admin/accounts/change-status
  public function changeStatus(Request $req) {
    try {
      $check = false;

      foreach($req->Permissions as $item){
        if($item == "product:edit") $check = true;
      }
      if($check == false){
        return redirect()->back()->with(['type' => 'warning', 'message' => 'Bạn không được cấp quyền chỉnh sửa sản phẩm!']);
      }

      $ok = UserModel::where('Id_KH', $req->id)->update(['Status' => $req->status]);
    
      if ($ok) {
        return redirect()->back()->with(['type' => 'success', 'message' => 'Thay đổi trạng thái thành công!']);
      } else {
        return redirect()->back()->with(['type' => 'warning', 'message' => 'Thay đổi trạng thái Thất bại!']);
      }
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  }
  
  // [GET] admin/accounts/create
  public function create(Request $req) {
    try {
      $check = false;
    
      foreach($req->Permissions as $item){
        if($item == "user:create") $check = true;
        
      }
      if($check == false){
        return redirect()->back()->with(['type' => 'warning', 'message' => 'Bạn không được cấp quyền tạo tài khoản!']);
      }

      return view("admin/pages/accounts/create");
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  } 

  // [POST] admin/products/create
  public function createPost(Request $req) {
    try {
      $user = [
        'Name' => $req->Name,
        'Username' => $req->Username,
        'Password' => $req->Password_1,
        'Email' => $req->Email,
        'Address' => $req->Address,
        'Status' => $req->Status,
        'Deleted' => false
      ];
      if($req->image_name) $user['Image'] = $req->image_name;
      
      if($req->SDT) $user['SDT'] = $req->SDT;
 
      UserModel::create($user);
      
      return redirect()->back()->with(['type' => 'success', 'message' => 'Thêm khách hàng thành công']);
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  } 

    // [GET] admin/accounts/edit
  public function edit(Request $req) {
    try {
      $check = false;
    
      foreach($req->Permissions as $item){
        if($item == "user:edit") $check = true;
      }
      if($check == false){
        return redirect()->back()->with(['type' => 'warning', 'message' => 'Bạn không được cấp quyền chỉnh sửa tài khoản!']);
      }

      $users = UserModel::select('Id_KH', 'Name', 'Image','Username', 'Email', 'SDT', 'Status',	'Address')
      ->where(['Id_KH' => $req->id, 'Deleted' => false])->get();

      return view("admin/pages/accounts/edit", ['users' => $users]);
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  }

  // [PTACH] admin/accounts/edit
  public function editPatch(Request $req) {
    try {
      $user = [
        'Name' => $req->Name,
        'Username' => $req->Username,
        'Email' => $req->Email,
        'SDT' => $req->SDT,
        'Address' => $req->Address,
        'Status' => $req->Status,
        'Deleted' => false
      ];
      if($req->image_name) $user['Image'] = $req->image_name;
      
      if($req->SDT) $user['SDT'] = $req->SDT;

      UserModel::where('Id_KH', $req->id)->update($user);
      return redirect()->back()->with(['type' => 'success', 'message' => 'Sửa tài khoản thành công']);
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  }

  // [PTACH] admin/accounts/provide-role
  public function provideRole(Request $req) {
    try {
      $check = false;
      foreach($req->Permissions as $item) if($item == "role:provide") $check = true;

      if($check == false){
        return redirect()->back()->with(['type' => 'warning', 'message' => 'Bạn không có quyền, cấp quyền cho người khác!']);
      }

      $idUser = $req->id_user;
      $idRole = $req->id_role;

      $ok = UserModel::where('Id_KH', $idUser)->update(['Id_role' => $idRole]);
      if($ok){
        return redirect()->back()->with(['type' => 'success', 'message' => 'Cấp mới quuyền thành công']);
      } else {
        return redirect()->back()->with(['type' => 'warning', 'message' => 'Cấp mới quuyền thất bại!']);
      }
      
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  }
  
  
}
