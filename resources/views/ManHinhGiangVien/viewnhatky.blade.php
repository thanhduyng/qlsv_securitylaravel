@extends('layouts.layout')

@section('content')
<!-- <head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
</head> -->
<div class="container-fluid py-5">
    <form id="jsvalidations" action="{{route('giang_vien.storenhatky')}}" method="post">
        @csrf
        <input class="form-control" type="hidden" name="id_thoikhoabieu[]" value="{{$thoiKhoaBieu->id}}" /><br>
        <div style="padding: 10px;">
            <div class="form-group row">
                <div class="col-sm-4 col-xs-12">
                    <label style="font-size: 15px;">Tên lớp học: </label>
                    <a style="font-size: 15px; font-weight: bold; color: black; margin-left: 4px;"> {{$qlsv_lophoc->tenlophoc}}
                        <input type="hidden" name="idlop" value="{{$qlsv_lophoc->id}}">
                    </a>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <label for="">Ngày học</label>
                    <select name="ngayhoc" class="form-control" onchange="document.location.href='{{route('giang_vien.viewnhatky')}}?id_lophoc={{$qlsv_lophoc->id}}&id_thoikhoabieu='+this.value;">
                        @foreach($thoiKhoaBieuall as $nd => $value)
                        <option value="{{$nd}}" {{$nd==$id_thoikhoabieu? 'selected' : ''}}>{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <label style="margin-top: 10px;">Lời nhắn P.Đào tạo</label>
                    <input type="hidden" class="form-control" name="loinhanphongdaotao" value="{{$thoiKhoaBieu->loinhanphongdaotao}}" />
                    <div style="color: red;font-weight: bold;">{{$thoiKhoaBieu->loinhanphongdaotao}}</div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4 col-xs-12">
                    <label>Buổi thứ</label>
                    <input type="number" class="form-control" id="" name="buoithu" value="{{$thoiKhoaBieu->buoithu}}" />
                </div>
                <div class="col-sm-4 col-xs-12">
                    <label style="margin-top: 10px;" for="">Số worktask</label></label>
                    <select class="form-control" name="id_worktask" required>
                        <option value="">-- Chọn --</option>
                        @foreach($workTask as $key=>$ph)
                        <option value={{$key}} {{$key==$thoiKhoaBieu->id_worktask?"selected":""}}> {{$ph}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <hr>
        <div style=" padding: 10px;">
            <div class="form-group row">
                <div class="col-sm-4 col-xs-12">
                    <label for="">Tên phòng học</label>
                    <select class="form-control" name="id_phonghoc" required>
                        <option value="">-- Chọn --</option>
                        @foreach($phongHoc as $key=>$ph)
                        <option value={{$key}} {{$key==$thoiKhoaBieu->id_phonghoc   ?"selected":"" }}> {{$ph}} </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-4 col-xs-6">
                    <label style="margin-top: 10px;" for="">Ca học</label>
                    <select disabled name="cahoc" class="form-control">
                        <option value="1" {{$thoiKhoaBieu->cahoc == 1 ? 'selected' : ''}} name="cahoc">Sáng</option>
                        <option value="2" {{$thoiKhoaBieu->cahoc == 2 ? 'selected' : ''}} name="cahoc">Chiều</option>
                        <option value="3" {{$thoiKhoaBieu->cahoc == 3 ? 'selected' : ''}} name="cahoc">Tối</option>
                    </select>
                </div>
                <div class="col-sm-4 col-xs-6">
                    <label style="margin-top: 10px;" for="">Địa điểm học</label>
                    <select disabled name="diadiemhoc" class="form-control">
                        <option value="1" {{$thoiKhoaBieu->diadiemhoc == 1 ? 'selected' : ''}} name="diadiemhoc">Trường</option>
                        <option value="2" {{$thoiKhoaBieu->diadiemhoc == 2 ? 'selected' : ''}} name="diadiemhoc">Xưởng ô tô</option>
                        <option value="3" {{$thoiKhoaBieu->diadiemhoc == 3 ? 'selected' : ''}} name="diadiemhoc">Khác</option>
                    </select>
                </div>
            </div>
        </div>
        <hr>
        <div style="padding: 10px;">
            <div class="form-group row">
                <div class="col-sm-3 col-xs-6">
                    <label>Giờ vào:</label>
                    <input class="form-control" type="time" id="giovao" name="giovao" value="{{$thoiKhoaBieu->giovao}}">
                </div>
                <div class="col-sm-3 col-xs-6">
                    <label>Giờ bắt đầu:</label>
                    <input class="form-control" type="time" id="appt" name="giobatdau" value="{{$thoiKhoaBieu->giobatdau}}">
                </div>

                <div class="col-sm-3 col-xs-6">
                    <label style="margin-top: 10px;">Đánh giá:</label>
                    <select name="danhgiagiovao" class="form-control" required>
                        <option value="">--Chọn--</option>
                        <option value="1" {{$thoiKhoaBieu->danhgiagiovao == 1 ? 'selected' : ''}} name="danhgiagiovao">Đúng</option>
                        <option value="2" {{$thoiKhoaBieu->danhgiagiovao == 2 ? 'selected' : ''}} name="danhgiagiovao">Trế</option>
                    </select>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <label style="margin-top: 10px;">Lý do</label>
                    <select name="lydogiovao" class="form-control" required>
                        <option value="">--Chọn--</option>
                        <option value="1" {{$thoiKhoaBieu->lydogiovao == 1 ? 'selected' : ''}} name="lydogiovao">SV đến lớp trễ</option>
                        <option value="2" {{$thoiKhoaBieu->lydogiovao == 2 ? 'selected' : ''}} name="lydogiovao">GV đến lớp trễ</option>
                        <option value="3" {{$thoiKhoaBieu->lydogiovao == 3 ? 'selected' : ''}} name="lydogiovao">Chuẩn bị trễ</option>
                    </select>
                </div>
            </div>
        </div>
        <hr>
        <div style=" padding: 10px; margin-top: 5px;">
            <div class="form-group row">
                <div class="col-sm-4 col-xs-6">
                    <label>Giờ ra:</label>
                    <input class="form-control" type="time" id="giora" name="giora" value="{{$thoiKhoaBieu->giora}}">
                </div>
                <div class="col-sm-4 col-xs-6">
                    <label for="">Đánh giá</label>
                    <select name="danhgiagiora" class="form-control" required>
                        <option value="">--Chọn--</option>
                        <option value="1" {{$thoiKhoaBieu->danhgiagiora == 1 ? 'selected' : ''}} name="danhgiagiora">Sớm</option>
                        <option value="2" {{$thoiKhoaBieu->danhgiagiora == 2 ? 'selected' : ''}} name="danhgiagiora">Đúng</option>
                        <option value="3" {{$thoiKhoaBieu->danhgiagiora == 3 ? 'selected' : ''}} name="danhgiagiora">Trễ</option>
                    </select>
                </div>

                <div class="col-sm-4 col-xs-6">
                    <label style="margin-top: 10px;">Lý do</label>
                    <select name="lydogiora" class="form-control" required>
                        <option value="">--Chọn--</option>
                        <option value="1" {{$thoiKhoaBieu->lydogiora == 1 ? 'selected' : ''}} name="lydogiora">Xong bài</option>
                        <option value="2" {{$thoiKhoaBieu->lydogiora == 2 ? 'selected' : ''}} name="lydogiora">Lớp đề nghị</option>
                        <option value="3" {{$thoiKhoaBieu->lydogiora == 3 ? 'selected' : ''}} name="lydogiora">Khác</option>
                    </select>
                </div>
            </div>
        </div>
        <hr>
        <div style=" padding: 10px;">
            <div class="form-group row">
                <div class="col-sm-4 col-xs-12">
                    <label for="">Sĩ số</label>
                    <input style="margin-bottom: 0;" type="number" class="form-control" id="" name="siso" value="{{$thoiKhoaBieu->siso}}" />
                </div>
                <div class="col-sm-4 col-xs-12">
                    <label style="margin-top: 10px;">Thực hiện tốt hoặc hiểu bài</label>
                    <input type="number" class="form-control" name="thuchientot" value="{{$thoiKhoaBieu->thuchientot}}" />
                </div>
                <div class="col-sm-4 col-xs-12">
                    <label style="margin-top: 10px;">Không làm được/không hiểu</label>
                    <input type="number" class="form-control" name="khonglamduoc" value="{{$thoiKhoaBieu->khonglamduoc}}" />
                </div>

            </div>
        </div>
        <hr>
        <div style=" padding: 10px;">
            <div class="form-group row">
                <div class="col-sm-4 col-xs-12">
                    <label for="">Đánh giá của GV</label></label>
                    <textarea rows="3" type="text" class="form-control" id="" name="danhgiacuagiangvien">{{$thoiKhoaBieu->danhgiacuagiangvien}}</textarea>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <label style="margin-top: 10px;">Lời nhắn của GV</label></label>
                    <textarea rows="3" type="text" class="form-control" id="" name="loinhancuagiangvien">{{$thoiKhoaBieu->loinhancuagiangvien}}</textarea>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <label style="margin-top: 10px;">Ghi chú</label></label>
                    <textarea rows="3" type="text" class="form-control" id="" name="ghichu">{{$thoiKhoaBieu->ghichu}}</textarea>
                </div>
            </div>
        </div>
        @if($isSubmit==0)
        <button type="submit" style="margin-top: 8px; margin-bottom: 8px;" class="btn btn-primary px-4 float-right"><i class="glyphicon glyphicon-floppy-disk"></i> Lưu</button>
        @endif
    </form>
</div>
</body>
@endsection