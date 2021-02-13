<footer>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<h5>VỀ CHÚNG TÔI</h5><br>
					<p><span class="dungexpress">DungExpress.vn</span> được thành lập vào tháng 8 năm 2020, hứa hẹn là một trang web hàng đầu chuyên cung cấp các tin tức chính thống trong nước và ngoài nước</p>
					<p>
						<img src="image/mail.png" alt="">&emsp;	
						<span>dungvm720@wru.vn</span>
					</p>
                    <p>
                    	<img src="image/phone.png" alt="">&emsp;
						<span>0386132297</span>
                    </p>   
				</div>
				<div class="danhmuc col-sm-3">
					<h5>DANH MỤC</h5><br>
					<p><a href="#"><i class="fas fa-angle-right"></i>&emsp;Sự kiện</a></p>
					<p><a href="#"><i class="fas fa-angle-right"></i>&emsp;Xã hội</a></p>
					<p><a href="#"><i class="fas fa-angle-right"></i>&emsp;Thế giới</a></p>
					<p><a href="#"><i class="fas fa-angle-right"></i>&emsp;Giáo dục</a></p>
					<p><a href="#"><i class="fas fa-angle-right"></i>&emsp;Nhịp sống trẻ</a></p>
				</div>
				<div class="col-sm-3">
					<h5>TIN TỨC NỔI BẬT</h5><br>
					@foreach($tinnoibat as $tt)
					<p><a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html"><i class="fas fa-angle-right"></i>&emsp;{{$tt->TieuDe}}</a></p>
					@endforeach
					<!-- <p><a href="#"><i class="fas fa-angle-right"></i>&emsp;Năng lượng mặt trời: Những ý tưởng sáng tạo và ngộ nghĩnh</a></p>
					<p><a href="#"><i class="fas fa-angle-right"></i>&emsp;Năng lượng mặt trời: Những ý tưởng sáng tạo và ngộ nghĩnh</a></p> -->
				</div>
				<div class="col-sm-3">
					<h5>FANPAGE</h5><br>
					<div class="fb-page" data-href="https://www.facebook.com/DungExpressvn-102346218427527" data-tabs="timeline" data-width="230" data-height="200" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/DungExpressvn-102346218427527" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/DungExpressvn-102346218427527">DungExpress.vn</a></blockquote></div>
				</div>
			</div>
		</div>
	</footer>