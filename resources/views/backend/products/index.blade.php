@extends('backend.layout.master')
@section('title','Quản lí sản phẩm')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="pjax-container">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
      PHÒNG
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Sản phẩm</a></li>
      <li><a href="{{ route('backend.product.index') }}">Quản lý Sản phẩm</a></li>
      <li class="active">Tất cả</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          @if (Session::has('success'))
          <div class="alert-custom">
            <div class="alert alert-success">{{ Session::get('success') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
          @endif
          <div class="box-body">
            <table id="products" class="table table-bordered table-striped set__width">
              <a href="{{ route('backend.product.create') }}" class="btn btn-primary new-custom"><i class="fa fa-plus"></i> Thêm mới</a>
              <a href="#" class="btn btn-danger delete-all new-custom" style="margin-left: 3px;"><i class="fa fa-trash"></i> Xoá chọn</a>
              <thead>
                <tr>
                  <th>
                    <label style="margin-bottom: 0px">
                      <input type="checkbox" id="selectall">
                    </label>
                  </th>
                  <th>STT</th>
                  <th>Hình ảnh</th>
                  <th>Loại phòng</th>
                  <th>Số phòng</th>
                  <th>Trạng thái</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($products as $k => $product)
                <tr>
                  <td>
                    <input type="checkbox" class="checkbox" data-id="{{$product->id}}">
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="text" data-id="{{ $product->id }}" value="@if(isset($product->stt)){{ old('stt', $product->stt) }}@else{{ old('stt') }}@endif" class="stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự" style="max-width: 50px; text-align: center">
                    </div>
                  </td>
                  <td>
                    <a href="{{ route('backend.product.edit', $product->id) }}"><img src="{{ asset('storage') }}/uploads/{{ $product->code }}/{{ $product->img }}" class="img-thumbnail" style="max-width: 60px; margin-bottom: 0px">
                    </a>
                  </td>
                  <td>
                    <b>{{ $product->procatone->translations->name ?? '' }}</b>
                  </td>

                  <td><a href="{{ route('backend.product.edit', $product->id) }}"><b>{{ $product->code ?? '' }}</b></a></td>
                  <td>
                    <input data-id="{{ $product->id }}" class="hide_show" type="checkbox" data-on="Còn <i class='fa fa-check'></i> " data-off="Hết <i class='fa fa-times'></i> " {{ $product->hide_show ? 'checked' : '' }} data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-style="ios" data-size="mini">
                  </td>
                  <td>
                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Sửa" href="{{ route('backend.product.edit', $product->id ) }}"><i class="fa fa-edit"></i></a>
                    <form method="POST" action="{{ route('backend.product.destroy', $product->id) }}" style="display: inline;">
                      @csrf
                      {{ method_field('DELETE') }}
                      <button class="btn btn-danger del-confirm" data-toggle="tooltip" data-placement="top" title="Xoá"><i class="fa fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <a href="{{ route('backend.product.create') }}" class="btn btn-primary new-custom"><i class="fa fa-plus"></i> Thêm mới</a>
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
  $('#products').on('change','input[class="hide_show"]',function(){
    var hide_show = $(this).prop('checked') == true ? 1 : 0;
    var product_id = $(this).data('id');
    $.ajax({
      type: "GET",
      dataType: "json",
      url: '{{ route('backend.product.hideshow') }}',
      data: {'hide_show': hide_show, 'product_id': product_id},
        success: function(data){
         Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Đã cập nhật trạng thái',
                    showConfirmButton: false,
                    timer: 1000
                    })
      }
    });
  })
}

$(document).ready(function(){
  switchChange();
  $('.choose').on('change',function(){
    var action  = $(this).attr('id');
    var code_id = $(this).find(':selected').data('id')
    var _token  = $('input[name="_token"]').val();
    var result  = '';
    if (action == 'procatone'){
      result = 'procattwo';
    }else{
      result = 'procatthree';
    }
    $.ajax({
      url : '{{ route('backend.product.select') }}',
      method : 'POST',
      data: {action:action,code_id:code_id,_token:_token},
      success:function(data){
        $('#'+result).html(data);
      }
    });
  });

  $(function(){
    $('#products').on('change','input[class="is_featured"]',function(){
      var is_featured = $(this).prop('checked') == true ? 1 : 0;
      var product_id = $(this).data('id');
      $.ajax({
        type: "GET",
        dataType: "json",
        url: '{{ route('backend.product.isfeatured') }}',
        data: {'is_featured': is_featured, 'product_id': product_id},
        success: function(data){
           Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Đã cập nhật trạng thái',
                    showConfirmButton: false,
                    timer: 1000
                    })
        }
      });
    })
  })

  $(function(){
    $('#products').on('change','input[class="is_new"]',function(){
      var is_new = $(this).prop('checked') == true ? 1 : 0;
      var product_id = $(this).data('id');
      $.ajax({
        type: "GET",
        dataType: "json",
        url: '{{ route('backend.product.isnew') }}',
        data: {'is_new': is_new, 'product_id': product_id},
        success: function(data){
           Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Đã cập nhật trạng thái',
                    showConfirmButton: false,
                    timer: 1000
                    })
        }
      });
    })
  })

  $(function(){
    $('#products').on( 'change', 'input[class="stt"]', function () {
      var stt = $(this).val();
      var product_id = $(this).data('id');
      $.ajax({
        type: "GET",
        dataType: "json",
        url: '{{ route('backend.product.changestt') }}',
        data: {'stt': stt, 'product_id': product_id},
        success: function(data){
           Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Đã cập nhật trạng thái',
                    showConfirmButton: false,
                    timer: 1000
                    })
        }
      });
    })
  })

})
</script>
<script type="text/javascript">
  $(document).ready(function() {
      $('#selectall').on('click', function(e) {
          if ($(this).is(':checked', true)) {
              $(".checkbox").prop('checked', true);
          } else {
              $(".checkbox").prop('checked', false);
          }
      });
      $('.checkbox').on('click', function() {
          if ($('.checkbox:checked').length == $('.checkbox').length) {
              $('#selectall').prop('checked', true);
          } else {
              $('#selectall').prop('checked', false);
          }
      });
      $('.delete-all').on('click', function(e) {
          var idsArr = [];
          $(".checkbox:checked").each(function() {
              idsArr.push($(this).attr('data-id'));
          });
          if (idsArr.length <= 0) {
              Swal.fire(
                  'Chưa chọn !',
                  'Vui lòng chọn ít nhất 1 mục để XOÁ !',
                  'question'
              )

          } else {
              Swal.fire({
                  title: 'Bạn có chắc',
                  text: "Không thể hoàn tác sau khi xóa !",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Xóa',
                  cancelButtonText: 'Hủy'
              }).then((result) => {
                  if (result.isConfirmed) {
                      var strIds = idsArr.join(",");
                      $.ajax({
                          url: "{{ route('backend.product.deletemultiple') }}",
                          type: 'DELETE',
                          headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                  'content')
                          },
                          data: 'ids=' + strIds,
                          success: function(data) {
                              if (data['status'] == true) { // if true (1)
                                  setTimeout(function() { // wait for 3 secs(2)
                                      location
                                  .reload(); // then reload the page.(3)
                                  }, 3000);
                                  $(".checkbox:checked").each(function() {
                                      $(this).parents("tr").remove();
                                  });
                                  Swal.fire(
                                      'Thành Công',
                                      'Đã xóa các mục vừa chọn !',
                                      'success'
                                  )
                              } else {
                                  alert('Rất tiếc, đã có lỗi xảy ra !');
                              }
                          },
                          error: function(data) {
                              Swal.fire(
                                  'Thất Bại !',
                                  'Đã có lỗi xảy ra !',
                                  'danger'
                              )
                          }
                      });

                  }
              })

          }
      });
  });
</script>
<script>
  $(function () {
    tableData = $('#products').DataTable({
    'order'       : [1,3,4,5], //Bắt đầu sắp xếp cột nào ?
    'responsive'  : true,
    'paging'      : true,
    'lengthChange': true,
    'searching'   : true,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : true,
    'columnDefs': [
    { 'orderable': false, 'targets': [0,2,6] }
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
