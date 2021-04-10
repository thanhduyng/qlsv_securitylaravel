<!DOCTYPE html>
<html>

<head>
    <title>trang chu</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable = no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/images/logo1.png" type="image/x-icon">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="/js/config.js"></script>
    <link rel="stylesheet" href="/css/footer.css" />
    <link rel="stylesheet" href="/css/mobile.css" />
    <link rel="stylesheet" href="/css/dsresponsive.css" />
    <link rel="stylesheet" href="/css/trangchusv.css" />
   
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
    <script src="/js/validations.js"></script>
    <script src="/js/jsgvsv.js"></script>
    <script src="/js/jsthongbao.js"></script>
    <style>
        label.error {
            color: red;
            font-family: verdana, Helvetica;
        }

        body {
            font-family: Arial, Sans-serif;
        }

        .btn-success:hover {
            background: #6699FF;
            text-decoration: none;
        }

        /* footer {
            position: fixed;
            bottom: 0;
        } */

        a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
        }

        .logo {
            height: 130px;
            background-image: url(/images/aspace.jpg);
        }

        .w3-sidebar {
            height: 118%;
            width: 280px;
            background-color: #fff;
            position: fixed !important;
            z-index: 1;
            overflow: auto;
        }
    </style>
</head>
<header class="row logo">
    <div class="col-sm-4">
        <img src="/images/logo1.png" style="width: 47%; margin-left: 90px; margin-top: 15px;">

    </div>
    <div class="col-sm-8 shopping-mall">
        <h2 style="margin-top: 48px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif; color: #fff;">
            CỔNG THÔNG TIN ĐIỆN TỬ TRƯỜNG KỸ THUẬT <a style="color: #D90000; font-size: 29px;">@</a>SPACE</h2>
    </div>
</header>

<body>
    <!-- Navbar (sit on top) -->
    <div class="w3-top">
        <div class="w3-bar w3-white w3-card" id="myNavbar">
            <span style="font-size: 17px; font-weight: bold;" class="plus-index">{{$title}}</span>

            <!-- navbar pc -->
            <div class="w3-right w3-hide-small" style="float: right;">
                <a style="float: right;" class="w3-bar-item w3-button" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"><i class="glyphicon glyphicon-log-in"></i> Đăng xuất</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
            <div class="andi">
                <a href="#about" class="w3-bar-item w3-button">Trang chủ</a>
                <a href="#team" class="w3-bar-item w3-button"><i class="fa fa-user"></i> Giới thiệu</a>
                <a href="#work" class="w3-bar-item w3-button"><i class="fa fa-th"></i> Tin tức</a>
                <a href="#pricing" class="w3-bar-item w3-button"><i class="fa fa-usd"></i> Liên hệ</a>
                <a href="#contact" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i> Đăng nhập</a>
            </div>
            <!-- navbar pc -->

            <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
                <i class="fa fa-bars" style="margin-right: 14px; font-size: 23px;"></i>
            </a>
        </div>
    </div>
    <!-- Sidebar on small screens when clicking the menu icon -->
    <nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none; top: 0;" id="mySidebar">
        <!-- <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16" style="margin-left: 140px;">
            ×</a> -->
        <a><img src="/images/logo1.png" class="logotruong" style="width: 100%; height: 140px; background-color: #fff; margin-top: 0;margin-left: 0px;padding: 7px;margin-bottom: 15px;"></a>
        <a href="{{route('qlsv_sinhvien.index')}}" onclick="w3_close()" class="w3-bar-item w3-button">Quản lý sinh viên</a>
        <a href="{{route('qlsv_giangvien.index')}}" onclick="w3_close()" class="w3-bar-item w3-button">Quản lý giảng viên</a>
        <a href="{{route('qlsv_quantri.index')}}" onclick="w3_close()" class="w3-bar-item w3-button">Quản lý người dùng quản trị</a>
        <a href="{{route('qlsvlophoc.index')}}" onclick="w3_close()" class="w3-bar-item w3-button">Quản lý lớp học</a>
        <a href="{{route('qlsv_thoikhoabieu.index')}}" onclick="w3_close()" class="w3-bar-item w3-button">Quản lý thời khoá biểu</a>
        <a href="/worktask/mon/1" onclick="w3_close()" class="w3-bar-item w3-button">Quản lý worktask</a>
        <a href="{{route('qlsv_tudanhgia.index')}}" onclick="w3_close()" class="w3-bar-item w3-button">Quản lý tự đánh giá</a>
        <a href="{{route('qlsv_khoahoc.index')}}" onclick="w3_close()" class="w3-bar-item w3-button">Quản lý khoá học</a>
        <a href="{{route('qlsv_monhoc.index')}}" onclick="w3_close()" class="w3-bar-item w3-button">Quản lý môn học</a>
        <a href="{{route('qlsv_phonghoc.index')}}" onclick="w3_close()" class="w3-bar-item w3-button">Quản lý phòng học</a>
        <a href="{{route('qlsv_kieuthi.index')}}" onclick="w3_close()" class="w3-bar-item w3-button">Quản lý kiểu thi</a>
        <a href="{{route('quan_tri.index')}}" onclick="w3_close()" class="w3-bar-item w3-button">Quản lý thông báo</a>


        <!-- <div class="dropdown">
            <a class="w3-bar-item w3-button" data-toggle="dropdown">Quản trị hệ thống<span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li class="active" href="#"><a>Text</a></li>
                <li class="active" href="#"><a>Text</a></li>
                <li class="active" href="#"><a>Text</a></li>
            </ul>
        </div> -->
        <a class="w3-bar-item w3-button" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

    </nav>

    <!--  content  -->
    <main style="padding-top: 0px; margin-top: 70px;">
        @yield('content')
    </main>
    <!-- end content -->



    <script>
        // Toggle between showing and hiding the sidebar when clicking the menu icon
        var mySidebar = document.getElementById("mySidebar");

        function w3_open() {
            if (mySidebar.style.display === 'block') {
                mySidebar.style.display = 'none';
            } else {
                mySidebar.style.display = 'block';
            }
        }

        // Close the sidebar with the close button
        function w3_close() {
            mySidebar.style.display = "none";
        }
    </script>


</body>
<!-- footer -->
<footer class="footer-distributed">
    <div class="form-group row">
        <div class="col-xs-7">
            <p><span style="color: #fff; font-size: 14px;">Liên kết :</span></p>
            <a style=" color: #fff; font-size: 14px;" href="http://ispacedanang.edu.vn/">ispacedanang.edu.vn</a>
            <a style=" color: #fff; font-size: 14px;" href="https://aspace.edu.vn/">aspace.edu.vn</a>
        </div>
        <div class="col-xs-5">
            <p style="color: #fff; font-size: 14px;">Liên hệ :</p><a style="font-size: 14px;">0774 955 635</a>
        </div>
    </div>
</footer>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</html>