@extends('backend.layout.master')
@section('title','Quản lí danh mục video')
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
      <li><a>Media</a></li>
      <li><a href="{{ route('backend.videocat.index') }}">Danh mục Media</a></li>
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
          @elseif (Session::has('danger'))
          <div class="alert-custom">
            <div class="alert alert-danger">{{ Session::get('danger') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
          @endif
          <div class="box-body">
            <table id="videocats" class="table table-bordered table-striped set__width">
              <a href="{{ route('backend.videocat.create') }}" class="btn btn-primary new-custom"><i class="fa fa-plus"></i> Thêm mới</a>
              <a href="#" class="btn btn-danger delete-all new-custom" style="margin-left: 3px;"><i class="fa fa-trash"></i> Xoá chọn</a>
              <thead>
                <tr>
                  <th>
                    <label style="margin-bottom: 0px">
                      <input type="checkbox" id="selectall">
                    </label>
                  </th>
                  <th>STT</th>
                  <th>Tên danh mục</th>
                  <th>Hiển thị</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach($videocats as $videocat)
                <tr>
                <td>
                  <label>
                    <input type="checkbox" class="checkbox" data-id="{{ $videocat->id }}">
                  </label>
                </td>
                <td>
                  <div class="form-group">
                    <input type="text" data-id="{{ $videocat->id }}" value="@if(isset($videocat->stt)){{ old('stt', $videocat->stt) }}@else{{ old('stt') }}@endif" class="stt" data-toggle="tooltip" data-placement="top" title="Nhập số thứ tự" style="max-width: 50px; text-align: center">
                  </div>
                </td>
                <td><a href="{{ route('backend.videocat.edit', $videocat->id ) }}">{{ $videocat->translations->name ?? '' }}</a></td>
                <td>
                  <input data-id="{{ $videocat->id }}" class="hide_show" type="checkbox" data-on="<i class='fa fa-check'></i>" data-off="<i class='fa fa-times'></i>" {{ $videocat->hide_show ? 'checked' : '' }} data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-style="ios" data-size="mini">
                </td>
                <td>
                  <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Sửa danh mục" href="{{ route('backend.videocat.edit', $videocat->id ) }}"><i class="fa fa-edit"></i></a>
                  <form method="POST" action="{{ route('backend.videocat.destroy', $videocat->id) }}"  style="display: inline;">
                    @csrf
                    {{ method_field('DELETE') }}
                    <button class="btn btn-danger del-confirm" data-toggle="tooltip" data-placement="top" title="Xoá danh mục"><i class="fa fa-trash"></i></button>
                  </form>
                </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <a href="{{ route('backend.videocat.create') }}" class="btn btn-primary new-custom"><i class="fa fa-plus"></i> Thêm mới</a>
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
  $(function () {
    $('#videocats').DataTable({
      'order'       : [0],
      'responsive'  : true,
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'columnDefs': [
      { 'orderable': false, 'targets': [0,1,4] }
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
  })
</script>
<script>
function switchChange(){
  $('#videocats').on('change','input[class="hide_show"]',function(){
    var hide_show = $(this).prop('checked') == true ? 1 : 0;
    var videocat_id = $(this).data('id');
    $.ajax({
      type: "GET",
      dataType: "json",
      url: '{{ route('backend.videocat.hideshow') }}',
      data: {'hide_show': hide_show, 'videocat_id': videocat_id},
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
    $('#videocats').on('change','input[class="is_new"]',function(){
      var is_new = $(this).prop('checked') == true ? 1 : 0;
      var videocat_id = $(this).data('id');
      $.ajax({
        type: "GET",
        dataType: "json",
        url: '{{ route('backend.videocat.isnew') }}',
        data: {'is_new': is_new, 'videocat_id': videocat_id},
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
    $('#videocats').on('change','input[class="is_featured"]',function(){
      var is_featured = $(this).prop('checked') == true ? 1 : 0;
      var videocat_id = $(this).data('id');
      $.ajax({
        type: "GET",
        dataType: "json",
        url: '{{ route('backend.videocat.isfeatured') }}',
        data: {'is_featured': is_featured, 'videocat_id': videocat_id},
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
    $('#videocats').on( 'change', 'input[class="stt"]', function () {
      var stt = $(this).val();
      var videocat_id = $(this).data('id');
      $.ajax({
        type: "GET",
        dataType: "json",
        url: '{{ route('backend.videocat.changestt') }}',
        data: {'stt': stt, 'videocat_id': videocat_id},
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
{{--
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
            url: "{{ route('backend.videocat.deletemultiple') }}",
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
</script> --}}

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
                            url: "{{ route('backend.videocat.deletemultiple') }}",
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
                                    Swal.fire(
                                        'Thất bại',
                                        'Đã có lỗi xảy ra!',
                                        'error'
                                    )
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
@endpush
