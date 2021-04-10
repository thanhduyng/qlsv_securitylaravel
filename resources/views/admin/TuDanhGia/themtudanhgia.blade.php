@extends('layouts.trangchu')

@section('content')
<div style="text-align:right;padding: 4px;">
    <a class="btn btn-primary btn-sm" style="margin-right: 15px; margin-top: 5px;" href="<?= route("qlsv_tudanhgia.index") ?>">
        <i class="glyphicon glyphicon-list-alt"></i></a>
</div>

<body>
    <div class="container-fluid py-5">
        <div class="row" style="padding: 20px;">
            <form id="jsvalidations" method="post" action="{{route('qlsv_tudanhgia.store')}}">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label>Tên Môn học:</label>
                        <select name="id_monhoc" class="form-control">
                            @foreach($qlsv_monhoc as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label for="">Tiêu đề:</label>
                        <input id="tieude" type="text" class="form-control" name="tieude" placeholder="nhập tên tiêu đề" />
                    </div>
              
                    <div class="col-sm-3">
                        <label for="">Câu hỏi:</label>
                        <input id="cauhoi" type="text" class="form-control" name="cauhoi" placeholder="nhập tên câu hỏi" />
                    </div>
                    <div class="col-sm-3">
                        <label>Thứ tự: </label></br>
                        <input type="text" class="form-control" name="thutu" placeholder="nhập tên thứ tự" />
                    </div>
                </div>
                <button type="submit" class="btn btn-success px-4 float-right"><i class="glyphicon glyphicon-plus"></i> Thêm mới</button>

            </form>
        </div>
    </div>

    @endsection