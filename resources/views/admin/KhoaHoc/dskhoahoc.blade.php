@extends('layouts.trangchu')

@section('content')
<div style="text-align:right;padding-top: 7px; padding-bottom: 5px;">
    <a class="btn btn-primary btn-sm" href="#" onclick="$('#searcharea').toggle();return false;">
        <i class="glyphicon glyphicon-search"></i></a>
    <a class="btn btn-success btn-sm" href="<?= route("qlsv_khoahoc.create") ?>">
        <i class="glyphicon glyphicon-plus"></i></a>
</div>
<div id="searcharea" style="display:none; margin-top: 15px;">
    <form action="<?= route("qlsv_khoahoc.index") ?>" method="get">
        <div class="form-group row">
            <div class="col-sm-4 col-xs-7" style="margin-left: 30px;">
                <input style="width: 220px; margin-left: -2px; margin-top: -1px;" id="" class="form-control" type="text" value="{{$search}}" name="search" placeholder="nhập tên khoá">
            </div>
            <div class="col-sm-4 col-xs-3">
                <button style="margin-left: 14px;" type="submit" class="btn btn-primary btn-sm">Tìm kiếm</button>
            </div>
        </div>
    </form>
</div>

@if(Session::has('message'))
<div class="alert alert-success text-center" role="alert">
    <strong></strong> {{Session::get('message')}}
</div>
@endif
<form method=get action="<?= route("qlsv_khoahoc.index") ?>">
    <table>
        <thead class="andi">
            <tr>
                <th>STT</th>
                <th class="width">Nội dung</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @if($khoaHoc->count())
            @foreach($khoaHoc as $i =>$cl )
            <tr>
                <td>
                    <a class="btn btn-default btn-circle">{{$i+1}}</a>
                </td>
                <input type="hidden" class="serdelete_val_id" value="{{$cl->id}}" />
                <td class="width">
                    <i style="margin-left: 25px;">{{$cl->tenkhoahoc}}</i><br>
                    <i style="margin-left: 25px;">số lượng sinh viên: {{$cl->soluongsv}}</i><br>
                    <i style="margin-left: 25px;">số lượng lớp: {{$cl->soluonglop}}</i><br>
                    <i style="margin-left: 25px;">{{$cl->ghichu}}</i><br>
                </td>

                <td style="padding-left:0;line-height: 33px;">
                    <a class="btn-default btn-xs" href="edit/{{$cl->id}}">
                        <i class="glyphicon glyphicon-pencil"></i></a>
                    <a class="btn-default btn-xs servideletebtn" href="delete/{{$cl->id}}">
                        <i class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    <div class="text-center">
        {{ $khoaHoc->appends(['sort' => 'id'])->links() }}
    </div>
</form>
<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.servideletebtn').click(function(e) {
            e.preventDefault();

            var delete_id = $(this).closest("tr").find('.serdelete_val_id').val();
            // alert(delete_id);    
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        var data = {
                            "_token": $('input[name="csrf-token"]').val(),
                            "id": delete_id,
                        };
                        $.ajax({
                            type: "DELETE",
                            url: 'khoahoc/delete_id/' + delete_id,
                            data: data,
                            dataType: "dataType",
                            success: function(response) {
                                swal(response.status, {
                                        icon: "success",
                                    })
                                    .then((willDelete) => {
                                        location.reload();
                                    });
                            }
                        });


                    }
                });
        });
    });
</script>
@endsection