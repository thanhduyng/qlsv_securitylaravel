@extends('layouts.trangchu')

@section('content')

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
</head>
<div style="text-align:right;padding: 4px;">
    <a style="margin-right: 15px; margin-top: 5px;" class="btn btn-primary btn-sm" href="<?= route("qlsv_thoikhoabieu.index") ?>">
        <i class="glyphicon glyphicon-list-alt"></i></a>
</div>
<div class="container-fluid py-5" style="margin-bottom: 10px;">
    <form id="jsvalidations" method="post" action="{{ route('qlsv_thoikhoabieu.update',[$thoiKhoaBieu->id])}} ">
        @csrf
        <input class="form-control" type="hidden" name="id" value="{{$thoiKhoaBieu->id}}" /><br>
        <div style="border: 2px solid #CCCCCC; border-radius: 7px; padding: 10px;">
            <div class="form-group row">
                <div class="col-sm-6 col-xs-12">
                    <label for="">Tên lớp học</label>
                    <select class="form-control" name="id_lophoc">
                        @foreach($lopHoc as $key=>$ph)
                        <option value={{$key}} {{$key==$thoiKhoaBieu->id_lophoc?"selected":""}}> {{$ph}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <label for="">Ngày học</label>
                    <input type="date" class="form-control" id="" name="ngayhoc" value="{{$thoiKhoaBieu->ngayhoc}}" />
                </div>
                <div class="col-sm-6 col-xs-12">
                    <label for="">Lời nhắn P.Đào tạo</label>
                    <textarea type="text" class="form-control" id="" rows="3" name="loinhanphongdaotao" value="{{$thoiKhoaBieu->loinhanphongdaotao}}"></textarea>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <label for="">Buổi thứ</label>
                    <input type="number" class="form-control" id="" name="buoithu" value="{{$thoiKhoaBieu->buoithu}}" />
                </div>
                <div class="col-sm-6 col-xs-12">
                    <label for="">Số worktask</label></label>
                    <select class="form-control" name="id_worktask">
                        @foreach($workTask as $key=>$tkb)
                        <option value={{$key}} {{$key==$thoiKhoaBieu->id_worktask?"selected":""}}> {{$tkb}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <br>

        <div style="border: 2px solid #CCCCCC; border-radius: 7px; padding: 10px;">
            <div class="form-group row">
                <div class="col-sm-6 col-xs-12">
                    <label for="">Tên phòng học</label>
                    <select class="form-control" name="id_phonghoc">
                        @foreach($phongHoc as $key=>$ph)
                        <option value={{$key}} {{$key==$thoiKhoaBieu->id_phonghoc?"selected":""}}> {{$ph}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6 col-xs-6">
                    <label for="">Ca học</label>
                    <select name="cahoc" class="form-control">
                        <option value="1" {{$thoiKhoaBieu->cahoc == 1 ? 'selected' : ''}} name="cahoc">Sáng</option>
                        <option value="2" {{$thoiKhoaBieu->cahoc == 2 ? 'selected' : ''}} name="cahoc">Chiều</option>
                        <option value="3" {{$thoiKhoaBieu->cahoc == 3 ? 'selected' : ''}} name="cahoc">Tối</option>
                    </select>
                </div>
                <div class="col-sm-6 col-xs-6">
                    <label for="">Địa điểm học</label>
                    <select name="diadiemhoc" class="form-control">
                        <option value="1" {{$thoiKhoaBieu->diadiemhoc == 1 ? 'selected' : ''}} name="diadiemhoc">Trường</option>
                        <option value="2" {{$thoiKhoaBieu->diadiemhoc == 2 ? 'selected' : ''}} name="diadiemhoc">Xưởng ô tô</option>
                        <option value="3" {{$thoiKhoaBieu->diadiemhoc == 3 ? 'selected' : ''}} name="diadiemhoc">Khác</option>
                    </select>
                </div>
            </div>
        </div>
        <br>
        <div style="border: 2px solid #CCCCCC; border-radius: 7px; padding: 10px;">
            <div class="form-group row">
                <div class="col-sm-6 col-xs-6">
                    <label>Giờ vào:</label>
                    <input class="form-control" type="time" id="appt" name="giovao" value="{{$thoiKhoaBieu->giovao}}">
                </div>
                <div class="col-sm-6 col-xs-6">
                    <label>Giờ bắt đầu:</label>
                    <input class="form-control" type="time" id="appt" name="giobatdau" value="{{$thoiKhoaBieu->giobatdau}}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 col-xs-6">
                    <label>Đánh giá:</label>
                    <select name="danhgiagiovao" class="form-control">
                        <option value="0">--Chọn--</option>
                        <option value="1" {{$thoiKhoaBieu->danhgiagiovao == 1 ? 'selected' : ''}} name="danhgiagiovao">Đúng</option>
                        <option value="2" {{$thoiKhoaBieu->danhgiagiovao == 2 ? 'selected' : ''}} name="danhgiagiovao">Trế</option>
                    </select>
                </div>

                <div class="col-sm-6 col-xs-6">
                    <label for="">Lý do</label>
                    <select name="lydogiovao" class="form-control">
                        <option value="0">--Chọn--</option>
                        <option value="1" {{$thoiKhoaBieu->lydogiovao == 1 ? 'selected' : ''}} name="lydogiovao">SV đến lớp trễ</option>
                        <option value="2" {{$thoiKhoaBieu->lydogiovao == 2 ? 'selected' : ''}} name="lydogiovao">GV đến lớp trễ</option>
                        <option value="3" {{$thoiKhoaBieu->lydogiovao == 3 ? 'selected' : ''}} name="lydogiovao">Chuẩn bị trễ</option>
                    </select>
                </div>
            </div>
        </div>
        <br>

        <div style="border: 2px solid #CCCCCC; border-radius: 7px; padding: 10px;">
            <div class="form-group row">
                <div class="col-sm-6 col-xs-6">
                    <label>Giờ ra:</label>
                    <input class="form-control" type="time" id="appt" name="giora" value="{{$thoiKhoaBieu->giora}}">
                </div>

                <div class="col-sm-6 col-xs-6">
                    <label for="">Đánh giá</label>
                    <select name="danhgiagiora" class="form-control">
                        <option value="0">--Chọn--</option>
                        <option value="1" {{$thoiKhoaBieu->danhgiagiora == 1 ? 'selected' : ''}} name="danhgiagiora">Sớm</option>
                        <option value="2" {{$thoiKhoaBieu->danhgiagiora == 2 ? 'selected' : ''}} name="danhgiagiora">Đúng</option>
                        <option value="3" {{$thoiKhoaBieu->danhgiagiora == 3 ? 'selected' : ''}} name="danhgiagiora">Trễ</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 col-xs-6">
                    <label for="">Lý do</label>
                    <select name="lydogiora" class="form-control">
                        <option value="0">--Chọn--</option>
                        <option value="1" {{$thoiKhoaBieu->lydogiora == 1 ? 'selected' : ''}} name="lydogiora">Xong bài</option>
                        <option value="2" {{$thoiKhoaBieu->lydogiora == 2 ? 'selected' : ''}} name="lydogiora">Lớp đề nghị</option>
                        <option value="3" {{$thoiKhoaBieu->lydogiora == 3 ? 'selected' : ''}} name="lydogiora">Khác</option>
                    </select>
                </div>
            </div>
        </div>
        <br>
        <div style="border: 2px solid #CCCCCC; border-radius: 7px; padding: 10px;">
            <div class="form-group row">
                <div class="col-sm-6 col-xs-12">
                    <label for="">Sĩ số</label>
                    <input type="number" class="form-control" id="" name="siso" value="{{$thoiKhoaBieu->siso}}" />
                </div>
                <div class="col-sm-6 col-xs-12">
                    <label>Thực hiện tốt hoặc hiểu bài</label>
                    <input type="number" class="form-control" name="thuchientot" value="{{$thoiKhoaBieu->thuchientot}}" />
                </div>
                <div class="col-sm-6 col-xs-12">
                    <label>Không làm được/không hiểu</label>
                    <input type="number" class="form-control" name="khonglamduoc" value="{{$thoiKhoaBieu->khonglamduoc}}" />
                </div>
            </div>
        </div><br>
        <div style="border: 2px solid #CCCCCC; border-radius: 7px; padding: 10px;">
            <div class="form-group row">
                <div class="col-sm-6 col-xs-12">
                    <label for="">Đánh giá của GV</label></label>
                    <textarea rows="3" type="text" class="form-control" id="" name="danhgiacuagiangvien" value="{{$thoiKhoaBieu->danhgiacuagiangvien}}"></textarea>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <label for="">Lời nhắn của GV</label></label>
                    <textarea rows="3" type="text" class="form-control" id="" name="loinhancuagiangvien" value="{{$thoiKhoaBieu->loinhancuagiangvien}}"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 col-xs-12">
                    <label for="">Ghi chú</label></label>
                    <textarea rows="3" type="text" class="form-control" id="" name="ghichu" value="{{$thoiKhoaBieu->ghichu}}"></textarea>
                </div>
            </div>
        </div>
        <button type="submit" style="margin-top: 8px;" class="btn btn-primary px-4 float-right"><i class="glyphicon glyphicon-floppy-disk"></i> Lưu</button>
    </form>
</div>
</body>
@endsection