@extends('layouts.trangchu')

@section('content')

<head>
 
  <style>
        @media (max-width: 880px) {
            .plus-them {
                margin-left: 300px;
            }
        }
    </style>
</head>

<body>
  <div class="container-fuild py-5" style="margin-top: 0px; margin-bottom: 1px;">
    <div class="row" style="background-color:#ddd; padding: 40px; padding-bottom: 80px;">
    
      <div class="col-md-10 mx-auto">
       
          @csrf
          <div class="form-group row">
            <div class="col-sm-6">
              <label for="">Tên worktask</label>
              <input type="text" class="form-control" id="" value="{{$worktask->tenworktask}}" name="tenworktask" placeholder="nhập tên worktask" />
            </div>
            </br> </br> </br>
			 
			 <table class="table">
							 <thead>
                     <tr>
                   
                  <th>Tên công việc</th>
                       <th></th>
                         </tr>
                     </thead>
					 <tbody>
					
                        @foreach($worktaskdetail as $wtl)
					 @if($wtl->id_worktask==$worktask->id)
                        <tr>
	                    
                     <td >  
					 <input type="text"   class="form-control" name="ten[]" value="{{$wtl->ten}}" placeholder="Enter tên worktaskdetail">
            <td>
						</tr>
						
						
						@endif
						@endforeach
					
						
						</tbody>
						</table>
			
			
			
			
          </div>
         
      </div>
    </div>
  </div>
  @endsection