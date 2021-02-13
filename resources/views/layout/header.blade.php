<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top nav-header" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img src="image/logomd1.png" alt="">
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="trangchu">TRANG CHỦ</a></li>
                    <li><a href="gioithieu">GIỚI THIỆU</a></li>
                    <li><a href="lienhe">LIÊN HỆ</a></li>
                </ul>
                <ul class="nav navbar-nav" >
                    @if(Auth::user())
                     <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>
                            {{Auth::user()->name}}
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="caidat/{{Auth::user()->id}}"><i class="fa fa-gear fa-fw"></i> Cài đặt</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="dangxuat"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    @else
                     <li><a href="dangnhap">ĐĂNG NHẬP</a></li>
                     <li><a>|</a></li>
                     <li><a href="dangky">ĐĂNG KÝ</a></li>
                    @endif
                </ul>
                <form action="timkiem" method="get" class="navbar-form navbar-left" role="search">
                    @csrf
                    <input type="text" name="search" class="ip-search form-search" placeholder="Tìm kiếm...">
                    <button type="submit" class="btn-search"><img src="image/icon-search.png" alt=""></button>
                </form>
            </div>


            
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
