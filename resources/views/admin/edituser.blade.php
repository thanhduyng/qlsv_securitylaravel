@extends('layouts.trangchu')

@section('content')

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
    <style>
        .dropdown-menu {
            background-color: #ccc;
        }

        @media (max-width: 880px) {
            .footer-distributed {
                position: fixed;
                bottom: 0px;
            }
        }
    </style>
</head>
<div style="text-align:right;padding: 4px;">
    <a class="btn btn-primary btn-sm" style="margin-right: 15px; margin-top: 5px;" href="<?= route("user.index") ?>">
        <i class="glyphicon glyphicon-list-alt"></i></a>
</div>
<div class="container">
    <form method="post" action="{{ route('user.update',[$users->id])}} ">
        @csrf
        <div class="form-group">
            <input class="form-control" type="hidden" name="id" value="{{$users->id}}" />
        </div>
        <div class="form-group">
            <label>Tên </label>
            <input class="form-control" type="text" name="name" value="{{$users->name}}" />
        </div>
        <div class="form-group">
            <label>Email</label>
            <input class="form-control" type="text" name="email" value="{{$users->email}}" />
        </div>
        <div class="form-group">
            <label>Nhóm</label>
            <select class="form-control" id="edit-nhom" name="nhoms[]" multiple="mutiple">
                @foreach($nhoms as $nd => $value)
                <option value="{{$nd}}">{{$value}}</option>
                <option value="{{$nd}}" {{($nd == $lopHoc->id_giangvien) ? 'selected' : ''}}>{{$value}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Tên vai trò</label>
            <select class="form-control" id="edit-user" name="vaitros[]" multiple="mutiple">
                @foreach($qlsv_vaitros as $qlsv_vaitro)
                <option {{$listRowOfUser->contains($qlsv_vaitro->id)?'selected':''}} value="{{$qlsv_vaitro->id}}">{{$qlsv_vaitro->ten}}</option>
                @endforeach
            </select>
        </div>

        <button style="margin-bottom: 5px; margin-top: 5px;" type="submit" class="btn btn-primary px-4 float-right"><i class="glyphicon glyphicon-floppy-disk"></i> Lưu</button>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('#edit-user').multiselect({
            nonSelectedText: '-- Chọn vai trò --',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '291px'
        });
        $('#edit-nhom').multiselect({
            nonSelectedText: '-- Chọn nhóm --',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth: '291px'
        });
    });
</script>
@endsection