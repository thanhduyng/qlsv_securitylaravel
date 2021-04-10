@extends('layouts.trangchu')

@section('content')
<div style="text-align:right;padding: 4px;">
    <a class="btn btn-primary btn-sm" href="<?= route("qlsv_thoikhoabieu.index") ?>">
        <i class="glyphicon glyphicon-list-alt"></i></a>
</div>
<div class="container-fluid py-5">
    <div class="row" style="padding: 20px; padding-bottom: 50px;">
        <div class="col-md-10 mx-auto">
            <form method="post" action="{{route('qlsv_thoikhoabieu.store')}}">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6 col-xs-6">
                        <label for="">Buổi thứ</label>
                        <input type="number" class="form-control" id="" name="buoithu" placeholder="nhập buổi thứ" />
                    </div>
                    <div class="col-sm-6 col-xs-6">
                        <label for="">Ngày học</label>
                        <input type="date" class="form-control" id="" name="ngayhoc" placeholder="nhập ngày học" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 col-xs-6">
                        <label for="">Tên worktask</label></label>
                        <select name="id_worktask" class="form-control">
                            @foreach($workTask as $nd => $value)
                            <option value="{{$nd}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 col-xs-6">
                        <label for="">Tên phòng học</label>
                        <select name="id_phonghoc" class="form-control">
                            @foreach($phongHoc as $nd => $value)
                            <option value="{{$nd}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 col-xs-6">
                        <label for="">Ca học</label>
                        <select name="cahoc" class="form-control">
                            <option value="1">Sáng</option>
                            <option value="2">Chiều</option>
                            <option value="3">Tối</option>
                        </select>
                    </div>
                    <div class="col-sm-6 col-xs-6">
                        <label for="">Địa điểm học</label>
                        <select name="diadiemhoc" class="form-control">
                            <option value="1">Trường</option>
                            <option value="2">Xưởng Ô tô</option>
                            <option value="3">Khác</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 col-xs-6">
                        <label>Giờ vào:</label>
                        <input class="form-control" type="time" id="appt" name="giovao">
                    </div>
                    <div class="col-sm-6 col-xs-6">
                        <label>Giờ bắt đầu:</label>
                        <input class="form-control" type="time" id="appt" name="giobatdau">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 col-xs-6">
                        <label for="">Đánh giá giờ vào</label>
                        <select name="danhgiagiovao" class="form-control">
                            <option value="1">Đúng</option>
                            <option value="2">Trễ</option>
                        </select>
                    </div>
                    <div class="col-sm-6 col-xs-6">
                        <label for="">Lý do giờ vào</label>
                        <select name="lydogiovao" class="form-control">
                            <option value="0">Không có</option>
                            <option value="1">SV đến lớp trễ</option>
                            <option value="2">GV đến lớp trễ</option>
                            <option value="3">Chuẩn bị trễ</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 col-xs-6">
                        <label>Giờ ra:</label>
                        <input class="form-control" type="time" id="appt" name="giora">
                    </div>
                    <div class="col-sm-6 col-xs-6">
                        <label for="">Đánh giá giờ ra</label>
                        <select name="danhgiagiora" class="form-control">
                            <option value="1">Sớm</option>
                            <option value="2">Đúng</option>
                            <option value="3">Trễ</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 col-xs-6">
                        <label for="">Lý do giờ ra</label>
                        <select name="lydogiora" class="form-control">
                            <option value="1">Xong bài</option>
                            <option value="2">Lớp đề nghị</option>
                            <option value="3">Khác</option>
                        </select>
                    </div>
                    <div class="col-sm-6 col-xs-6">
                        <label for="">Sĩ số</label>
                        <input type="number" class="form-control" id="" name="siso" placeholder="nhập sĩ số" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 col-xs-6">
                        <label for="">Kết quả thực hiện</label>
                        <select name="ketquathuchien" class="form-control">
                            <option value="1">Thực hiện tốt hoặc hiểu bài</option>
                            <option value="2">Không làm được/không hiểu</option>
                        </select>
                    </div>
                    <div class="col-sm-6 col-xs-6">
                        <label for="">Lời nhắn Phòng Đào tạo(GV ghi lại tên xe thực hành-NẾU CÓ)</label>
                        <input type="text" class="form-control" id="" name="loinhanphongdaotao" placeholder="nhập lời nhắn" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 col-xs-6">
                        <label for="">Đánh giá của giảng viên</label></label>
                        <input type="text" class="form-control" id="" name="danhgiacuagiangvien" placeholder="nhập đánh giá" />
                    </div>
                    <div class="col-sm-6 col-xs-6">
                        <label for="">Lời nhắn của giảng viên</label></label>
                        <input type="text" class="form-control" id="" name="loinhancuagiangvien" placeholder="nhập lời nhắn" />
                    </div>
                </div>
                <div class="form-group row">

                    <div class="col-sm-6 col-xs-6">
                        <label for="">Ghi chú</label></label>
                        <input type="text" class="form-control" id="" name="ghichu" placeholder="nhập ghi chú" />
                    </div>

                </div>


                <button type="submit" class="btn btn-success px-4 float-right"><i class="glyphicon glyphicon-plus"></i> Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection