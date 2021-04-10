@extends('layouts.trangchu')

@section('content')

<head>
    <style>
       
    </style>
</head>
<div style="text-align:right;padding: 4px; margin-right: 10px;">
    <a style="margin-top: 5px;" class="btn btn-primary btn-sm" href="<?= route("qlsv_giangvien.index") ?>">
        <i class="glyphicon glyphicon-list-alt"></i></a>
</div>
<div class="container-fluid py-5">
    <div class="row" style="padding: 8px;">
        <div class="col-md-10 mx-auto">
            <form id="jsgvsv" method="post" action="{{route('qlsv_giangvien.store')}}">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="">Họ và tên:</label>
                        <input type="text" required class="form-control" value="{{ old('hovaten') }}" id="hovaten" name="hovaten" placeholder="nhập họ và tên" />
                    </div>
                    <div class="col-sm-4">
                        <label>Giới tính:</label>
                        <select name="gioitinh" class="form-control" required>
                            <option value=''>-- Chọn -- </option>
                            <option value="1" id="gioitinh1" name="gioitinh"> Nam </option>
                            <option value="2" id="gioitinh2" name="gioitinh">Nữ</option>
                            <option value="3" id="gioitinh3" name="gioitinh">Khác</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <label for="">Ngày sinh:</label>
                        <input type="date" value="" class="form-control" name="ngaysinh" placeholder="nhập ngày sinh" />
                    </div>
                    <div class="col-sm-4">
                        <label for="">Địa chỉ:</label>
                        <input type="text" class="form-control" id="" name="diachi" placeholder="nhập địa chỉ" />
                    </div>


                    <div class="col-sm-4">
                        <label for="">Số điện thoại Cá nhân:</label>
                        <input type="text" class="form-control" id="" name="sodienthoaicanhan" placeholder="nhập số điện thoại cá nhân" />
                    </div>
                    <div class="col-sm-4">
                        <label for="">Số điện thoại Công khai: </label>
                        <input type="text" class="form-control" id="" name="sodienthoaicongkhai" placeholder="nhập số điện thoại công khai" />
                    </div>
                    <div class="col-sm-4">
                        <label for="">Giới thiệu:</label>
                        <input type="text" class="form-control" name="gioithieu" placeholder="nhập giới thiệu" />
                    </div>
                    <div class="col-sm-4">
                        <label for="">Ghi chú:</label>
                        <input type="text" class="form-control" id="" name="ghichu" placeholder="nhập ghi chú" />
                    </div>

                    <div class="col-sm-4">
                        <label for="">username:</label>
                        <input type="text" value="{{ old('name') }}" class="form-control" id="name" name="name" placeholder="nhập name" />
                        <!-- @error('name')
                        {{ $message }}
                        @enderror -->
                    </div>

                    <div class="col-sm-4">
                        <label for="">Email:</label>
                        <input type="email" value="{{ old('email') }}" class="form-control" id="email" name="email" placeholder="nhập email" />
                        <!-- @error('email')
                        {{ $message }}
                        @enderror -->
                    </div>
                    <div class="col-sm-4">
                        <label for="">Mật khẩu: </label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="nhập password" />
                    </div>
                </div>
                <button type="submit" name="register" id="register" class="btn btn-success px-4 float-right"><i class="glyphicon glyphicon-plus"></i> Thêm mới</button>
                <!-- <input type="submit" name='submit' value="Submit"> -->
            </form>

        </div>
    </div>
</div>
@endsection