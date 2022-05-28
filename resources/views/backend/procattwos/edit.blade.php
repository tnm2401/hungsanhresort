@extends('backend.layout.master')
@section('title','Cập nhật danh mục cấp 2')
@push('script')
    <script>
        $('document').ready(function () {
            $(document).on('keyup', 'input#slug', function () {
                var slugcat = CreateSlugCat($(this).val());
                $('div#slug-seo').text(window.location.hostname + '/' + slugcat + '.html');
            });

            $(document).on('keyup', 'textarea#description', function () {
                var des = ($(this).val());
                $('div#description-seo').text(des);
            });

            $(document).on('keyup', 'input#name', function () {
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
    @if(session()->get('locale') == 'vi')
    <span>Bạn đang sửa danh mục tiếng Việt <i class="fi fi-vn"></i></span>
    @elseif(session()->get('locale') == 'en')
    <span>Bạn đang sửa danh mục tiếng Anh <i class="fi fi-gb"></i></span>
    @else
    <span>Bạn đang sửa danh mục tiếng Trung <i class="fi fi-cn"></i></span>
    @endif
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Sản phẩm</a></li>
      <li><a href="{{ route('backend.procattwo.index') }}">Danh mục Cấp 2</a></li>
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
    <form method="POST" action="{{ route('backend.procattwo.update', $procattwo->id) }}" enctype="multipart/form-data">
      @csrf
      {{ method_field('PUT') }}
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                <label>Tên danh mục</label>
                <input type="text" name="translation[name]" id="name" data-length=120 value="@if(isset($procattwo->translations->name)){{ old('translation[name]', $procattwo->translations->name) }}@else{{ old('translation[name]') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên danh mục">
              </div>
              <label>Danh mục cấp 1</label>
              <div class="form-group">
                <select class="form-control select2" name="procatone_id" data-placeholder=" Chọn danh mục"
                  style="width: 100%;">
                  <option value=""> Chọn danh mục</option>
                  @foreach ($procatones as $procatone)
                    <option value="{{ $procatone->id }}" {{ ($procatone->id == $procattwo->procatone_id) ? 'selected' : '' }}> {{ $procatone->translations->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Mô tả danh mục</label>
                <textarea class="form-control" name="translation[descriptions]" id="descriptions" data-length=400 value="@if(isset($procattwo->translations->descriptions)){{ old('descriptions', $procattwo->translations->descriptions) }}@else{{ old('descriptions') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả danh mục">@if(isset($procattwo->translations->descriptions)){{ old('descriptions', $procattwo->translations->descriptions) }}@else{{ old('descriptions') }}@endif</textarea>
              </div>
              <div class="form-group">
                <label>Thông tin chung</label>
                <textarea class="form-control" name="infomation" id="infomation" rows="3">@if(isset($procattwo->infomation)){{ old('infomation', $procattwo->infomation) }}@else{{ old('infomation') }}@endif</textarea>
              </div>
            </div>
                <div class="box-header with-border">
                  <h3 class="box-title">Tối ưu hoá tìm kiếm (SEO-{{ $lang }})</h3>
                </div>
                <div class="box-body">
                  <div class="form-group">
                    <div class="url-seo" id="slug-seo">{{ url('/') }}/{{ $procattwo->translations->slug }}.html</div>
                    <div class="title-seo" id="title-seo">{{ $procattwo->translations->title }}</div>
                    <div class="description-seo" id="description-seo">{{ $procattwo->translations->descriptions }}</div>
                    <label>URL danh mục</label>
                    <input type="text" type="text" name="slug" id="slug" value="@if(isset($procattwo->translations->slug)){{ old('slug', $procattwo->translations->slug) }}@else{{ old('slug') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập URL danh mục">
                  </div>
                  <div class="form-group">
                    <label>Tiêu đề ({{ $lang }})</label>
                    <input type="text" name="translation[title]" id="title" value="@if(isset($procattwo->translations->title)){{ old('title', $procattwo->translations->title) }}@else{{ old('title') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tiêu đề danh mục">
                  </div>
                  <div class="form-group">
                    <label>Từ khóa ({{ $lang }})</label>
                    <textarea class="form-control" name="translation[keywords]" id="keywords" value="@if(isset($procattwo->translations->keywords)){{ old('keywords', $procattwo->translations->keywords) }}@else{{ old('keywords') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập từ khoá cho danh mục">@if(isset($procattwo->translations->keywords)){{ old('keywords', $procattwo->translations->keywords) }}@else{{ old('keywords') }}@endif</textarea>
                  </div>
                  <div class="form-group">
                    <label>Mô tả ({{ $lang }})</label>
                    <textarea class="form-control" name="translation[description]" id="description" value="@if(isset($procattwo->translations->description)){{ old('description', $procattwo->translations->description) }}@else{{ old('description') }}@endif" rows="7" data-toggle="tooltip" data-placement="top" title="Nhập mô tả ngắn danh mục">@if(isset($procattwo->translations->description)){{ old('description', $procattwo->translations->description) }}@else{{ old('description') }}@endif</textarea>
                  </div>
                  <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                  <a href="{{ route('backend.procatone.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
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
              <a href="{{ route('backend.procattwo.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
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
                            <a href="{{ route('change.locale', ''.$lang->locale.'') }}" ><span> <i class="{{ $lang->flag }}"></i> {{ $lang->name }} <i class="fas fa-external-link-alt"></i></span></a>
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
                <img class="img-thumbnail mb-2" style="width: 100%; margin-bottom:10px;" src="/storage/uploads/{{ $procattwo->img }}" alt="{{ $procattwo->name }}">
                <input type="file" name="img" class="form-control" value="{{ $procattwo->img }}" data-toggle="tooltip" data-placement="top" title="Dimensions min 500 x 500 (px)">
              </div>
            </div>
          </div>

          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Số thứ tự</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <input type="number" name="stt" id="stt" value="@if(isset($procattwo->stt)){{ old('stt', $procattwo->stt) }}@else{{ old('stt') }}@endif" class="form-control stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>
                <input type="checkbox" name="hide_show" id="hide_show" value="1" {{ $procattwo->hide_show == 1 ? 'checked' : '' }} class="cbc">
                <label class="cbc">Hiển thị</label>
              </label>
            </div>
          </div>
          {{-- <div class="box box-primary">
            <div class="box-header with-border">
              <label>
                <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ $procattwo->is_featured == 1 ? 'checked' : '' }} class="cbc">
                <label class="cbc">Nổi bật</label>
              </label>
            </div>
          </div> --}}
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Thao tác</label>
            </div>
            <div class="box-body">
              <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
              <a href="{{ route('backend.procattwo.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
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
