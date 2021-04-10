@extends('layouts.trangchu')

@section('content')
<div >
    <i ><a style="margin: 15px;" class="btn btn-success px-4" href="{{route('quan_tri.index')}}">Thông báo nhận</a></i>
    <i ><a style="margin: 15px;" class="btn btn-success px-4" href="{{route('quan_tri.createDaoTao')}}">Thêm mới</a></i>
</div>
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
                    <p style="margin-left: 23px; font-size: 18px; font-weight: bold;">{{$value->nguoitao}}<a style="color: black; margin-left: 30px;">{{ date('d-m-Y', strtotime($value->created_at))}}</a></p>
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