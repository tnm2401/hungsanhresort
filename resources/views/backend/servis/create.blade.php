@extends('backend.layout.master')
@section('title','Thêm dịch vụ')
@push('script')
<script>
  $("#name_vi").keyup(function(){
    $("#title_vi").val(this.value);
    $("#keywords_vi").val(this.value);
    $("#description_vi").val(this.value);
  });
</script>
<script>
  $("#name_en").keyup(function(){
    $("#title_en").val(this.value);
    $("#keywords_en").val(this.value);
    $("#description_en").val(this.value);
  });
</script>
<script>
  $("#name_cn").keyup(function(){
    $("#title_cn").val(this.value);
    $("#keywords_cn").val(this.value);
    $("#description_cn").val(this.value);
  });
</script>
<script>
  $('document').ready(function () {
    $(document).on('change', 'input#name_vi', function() {
      var title1 = ($(this).val());
      $('div#title1').text(title1);
    });
  });
</script>
<script>
  $('document').ready(function () {
    $(document).on('change', 'textarea#descriptions_vi', function() {
      var descriptions = ($(this).val());
      $('div#descriptions1').text(descriptions);
    });
  });
</script>
<script>
  $('document').ready(function () {
    $(document).on('change', 'input#name_en', function() {
      var title1 = ($(this).val());
      $('div#title2').text(title1);
    });
  });
</script>
<script>
  $('document').ready(function () {
    $(document).on('change', 'textarea#descriptions_en', function() {
      var descriptions = ($(this).val());
      $('div#descriptions2').text(descriptions);
    });
  });
</script>
<script>
  $('document').ready(function () {
    $(document).on('change', 'input#name_cn', function() {
      var title1 = ($(this).val());
      $('div#title3').text(title1);
    });
  });
</script>
<script>
  $('document').ready(function () {
    $(document).on('change', 'textarea#descriptions_cn', function() {
      var descriptions = ($(this).val());
      $('div#descriptions3').text(descriptions);
    });
  });
</script>
<script>
  $('document').ready(function () {
    $(document).on('change', 'input#name_vi', function() {
      var slugwm = CreateSlugE($(this).val());
      $('div#slugwm').text('{{ $setting->web }}/'+slugwm+'.html');
    });
  });
  $('document').ready(function () {
    $(document).on('change', 'input#slug', function() {
      var slugwm = CreateSlugE($(this).val());
      $('div#slugwm').text('{{ $setting->web }}/'+slugwm+'.html');
    });
  });
  function CreateSlugE(text)
  {
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
    Thêm mới bài viết
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li>Dịch vụ</li>
      <li><a href="{{ route('backend.servi.index') }}">Quản lý dịch vụ</a></li>
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
    <form id="stringLengthForm" method="POST" action="{{ route('backend.servi.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">🇻🇳 Tiếng Việt</a></li>
              <li><a href="#tab_2" data-toggle="tab">🇬🇧 Tiếng Anh</a></li>
              <li><a href="#tab_3" data-toggle="tab">🇨🇳 Tiếng Trung</a></li>
              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active tab-content-en" id="tab_1">
                <input type="hidden" id="type" name="type" value="service">
                <div class="form-group">
                  <label>Tên bài viết (VI)</label>
                  <input type="text" name="name_vi" id="name_vi" onkeyup="AutoSlug();" value="{{ old('name_vi') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên bài viết (VI)">
                </div>
                <div class="form-group">
                  <label>URL Video Youtube</label>
                  <input type="text" name="video" id="video" value="{{ old('video') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập URL Video Youtube">
                </div>
                <div class="form-group">
                  <label>Mô tả (VI)</label>
                  <textarea class="form-control" name="descriptions_vi" id="descriptions_vi" value="{{ old('descriptions_vi') }}" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả bài viết (VI)">{{ old('descriptions_vi') }}</textarea>
                </div>
                <div class="form-group">
                  <label>Nội dung (VI - Left)</label>
                  <textarea class="form-control" name="content_vi" id="content_vi" rows="3">{!! old('content_vi') !!}</textarea>
                </div>
                <div class="form-group">
                  <label>Nội dung (VI - Right)</label>
                  <textarea class="form-control" name="content1_vi" id="content1_vi" rows="3">{!! old('content1_vi') !!}</textarea>
                </div>
                <label>Tối ưu hoá tìm kiếm (SEO - VI)</label>
                <div class="form-group">
                  <div class="url-seo" id="slugwm"></div>
                  <div class="title-seo" id="title1"></div>
                  <div class="description-seo" id="descriptions1"></div>
                  <label>URL bài viết</label>
                  <input type="text" type="text" name="slug" id="slug" value="{{ old('slug') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập URL bài viết">
                </div>
                <div class="form-group">
                  <label>Title (VI)</label>
                  <input type="text" name="title_vi" id="title_vi" value="{{ old('title_vi') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tiêu đề bài viết (VI)">
                </div>
                <div class="form-group">
                  <label>Keywords (VI)</label>
                  <textarea class="form-control" name="keywords_vi" id="keywords_vi" value="{{ old('keywords_vi') }}" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập từ khoá cho bài viết (VI)">{{ old('keywords_vi') }}</textarea>
                </div>
                <div class="form-group">
                  <label>Description (VI)</label>
                  <textarea class="form-control" name="description_vi" id="description_vi" value="{{ old('description_vi') }}" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả ngắn bài viết (VI)">{{ old('description_vi') }}</textarea>
                </div>
                <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                <a href="{{ route('backend.servi.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
              </div>
              <div class="tab-pane" id="tab_2">
                <div class="form-group">
                  <label>Tên bài viết (EN)</label>
                  <input type="text" name="name_en" id="name_en" value="{{ old('name_en') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên bài viết (EN)">
                </div>
                <div class="form-group">
                  <label>Mô tả (EN)</label>
                  <textarea class="form-control" name="descriptions_en" id="descriptions_en" value="{{ old('descriptions_en') }}" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả bài viết (EN)">{{ old('descriptions_en') }}</textarea>
                </div>
                <div class="form-group">
                  <label>Nội dung (EN - Left)</label>
                  <textarea class="form-control" name="content_en" id="content_en" rows="3">{!! old('content_en') !!}</textarea>
                </div>
                <div class="form-group">
                  <label>Nội dung (EN - Right)</label>
                  <textarea class="form-control" name="content1_en" id="content1_en" rows="3">{!! old('content1_en') !!}</textarea>
                </div>
                <label>Tối ưu hoá tìm kiếm (SEO - EN)</label>
                <div class="form-group">
                  <div class="url-seo" id="slugwm"></div>
                  <div class="title-seo" id="title2"></div>
                  <div class="description-seo" id="descriptions2"></div>
                </div>
                <div class="form-group">
                  <label>Title (EN)</label>
                  <input type="text" name="title_en" id="title_en" value="{{ old('title_en') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tiêu đề bài viết (EN)">
                </div>
                <div class="form-group">
                  <label>Keywords (EN)</label>
                  <textarea class="form-control" name="keywords_en" id="keywords_en" value="{{ old('keywords_en') }}" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập từ khoá cho bài viết (EN)">{{ old('keywords_en') }}</textarea>
                </div>
                <div class="form-group">
                  <label>Description (EN)</label>
                  <textarea class="form-control" name="description_en" id="description_en" value="{{ old('description_en') }}" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả ngắn bài viết (EN)">{{ old('description_en') }}</textarea>
                </div>
                <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                <a href="{{ route('backend.servi.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
              </div>
              <div class="tab-pane" id="tab_3">
                <div class="form-group">
                  <label>Tên bài viết (CN)</label>
                  <input type="text" name="name_cn" id="name_cn" value="{{ old('name_cn') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên bài viết (CN)">
                </div>
                <div class="form-group">
                  <label>Mô tả (CN)</label>
                  <textarea class="form-control" name="descriptions_cn" id="descriptions_cn" value="{{ old('descriptions_cn') }}" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả bài viết (CN)">{{ old('descriptions_cn') }}</textarea>
                </div>
                <div class="form-group">
                  <label>Nội dung (CN - Left)</label>
                  <textarea class="form-control" name="content_cn" id="content_cn" rows="3">{!! old('content_cn') !!}</textarea>
                </div>
                <div class="form-group">
                  <label>Nội dung (CN - Right)</label>
                  <textarea class="form-control" name="content1_cn" id="content1_cn" rows="3">{!! old('content1_cn') !!}</textarea>
                </div>
                <label>Tối ưu hoá tìm kiếm (SEO - CN)</label>
                <div class="form-group">
                  <div class="url-seo" id="slugwm"></div>
                  <div class="title-seo" id="title3"></div>
                  <div class="description-seo" id="descriptions3"></div>
                </div>
                <div class="form-group">
                  <label>Title (CN)</label>
                  <input type="text" name="title_cn" id="title_cn" value="{{ old('title_cn') }}" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tiêu đề bài viết (CN)">
                </div>
                <div class="form-group">
                  <label>Keywords (CN)</label>
                  <textarea class="form-control" name="keywords_cn" id="keywords_cn" value="{{ old('keywords_cn') }}" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập từ khoá cho bài viết (CN)">{{ old('keywords_cn') }}</textarea>
                </div>
                <div class="form-group">
                  <label>Description (CN)</label>
                  <textarea class="form-control" name="description_cn" id="description_cn" value="{{ old('description_cn') }}" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả ngắn bài viết (CN)">{{ old('description_cn') }}</textarea>
                </div>
                <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                <a href="{{ route('backend.servi.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
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
              <a href="{{ route('backend.servi.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Chọn danh mục</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <select class="form-control select2" name="svcategory_id" data-placeholder=" Chọn danh mục"
                  style="width: 100%;">
                  <option value="">Chọn danh mục</option>
                  @foreach ($svcategories as $item)
                  <option value="{{ $item->id }}">{{ $item->name_vi }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Hình ảnh đại diện</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <input type="file" name="img" class="form-control" data-toggle="tooltip" data-placement="top" title="Dimensions min 568 x 330 (px)">
              </div>
            </div>
          </div>
          {{-- <div class="box box-primary">
            <div class="box-header with-border">
              <label>Hình ảnh chi tiết</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <input type="file" name="img1" class="form-control" data-toggle="tooltip" data-placement="top" title="Dimensions min 469 x auto (px)">
              </div>
            </div>
          </div> --}}
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Số thứ tự</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <input type="number" name="stt" id="stt" value="1" min="0" class="form-control stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>
                <input type="checkbox" name="hide_show" id="hide_show" value="1" class="cbc" checked="1">
                <label class="cbc">Hiển thị</label>
              </label>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>
                <input type="checkbox" name="is_featured" id="is_featured" value="1" class="cbc">
                <label class="cbc">Nổi bật</label>
              </label>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Thao tác</label>
            </div>
            <div class="box-body">
              <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
              <a href="{{ route('backend.servi.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
            </div>
          </div>
        </div>
        <!-- right column -->
      </div>
    </section>
  </div>
</form>
@endsection
