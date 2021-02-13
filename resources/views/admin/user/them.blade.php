@extends('admin.layout.index')

@section('content')

<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">

                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                    {{$err}}<br>
                                @endforeach
                            </div>
                        @endif

                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                <p>{{ session('thongbao') }}</p>
                            </div>
                        @endif

                        @if(session('loi'))
                            <div class="alert alert-danger">
                                <p>{{ session('loi') }}</p>
                            </div>
                        @endif
                        
                        <form action="admin/user/them" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Họ tên</label>
                                <input class="form-control" name="hoten" placeholder="Nhập vào Họ Tên" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Nhập vào email">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Nhập vào password">
                            </div>
                            <div class="form-group">
                                <label>Nhập lại Password</label>
                                <input type="password" name="nlpassword" class="form-control" placeholder="Nhập lại password">
                            </div>
                            <div class="form-group">
                                <label>Phân quyền</label>
                                <label class="radio-inline">
                                    <input name="quyen" value="0" checked="" type="radio"> User
                                </label>
                                <label class="radio-inline">
                                    <input name="quyen" value="1" type="radio">Admin
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Đặt Lại</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

@endsection