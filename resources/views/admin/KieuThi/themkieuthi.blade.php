@extends('layouts.trangchu')

@section('content')
<div style="text-align:right;padding: 4px;">
    <a style="margin-right: 15px; margin-top: 5px;" class="btn btn-primary btn-sm" href="<?= route("qlsv_kieuthi.index") ?>">
        <i class="glyphicon glyphicon-list-alt"></i></a>
</div>
<div class="container-fluid py-5">
    <div class="row" style="padding: 4px;">
        <div class="col-md-10 mx-auto">
            <form id="jsvalidations" method="post" action="{{route('qlsv_kieuthi.store')}}">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="kieuthi">Tên kiểu thi:</label>
                        <input id="kieuthi" type="text" class="form-control" name="kieuthi" placeholder="nhập tên kiểu thi" />
                    </div>

                </div>
                <button type="submit" class="btn btn-success px-4 float-right"><i class="glyphicon glyphicon-plus"></i> Thêm mới</button>

            </form>
        </div>
    </div>
</div>
@endsection