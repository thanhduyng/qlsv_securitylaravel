@extends('layouts.trangchu')

@section('content')
<div style="text-align:right;padding-top: 7px; padding-bottom: 5px;">
    <a class="btn btn-primary btn-sm" href="#" onclick="$('#searcharea').toggle();return false;">
        <i class="glyphicon glyphicon-search"></i></a>
    <a class="btn btn-success btn-sm" href="<?= route("qlsv_sinhvien.create") ?>">
        <i class="glyphicon glyphicon-plus"></i></a>
</div>
<div id="searcharea" class="collapse">
    <form action="{{route('qlsv_sinhvien.index')}}" method="get" class="row p-3">
        <div class="form-group row" style="margin: 25px;">
            <div class="col-sm-6 col-xs-6">
                <label>Khóa học</label>
                <select name="khoahoc" class="form-control">
                    <option value="">--Chọn khóa học--</option>
                    @foreach($khoaHoc as $i =>$cl )
                    <option value="{{$i}}">{{$cl}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-6 col-xs-6">
                <label>Sinh viên</label>
                <input class="form-control" id="" type="text" value="{{$search ?? '' }}" name="search" placeholder="Nhập Tên sinh viên">
            </div>

            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary btn-sm" style="float: right; margin-top: 10px;">Tìm kiếm</button>
            </div>
        </div>
    </form>
</div>
<form method=get action="{{route('qlsv_sinhvien.index')}}">
    <table>
        <thead class="andi">
            <tr>
                <th>STT</th>
                <th class="width">Nội dung</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @if($sinhVien->count())
            @foreach($sinhVien as $i =>$cl )
            <tr>
                <td>
                    <a class="btn btn-default btn-circle">{{$i+1}}</a>
                </td>
                <td class="width">
                   <i style="margin-left: 25px;">{{$cl->hovaten}}</i><br>
                    <i style="margin-left: 25px;">{{$cl->sodienthoaisinhvien}}</i><br>
                    <i style="margin-left: 25px;"><?php echo \App\qlsv_khoahoc::find($cl->id_khoahoc)->tenkhoahoc ?></i><br>
                </td>
                <td style="padding-left:0;line-height: 33px;">
                    <a class="btn-default btn-xs" href="edit/{{$cl->id}}">
                        <i class="glyphicon glyphicon-pencil"></i></a>
                    <a class="btn-default btn-xs" href="delete/{{$cl->id}}">
                        <i class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</form>


@endsection