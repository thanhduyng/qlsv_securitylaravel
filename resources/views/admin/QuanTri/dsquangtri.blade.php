@extends('layouts.trangchu')

@section('content')
<div style="text-align:right;padding-top: 7px; padding-bottom: 5px;">
    <a class="btn btn-primary btn-sm" href="#" onclick="$('#searcharea').toggle();return false;">
        <i class="glyphicon glyphicon-search"></i></a>
    <a class="btn btn-success btn-sm" href="<?= route("qlsv_quantri.create") ?>">
        <i class="glyphicon glyphicon-plus"></i></a>
</div>

<div id="searcharea" style="display:none; margin-top: 15px;">
    <form action="<?= route("qlsv_quantri.index") ?>" method="get">
        <div class="form-group row">
            <div class="col-sm-4 col-xs-7" style="margin-left: 30px;">
                <input style="width: 220px; margin-left: -2px; margin-top: -1px;" id="" class="form-control" type="text" value="{{$search}}" name="search" placeholder="Tìm kiếm">
            </div>
            <div class="col-sm-4 col-xs-3">
                <button style="margin-left: 14px;" type="submit" class="btn btn-primary btn-sm">Tìm kiếm</button>
            </div>
        </div>
    </form>
</div>
<form method=get action="<?= route("qlsv_quantri.index") ?>">
    <table>
        <thead class="andi">
            <tr>
                <th>STT</th>
                <th class="width">Nội dung</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @if($quanTri->count())
            @foreach($quanTri as $i =>$cl )
            <tr>
                <input type="hidden" class="serdelete_val_id" value="{{$cl->id}}">
                <td>
                    <a class="btn btn-default btn-circle">{{$i+1}}</a>
                </td>
                <td>
                    <i style="margin-left: 25px;">{{$cl->ten}}</i><br>
                    <i style="margin-left: 25px;">{{$cl->sodienthoai}}</i><br>
                </td>
                <td style="padding-left:0;line-height: 33px;">
                    <a class="btn-default btn-xs" href="edit/{{$cl->id}}">
                        <i class="glyphicon glyphicon-pencil"></i></a>
                    <a class="btn-default btn-xs servicedeletebtn" href="delete/{{$cl->id}}">
                        <i class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    <div class="text-center">
        {{ $quanTri->appends(['sort' => 'id'])->links() }}
    </div>
</form>
@endsection