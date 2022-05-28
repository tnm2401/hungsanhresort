@extends('backend.layout.master')
@section('title', 'Cập nhật danh mục phòng')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="pjax-container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h4>
                CẬP NHẬT DANH MỤC PHÒNG ({{ session('locale') }})
            </h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
                <li><a>Phòng</a></li>
                <li><a href="{{ route('backend.procatone.index') }}">Danh mục phòng</a></li>
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
            <form method="POST" action="{{ route('backend.procatone.update', $procatone->id) }}"
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
                                    <input type="text" name="translation[name]" id="name"
                                        value="@if (isset($procatone->translations->name)) {{ old('name', $procatone->translations->name) }}@else{{ old('name') }} @endif"
                                        class="form-control" data-toggle="tooltip" data-placement="top"
                                        title="Nhập tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label>Nội dung hiển thị trang chủ ({{ session('locale') }})</label>
                                    <textarea class="form-control" name="translation[content]" id="content"
                                        value="@if (isset($procatone->translations->content)) {{ old('content', $procatone->translations->content) }}@else{{ old('content') }} @endif"
                                        rows="7" data-toggle="tooltip" data-placement="top" title="Nhập mô tả danh mục">
@if (isset($procatone->translations->content))
{{ old('content', $procatone->translations->content) }}@else{{ old('content') }}
@endif
</textarea>
                                </div>
       <div class="form-group">
                                    <label>Mô tả chi tiết ({{ session('locale') }})</label>
                                    <textarea class="form-control" name="translation[descriptions]" id="descriptions"
                                        value="@if (isset($procatone->translations->descriptions)) {{ old('descriptions', $procatone->translations->descriptions) }}@else{{ old('descriptions') }} @endif"
                                        rows="7" data-toggle="tooltip" data-placement="top" title="Nhập mô tả danh mục">
@if (isset($procatone->translations->descriptions))
{{ old('descriptions', $procatone->translations->descriptions) }}@else{{ old('descriptions') }}
@endif
</textarea>
                                </div>
                                <label>Thêm hình ảnh chi tiết</label>
                                <input id="image" type="file" class="form-control" name="imgs[]"
                                    style="margin-bottom: 10px" multiple data-toggle="tooltip" data-placement="top"
                                    title="Dimensions min 500 x 500 (px)" />
                                <div id="frames"></div>
                                <div class="form-group">
                                    <label>Hình ảnh hiện tại</label>
                                    <div id="frames">
                                        @foreach ($procatone->images as $image)
                                            @php
                                                $img = $image->imgs;
                                            @endphp
                                            <img src="{{ asset('storage') }}/uploads/cateroom/{{ $image->imgs }}"
                                                alt="product image" class="img-thumbnail mx-md-auto"
                                                style="width: 150px; height: 100px">
                                            <a style="cursor:pointer" data-toggle="tooltip" class="delete-img"
                                                data-id="{{ $image->id }}" data-placement="top" title="Xoá"><i
                                                    style="color: rgb(230, 86, 86)" class="fa-solid fa-trash-can-xmark"></i>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="box-header with-border">
                                <h3 class="box-title">Tối ưu hoá tìm kiếm (SEO-{{ session('locale') }})</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="url-seo" id="slug-seo">
                                        {{ url('/') }}/{{ $procatone->translations->slug ?? '' }}.html</div>
                                    <div class="title-seo" id="title-seo">
                                        {{ $procatone->translations->title ?? '' }}</div>
                                    <div class="description-seo" id="description-seo">
                                        {{ $procatone->translations->description }}</div>
                                    <label>URL danh mục</label>
                                    <input type="text" type="text" name="translation[slug]" id="slug"
                                        value="@if (isset($procatone->translations->slug)) {{ old('slug', $procatone->translations->slug) }}@else{{ old('slug') }} @endif"
                                        class="form-control" data-toggle="tooltip" data-placement="top"
                                        title="Nhập URL danh mục">
                                </div>
                                <div class="form-group">
                                    <label>Tiêu đề ({{ session('locale') }})</label>
                                    <input type="text" name="translation[title]" id="title"
                                        value="@if (isset($procatone->translations->title)) {{ old('title', $procatone->translations->title) }}@else{{ old('title') }} @endif"
                                        class="form-control" data-toggle="tooltip" data-placement="top"
                                        title="Nhập tiêu đề danh mục">
                                </div>
                                <div class="form-group">
                                    <label>Từ khóa ({{ session('locale') }})</label>
                                    <textarea class="form-control" name="translation[keywords]" id="keywords"
                                        value="@if (isset($procatone->translations->keywords)) {{ old('keywords', $procatone->translations->keywords) }}@else{{ old('keywords') }} @endif"
                                        rows="3" data-toggle="tooltip" data-placement="top"
                                        title="Nhập từ khoá cho danh mục">
@if (isset($procatone->translations->keywords))
{{ old('keywords', $procatone->translations->keywords) }}@else{{ old('keywords') }}
@endif
</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả ({{ session('locale') }})</label>
                                    <textarea class="form-control" name="translation[description]" id="description"
                                        value="@if (isset($procatone->translations->description)) {{ old('description', $procatone->translations->description) }}@else{{ old('description') }} @endif"
                                        rows="7" data-toggle="tooltip" data-placement="top"
                                        title="Nhập mô tả ngắn danh mục">
@if (isset($procatone->translations->description))
{{ old('description', $procatone->translations->description) }}@else{{ old('description') }}
@endif
</textarea>
                                </div>
                                <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                                <a href="{{ route('backend.procatone.index') }}" class="btn btn-danger"><i
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
                                <a href="{{ route('backend.procatone.index') }}" class="btn btn-danger"><i
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
                                    <img id="pic2" class="img-thumbnail mb-2" style="width: 100%; margin-bottom:10px;"
                                        src="{{ asset('storage') }}/uploads/cateroom/{{ $procatone->img }}"
                                        alt="{{ $procatone->name }}">
                                    <input type="file" name="img" class="form-control" value="{{ $procatone->img }}"
                                        data-toggle="tooltip" data-placement="top"
                                        oninput="pic2.src=window.URL.createObjectURL(this.files[0])"
                                        title="Dimensions min 370 x 250 (px)">
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
                                        value="@if (isset($procatone->stt)){{ old('stt', $procatone->stt) }}@else{{ old('stt') }} @endif"
                                        min="0" class="form-control stt" data-toggle="tooltip" data-placement="top"
                                        title="Nhập số thứ tự">
                                </div>
                            </div>
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <label>Giá một đêm (₫)</label>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <input type="text" name="price" id="price" onchange="numberWithCommas();"
                                        data-length=120 value="{{ $procatone->price }}" class="form-control"
                                        data-toggle="tooltip" data-placement="top" title="Nhập giá sản phẩm">
                                </div>
                            </div>
                        </div>

                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <label>Giảm giá (%)</label>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <input type="number" name="discount" id="discount" data-length=120
                                        value="{{ $procatone->discount }}" class="form-control" data-toggle="tooltip"
                                        data-placement="top" title="Nhập % giảm giá">
                                </div>
                            </div>
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <label for="">Khu</label>
                                <input type="text" class="form-control" value="{{ $procatone->location }}"
                                    name="location" placeholder="A,B,C,D,...">
                            </div>
                        </div>
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <label>
                                    <input type="checkbox" name="hide_show" id="hide_show" value="1"
                                        {{ $procatone->hide_show == 1 ? 'checked' : '' }} class="cbc">
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
                                <a href="{{ route('backend.procatone.index') }}" class="btn btn-danger"><i
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
        $(".delete-img").click(function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");
            Swal.fire({
                title: 'Xóa hình ảnh này ?',
                text: "Sau khi xóa không thể hoàn tác",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đồng ý !',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('/') }}/administrator/procatones/" + id + "/delete",
                        // url : {{ route('backend.product.delete', 13) }}
                        type: 'DELETE',
                        data: {
                            "id": id,
                            "_token": token,
                        },
                        success: function(data) {
                            if (data['status'] == true) { // if true (1)
                                setTimeout(function() { // wait for 3 secs(2)
                                    location.reload(); // then reload the page.(3)
                                }, 1000);
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Đã xóa hình ảnh',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            } else {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: 'Đã có lỗi xảy ra',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                        },
                        error: function(data) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Đã có lỗi xảy ra',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    });
                }
            })

        });
    </script>


    <script>
        $('document').ready(function() {
            $(document).on('change', 'input#slug', function() {
                var slugcat = CreateSlugCat($(this).val());
                $('div#slug-seo').text(window.location.hostname + '/' + slugcat + '.html');
            });
        });

        $(document).on('change', 'textarea#description', function() {
            $("div#description-seo").text(this.value);
        });

        $(document).on('change', 'input#title', function() {
            $("div#title-seo").text(this.value);
        });

        CKEDITOR.replace('descriptions', options);
        CKEDITOR.replace('content', options);

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
