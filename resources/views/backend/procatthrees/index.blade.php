@extends('backend.layout.master')
@section('title','Quản lí danh mục cấp 3')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
      Quản lý Danh mục
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Sản phẩm</a></li>
      <li><a href="{{ route('backend.procatthree.index') }}">Danh mục Cấp 3</a></li>
      <li class="active">Tất cả</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-body">
            <table id="procatthrees" class="table table-bordered table-striped set__width">
              <a href="{{ route('backend.procatthree.create') }}" class="btn btn-primary new-custom"><i class="fa fa-plus"></i> Thêm mới</a>
              <a href="#" class="btn btn-danger delete-all new-custom" style="margin-left: 3px;"><i class="fa fa-trash"></i> Xoá chọn</a>
              <thead>
                <tr>
                  <th>
                    <label style="margin-bottom: 0px">
                      <input type="checkbox" id="selectall">
                    </label>
                  </th>
                  <th>STT</th>
                  <th style="max-width:200px">
                    <div class="form-group">
                      <select class="form-control select2 choose procatone" name="procatone" id="procatone" style="max-width: 100%;">
                        <option value="">Chọn danh mục cấp 1</option>
                        @foreach($procatones as $key => $procatone)
                        <option value="{{ $procatone->translations->name }}" data-id="{{ $procatone->id }}">{{ $procatone->translations->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </th>
                  <th style="max-width:200px">
                    <div class="form-group">
                      <select class="form-control select2 choose procattwo" name="procattwo" id="procattwo" style="max-width: 100%;">
                        <option value="">Chọn danh mục cấp 2</option>
                      </select>
                    </div>
                  </th>
                  <th style="max-width:200px">Tên danh mục</th>
                  {{-- <th>Ngày cập nhật</th> --}}
                  <th>Hiển thị</th>
                  {{-- <th>Hiển thị menu</th> --}}
                  {{-- <th>Trạng thái</th> --}}
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach($procatthrees as $procatthree)
                <tr>
                <td>
                  <label>
                    <input type="checkbox" class="checkbox" data-id="{{ $procatthree->id }}">
                  </label>
                </td>
                <td>
                  <div class="form-group">
                    <input type="text" data-id="{{ $procatthree->id }}" value="@if(isset($procatthree->stt)){{ old('stt', $procatthree->stt) }}@else{{ old('stt') }}@endif" class="stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự" style="max-width: 50px; text-align: center">
                  </div>
                </td>
                <td>
                  {{ $procatthree->procatone->translations->name ?? '' }}
                </td>
                <td>
                  {{ $procatthree->procattwo->translations->name ?? ''}}
                </td>
                <td>{{ $procatthree->translations->name ?? '' }}</td>
                <td>
                  <input data-id="{{ $procatthree->id }}" class="hide_show" type="checkbox" data-on="<i class='fa fa-check'></i>" data-off="<i class='fa fa-times'></i>" {{ $procatthree->hide_show ? 'checked' : '' }} data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-style="ios" data-size="mini">
                </td>
                <td>
                  <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Sửa danh mục" href="{{ route('backend.procatthree.edit', $procatthree->id ) }}"><i class="fa fa-edit"></i></a>
                  <form method="POST" action="{{ route('backend.procatthree.destroy', $procatthree->id) }}"  style="display: inline;">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button class="btn btn-danger del-confirm" data-toggle="tooltip" data-placement="top" title="Xoá danh mục"><i class="fa fa-trash"></i></button>
                  </form>
                </td>
                {{-- @php
                  recursveTable ($productcategories);
                @endphp --}}
                </tr>
                @endforeach
              </tbody>
            </table>
            <a href="{{ route('backend.procatthree.create') }}" class="btn btn-primary new-custom"><i class="fa fa-plus"></i> Thêm mới</a>
            <a href="#" class="btn btn-danger delete-all new-custom"><i class="fa fa-trash"></i> Xoá chọn</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
@push("script")
<script>
  function switchChange(){
    $('#procatthrees').on('change','input[class="hide_show"]',function(){
      var hide_show = $(this).prop('checked') == true ? 1 : 0;
      var procatthree_id = $(this).data('id');
      $.ajax({
        type: "GET",
        dataType: "json",
        url: '{{ route('backend.procatthree.hideshow') }}',
        data: {'hide_show': hide_show, 'procatthree_id': procatthree_id},
          success: function(data){
          // console.log(data.success)
        }
      });
    })
  }
  $(document).ready(function(){
    switchChange();
    $('.choose').on('change',function(){
      var action  = $(this).attr('id');
      // var code_id = $(this).val();
      var code_id = $(this).find(':selected').data('id');
      var _token  = $('input[name="_token"]').val();
      var result  = '';
      if (action == 'procatone'){
        result = 'procattwo';
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

    // $(function(){
    //   $('#products').on('change','input[class="is_featured"]',function(){
    //     var is_featured = $(this).prop('checked') == true ? 1 : 0;
    //     var product_id = $(this).data('id');
    //     $.ajax({
    //       type: "GET",
    //       dataType: "json",
    //       url: '{{ route('backend.product.isfeatured') }}',
    //       data: {'is_featured': is_featured, 'product_id': product_id},
    //       success: function(data){
    //         console.log(data.success)
    //       }
    //     });
    //   })
    // })

    // $(function(){
    //   $('#products').on('change','input[class="is_new"]',function(){
    //     var is_new = $(this).prop('checked') == true ? 1 : 0;
    //     var product_id = $(this).data('id');
    //     $.ajax({
    //       type: "GET",
    //       dataType: "json",
    //       url: '{{ route('backend.product.isnew') }}',
    //       data: {'is_new': is_new, 'product_id': product_id},
    //       success: function(data){
    //         console.log(data.success)
    //       }
    //     });
    //   })
    // })

    $(function(){
      $('#procatthrees').on( 'change', 'input[class="stt"]', function () {
        var stt = $(this).val();
        var procatthree_id = $(this).data('id');
        $.ajax({
          type: "GET",
          dataType: "json",
          url: '{{ route('backend.procatthree.changestt') }}',
          data: {'stt': stt, 'procatthree_id': procatthree_id},
          success: function(data){
            // console.log(data.success)
          }
        });
      })
    })

  })
</script>

<script>
  // $(function() {
  //   $('.hide_show').change(function() {
  //     var hide_show = $(this).prop('checked') == true ? 1 : 0;
  //     var procatthree_id = $(this).data('id');
  //     $.ajax({
  //       type: "GET",
  //       dataType: "json",
  //       url: '{{ route('backend.procatthree.hideshow') }}',
  //       data: {'hide_show': hide_show, 'procatthree_id': procatthree_id},
  //       success: function(data){
  //         console.log(data.success)
  //       }
  //     });
  //   })
  // })
  $(function() {
    $('.is_new').change(function() {
      var is_new = $(this).prop('checked') == true ? 1 : 0;
      var procatthree_id = $(this).data('id');
      $.ajax({
        type: "GET",
        dataType: "json",
        url: '{{ route('backend.procatthree.isnew') }}',
        data: {'is_new': is_new, 'procatthree_id': procatthree_id},
        success: function(data){
          // console.log(data.success)
        }
      });
    })
  })
  $(function() {
    $('.is_featured').change(function() {
      var is_featured = $(this).prop('checked') == true ? 1 : 0;
      var procatthree_id = $(this).data('id');
      $.ajax({
        type: "GET",
        dataType: "json",
        url: '{{ route('backend.procatthree.isfeatured') }}',
        data: {'is_featured': is_featured, 'procatthree_id': procatthree_id},
        success: function(data){
          // console.log(data.success)
        }
      });
    })
  })
  // $(function() {
  //   $('.stt').change(function() {
  //     var stt = $(this).val();
  //     var procatthree_id = $(this).data('id');
  //     $.ajax({
  //       type: "GET",
  //       dataType: "json",
  //       url: '{{ route('backend.procatthree.changestt') }}',
  //       data: {'stt': stt, 'procatthree_id': procatthree_id},
  //       success: function(data){
  //         console.log(data.success)
  //       }
  //     });
  //   })
  // })
</script>

<script type="text/javascript">
  $(document).ready(function () {
    $('#selectall').on('click', function(e) {
     if($(this).is(':checked',true))
     {
      $(".checkbox").prop('checked', true);
    } else {
      $(".checkbox").prop('checked',false);
    }
  });
    $('.checkbox').on('click',function(){
      if($('.checkbox:checked').length == $('.checkbox').length){
        $('#selectall').prop('checked',true);
      }else{
        $('#selectall').prop('checked',false);
      }
    });
    $('.delete-all').on('click', function(e) {
      var idsArr = [];
      $(".checkbox:checked").each(function() {
        idsArr.push($(this).attr('data-id'));
      });
      if(idsArr.length <=0)
      {
        alert("Vui lòng chọn ít nhất 1 mục để XOÁ !");
      }  else {
        if(confirm("Bạn có chắc chắn, XOÁ TẤT CẢ danh mục đã chọn ?")){
          var strIds = idsArr.join(",");
          $.ajax({
            url: "{{ route('backend.procatthree.deletemultiple') }}",
            type: 'DELETE',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: 'ids='+strIds,
            success: function (data) {
                          if (data['status']==true) { // if true (1)
                              setTimeout(function(){ // wait for 3 secs(2)
                                location.reload(); // then reload the page.(3)
                              }, 3000);
                              $(".checkbox:checked").each(function() {
                                $(this).parents("tr").remove();
                              });
                              alert(data['message']);
                            } else {
                              alert('Rất tiếc, đã có lỗi xảy ra !');
                            }
                          },
                          error: function (data) {
                            alert(data.responseText);
                          }
                        });
        }
      }
    });
  });
</script>
<script>
  $(function () {
    tableData = $('#procatthrees').DataTable({
      'order'       : [0],
      'responsive'  : true,
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'columnDefs': [
      { 'orderable': false, 'targets': [0,1,2,3] }
      ],
      'language': {
        "sProcessing":   "Đang xử lý...",
        "sLengthMenu":   "Xem _MENU_ mục",
        "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
        "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
        "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
        "sInfoFiltered": "(được lọc từ _MAX_ mục)",
        "sInfoPostFix":  "",
        "sSearch":       "Tìm:",
        "sUrl":          "",
        "oPaginate": {
          "sFirst":    "Đầu",
          "sPrevious": "Trước",
          "sNext":     "Tiếp",
          "sLast":     "Cuối"
        }
      }
    })
    // Apply the search
    tableData.columns().every(function () {
      let that = this;
      $('select', this.header()).change(function (e) {
          if (that.search() !== this.value) {
              that.search(this.value).draw();
          }
      });
    });
  })
</script>
@endpush
@php

@endphp
