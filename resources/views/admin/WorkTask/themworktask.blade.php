@extends('layouts.trangchu')

@section('content')

<div style="text-align:right;padding: 4px;">
  <a style="margin-right: 15px; margin-top: 5px;" class="btn btn-primary btn-sm" href="{{route('qlsv_worktask.mon',$id)}}">
    <i class="glyphicon glyphicon-list-alt"></i></a>
</div>

<body>

  <div class="container-fuild py-5" style="margin-top: 0px; margin-bottom: 1px;">
    <div class="row" style=" padding: 40px; padding-bottom: 80px;">
      <div class="col-md-10 mx-auto">
        <form method="post" action="{{ route('qlsv_worktask.store')}}">
          @csrf
          <div class="form-group row">
            <div class="col-sm-6">
              <label for="">Tên worktask</label>
              <input type="text" class="form-control" id="" name="tenworktask" placeholder="nhập tên worktask" />
              <span style="color: red;">@error('tenworktask'){{$message}}@enderror</span>
            </div>

            <div class="col-sm-6">
              <label for="">Thứ tự worktask</label>
              <input type="number" class="form-control" value={{$thutu}} id="thutu" name="thutu" placeholder="nhập thứ tự worktask" readonly />
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-6">
              <input type="hidden" name="id_monhoc" value="{{$monhoc2[0]->id}}" id="monhoc1" class="form-control" />
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-6">


              <table class="table">
                <thead>
                  <tr width="100%">
                    <th>STT</th>
                    <th>Tên công việc</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr width="100%">
                    <td>1</td>
                    <td>
                      <input type="text" class="form-control" name="ten[]" value="" placeholder="Enter tên worktaskdetail">
                    <td>
                  </tr>
                  <tr width="100%">
                    <td>2</td>
                    <td>
                      <input type="text" class="form-control" name="ten[]" value="" placeholder="Enter tên worktaskdetail">
                    <td>
                  </tr>
                  <tr width="100%">
                    <td>3</td>
                    <td>
                      <input type="text" class="form-control" name="ten[]" value="" placeholder="Enter tên worktaskdetail">
                    <td>
                  </tr>
                  <tr width="100%">
                    <td>4</td>
                    <td>
                      <input type="text" class="form-control" name="ten[]" value="" placeholder="Enter tên worktaskdetail">
                    <td>
                  </tr>
                  <tr width="100%">
                    <td>5</td>
                    <td>
                      <input type="text" class="form-control" name="ten[]" value="" placeholder="Enter tên worktaskdetail">
                    <td>
                  </tr>
                  <tr width="100%">
                    <td>6</td>
                    <td>
                      <input type="text" class="form-control" name="ten[]" value="" placeholder="Enter tên worktaskdetail">
                    <td>
                  </tr>
                  <tr width="100%">
                    <td>7</td>
                    <td>
                      <input type="text" class="form-control" name="ten[]" value="" placeholder="Enter tên worktaskdetail">
                    <td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <input type="submit" value="+ Lưu" class=" btn btn-success px-4 float-right " />
        </form>
      </div>
    </div>
  </div>
</body>
<script type="text/javascript">
  $(document).ready(function() {
    $("#monhoc1").change(function(e) {
      e.preventDefault();


      // var _token = $("input[name='_token']").val();
      // var name = $("input[name='id_monhoc']").value;
      var name = document.getElementById("monhoc1").value;


      $.ajax({
        url: '/worktask/show',
        type: 'GET',
        data: {
          name: name
        },
        success: function(data) {

          alert(data);
          var thutu = JSON.parse(data);
          alert(thutu);
          document.getElementById("thutu").value = data.success;

        }
      });
    });
  });
</script>
@endsection