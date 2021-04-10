@extends('layouts.trangchu')

@section('content')
<div style="text-align:right;padding: 4px;">
    <a style="margin-right: 15px; margin-top: 5px;" class="btn btn-primary btn-sm" href="<?= route("qlsv_giangvien.index") ?>">
        <i class="glyphicon glyphicon-list-alt"></i></a>
</div>
<div class="container-fluid py-5">
    <div class="row" style="padding: 9px;">
        <form id="jsgvsv" method="post" action="{{ route('qlsv_giangvien.update',[$giangVien->id])}} ">
            @csrf
            <div iv class="form-group">
                <input type="hidden" class="form-control" value="{{$giangVien->id}}" name="id">
                <div class="col-sm-4">
                    <label for="recipient-name" class="col-form-label">Họ và Tên:</label>
                    <input type="text" class="form-control" name="hovaten" value="{{$giangVien->hovaten}}" placeholder="nhập họ và tên">
                </div>
                <div class="col-sm-4">
                    <label for="recipient-name" class="col-form-label">Ngày sinh:</label>
                    <input type="date" class="form-control" name="ngáyinh" value="{{$giangVien->ngaysinh}}" placeholder="nhập họ và tên">
                </div>
                <div class="col-sm-4">
                    <label for="recipient-name" class="col-form-label">Địa chỉ:</label>
                    <input type="text" class="form-control" name="diachi" value="{{$giangVien->diachi}}" placeholder="nhập địa chỉ">
                </div>
                <div class="col-sm-4">
                    <label for="recipient-name" class="col-form-label">Giới tính:</label>
                    <select name="gioitinh" class="form-control">
                        <option value="0" {{$giangVien->gioitinh == 0 ? 'selected' : '' }} name="gioitinh"> Nam
                        </option>
                        <option value="1" {{$giangVien->gioitinh == 1 ? 'selected' : ''}} name="gioitinh">Nữ</option>
                        <option value="2" {{$giangVien->gioitinh == 2 ? 'selected' : ''}} name="gioitinh">Khác</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="recipient-name" class="col-form-label">Số điện thoại cá nhân:</label>
                    <input type="text" class="form-control" value="{{$giangVien->sodienthoaicanhan}}" name="sodienthoaicanhan" placeholder="nhập số điện thoại liên hệ">
                </div>
                <div class="col-sm-4">
                    <label for="recipient-name" class="col-form-label">Số điện thoại công khai:</label>
                    <input type="text" class="form-control" value="{{$giangVien->sodienthoaicongkhai}}" name="sodienthoaicongkhai" placeholder="nhập số điện thoại liên hệ">
                </div>
                <div class="col-sm-4">
                    <label for="recipient-name" class="col-form-label">Giới thiệu:</label>
                    <input type="text" class="form-control" value="{{$giangVien->gioithieu}}" name="gioithieu" placeholder="nhập giới thiệu">
                </div>
                <div class="col-sm-4">
                    <label for="recipient-name" class="col-form-label">Ghi chú:</label>
                    <input type="text" class="form-control" value="{{$giangVien->ghichu}}" name="ghichu" placeholder="nhập ghi chú">
                </div>
                <div class="col-sm-12" style="margin-top: 10px;">
                    <button type="submit" class="btn btn-primary px-4 float-right"><i class="glyphicon glyphicon-floppy-disk"></i> Lưu</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
@endsection