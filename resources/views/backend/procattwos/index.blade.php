@extends('backend.layout.master')
@section('title','Quản lí danh mục cấp 2')
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
      <li><a href="{{ route('backend.procattwo.index') }}">Danh mục Cấp 2</a></li>
      <li class="active">Tất cả</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-body">
            <table id="procattwos" class="table table-bordered table-striped set__width">
              <a href="{{ route('backend.procattwo.create') }}" class="btn btn-primary new-custom"><i class="fa fa-plus"></i> Thêm mới</a>
              <a href="#" class="btn btn-danger delete-all new-custom" style="margin-left: 3px;"><i class="fa fa-trash"></i> Xoá chọn</a>
              <thead>
                <tr>
                  <th>
                    <label style="margin-bottom: 0px">
                      <input type="checkbox" id="selectall">
                    </label>
                  </th>
                  <th>STT</th>
                  <th>
                    <div class="form-group">
                      <select class="form-control select2" style="max-width: 100%;">
                        <option selected="selected" value="">Chọn cấp 1</option>
                        @foreach($procatones as $procatone)
                        <option>{{ $procatone->translations->name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </th>
                  <th>Tên danh mục</th>
                  <th>Hiển thị</th>
                  <th>Nổi bật</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach($procattwos as $procattwo)
                <tr>
                <td>
                  <label>
                    <input type="checkbox" class="checkbox" data-id="{{ $procattwo->id }}">
                  </label>
                </td>
                <td>
                  <div class="form-group">
                    <input type="text" data-id="{{ $procattwo->id }}" value="@if(isset($procattwo->stt)){{ old('stt', $procattwo->stt) }}@else{{ old('stt') }}@endif" class="stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự" style="max-width: 50px; text-align: center">
                  </div>
                </td>
                <td>
                  {{ $procattwo->procatone->translations->name ?? '' }}
                </td>
                <td><a href="{{ route('backend.procattwo.edit', $procattwo->id ) }}">{{ $procattwo->translations->name ?? '' }}</a></td>
                <td>
                  <input data-id="{{ $procattwo->id }}" class="hide_show" type="checkbox" data-on="<i class='fa fa-check'></i>" data-off="<i class='fa fa-times'></i>" {{ $procattwo->hide_show ? 'checked' : '' }} data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-style="ios" data-size="mini">
                </td>
                <td>
                  <input data-id="{{ $procattwo->id }}" class="is_featured" type="checkbox" data-on="<i class='fa fa-check'></i>" data-off="<i class='fa fa-times'></i>" {{ $procattwo->is_featured ? 'checked' : '' }} data-toggle="toggle" data-onstyle="warning" data-offstyle="danger" data-style="ios" data-size="mini">
                </td>

                <td>
                  <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Sửa danh mục" href="{{ route('backend.procattwo.edit', $procattwo->id ) }}"><i class="fa fa-edit"></i></a>
                  <form method="POST" action="{{ route('backend.procattwo.destroy', $procattwo->id) }}" style="display: inline;">
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
            <a href="{{ route('backend.procattwo.create') }}" class="btn btn-primary new-custom"><i class="fa fa-plus"></i> Thêm mới</a>
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
      $('#procattwos').on('change','input[class="hide_show"]',function(){
        var hide_show = $(this).prop('checked') == true ? 1 : 0;
        var procattwo_id = $(this).data('id');
        $.ajax({
          type: "GET",
          dataType: "json",
          url: '{{ route('backend.procattwo.hideshow') }}',
          data: {'hide_show': hide_show, 'procattwo_id': procattwo_id},
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

      $(function(){
        $('#procattwos').on('change','input[class="is_new"]',function(){
          var is_new = $(this).prop('checked') == true ? 1 : 0;
          var procattwo_id = $(this).data('id');
          $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('backend.procattwo.isnew') }}',
            data: {'is_new': is_new, 'procattwo_id': procattwo_id},
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
        $('#procattwos').on('change','input[class="is_featured"]',function(){
          var is_featured = $(this).prop('checked') == true ? 1 : 0;
          var procattwo_id = $(this).data('id');
          $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('backend.procattwo.isfeatured') }}',
            data: {'is_featured': is_featured, 'procattwo_id': procattwo_id},
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
        $('#procattwos').on( 'change', 'input[class="stt"]', function () {
          var stt = $(this).val();
          var procattwo_id = $(this).data('id');
          $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('backend.procattwo.changestt') }}',
            data: {'stt': stt, 'procattwo_id': procattwo_id},
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
                        url: "{{ route('backend.procattwo.deletemultiple') }}",
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
    tableData = $('#procattwos').DataTable({
      'order'       : [0],
      'responsive'  : true,
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'columnDefs': [
      { 'orderable': false, 'targets': [0,1,2,6] }
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
// function TableCategories($categories, $parent_id = 0, $char = '')
// {
//     foreach ($categories as $key => $item)
//     {
//         // Nếu là chuyên mục con thì hiển thị
//         if ($item->parent_id == $parent_id)
//         {
//             echo '<tr>';
//                 echo '<td>'.$item->stt.'</td>';
//                 echo '<td>'.$item->img.'</td>';
//                 echo '<td>'.$char . $item->name.'</td>';
//                 echo '<td>'.$item->updated_at.'</td>';
//                 echo '<td>'.$item->hide_show.'</td>';
//                 echo '<td>'.$item->status.'</td>';
//                 echo '<td>'..'</td>';
//                 echo '<td>'..'</td>';
//             echo '</tr>';

//             // Xóa chuyên mục đã lặp
//             unset($categories[$key]);

//             // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
//             TableCategories($categories, $item->id, $char.'---');
//         }
//     }
// }
@endphp
