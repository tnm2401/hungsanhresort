@extends('backend.layout.master')
@section('title','Cập nhật dịch vụ phòng')
@push('script')

@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
    CẬP NHẬT DỊCH VỤ PHÒNG
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Phòng</a></li>
      <li><a href="{{ route('backend.serviceroom.index') }}">Dịch vụ phòng</a></li>
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
    <form method="POST" action="{{ route('backend.serviceroom.update', $serviceroom->id) }}" enctype="multipart/form-data">
      @csrf
      {{ method_field('PUT') }}
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-body">
              <div class="form-group">
                <label>Tên danh mục </label>
                <input type="text" class="form-control" name="name" value = "{{ $serviceroom->name }}" >
              </div>
              <div class="form-group">
                <label>Hình ảnh </label>
                <img id="pic" class="img-thumbnail mb-2" style="width: 100%; margin-bottom:10px;"
                src="{{ asset('storage') }}/uploads/serviceroom/{{ $serviceroom->img }}"
                alt="{{ $serviceroom->name }}">
            <input  oninput="pic.src=window.URL.createObjectURL(this.files[0])"
            type="file" name="img" class="form-control" value="{{ $serviceroom->img }}"
                data-toggle="tooltip" data-placement="top" title="Dimensions min 500 x 500 (px)">
              </div>
              <div class="form-group">
                <label>Giá tiền </label>
                <input type="text" class="form-control" name="price" value = "{{ $serviceroom->price }}" >
              </div>
              <div class="form-group">
                <label>Đơn vị tính </label>
                <input type="text" class="form-control" name="unit" value = "{{ $serviceroom->unit }}" >
              </div>
              <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
              <a href="{{ route('backend.serviceroom.index') }}" class="btn btn-danger"><i class="fa fa-times-circle"></i> Thoát</a>
          </div>
        </div>


          </div>
        </div>
        <!-- right column -->
      </div>
    </section>
  </div>
</form>
@endsection

