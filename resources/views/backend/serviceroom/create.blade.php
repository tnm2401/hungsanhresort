@extends('backend.layout.master')
@section('title', 'Thêm dịch vụ phòng')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="pjax-container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h4>
                THÊM DỊCH VỤ PHÒNG
            </h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
                <li><a>Quản lí phòng</a></li>
                <li><a href="{{ route('backend.serviceroom.index') }}">Dịch vụ phòng </a></li>
                <li class="active">Thêm mới</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" autocomplete="off" action="{{ route('backend.serviceroom.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Tên dịch vụ</label>
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Đơn vị tính</label>
                                        <input type="text" class="form-control" placeholder="ví dụ : Chai, thùng ,..." name="unit">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Hình ảnh</label>
                                        <input type="file" name="img" class="form-control" data-toggle="tooltip"
                                        oninput="pic.src=window.URL.createObjectURL(this.files[0])" data-placement="top"
                                        title="Dimensions min 370 x 250 (px)">
                                    <img style="margin-top:5px" width="100%" src="" id="pic" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Giá tiền</label>
                                        <input type="number" class="form-control" name="price">
                                    </div>
                                        <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                                        <a href="{{ route('backend.serviceroom.index') }}" class="btn btn-danger"><i
                                                class="fa fa-times-circle"></i> Thoát</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
        </section>
    </div>
    </form>
@endsection
@php
@endphp

