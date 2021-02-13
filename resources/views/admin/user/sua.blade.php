@extends('admin.layout.index')

@section('content')

<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>{{$user->name}}</small>
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
                        
                        <form action="admin/user/sua/{{$user->id}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Họ tên</label>
                                <input class="form-control" name="hoten"value="{{$user->name}}" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email"value="{{$user->email}}" readonly="" />
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="changePassword" name="changePassword">
                                <label>Password</label>
                                <input type="password" class="form-control password" name="password" disabled="">
                            </div>
                            <div class="form-group">
                                <label>Nhập lại Password</label>
                                <input type="password" class="form-control password" name="nlpassword" disabled="">
                            </div>
                            <div class="form-group">
                                <label>Phân Quyền</label>
                                <label class="radio-inline">
                                    <input name="quyen" value="0" 

                                    @if($user->quyen == 0)
                                        {{"checked"}}
                                    @endif

                                    type="radio"> User
                                </label>
                                <label class="radio-inline">
                                    <input name="quyen" value="1" 
                                    
                                    @if($user->quyen == 1)
                                        {{"checked"}}
                                    @endif

                                    type="radio">Admin
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Đặt Lại</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>

@endsection

@section('script')

    <script>
        $(document).ready(function() {
            $('#changePassword').change(function() {
                if($(this).is(":checked")) {
                    $(".password").removeAttr('disabled');
                } else {
                    $(".password").attr('disabled', '');
                }
            });
        });
    </script>

@endsection