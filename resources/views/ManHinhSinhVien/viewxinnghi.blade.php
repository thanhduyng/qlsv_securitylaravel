@extends('layouts.layout')

@section('content')
<div style="text-align:right;padding: 4px;">
    <a style="margin-right: 15px; margin-top: 5px;" class="btn btn-primary btn-sm" href="<?= route("sinh_vien.chonlop") ?>">
        <i class="glyphicon glyphicon-list-alt"></i></a>
</div>

<body>
    <div class="container-fuild py-5" style="margin-top: 0px; margin-bottom: 1px;">
        <div class="row" style="padding: 20px;">
            <div class="col-md-10 mx-auto">
                <form id="jsvalidations" method="post" action="{{ route('sinh_vien.storexinnghi') }}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-xs-2" style="font-size: 15px;">Lớp:</label>
                        <div class="col-sm-10" style="width: 75%; float: left; margin-left: -15px; font-size: 15px; font-weight: bold;">
                            <p>{{$qlsv_lophoc->tenlophoc}}
                                <input type="hidden" name="id_lophoc" value="{{$qlsv_lophoc->id}}">
                            </p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10" style="width: 75%; float: left; margin-left: -15px;">
                            <input type="hidden" name="id_sinhvien" value="{{$qlsv_sinhvien->id}}">
                            </p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label>Ngày </label></br>
                            <select name="ngayhoc" class="form-control">
                                @foreach($thoiKhoaBieu as $nd => $value)
                                <option value="{{$nd}}" {{$nd==$id_thoikhoabieu? 'selected' : ''}}>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-12">
                            <label>Nội dung </label></br>
                            <textarea rows="4" class="form-control" name="noidung" placeholder="nhập nội dung"></textarea>
                        </div>
                        <div class="col-sm-12">
                            <label>Lý do </label></br>
                            <textarea rows="2" class="form-control" name="lydo" placeholder="nhập lý do"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary px-4 float-right">
                        <i class="glyphicon glyphicon-send"></i> Gửi</button>
                </form>
            </div>
        </div>
    </div>
    @endsection