@extends('layouts.trangchu')

@section('content')
<main>
    <div class="row">
        <div class="col-xs-4" style="margin-top: 40px;">
            <a href="{{ route('quan_tri.viewdiemthi') }}">
                <img src="/images/diemthi.png" style="width: 90%; margin-top: 5px; margin-bottom: -62px; margin-left: 10px;">
            </a>
            <label style="margin-top: 55px; margin-left: 36px;">Điểm Thi</label>
        </div>
        <div class="col-xs-4" style="margin-top: 40px;">
            <a href="{{ route('quan_tri.viewdanhgia') }}">
                <img src="/images/tudanhgia.png" style="width: 75%; margin-left: 15px;">
            </a>
            <label style="margin-top: 55px; margin-left: 30px;">Đánh Giá</label>
        </div>
        <div class="col-xs-4" style="margin-top: 40px;">
            <a href="{{route("quan_tri.index")}}">
                <img src="/images/worktask.png" style="width: 75%; margin-left: 10px;">
            </a>
            <label style="margin-top: 55px; margin-left: 18px;">Work Task</label>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4" style="margin-top: 20px;">
            <a href="{{ route('quan_tri.chonlophoc') }}">
                <img src="/images/lophoc.png" style="width: 70%; margin-top: 16px; margin-left: 20px;">
            </a>
            <label style="margin-top: 55px; margin-left: 30px;">Lớp Học</label>
        </div>
        <div class="col-xs-4" style="margin-top: 20px;">
            <img src="/images/xinnghi.png" style="width: 75%; margin-left: 15px;">
            <label style="margin-top: 55px; margin-left: 10px;">Xin Nghỉ Phép</label>
        </div>
        <div class="col-xs-4" style="margin-top: 20px;">
            <a href="{{route("quan_tri.index")}}">
                <img src="/images/thongbao.png" style="width: 75%; margin-left: 10px">
            </a>
            <label style="margin-top: 55px; margin-left: 18px;">Thông báo</label>
        </div>
    </div>

    <div class="row">
        <!-- <div class="col-xs-4" style="margin-top: 20px;">
            <a href="{{ route('quan_tri.chonlophoc') }}">
                <img src="/images/khoahoc.png" style="width: 75%; margin-top: 10px; margin-left: 20px;">
            </a>
            <label style="margin-top: 55px; margin-left: 30px;">Khoá Học</label>
        </div> -->
        <!-- <div class="col-xs-4" style="margin-top: 20px;">
            <img src="/images/lichhoc.png" style="width: 75%; margin-left: 15px; margin-top: 10px;">
            <label style="margin-top: 55px; margin-left: 22px;">Điểm danh</label>
        </div> -->
        <!-- <div class="col-xs-4" style="margin-top: 20px;">
            <a href="{{route("quan_tri.index")}}">
                <img src="/images/monhoc.png" style="width: 75%; margin-left: 10px; margin-top: 10px;">
            </a>
            <label style="margin-top: 55px; margin-left: 24px;">Môn Học</label>
        </div> -->
    </div>
</main>
@endsection