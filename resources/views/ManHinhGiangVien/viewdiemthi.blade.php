@extends('layouts.layout')

@section('content')

<main style="padding-top: 0px; margin-top: 70px; margin-bottom: 200px;">
    <!-- @yield('content') -->
    <h1></h1><br>
    <form action="{{route('giang_vien.storediemthi')}}" method="post">
        @csrf
        <div class="form-group row">
            <label style="margin-left: 20px; font-size: 15px;" class="col-sm-2 col-xs-2">Lớp:</label>
            <div class="col-sm-10" style="width: 75%; float: left; margin-left: -15px; font-size: 15px; font-weight: bold;">
                <p>{{$qlsv_lophoc->tenlophoc}}
                    <input type="hidden" name="idlop" value="{{$qlsv_lophoc->id}}">
                </p>
            </div>
        </div>
        <table style="width: 93%; margin-left: 15px; ">
            <?php $stt = 1 ?>
            <thead>
                <tr>
                    <th style="height: 13px;">STT</th>
                    <th style="height: 13px; width: 50%;">Tên sinh viên</th>
                    <th style="height: 13px; width: 15%;">LT</th>
                    <th style="height: 13px; width: 15%;">TH</th>
                    <th style="height: 13px; width: 20%;">Ghi chú</th>

                </tr>
            </thead>
            <tbody>
                @foreach($qlsv_sinhvienlophoc as $values)
                <tr>

                    <td>
                        <?= $stt++ ?>
                        <input type="hidden" name="id_sinhvienlophoc[]" value="{{$values->id}}">
                    </td>
                    <td>{{$values->hovaten}}</td>
                    <td>
                        <input type="number" style="width:50px; text-align: right;" max="10" min="0" name="diemlythuyet[]"
                            value="{{$values->diemlythuyet}}">
                    </td>
                    <td>
                        <input type="number" style="width:50px; text-align: right;" max="10" min="0" name="diemthuchanh[]"
                            value="{{$values->diemthuchanh}}">
                    </td>
                    <td>
                        <input type="text" style="width:100%; text-align: right;"  name="ghichu[]" value="{{$values->ghichu}}">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button style="margin-left: 15px; margin-top: 8px;" type="submit" class="btn btn-primary px-4 float-right"> <i
                class="glyphicon glyphicon-floppy-disk"></i> Lưu</button>
    </form>


</main>
<script>
    $(function(){
        $('input').focus(function(){
            $(this).select();
        });
    });
</script>
@endsection