@extends('backend.layout.master')
@section('title','Thêm mơi slider')
@push('script')
@endpush
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="pjax-container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h4>
                Thêm mới Slider
            </h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
                <li>Hình ảnh</li>
                <li><a href="{{ route('backend.slider.index') }}">Quản lý Sliders</a></li>
                <li class="active">Thêm</li>
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
            <form id="stringLengthForm" method="POST" action="{{ route('backend.slider.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-9">
                        <input type="hidden" id="type" name="type" value="slider">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                @foreach ($language as $lang)
                                    <li class="{{ $loop->first ? 'active' : '' }}"><a href="#tab_{{ $lang->locale }}"
                                            data-toggle="tab">
                                            <span class="{{ $lang->flag }}"></span> {{ $lang->name }}</a></li>
                                @endforeach
                                <li class="pull-right"><a href="#" class="text-muted"><i
                                            class="fa fa-gear"></i></a></li>
                            </ul>
                            <div class="tab-content">
                                @foreach($language  as $key => $lang)
                                <div class="tab-pane {{$loop->first ? 'in active' : ''}} tab-content-en" id="tab_{{$lang->locale}}">
                                    <div class="form-group">
                                        <label>Tiêu đề ({{ $lang->locale }})</label>
                                        <input type="text" name="translation[{{$key}}][name]" value="{{ old('translation['.$key.'][name]') }}"
                                            class="form-control" data-toggle="tooltip" data-placement="top"
                                            title="Nhập tiêu đề hình ảnh">
                                    </div>
                                    <div class="form-group">
                                        <label>Nội dung ngắn ({{ $lang->locale }})</label>
                                        <input type="text" name="translation[{{$key}}][content]" value="{{ old('translation['.$key.'][content]') }}"
                                            class="form-control" data-toggle="tooltip" data-placement="top"
                                            title="Mô tả ngắn">
                                    </div>

                                    <div hidden class="form-group">
                                        <label>Locale ({{$lang->locale}})</label>
                                        <input type="text" class="form-control" name="translation[{{$key}}][locale]" value="{{$lang->locale}}">
                                    </div>
                                    @if($loop->first)
                                    <div class="form-group">
                                                <div class="form-group">
                                                    <label>Link liên kết</label>
                                                    <input type="text" name="url" id="url" value="{{ old('url') }}"
                                                        class="form-control" data-toggle="tooltip" data-placement="top"
                                                        title="Nhập Link liên kết">
                                                </div>
                                                <div class="form-group">
                                                    <label>Hình ảnh</label>
                                                    <input type="file" name="img" class="form-control" data-toggle="tooltip"
                                                        data-placement="top" title="Dimensions min 1440 x 520 (px)">
                                                </div>
                                    </div>
                                    @endif
                                </div>
                                @endforeach
                                <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                                <a href="{{ route('backend.slider.index') }}" class="btn btn-danger"><i
                                    class="fa fa-times-circle"></i> Thoát</a>
                            </div>
                        </div>

                    </div>
                    <!-- left column -->
                    <!-- right column -->
                    <div class="col-md-3">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <label>Thao tác</label>
                            </div>
                            <div class="box-body">
                                <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                                <a href="{{ route('backend.slider.index') }}" class="btn btn-danger"><i
                                        class="fa fa-times-circle"></i> Thoát</a>
                            </div>
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <label>Số thứ tự</label>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <input type="number" name="stt" id="stt" value="1" min="0" class="form-control stt"
                                        data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự">
                                </div>
                            </div>
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <label>
                                    <input type="checkbox" name="hide_show" id="hide_show" value="1" class="cbc"
                                        checked="1">
                                    <label class="cbc">Hiển thị</label>
                                </label>
                            </div>
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <label>Thao tác</label>
                            </div>
                            <div class="box-body">
                                <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                                <a href="{{ route('backend.slider.index') }}" class="btn btn-danger"><i
                                        class="fa fa-times-circle"></i> Thoát</a>
                            </div>
                        </div>
                    </div>
                    <!-- right column -->
                </div>
        </section>
    </div>
    </form>

@endsection
