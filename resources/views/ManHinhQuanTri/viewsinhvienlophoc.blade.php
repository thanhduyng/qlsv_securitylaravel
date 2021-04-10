@extends('layouts.trangchu')

@section('content')

<main style="margin-bottom: 20px;">
    <h1></h1><br>
    <form action="" method="post">
        <div class="form-group row">
            <label style="margin-left: 20px; margin-top: 20px; font-size: 15px;" class="col-sm-2 col-xs-2">Lớp:</label>
            <div class="col-sm-10" style="width: 75%; float: left; margin-left: -15px;margin-top: 20px; font-size: 15px; font-weight: bold;">
                <p>{{$qlsv_lophoc->tenlophoc}}</p>
            </div>
        </div>
        <table style="width: 93%; margin-left: 15px; ">
            <?php $stt = 1 ?>
            <thead>
                <tr>
                    <th style="height: 13px;">STT</th>
                    <th style="height: 13px; width: 85%;">Tên sinh viên</th>
                </tr>
            </thead>
            <tbody>
                @foreach($qlsv_sinhvienlophoc as $values)
                <tr>
                    <td>
                        <?= $stt++ ?>
                    </td>
                    <td>
                        <i><?php echo \App\qlsv_sinhvien::find($values->id_sinhvien)->hovaten ?></i>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>
</main>
@endsection