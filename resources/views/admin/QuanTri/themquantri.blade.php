@extends('layouts.trangchu')

@section('content')
<div style="text-align:right;padding: 4px; margin-right: 10px;">
    <a style="margin-top: 5px;" class="btn btn-primary btn-sm" href="<?= route("qlsv_quantri.index") ?>">
        <i class="glyphicon glyphicon-list-alt"></i></a>
</div>
<div class="container-fluid py-5" style="margin-bottom: 10px;">
    <div class="row" style="">
        <div class="col-md-10 mx-auto">
            <form id="jsgvsv" method="post" action="{{route('qlsv_quantri.store')}}">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="">Họ và tên:</label>
                        <input type="text" class="form-control" value="{{ old('ten') }}" id="ten" name="ten" placeholder="nhập họ và tên" />

                    </div>
                    <div class="col-sm-6" >
                        <label>Giới tính:</label>
                        <select name="gioitinh" class="form-control">
                            <option value="">-- Chọn--</option>
                            <option value="1" id="gioitinh1" name="gioitinh"> Nam </option>
                            <option value="2" id="gioitinh2" name="gioitinh">Nữ</option>
                            <option value="3" id="gioitinh3" name="gioitinh">Khác</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="">Số điện thoại:</label>
                        <input type="number" class="form-control" id="" name="sodienthoai" placeholder="nhập số điện thoại" />
                    </div>
                    <div class="col-sm-6">
                        <label for="">Địa chỉ:</label>
                        <input type="text" class="form-control" id="" name="diachi" placeholder="nhập địa chỉ" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="">username:</label>
                        <input type="text" value="{{ old('name') }}" class="form-control" id="name" name="name" placeholder="nhập name" />
                        @error('name')
                        {{ $message }}
                        @enderror
                    </div>

                    <div class="col-sm-6">
                        <label for="">Email:</label>
                        <input type="text" value="{{ old('email') }}" class="form-control" id="email" name="email" placeholder="nhập email" />
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label for="">Mật khẩu: </label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="nhập password" />
                    </div>
                </div>
                <button type="submit" name="register" id="register" class="btn btn-success px-4 float-right"><i class="glyphicon glyphicon-plus"></i> Thêm mới</button>
            </form>
        </div>
    </div>
</div>
@endsection