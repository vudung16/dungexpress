@extends('layout.index')
@section('title','Giới thiệu')
@section('content')
<div class="container">

    	<!-- slider -->
    	@include('layout.slide')
        <!-- end slide -->

        <div class="space20"></div>


        <div class="row main-left">
            @include('layout.menu')

            <div class="col-md-9">
	            <h1>Giới Thiệu</h1>
	            <p>Sự ra đời của DUNGEXPRESS.VN xuất phát từ niềm khao khát quản lý một trang web chuyên về tin tức đến với mọi người. Các thông tin, tin thức trong nước và quốc tế được cập nhật thường xuyên, nhanh chóng và chính xác nhất</p>
	            <p>Bạn muốn đóng góp để website tin tức được hoàn thiện tốt hơn vui lòng truy cập <a href="lienhe">vào đây</a></p>
        	</div>
        </div>
        <!-- /.row -->
    </div>

@endsection