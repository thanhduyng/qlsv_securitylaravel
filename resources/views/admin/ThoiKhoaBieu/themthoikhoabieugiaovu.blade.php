@extends('layouts.trangchu')

@section('content')
<head>
    <style>
        #test {
            height: 510px;
            overflow-x: auto;
        }

        @media (max-width: 880px) {
            #lnpdt {
                width: 100px;
            }
        }
    </style>
</head>
<div style="text-align:right;padding: 4px;">
    <a style="margin-right: 15px; margin-top: 5px;" class="btn btn-primary btn-sm" href="<?= route("qlsv_thoikhoabieu.index") ?>">
        <i class="glyphicon glyphicon-list-alt"></i></a>
</div>
<div class="container-fluid py-5" style="margin-bottom: 10px;">
    <div class="row" style=" padding: 17px; margin-top: 8px;">
        <form method="post" action="{{route('qlsv_thoikhoabieu.storegiaovu')}}">
            @csrf
            <div class="form-group row">
                <div class="col-sm-12 col-xs-12">
                    <label for="">Tên lớp học</label>
                    <select name="id_lophoc" class="form-control">
                        <option>-- Chọn --</option>
                        @foreach($lopHoc as $nd => $value)
                        <option value="{{$nd}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="test">
                <table>
                    <thead>
                        <th>Ngày học</th>
                        <th>Ca học</th>
                        <th>Địa điểm học</th>
                        <th width=100%>Lời nhắn PĐT</th>
                    </thead>
                    <tbody>
                        @for($i=1; $i<=10; $i++) <tr>

                            <td> <input type='date' id='hasta' class="form-control" name="ngayhoc[]" value=''></td>
                            <td>
                                <select style="width: 120px;" name="cahoc[]" class="form-control">
                                    <option value="0">-- Chọn --</option>
                                    <option value="1">Sáng</option>
                                    <option value="2">Chiều</option>
                                    <option value="3">Tối</option>
                                </select>
                            </td>
                            <td>
                                <select style="width: 120px;" name="diadiemhoc[]" class="form-control">
                                    <option value="0">-- Chọn --</option>
                                    <option value="1">Trường</option>
                                    <option value="2">Xưởng Ô tô</option>
                                    <option value="3">Khác</option>
                                </select>
                            </td>
                            <td>
                                <input id="lnpdt" type="text" class="form-control" rows="3" name="loinhanphongdaotao[]" placeholder="nhập lời nhắn">
                            </td>
                            </tr>
                            @endfor
                    </tbody>
                </table>
            </div>
    </div>
    <button style="margin-top: 9px;" type="submit" class="btn btn-success px-4 float-right"><i class="glyphicon glyphicon-plus"></i> Thêm mới</button>
    </form>
</div>
</div>
@endsection