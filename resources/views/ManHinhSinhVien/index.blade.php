@extends('layouts.layout')

@section('content')
<main style="margin-left: 0px;">
    <div class="row">
        <div class="col-xs-4" style="margin-top: 40px;">
            <a href="{{ route('sinh_vien.trangchu') }}">
                <img src="/images/lophoc.png" style="width: 70%; margin-top: 16px; margin-left: 20px;">
            </a>
            <label style="margin-top: 55px; margin-left: 30px;">Lớp Học</label>
        </div>
        <div class="col-xs-4" style="margin-top: 40px;">
            <img src="/images/lichhoc.png" style="width: 75%; margin-left: 15px;">
            <label style="margin-top: 55px; margin-left: 30px;">Lịch học</label>
        </div>
        <div class="col-xs-4" style="margin-top: 40px;">
            <a href="/sinh_vien/chonlop">
                <img src="/images/xinnghi.png" style="width: 75%; margin-left: 10px;">
            </a>
            <label style="margin-top: 55px; margin-left: 5px;">Xin nghỉ phép</label>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4" style="margin-top: 20px;">
            <a href="{{route("sinh_vien.trangthongbao")}}">
                <img src="/images/thongbao.png" style="width: 75%; margin-left: 20px; float: left;">
            </a>
            <label style="margin-top: 55px; margin-left: 26px;">Thông báo</label>
        </div>
    </div>
</main>
@endsection