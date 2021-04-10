@extends('layouts.trangchu')

@section('content')
<div style="text-align:right;padding: 4px;">
  <a style="margin-right: 15px; margin-top: 5px;" class="btn btn-primary btn-sm" href="<?= route("qlsv_monhoc.index") ?>">
    <i class="glyphicon glyphicon-list-alt"></i></a>
</div>
<body>
  <div class="container-fuild py-5" style="margin-top: 0px; margin-bottom: 1px;">
    <div class="row" style="padding: 20px;">
      <div class="col-md-10 mx-auto">
        <form id="jsvalidations" method="post" action="{{route('qlsv_monhoc.update',$monhoc->id)}}">
          @csrf
          <div class="form-group row">
            <div iv class="form-group">
              <input type="hidden" class="form-control" value="{{$monhoc->id}}" name="id">
            </div>
            <div class="col-sm-12">
              <label>Tên môn học</label>
              <input id="tenmonhoc" type="text" class="form-control" value="{{$monhoc->tenmonhoc}}" name="tenmonhoc" placeholder="nhập tên môn học" />
            </div>
            <div class="col-sm-12">
              <label>Ghi chú </label></br>
              <textarea rows="4" class="form-control" name="ghichu" form="monhoc" placeholder="nhập ghi chú">{{$monhoc->ghichu}}</textarea>
            </div>
          </div>
          <button type="submit" class="btn btn-primary px-4 float-right">
            <i class="glyphicon glyphicon-floppy-disk"></i> Lưu</button>
        </form>
      </div>
    </div>
  </div>
  @endsection