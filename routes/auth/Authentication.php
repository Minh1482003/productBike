<?php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckLogin;
use App\Http\Controllers\auth\AuthenController;

use App\Http\Middleware\CheckAccount;

//[GET] Login
Route::get('/login', [AuthenController::class, 'login'])->name('authen.login');

Route::post('/login', [AuthenController::class, 'loginPost'])
  ->middleware(CheckLogin::class);

Route::get('/logout', [AuthenController::class, 'logout'])->name('authen.logout');
//End Logout

//[GET] register
Route::get('/register', [AuthenController::class, 'register'])->name('authen.register');

Route::post('/register', [AuthenController::class, 'registerPost'])->name('authenPost.register')
  ->middleware(CheckAccount::class);

//[GET] SendEmai
Route::get('/sendEmail', [AuthenController::class, 'sendEmail'])->name('sendEmai.Verify');

Route::get('/sendOtp', [AuthenController::class, 'sendOtp'])->name('sendOtp.Verify');

Route::post('/sendOtp', [AuthenController::class, 'sendOtpPost'])->name('sendOtpPost.Verify');
//[POST] SendOTP