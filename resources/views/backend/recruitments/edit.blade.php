@extends('backend.layout.master')
@section('title','Cập nhật tin tuyển dụng')
@push('script')
    {{-- custom datepicker --}}
    <script>
        $("#slug").keyup(function(){
        $("#slug-seo").text(window.location.hostname+'/'+ this.value + '.html');
      });
      $("#title").keyup(function(){
        $("#title-seo").text(this.value);
      });
      $("#description").keyup(function(){
        $("#description-seo").text(this.value);
      });
        </script>
        <script>
            var editor = CKEDITOR.replace('content');
            CKFinder.setupCKEditor(editor);
        </script>

    <script>
        var date = new Date();
        var seconds = date.getSeconds();
        var minutes = date.getMinutes();
        var hour = date.getHours();
        $('#datepicker').datepicker({
            autoclose: true,
            // format: 'yyyy-mm-dd '+hour+':'+minutes+':'+seconds,
            format: 'dd-mm-yyyy',
            startDate: date
        })
    </script>
    {{-- end custom datepicker --}}
    <script>
        $('document').ready(function() {
            $(document).on('change', 'input#slug', function() {
                var slug1 = createslug($(this).val());
                $('div#slug1').text('{{ $setting->web }}/tuyen-dung/' + slug1 + '.html');
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
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="pjax-container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h4>
                Chỉnh sửa tin tuyển dụng
            </h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
                <li><a href="{{ route('backend.recruitment.index') }}">Quản lý tuyển dụng</a></li>
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
            <form method="post" action="{{ route('backend.recruitment.update', $recruitment->id) }}"
                enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-9">
                        <form method="recruitment" action="{{ route('backend.recruitment.update', $recruitment->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="box box-primary">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Tên bài viết ({{ $lang }})</label>
                                        <input type="text" name="translation[name]" id="translation[name]"
                                            value="@if (isset($recruitment->translations->name)){{ old('translation[name]', $recruitment->translations->name) }}@else{{ old('translation[name]') }} @endif"
                                            class="form-control" data-toggle="tooltip" data-placement="top"
                                            title="Nhập tên bài viết ({{ $lang }})">
                                    </div>

                                    <div class="form-group">
                                        <label>Nội dung ({{ $lang }})</label>
                                        <textarea class="form-control" name="translation[content]" id="content" rows="3">@if (isset($recruitment->translations->content)){{ old('content', $recruitment->translations->content) }}@else{{ old('content') }}@endif</textarea>
                                    </div>
                                </div>
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Tối ưu hoá tìm kiếm (SEO)</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <div class="url-seo" id="slug-seo">
                                                {{ route('frontend.home.index') }}/{{ $recruitment->translations->slug }}.html
                                            </div>
                                            <div class="title-seo" id="title-seo">{{ $recruitment->translations->title }}
                                            </div>
                                            <div class="description-seo" id="description-seo">
                                                {{ $recruitment->translations->description }}</div>
                                            <label>URL sản phẩm ({{ $lang }})</label>
                                            <input type="text" type="text" name="slug" id="slug" data-length=120
                                                value="@if (isset($recruitment->translations->slug)) {{ old('slug', $recruitment->translations->slug) }}@else{{ old('slug') }} @endif"
                                                class="form-control" data-toggle="tooltip" data-placement="top"
                                                title="Nhập URL sản phẩm">
                                        </div>
                                        <div class="form-group">
                                            <label>Tiêu đề ({{ $lang }})</label>
                                            <input type="text" name="translation[title]" id="title" data-length=120
                                                value="@if (isset($recruitment->translations->title)) {{ old('translation[title]', $recruitment->translations->title) }}@else{{ old('translation[title]') }} @endif"
                                                class="form-control" data-toggle="tooltip" data-placement="top"
                                                title="Nhập tiêu đề sản phẩm">
                                        </div>
                                        <div class="form-group">
                                            <label>Từ khóa ({{ $lang }})</label>
                                            <textarea class="form-control" name="translation[keywords]" id="keywords"
                                                data-length=320
                                                value="@if (isset($recruitment->translations->keywords)){{ old('translation[keywords]', $recruitment->translations->keywords) }}@else{{ old('translation[keywords]') }} @endif"
                                                rows="3" data-toggle="tooltip" data-placement="top"
                                                title="Nhập từ khoá cho sản phẩm">@if (isset($recruitment->translations->keywords)){{ old('translation[keywords]', $recruitment->translations->keywords) }}@else{{ old('translation[keywords]') }}@endif</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Mô tả ({{ $lang }})</label>
                                            <textarea class="form-control" name="translation[description]"
                                                id="description" data-length=320
                                                value="@if (isset($recruitment->translations->description)) {{ old('translation[description]', $recruitment->translations->description) }}@else{{ old('translation[description]') }} @endif"
                                                rows="3" data-toggle="tooltip" data-placement="top"
                                                title="Nhập mô tả ngắn sản phẩm">@if (isset($recruitment->translations->description)){{ old('translation[description]', $recruitment->translations->description) }}@else{{ old('translation[description]') }}@endif</textarea>
                                        </div>
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
                                <a href="{{ route('backend.recruitment.index') }}" class="btn btn-danger"><i
                                        class="fa fa-times-circle"></i> Thoát</a>
                            </div>
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <label>Số lượng</label>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <input type="number" min="1" name="quantity" id="quantity"
                                        value="@if (isset($recruitment->quantity)){{ old('quantity', $recruitment->quantity) }}@else{{ old('quantity') }} @endif"
                                        class="form-control" data-toggle="tooltip" data-placement="top"
                                        title="Nhập số lượng cần tuyển">
                                </div>
                            </div>
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <label>Ngày hết hạn</label>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="datepicker"
                                            name="date_expired"
                                            value="{{ date('d-m-Y', strtotime($recruitment->date_expired)) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <label>Hình ảnh đại diện</label>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <img class="img-thumbnail mb-2" style="width: 100%; margin-bottom:10px;"
                                        src="/storage/uploads/{{ $recruitment->img }}" alt="{{ $recruitment->name }}">
                                    <input type="file" name="img" class="form-control" value="{{ $recruitment->img }}"
                                        data-toggle="tooltip" data-placement="top" title="Dimensions min 370 x 250 (px)">
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
                                        value="@if (isset($recruitment->stt)){{ old('stt', $recruitment->stt) }}@else{{ old('stt') }} @endif"
                                        class="form-control stt" data-toggle="tooltip" data-placement="top"
                                        title="Nhập số thứ tự">
                                </div>
                            </div>
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <label>
                                    <input type="checkbox" name="hide_show" id="hide_show" value="1"
                                        {{ $recruitment->hide_show == 1 ? 'checked' : '' }} class="cbc">
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
                                <a href="{{ route('backend.recruitment.index') }}" class="btn btn-danger"><i
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
