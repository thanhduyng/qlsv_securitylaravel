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
<div style="text-align:right;padding: 4px;">
    <a class="btn btn-primary btn-sm" style="margin-right: 15px; margin-top: 5px;" href="<?= route("qlsv_vaitro.index") ?>">
        <i class="glyphicon glyphicon-list-alt"></i></a>
</div>
<div class="container-fluid py-5">
    <div class="row" style="padding: 20px;">
        <form method="post" action="{{route('qlsv_vaitro.store')}}">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6">
                    <label>Mã vai trò</label>
                    <input type="text" class="form-control" id="" name="ma" placeholder="nhập mã" />
                </div>
                <div class="col-sm-6" style="margin-top: 6px;">
                    <label>Tên vai trò</label>
                    <input type="text" class="form-control" id="" name="ten" placeholder="nhập tên" />
                </div>
            </div>
            <div>
                @php echo($cn) @endphp
            </div>
            {{--<div style="">
                @foreach($chucNang as $chucNang)
                <div class="form-check">
                    <div class="col-md-6">
                        <input type="checkbox" class="form-check-input" name="chucnang[]" value="{{$chucNang->id}}">
            <label class="form-check-label">{{$chucNang->ten}}</label>
    </div>
</div>
@endforeach
</div>--}}
<button type="submit" class="btn btn-success px-4 float-right"><i class="glyphicon glyphicon-plus"></i> Thêm mới</button>
</form>
</div>
</div>
@endsection