<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;

class TheLoaiController extends Controller
{
    //xem danh sách
    public function getDanhSach() {
    	$theloai = TheLoai::all();
    	return view('admin.theloai.danhsach', ['theloai'=>$theloai]);
    }


    //Thêm
    public function getThem() {
    	return view('admin.theloai.them');
    }

    public function postThem(Request $request) {

    	$this->validate($request,
    		[
    			'Ten' => 'required|min:3|max:100|unique:theloai'
    		],
    		[
    			'Ten.required' => 'Bạn chưa nhập tên thể loại',
    			'Ten.min' => 'Tên thể loại phải có độ dài từ 3 cho đến 100 ký tự',
    			'Ten.max' => 'Độ dài vượt quá 100 ký tự',
                'Ten.unique' =>'Tên thể loại đã tồn tại'
    		]);
    	$theloai = new TheLoai();
    	$theloai->Ten = $request->Ten;
    	$theloai->TenKhongDau = changeTitle($request->Ten);
    	$theloai->save();

    	return redirect('admin/theloai/them')->with('thongbao','Thêm thành công!');
    }

    //Xóa

    public function getXoa($id) {
        $theloai = TheLoai::find($id);
        $theloai->delete();
        return redirect('admin\theloai\danhsach')->with('thongbao','Bạn đã xóa thành công thể loại có id là'.' '.$id);
    }

    //Sửa
    public function getSua($id) {
        $theloai = TheLoai::findOrFail($id);
        return view('admin.theloai.sua',['theloai' => $theloai]);
    }
    public function postSua(Request $request, $id) {
        $this->validate($request,
            [
                'Ten' => 'required|min:3|max:100|unique:TheLoai'
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên thể loại',
                'Ten.min' => 'Tên thể loại phải có độ dài từ 3 cho đến 100 ký tự',
                'Ten.max' => 'Độ dài vượt quá 100 ký tự',
                'Ten.unique' =>'Tên thể loại đã tồn tại'
            ]);
        $theloai = TheLoai::find($id);
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();

        return redirect('admin/theloai/danhsach')->with('thongbao','Sửa thành công!');
    }
}

