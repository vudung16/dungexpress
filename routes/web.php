<?php

use Illuminate\Support\Facades\Route;
use App\Models\TheLoai;
use App\Http\Controllers\TheLoaiController;
use App\Models\TinTuc;
use App\Http\Controllers\TinTucController;
use App\Models\LoaiTin;
use App\Http\Controllers\LoaiTinController;
use App\Models\User;
use App\Http\Controllers\UserController;
use App\Models\Slide;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PageController;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PageController::class, 'trangchu']);
Route::get('trangchu', [PageController::class, 'trangchu'])->middleware('verified_email');

Route::get('gioithieu', [PageController::class, 'gioithieu']);

Route::get('lienhe', [PageController::class, 'getlienhe']);
Route::post('lienhe', [PageController::class, 'postlienhe']);

//thông tin tài khoản
Route::get('caidat/{id}', [PageController::class, 'getSua']);
Route::post('caidat/{id}', [PageController::class, 'postSua']);

//tìm kiếm
Route::get('timkiem', [PageController::class, 'timkiem']);


//đăng nhập admin
Route::get('admin/login', [UserController::class, 'getDangnhapAdmin']);
Route::post('admin/login', [UserController::class, 'postDangnhapAdmin']);

//Đăng xuất admin
Route::get('admin/logout', [UserController::class, 'logout']);

//dangxuat user
Route::get('dangxuat', [PageController::class, 'logout']);


//dangnhap user
Route::get('dangnhap', [PageController::class, 'getDangNhap']);
Route::post('dangnhap', [PageController::class, 'postDangNhap']);

//dangky user
Route::get('dangky', [PageController::class, 'getDangKy']);
Route::post('dangky', [PageController::class, 'postDangKy']);

Route::get('loaitin/{id}/{TenKhongDau}.html', [PageController::class, 'loaitin']);
Route::get('tintuc/{id}/{TieuDeKhongDau}.html', [PageController::class, 'tintuc']);
// Đăng comment
Route::post('comment/{id}', [CommentController::class, 'postComment']);





// xác thực email
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('trangchu');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');






//phần admin
Route::group(['prefix'=>'admin', 'middleware'=>'adminLogin'], function() {
	Route::group(['prefix'=>'theloai'], function() {
		// admin/theloai/sua
		Route::get('danhsach', [TheLoaiController::class, 'getDanhSach']);
		Route::get('sua/{id}', [TheLoaiController::class, 'getSua']);
		Route::post('sua/{id}', [TheLoaiController::class, 'postSua']);
		Route::get('them', [TheLoaiController::class, 'getThem']);
		Route::post('them', [TheLoaiController::class, 'postThem']);
		Route::get('xoa/{id}', [TheLoaiController::class, 'getXoa']);
	});

	Route::group(['prefix'=>'loaitin'], function() {
		// admin/loaitin/sua
		Route::get('danhsach', [LoaiTinController::class, 'getDanhSach']);
		Route::get('sua/{id}', [LoaiTinController::class, 'getSua']);
		Route::post('sua/{id}', [LoaiTinController::class, 'postSua']);
		Route::get('them', [LoaiTinController::class, 'getThem']);
		Route::post('them', [LoaiTinController::class, 'postThem']);
		Route::get('xoa/{id}', [LoaiTinController::class, 'getXoa']);
	});

	Route::group(['prefix'=>'tintuc'], function() {
		// admin/tintuc/sua
		Route::get('danhsach', [TinTucController::class, 'getDanhSach']);
		Route::get('sua/{id}', [TinTucController::class, 'getSua']);
		Route::post('sua/{id}', [TinTucController::class, 'postSua']);
		Route::get('them', [TinTucController::class, 'getThem']);
		Route::post('them', [TinTucController::class, 'postThem']);
		Route::get('xoa/{id}', [TinTucController::class, 'getXoa']);
	});

	Route::group(['prefix'=>'comment'], function() {
			// admin/tintuc/sua
		Route::get('xoa/{id}/{idtintuc}', [CommentController::class, 'getXoa']);
	});

	Route::group(['prefix'=>'user'], function() {
		// admin/user/sua
		Route::get('danhsach', [UserController::class, 'getDanhSach']);
		Route::get('sua/{id}', [UserController::class, 'getSua']);
		Route::post('sua/{id}', [UserController::class, 'postSua']);
		Route::get('them', [UserController::class, 'getThem']);
		Route::post('them', [UserController::class, 'postThem']);
		Route::get('xoa/{id}', [UserController::class, 'getXoa']);
	});

	Route::group(['prefix'=>'slide'], function() {
		// admin/slide/sua
		Route::get('danhsach', [SlideController::class, 'getDanhSach']);
		Route::get('sua/{id}', [SlideController::class, 'getSua']);
		Route::post('sua/{id}', [SlideController::class, 'postSua']);
		Route::get('them', [SlideController::class, 'getThem']);
		Route::post('them', [SlideController::class, 'postThem']);
		Route::get('xoa/{id}', [SlideController::class, 'getXoa']);
	});

	Route::group(['prefix'=>'ajax'], function() {
		Route::get('loaitin/{idTheLoai}', [AjaxController::class, 'getLoaiTin']);
	});
});




