@extends('layouts.layout')

@section('content')
<main>
    <div class="row">
        <div class="col-xs-4" style="margin-top: 40px;">
            <a href="{{ route('giang_vien.tranglophoc') }}">
                <img src="/images/lophoc.png" style="width: 70%; margin-top: 16px; margin-left: 20px;">
            </a>
            <label style="margin-top: 55px; margin-left: 30px;">Lớp Học</label>
        </div>
        <div class="col-xs-4" style="margin-top: 40px;">
            <a href="{{route("giang_vien.index")}}">
                <img src="/images/thongbao.png" style="width: 75%; margin-left: 15px;">
            </a>
            <label style="margin-top: 55px; margin-left: 23px;">Thông báo</label>
        </div>

        @foreach($lopHoc as $key=> $value)
        <div class="col-xs-4" style="margin-top: 40px;">
            <a href="/giang_vien/viewxinnghisv/?id_lophoc={{$value->id}}">
                <img src="/images/xinnghi.png" style="width: 75%; margin-left: 15px;">
            </a>
            <label style="margin-top: 55px; margin-left: 18px;">Phép của SV</label>
        </div>
        @endforeach
    </div>
</main>
@endsection