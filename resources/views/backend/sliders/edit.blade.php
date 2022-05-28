@extends('backend.layout.master')
@section('title','Cập nhật slider')
@push('script')
@endpush
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="pjax-container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h4>
                Chỉnh sửa hình ảnh
            </h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
                <li>Hình ảnh</li>
                <li><a href="{{ route('backend.slider.index') }}">Quản lý Slider</a></li>
                <li class="active">Sửa</li>
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
            <form method="POST" action="{{ route('backend.slider.update', $slider->id) }}" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}
                <div class="row">
                    <div class="col-md-9">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Tiêu đề ({{ $lang }})</label>
                                    <input type="text" name="translation[name]"
                                        value="@if (isset($slider->translations->name)){{ old('translation[name]', $slider->translations->name) }}@else{{ old('translation[name]') }} @endif"
                                        class="form-control" data-toggle="tooltip" data-placement="top"
                                        title="Nhập tiêu đề hình ảnh ">
                                </div>
                                <div class="form-group">
                                    <label>Nội dung ({{ $lang }})</label>
                                    <input type="text" name="translation[content]"
                                        value="@if (isset($slider->translations->content)){{ old('translation[content]', $slider->translations->content) }}@else{{ old('translation[content]') }} @endif"
                                        class="form-control" data-toggle="tooltip" data-placement="top"
                                        title="Nhập tiêu đề hình ảnh (VI)">
                                </div>
                                <div class="form-group">
                                    <label>Link liên kết</label>
                                    <input type="text" name="url" id="url"
                                        value="@if (isset($slider->url)) {{ old('url', $slider->url) }}@else{{ old('url') }} @endif"
                                        class="form-control" data-toggle="tooltip" data-placement="top"
                                        title="Nhập Link liên kết">
                                </div>
                                <div class="form-group">
                                    <label>Hình ảnh</label>
                                    <input type="file" name="img" class="form-control" value="{{ $slider->img }}"
                                        data-toggle="tooltip" data-placement="top" title="Dimensions min 1440 x 520 (px)">
                                    <img class="img-thumbnail mb-2" style="max-width: 100px; margin-top:10px;"
                                        src="{{ asset('storage') }}/uploads/slides/{{ $slider->img }}"
                                        alt="{{ $slider->name }}">
                                </div>
                                <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                                <a href="{{ route('backend.newcatone.index') }}" class="btn btn-danger"><i
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
                        @if ($language->count() > 1)
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <label>Ngôn ngữ</label>
                                    <input hidden type="text" name="changelang" id="inputchange">
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <ul id="changelanguage">
                                            @foreach ($language as $lang)
                                                <li>
                                                    <span class="changelanguage  change-confirm"
                                                        id="{{ $lang->locale }}"> <i class="{{ $lang->flag }}"></i>
                                                        {{ $lang->name }} <i class="fas fa-external-link-alt"></i></span>
                                                </li>
                                                <br>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <label>Số thứ tự</label>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <input type="number" name="stt" id="stt"
                                        value="@if (isset($slider->stt)){{ old('stt', $slider->stt) }}@else{{ old('stt') }} @endif"
                                        class="form-control stt" data-toggle="tooltip" data-placement="top"
                                        title="Nhập số thứ tự">
                                </div>
                            </div>
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <label>
                                    <input type="checkbox" name="hide_show" id="hide_show" value="1"
                                        {{ $slider->hide_show == 1 ? 'checked' : '' }} class="cbc"><label
                                        class="cbc">Hiển thị</label>
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
