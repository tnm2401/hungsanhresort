@extends('backend.layout.master')
@section('title', 'Cập nhật thông tin phòng')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="pjax-container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h4>
                CHỈNH SỬA THÔNG TIN PHÒNG
            </h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
                <li><a>Phòng</a></li>
                <li><a href="{{ route('backend.product.index') }}">Quản lý phòng</a></li>
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
            <div class="row">
                <!-- left column -->
                <div class="col-md-9">
                    <form id="edit-product" method="POST" action="{{ route('backend.product.update', $product->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Danh mục Cấp 1</label>
                                            <select class="form-control select2 choose procatone" name="procatone"
                                                id="procatone" style="width: 100%;">
                                                <option value="">Chọn</option>
                                                @foreach ($procatones as $key => $procatone)
                                                    <option value="{{ $procatone->id }}"
                                                        {{ $product->procatone_id == $procatone->id ? 'selected' : '' }}>
                                                        {{ $procatone->translations->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mã phòng ({{ session('locale') }})</label>
                                            <input value="{{ $product->code }}" type="text" name="code" class="form-control"
                                            readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Tag ({{ session('locale') }})</label>
                                            <select class="form-control select2 tag" name="tags[]" multiple="multiple"
                                                id="">
                                                @foreach ($product->get_tags as $tag)
                                                    <option selected value="{{ $tag->id }}">
                                                        {{ $tag->translations->name }}</option>
                                                @endforeach
                                                @foreach ($tags as $t)
                                                    <option value="{{ $t->id }}">
                                                        {{ $t->translations->name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <label>Thêm hình ảnh chi tiết</label>
                                <input id="image" type="file" class="form-control" name="imgs[]"
                                    style="margin-bottom: 10px" multiple data-toggle="tooltip" data-placement="top"
                                    title="Dimensions min 500 x 500 (px)" />
                                <div id="frames"></div>
                                <div class="form-group">
                                    <label>Hình ảnh hiện tại </label>
                                    <div id="frames">
                                        @foreach ($product->images as $image)
                                            <img src="{{ asset('storage') }}/uploads/{{ $product->code }}/{{ $image->imgs }}"
                                                alt="{{ $image->imgs }}" class="img-thumbnail mx-md-auto"
                                                style="width: 150px; height: 100px">
                                            <a style="cursor:pointer" data-toggle="tooltip" class="delete-img"
                                                data-id="{{ $image->id }}" data-placement="top" title="Xoá"><i
                                                    style="color: rgb(230, 86, 86)" class="fa-solid fa-trash-can-xmark"></i>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Mô tả ngắn ({{ session('locale') }})</label>
                                    <textarea class="form-control" name="translation[descriptions]" id="descriptions" data-length=320 rows="3"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Nhập mô tả ngắn sản phẩm">{!! $product->translations->descriptions ?? '' !!}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Mô tả chi tiết ({{ session('locale') }})</label>
                                    <textarea class="form-control" name="translation[content]" id="content" rows="3">{!! $product->translations->content ?? '' !!}</textarea>

                                </div>
                            </div>
                            <div class="box-header with-border">
                                <h3 class="box-title">Tối ưu hoá tìm kiếm (SEO - {{ session('locale') }})</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="url-seo" id="slug-seo">
                                        {{ route('frontend.home.index') }}/{{ $product->translations->slug ?? '' }}.html
                                    </div>
                                    <div class="title-seo" id="title-seo">{{ $product->translations->title ?? '' }}
                                    </div>
                                    <div class="description-seo" id="description-seo">
                                        {{ $product->translations->description ?? '' }}</div>
                                    <label>URL sản phẩm ({{ session('locale') }})</label>
                                    <input type="text" type="text" name="translation[slug]" id="slug" data-length=120
                                        value="@if (isset($product->translations->slug)) {{ old('slug', $product->translations->slug) }}@else{{ old('slug') }} @endif"
                                        class="form-control" data-toggle="tooltip" data-placement="top"
                                        title="Nhập URL sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label>Tiêu đề ({{ session('locale') }})</label>
                                    <input type="text" name="translation[title]" id="title" data-length=120
                                        value="@if (isset($product->translations->title)) {{ old('translation[title]', $product->translations->title) }}@else{{ old('translation[title]') }} @endif"
                                        class="form-control" data-toggle="tooltip" data-placement="top"
                                        title="Nhập tiêu đề sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label>Từ khóa ({{ session('locale') }})</label>
                                    <textarea class="form-control" name="translation[keywords]" id="keywords" data-length=320
                                        value="@if (isset($product->translations->keywords)) {{ old('translation[keywords]', $product->translations->keywords) }}@else{{ old('translation[keywords]') }} @endif"
                                        rows="3" data-toggle="tooltip" data-placement="top"
                                        title="Nhập từ khoá cho sản phẩm">@if (isset($product->translations->keywords)){{ old('translation[keywords]', $product->translations->keywords) }}@else{{ old('translation[keywords]') }}@endif</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả ({{ session('locale') }})</label>
                                    <textarea class="form-control" name="translation[description]" id="description" data-length=320 value="@if (isset($product->translations->description)) {{ old('translation[description]', $product->translations->description) }}@else{{ old('translation[description]') }} @endif"rows="3"data-toggle="tooltip"data-placement="top"title="Nhập mô tả ngắn sản phẩm">@if (isset($product->translations->description)){{ old('translation[description]', $product->translations->description) }}@else{{ old('translation[description]') }}@endif</textarea>
                                </div>
                                <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                                <a href="{{ route('backend.product.index') }}" class="btn btn-danger"><i
                                        class="fa fa-times-circle"></i> Thoát</a>
                            </div>
                        </div>
                </div>
                <!-- left column -->
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
                                                <span class="changelanguage  change-confirm-product" id="{{ $lang->locale }}"> <i
                                                        class="{{ $lang->flag }}"></i>
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
                                    src="{{ asset('storage') }}/uploads/{{ $product->code }}/{{ $product->img }}"
                                    alt="{{ $product->name }}">
                                <input oninput="pic.src=window.URL.createObjectURL(this.files[0])" type="file" name="img"
                                    class="form-control" value="{{ $product->img }}" data-toggle="tooltip"
                                    data-placement="top" title="Dimensions min 500 x 500 (px)">
                            </div>
                        </div>
                    </div>
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <label>Diện tích ( m <sup>2</sup>   )</label>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <input type="text" value="{{ $product->cover }}" class="form-control"
                                    placeholder="ví dụ : 400" name="cover">
                            </div>
                        </div>
                    </div>
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <label>Số người</label>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <input type="number" class="form-control" value="{{ $product->person }}" name="person">
                            </div>
                        </div>
                    </div>
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <label>Số giường</label>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <input type="number" class="form-control" value="{{ $product->bed }}" name="bed">
                            </div>
                        </div>

                    </div>
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <label>Số thứ tự</label>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <input type="number" name="stt" id="stt" min="0"
                                    value="@if (isset($product->stt)){{ old('stt', $product->stt) }}@else{{ old('stt') }} @endif"
                                    class="form-control stt" data-toggle="tooltip" data-placement="top"
                                    title="Nhập số thứ tự">
                            </div>
                        </div>
                    </div>
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <label>
                                <input type="checkbox" name="hide_show" id="hide_show" value="1"
                                    {{ $product->hide_show == 1 ? 'checked' : '' }} class="cbc">
                                <label class="cbc">Còn phòng </label>
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
                    </form>
            </div>
        </section>
    </div>
@endsection
@push('script')

    <script>
        $("#slug").keyup(function() {
            $("#slug-seo").text(window.location.hostname + '/' + this.value + '.html');
        });
        $("#title").keyup(function() {
            $("#title-seo").text(this.value);
        });
        $("#description").keyup(function() {
            $("#description-seo").text(this.value);
        });
    </script>
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('descriptions', options);
            CKEDITOR.replace('content', options);
        });
    </script>
    <script>
        $('document').ready(function() {
            $(document).on('change', 'input#slug', function() {
                var slug1 = CreateSlugProduct($(this).val());
                $('div#slug1').text('{{ $setting->web }}/san-pham/' + slug1 + '.html');
            });
        });

        function CreateSlugProduct(text) {
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
        $('input#old_price').keyup(function(event) {
            // skip for arrow keys
            if (event.which >= 37 && event.which <= 40) return;
            // format number
            $(this).val(function(index, value) {
                return value
                    .replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            });
        });
        $('input#price').keyup(function(event) {
            // skip for arrow keys
            if (event.which >= 37 && event.which <= 40) return;
            // format number
            $(this).val(function(index, value) {
                return value
                    .replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            });
        });
        $('input#prices').keyup(function(event) {
            // skip for arrow keys
            if (event.which >= 37 && event.which <= 40) return;
            // format number
            $(this).val(function(index, value) {
                return value
                    .replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            });
        });
    </script>
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
                        url: "{{ url('/') }}/administrator/products/" + id + "/delete",
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
        $(document).ready(function() {
            $('.choose').on('change', function() {
                var action = $(this).attr('id');
                var code_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                // alert(action);
                // alert(code_id);
                // alert(_token);
                if (action == 'procatone') {
                    result = 'procattwo';
                } else {
                    result = 'procatthree';
                }
                $.ajax({
                    url: '{{ route('backend.product.select_option') }}',
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

    <script>
        $('.change-confirm-product').click(function(event) {
    var form = $("#edit-product");
    // alert(form);
    event.preventDefault();
    Swal.fire({
        title: 'Đổi ngôn ngữ?',
        text: "Bạn sẽ chuyển sang ngôn ngữ vừa chọn",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xác nhận!',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        } else {
            Swal.fire(
                'Đã hủy!',
                'Chưa chuyển',
                'error'
            )
        }
    })
});

// $("#changelanguage  li span").click(function() {
//     const id = $(this).attr('id');
//     // alert(id);
//     $("input#inputchange").val(id);
// });
    </script>
@endpush
@php
function showCategories($productcategories, $selected, $parent_id = 0, $char = '')
{
    foreach ($productcategories as $key => $item) {
        // Nếu là chuyên mục con thì hiển thị
        if ($item->parent_id == $parent_id) {
            $selected_check = $item->id == $selected ? 'selected="selected"' : '';
            echo '<option ' . $selected_check . ' value="' . $item->id . '">' . $char . $item->name . '</option>';

            // Xóa chuyên mục đã lặp
            unset($productcategories[$key]);

            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showCategories($productcategories, $selected, $item->id, $char . '—');
        }
    }
}
@endphp
