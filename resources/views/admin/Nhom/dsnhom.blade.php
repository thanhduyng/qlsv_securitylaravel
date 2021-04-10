@extends('layouts.trangchu')

@section('content')
<div style="text-align:right;padding-top: 7px; padding-bottom: 5px;">
  
    <a class="btn btn-success btn-sm" href="<?= route("qlsv_nhom.create") ?>">
        <i class="glyphicon glyphicon-plus"></i></a>
</div>
<form method=get action="<?= route("qlsv_nhom.index") ?>">
    <table>
        <thead class="andi">
            <tr>
                <th>STT</th>
                <th width=100%>Nội dung</th>
                <th>Nhóm</th>
            </tr>
        </thead>
        <tbody>
            @if($nhom->count())
            @foreach($nhom as $i =>$cl )
            <tr>
                <td>
                    <a class="btn btn-default btn-circle">{{$i+1}}</a>
                </td>
                <td width=100%>
                    <i style="margin-left: 25px;">{{$cl->ma}}</i><br>
                    <i style="margin-left: 25px;">{{$cl->ten}}</i>
                    
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
    <div class="text-center">
        {{ $nhom->appends(['sort' => 'id'])->links() }}
    </div>
</form>
@endsection