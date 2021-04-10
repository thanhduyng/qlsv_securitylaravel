@extends('layouts.trangchu')

@section('content')
<div style="text-align:right;padding: 4px;">
  <a class="btn btn-primary btn-sm" style="margin-right: 15px; margin-top: 5px;" href="<?= route("qlsv_phonghoc.index") ?>">
    <i class="glyphicon glyphicon-list-alt"></i></a>
</div>

<div class="container-fluid py-5">
  <div class="row" style="padding: 20px;">
    <form id="jsvalidations" method="post" action="{{route('qlsv_phonghoc.store')}}">
      @csrf
      <div class="form-group row">
        <div class="col-sm-12">
          <label>Tên phòng học</label>
          <input type="text" class="form-control" id="tenphonghoc" name="tenphonghoc" placeholder="nhập tên phòng học" />
        </div>
        <div class="col-sm-12">
          <label>Ghi chú</label>
          <textarea type="text" class="form-control" rows="3" name="ghichu" placeholder="nhập ghi chú"></textarea>
        </div>
      </div>
      <button type="submit" class="btn btn-success px-4 float-right"><i class="glyphicon glyphicon-plus"></i> Thêm mới</button>
    </form>
  </div>
</div>
@endsection