@extends('layout.index')

@section('content') 
	
	<div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{$tintuc->TieuDe}}</h1>

                <!-- Author -->
                <p class="lead">
                    Đăng bởi <a href="#">admin</a>
                </p>

                <!-- Preview Image -->
                <img class="img-responsive" src="upload/tintuc/{{$tintuc->Hinh}}" alt="">

                <!-- Date/Time -->
                <br><p><span class="glyphicon glyphicon-time"></span> Ngày đăng:  {{$tintuc->created_at}}</p>
                <p>Lượt xem: {{$tintuc->SoLuotXem}}</p>
                <hr>

                <!-- Post Content -->
                <div>
                	<p class="lead">{!! $tintuc->TomTat !!}</p>
                	<p class="lead">{!! $tintuc->NoiDung !!}</p>
                </div>


                

                <!-- Blog Comments -->

                <!-- Comments Form -->
                
                 

				<div class="well">
                    @if(session('thongbao'))
                        {{session('thongbao')}}
                    @endif
                    <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                    <form role="form" action="comment/{{$tintuc->id}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="NoiDung" rows="3"></textarea>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Gửi">
                    </form>
                </div>
            

                

                <!-- Posted Comments -->

                <!-- Comment -->
                @foreach($tintuc->comment as $cm)
	                <div class="media">
	                    <a class="pull-left" href="#">
	                        <img class="media-object" src="http://placehold.it/64x64" alt="">
	                    </a>
	                    <div class="media-body">
	                        <h4 class="media-heading">{{$cm->user->name}}
	                            <small>{{$cm->created_at}}</small>
	                        </h4>
	                        {{$cm->NoiDung}}
	                    </div>
	                </div>
                @endforeach
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin liên quan</b></div>
                    <div class="panel-body">

                        <!-- item -->
                        @foreach($tinlienquan as $tt)
	                        <div class="row" style="margin-top: 10px;">
	                            <div class="col-md-5">
	                                <a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">
	                                    <img class="img-responsive" src="upload/tintuc/{{$tt->Hinh}}" alt="">
	                                </a>
	                            </div>
	                            <div class="col-md-7">
	                                <a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html"><b>{{$tt->TieuDe}}</b></a>
	                            </div>
	                            <div class="break"></div>
	                        </div>
                        @endforeach
                        <!-- end item -->

                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">

                        <!-- item -->
                        @foreach($tinnoibat as $tt)
	                        <div class="row" style="margin-top: 10px;">
	                            <div class="col-md-5">
	                                <a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">
	                                    <img class="img-responsive" src="upload/tintuc/{{$tt->Hinh}}" alt="">
	                                </a>
	                            </div>
	                            <div class="col-md-7">
	                                <a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html"><b>{{$tt->TieuDe}}</b></a>
	                            </div>
	                            <div class="break"></div>
	                        </div>
                        @endforeach
                    </div>
                </div>
                
            </div>

        </div>
        <!-- /.row -->
    </div>

@endsection