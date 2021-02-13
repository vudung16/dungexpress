@extends('layout.index')
@section('title','Liên Hệ')
<style>
	
	section	.container {
	    width: 100%;
	    margin: auto;
	    border-radius: 5px;
	    background-color: #f2f2f2;
	    padding: 20px;
	}
	input[type=text], input[type=email]{
		width: 100%;
		padding: 12px;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
		margin-top: 6px;
		margin-bottom: 16px;
		resize: vertical;
	}
	 
	input[type=submit] {
	    background-color: #4CAF50;
	    color: white;
	    padding: 12px 20px;
	    border: none;
	    border-radius: 4px;
	    cursor: pointer;
	}
	 
	input[type=submit]:hover {
	    background-color: #45a049;
	}
</style>

@section('content')
	<div class="container">

    	<!-- slider -->
    	@include('layout.slide')
        <!-- end slide -->

        <div class="space20"></div>


        <div class="row main-left">
            @include('layout.menu')

            <div class="col-md-9">
	            <section>
				   <div class="container">
				     <div class="containerinfo">
				       <div>
				         <h2>Thông Tin Liên Hệ</h2>
				         <ul class="info">
				           <li>
				             <span><i class="fa fa-map-marker" aria-hidden="true"></i></span>
				             <span>Thôn Nguyên Hanh, Văn Tự, Thường Tín, Hà Nội
				             </span>
				           </li>
				           <li>
				             <span><i class="fa fa-envelope" aria-hidden="true"></i></span>
				             <span>dungvm720@wru.vn</span>
				           </li>
				          <li>
				             <span><i class="fa fa-phone-square" aria-hidden="true"></i></span>
				             <span>0386132297</span>
				           </li>
				         </ul>
				       </div>
				    </div>
				</section>

				@if(session('thongbao'))
                    <div class="alert alert-success">
                        <p>{{ session('thongbao') }}</p>
                    </div>
                @endif

				<section>
				   <div class="container">
					    <h2>Liên hệ với chúng tôi</h2><br>
					    <form action="lienhe" method="post">
					    	@csrf
					        <label for="fname">Họ Và Tên</label>
					        <input type="text" id="name" name="name" placeholder="Nhập họ và tên...">
					 
					        <label for="lname">Email</label>
					        <input type="email" id="email" name="email" placeholder="Nhập email...">
					 
					        <label for="country">Số Điện Thoại</label>
					        <input type="text" id="phone" name="phone" placeholder="Nhập số điện thoại...">
					 
					        <label for="address">Địa Chỉ</label>
					        <input type="text" id="address" name="address" placeholder="Nhập địa chỉ...">

					        <label for="noidung">Nội Dung</label>
					        <input type="text" id="noidung" name="noidung" placeholder="Nhập nội dung cần phản hồi...">
					 
					        <input type="submit" value="Gửi Thông Tin">
					    </form>
					</div>
				 </section>
        	</div>
        </div>
        <!-- /.row -->
    </div>
@endsection