 
 @extends('layouts.trangchu')

@section('content')
<head>

	 <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
         rel = "stylesheet">
      <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
      <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	 
</head>
 <body>
  <div class="container-fuild py-5" style="margin-top: 0px; margin-bottom: 1px;">
    <div class="row" style="background-color:white; padding: 40px; padding-bottom: 80px;">
    
      <div class="col-md-10 mx-auto">

      <div style="text-align:right;background-color:#f3ecec;padding: 4px;" >
    <a class="btn btn-primary btn-sm" href="#"  onclick="$('#searcharea').toggle();return false;">
        <i class="glyphicon glyphicon-search" ></i></a>
	<a class="btn btn-primary btn-sm" href="{{route('qlsv_worktask.index')}}">
       <i class="glyphicon glyphicon-list-alt">Worktask</i></a>
  <a class="btn btn-primary btn-sm" href="{{route('qlsv_monhoc.index')}}">
        <i class="glyphicon glyphicon-list-alt">Môn Học</i></a>

</div>

<div id="searcharea" style="display:none">
   
        <div class="form-group">
            <input id="txt_search" class="form-control" type="text" value="" name="tenmonhoc" placeholder="Tìm kiếm môn học">
           <div class="tab" id="searchResult">
		   
		   </div>
		   
			<button type="submit" id="timkiem"  class="btn btn-primary">Tìm kiếm</button>
        </div>
   
</div>



 <div   id="demo" >
 <form action="<?= route("qlsv_worktask.chonmonhoc") ?>" method="get">
        <div class="form-group">
              <label for="">Tên môn học</label>
              <select class="form-control" name="id" id="monhoc1">
                  @foreach($monhoc as $key=>$mh)
                  <option value={{$key}}> {{$mh}} </option>
                  @endforeach
               </select>
            </div>
			 <button type="submit" class="btn btn-success px-4 float-right"><i class="glyphicon glyphicon-plus"></i>Chọn Môn</button>
         
    </form>
 </div>
	
 

   
</div>
<div>
<table id="table" class="table" >


</table>

</div>
	</body>
	</div>
    </div>
  </div>
  



<script>
var tenmonhoc=[];

 $(document).ready(function(){
$("#timkiem").click(function(){
	$("#demo").hide();
    var search1=document.getElementById("txt_search").value ;
   
    $.ajax({
        url: '/worktask/findmon1',
        type: 'get',
				async:false,
                data: {search1:search1, type:1},
                dataType: 'json',
                success:function(response){
                    var len = response.response.length;
                    $("#table").empty();
                    $("#table").append("<tr><th>Tên Môn</th><th>Ghi Chú</th><th>Chọn môn</th></tr>")
                    for( var i = 0; i<len; i++){
                        var id = response.response[i]['id'];
                        var name = response.response[i]['value'];
                        var ghichu = response.response[i]['ghichu'];
                         
                 $("#table").append("<tr><td>"+name+"</td><td>"+ghichu+"</td><td><form action='{{route('qlsv_worktask.chonmonhoc') }}' method='get' ><input type='hidden' name='id' value="+id+"> <button type='submit' class='btn btn-success px-4 float-right'><i class='glyphicon glyphicon-plus'></i>Chọn Môn</button></form></td></tr>");

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
                       // $("#searchResult").append("<div class='tablinks' value='"+id+"'>"+name+"</div>");

                    }

                    // binding click event to li
                  //  $("#searchResult div").bind("click",function(){
                  //      setText(this);
                  //  });

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
}
</script>
    @endsection