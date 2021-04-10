@extends('layouts.trangchu')

@section('content')

<head>
    <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
</head>
<div style="text-align:right;padding: 4px;">
    <a class="btn btn-success btn-sm" href="{{route('qlsv_worktask.create',$idd)}}">
        <i class="glyphicon glyphicon-plus"></i></a>

</div>
<!-- <div id="searcharea" class="collapse">
    <form action="{{route('qlsv_worktask.worktaskfind')}}" method="get" class="row p-3">
        <div class="form-group row" style="margin: 25px;">
            <div class="col-sm-6 col-xs-6">
                <label>Môn học</label>

                <select name="id" id="monhoc" class="form-control">
                    <option value="">--Chọn môn học--</option>
                    @foreach($monhoc as $i =>$cl )
                    <option value="{{$i}}">{{$cl}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-6 col-xs-6">
                <label>Tên WorkTask</label>
                <input class="form-control" id="txt_search" type="text" value="{{$search ?? '' }}" name="tenworktask" placeholder="Nhập Tên worktask">
            </div>
<div class="tab" id="searchResult">   
		   </div>
            <div class="col-sm-12">
                <button type="submit" id="timkiem" class="btn btn-primary btn-sm" style="float: right;
    margin-top: 10px;">Tìm kiếm</button>
            </div>
        </div>
    </form>
</div> -->
<form method=get>
    <table id="demo">
        <thead class="andi">
            <tr>
                <th>STT</th>
                <th>Tên WorkTask</th>

                <th>Sửa Xóa</th>
            </tr>
        </thead>
        <tbody>
            @if($worktask->count())
            @foreach($worktask as $i =>$wt )
            <tr>
                <input type="hidden" class="serdelete_val_id" value="{{$wt->id}}">
                <td> <a class="btn btn-default btn-circle">
                        <?php static $k = 0;
                        echo $k = $k + 1; ?>
                    </a>
                </td>
                <td>
                    <div style="margin-left: 27px;">
                        <?php $kk = 0; ?>
                        {{$wt->tenworktask}}<br>
                        @if($worktaskdetail->count())
                        @foreach($worktaskdetail as $ii =>$value )

                        @if($value->id_worktask==$wt->id)
                        <?php $kk = $kk + 1;
                        echo "  <i>" . $kk . "--{$value->ten}</i><br>";

                        ?>
                        @endif

                        @endforeach
                        @endif
                    </div>
                </td>

                <td style="padding-left:0;line-height: 33px;">
                    <a class="btn-default btn-xs" href="{{route('qlsv_worktask.edit',$wt->id)}}">
                        <i class="glyphicon glyphicon-pencil"></i></a>
                    <a class="btn-default btn-xs servicedeletebtn" href="{{route('qlsv_worktask.destroy',$wt->id)}}">
                        <i class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>

</form>
<div id="table1">


</div>

<script>
    $(document).ready(function() {
        $('.servicedeletebtn').click(async function(e) {
            e.preventDefault();

            var delete_id = $(this).closest("tr").find('.serdelete_val_id').val();



            const isDelete = await swal(_swalConfig.deleteConfirm)



            //await swal(_swalConfig.deleteSuccess)
            if (!isDelete) return
            $.ajax(this.href)
                .done((resp) => {
                    $(this).closest('tr').remove()
                }).then((result) => {

                    if (result._typeMessage == "deleteSuccess") {
                        swal(_swalConfig.deleteSuccess)
                    } else {
                        swal(_swalConfig.deleteFailed)
                    };
                });

        })
    });
</script>
<script>
    /*  $(function(e) {
        $("#chkCheckAll").click(function() {
            $(".checkBoxClass").prop('checked', $(this).prop('checked'));
        });
    });*/
</script>
<script>
    var tenmonhoc = [];

    /* $(document).ready(function(){

        $("#monhoc").change(function(e){
                e.preventDefault();


               // var _token = $("input[name='_token']").val();
               // var name = $("input[name='id_monhoc']").value;
            var name = document.getElementById("monhoc").value;
                    alert(name);

                $.ajax({
                    url: '/worktask/worktaskfind',
                    type:'GET',
                    data: { name:name},
                    success: function(data) {
                        $("#demo").hide();
                        $("#table1").empty();
                           // alert(data.success);
                    //  document.getElementById("thutu").value =data.success;
                      $("#table1").append("<div> <table class='table' >");
          
                      

                        }


                    
                });


            }); 






    $("#timkiem").click(function(){
    	
        var search1=document.getElementById("txt_search").value ;
       
        $.ajax({
            url: '/worktask/worktaskfind',
            type: 'get',
    				async:false,
                    data: {search1:search1, type:1},
                    dataType: 'json',
                    success:function(response){
                        var len = response.response.length;
    					$("#demo").hide();
                        $("#table").empty();
                        $("#table").append("<tr><th>STT</th><th>Tên WorkTask</th><th>Tên Môn Học</th><th>Thứ Tự</th><th>Sửa Xóa</th></tr>")
                        for( var i = 0; i<len; i++){
                            var id = response.response[i]['id'];
                            var name = response.response[i]['value'];
                            var ghichu = response.response[i]['ghichu'];
                             
                     $("#table").append("<tr><td>"+name+"</td><td>"+ghichu+"</td><td><form method='get' ><input type='hidden' name='id' value="+id+"> <button type='submit' class='btn btn-success px-4 float-right'><i class='glyphicon glyphicon-plus'></i>Chọn Môn</button></form></td></tr>");

                        }
                       
                    }
        });
    });
        $("#txt_search").keyup(function(){
            var search = $(this).val();

            if(search != ""){

                $.ajax({
                    url: '/worktask/findmon',
                    type: 'get',
    				async:false,
                    data: {search:search, type:1},
                    dataType: 'json',
                    success:function(response){
                    //alert(response.response[0]['id']);
                        var len = response.response.length;
                        $("#searchResult").empty();
                        for( var i = 0; i<len; i++){
                            var id = response.response[i]['id'];
                            var name = response.response[i]['value'];
                              tenmonhoc[i]=name;
                       

                        }

                       

                    }
                });
            }
    		


     });




    });




    $(function() {
                $( "#txt_search" ).autocomplete({
                   source:tenmonhoc,
                   minLength: 1
                });
             });






    function setText(element){
    	
    	var value = $(element).text();
    	  $("#txt_search").val(value);
    	$("#searchResult").hide();
    }*/
</script>

@endsection