@extends('layouts.layout')

@section('content')

<head>
    <style>
        .row {
            margin-left: -34px;
            margin-top: 5px;
        }

        @media (max-width: 880px) {
            .cauhoi {
                float: none !important;
                ;
            }
        }
    </style>
</head>
<div class="container-fluid py-5">
    <div class="row" style="padding: 20px;">
        <form id="jsvalidations" method="post" action="{{ route('sinh_vien.storedanhgia') }}">
            @csrf
            <div class="form-group row">
                <label style="margin-left: 40px; font-size: 15px;" class="col-sm-2 col-xs-2">Lớp:</label>
                <div class="col-sm-10" style="width: 75%; float: left; margin-left: -15px;font-size: 15px; font-weight: bold;">
                    <p>{{$qlsv_lophoc->tenlophoc}}
                        <input type="hidden" name="id_lophoc" value="{{$qlsv_lophoc->id}}">
                    </p>
                </div>
            </div>
            <div>
                <input type="hidden" name="id_sinhvien" value="{{$qlsv_sinhvien->id}}">
            </div>
            <div class="form-group row">
                <div class="col-sm-7 col-xs-12">
                    @if($qlsv_tudanhgiasinhvienlophocs->count())
                    @foreach($qlsv_tudanhgiasinhvienlophocs as $i =>$values )
                    <ul>
                        <input type="hidden" name="id_tudanhgia[]" value="{{$values->id_tdg}}">
                        <h4 style="font-size: 18px;font-weight: bold; display: block;">{{$values->tieude}}</h4>
                        <a style="color: gray; float: left; margin-top: -2px; font-weight: bold;">{{$i+1}}.</a>
                        <li class="cauhoi" style="list-style: none; float: left; margin-left: 6px; font-style: italic;">{{$values->cauhoi}}.</li>
                        <li style="list-style: none; margin-top: 8px; margin-left: 14px;">
                            <textarea rows="4" type="text" value="" class="form-control" id="cautraloi[]" name="cautraloi[]" placeholder="nhập câu trả lời"></textarea><br>
                        </li>
                    </ul>
                    @endforeach
                    @endif
                </div>
            </div>
            <button style="margin-left: 35px;margin-top: -60px;" type="submit" class="btn btn-primary px-4 float-right">
            <i class="glyphicon glyphicon-send"></i> Gửi</button>
        </form>
    </div>
</div>
@endsection