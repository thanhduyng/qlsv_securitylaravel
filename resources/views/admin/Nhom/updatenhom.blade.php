@extends('layouts.trangchu')

@section('content')
<div class="container"><br>
    <form method="post" action="{{ route('qlsv_nhom.update', [$nhom->id]) }} ">
        @csrf
        <div iv class="form-group">

            <input type="hidden" class="form-control" value="{{ $nhom->id }}" name="id">
        </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Mã nhóm:</label>
                    <input type="text" class="form-control" name="ma" value="{{ $nhom->ma }}"
                        placeholder="nhập mã nhóm">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Tên nhóm:</label>
                    <input type="text" class="form-control" name="ten" value="{{ $nhom->ten }}"
                        placeholder="nhập tên nhóm">
                </div>
                <input class="btn btn-primary" type="submit" value="Sửa" />
            </form>
        </div>
    </body>
@endsection
