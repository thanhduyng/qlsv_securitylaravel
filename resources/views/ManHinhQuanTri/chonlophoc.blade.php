@extends('layouts.trangchu')

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
                    <p style="margin-left: 23px; margin-top: 5px; font-size: 20px;">{{$value->tenlophoc}}</p>
                    <ul style="list-style: none; margin-top: 16px; margin-left: -17px; ">
                        <li style="float: left; margin-right: 3px;"><a class="btn-sm btn-success" style="padding: 8px 28px; font-size: 16px;" 
                        href="/quan_tri/viewsinhvienlophoc/?id_lophoc={{$value->id_lophoc}}&id_monhoc={{$value->id_monhoc}}"> Xem chi tiết</a></li>
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