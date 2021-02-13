<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;
use App\Models\LoaiTin;
use App\Models\Slide;
use App\Models\TinTuc;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Alert;

class PageController extends Controller
{
	public function __construct() {
		$theloai = TheLoai::all();
		$slide = Slide::orderBy('id','DESC')->limit(5)->get();
        $tinnoibat = TinTuc::orderBy('id','DESC')->where('NoiBat',1)->orWhere('SoLuotXem','>','10')->take(5)->get();
		view()->share('theloai',$theloai);
		view()->share('slide',$slide);
        view()->share('tinnoibat',$tinnoibat);
	}

    public function trangchu() {
    	return view('pages.trangchu');
    }
    public function gioithieu() {
        return view('pages.gioithieu');
    }
    public function getlienhe() {
        return view('pages.lienhe');
    }
    public function postlienhe(Request $request) {
        Mail::send('pages.postlienhe', [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'noidung'=>$request->noidung
        ], function($mail) use($request){
            $mail->to('dungshinichi99@gmail.com',$request->name);
            $mail->from($request->email);
            $mail->subject('Thông tin liên hệ');
        });

        return redirect('/lienhe')->with('thongbao','Gửi phản hồi thành công');
    }


    public function loaitin($id) {
    	$loaitin = LoaiTin::find($id);
    	$tintuc = TinTuc::orderBy('id','DESC')->where('idLoaiTin',$id)->paginate(5);
    	return view('pages.loaitin', ['loaitin'=>$loaitin, 'tintuc'=>$tintuc]);
    }

    public function tintuc($id) {
    	$tintuc = TinTuc::find($id);
    	$tinnoibat = TinTuc::orderBy('id','DESC')->where('NoiBat',1)->orWhere('SoLuotXem','>','10')->take(5)->get();
    	$tinlienquan = TinTuc::orderBy('idLoaiTin','DESC')->where('idLoaiTin',$tintuc->idLoaiTin)->take(5)->get();
        $luotxem = TinTuc::where('id', $id)->update(['SoLuotXem' => $tintuc->SoLuotXem+1]);
    	return view('pages.tintuc', ['tintuc'=>$tintuc, 'tinnoibat'=>$tinnoibat, 'tinlienquan'=>$tinlienquan, 'luotxem'=>$luotxem]);
    }


    public function getDangNhap() {
    	return view('pages.dangnhap');
    }
    public function postDangNhap(Request $request) {
    	$this->validate($request,
            [
                'email' => 'required',
                'password' => 'required|min:6|max:20'
            ],
            [
                'email.required' => 'Bạn chưa nhập vào email',
                'password.required' => 'Bạn chưa nhập vào password',
                'password.min' => 'Độ dài mật khẩu tối thiểu 6 kí tự',
                'password.max' =>'Độ dài mật khẩu tối đa 20 kí tự'
            ]);

    	$credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

    	if(Auth::attempt($credentials)){
            alert()->success('Đăng nhập', 'thành công');
    		return redirect('trangchu');

    	} else {
            alert()->error('Đăng nhập thất bại', 'Nhập lại mật khẩu và tài khoản');
    		return redirect('dangnhap')->with('errors', 'Đăng nhập thất bại!');
    	}

    }
    public function logout() {
    	Auth::logout();
    	return redirect('trangchu');
    }

    public function getDangKy() {
        return view('pages.dangky');
    }

    public function postDangKy(Request $request) {
        $this->validate($request, [
            'hoten' => 'required|min:3|max:30',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:30',
            'nlpassword' => 'required|same:password'
        ],[
            'hoten.required' => 'Bạn chưa nhập họ tên',
            'hoten.min' => 'Độ dài họ tên phải tối thiểu có 3 kí tự',
            'hoten.max' => 'Độ dài họ tên tối đa là 30 kí tự',
            'email.required' => 'Bạn chưa nhập email',
            'emai.email' => 'Bạn chưa nhập dúng email',
            'email.unique' => 'Email vừa nhập đã tồn tại',
            'password.required' => 'Bạn chưa nhập password',
            'password.min' => 'Độ dài mật khẩu phải tối thiểu có 8 kí tự',
            'password.max' => 'Độ dài mật khẩu tối đa là 30 kí tự',
            'nlpassword.required' => 'Bạn chưa nhập lại password',
            'nlpassword.same' => 'Mật khẩu nhập lại không khớp'
        ]);

        $user = new User;
        $user->name = $request->hoten;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        event(new Registered($user));

        return redirect('trangchu')->with('thongbao','Bạn đã thêm thành công user '.$user->name);
    }



    public function timkiem(Request $request) {

        $tukhoa = $request->search;
        $tinnoibat = TinTuc::orderBy('id','DESC')->where('NoiBat',1)->orWhere('SoLuotXem','>','10')->take(5)->get();
        $tintuc = TinTuc::orderBy('id','DESC')->where('TieuDe','like',"%$tukhoa%")->orWhere('TomTat','like',"%$tukhoa%")->orWhere('NoiDung','like',"%$tukhoa%")->take(30)->paginate(5);
        return view('pages.timkiem', ['tintuc'=>$tintuc, 'tukhoa'=>$tukhoa, 'tinnoibat'=>$tinnoibat]);

    }


//sửa tài khoản người dùng

    public function getSua($id) {
        $user = User::find($id);
        return view('pages.profile', ['user'=>$user]);
    }

    public function postSua(Request $request, $id) {
        $this->validate($request, [
            'hoten' => 'required|min:3|max:30',
        ],[
            'hoten.required' => 'Bạn chưa nhập họ tên',
            'hoten.min' => 'Độ dài họ tên phải tối thiểu có 3 kí tự',
            'hoten.max' => 'Độ dài họ tên tối đa là 30 kí tự'
        ]);

        $user = User::find($id);
        $user->name = $request->hoten;

        if($request->changePassword == "on") {

            $this->validate($request, [
                'password' => 'required|min:8|max:30',
                'nlpassword' => 'required|same:password'
            ],[
                'password.required' => 'Bạn chưa nhập password',
                'password.min' => 'Độ dài mật khẩu phải tối thiểu có 8 kí tự',
                'password.max' => 'Độ dài mật khẩu tối đa là 30 kí tự',
                'nlpassword.required' => 'Bạn chưa nhập lại password',
                'nlpassword.same' => 'Mật khẩu nhập lại không khớp'
            ]);

            $user->password = bcrypt($request->password);
        }



        $user->save();

        return redirect('caidat/'.$id)->with('thongbao','Bạn đã sửa thành công');
    
    }
}
