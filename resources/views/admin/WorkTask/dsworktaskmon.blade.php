@extends('layouts.trangchu')

@section('content')

<body>
    <div class="container-fuild py-5" style="margin-top: 0px; margin-bottom: 1px;">
        <div class="row" style="background-color:white; padding: 40px; padding-bottom: 80px;">
            <div class="col-md-10 mx-auto">
                <table class="table">
                    @csrf
                    <thead>
                        <tr>
                            <h2><span class="label label-primary">Tên môn học :</span></h2>
                        </tr>
                    </thead>
                    <tr>
                        <tbody>
                            <td>
                                <h2><span class="label label-primary">{{$monhoc->tenmonhoc}}</span></h2>
                            </td>
                        </tbody>
                    </tr>
                </table>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Số Thứ Tự</th>
                            <th> Tên WorkTask </th>
                            @csrf
                            <th>Tên công việc</th>
                            <th>Sửa Xóa</th>
                        </tr>
                    </thead>
                    @if($worktask->count())
                    @foreach($worktask as $i =>$wt )

                    <tbody>
                        <tr>
                          
                            <td rowspan="3"><?php static $k = 0;
                                            $k = $k + 1;
                                            echo "Task : " . $k; ?></td>
                            <td rowspan="3">{{$wt}}</td>
                            <td rowspan="3">
                                @foreach($worktaskdetail as $j =>$wtl)
                                
                                @if($wtl->id_worktask==$i)
                                +{{$wtl->ten}}.</br>

                                @endif
                                @endforeach
                            </td>
                            <td rowspan="3" style="padding-left:0;line-height: 33px;">
                                <a class="btn-default btn-xs" href="{{route('qlsv_worktask.edit',$i)}}"">
                        <i class=" glyphicon glyphicon-pencil"></i></a>
                                <a class="btn-default btn-xs" href="{{route('qlsv_worktask.destroy',$i)}}">
                                    <i class="glyphicon glyphicon-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                    @endif
                </table>
                @csrf
            </div>
            <a type="button" href="{{route('qlsv_worktask.index')}}" class="btn btn-primary px-4 float-right"> Danh sách worktask</a>
        </div>
    </div>
    </div>








</body>


<script>
    /*  $(function(e) {
        $("#chkCheckAll").click(function() {
            $(".checkBoxClass").prop('checked', $(this).prop('checked'));
        });
    });*/
</script>

<script type="text/javascript">
    /*  $(document).ready(function() {


        $('#master').on('click', function(e) {
            if ($(this).is(':checked', true)) {
                $(".sub_chk").prop('checked', true);
            } else {
                $(".sub_chk").prop('checked', false);
            }
        });


        $('.delete_all').on('click', function(e) {


            var allVals = [];
            $(".sub_chk:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });


            if (allVals.length <= 0) {
                alert("Vui lòng chọn hàng");
            } else {


                var check = confirm("Bạn có chắc chắn muốn xóa hàng này không ? ");
                if (check == true) {


                    var join_selected_values = allVals.join(",");


                    $.ajax({
                        url: $(this).data('url'),
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: 'ids=' + join_selected_values,
                        success: function(data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {
                                    $(this).parents("tr").remove();
                                });
                                alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Rất tiếc, đã xảy ra lỗi !!');
                            }
                        },
                        error: function(data) {
                            alert(data.responseText);
                        }
                    });


                    $.each(allVals, function(index, value) {
                        $('table tr').filter("[data-row-id='" + value + "']").remove();
                    });
                }
            }
        });


        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function(event, element) {
                element.trigger('confirm');
            }
        });


        $(document).on('confirm', function(e) {
            var ele = e.target;
            e.preventDefault();


            $.ajax({
                url: ele.href,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data['success']) {
                        $("#" + data['tr']).slideUp("slow");
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Rất tiếc, đã xảy ra lỗi !!');
                    }
                },
                error: function(data) {
                    alert(data.responseText);
                }
            });


            return false;
        });
    });*/
</script>
@endsection