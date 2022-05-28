@extends('backend.layout.master')
@section('title', 'Cập nhật bài viết')
@push('script')
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('content', options);
        });
    </script>
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="pjax-container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h4>
                Chỉnh sửa Bài viết
            </h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
                <li><a>Tin tức</a></li>
                <li><a href="{{ route('backend.post.index') }}">Quản lý Tin tức</a></li>
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
            <form method="POST" action="{{ route('backend.post.update', $post->id) }}" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}
                <div class="row">
                    <!-- left column -->
                    <!-- left column -->
                    <div class="col-md-9">
                        <form method="POST" action="{{ route('backend.post.update', $post->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="box box-primary">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Tên bài viết ({{ session('locale') }})</label>
                                        <input type="text" name="translation[name]" id="translation[name]"
                                            value="@if (isset($post->translations->name)){{ old('translation[name]', $post->translations->name) }}@else{{ old('translation[name]') }} @endif"
                                            class="form-control" data-toggle="tooltip" data-placement="top"
                                            title="Nhập tên bài viết ({{ $lang }})">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tag ({{ session('locale') }})</label>
                                        <select class="form-control select2 tag" name="tags[]" multiple="multiple" id="">
                                            @foreach ($post->get_tags as $tag)
                                                <option selected value="{{ $tag->id }}">
                                                    {{ $tag->translations->name ?? '' }}</option>
                                            @endforeach
                                            @foreach ($tags as $t)
                                                <option value="{{ $t->id }}">{{ $t->translations->name ?? '' }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label>Danh mục Cấp 1</label>
                                        <select class="form-control select2 choose newcatone" name="newcatone"
                                            id="newcatone" style="width: 100%;">
                                            <option value="">Chọn</option>
                                            @foreach ($newcatones as  $newcatone)
                                                <option value="{{ $newcatone->id }}"
                                                    {{ $post->newcatone_id == $newcatone->id ? 'selected' : '' }}>
                                                    {{ $newcatone->translations->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Mô tả bài viết ({{ session('locale') }})</label>
                                        <textarea class="form-control" name="translation[descriptions]" id="descriptions"
                                            value="@if (isset($post->translations->descriptions)){{ old('translation[descriptions]', $post->translations->descriptions) }}@else{{ old('translation[descriptions]') }} @endif"
                                            rows="3" data-toggle="tooltip" data-placement="top"
                                            title="Nhập mô tả bài viết (VI)">@if (isset($post->translations->descriptions)){{ old('translation[descriptions]', $post->translations->descriptions) }}@else{{ old('translation[descriptions]') }}@endif</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Nội dung ({{ session('locale') }})</label>
                                        <textarea class="form-control" name="translation[content]" id="content" rows="3">@if (isset($post->translations->content)){{ old('content', $post->translations->content) }}@else{{ old('content') }}@endif</textarea>
                                    </div>
                                </div>
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Tối ưu hoá tìm kiếm (SEO - {{ session('locale') }})</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <div class="url-seo" id="slug-seo">
                                                {{ route('frontend.home.index') }}/{{ $post->translations->slug }}.html
                                            </div>
                                            <div class="title-seo" id="title-seo">{{ $post->translations->title }}
                                            </div>
                                            <div class="description-seo" id="description-seo">
                                                {{ $post->translations->description }}</div>
                                            <label>URL bài viết ({{ session('locale') }})</label>
                                            <input type="text" type="text" name="translation[slug]" id="slug" data-length=120
                                                value="@if (isset($post->translations->slug)){{ old('slug', $post->translations->slug) }}@else{{ old('slug') }} @endif"
                                                class="form-control" data-toggle="tooltip" data-placement="top"
                                                title="Nhập URL sản phẩm">
                                        </div>
                                        <div class="form-group">
                                            <label>Tiêu đề ({{ session('locale') }})</label>
                                            <input type="text" name="translation[title]" id="title" data-length=120
                                                value="@if (isset($post->translations->title)){{ old('translation[title]', $post->translations->title) }}@else{{ old('translation[title]') }} @endif"
                                                class="form-control" data-toggle="tooltip" data-placement="top"
                                                title="Nhập tiêu đề sản phẩm">
                                        </div>
                                        <div class="form-group">
                                            <label>Từ khóa ({{ session('locale') }})</label>
                                            <textarea class="form-control" name="translation[keywords]" id="keywords" data-length=320
                                                value="@if (isset($post->translations->keywords)){{ old('translation[keywords]', $post->translations->keywords) }}@else{{ old('translation[keywords]') }} @endif"
                                                rows="3" data-toggle="tooltip" data-placement="top"
                                                title="Nhập từ khoá cho sản phẩm">@if (isset($post->translations->keywords)){{ old('translation[keywords]', $post->translations->keywords) }}@else{{ old('translation[keywords]') }}@endif</textarea>

                                        </div>
                                        <div class="form-group">
                                            <label>Mô tả ({{ session('locale') }})</label>
                                            <textarea class="form-control" name="translation[description]" id="description" data-length=320
                                                value="@if (isset($post->translations->description)){{ old('translation[description]', $post->translations->description) }}@else{{ old('translation[description]') }} @endif"
                                                rows="3" data-toggle="tooltip" data-placement="top"
                                                title="Nhập mô tả ngắn sản phẩm">@if (isset($post->translations->description)){{ old('translation[description]', $post->translations->description) }}@else{{ old('translation[description]') }}@endif</textarea>
                                        </div>
                                    </div>
                            </div>
                    </div>
                    <!-- left column -->
                    <!-- left column -->
                    <!-- right column -->
                    <div class="col-md-3">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <label>Thao tác</label>
                            </div>
                            <div class="box-body">
                                <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                                <a href="{{ route('backend.post.index') }}" class="btn btn-danger"><i
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
                                <label>Hình ảnh đại diện</label>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <img id="pic" class="img-thumbnail mb-2" style="width: 100%; margin-bottom:10px;"
                                        src="{{ asset('storage') }}/uploads/post/{{ $post->img }}"
                                        alt="{{ $post->translations->name }}">
                                    <input oninput="pic.src=window.URL.createObjectURL(this.files[0])" type="file"
                                        name="img" class="form-control" value="{{ $post->img }}" data-toggle="tooltip"
                                        data-placement="top" title="Dimensions min 370 x 250 (px)">
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
                                        value="@if (isset($post->stt)){{ old('stt', $post->stt) }}@else{{ old('stt') }} @endif"
                                        min="0" class="form-control stt" data-toggle="tooltip" data-placement="top"
                                        title="Nhập số thứ tự">
                                </div>
                            </div>
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <label>
                                    <input type="checkbox" name="hide_show" id="hide_show" value="1"
                                        {{ $post->hide_show == 1 ? 'checked' : '' }} class="cbc">
                                    <label class="cbc">Hiển thị</label>
                                </label>
                            </div>
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <label>
                                    <input type="checkbox" name="is_featured" id="is_featured" value="1"
                                        {{ $post->is_featured == 1 ? 'checked' : '' }} class="cbc">
                                    <label class="cbc">Nổi bật</label>
                                </label>
                            </div>
                        </div>
                         <div class="box box-primary">
                            <div class="box-header with-border">
                                <label>Ngày đăng bài</label>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <input type="text" name="created_at" 
                                        value="@if (isset($post->created_at)){{ old('created_at', $post->created_at) }}@else{{ old('created_at') }} @endif"
                                        min="0" class="form-control " data-toggle="tooltip" data-placement="top"
                                        title="Ngày đăng bài">
                                </div>
                            </div>
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <label>Thao tác</label>
                            </div>
                            <div class="box-body">
                                <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                                <a href="{{ route('backend.post.index') }}" class="btn btn-danger"><i
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
@push('script')
    <script>
        $("#name_vi").keyup(function() {
            $("#title_vi").val(this.value);
        });
    </script>
    <script>
        $("#name_en").keyup(function() {
            $("#title_en").val(this.value);
        });
    </script>
    <script>
        $("#name_cn").keyup(function() {
            $("#title_cn").val(this.value);
        });
    </script>
    {{-- <script>
  var editor = CKEDITOR.replace( 'content' );
  CKFinder.setupCKEditor( editor );
</script> --}}
    <script>
        $('document').ready(function() {
            $(document).on('change', 'input#slug', function() {
                var slug1 = createslug($(this).val());
                $('div#slug1').text(window.location.hostname +
                    '/' + slug1 + '.html');
            });
        });

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
    <script>
        $(document).ready(function() {
            $('.choose').on('change', function() {
                var action = $(this).attr('id');
                var code_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                // alert(action);
                if (action == 'newcatone') {
                    result = 'newcattwo';
                }
                $.ajax({
                    url: '{{ route('backend.post.select') }}',
                    method: 'POST',
                    data: {
                        action: action,
                        code_id: code_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                    }
                });
            });
        })
    </script>
@endpush
