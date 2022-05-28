@extends('backend.layout.master')
@section('title','Cập nhật tags')
@push('script')
{{-- <script>
  $("#name").keyup(function(){
    $("#title").val(this.value);
  });
</script> --}}
<script>
  $('document').ready(function () {
    $(document).on('change', 'input#slug', function() {
      var slugcat = CreateSlugCat($(this).val());
      $('div#slug-seo').text(window.location.hostname + '/tags/' +slugcat + '.html');
    });
  });

  $(document).on('change', 'textarea#description', function() {
      $("div#description-seo").text(this.value);
  });

  $(document).on('change', 'input#title', function() {
      $("div#title-seo").text(this.value);
  });


  function CreateSlugCat(text)
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
    Chỉnh sửa tag ({{ $lang }})
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a href="{{ route('backend.tag.index') }}">Tags</a></li>
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
    <form method="POST" action="{{ route('backend.tag.update', $tag->id) }}" enctype="multipart/form-data">
      @csrf
      {{ method_field('PUT') }}
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                <label>Tên tag ({{ session('locale') }})</label>
                <input type="text" name="translation[name]" id="name" value="@if(isset($tag->translations->name)){{ old('name', $tag->translations->name) }}@else{{ old('name') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên tag">
              </div>
              <div class="form-group">
                <label for="">Loại</label>
                      <select class="form-control select2" name="type" id="">
                          @if($tag->type == 'post')
                          <option selected value="post">Bài viết</option>
                          <option value="product">Phòng</option>
                          @else
                          <option selected value="product">Phòng</option>
                          <option  value="post">Bài Viết</option>
                          @endif
                      </select>
            </div>
              <div class="form-group">
                <label>Mô tả tag ({{ session('locale') }})</label>
                <textarea class="form-control" name="translation[descriptions]" id="descriptions" value="@if(isset($tag->translations->descriptions)){{ old('descriptions', $tag->translations->descriptions) }}@else{{ old('descriptions') }}@endif" rows="7" data-toggle="tooltip" data-placement="top" title="Nhập mô tả tag">@if(isset($tag->translations->descriptions)){{ old('descriptions', $tag->translations->descriptions) }}@else{{ old('descriptions') }}@endif</textarea>
              </div>

            </div>
              <div class="box-header with-border">
                <h3 class="box-title">Tối ưu hoá tìm kiếm (SEO-{{ session('locale')  }})</h3>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <div class="url-seo" id="slug-seo">{{ url('/') }}/tags/{{ $tag->translations->slug ?? ''}}.html</div>
                  <div class="title-seo" id="title-seo">{{ $tag->translations->title ?? ''}}</div>
                  <div class="description-seo" id="description-seo">{{ $tag->translations->descriptions ?? '' }}</div>
                  <label>URL tag</label>
                  <input type="text" type="text" name="translation[slug]" id="slug" value="@if(isset($tag->translations->slug)){{ old('slug', $tag->translations->slug) }}@else{{ old('slug') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập URL tag">
                </div>
                <div class="form-group">
                  <label>Tiêu đề ({{ session('locale')  }})</label>
                  <input type="text" name="translation[title]" id="title" value="@if(isset($tag->translations->title)){{ old('title', $tag->translations->title) }}@else{{ old('title') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tiêu đề tag">
                </div>
                <div class="form-group">
                  <label>Từ khóa ({{ session('locale')  }})</label>
                  <textarea class="form-control" name="translation[keywords]" id="keywords" value="@if(isset($tag->translations->keywords)){{ old('keywords', $tag->translations->keywords) }}@else{{ old('keywords') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập từ khoá cho tag">@if(isset($tag->translations->keywords)){{ old('keywords', $tag->translations->keywords) }}@else{{ old('keywords') }}@endif</textarea>
                </div>
                <div class="form-group">
                  <label>Mô tả ({{ session('locale')  }})</label>
                  <textarea class="form-control" name="translation[description]" id="description" value="@if(isset($tag->translations->description)){{ old('description', $tag->translations->description) }}@else{{ old('description') }}@endif" rows="7" data-toggle="tooltip" data-placement="top" title="Nhập mô tả ngắn tag">@if(isset($tag->translations->description)){{ old('description', $tag->translations->description) }}@else{{ old('description') }}@endif</textarea>
                </div>
                <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                <a href="{{ route('backend.tag.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
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
              <a href="{{ route('backend.tag.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
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
              <label>Số thứ tự</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <input type="number" name="stt" id="stt" value="@if(isset($tag->stt)){{ old('stt', $tag->stt) }}@else{{ old('stt') }}@endif" min="0" class="form-control stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>
                <input type="checkbox" name="hide_show" id="hide_show" value="1" {{ $tag->hide_show == 1 ? 'checked' : '' }} class="cbc">
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
              <a href="{{ route('backend.tag.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
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
@endphp
