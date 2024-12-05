<?php
namespace App\Http\Controllers\VnPay;

use App\Http\Controllers\Controller;
use App\Models\BillModel;

use Illuminate\Http\Request;

class VnPayController extends Controller {
  public function createPayment(Request $request) {
    $id_oder = session('vnp_TxnRef');
    $deposit = session('vnp_Amount');

    $vnp_TmnCode = "ULYBVY1P"; // Mã website tại VNPAY 
    $vnp_HashSecret = "D1GU861KDBVURSQJJ3WQH7BEYUU97UCS"; // Chuỗi bí mật
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_ReturnUrl = route('vnpay.return');

    $vnp_TxnRef = "DH".$id_oder; // Mã đơn hàng
    $vnp_OrderInfo = "Thanh toán tiền cọc đơn hàng"; //Mội dung đơn hàng
    $vnp_OrderType = "billpayment";
    $vnp_Amount = $deposit * 100; // Số tiền thanh toán
    $vnp_Locale = "vn";
    $vnp_BankCode = $request->bank_code;
    $vnp_IpAddr = $request->ip();

    $inputData = array(
      "vnp_Version" => "2.1.0",
      "vnp_TmnCode" => $vnp_TmnCode,
      "vnp_Amount" => $vnp_Amount,
      "vnp_Command" => "pay",
      "vnp_CreateDate" => date('YmdHis'),
      "vnp_CurrCode" => "VND",
      "vnp_IpAddr" => $vnp_IpAddr,
      "vnp_Locale" => $vnp_Locale,
      "vnp_OrderInfo" => $vnp_OrderInfo,
      "vnp_OrderType" => $vnp_OrderType,
      "vnp_ReturnUrl" => $vnp_ReturnUrl,
      "vnp_TxnRef" => $vnp_TxnRef,
    );

    if ($vnp_BankCode) {
      $inputData['vnp_BankCode'] = $vnp_BankCode;
    }

    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnp_Url = $vnp_Url . "?" . $query;
    $vnp_Url .= 'vnp_SecureHash=' . hash_hmac('sha512', $hashdata, $vnp_HashSecret);

    return redirect()->to($vnp_Url);
  }

  public function returnPayment(Request $request) {
    
   
    $vnp_HashSecret = "D1GU861KDBVURSQJJ3WQH7BEYUU97UCS"; // Chuỗi bí mật

    $inputData = $request->all();

    $vnp_SecureHash = $inputData['vnp_SecureHash'];
    unset($inputData['vnp_SecureHash']);

    ksort($inputData);
    $i = 0;
    $hashData = "";
    foreach ($inputData as $key => $value) {
      if ($i == 1) {
        $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
      } else {
        $hashData .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
      }
    }

    $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

    BillModel::where('Id_HD', $req->orderId)->update(['Status' => 'Đã cọc chờ xác nhận']);

    if ($secureHash == $vnp_SecureHash) {
      if ($inputData['vnp_ResponseCode'] == '24') {
        return view('vnpay/paysuccess', [
            'orderId' => $inputData['vnp_TxnRef'],
            'amount' => $inputData['vnp_Amount'] / 100
        ]);
      } 
    } else {
      return "sai";
      // Dữ liệu không hợp lệ
      // return view('vnpay.invalid');
    }
  }
}