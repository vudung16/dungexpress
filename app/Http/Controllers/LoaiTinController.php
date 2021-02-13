<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiTin;
use App\Models\TheLoai;

class LoaiTinController extends Controller
{
    public function getDanhSach() {
    	$loaitin = LoaiTin::all();
    	return view('admin.loaitin.danhsach', ['loaitin'=>$loaitin]);
    }

     //Thêm
    public function getThem() {
    	$theloai = TheLoai::all();
    	return view('admin.loaitin.them',['theloai'=>$theloai]);
    }

    public function postThem(Request $request) {

    	$this->validate($request,
    		[
    			'Ten' => 'required|min:3|max:100|unique:loaitin',
    			'TheLoai' => 'required'
    		],
    		[
    			'Ten.required' => 'Bạn chưa nhập tên loại tin',
    			'Ten.min' => 'Tên loại tin phải có độ dài từ 3 cho đến 100 ký tự',
    			'Ten.max' => 'Độ dài vượt quá 100 ký tự',
                'Ten.unique' =>'Tên loại tin đã tồn tại',
                'TheLoai.required' => 'Bạn chưa nhập thể loại'
    		]);
    	$loaitin = new LoaiTin();
    	$loaitin->Ten = $request->Ten;
    	$loaitin->TenKhongDau = changeTitle($request->Ten);
    	$loaitin->idTheLoai = $request->TheLoai;
    	$loaitin->save();

    	return redirect('admin/loaitin/danhsach')->with('thongbao','Thêm thành công!');
    }

    //Sửa

    public function getSua($id){
    	$theloai = TheLoai::all();
    	$loaitin = LoaiTin::find($id);
    	return view('admin.loaitin.sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }

    public function postSua(Request $request, $id){
    	$this->validate($request,
	            [
	                'Ten' => 'required|min:3|max:100|unique:LoaiTin'
	            ],
	            [
	                'Ten.required' => 'Bạn chưa nhập tên thể loại',
	                'Ten.min' => 'Tên thể loại phải có độ dài từ 3 cho đến 100 ký tự',
	                'Ten.max' => 'Độ dài vượt quá 100 ký tự',
	                'Ten.unique' =>'Tên thể loại đã tồn tại'
	            ]);
        $loaitin = LoaiTin::find($id);
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();

        return redirect('admin/loaitin/sua/'.$id)->with('thongbao','Sửa thành công!');
	}

	//Xóa

	public function getXoa($id){
		$loaitin = LoaiTin::find($id);
		$loaitin->delete();

		return redirect('admin/loaitin/danhsach')->with('thongbao','Xóa thành công!');

	}

}
