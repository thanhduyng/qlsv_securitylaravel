@extends('layouts.layout')

@section('content')
<div class="container-fluid py-5" >
    <div class="row" style="padding: 20px;margin-top: 15px;">
        <form id="jsvalidations" method="post" action="{{route('giang_vien.storeGiangVienLop')}}">
            @csrf
            <div class="form-group row">
                <div class="col-sm-12">
                    <label>Tiêu đề</label>
                    <input type="text" class="form-control" id="" name="tieude" placeholder="nhập tiêu đề" />
                </div>
                <div class="col-sm-12">
                    <label>Nội dung</label>
                    <textarea type="text" class="form-control" rows="3" name="noidung" placeholder="nhập nội dung"></textarea>
                </div>
            </div>

                <div class="row" style="margin-top: 5px;">
                    <div class="col-xs-12">
                        <a style="color: black; font-size: 20px;">Chọn lớp</a> <a class="btn-default btn-xs" href=""></a>
                    </div>
                </div>

            <table>
                <thead>
                    <tr>
                        <th style="height: 13px;">STT</th>
                        <th style="height: 13px; width: 65%;">Tên lớp</th>
                        <th style="height: 13px; width: 65%;">Chọn</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $stt = 1;
                    @endphp
                    @foreach($lopHoc as $key=>$value)
                    <tr>
                        <td class=stt><span class=stt>{{$stt++}}</span></td>
                        <td>{{$value->tenlophoc}}</td>
                        <td><input type="checkbox" name="id[]" value="{{$value->id}}"/></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" style="margin-top: 10px;" class="btn btn-primary px-4 float-right">
            <i class="glyphicon glyphicon-send"></i> Gửi</button>
        </form>
    </div>
</div>
@endsection