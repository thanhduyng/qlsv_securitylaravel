@extends('layouts.trangchu')

@section('content')

<div style="text-align:right;padding-top: 7px; padding-bottom: 5px;">
    <a class="btn btn-primary btn-sm" href="#" onclick="$('#searcharea').toggle();return false;">
        <i class="glyphicon glyphicon-search"></i></a>
    <a class="btn btn-success btn-sm" href="<?= route("qlsvlophoc.create") ?>">
        <i class="glyphicon glyphicon-plus"></i></a>
</div>
<div id="searcharea" style="display:none; margin-top: 15px;">
    <form action="<?= route("qlsvlophoc.index") ?>" method="get">
        <div class="form-group row">
            <div class="col-sm-12 col-xs-7" style="margin-left: 30px;">
                <input style="width: 220px; margin-left: -2px; margin-top: -1px;" id="" class="form-control" type="text" value="{{$search}}" name="search" placeholder="nhập tên lớp">
            </div>
            <div class="col-sm-4 col-xs-3">
                <button style="margin-left: 14px;" type="submit" class="btn btn-primary btn-sm">Tìm kiếm</button>
            </div>
        </div>
    </form>
</div>
<form method=get action="<?= route("qlsvlophoc.index") ?>">
    <table>
        <thead class="andi">
            <tr>
                <th>STT</th>
                <th class="width">Nội dung</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @if($lopHoc->count())
            @foreach($lopHoc as $i =>$cl )
            <tr>
                 <td>
                    <a class="btn btn-default btn-circle">{{$i+1}}</a>
                </td>
                <td>
                    <i style="margin-left: 15px;">Lớp: {{$cl->tenlophoc}}</i><br>
                    <!-- <i>Khoá: <?php echo \App\qlsv_khoahoc::find($cl->id_khoahoc)->tenkhoahoc ?></i><br> -->
                    <i style="margin-left: 15px;">GV: <?php echo \App\qlsv_giangvien::find($cl->id_giangvien)->hovaten ?></i><br>
                    <i style="margin-left: 15px;">Tổng SV: {{$cl->soluongsv}}</i><br>
                    <i style="margin-left: 15px;">Môn: <?php echo \App\qlsv_monhoc::find($cl->id_monhoc)->tenmonhoc ?></i><br>
                    <!-- <a style="margin-left: 15px;" href="/" type="submit" class="btn-sm btn-success px-4 float-right">
                        <i class="glyphicon glyphicon-user"></i> sinh viên</a> -->      
                    <i><a class="btn btn-success px-4 float-right" href="{{route('qlsv_thoikhoabieu.thoikhoabieu',$cl->id)}}">Thời Khoá Biểu</a></i>

                </td>
                <td style="padding-left:0;line-height: 33px;">
                    <a class="btn-default btn-xs" href="{{route('qlsvlophoc.create')}}?id={{$cl->id}}">
                        <i class="glyphicon glyphicon-pencil"></i></a>
                    <a class="btn-default btn-xs" href="delete/{{$cl->id}}">
                        <i class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    <div class="text-center">
        {{ $lopHoc->appends(['sort' => 'id'])->links() }}
    </div>
</form>
@endsection