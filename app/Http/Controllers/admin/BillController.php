<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BillModel;
use App\Helpers\HelperProduct;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request; 

class BillController extends Controller {
  // [GET] admin/bills
  public function index(Request $req) {
    try {
      
      $bills = DB::select("SELECT Id_HD, user.Name, DATE(Oder_date) AS Oder_date, bill.Status, Type_bill, Total_price
      FROM bill 
      JOIN user ON user.Id_KH = bill.Id_KH" );

      //pagination 
      $quantity = 7;

      if($req->Quantity){
        $quantity = $req->Quantity;
      }

      $pagination = [
        'currentPage' => 1,
        'limitItem' => $quantity,
        'skipRecords' => 0
      ];
      $totalRecords =  count($bills);
      HelperProduct::pagination($req, $pagination, $totalRecords);

      $bills = array_slice($bills, $pagination['skipRecords'], $pagination['limitItem']);
      //End pagination

      return view("admin/pages/Bills/index", [
        'bills' => $bills,
        'pagination' => $pagination
      ]);
      
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  }

  // [GET] admin/bills/detail
  public function BillDetail(Request $req) {
    try {
      
      $billDetails = DB::select("SELECT bill.Id_HD, product.Id_SP, user.Name as NameUser, product.Name as NameProduct, product.Image, Oder_date, bill.Status, Type_bill, bill_detail.Price, bill_detail.Quantity, bill.Total_price
        FROM bill 
        JOIN user ON user.Id_KH = bill.Id_KH
          JOIN bill_detail ON bill.Id_HD = bill_detail.Id_HD
          JOIN product ON bill_detail.Id_SP = product.Id_SP
          WHERE bill.Id_HD = ? AND Type_bill = 'buy' ", [$req->id] );

        // return $billDetails;

      return view("admin/pages/Bills/detail", [
        'billDetails' => $billDetails,
      ]);
      
    } catch (\Exception $e) {
        return  $e->getMessage();
    }
  }

  // // [GET] admin/Bills/delete
  // public function deleteItem(Request $req) {
  //   try {
  //     $check = false;
  //     foreach($req->Permissions as $item) if($item == "Bill:delete") $check = true;

  //     if($check == false){
  //       return redirect()->back()->with(['type' => 'warning', 'message' => 'Bạn không có quyền hạn xóa danh mục!']);
  //     }
  //     BillModel::where('Id_DM', $req->id)->update(['Deleted' => true]);
  //     return redirect()->back()->with(['type' => 'success', 'message' => 'Xóa danh mục thành công']);
  //   } catch (\Exception $e) {
  //       return  $e->getMessage();
  //   }
  // }
  
  // // [GET] admin/Bills/create
  // public function create(Request $req) {
  //   try {
  //     $check = false;
  //     foreach($req->Permissions as $item) if($item == "Bill:create") $check = true;

  //     if($check == false){
  //       return redirect()->back()->with(['type' => 'warning', 'message' => 'Bạn không có quyền hạn tạo mới danh mục!']);
  //     }
  //     return view("admin/pages/Bills/create");
  //   } catch (\Exception $e) {
  //       return  $e->getMessage();
  //   }
  // } 

  // // [POST] admin/Bills/create
  // public function createPost(Request $req) {
  //   try {
  //     $product = BillModel::create([
  //       'Name' => $req->Name,
  //     ]);
      
  //     return redirect()->back()->with(['type' => 'success', 'message' => 'Thêm sản phẩm thành công']);
  //   } catch (\Exception $e) {
  //       return  $e->getMessage();
  //   }
  // } 

  // // [GET] admin/Bills/edit
  // public function edit(Request $req) {
  //   try {
  //     $check = false;
  //     foreach($req->Permissions as $item) if($item == "Bill:edit") $check = true;

  //     if($check == false){
  //       return redirect()->back()->with(['type' => 'warning', 'message' => 'Bạn không có quyền chỉnh sửa xem danh mục!']);
  //     }

  //     $Bills = BillModel::select('Id_DM', 'Name')
  //     ->where(['Id_DM' => $req->id , 'Deleted' => false])->get();

  //     return view("admin/pages/Bills/edit", ['Bills' => $Bills]);
  //   } catch (\Exception $e) {
  //       return  $e->getMessage();
  //   }
  // }

  // // [PTACH] admin/Bills/edit
  // public function editPatch(Request $req) {
  //   try {
  //     BillModel::where('Id_DM', $req->id)->update(['Name' => $req->Name]);
  //     return redirect()->back()->with(['type' => 'success', 'message' => 'Sửa danh mục thành công']);
  //   } catch (\Exception $e) {
  //       return  $e->getMessage();
  //   }
  // }
}
