@extends('layouts.trangchu')

@section('content')
<div style="text-align:right;padding-top: 7px; padding-bottom: 5px;">
    <a class="btn btn-primary btn-sm" href="#" onclick="$('#searcharea').toggle();return false;">
        <i class="glyphicon glyphicon-search"></i></a>
    <a class="btn btn-success btn-sm" href="<?= route("qlsv_tudanhgia.create") ?>">
        <i class="glyphicon glyphicon-plus"></i></a>
</div>

<div id="searcharea" style="display:none; margin-top: 15px;">
    <form action="<?= route("qlsv_tudanhgia.index") ?>" method="get" class="form-inline pull-">
        <div class="form-group row">
            <div class="col-sm-4 col-xs-7" style="margin-left: 30px;">
                <label>Môn học</label>
                <select name="search" class="form-control">
                    <option value="">--Chọn môn học--</option>
                    @foreach($qlsv_monhoc as $i =>$cl )
                    <option value="{{$i}}">{{$cl}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4 col-xs-3">
                <button style="margin-left: 14px;margin-top: 30px;" type="submit" class="btn btn-primary btn-sm">Tìm kiếm</button>
            </div>
        </div>
    </form>
</div>
<table>
    <thead class="andi">
        <tr>
            <th>STT</th>
            <th>Tên môn học</th>
            <th>Tiêu đề</th>
            <!-- <th>Câu hỏi</th>
            <th>Thứ tự</th>
            <th>Số lượng câu hỏi trả lời</th>-->
            <th>Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @if($qlsv_tudanhgia->count())
        @foreach($qlsv_tudanhgia as $i =>$cl )
        <tr style="height: 75px;">
            <td>
                <a class="btn btn-default btn-circle">{{$i+1}}</a>
            </td>
            <td width="25%">
                <i style="margin-left: 20px;"> {{$qlsv_monhoc[$cl->id_monhoc] ?? " "}}</i><br>
            </td>
            <td width="48%">
                <i>{{$cl->tieude}}</i><br>
            </td>
            <td style="padding-left:0;line-height: 33px;">
                <a class="btn-default btn-xs" href="edit/{{$cl->id}}">
                    <i class="glyphicon glyphicon-pencil"></i></a>
                <a class="btn-default btn-xs" href="delete/{{$cl->id}}">
                    <i class="glyphicon glyphicon-trash"></i></a>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('.servicedeletebtn').click(async function(e) {
            e.preventDefault();
            var delete_id = $(this).closest("tr").find('.serdelete_val_id').val();
            const isDelete = await swal(_swalConfig.deleteConfirm)
            if (!isDelete) return
            $.ajax(this.href)
                .done((resp) => {
                    $(this).closest('tr').remove()
                });
        })
    });
</script>
@endsection