@extends('layouts.trangchu')

@section('content')

<div style="text-align:right;padding-top: 7px; padding-bottom: 5px;">
    <a class="btn btn-primary btn-sm" href="#searcharea" data-toggle="collapse">
        <i class="glyphicon glyphicon-search"></i></a>
    <a class="btn btn-success btn-sm" href="{{route('qlsv_monhoc.create')}}">
        <i class="glyphicon glyphicon-plus"></i></a>

</div>
<div id="searcharea" class="collapse" style="margin-top: 15px;">
    <form action="<?= route("qlsv_monhoc.search") ?>" method="get">
        <div class="form-group row">
            <div class="col-sm-4 col-xs-7">
                <input style="width: 220px; margin-left: 16px; margin-top: -1px;" class="form-control" id="tenmonhoc" type="text" value="{{$tenmonhoc ?? '' }}" name="tenmonhoc" placeholder="Nhập Tên môn học">
            </div>
            <div class="tab" id="searchResult">
            </div>
            <div class="col-sm-4 col-xs-3">
                <button type="submit" id="timkiem" class="btn btn-primary btn-sm" style="margin-left: 44px;">Tìm kiếm</button>
            </div>
        </div>
    </form>
</div>
<div>
    <table class="table" style="margin-top: 6px;">
        <thead>
            <tr>
                <th>STT</th>
                <th> Môn học </th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @if($monhoc->count())
            @foreach($monhoc as $i =>$mh )
            <tr>
                <input type="hidden" class="serdelete_val_id" value="{{$mh->id}}">
                <td>
                    <a class="btn btn-default btn-circle">{{$i+1}}</a>
                </td>
                <td>
                    {{$mh->tenmonhoc}}<br>
                    <i>{{$mh->ghichu}}</i><br>
                    <i><a class="btn btn-primary px-4 float-right" href="{{route('qlsv_worktask.mon',$mh->id)}}">work task</a></i>
                </td>
                <td style="padding-left:0;line-height: 33px;">
                    <a class="btn-default btn-xs" href="{{route('qlsv_monhoc.edit',$mh->id)}}"">
                        <i class=" glyphicon glyphicon-pencil"></i></a>
                    <a class="btn-default btn-xs servicedeletebtn" href="{{route('qlsv_monhoc.destroy',$mh->id)}}">
                        <i class="glyphicon glyphicon-trash"></i></a>
                </td>

            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    <div class="text-center">
        {{ $monhoc->links() }}
    </div>

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

                    const message1 = JSON.parse(result)
                    alert(message1._typeMessage);
                    if (message1._typeMessage == "deleteSuccess") {
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