@extends('layouts.trangchu')

@section('content')
        <div class="container"><br>
            <form method="post" action="{{ route('qlsv_chucnang.update', [$chucNang->id]) }} ">
                @csrf
                <div iv class="form-group">

                    <input type="hidden" class="form-control" value="{{ $chucNang->id }}" name="id">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Mã chức năng:</label>
                    <input type="text" class="form-control" name="ma" value="{{ $chucNang->ma }}"
                        placeholder="nhập mã chức năng">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Tên chức năng:</label>
                    <input type="text" class="form-control" name="ten" value="{{ $chucNang->ten }}"
                        placeholder="nhập tên chức năng">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">URL:</label>
                    <input type="text" class="form-control" value="{{ $chucNang->url }}"
                        name="url" placeholder="nhập url">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">id-cha:</label>
                    <input type="text" class="form-control" value="{{ $chucNang->id_cha}}"
                        name="id_cha" placeholder="nhập số id_cha">
                </div>
                <input class="btn btn-primary" type="submit" value="Sửa" />
            </form>
        </div>
    </body>
@endsection
