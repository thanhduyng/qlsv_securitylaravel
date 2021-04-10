@extends('layouts.trangchu')

@section('content')

<div style="text-align:right;padding: 4px; margin-right: 10px;">
    <a style="margin-top: 5px;" class="btn btn-primary btn-sm" href="<?= route("quan_tri.trangchu") ?>">
        <i class="glyphicon glyphicon-list-alt"></i></a>
</div>

<div>
    <form action="<?= route("quan_tri.searchdanhgia") ?>" method="get">
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
                        <th class="andi" style="height: 13px; width: 15%;">Tên lớp học</th>
                        <th class="" style="height: 13px; width: 10%;">Tên SV</th>
                        <th class="andi" style="height: 13px; width: 10%;">Môn học</th>
                        <th class="" style="height: 13px;">Tiêu đề</th>
                        <th class="andi" style="height: 13px;">Câu hỏi</th>
                        <th style="height: 13px; width: 30%;">Câu trả lời</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($danhGia as $values)
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
                        <td class="andi">
                            <i><?php echo \App\qlsv_monhoc::find($values->id_monhoc)->tenmonhoc ?></i>
                        </td>
                        <td class="">{{$values->tieude}}</td>
                        <td class="andi">{{$values->cauhoi}}</td>
                        <td>{{$values->cautraloi}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-center">
                {{ $danhGia->appends(['sort' => 'id'])->links() }}
            </div>
        </form>
    </main>
</div>
@endsection