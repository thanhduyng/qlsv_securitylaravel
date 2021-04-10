@extends('layouts.layout')

@section('content')
<main style=" margin-bottom: 200px;">
    <form action="" method="post" >
        @csrf
        <div class="form-group row" >
            <label style="margin-left: 20px; font-size: 15px; margin-top: 42px;" class="col-sm-2 col-xs-2">Lớp:</label>
            <div class="col-sm-10" style="width: 75%; float: left; margin-left: -15px;">
                <p style="margin-left: 10px;font-size: 15px; font-weight: bold;margin-top: 42px;">{{$qlsv_lophoc->tenlophoc}}
                    <input type="hidden" name="idlop" value="{{$qlsv_lophoc->id}}">
                </p>
            </div>
        </div>
        <table style="width: 93%; margin-left: 15px; margin-bottom: 10px; ">
            <?php $stt = 1 ?>
            <thead>
                <tr>
                    <th style="height: 13px;">STT</th>
                    <th style="height: 13px; width: 40%;">Ngày học</th>
                    <th style="height: 13px; width: 40%;">Đến lớp</th>
                </tr>
            </thead>
            <tbody>
                @foreach($qlsv_sinhvienlophoc as $values)
                <tr>

                    <td>
                        <?= $stt++ ?>
                    </td>
                    <td>
                        <p>{{$values->ngayhoc}}</p>
                    </td>
                    <td class="form-group">
                        <select disabled name="denlop" class="form-control">
                            <option value="1" {{$values->denlop == 1 ? 'selected' : '' }} name="denlop">C</option>
                            <option value="2" {{$values->denlop == 2 ? 'selected' : ''}} name="denlop">K</option>
                            <option value="3" {{$values->denlop == 3 ? 'selected' : ''}} name="denlop">P</option>

                        </select>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @foreach($vang as $values)
        <a style="color: black; margin-left: 260px; font-size: 16px; font-weight: bold;">Số buổi vắng:</a><a style="color: gray; font-weight: bold; font-size: 18px;"> {{$values->vang}}</a>
        @endforeach
    </form>
</main>
<!-- end content -->
@endsection