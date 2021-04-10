@extends('layouts.trangchu')

@section('content')

<div style="text-align:right;padding: 4px; margin-right: 10px;">
    <a style="margin-top: 5px;" class="btn btn-primary btn-sm" href="<?= route("quan_tri.trangchu") ?>">
        <i class="glyphicon glyphicon-list-alt"></i></a>
</div>

<div>
    <form action="<?= route("quan_tri.searchdiemthi") ?>" method="get">
        <div style="text-align:right;padding-top: 20px">
            <div class="form-group">
                <div class="col-xs-5" style="margin-bottom: 5px;">
                    <select name="searchlop" class="form-control" style="width: 320px;">
                        <option value="">-- Chọn Lớp --</option>
                        @foreach($lopHoc as $nd => $value)
                        <option value="{{$nd}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-2">
                    <button style="margin-left: 177px;" type="submit" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
        </div>
    </form>
    <main style="margin-bottom: 20px;">
        <h1></h1><br>
        <form method="post">
            <table style="width: 93%; margin-left: 15px; ">
                <?php $stt = 1 ?>
                <thead>
                    <tr>
                        <th style="height: 13px;">STT</th>
                        <th class="andi" style="height: 13px; width: 25%;">Tên lớp học</th>
                        <th class="width" style="height: 13px;">Tên sinh viên</th>
                        <th style="height: 13px; width: 15%;">LT</th>
                        <th style="height: 13px; width: 15%;">TH</th>
                        <th class="andi" style="height: 13px; width: 15%;">Ngày cho điểm</th>
                        <th class="andi" style="height: 13px;">Ghi chú GV</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($diemThi as $values)
                    <tr>
                        <td>
                            <?= $stt++ ?>
                        </td>
                        <td class="andi">
                            <i><?php echo \App\qlsv_lophoc::find($values->id_lophoc)->tenlophoc ?></i>
                        </td>
                        <td>
                            <i><?php echo \App\qlsv_sinhvien::find($values->id_sinhvien)->hovaten ?></i>
                        </td>

                        <td>{{$values->diemlythuyet}}</td>
                        <td>{{$values->diemthuchanh}}</td>
                        <td class="andi">{{ date('d-m-Y', strtotime($values->ngaychodiem))}}</td>
                        <td class="andi">{{$values->ghichu}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </main>
</div>
<script>
    $(function() {
        $('input').focus(function() {
            $(this).select();
        });
    });
</script>
@endsection