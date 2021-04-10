@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" style="font-size: 20px; text-align: center; height: 60px;margin-top: 30px;">
               @if($giangVien==1)
                <div class="card" style="background-color: #ddd;">
                    <a class="card-header" href="{{route('giang_vien.trangchu')}}">{{ __('Giảng Viên') }}</a>
                </div>
                @endif
                @if($sinhVien==1)
                <div class="card" style="margin-top: 15px;background-color: #ddd;">
                    <a class="card-header" href="{{route('sinh_vien.trangchu')}}">{{ __('Sinh Viên') }}</a>
                </div>
                @endif
                @if($phongDaoTao==1)
                <div class="card" style="margin-top: 15px;background-color: #ddd;">
                    <a class="card-header" href="{{route('quan_tri.trangchu')}}">{{ __('Phòng Đào Tạo') }}</a>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection