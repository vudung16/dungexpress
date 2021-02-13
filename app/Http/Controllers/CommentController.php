<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiTin;
use App\Models\TheLoai;
use App\Models\Comment;
use App\Models\TinTuc;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{

	//Xóa

	public function getXoa($id, $idtintuc){
		$comment = Comment::find($id);
		$comment->delete();

		return redirect('admin/tintuc/sua/'.$idtintuc)->with('thongbao','Xóa Comment thành công!');

	}

	public function postComment(Request $request, $id) {
		if(Auth::user()) {
			$idTinTuc = $id;

			$tintuc = TinTuc::find($id);
			$comment = new Comment;
			$comment->idTinTuc = $idTinTuc;
			$comment->idUser = Auth::user()->id;
			$comment->NoiDung = $request->NoiDung;
			$comment->save();

			return redirect("tintuc/$id/".$tintuc->TieuDeKhongDau.".html")->with('thongbao','Viết bình luận thành công');
		} else {
			alert()->info('Bạn cần đăng nhập để bình luận bài viết này');
			return redirect('dangnhap');
		}

	}

}
