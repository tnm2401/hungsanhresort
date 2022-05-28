@extends('backend.layout.master')
@section('title','Thêm phòng')
@push('script')
<script>

$("input#code").keyup(function() {
    var slug1 = $(this).val();
    var slug = slug1.toLowerCase();
    $('input#slugz_vi').val('phong-'+slug );
    $('div#slugvi').text(window.location.hostname + '/' +'phong-'+ slug + '.html');
    $('div#slugen').text(window.location.hostname + '/' +'room-'+ slug + '.html');
    $('input#slugz_en').val('room-'+slug );

});

</script>
    @foreach ($language as $lang)
        <script>

        $(document).ready(function() {
            CKEDITOR.replace('content_{{ $lang->locale }}', options);
            CKEDITOR.replace('descriptions_{{ $lang->locale }}', options);
        });
            $(document).on('keyup', 'textarea#des_{{ $lang->locale }}', function() {
                var des1 = ($(this).val());
                $('div#description{{ $lang->locale }}').text(des1);
            });
            $(document).on('keyup', 'input#title_{{ $lang->locale }}', function() {
                var des1 = ($(this).val());
                $('div#title{{ $lang->locale }}').text(des1);
            });
            $(document).on('keyup', 'textarea#des_{{ $lang->locale }}', function() {
                var des1 = ($(this).val());
                $('div#description{{ $lang->locale }}').text(des1);
            });
            $(document).on('keyup', 'input#slugz_{{ $lang->locale }}', function() {
                var slug1 = createslug($(this).val());
                $('div#slug{{ $lang->locale }}').text(window.location.hostname + '/' + slug1 + '.html');
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
                THÊM MỚI PHÒNG
            </h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
                <li><a>Phòng</a></li>
                <li><a href="{{ route('backend.product.index') }}">Quản lý Phòng</a></li>
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
            <form autocomplete="off" id="stringLengthForm" method="POST" action="{{ route('backend.product.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-9">
                        <div class="nav-tabs-custom">

                            <ul class="nav nav-tabs">
                                @foreach ($language as $lang)
                                    <li class="{{ $loop->first ? 'active' : '' }}"><a href="#tab_{{ $lang->locale }}"
                                            data-toggle="tab">
                                            <span class="{{ $lang->flag }}"></span> {{ $lang->name }}
                                            ({{ $lang->locale }})
                                        </a></li>
                                @endforeach
                                <li class="pull-right"><a href="#" class="text-muted"><i
                                            class="fa fa-gear"></i></a></li>
                            </ul>
                            <div class="tab-content">
                                @foreach ($language as $key => $lang)
                                    <div class="tab-pane {{ $loop->first ? 'in active' : '' }} tab-content-en"
                                        id="tab_{{ $lang->locale }}">
                                        @if ($loop->first)
                                            <input type="hidden" id="type" name="type" value="product">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Danh mục phòng</label>
                                                            <select class="form-control select2  "
                                                                name="procatone"  style="width: 100%;">
                                                                <option value="">Chọn</option>
                                                                @foreach ($procatones as $procatone)
                                                                    <option value="{{ $procatone->id }}">
                                                                        {{ $procatone->translations->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Tên phòng ( <small style="color: rgb(200, 98, 98)">* Khu + số phòng </small> )</label>
                                                            <input type="text" id="code" name="code" data-length=120
                                                                value="{{ old('name') }}" placeholder="ví dụ : A1" class="form-control"
                                                                data-toggle="tooltip" data-placement="top" title="Nhập tên phòng" required>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label>Hình ảnh chi tiết</label>
                                                    <input type="file" class="form-control" id="image" name="imgs[]" multiple
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Dimensions min 500 x 500 (px)" />
                                                        <div id="frames"></div>
                                                </div>


                                                <div class="form-group">
                                                        <label>Tag ({{ $lang->locale }})</label> <small>*có thể chọn nhiều tags</small>
                                                    <select class="form-control tag select2" name=tags[] multiple="multiple">
                                                        @foreach ($tags as $tag)
                                                            <option value="{{ $tag->id }}">{{ $tag->translations->name ?? '' }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif


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
                                                <label>Mô tả chi tiết ({{ $lang->locale }})</label>
                                                <textarea class="form-control"
                                                    name="translation[{{ $key }}][content]"
                                                    id="content_{{ $lang->locale }}"
                                                    rows="3">{!! old('content') !!}</textarea>
                                            </div>


                                        <div class="box-header with-border">
                                            <h3 class="box-title">Tối ưu hoá tìm kiếm (SEO-{{ $lang->locale }})</h3>
                                        </div>

                                            <div class="form-group">
                                                <div class="url-seo" id="slug{{ $lang->locale }}"></div>
                                                <div class="title-seo" id="title{{ $lang->locale }}"></div>
                                                <div class="description-seo" id="description{{ $lang->locale }}"></div>
                                            </div>

                                            <div class="form-group">
                                                <label>URL danh mục ({{ $lang->locale }})</label>
                                                <input type="text" type="text"
                                                    name="translation[{{ $key }}][slug]"
                                                    id="slugz_{{ $lang->locale }}"
                                                    value="{{ old('slugz_' . $lang->locale) }}" class="form-control"
                                                    data-toggle="tooltip" data-placement="top" title="Nhập URL danh mục">

                                            </div>

                                            <div class="form-group">

                                                <label>Tiêu Đề ({{ $lang->locale }})</label>
                                                <input type="text" name="translation[{{ $key }}][title]"
                                                    id="title_{{ $lang->locale }}"
                                                    value="{{ old('title_' . $lang->locale) }}" class="form-control"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Nhập tiêu đề danh mục">
                                            </div>
                                            <div class="form-group">
                                                <label>Từ khóa ({{ $lang->locale }})</label>
                                                <textarea class="form-control"
                                                    name="translation[{{ $key }}][keywords]"
                                                    id="keywords_{{ $lang->locale }}"
                                                    value="{{ old('keywords_' . $lang->locale) }}" rows="3"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Nhập từ khoá cho danh mục"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label>Mô tả ({{ $lang->locale }})</label>
                                                <textarea class="form-control"
                                                    name="translation[{{ $key }}][description]"
                                                    id="des_{{ $lang->locale }}"
                                                    value="{{ old('description_' . $lang->locale) }}" rows="3"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Nhập mô tả ngắn danh mục"></textarea>
                                            </div>

                                            <div hidden class="form-group">
                                                <label>Locale ({{ $lang->locale }})</label>
                                                <input type="text" class="form-control"
                                                    name="translation[{{ $key }}][locale]"
                                                    value="{{ $lang->locale }}">
                                            </div>
                                    </div>
                                @endforeach

                                <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                                <a href="{{ route('backend.product.index') }}" class="btn btn-danger"><i
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
                                <a href="{{ route('backend.product.index') }}" class="btn btn-danger"><i
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
                                <label>Diện tích</label>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="ví dụ : 200 X 150" name="cover" >
                                </div>
                            </div>
                            
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <label>Số người</label>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <input type="number" class="form-control" name = "person">
                                </div>
                            </div>
                            
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <label>Số giường</label>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <input type="number" class="form-control" name="bed">
                                </div>
                            </div>
                            
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <label>Số thứ tự</label>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <input type="number" name="stt" id="stt" value="1" class="form-control stt"
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
                                <a href="{{ route('backend.product.index') }}" class="btn btn-danger"><i
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


