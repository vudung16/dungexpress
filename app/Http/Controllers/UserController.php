<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Comment;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function getDanhSach() {
        $user = User::all();
        return view('admin.user.danhsach', ['user'=>$user]);
    }

    public function getThem(Request $request) {
        $user = User::all();
        return view('admin.user.them', ['user'=>$user]);
    }

    public function postThem(Request $request) {
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
        $user->quyen = $request->quyen;
        $user->save();

        return redirect('admin/user/them')->with('thongbao','Bạn đã thêm thành công user '.$user->name);
    }

    public function getSua($id) {
        $user = User::find($id);
        return view('admin.user.sua', ['user'=>$user]);
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
        $user->quyen = $request->quyen;

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

        return redirect('admin/user/sua/'.$id)->with('thongbao','Bạn đã sửa thành công');
    
    }

    public function getXoa($id) {
        $user = User::find($id);
        $comment = Comment::where('idUser',$id);
        $comment->delete();
        $user->delete();

        return redirect('admin/user/danhsach')->with('thongbao','Bạn đã xóa thành công user '.$user->name);
    }

    public function getDangnhapAdmin() {
    	return view('admin.login');
    }

    public function postDangnhapAdmin(Request $request){
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
    		return redirect('admin/theloai/danhsach')->with('thongbao','Đăng nhập thành công');

    	} else {
    		return redirect('admin/login')->with('errors', 'Đăng nhập thất bại!');
    	}
    }


    public function logout() {
        Auth::logout();
            return redirect('admin/login');
        
    }
}
