@extends('layouts.trangchu')

@section('content')
<div style="margin-top: 100px;">
    <form action="<?= route("quan_tri.search") ?>" method="get">
        <div>
            <div class="form-group">
                <div class="col-xs-5" style="margin-bottom: 20px;">
                    <select name="searchkh" class="form-control">
                        <option value="">-- Khoá --</option>
                        @foreach($khoaHoc as $nd => $value)
                        <option value="{{$nd}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-5">
                    <input style="width: 190px; margin-left: -13px; margin-top: -1px;" id="" class="form-control" type="text" value="{{$search}}" name="search" placeholder="nhập tên sinh viên">
                </div>
                <div class="col-xs-2">
                    <button style="margin-left: 9px;" type="submit" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="container-fluid py-5">
    <div class="row" style="padding: 15px;margin-top: 40px;">
        <form id="jsthongbao" method="post" action="{{route('quan_tri.storeDaoTaoSinhVien')}}">
            @csrf
            <div class="form-group row">
                <div class="col-sm-12">
                    <label style="margin-left: -150px;">Tiêu đề</label>
                    <input type="text" class="form-control" id="" name="tieude" placeholder="nhập tiêu đề" />
                </div>
                <div class="col-sm-12">
                    <label>Nội dung</label>
                    <textarea type="text" class="form-control" rows="3" name="noidung" placeholder="nhập nội dung"></textarea>
                </div>
            </div>

            <div class="row" style="margin-top: 5px;">
                <div class="col-xs-12">
                    <a style="color: black; font-size: 20px;">Chọn sinh viên</a> <a class="btn-default btn-xs" href=""></a>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th style="height: 13px;">STT</th>
                        <th style="height: 13px; width: 25%;">Khoá học</th>
                        <th style="height: 13px; width: 50%;">Tên sinh viên</th>
                        <th style="height: 13px; width: 15%;">Chọn</th>
                    </tr>
                </thead>
                <tbody class="sinhvien_duocchon">
                    @php
                    $stt = 1;
                    @endphp
                    @foreach($sinhVien as $key=>$value)
                    <tr>
                        <td class=stt><span class=stt>{{$stt++}}</span></td>
                        <td><?php echo \App\qlsv_khoahoc::find($value->id_khoahoc)->tenkhoahoc ?></td>
                        <input type="hidden" class="id_sinhvien" value="{{$value->id}}">
                        <input type="hidden" class="tensinhvien" value="{{$value->hovaten}}">
                        <td>{{$value->hovaten}}</td>
                        <td><input type="checkbox" name="id_user[]" value="{{$value->id_user}}" /></td>
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