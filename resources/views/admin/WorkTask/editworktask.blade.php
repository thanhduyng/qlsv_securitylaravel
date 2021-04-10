@extends('layouts.trangchu')

@section('content')

<body>
  <div class="container-fuild py-5" style="margin-top: 0px; margin-bottom: 1px;">
    <div class="row" style="padding: 25px; padding-bottom: 20px;">

      <div class="col-md-10 mx-auto">
        <form method="post" action="{{route('qlsv_worktask.update',$worktask->id)}}">
          @csrf
          <input type="hidden" name="id" value={{$worktask->id}}>
          <div class="form-group">
            <h4> <label class="label label-primary" for="">Tên worktask</label></h4>
            <input type="text" class="form-control" name="tenworktask" value="{{$worktask->tenworktask}}" placeholder="Enter Tên worktask">
          </div>
          <div class="form-group">
            <input type="hidden" name="id_monhoc" value="{{$monhoc2[0]->id}}" id="monhoc1" class="form-control" />
          </div>
          <div class="form-group">
            <h4><label class="label label-primary" for="">Thứ tự worktask</label></h4>
            <input type="number" class="form-control" name="thutu" value="{{$worktask->thutu}}" placeholder="Enter thứ tự">
          </div>
          <table class="table">
            @csrf
            <thead>
              <tr>
                <th width=100%><a>Tên công việc</a></th>
              </tr>
            </thead>
            <tbody>
              @foreach($worktaskdetail as $wtl)
              @if($wtl->id_worktask==$worktask->id)
              <tr>
                <td>
                  <input type="text" class="form-control" name="ten[]" value="{{$wtl->ten}}" placeholder="Enter tên worktaskdetail">
                <td>
              </tr>
              @endif
              @endforeach
              <tr>
                <td>
                  <input type="text" class="form-control" name="ten[]" value="" placeholder="Enter tên worktaskdetail">
                <td>
              </tr>
              <tr>
                <td>
                  <input type="text" class="form-control" name="ten[]" value="" placeholder="Enter tên worktaskdetail">
                <td>
              </tr>
              <tr>
                <td>
                  <input type="text" class="form-control" name="ten[]" value="" placeholder="Enter tên worktaskdetail">
                <td>
              </tr>
              <tr>
                <td>
                  <input type="text" class="form-control" name="ten[]" value="" placeholder="Enter tên worktaskdetail">
                <td>
              </tr>
            </tbody>
          </table>
          @csrf
      </div>
      <!-- <input style="margin-left: 15px;" type="submit" value="+ Lưu" 
      class=" btn btn-primary px-4 float-right " /> -->
      <button style="margin-bottom: 5px; margin-left: 15px;" type="submit" class="btn btn-primary px-4 float-right"><i class="glyphicon glyphicon-floppy-disk"></i> Lưu</button>
      </form>
    </div>
  </div>
  </div>
  @endsection