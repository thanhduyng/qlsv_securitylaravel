@extends('layouts.trangchu')

@section('content')
<div class="row">
    <div class="col-xs-6" style="margin-top: 40px;">
        <a href="{{route('quan_tri.createDaoTaoGiangVien')}}">
            <img src="/images/giaovien.jpg" 
            style="width: 85%; margin-top: -4px; margin-bottom: -54px; margin-left: 17px;">
        </a>
        <label style="margin-top: 55px; margin-left: 35px;">Tạo thông báo GV</label>
    </div>
    <div class="col-xs-6" style="margin-top: 40px;">
        <a href="{{ route('quan_tri.createDaoTaoKhoa') }}">
            <img src="/images/khoahoc.png" style="width: 76%; margin-left: 20px;">
        </a>
        <label style="margin-top: 55px; margin-left: 22px;">Tạo thông báo Khoá</label>
    </div>
</div>

<div class="row">
    <div class="col-xs-6" style="margin-top: 20px;">
        <a href="{{route('quan_tri.createDaoTaoLop')}}">
            <img src="/images/lophocs.png" style="width: 78%; margin-top: 12px; margin-bottom: -89px; margin-left: 23px;">
        </a>
        <label style="margin-top: 90px; margin-left: 33px;">Tạo thông báo Lớp</label>
    </div>
    <div class="col-xs-6" style="margin-top: 20px;">
        <a href="{{ route('quan_tri.createDaoTaoSinhVien') }}">
            <img src="/images/students.png" style="width: 85%; margin-left: 15px;">
        </a>
        <label style="margin-top: 40px; margin-left: 36px;">Tạo thông báo SV</label>
    </div>
</div>

@endsection