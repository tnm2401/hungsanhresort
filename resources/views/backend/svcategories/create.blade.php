@extends('backend.layout.master')
@section('title','Thêm dịch vụ')
@push('script')
@foreach($language as $lang)

    <script>

$(document).ready(function() {
            CKEDITOR.replace('content_{{ $lang->locale }}', options);
        });

$(document).ready(function() {
            $("#name_{{ $lang->locale }}").keyup(function() {
                $("#title_{{ $lang->locale }}").val(this.value);
                $("#keywords_{{ $lang->locale }}").val(this.value);
                $("#des_{{ $lang->locale }}").val(this.value);
            });

            $(document).on('change', 'input#name_{{ $lang->locale }}', function() {
                var title1 = ($(this).val());
                $('div#title{{ $lang->locale }}').text(title1);

                var des{{ $lang->locale }} = ($(this).val());
                $('div#description{{ $lang->locale }}').text(des{{ $lang->locale }});

                var slug{{ $lang->locale }} = createslug($(this).val());
                $('div#slug{{ $lang->locale }}').text(window.location.hostname + '/' + slug{{ $lang->locale }} + '.html');
            });

            $(document).on('change', 'textarea#des_{{ $lang->locale }}', function() {
                var des{{ $lang->locale }} = ($(this).val());
                $('div#description{{ $lang->locale }}').text(des{{ $lang->locale }});
            });

            $(document).on('change', 'input#slug_{{ $lang->locale }}', function() {
                var slug{{ $lang->locale }} = createslug($(this).val());
                $('div#slug{{ $lang->locale }}').text(window.location.hostname + '/' + slug{{ $lang->locale }} + '.html');
            });
        });
        </script>
 @endforeach

<script>
        function createslug(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-') // Replace spaces with -
                .replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a')
                .replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e')
                .replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i')
                .replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o')
                .replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u')
                .replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y')
                .replace(/đ/gi, 'd')
                .replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '')
                .replace(/\-\-\-\-\-/gi, '-')
                .replace(/\-\-\-\-/gi, '-')
                .replace(/\-\-\-/gi, '-')
                .replace(/\-\-+/g, '-') // Replace multiple - with single -
                .replace(/^-+/, '') // Trim - from start of text
                .replace(/-+$/, ''); // Trim - from end of text
        }
    </script>
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="pjax-container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h4>
                THÊM DỊCH VỤ
            </h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
                <li><a href="{{ route('backend.svcategory.index') }}">Dịch vụ</a></li>
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
            <form method="POST" action="{{ route('backend.svcategory.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-9">
                        <div class="nav-tabs-custom">

                            <ul class="nav nav-tabs">
                                @foreach ($language  as $lang)
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
                                            <label>Tên dịch vụ ({{ $lang->locale }})</label>
                                            <input type="text" name="translation[{{$key}}][name]" id="name_{{ $lang->locale }}" onkeyup="AutoSlug();"
                                                value="{{ old('name_'.$lang->locale) }}" class="form-control" data-toggle="tooltip"
                                                data-placement="top" title="Nhập tên dịch vụ">
                                        </div>
                                        <div class="form-group">
                                            <label>Mô tả ngắn ({{ $lang->locale }})</label>
                                            <textarea class="form-control"
                                                name="translation[{{ $key }}][descriptions]"
                                                id="descriptions_{{ $lang->locale }}" data-length=320
                                                 value="{{ old('descriptions') }}"
                                                rows="3" data-toggle="tooltip" data-placement="top"
                                                title="Nhập mô tả ngắn sản phẩm">{{ old('descriptions') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Nội dung ({{ $lang->locale }})</label>
                                            <textarea class="form-control"
                                                name="translation[{{ $key }}][content]"
                                                id="content_{{ $lang->locale }}"
                                                rows="3">{!! old('content') !!}</textarea>
                                        </div>

                                    <div class="box-header with-border">
                                        <h3 class="box-title">Tối ưu hoá tìm kiếm (SEO)</h3>
                                    </div>
                                        <div class="form-group">
                                            <div class="url-seo" id="slug{{ $lang->locale }}"></div>
                                            <div class="title-seo" id="title{{ $lang->locale }}"></div>
                                            <div class="description-seo" id="description{{ $lang->locale }}"></div>
                                        </div>

                                        <div class="form-group">
                                            <label>URL danh mục ({{ $lang->locale }})</label>
                                            <input type="text" type="text" name="translation[{{$key}}][slug]" id="slug_{{ $lang->locale }}"
                                                value="{{ old('translation['.$key.'][slug]') }}" class="form-control" data-toggle="tooltip"
                                                data-placement="top" title="Nhập URL danh mục">

                                        </div>

                                        <div class="form-group">

                                            <label>Tiêu Đề ({{ $lang->locale }})</label>
                                            <input type="text" name="translation[{{$key}}][title]" id="title_{{ $lang->locale }}"
                                                value="{{ old('translation['.$key.'][title]') }}" class="form-control"
                                                data-toggle="tooltip" data-placement="top" title="Nhập tiêu đề danh mục">
                                        </div>
                                        <div class="form-group">
                                            <label>Từ khóa ({{ $lang->locale }})</label>
                                            <textarea class="form-control" name="translation[{{$key}}][keywords]" id="keywords_{{ $lang->locale }}"
                                                value="{{ old('translation['.$key.'][keywords]') }}" rows="3" data-toggle="tooltip"
                                                data-placement="top" title="Nhập từ khoá cho danh mục"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Mô tả ({{ $lang->locale }})</label>
                                            <textarea class="form-control" name="translation[{{$key}}][description]" id="des_{{ $lang->locale }}"
                                                value="{{ old('translation['.$key.'][description]') }}" rows="3" data-toggle="tooltip"
                                                data-placement="top" title="Nhập mô tả ngắn danh mục"></textarea>
                                        </div>
                                        <div hidden class="form-group">
                                            <label>Locale ({{$lang->locale}})</label>
                                            <input type="text" class="form-control" name="translation[{{$key}}][locale]" value="{{$lang->locale}}">
                                        </div>
                                </div>
                                @endforeach

                                <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                                <a href="{{ route('backend.svcategory.index') }}" class="btn btn-danger"><i
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
                                <a href="{{ route('backend.svcategory.index') }}" class="btn btn-danger"><i
                                        class="fa fa-times-circle"></i> Thoát</a>
                            </div>
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <label>Hình ảnh đại diện</label>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <input type="file" name="img" class="form-control" data-toggle="tooltip"
                                        oninput="pic.src=window.URL.createObjectURL(this.files[0])" data-placement="top"
                                        title="Dimensions min 370 x 250 (px)">
                                    <img style="margin-top:5px" width="100%" src="" id="pic" />
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
                                <label>
                                    <input type="checkbox" name="is_featured" id="is_featured" value="1"
                                        class="cbc">
                                    <label class="cbc">Nổi bật</label>
                                </label>
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
                                <label>Thao tác</label>
                            </div>
                            <div class="box-body">
                                <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                                <a href="{{ route('backend.svcategory.index') }}" class="btn btn-danger"><i
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
@php
@endphp
