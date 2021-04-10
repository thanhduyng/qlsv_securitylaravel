@extends('layouts.trangchu')

@section('content')
    <div style="text-align:right;background-color:#ddd;padding: 4px;">
        <a class="btn btn-primary btn-sm" href="<?= route('qlsv_chucnang.index') ?>">
            <i class="glyphicon glyphicon-list-alt"></i></a>
    </div>
    <body>
        <div class="container-fuild py-5" style="margin-top: 0px; margin-bottom: 1px;">
            <div class="row" style="background-color:#ddd; padding: 40px; padding-bottom: 80px;">
                <div class="col-md-10 mx-auto">
                    <form method="post" action="{{ route('qlsv_chucnang.store') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="">Mã chức năng</label>
                                <input type="text" class="form-control" id="" name="ma" placeholder="nhập mã chức năng" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="">Tên chức năng</label>
                                <input type="text" class="form-control" id="" name="ten" placeholder="tên chức năng" />
                            </div>
                            <div class="col-sm-6">
                                <label for="">URL</label>
                                <input type="text" class="form-control" id="" name="url" placeholder="nhập url" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="">id_cha</label>
                                <input type="text" class="form-control" id="" name="id_cha" placeholder="nhập số id_cha" />
                            </div>
                        </div>
                      
                        <button type="submit" class="btn btn-success px-4 float-right"><i class="glyphicon glyphicon-plus"></i> Thêm
                            mới</button>
                </div>

            </div>
            </form>
        </div>
        </div>
        </div>
        </div>
    @endsection
