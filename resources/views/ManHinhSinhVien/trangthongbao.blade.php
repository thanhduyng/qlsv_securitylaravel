@extends('layouts.layout')

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
            @foreach($thongBao as $key=> $value)
            <tr>
                <td>
                    <a class="btn btn-default btn-circle">{{$key+1}}</a>
                </td>
                <td width=100%>
                    <p style="margin-left: 23px; font-size: 18px; font-weight: bold;">
                    {{$value->nguoitao}}<a style="color: black; margin-left: 27px;">{{ date('d-m-Y', strtotime($value->created_at))}}</a></p>
                    <p style="margin-left: 23px; font-weight: bold;">{{$value->tieude}}</p>
                    <p style="margin-left: 23px; font-style: italic;">{{$value->noidung}}</p>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-center">
    </div>
</form>
@endsection