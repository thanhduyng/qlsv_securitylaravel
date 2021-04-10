    @extends('layouts.trangchu')

    @section('content')

    <div style="text-align:right;padding: 4px;">
        <a style="margin-right: 15px; margin-top: 5px;" class="btn btn-primary btn-sm" href="<?= route("qlsv_sinhvien.index") ?>">
            <i class="glyphicon glyphicon-list-alt"></i></a>
    </div>

    <body>
        <div class="container-fuild py-5">
            <div class="row" style="padding: 20px;">
                <div class="col-md-10 mx-auto">
                    <form id="jsgvsv" method="post" action="{{ route('qlsv_sinhvien.store') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label>Họ và tên</label>
                                <input type="text" class="form-control" id="" name="hovaten" placeholder="nhập họ và tên" />
                            </div>
                            <div class="col-sm-6">
                                <label style="margin-top: 7px;">Địa chỉ</label>
                                <input type="text" class="form-control" id="" name="diachi" placeholder="nhập địa chỉ" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="">Tên khóa học</label>
                                <select name="id_khoahoc" required class="form-control">
                                    <option value="">-- Chọn --</option>
                                    @foreach($khoaHoc as $nd => $value)
                                    <option value="{{$nd}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 ">
                                <label style="">Giới tính</label>
                                <select name="gioitinh" required class="form-control">
                                    <option value="">-- Chọn --</option>
                                    <option value="1">Nam</option>
                                    <option value="2">Nữ</option>
                                    <option value="3">Khác</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="">Số điện thoại sinh viên</label>
                                <input type="number" class="form-control" id="" name="sodienthoaisinhvien" placeholder="nhập số điện thoại sinh viên" />
                            </div>
                            <div class="col-sm-6">
                                <label style="">Số điện thoại gia đình</label>
                                <input type="number" class="form-control" id="" name="sodienthoaigiadinh" placeholder="nhập số điện thoại gia đình" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="">Username</label>
                                <input type="text" class="form-control" id="" name="name" placeholder="nhập username" />
                            </div>
                            <div class="col-sm-6">
                                <label style="">Mật khẩu</label>
                                <input type="password" class="form-control" name="password" placeholder="nhập mật khẩu" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="">Email</label>
                                <input type="text" class="form-control" id="" name="email" placeholder="nhập email" />
                            </div>
                            <div class="col-sm-6">
                                <label for="">Ghi chú</label>
                                <textarea rows="3" type="text" class="form-control" id="" name="ghichu" placeholder="nhập ghi chú"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success px-4 float-right">
                            <i class="glyphicon glyphicon-plus"></i> Thêm mới</button>
                </div>
                </form>
            </div>
        </div>
        </div>
        @endsection