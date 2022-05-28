@extends('backend.layout.master')
@section('title','Thêm danh mục cấp 3')
@push('script')
@foreach($language as $lang)

<script>

    $("#name_{{ $lang->locale }}").keyup(function() {
        $("#title_{{ $lang->locale }}").val(this.value);
        $("div#title{{ $lang->locale }}").text(this.value);
        $("#keywords_{{ $lang->locale }}").val(this.value);
        $("#description_{{ $lang->locale }}").val(this.value);
        $("#descriptions_{{ $lang->locale }}").val(this.value);
        $("#des_{{ $lang->locale }}").val(this.value);

    });
    $(document).on('change', 'textarea#des_{{ $lang->locale }}', function() {
        var des1 = ($(this).val());
        $('div#description{{ $lang->locale }}').text(des1);
    });

    $(document).on('change', 'input#name_{{ $lang->locale }}', function() {
        var title1 = ($(this).val());
        $('div#description{{ $lang->locale }}').text(title1);
    });

    $(document).on('change', 'textarea#des_{{ $lang->locale }}', function() {
        var des1 = ($(this).val());
        $('div#description{{ $lang->locale }}').text(des1);
    });

    $(document).on('change', 'input#name_{{ $lang->locale }}', function() {
        var slug1 = createslug($(this).val());
        $('div#slug{{ $lang->locale }}').text(window.location.hostname + '/' + slug1 + '.html');
    });

    $('document').ready(function() {
        $(document).on('change', 'input#slug', function() {
            var slug1 = createslug($(this).val());
            $('div#slug1').text('{{ url('/') }}/danh-muc/' + slug1 + '.html');
        });
    });
</script>
@endforeach
<script>
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
<script>
  $(document).ready(function(){
    $('.choose').on('change',function(){
      var action  = $(this).attr('id');
      var code_id = $(this).val();
      var _token  = $('input[name="_token"]').val();
      var result  = '';
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
    Thêm mới Danh mục
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Sản phẩm</a></li>
      <li><a href="{{ route('backend.procatthree.index') }}">Danh mục Cấp 3</a></li>
      <li class="active">Thêm mới</li>
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
    <form method="POST" action="{{ route('backend.procatthree.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="row">

        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    @foreach ($language as $lang)
                    <li class="{{ $loop->first ? 'active' : '' }}"><a href="#tab_{{ $lang->locale }}"  data-toggle="tab">
                                <span class="{{ $lang->flag }}"></span> {{ $lang->name }}
                                ({{ $lang->locale }})</a></li>

                    @endforeach
                    <li class="pull-right"><a href="#" class="text-muted"><i
                                class="fa fa-gear"></i></a></li>
                </ul>
                <div class="tab-content">
                    @foreach($language as $key => $lang)
                    <div class="tab-pane {{$loop->first ? 'in active' : ''}} tab-content-en" id="tab_{{$lang->locale}}">
                                <div class="form-group">
                                    <label>Tên danh mục ({{ $lang->locale }})</label>
                                    <input type="text" name="translation[{{$key}}][name]" id="name_{{ $lang->locale }}" onkeyup="AutoSlug();"
                                        data-length=120 value="{{ old('translation['.$key.'][name]') }}" class="form-control"
                                        data-toggle="tooltip" data-placement="top" title="Nhập tên danh mục">
                                </div>
                                @if($loop->first)
                                <label>Danh mục cấp 1</label>
                                <div class="form-group">
                                    <select class="form-control choose procatone select2"  name="procatone" id="procatone"
                                        data-placeholder=" Chọn danh mục cấp 1" style="width: 100%;">
                                        <option value=""> Chọn danh mục cấp 1</option>
                                        @foreach ($procatones as $procatone)
                                            <option value="{{ $procatone->id }}"> {{ $procatone->translations->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <label>Danh mục cấp 2</label>
                                <div class="form-group">
                                  <select class="form-control select2 choose procattwo" name="procattwo" id="procattwo"
                                        data-placeholder=" Chọn danh mục cấp 1 trước" style="width: 100%;">

                                    </select>
                                </div>
                                @else
                                @endif
                                <div class="form-group">
                                    <label>Mô tả danh mục {{ $lang->locale }}</label>
                                    <textarea class="form-control" name="translation[{{$key}}][descriptions]" id="descriptions_{{ $lang->locale }}"
                                        data-length=400 value="{{ old('descriptions_'.$lang->locale) }}" rows="3"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Nhập mô tả danh mục"></textarea>
                                </div>
                            <div class="box-header with-border">
                                <h3 class="box-title">Tối ưu hoá tìm kiếm (SEO-{{ $lang->locale }})</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <div class="url-seo" id="slug{{ $lang->locale }}"></div>
                                <div class="title-seo" id="title{{ $lang->locale }}"></div>
                                <div class="description-seo" id="description{{ $lang->locale }}"></div>
                                    <label>URL danh mục</label>
                                    <medium class="charcounter-slug" id="charcounter-slug"></medium>
                                    <input type="text" type="text" name="translation[{{$key}}][slug]" id="slug_{{ $lang->locale }}" data-length=120
                                        value="{{ old('slug'.$lang->locale) }}" class="form-control"
                                        data-toggle="tooltip" data-placement="top" title="Nhập URL danh mục">
                                </div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <medium class="charcounter-title" id="charcounter-title"></medium>
                                    <input type="text" name="translation[{{$key}}][title]" id="title_{{ $lang->locale }}" data-length=120
                                        value="{{ old('title_'.$lang->locale) }}" class="form-control"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Nhập tiêu đề danh mục">
                                </div>
                                <div class="form-group">
                                    <label>Từ khóa ({{ $lang->locale }})</label>
                                    <medium class="charcounter-keywords" id="charcounter-keywords"></medium>
                                    <textarea class="form-control" name="translation[{{$key}}][keywords]" id="keywords_{{ $lang->locale }}"
                                        data-length=400 value="{{ old('keywords_'.$lang->locale) }}" rows="3"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Nhập từ khoá cho danh mục"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả ({{ $lang->locale }})</label>
                                    <medium class="charcounter-description" id="charcounter-description">
                                    </medium>
                                    <textarea class="form-control" name="translation[{{$key}}][description]" id="des_{{ $lang->locale }}"
                                        data-length=400 value="{{ old('description_'.$lang->locale) }}" rows="3"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Nhập mô tả ngắn danh mục"></textarea>
                                </div>
                                <div hidden class="form-group">
                                    <label>Locale ({{$lang->locale}})</label>
                                    <input type="text" class="form-control" name="translation[{{$key}}][locale]" value="{{$lang->locale}}">
                                </div>
                            </div>
                    </div>
                    @endforeach

                    <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                    <a href="{{ route('backend.svcategory.index') }}" class="btn btn-danger"><i
                            class="fa fa-times-circle"></i> Thoát</a>
                </div>
            </div>
        </div>
        <!-- right column -->
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <label>Thao tác</label>
                </div>
                <div class="box-body">
                    <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                    <a href="{{ route('backend.procattwo.index') }}" class="btn btn-danger"><i
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
                            data-placement="top" title="Dimensions min 500 x 500 (px)">
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
                    <label>Thao tác</label>
                </div>
                <div class="box-body">
                    <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                    <a href="{{ route('backend.procattwo.index') }}" class="btn btn-danger"><i
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
@php
function showCategories($productcategories, $parent_id = 0, $char = '')
{
    foreach ($productcategories as $key => $item)
    {
        // Nếu là chuyên mục con thì hiển thị
        if ($item->parent_id == $parent_id)
        {
            echo '<option value="'.$item->id.'">'.$char.$item->name.'</option>';
            // Xóa chuyên mục đã lặp
            unset($productcategories[$key]);

            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showCategories($productcategories, $item->id, $char.'—');
        }
    }
}
@endphp
