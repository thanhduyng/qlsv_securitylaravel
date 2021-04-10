@extends('layouts.trangchu')

@section('content')
<div style="text-align:right;padding: 4px;">
  <a style="margin-right: 15px; margin-top: 5px;" class="btn btn-primary btn-sm" href="<?= route("qlsv_phonghoc.index") ?>">
    <i class="glyphicon glyphicon-list-alt"></i></a>
</div>
<div class="container">
  <form id="jsvalidations" method="post" action="{{ route('qlsv_phonghoc.update',[$phongHoc->id])}} ">
    @csrf
    <div class="form-group">
      <input class="form-control" type="hidden" name="id" value="{{$phongHoc->id}}" />
    </div>
    <div class="form-group">
      <label>Tên phòng hoc</label>
      <input id="tenphonghoc" class="form-control" type="text" name="tenphonghoc" value="{{$phongHoc->tenphonghoc}}" />
    </div>
    <div class="form-group">
      <label>Ghi chú</label>
      <textarea class="form-control" type="text" name="ghichu">{{$phongHoc->ghichu}}</textarea>
    </div>
    <button style="margin-bottom: 5px;" type="submit" class="btn btn-primary px-4 float-right"><i class="glyphicon glyphicon-floppy-disk"></i> Lưu</button>
  </form>
</div>
@endsection