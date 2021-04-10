@extends('layouts.trangchu')

@section('content')
<div style="text-align:right;padding: 4px;">
    <a style="margin-right: 15px; margin-top: 5px;" class="btn btn-primary btn-sm" href="<?= route("qlsv_quantri.index") ?>">
        <i class="glyphicon glyphicon-list-alt"></i></a>
</div>
<div class="container" style="margin-bottom: 10px;">
    <form method="post" action="{{ route('qlsv_quantri.update',[$quanTri->id])}} ">
        @csrf
        <div iv class="form-group">
            <input type="hidden" class="form-control" value="{{$quanTri->id}}" name="id">
        </div>
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Họ và Tên:</label>
            <input type="text" class="form-control" name="ten" value="{{$quanTri->ten}}" placeholder="nhập họ và tên">
        </div>
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Địa chỉ:</label>
            <input type="text" class="form-control" name="diachi" value="{{$quanTri->diachi}}" placeholder="nhập địa chỉ">
        </div>

        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Giới tính:</label>
            <select name="gioitinh" class="form-control">
                <option value="0" {{$quanTri->gioitinh == 0 ? 'selected' : '' }} name="gioitinh"> Nam
                </option>
                <option value="1" {{$quanTri->gioitinh == 1 ? 'selected' : ''}} name="gioitinh">Nữ</option>
                <option value="2" {{$quanTri->gioitinh == 2 ? 'selected' : ''}} name="gioitinh">Khác</option>
            </select>
        </div>

        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Số điện thoại:</label>
            <input type="text" class="form-control" value="{{$quanTri->sodienthoai}}" name="sodienthoai" placeholder="nhập số điện thoại">
        </div>
        <button type="submit" class="btn btn-primary px-4 float-right"><i class="glyphicon glyphicon-floppy-disk"></i> Lưu</button>

    </form>
</div>
</body>
@endsection