@extends('layouts.trangchu')

@section('content')
<div style="text-align:right;padding: 4px;">
    <a style="margin-right: 15px; margin-top: 5px;" class="btn btn-primary btn-sm" href="<?= route("qlsv_kieuthi.index") ?>">
        <i class="glyphicon glyphicon-list-alt"></i></a>
</div>
<div class="container">

    <form id="jsvalidations" method="post" action="{{ route('qlsv_kieuthi.update',[$qlsv_kieuthi->id])}} ">
        @csrf
        <div iv class="form-group">
            <input type="hidden" class="form-control" value="{{$qlsv_kieuthi->id}}" name="id">
        </div>
        <div class="form-group">
            <label for="ten">Tên kiểu thi:</label>
            <input id="kieuthi" type="text" class="form-control" name="kieuthi" value="{{$qlsv_kieuthi->kieuthi}}" placeholder="nhập tên Kiểu Thi" />
        </div>
        <button style="margin-bottom: 5px;" type="submit" class="btn btn-primary px-4 float-right"><i class="glyphicon glyphicon-floppy-disk"></i> Lưu</button>
    </form>
</div>
</body>
@endsection