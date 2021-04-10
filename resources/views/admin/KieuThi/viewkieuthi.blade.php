@extends('layouts.trangchu')

@section('content')
<div style="text-align:right;padding-top: 7px; padding-bottom: 5px;">
    <a class="btn btn-primary btn-sm" href="#" onclick="$('#searcharea').toggle();return false;">
        <i class="glyphicon glyphicon-search"></i></a>
    <a class="btn btn-success btn-sm" href="<?= route("qlsv_kieuthi.create") ?>">
        <i class="glyphicon glyphicon-plus"></i></a>
</div>
<div id="searcharea" style="display:none; margin-top: 15px;">
    <form action="<?= route("qlsv_kieuthi.index") ?>" method="get">
        <div class="form-group row">
            <div class="col-sm-4 col-xs-7" style="margin-left: 30px;">
                <input style="width: 220px; margin-left: -2px; margin-top: -1px;" id="" class="form-control" type="text" value="{{$search}}" name="search" placeholder="nhập tên kiểu thi">
            </div>
            <div class="col-sm-4 col-xs-3">
                <button style="margin-left: 14px;" type="submit" class="btn btn-primary btn-sm">Tìm kiếm</button>
            </div>
        </div>
    </form>
</div>

<form action="">
    <table>
        <thead class="andi">
            <tr>
                <th>STT</th>
                <th>HỌ VÀ TÊN</th>
                <th>Hành động</th>

            </tr>
            <?php $stt = 1 ?>
        </thead>
        <tbody>
            @foreach($qlsv_kieuthi as $value)
            <tr>
                <td>
                    <a class="btn btn-default btn-circle">{{$stt++}}</a>
                </td>
                <td class="width">
                <i style="margin-left: 25px;" >   {{$value->kieuthi}}</i><br>
                </td>
                <td style="padding-left:0;line-height: 33px; ">
                    <a class="btn-default btn-xs" href="edit/{{$value->id}}">
                        <i class="glyphicon glyphicon-pencil"></i></a>
                    <a class="btn-default btn-xs" href="delete/{{$value->id}}">
                        <i class="glyphicon glyphicon-trash"></i></a>
                </td>

            </tr>
            @endforeach
        </tbody>
        <div class="text-center">
            {{ $qlsv_kieuthi->appends(['sort' => 'id'])->links() }}
        </div>
    </table>

</form>




@endsection