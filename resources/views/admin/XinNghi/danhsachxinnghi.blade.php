@extends('layouts.trangchu')

@section('content')

<head>
    <style>
        @media (max-width: 880px) {
            .width {
                width: 100%;
            }
        }
    </style>
</head>
<form method=get action="<?= route("qlsv_xinnghi.index") ?>">
    <table>
        <thead class="andi">
            <tr>
                <th>Ngày nghỉ</th>
                <th>Tên sinh viên</th>
                <th class="width">Nội dung</th>
                <th class="width">Lý do</th>

            </tr>
        </thead>
        <tbody>

            @foreach($xinNghi as $i =>$cl )
            <tr>
                <td class="width">
                    <i style="margin-left: 25px;">{{$cl->ngaynghi}}</i><br>
                </td>
                <td class="width">
                    <i style="margin-left: 25px;">{{$cl->id_sinhvien}}</i><br>
                </td>
                <td class="width">
                    <i style="margin-left: 25px;">{{$cl->noidung}}</i><br>
                </td>
                <td class="width">
                    <i style="margin-left: 25px;">{{$cl->lydo}}</i><br>
                </td>

            </tr>
            @endforeach

        </tbody>
    </table>

</form>
@endsection