@extends('layouts.trangchu')

@section('content')
<div style="text-align:right;padding: 4px; margin-right: 10px;">
    <a style="margin-top: 5px;" class="btn btn-primary btn-sm" href="<?= route("qlsvlophoc.index") ?>">
        <i class="glyphicon glyphicon-list-alt"></i></a>
</div>
<form method="post" action="{{route('qlsvlophoc.store')}}">
    @csrf
    <input type="hidden" name="id" value="{{$id}}" />
    <div class="form-group">
        <div class="col-sm-6 col-xs-6">
            <label for="">Khoá</label>
            <select name="id_khoahoc" id="id_khoahoc" required class="form-control" onchange="taotenlop()">
                <option value="">--Chọn--</option>
                @foreach($khoaHoc as $nd => $value)
                <option value="{{$nd}}" {{($nd == $lopHoc->id_khoahoc) ? 'selected' : ''}}>{{$value}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-6 col-xs-6">
            <label for="">Môn</label>
            <select name="id_monhoc" id="id_monhoc" required class="form-control" onchange="taotenlop()">
                <option>--Chọn--</option>
                @foreach($monHoc as $nd => $value)
                <option value="{{$nd}}" {{($nd == $lopHoc->id_monhoc) ? 'selected' : ''}}>{{$value}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <br> <br> <br>
    <div class="form-group">
        <div class="col-sm-6 col-xs-6" style=""><label>Giảng viên</label>
            <select name="id_giangvien" required class="form-control" onchange="taotenlop()" id="id_giangvien">
                <option>--Chọn--</option>
                @foreach($giangVien as $nd => $value)
                <option value="{{$nd}}" {{($nd == $lopHoc->id_giangvien) ? 'selected' : ''}}>{{$value}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-6 col-xs-6">
            <label for="">Tên Lớp</label>
            <input type="text" class="form-control" id="tenlophoc" name="tenlophoc" value="{{$lopHoc->tenlophoc}}" placeholder="nhập tên lớp học" />
        </div>
    </div>

    <div style="text-align:right;padding-top: 80px;">
        <div class="form-group">
            <div class="col-xs-9">
                <a style="color: black; font-size: 20px; margin-right: 0px; float: left;">Danh sách sinh viên</a> <a class="btn-default btn-xs" href=""></a>
            </div>
            <div class="col-xs-3">
                <a class="btn btn-success btn-sm" onclick="$('#addsv').toggle();return false;">
                    <i class="glyphicon glyphicon-plus"></i></a>
            </div>
        </div>
    </div>
    <!-- Danh sách sinh viên -->

    <table style="width: 93%; margin-left: 15px;">
        <thead>
            <tr>
                <th style="height: 13px;">STT</th>
                <th style="height: 13px; width: 65%;">Tên sinh viên</th>
            </tr>
        </thead>
        <tbody class="sinhvien_duocchon">
            @php
            $stt = 1;
            @endphp
            @foreach($sinhVienLopHoc as $key=>$value)
            <tr>
                <td class=stt><span class=stt>{{$stt++}}</span>
                    <input type=hidden name=id_sinhvien[] class=id_sinhvien value="{{$key}}">
                </td>
                <td class=hovaten>{{$value}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- end danh sách sinh viên -->

    <button style="margin-left: 15px; margin-top: 4px;" type="submit" class="btn btn-primary px-4 float-right"><i class="glyphicon glyphicon-floppy-disk"></i> Lưu</button>
</form><br>

<div id="addsv" style="display: none;">
    <form action="<?= route("qlsvlophoc.search") ?>" method="get">
        <div style="text-align:right;padding-top: 20px">
            <div class="form-group">
                <div class="col-xs-5" style="margin-bottom: 5px;">
                    <select name="searchkh" class="form-control">
                        <option value="">-- Khoá --</option>
                        @foreach($khoaHoc as $nd => $value)
                        <option value="{{$nd}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-xs-5">
                    <input style="width: 190px; margin-left: -13px; margin-top: -1px;" id="" class="form-control" type="text" value="{{$search}}" name="search" placeholder="nhập tên sinh viên">
                </div>
                <div class="col-xs-2">
                    <button style="margin-left: 9px;" type="submit" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
        </div>
    </form>

    <table style="width: 93%; margin-left: 15px; margin-top: -6px;">
        <thead>
            <tr>
                <th style="height: 13px;">STT</th>
                <th style="height: 13px; width: 15%;">Khoá</th>
                <th style="height: 13px; width: 55%;">Tên sinh viên</th>
                <th style="height: 13px;">Chức năng</th>

            </tr>
        </thead>
        <tbody>
            @if($sinhVien->count())
            @foreach($sinhVien as $i =>$cl )

            @php
            if(isset($sinhVienLopHoc[$cl->id])){
            continue;
            }
            @endphp
            <tr>
                <td>{{$i+1}}</td>
                <td><?php echo \App\qlsv_khoahoc::find($cl->id_khoahoc)->tenkhoahoc ?></td>
                <td>{{$cl->hovaten}}</td>
                <td style="padding-left:0;line-height: 33px;" class="add-row">
                    <input type="hidden" class="id_sinhvien" value="{{$cl->id}}">
                    <input type="hidden" class="tensinhvien" value="{{$cl->hovaten}}">
                    <a onclick="addSinhVien(this)" class="btn btn-success btn-sm" style="margin-left:8px;">
                        <i class="glyphicon glyphicon-plus"></i></a>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div><br>
<script>
    function addSinhVien(a) {
        var p = $($(a).parent());
        var id = p.find(".id_sinhvien").val();
        var hoten = p.find(".tensinhvien").val();
        var trnew = $("<tr><td class=stt><span class=stt></span><input type=hidden name=id_sinhvien[] class=id_sinhvien></td><td class=hovaten></td></tr>");
        trnew.find(".id_sinhvien").val(id);
        trnew.find("td.stt>span.stt").text("1");
        trnew.find(".hovaten").text(hoten);
        $("table>tbody.sinhvien_duocchon").append(trnew);
        var stts = $("table>tbody.sinhvien_duocchon").find("td.stt>span.stt");
        for (var i = 0; i < stts.length; i++) {
            $(stts[i]).text(i + 1);
        }
        p.parent().empty();
    }

    function taotenlop() {
        var tengiangvien = $("#id_giangvien option:selected").text();
        var tenmonhoc = $("#id_monhoc option:selected").text();
        var tenkhoahoc = $("#id_khoahoc option:selected").text();
        $('#tenlophoc').val(tenkhoahoc + ' - ' + tenmonhoc + ' - ' + tengiangvien);
    }
</script>
@endsection