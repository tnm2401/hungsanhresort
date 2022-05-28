@extends('backend.layout.master')
@section('title','Cập nhật dịch vụ')
@push('script')
<script>
  $("#name_vi").keyup(function(){
    $("#title_vi").val(this.value);
  });
</script>
<script>
  $("#name_en").keyup(function(){
    $("#title_en").val(this.value);
  });
</script>
<script>
  $("#name_cn").keyup(function(){
    $("#title_cn").val(this.value);
  });
</script>
<script>
  $('document').ready(function () {
    $(document).on('change', 'input#slug', function() {
      var slugwb = createslug($(this).val());
      $('div#slugwb').text('{{ route('frontend.home.index')}}/'+slugwb+'.html');
    });
  });
  function createslug(text)
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
    Chỉnh sửa bài viết
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li>Dịch vụ</li>
      <li><a href="{{ route('backend.servi.index') }}">Quản lý dịch vụ</a></li>
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
    <form method="POST" action="{{ route('backend.servi.update', $servi->id) }}" enctype="multipart/form-data">
      @csrf
      {{ method_field('PUT') }}
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
                  <input type="text" name="name_vi" id="name_vi" value="@if(isset($servi->name_vi)){{ old('name_vi', $servi->name_vi) }}@else{{ old('name_vi') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên bài viết (VI)">
                </div>
                <div class="form-group">
                  <label>URL Video Youtube</label>
                  <input type="text" name="video" id="video" value="@if(isset($servi->video)){{ old('video', $servi->video) }}@else{{ old('video') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập URL Video Youtube">
                </div>
                <div class="form-group">
                  <label>Mô tả (VI)</label>
                  <textarea class="form-control" name="descriptions_vi" id="descriptions_vi" value="@if(isset($servi->descriptions_vi)){{ old('descriptions_vi', $servi->descriptions_vi) }}@else{{ old('descriptions_vi') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả bài viết (VI)">@if(isset($servi->descriptions_vi)){{ old('descriptions_vi', $servi->descriptions_vi) }}@else{{ old('descriptions_vi') }}@endif</textarea>
                </div>
                <div class="form-group">
                  <label>Nội dung (VI - Left)</label>
                  <textarea class="form-control" name="content_vi" id="content_vi" rows="3">@if(isset($servi->content_vi)){{ old('content_vi', $servi->content_vi) }}@else{{ old('content_vi') }}@endif</textarea>
                </div>
                <div class="form-group">
                  <label>Nội dung (VI - Right)</label>
                  <textarea class="form-control" name="content1_vi" id="content1_vi" rows="3">@if(isset($servi->content1_vi)){{ old('content1_vi', $servi->content1_vi) }}@else{{ old('content1_vi') }}@endif</textarea>
                </div>
                <label class="box-title">Tối ưu hoá tìm kiếm (SEO - VI)</label>
                <div class="form-group">
                  <div class="url-seo" id="slugwb">{{ $setting->web }}/{{ $servi->slug }}.html</div>
                  <div class="title-seo" id="title1">{{ $servi->title_vi }}</div>
                  <div class="description-seo" id="descriptions1">{{ $servi->description_vi }}</div>
                  <label>URL bài viết</label>
                  <input type="text" type="text" name="slug" id="slug" value="@if(isset($servi->slug)){{ old('slug', $servi->slug) }}@else{{ old('slug') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập URL bài viết">
                </div>
                <div class="form-group">
                  <label>Title (VI)</label>
                  <input type="text" name="title_vi" id="title_vi" value="@if(isset($servi->title_vi)){{ old('title_vi', $servi->title_vi) }}@else{{ old('title_vi') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tiêu đề bài viết (VI)">
                </div>
                <div class="form-group">
                  <label>Keywords (VI)</label>
                  <textarea class="form-control" name="keywords_vi" id="keywords_vi" value="@if(isset($servi->keywords_vi)){{ old('keywords_vi', $servi->keywords_vi) }}@else{{ old('keywords_vi') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập từ khoá cho bài viết (VI)">@if(isset($servi->keywords_vi)){{ old('keywords_vi', $servi->keywords_vi) }}@else{{ old('keywords_vi') }}@endif</textarea>
                </div>
                <div class="form-group">
                  <label>Description (VI)</label>
                  <textarea class="form-control" name="description_vi" id="description_vi" value="@if(isset($servi->description_vi)){{ old('description_vi', $servi->description_vi) }}@else{{ old('description_vi') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả ngắn bài viết (VI)">@if(isset($servi->description_vi)){{ old('description_vi', $servi->description_vi) }}@else{{ old('description_vi') }}@endif</textarea>
                </div>
                <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                <a href="{{ route('backend.servi.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
              </div>
              <div class="tab-pane" id="tab_2">
                <input type="hidden" id="type" name="type" value="service">
                <div class="form-group">
                  <label>Tên bài viết (EN)</label>
                  <input type="text" name="name_en" id="name_en" value="@if(isset($servi->name_en)){{ old('name_en', $servi->name_en) }}@else{{ old('name_en') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên bài viết (EN)">
                </div>
                <div class="form-group">
                  <label>Mô tả (EN)</label>
                  <textarea class="form-control" name="descriptions_en" id="descriptions_en" value="@if(isset($servi->descriptions_en)){{ old('descriptions_en', $servi->descriptions_en) }}@else{{ old('descriptions_en') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả bài viết (EN)">@if(isset($servi->descriptions_en)){{ old('descriptions_en', $servi->descriptions_en) }}@else{{ old('descriptions_en') }}@endif</textarea>
                </div>
                <div class="form-group">
                  <label>Nội dung (EN - Left)</label>
                  <textarea class="form-control" name="content_en" id="content_en" rows="3">@if(isset($servi->content_en)){{ old('content_en', $servi->content_en) }}@else{{ old('content_en') }}@endif</textarea>
                </div>
                <div class="form-group">
                  <label>Nội dung (EN - Right)</label>
                  <textarea class="form-control" name="content1_en" id="content1_en" rows="3">@if(isset($servi->content1_en)){{ old('content1_en', $servi->content1_en) }}@else{{ old('content1_en') }}@endif</textarea>
                </div>
                <label class="box-title">Tối ưu hoá tìm kiếm (SEO - EN)</label>
                <div class="form-group">
                  <div class="url-seo" id="slugwb">{{ $setting->web }}/{{ $servi->slug }}.html</div>
                  <div class="title-seo" id="title2">{{ $servi->title_en }}</div>
                  <div class="description-seo" id="descriptions2">{{ $servi->description_en }}</div>
                </div>
                <div class="form-group">
                  <label>Title (EN)</label>
                  <input type="text" name="title_en" id="title_en" value="@if(isset($servi->title_en)){{ old('title_en', $servi->title_en) }}@else{{ old('title_en') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tiêu đề bài viết (EN)">
                </div>
                <div class="form-group">
                  <label>Keywords (EN)</label>
                  <textarea class="form-control" name="keywords_en" id="keywords_en" value="@if(isset($servi->keywords_en)){{ old('keywords_en', $servi->keywords_en) }}@else{{ old('keywords_en') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập từ khoá cho bài viết (EN)">@if(isset($servi->keywords_en)){{ old('keywords_en', $servi->keywords_en) }}@else{{ old('keywords_en') }}@endif</textarea>
                </div>
                <div class="form-group">
                  <label>Description (EN)</label>
                  <textarea class="form-control" name="description_en" id="description_en" value="@if(isset($servi->description_en)){{ old('description_en', $servi->description_en) }}@else{{ old('description_en') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả ngắn bài viết (EN)">@if(isset($servi->description_en)){{ old('description_en', $servi->description_en) }}@else{{ old('description_en') }}@endif</textarea>
                </div>
                <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                <a href="{{ route('backend.servi.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
              </div>
              <div class="tab-pane" id="tab_3">
                <input type="hidden" id="type" name="type" value="service">
                <div class="form-group">
                  <label>Tên bài viết (CN)</label>
                  <input type="text" name="name_cn" id="name_cn" value="@if(isset($servi->name_cn)){{ old('name_cn', $servi->name_cn) }}@else{{ old('name_cn') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên bài viết (CN)">
                </div>
                <div class="form-group">
                  <label>Mô tả (CN)</label>
                  <textarea class="form-control" name="descriptions_cn" id="descriptions_cn" value="@if(isset($servi->descriptions_cn)){{ old('descriptions_cn', $servi->descriptions_cn) }}@else{{ old('descriptions_cn') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả bài viết (CN)">@if(isset($servi->descriptions_cn)){{ old('descriptions_cn', $servi->descriptions_cn) }}@else{{ old('descriptions_cn') }}@endif</textarea>
                </div>
                <div class="form-group">
                  <label>Nội dung (CN - Left)</label>
                  <textarea class="form-control" name="content_cn" id="content_cn" rows="3">@if(isset($servi->content_cn)){{ old('content_cn', $servi->content_cn) }}@else{{ old('content_cn') }}@endif</textarea>
                </div>
                <div class="form-group">
                  <label>Nội dung (CN - Right)</label>
                  <textarea class="form-control" name="content1_cn" id="content1_cn" rows="3">@if(isset($servi->content1_cn)){{ old('content1_cn', $servi->content1_cn) }}@else{{ old('content1_cn') }}@endif</textarea>
                </div>
                <label class="box-title">Tối ưu hoá tìm kiếm (SEO - CN)</label>
                <div class="form-group">
                  <div class="url-seo" id="slugwb">{{ $setting->web }}/{{ $servi->slug }}.html</div>
                  <div class="title-seo" id="title3">{{ $servi->title_cn }}</div>
                  <div class="description-seo" id="descriptions3">{{ $servi->description_cn }}</div>
                </div>
                <div class="form-group">
                  <label>Title (CN)</label>
                  <input type="text" name="title_cn" id="title_cn" value="@if(isset($servi->title_cn)){{ old('title_cn', $servi->title_cn) }}@else{{ old('title_cn') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tiêu đề bài viết (CN)">
                </div>
                <div class="form-group">
                  <label>Keywords (CN)</label>
                  <textarea class="form-control" name="keywords_cn" id="keywords_cn" value="@if(isset($servi->keywords_cn)){{ old('keywords_cn', $servi->keywords_cn) }}@else{{ old('keywords_cn') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập từ khoá cho bài viết (CN)">@if(isset($servi->keywords_cn)){{ old('keywords_cn', $servi->keywords_cn) }}@else{{ old('keywords_cn') }}@endif</textarea>
                </div>
                <div class="form-group">
                  <label>Description (CN)</label>
                  <textarea class="form-control" name="description_cn" id="description_cn" value="@if(isset($servi->description_cn)){{ old('description_cn', $servi->description_cn) }}@else{{ old('description_cn') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả ngắn bài viết (EN)">@if(isset($servi->description_cn)){{ old('description_cn', $servi->description_cn) }}@else{{ old('description_cn') }}@endif</textarea>
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
              <select class="form-control select2 choose" name="svcategory_id" id="svcategory_id">
                <option value="">Chọn danh mục</option>
                @foreach($svcategories as $key => $item)
                <option value="{{ $item->id }}" {{ ($servi->svcategory_id == $item->id) ? 'selected' : '' }}>{{ $item->name_vi }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Hình ảnh đại diện</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <img class="img-thumbnail mb-2" style="width: 100%; margin-bottom:10px;" src="/storage/uploads/{{ $servi->img }}" alt="{{ $servi->name }}">
                <input type="file" name="img" class="form-control" value="{{ $servi->img }}" data-toggle="tooltip" data-placement="top" title="Dimensions min 568 x 330 (px)">
              </div>
            </div>
          </div>
          {{-- <div class="box box-primary">
            <div class="box-header with-border">
              <label>Hình ảnh chi tiết</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <img class="img-thumbnail mb-2" style="width: 100%; margin-bottom:10px;" src="/storage/uploads/{{ $servi->img1 }}" alt="{{ $servi->name_vi }}">
                <input type="file" name="img1" class="form-control" value="{{ $servi->img1 }}" data-toggle="tooltip" data-placement="top" title="Dimensions min 469 x auto (px)">
              </div>
            </div>
          </div> --}}
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Số thứ tự</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <input type="number" name="stt" id="stt" min="0" value="@if(isset($servi->stt)){{ old('stt', $servi->stt) }}@else{{ old('stt') }}@endif" class="form-control stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>
                <input type="checkbox" name="hide_show" id="hide_show" value="1" {{ $servi->hide_show == 1 ? 'checked' : '' }} class="cbc">
                <label class="cbc">Hiển thị</label>
              </label>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>
                <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ $servi->is_featured == 1 ? 'checked' : '' }} class="cbc">
                <label class="cbc" style="margin-left: 10px;">Nổi bật</label>
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
