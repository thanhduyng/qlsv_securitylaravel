@extends('layouts.trangchu')

@section('content')
<div style="text-align:right;padding: 4px;">
  <a style="margin-right: 15px; margin-top: 5px;" class="btn btn-primary btn-sm" href="<?= route("qlsv_khoahoc.index") ?>">
    <i class="glyphicon glyphicon-list-alt"></i></a>
</div>
<div class="container-fluid py-5">
  <div class="row" style="padding: 20px;">
      <form id="jsvalidations" method="post" action="{{route('qlsv_khoahoc.store')}}">
        @csrf
        <div class="form-group row">
          <div class="col-sm-12">
            <label for="inputFirstname">Tên khoá học</label>
            <input type="text" class="form-control" id="tenkhoahoc" name="tenkhoahoc" placeholder="nhập tên khoá học" />
            <!-- <span style="color: red;">@error('tenkhoahoc'){{$message}}@enderror</span> -->
          </div>
          <div class="col-sm-12" style="margin-top: 6px;">
            <label for="inputFirstname">Ghi chú</label>
            <input type="text" class="form-control" id="" name="ghichu" placeholder="nhập ghi chú" />
            <!-- <span style="color: red;">@error('ghichu'){{$message}}@enderror</span> -->
          </div>
        </div>
        <button type="submit" class="btn btn-success px-4 float-right"><i class="glyphicon glyphicon-plus"></i> Thêm mới</button>
      </form>
    </div>
  </div>
@endsection