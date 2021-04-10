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
    <script src="/js/jstudanhgia.js"></script>
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

        .logo {
            height: 130px;
            background-image: url(/images/aspace.jpg);
        }

        a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
        }

        .glyphicon-log-out:before {
            content: "\e163";
            size: 110px;
            font-size: 22px;
        }

        @media only screen and (max-width: 760px),
        (min-device-width: 768px) and (max-device-width: 1024px) {
            .glyphicon {
                margin-top: 4px;
            }
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
                <i style="margin-right: 14px; font-size: 0px;"></i>
            </a>
            <a style="margin-right: -50px;font-size: 17px; font-weight: bold;margin-top: -7px;" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">{{ __('') }}<i class="glyphicon glyphicon-log-out"></i></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>


    <!-- Sidebar on small screens when clicking the menu icon -->


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