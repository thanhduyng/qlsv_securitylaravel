@extends('layouts.trangchu')

@section('content')
<div style="text-align:right;padding: 4px;">
    <a class="btn btn-primary btn-sm" style="margin-right: 15px; margin-top: 5px;" href="<?= route("qlsv_tudanhgia.index") ?>">
        <i class="glyphicon glyphicon-list-alt"></i></a>
</div>
<body>
    <div class="container-fluid py-5">
        <div class="row" style="padding: 20px;">
            <form id="jsvalidations" method="post" action="{{route('qlsv_tudanhgia.update')}}">
                @csrf
                <div class="form-group row">
                    <div>
                        <input type="hidden" name="id" value="{{$qlsv_tudanhgia->id}}">
                    </div>
                    <div class="col-sm-6">
                        <label>Tên Môn học:</label>
                        <select name="id_monhoc" class="form-control">
                            @foreach($qlsv_monhoc as $key => $value)
                            <option value="{{$key}}" {{($key == $qlsv_tudanhgia->id_monhoc) ? 'selected' : ""}}>
                                {{$value}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="">Tiêu đề:</label>
                        <input id="tieude" type="text" class="form-control" value="{{$qlsv_tudanhgia->tieude}}" name="tieude" placeholder="nhập tên Tiêu đề" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="">Câu hỏi:</label>
                        <input id="cauhoi" type="text" class="form-control" name="cauhoi" value="{{$qlsv_tudanhgia->cauhoi}}" placeholder="nhập tên Câu hỏi" />
                    </div>
                    <div class="col-sm-6">
                        <label>Thứ tự: </label></br>
                        <input type="text" class="form-control" name="thutu" value="{{$qlsv_tudanhgia->thutu}}" placeholder="nhập tên Thứ tự" />
                    </div>
                </div>
                <button type="submit" class="btn btn-primary px-4 float-right"><i class="glyphicon glyphicon-floppy-disk"></i> Lưu</button>
            </form>
        </div>
    </div>
    @endsection