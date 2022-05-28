@extends('backend.layout.master')
@section('title','Quản lí tags')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h4>
      Quản lý Tags
    </h4>
    <ol class="breadcrumb">
      <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
      <li><a>Bài viết</a></li>
      <li><a href="{{ route('backend.tag.index') }}">Quản lý Tags</a></li>
      <li class="active">Tất cả</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          @if (Session::has('success'))
          <div class="alert-custom">
            <div class="alert alert-success">{{ Session::get('success') }}</div>
          </div>
          @endif
          <div class="box-body">
            <table id="tags" class="table table-bordered table-striped">
              <a href="{{ route('backend.tag.create') }}" class="btn btn-primary new-custom"><i class="fa fa-plus"></i> Thêm mới</a>
              <a href="#" class="btn btn-danger delete-all new-custom" style="margin-left: 3px;"><i class="fa fa-trash"></i> Xoá chọn</a>
              <thead>
                <tr>
                  <th>
                    <label>
                      <input type="checkbox" id="selectall">
                    </label>
                  </th>
                  <th>STT</th>
                  <th>Tên Tags</th>
                  <th>Loại</th>
                  <th>Hiển thị</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($tags as $k => $tag)
                <tr>
                  <td>
                    <label>
                      <input type="checkbox" class="checkbox" data-id="{{$tag->id}}">
                    </label>
                  </td>
                  <td>
                    <div class="form-group">
                        <input type="text" data-id="{{ $tag->id }}"
                            value="@if (isset($tag->stt)) {{ old('stt', $tag->stt) }}@else{{ old('stt') }} @endif"
                            class="stt" data-toggle="tooltip" data-placement="top"
                            title="Nhập số thứ tự" style="max-width: 50px; text-align: center">
                    </div>
                  </td>
                  <td><a href="{{ route('backend.tag.edit', $tag->id) }}"> <span class="badge bg-green">{{ $tag->translations->name ?? '' }}</span></a></td>
                  <td>
                    {{-- <li>{{ $tag->type == 'post' ? "<i class="fa-thin fa-box-open"></i>": 'Sản Phẩm' }}</li>
                     --}}
                     @if($tag->type == 'product')
                     <i class="fa-solid fa-box-open"></i> <span class="badge bg-red">Sản phẩm</span>
                     @else
                     <i class="fa-solid fa-pen-line"></i> <span class="badge bg-light-blue">Bài viết</span>
                     @endif
                  </td>
                  <td>
                    <input data-id="{{ $tag->id }}" class="hide_show"
                        type="checkbox" data-on="<i class='fa fa-check'></i>"
                        data-off="<i class='fa fa-times'></i>"
                        {{ $tag->hide_show ? 'checked' : '' }} data-toggle="toggle"
                        data-onstyle="success" data-offstyle="danger" data-style="ios"
                        data-size="mini">
                </td>

                  <td>
                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Sửa Tag" href="{{ route('backend.tag.edit', $tag->id ) }}"><i class="fa fa-edit"></i></a>
                    <form method="POST" action="{{ route('backend.tag.destroy', $tag->id) }}"  style="display: inline;">
                      @csrf
                      {{ method_field('DELETE') }}
                      <button class="btn btn-danger del-confirm" data-toggle="tooltip" data-placement="top" title="Xoá Tag"><i class="fa fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <a href="{{ route('backend.tag.create') }}" class="btn btn-primary new-custom"><i class="fa fa-plus"></i> Thêm mới</a>
            <a href="#" class="btn btn-danger delete-all new-custom"><i class="fa fa-trash"></i> Xoá chọn</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
@push("script")

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
                            url: "{{ route('backend.tag.deletemultiple') }}",
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
    function switchChange() {
        $('#tags').on('change', 'input[class="hide_show"]', function() {
            var hide_show = $(this).prop('checked') == true ? 1 : 0;
            var tag_id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('backend.tag.hideshow') }}',
                data: {
                    'hide_show': hide_show,
                    'tag_id': tag_id
                },
                success: function(data) {
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

    $(document).ready(function() {
        switchChange();

        $(function() {
            $('#tags').on('change', 'input[class="stt"]', function() {
                var stt = $(this).val();
                var tag_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('backend.tag.changestt') }}',
                    data: {
                        'stt': stt,
                        'tag_id': tag_id
                    },
                    success: function(data) {
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
<script>
    $(function () {
      tableData = $('#tags').DataTable({
      'order'       : [2], //Bắt đầu sắp xếp cột nào ?
      'responsive'  : false,
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'columnDefs': [
      { 'orderable': false, 'targets': [1,2,3,4] }
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
