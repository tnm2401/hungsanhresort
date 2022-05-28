@extends('backend.layout.master')
@section('title', 'Cập nhật danh mục bài viết cấp 2')
@push('script')
    <script>
        $('document').ready(function() {
            $(document).on('keyup', 'input#slug', function() {
                var slugcat = CreateSlugCat($(this).val());
                $('div#slug-seo').text(window.location.hostname + '/' + slugcat + '.html');
            });

            $(document).on('keyup', 'textarea#description', function() {
                var des = ($(this).val());
                $('div#description-seo').text(des);
            });

            $(document).on('keyup', 'input#name', function() {
                var title1 = ($(this).val());
                $('div#title-seo').text(title1);
            });

        }); //ready function

        function CreateSlugCat(text) {
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
                Chỉnh sửa Danh mục
            </h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
                <li><a>Sản phẩm</a></li>
                <li><a href="{{ route('backend.newcattwo.index') }}">Danh mục Cấp 2</a></li>
                <li class="active">Sửa</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('backend.newcattwo.update', $newcattwo->id) }}"
                enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-9">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Tên danh mục ({{ session('locale') }})</label>
                                    <input type="text" name="translation[name]" id="name" data-length=120
                                        value="@if(isset($newcattwo->translations->name)){{ old('translation[name]', $newcattwo->translations->name) }}@else{{ old('translation[name]') }} @endif"
                                        class="form-control" data-toggle="tooltip" data-placement="top"
                                        title="Nhập tên danh mục">
                                </div>
                                <label>Danh mục cấp 1 ({{ session('locale') }})</label>
                                <div class="form-group">
                                    <select class="form-control select2" name="newcatone_id"
                                        data-placeholder=" Chọn danh mục" style="width: 100%;">
                                        <option value=""> Chọn danh mục</option>
                                        @foreach ($newcatones as $newcatone)
                                            <option value="{{ $newcatone->id }}"
                                                {{ $newcatone->id == $newcattwo->newcatone_id ? 'selected' : '' }}>
                                                {{ $newcatone->translations->name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả danh mục ({{ session('locale') }})</label>
                                    <textarea class="form-control" name="translation[descriptions]" id="descriptions" data-length=400 rows="3"data-toggle="tooltip" data-placement="top" title="Nhập mô tả danh mục">{{ $newcattwo->translations->descriptions }}</textarea>

                                </div>
                                <div class="form-group">
                                    <label>Thông tin chung ({{ session('locale') }})</label>
                                    <textarea class="form-control" name="translation[content]" id="infomation" rows="3">@if(isset($newcattwo->translations->content)){{ old('infomation', $newcattwo->translations->content) }}@else{{ old('infomation') }}@endif</textarea>
                                </div>
                            </div>
                                <div class="box-header with-border">
                                    <h3 class="box-title">Tối ưu hoá tìm kiếm (SEO-{{ session('locale') }})</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="url-seo" id="slug-seo">
                                            {{ url('/') }}/{{ $newcattwo->translations->slug }}.html</div>
                                        <div class="title-seo" id="title-seo">{{ $newcattwo->translations->title }}
                                        </div>
                                        <div class="description-seo" id="description-seo">
                                            {{ $newcattwo->translations->descriptions }}</div>
                                        <label>URL danh mục ({{ session('locale') }})</label>
                                        <input type="text" type="text" name="slug" id="slug"
                                            value="@if(isset($newcattwo->translations->slug)){{ old('slug', $newcattwo->translations->slug) }}@else{{ old('slug') }}@endif"
                                            class="form-control" data-toggle="tooltip" data-placement="top"
                                            title="Nhập URL danh mục">
                                    </div>
                                    <div class="form-group">
                                        <label>Tiêu đề ({{ session('locale') }})</label>
                                        <input type="text" name="translation[title]" id="title"
                                            value="@if(isset($newcattwo->translations->title)){{ old('title', $newcattwo->translations->title) }}@else{{ old('title') }} @endif"
                                            class="form-control" data-toggle="tooltip" data-placement="top"
                                            title="Nhập tiêu đề danh mục">
                                    </div>
                                    <div class="form-group">
                                        <label>Từ khóa ({{ session('locale') }})</label>
                                        <textarea class="form-control" name="translation[keywords]" id="keywords"
                                            value="@if(isset($newcattwo->translations->keywords)){{ old('keywords', $newcattwo->translations->keywords) }}@else{{ old('keywords') }} @endif"
                                            rows="3" data-toggle="tooltip" data-placement="top"
                                            title="Nhập từ khoá cho danh mục">@if(isset($newcattwo->translations->keywords)){{ old('keywords', $newcattwo->translations->keywords) }}@else{{ old('keywords') }}@endif</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả ({{ session('locale') }})</label>
                                        <textarea class="form-control" name="translation[description]" id="description"
                                            value="@if(isset($newcattwo->translations->description)){{ old('description', $newcattwo->translations->description) }}@else{{ old('description') }} @endif"
                                            rows="7" data-toggle="tooltip" data-placement="top"
                                            title="Nhập mô tả ngắn danh mục">@if(isset($newcattwo->translations->description)){{ old('description', $newcattwo->translations->description) }}@else{{ old('description') }}@endif</textarea>
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
                                <a href="{{ route('backend.newcattwo.index') }}" class="btn btn-danger"><i
                                        class="fa fa-times-circle"></i> Thoát</a>
                            </div>
                        </div>
                        @if($language->count() >= 1)
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <label>Ngôn ngữ</label>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <ul>
                                            @foreach ($language as $lang)
                                                <li>
                                                    <a href="{{ route('change.locale', '' . $lang->locale . '') }}"><span>
                                                            <i class="{{ $lang->flag }}"></i> {{ $lang->name }} <i
                                                                class="fas fa-external-link-alt"></i></span></a>
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
                                <label>Hình ảnh đại diện</label>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <img class="img-thumbnail mb-2" style="width: 100%; margin-bottom:10px;"
                                        src="/storage/uploads/{{ $newcattwo->img }}" alt="{{ $newcattwo->name }}">
                                    <input type="file" name="img" class="form-control" value="{{ $newcattwo->img }}"
                                        data-toggle="tooltip" data-placement="top" title="Dimensions min 500 x 500 (px)">
                                </div>
                            </div>
                        </div>

                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <label>Số thứ tự</label>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <input type="number" name="stt" id="stt"
                                        value="@if(isset($newcattwo->stt)){{ old('stt', $newcattwo->stt) }}@else{{ old('stt') }} @endif"
                                        class="form-control stt" data-toggle="tooltip" data-placement="top"
                                        title="Nhập số thứ tự">
                                </div>
                            </div>
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <label>
                                    <input type="checkbox" name="hide_show" id="hide_show" value="1"
                                        {{ $newcattwo->hide_show == 1 ? 'checked' : '' }} class="cbc">
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
                                <a href="{{ route('backend.newcattwo.index') }}" class="btn btn-danger"><i
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
function showCategories($productcategories, $selected, $parent_id = 0, $char = '')
{
    foreach ($productcategories as $key => $item) {
        // Nếu là chuyên mục con thì hiển thị
        if ($item->parent_id == $parent_id) {
            if ($item->id == $selected) {
                echo '<option selected value="' . $item->id . '">' . $char . $item->name . '</option>';
            } else {
                echo '<option value="' . $item->id . '">' . $char . $item->name . '</option>';
            }

            // Xóa chuyên mục đã lặp
            unset($productcategories[$key]);

            showCategories($productcategories, $selected, $item->id, $char . '—');
        }
    }
}
@endphp
