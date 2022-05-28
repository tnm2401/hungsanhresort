@extends('backend.layout.master')
@section('title','Cập nhật video')
@push('script')
<script>
  $(document).ready(function($) {
   var videobox = document.getElementById('videobox');
   $('#link').on('keyup', function() {
     if($(this).val() === "") {
   videobox.style.display = "none";
     }else{
   var url =$(this).val();
   var ifrm = document.createElement('iframe');
   ifrm.src = "//www.youtube.com/embed/"+ url.split("=")[1];
   // ifrm.src = (!url.includes('vimeo')) ? "//www.youtube.com/embed/"+ url.split("=")[1] : "//player.vimeo.com/video/"+ url.split("/")[3];
   ifrm.width= "100%";
   ifrm.height = "200";
   ifrm.frameborder="1";
   ifrm.scrolling="no";
   $('#video-preview').html(ifrm);
   videobox.style.display = "block";
     }
    });
  })
</script>
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
      Sửa Video
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a href="{{ route('video.index') }}">Quản lý Media</a></li>
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
    <form id="stringLengthForm" method="POST" action="{{ route('video.update',$video->id) }}" enctype="multipart/form-data">
      @csrf
      {{ method_field('PUT') }}
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <div class="row">
            <div class="col-md-7">
              <div class="box box-primary">
                <div class="box-body">
                  <input type="hidden" id="type" name="type" value="video">
                  <div class="form-group">
                    <label>Tên Video ({{ session('locale') }})</label>
                    <input type="text" name="translation[name]" id="name" value="@if(isset($video->translations->name)){{ old('translation[name]', $video->translations->name) }}@else{{ old('translation[name]') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên Video">
                  </div>
                  <div class="form-group">
                    <label>Danh mục Media</label>
                    <select class="form-control select2 choose videocat" name="videocat" id="videocat" style="width: 100%;">
                      <option value="">Chọn</option>
                      @foreach($videocats as $key => $item)
                      <option value="{{ $item->id }}" {{ ($video->videocat_id == $item->id) ? 'selected' : '' }}>{{ $item->translations->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Link Video Youtube</label>
                    <input type="url" name="link" id="link" placeholder="Video URL" value="@if(isset($video->link)){{ old('link', $video->link) }}@else{{ old('link') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập Link Video Youtube">
                  </div>
                  <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                  <a href="{{ route('video.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <div class="box box-primary">
                <div class="box-body">
                  <div class="form-group">
                    <label>Video hiện tại</label>
                  <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $video->url_code }}"
                      frameborder="0" allowfullscreen></iframe>
                  </div>
                  </div>
                    <div class="form-group">
                      <div id="videobox" style="display: none;">
                        <label>Xem trước Video mới</label>
                          <div class="form-group">
                              <div id="video-preview"></div>
                          </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- left column -->
        <!-- right column -->
        <div class="col-md-3">
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
                <img class="img-thumbnail mb-2" id="picture" style="width: 100%; margin-bottom:10px;" src="/storage/uploads/{{ $video->img }}" alt="{{ $video->name }}">
                <input type="file" name="img" class="form-control" value="{{ $video->img }}" oninput="picture.src=window.URL.createObjectURL(this.files[0])" data-toggle="tooltip" data-placement="top" title="Dimensions min 370 x 250 (px)">
              </div>
            </div>
          </div>
        <div class="box box-primary">
          <div class="box-header with-border">
            <label>Số thứ tự</label>
          </div>
          <div class="box-body">
            <div class="form-group">
              <input type="number" name="stt" id="stt" value="@if(isset($video->stt)){{ old('stt', $video->stt) }}@else{{ old('stt') }}@endif" class="form-control stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự">
            </div>
          </div>
        </div>
        <div class="box box-primary">
          <div class="box-header with-border">
            <label>
              <input type="checkbox" name="hide_show" id="hide_show" value="1" {{ $video->hide_show == 1 ? 'checked' : '' }} class="cbc">
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
          <a href="{{ route('video.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
        </div>
      </div>
    </div>
    <!-- right column -->
  </div>
</section>
</div>
</form>
@endsection
