@extends('layouts.trangchu')

@section('content')

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />

</head>
<div style="text-align:right;background-color:#ddd;padding: 4px;">
    <a class="btn btn-primary btn-sm" href="<?= route("qlsv_diemdanh.index") ?>">
        <i class="glyphicon glyphicon-list-alt"></i></a>
</div>
<div class="container-fluid py-5">
    <div class="row" style="background-color:#ddd; padding: 20px; padding-bottom: 50px;">
        <div class="col-md-10 mx-auto">
            <form method="post" action="{{route('qlsv_diemdanh.store')}}">
                @csrf

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="">Ngày điểm danh</label>
                        <input type="date" class="form-control" name="ngaydiemdanh" value="<?php echo date('Y-m-d') ?>">
                    </div>
                    <div class="col-sm-6">
                        <label>Lớp học:</label>
                        <select name="lophocs" class="form-control">
                            <option value="">---</option>
                            @foreach($lopHoc as $lh)
                            <option value="{{ $lh->id }}">{{ $lh->tenlophoc }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">

                    <div class="col-sm-6">
                        <label>Chọn sinh viên:</label>
                        <select name="sinhviens[]" multiple class="form-control">
                        </select>
                    </div>

                    <!-- <div class="col-sm-6">
                        <label>Sinh viên</label><br>
                        <select id="sinhvien" name="sinhviens[]" multiple class="form-control">
                            @foreach($sinhVien as $nd => $value)
                            <option value="{{$nd}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div> -->

                    {{--<!-- <div class=" form-group col-md-12">
                        <label>Sinh Viên: </label>
                        <div class="form-check">
                            @foreach($sinhVien as $sinhvien)
                            <div style="float: left; width: 25%;" class="float-left mt-5" style="width: 25%">
                                <input type="checkbox" class="form-check-input mr-1" name="sinhvien[]" value="{{$sinhvien->id}}">
                                <label class="form-check-label">{{$sinhvien->hovaten}}</label>
                            </div>
                            @endforeach</div>
                    </div> -->--}}

                   

                        <div class="col-sm-6 ">
                            <label for="">Đến lớp</label>
                            <select name="denlop" class="form-control">
                                <option value="1">Có</option>
                                <option value="2">Không</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 ">
                            <label for="">Kiến thức</label>
                            <select name="kienthuc" class="form-control">
                                <option value="1">Y</option>
                                <option value="2">N</option>
                            </select>
                        </div>
                        <div class="col-sm-6 ">
                            <label for="">Thực hành</label>
                            <select name="thuchanh" class="form-control">
                                <option value="1">Y</option>
                                <option value="2">N</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 ">
                            <label for="">Ghi chú</label>
                            <textarea type="text" class="form-control" rows="2" name="ghichu" value=""></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success px-4 float-right"><i class="glyphicon glyphicon-plus"></i> Thêm mới</button>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    var url = "{{ url('/showCitiesInCountry') }}";
    $("select[name='lophocs']").change(function() {
        var id_lophoc = $(this).val();
        var token = $("input[name='_token']").val();
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                id_lophoc: id_lophoc,
                _token: token
            },
            success: function(data) {
                $("select[name='sinhviens[]'").html('');
                $.each(data, function(key, value) {
                    $("select[name='sinhviens[]']").append(
                        "<option value=" + value.id + ">" + value.hovaten + "</option>"
                    );
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#sinhvien').multiselect({
            nonSelectedText: 'Sinh viên',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '340px'
        });
    });
</script>

@endsection