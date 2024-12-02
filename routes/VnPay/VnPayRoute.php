<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VnPay\VnPayController;

Route::get('/create-payment', [VnPayController::class, 'createPayment'])->name('vnpay.create');

Route::get('/vnpay-return', [VNPayController::class, 'returnPayment'])->name('vnpay.return');