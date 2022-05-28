@extends('backend.layout.master')
@section('title','Cập nhật danh mục bài viết cấp 1')
@push('script')
<script>
  $('document').ready(function () {
    $(document).on('change', 'input#slug', function() {
      var slugcat = CreateSlugCat($(this).val());
      $('div#slug-seo').text(window.location.hostname + '/' +slugcat + '.html');
    });
  });

  $(document).on('change', 'textarea#description', function() {
      $("div#description-seo").text(this.value);
  });

  $(document).on('change', 'input#title', function() {
      $("div#title-seo").text(this.value);
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
      Chỉnh sửa Danh mục
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Tin tức</a></li>
      <li><a href="{{ route('backend.newcatone.index') }}">Danh mục Cấp 1</a></li>
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
    <form method="POST" action="{{ route('backend.newcatone.update', $newcatone->id) }}" enctype="multipart/form-data">
      @csrf
      {{ method_field('PUT') }}
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                <label>Tên danh mục ({{ session('locale') }})</label>
                <input type="text" name="translation[name]" id="name" value="@if(isset($newcatone->translations->name)){{ old('name', $newcatone->translations->name) }}@else{{ old('name') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên danh mục">
              </div>
              <div class="form-group">
                <label>Mô tả danh mục ({{ session('locale') }})</label>
                <textarea class="form-control" name="translation[descriptions]" id="descriptions" value="@if(isset($newcatone->translations->descriptions)){{ old('descriptions', $newcatone->translations->descriptions) }}@else{{ old('descriptions') }}@endif" rows="7" data-toggle="tooltip" data-placement="top" title="Nhập mô tả danh mục">@if(isset($newcatone->translations->descriptions)){{ old('descriptions', $newcatone->translations->descriptions) }}@else{{ old('descriptions') }}@endif</textarea>
              </div>
            </div>
              <div class="box-header with-border">
                <h3 class="box-title">Tối ưu hoá tìm kiếm (SEO-{{ session('locale') }})</h3>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <div class="url-seo" id="slug-seo">{{ url('/') }}/{{ $newcatone->translations->slug ?? '' }}.html</div>
                  <div class="title-seo" id="title-seo">{{ $newcatone->translations->title ?? '' }}</div>
                  <div class="description-seo" id="description-seo">{{ $newcatone->translations->descriptions ?? '' }}</div>
                  <label>URL danh mục ({{ session('locale') }})</label>
                  <input type="text" type="text" name="slug" id="slug" value="@if(isset($newcatone->translations->slug)){{ old('slug', $newcatone->translations->slug) }}@else{{ old('slug') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập URL danh mục">
                </div>
                <div class="form-group">
                  <label>Tiêu đề ({{ session('locale') }})</label>
                  <input type="text" name="translation[title]" id="title" value="@if(isset($newcatone->translations->title)){{ old('title', $newcatone->translations->title) }}@else{{ old('title') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tiêu đề danh mục">
                </div>
                <div class="form-group">
                  <label>Từ khóa ({{ session('locale') }})</label>
                  <textarea class="form-control" name="translation[keywords]" id="keywords" value="@if(isset($newcatone->translations->keywords)){{ old('keywords', $newcatone->translations->keywords) }}@else{{ old('keywords') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập từ khoá cho danh mục">@if(isset($newcatone->translations->keywords)){{ old('keywords', $newcatone->translations->keywords) }}@else{{ old('keywords') }}@endif</textarea>
                </div>
                <div class="form-group">
                  <label>Mô tả ({{ session('locale') }})</label>
                  <textarea class="form-control" name="translation[description]" id="description" value="@if(isset($newcatone->translations->description)){{ old('description', $newcatone->translations->description) }}@else{{ old('description') }}@endif" rows="7" data-toggle="tooltip" data-placement="top" title="Nhập mô tả ngắn danh mục">@if(isset($newcatone->translations->description)){{ old('description', $newcatone->translations->description) }}@else{{ old('description') }}@endif</textarea>
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
              <a href="{{ route('backend.newcatone.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
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
                <img class="img-thumbnail mb-2" style="width: 100%; margin-bottom:10px;" src="{{ asset('storage') }}/uploads/{{ $newcatone->img }}" alt="{{ $newcatone->translations->name ?? '' }}">
                <input type="file" name="img" class="form-control" value="{{ $newcatone->img }}" data-toggle="tooltip" data-placement="top" title="Dimensions min 370 x 250 (px)">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Số thứ tự</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <input type="number" name="stt" id="stt" value="@if(isset($newcatone->stt)){{ old('stt', $newcatone->stt) }}@else{{ old('stt') }}@endif" min="0" class="form-control stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>
                <input type="checkbox" name="hide_show" id="hide_show" value="1" {{ $newcatone->hide_show == 1 ? 'checked' : '' }} class="cbc">
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
              <a href="{{ route('backend.newcatone.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
            </div>
          </div>
        </div>
        <!-- right column -->
      </div>
    </section>
  </div>
</form>
@endsection
