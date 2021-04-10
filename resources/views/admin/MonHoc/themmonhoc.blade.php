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
        <form method="post" id="jsvalidations" action="{{route('qlsv_monhoc.store')}}" id="monhoc">
          @csrf
          <div class="form-group row">
            <div class="col-sm-12">
              <label for="">Tên môn học</label>
              <input type="text" class="form-control" id="tenmonhoc" name="tenmonhoc" placeholder="nhập tên môn học" />
            </div>
            <div class="col-sm-12">
              <label>Ghi chú </label></br>
              <textarea type="text" class="form-control" id="" name="ghichu" placeholder="nhập ghi chú" ></textarea>
            </div>
          </div>
          <input type="submit" value="+ Thêm mới"  class=" btn btn-success px-4 float-right "/>
        </form>
      </div>
    </div>
   {{-- @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    --}}


  </div>



  @endsection