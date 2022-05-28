@extends('backend.layout.master')
@section('title','Cập nhật danh mục cấp 3')
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
<script>
  $(document).ready(function(){
    $('.choose').on('change',function(){
      var action  = $(this).attr('id');
      var code_id = $(this).val();
      var _token  = $('input[name="_token"]').val();
      var result  = '';
      // alert(action);
      // alert(code_id);
      // alert(_token);
      if (action == 'procatone'){
        result = 'procattwo';
      }else{
        result = 'procatthree';
      }
      $.ajax({
        url : '{{ route('backend.procatthree.select') }}',
        method : 'POST',
        data: {action:action,code_id:code_id,_token:_token},
        success:function(data){
          $('#'+result).html(data);
        }
      });
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
      Chỉnh sửa Danh mục
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Sản phẩm</a></li>
      <li><a href="{{ route('backend.procatthree.index') }}">Danh mục Cấp 3</a></li>
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
    <form method="POST" action="{{ route('backend.procatthree.update', $procatthree->id) }}" enctype="multipart/form-data">
      @csrf
      {{ method_field('PUT') }}
      <div class="row">
        <!-- left column -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body">
              <input type="hidden" id="type" name="type" value="productcategory">
              <div class="form-group">
                <label>Tên danh mục ({{ session('locale') }})</label>
                <input type="text" name="translation[name]" id="name" data-length=120 value="@if(isset($procatthree->translations->name)){{ old('name', $procatthree->translations->name) }}@else{{ old('name') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tên danh mục">
              </div>
              <label>Danh mục Cấp 1</label>
              <div class="form-group">
                  <select class="form-control select2 choose procatone" name="procatone" id="procatone" data-placeholder=" Chọn danh mục cấp 1" style="width: 100%;">
                    <option value=""> Chọn danh mục</option>
                    @foreach ($procatones as $procatone)
                      <option value="{{ $procatone->id }}" {{ ($procatone->id == $procatthree->procatone_id) ? 'selected' : ''  }}> {{ $procatone->translations->name }}</option>
                    @endforeach
                  </select>
              </div>
              <label>Danh mục Cấp 2</label>
              <div class="form-group">
                  <select class="form-control select2 choose procattwo" name="procattwo" id="procattwo" data-placeholder=" Chọn danh mục cấp 1"
                    style="width: 100%;">
                    <option value=""> Chọn danh mục</option>
                    @foreach ($procattwos as $procattwo)
                      <option value="{{ $procattwo->id }}" {{ ($procattwo->id == $procatthree->procattwo_id) ? 'selected' : ''  }}> {{ $procattwo->translations->name }}</option>
                    @endforeach
                  </select>
              </div>
              <div class="form-group">
                <label>Mô tả danh mục ({{ session('locale') }})</label>
                <textarea class="form-control" name="translation[descriptions]" id="descriptions" data-length=400 value="@if(isset($procatthree->translations->descriptions)){{ old('descriptions', $procatthree->translations->descriptions) }}@else{{ old('descriptions') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả danh mục">@if(isset($procatthree->translations->descriptions)){{ old('descriptions', $procatthree->translations->descriptions) }}@else{{ old('descriptions') }}@endif</textarea>
              </div>
            </div>
              <div class="box-header with-border">
                <h3 class="box-title">Tối ưu hoá tìm kiếm (SEO - {{ $lang }})</h3>
              </div>
              <div class="box-body">
                <div class="form-group">

                  <div class="url-seo" id="slug-seo">{{ url('/') }}/{{ $procatthree->translations->slug }}.html</div>
                  <div class="title-seo" id="title-seo">{{ $procatthree->translations->title }}</div>
                  <div class="description-seo" id="description-seo">{{ $procatthree->translations->descriptions }}</div>
                  <label>URL danh mục ({{ session('locale') }})</label>
                  <input type="text" type="text" name="translation[slug]" id="slug" data-length=120 value="@if(isset($procatthree->translations->slug)){{ old('slug', $procatthree->translations->slug) }}@else{{ old('slug') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập URL danh mục">
                </div>
                <div class="form-group">
                  <label>Tiêu đề ({{ session('locale') }})</label>
                  <input type="text" name="title" id="translation[title]" data-length=120 value="@if(isset($procatthree->translations->title)){{ old('title', $procatthree->translations->title) }}@else{{ old('title') }}@endif" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhập tiêu đề danh mục">
                </div>
                <div class="form-group">
                  <label>Từ khóa ({{ session('locale') }})</label>
                  <textarea class="form-control" name="translation[keywords]" id="keywords" data-length=400 value="@if(isset($procatthree->translations->keywords)){{ old('keywords', $procatthree->translations->keywords) }}@else{{ old('keywords') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập từ khoá cho danh mục">@if(isset($procatthree->translations->keywords)){{ old('keywords', $procatthree->translations->keywords) }}@else{{ old('keywords') }}@endif</textarea>
                </div>
                <div class="form-group">
                  <label>Mô tả ({{ session('locale') }})</label>
                  <textarea class="form-control" name="translation[description]" id="description" data-length=400 value="@if(isset($procatthree->translations->description)){{ old('description', $procatthree->translations->description) }}@else{{ old('description') }}@endif" rows="3" data-toggle="tooltip" data-placement="top" title="Nhập mô tả ngắn danh mục">@if(isset($procatthree->translations->description)){{ old('description', $procatthree->translations->description) }}@else{{ old('description') }}@endif</textarea>
                </div>

                <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                <a href="{{ route('backend.procatthree.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
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
              <a href="{{ route('backend.procatthree.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
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
                <img class="img-thumbnail mb-2" style="max-width: 100px; margin-bottom:10px;" src="{{ asset('storage') }}/uploads/{{ $procatthree->img }}" alt="{{ $procatthree->name }}">
                <input type="file" name="img" class="form-control" value="{{ $procatthree->img }}" data-toggle="tooltip" data-placement="top" title="Dimensions min 370 x 250 (px)">
              </div>
            </div>
          </div>
          {{-- <div class="box box-primary">
            <div class="box-header with-border">
              <label>Trạng thái</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <select class="form-control select2" name="status" style="width: 100%;">
                  @php
                  if ($procatthree->status == 'Published') {
                    echo '<option value="Published" selected>Xuất bản</option>';
                    echo '<option value="Pending">Chờ duyệt</option>';
                  }else {
                    echo '<option value="Pending" selected>Chờ duyệt</option>';
                    echo '<option value="Published">Xuất bản</option>';
                  }
                  @endphp
                </select>
              </div>
            </div>
          </div> --}}
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Số thứ tự</label>
            </div>
            <div class="box-body">
              <div class="form-group">
                <input type="number" name="stt" id="stt" value="@if(isset($procatthree->stt)){{ old('stt', $procatthree->stt) }}@else{{ old('stt') }}@endif" class="form-control stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự">
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>
                <input type="checkbox" name="hide_show" id="hide_show" value="1" {{ $procatthree->hide_show == 1 ? 'checked' : '' }} class="minimal"><span style="margin-left: 10px;">Hiển thị</span>
              </label>
            </div>
          </div>
          {{-- <div class="box box-primary">
            <div class="box-header with-border">
              <label>
                <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ $procatthree->is_featured == 1 ? 'checked' : '' }} class="minimal"><span style="margin-left: 10px;">Nổi bật</span>
              </label>
            </div>
          </div> --}}
          <div class="box box-primary">
            <div class="box-header with-border">
              <label>Thao tác</label>
            </div>
            <div class="box-body">
              <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
              <a href="{{ route('backend.procatthree.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
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
    foreach ($productcategories as $key => $item)
    {
        // Nếu là chuyên mục con thì hiển thị
        if ($item->parent_id == $parent_id)
        {

            if ($item->id == $selected) {
              echo '<option selected value="'.$item->id.'">'.$char.$item->name.'</option>';
            } else {
              echo '<option value="'.$item->id.'">'.$char.$item->name.'</option>';
            }

            // Xóa chuyên mục đã lặp
            unset($productcategories[$key]);

            showCategories($productcategories,$selected, $item->id, $char.'—');
        }
    }
}
@endphp
