@extends('ManHinhGiangVien.layout')

@section('content')
<form method=get action="">
    <table>
        <thead class="andi">
            <tr>
                <th>STT</th>
                <th width=100%>Nội dung</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lopHoc as $key=> $value)
            <tr>
                <td>
                    <a class="btn btn-default btn-circle">{{$key+1}}</a>
                </td>
                <td width=100%>
                    <p style="margin-left: 23px; margin-top: 5px;">Lớp: <?php echo \App\qlsv_lophoc::find($value->id_lophoc)->tenlophoc ?></p>
                    <ul style="list-style: none; margin-top: 16px; margin-left: -17px; ">
                    <li style="float: left; margin-right: 3px; "><a class="btn-sm btn-success" style="padding: 5px 50px;"
 href="/xinnghi/chonlop/viewxinnghi/?id_lophoc={{$value->id_lophoc}}&id_sinhvien={{$value->id_sinhvien}}">Xin nghỉ</a></li>
                    </ul>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-center">
    </div>
</form>
@endsection