@extends('layouts.trangchu')

@section('content')

<head>
    <style>
        @media (max-width: 880px) {
            .footer-distributed {
                position: fixed;
                bottom: 0px;
            }
        }
    </style>
</head>
<body style="height: 900px;">
<div style="text-align:right;padding: 4px;">
    <a class="btn btn-primary btn-sm" style="margin-right: 15px; margin-top: 5px;" href="<?= route("qlsv_vaitro.index") ?>">
        <i class="glyphicon glyphicon-list-alt"></i></a>
</div>
<div class="container-fluid py-5">
    <div class="row" style="padding: 20px;">
        <form method="post" action="{{ route('qlsv_vaitro.update',[$vaiTro->id])}}">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6">
                    <label>Mã vai trò</label>
                    <input type="text" class="form-control" value="{{$vaiTro->ma}}" id="" name="ma" placeholder="nhập mã" />
                </div>
                <div class="col-sm-6" style="margin-top: 6px;">
                    <label>Tên vai trò</label>
                    <input type="text" class="form-control" value="{{$vaiTro->ten}}" id="" name="ten" placeholder="nhập tên" />
                </div>
            </div>

            <div>
                @foreach($qlsv_chucnangs as $qlsv_chucnangs)
                <div class="form-check">
                    <div class="col-md-6">
                        <input type="checkbox" class="form-check-input" name="chucnangs[]" {{$listRowOfChucnang->contains($qlsv_chucnangs->id)?'checked':''}} value="{{$qlsv_chucnangs->id}}" />
                        <label>{{$qlsv_chucnangs->ten}}</label>
                    </div>
                </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-success px-4 float-right"><i class="glyphicon glyphicon-plus"></i> Thêm mới</button>
        </form>
    </div>
</div>
</body>
@endsection