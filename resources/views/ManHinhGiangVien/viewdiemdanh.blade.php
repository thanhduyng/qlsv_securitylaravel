@extends('layouts.layout')

@section('content')
<main style="padding-top: 0px; margin-top: 70px; margin-bottom: 200px;">
    <form action="{{route('giang_vien.storediemdanh')}}" method="post">
        @csrf
        <div class="form-group row">
            <label style="margin-left: 20px; margin-top: 42px; font-size: 15px;" class="col-sm-2 col-xs-2">Lớp:</label>
            <div class="col-sm-10" style="width: 75%; float: left; margin-left: -15px;">
                <p style="margin-left: 10px;margin-top: 42px; font-size: 15px; font-weight: bold;">{{$qlsv_lophoc->tenlophoc}}
                    <input type="hidden" name="idlop" value="{{$qlsv_lophoc->id}}">
                </p>
            </div>
        </div>

        <div class="form-group row">
            <label style="margin-left: 20px;" class="col-sm-2 col-xs-2">Ngày:</label>
            <div class="col-sm-10" style="width: 59%; float: left; margin-left: -5px;">
                <select name="ngayhoc" class="form-control" onchange="document.location.href='{{route('giang_vien.viewdiemdanh')}}?id_lophoc={{$qlsv_lophoc->id}}&id_thoikhoabieu='+this.value;">
                    @foreach($thoiKhoaBieu as $nd => $value)
                    <option value="{{$nd}}" {{$nd==$id_thoikhoabieu? 'selected' : ''}}>{{$value}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <table style="width: 93%; margin-left: 15px; ">
            <thead>
                <tr>
                    <th style="height: 13px;">STT</th>
                    <th style="height: 13px; width: 50%;">Tên sinh viên</th>
                    <th style="height: 13px; width: 35%;">ĐD</th>
                    <th style="height: 13px; ">KT</th>
                    <th style="height: 13px;">TH</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                @foreach($qlsv_sinhvienlophoc as $values)
                <tr>
                    <td>
                        {{$i++}}
                        <input type="hidden" name="id_sinhvienlophoc[]" value="{{$values->id_svlh}}">
                    </td>
                    <td>{{$values->hovaten}}</td>
                    <td> <select name="{{$values->id_svlh}}_denlop" class="form-control" style="margin-left: -5px;">
                            <option value="1" {{$values->denlop==1? 'selected' : ''}}>C</option>
                            <option value="2" {{$values->denlop==2? 'selected' : ''}}>K</option>
                            <option value="3" {{$values->denlop==3? 'selected' : ''}}>P</option>

                        </select></td>
                    <td><input class="form-check-input" type="checkbox" {{$values->kienthuc==1? 'checked' : ''}} name="{{$values->id_svlh}}_kienthuc" value="1" /></td>
                    <td><input class="form-check-input" type="checkbox" {{$values->thuchanh==1? 'checked' : ''}} name="{{$values->id_svlh}}_thuchanh" value="1" /></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if($isSubmit==0)
        <button type="submit" style="margin-left: 15px; margin-top: 8px;" class="btn btn-primary px-4 float-right"><i class="glyphicon glyphicon-floppy-disk"></i> Lưu</button>
        @endif
    </form>
</main>
<!-- end content -->
@endsection