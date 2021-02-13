@extends('layout.index')

@section('title','Tìm Kiếm')

@section('content') 
	
	<div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                        <h4><b>Tìm Kiếm: {{$tukhoa}}</b></h4>
                    </div>
                    @foreach($tintuc as $tt)
                        <div class="row-item row">
                            <div class="col-md-3">

                                <a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">
                                    <br>
                                    <img width="200px" height="200px" class="img-responsive" src="upload/tintuc/{{$tt->Hinh}}" alt="">
                                </a>
                            </div>

                            <div class="col-md-9">
                                <h3>{{$tt->TieuDe}}</h3>
                                <p>{{$tt->TomTat}}</p>
                                <a class="btn btn-primary" href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">Xem Thêm <span class="glyphicon glyphicon-chevron-right"></span></a>
                            </div>
                            <div class="break"></div>
                        </div>

                    @endforeach

                    {{ $tintuc->links('vendor.pagination.default') }}

                </div>
            </div>
               

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-lg-3">

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