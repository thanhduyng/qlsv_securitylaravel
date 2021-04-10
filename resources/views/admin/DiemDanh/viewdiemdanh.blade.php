@extends('layouts.trangchu')

@section('content')
<div style="text-align:right;background-color:#f3ecec;padding: 4px;">
    <a class="btn btn-primary btn-sm" href="#" onclick="$('#searcharea').toggle();return false;">
        <i class="glyphicon glyphicon-search"></i></a>
    <a class="btn btn-success btn-sm" href="<?= route("qlsv_diemdanh.create") ?>">
        <i class="glyphicon glyphicon-plus"></i></a>

</div>
<div id="searcharea" style="display:none">

</div>
<form method=get action="<?= route("qlsv_diemdanh.index") ?>">
    <table>
        <thead>
            <tr>
                <th>sTT</th>
                <th>Ngày điểm danh</th>
                <th>Tên lớp học</th>
                <th>Tên sinh viên</th>
                <th>Điểm danh</th>
                <th>Kiến thức</th>
                <th>Thực hành</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>

            @foreach($diemDanh as $i =>$cl )
            <tr>
                <td>{{$i+1}}</td>
                <td>{{$cl->ngaydiemdanh}}</td>
                <td>{{$cl->id_lophoc}}</td>
                <td>{{$cl->id_sinhvien}}</td>
                <td>
                    @if( $cl->denlop == 1)
                    có
                    @elseif($cl->denlop == 2)
                    không
                    @elseif($cl->denlop == 3)
                    vắng có phép
                    @endif
                </td>
                <td>
                    @if( $cl->kienthuc == 1)
                    có
                    @else($cl->kienthuc == 2)
                    không
                    @endif
                </td>
                <td>
                    @if( $cl->thuchanh == 1)
                    có
                    @else($cl->thuchanh == 2)
                    không
                    @endif
                </td>
                <td style="padding-left:0;line-height: 33px;">
                    <a class="btn-default btn-xs" href="edit/{{$cl->id}}">
                        <i class="glyphicon glyphicon-pencil"></i></a>
                    <a class="btn-default btn-xs" href="delete/{{$cl->id}}">
                        <i class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>

</form>
@endsection