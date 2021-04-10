@extends('layouts.trangchu')

@section('content')
<div style="text-align:right;padding: 4px;">
    <a style="margin-right: 15px; margin-top: 5px;" class="btn btn-primary btn-sm" href="<?= route("qlsv_xinnghi.index") ?>">
        <i class="glyphicon glyphicon-list-alt"></i></a>
</div>
<body>
    <div class="container-fuild py-5" style="margin-top: 0px; margin-bottom: 1px;">
        <div class="row" style="padding: 20px;">
            <div class="col-md-10 mx-auto">
                <form method="post" action="{{ route('qlsv_xinnghi.store') }}">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label for="">Ngày xin nghỉ</label>
                            <input type="date" class="form-control" name="ngaynghi" />
                        </div>
                        <div class="col-sm-12">
                            <label>Nội dung </label></br>
                            <textarea rows="4" class="form-control" name="noidung"  placeholder="nhập nội dung"></textarea>
                        </div>
                        <div class="col-sm-12">
                            <label>Lý do </label></br>
                            <textarea rows="2" class="form-control" name="lydo"  placeholder="nhập lý do"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success px-4 float-right"><i class="glyphicon glyphicon-plus"></i> Thêm
                            mới</button>
                </form>
            </div>
        </div>
    </div>
    @endsection