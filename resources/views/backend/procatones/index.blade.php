@extends('backend.layout.master')
@section('title','Quản lí danh mục phòng')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="pjax-container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h4>
                QUẢN LÍ DANH MỤC PHÒNG
            </h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
                <li><a>Phòng</a></li>
                <li><a href="{{ route('backend.procatone.index') }}">Danh mục phòng</a></li>
                <li class="active">Tất cả</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">

                        <div class="box-body">
                            <table id="procatones" class="table table-bordered table-striped set__width">
                                <a href="{{ route('backend.procatone.create') }}" class="btn btn-primary new-custom"><i
                                        class="fa fa-plus"></i> Thêm mới</a>
                                <a href="#" class="btn btn-danger delete-all new-custom" style="margin-left: 3px;"><i
                                        class="fa fa-trash"></i> Xoá chọn</a>
                                <thead>
                                    <tr>
                                        <th>
                                            <label style="margin-bottom: 0px">
                                                <input type="checkbox" id="selectall">
                                            </label>
                                        </th>
                                        <th>STT</th>
                                        <th>Tên - Khu</th>
                                        <th>Giá một đêm</th>
                                        <th>Ảnh</th>
                                        <th>Hiển thị</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($procatones as $procatone)
                                        <tr>
                                            <td>
                                                <label>
                                                    <input type="checkbox" class="checkbox"
                                                        data-id="{{ $procatone->id }}">
                                                </label>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" data-id="{{ $procatone->id }}"
                                                        value="@if (isset($procatone->stt)) {{ old('stt', $procatone->stt) }}@else{{ old('stt') }} @endif"
                                                        class="stt" data-toggle="tooltip" data-placement="top"
                                                        title="Nhập số thứ tự" style="max-width: 50px; text-align: center">
                                                </div>
                                            </td>
                                            <td><a
                                                    href="{{ route('backend.procatone.edit', $procatone->id) }}"><b>{{ $procatone->translations->name ?? '' }}</b> - <b> Khu {{ $procatone->location }} </b></a>
                                            </td>
                                            <td>
                                                @if($procatone->discount > 0)
                                                <s><small style="color: #dd4b39">{{ number_format($procatone->price) }} đ</small></s>
                                               <span style="color:#00a65a">{{ number_format($procatone->selling_price) }} đ</span>

                                                @else
                                                <span style="color:#00a65a">{{ number_format($procatone->price) }} đ</span>

                                                @endif
                                            </td>
                                            <td>
                                                <img width="200px" height="200px" class="img-thumbnail" src="{{ asset('storage') }}/uploads/cateroom/{{ $procatone->img }}" alt="">
                                            </td>
                                            <td>
                                                <input data-id="{{ $procatone->id }}" class="hide_show"
                                                type="checkbox" data-on="<i class='fa fa-check'></i>"
                                                data-off="<i class='fa fa-times'></i>"
                                                {{ $procatone->hide_show ? 'checked' : '' }} data-toggle="toggle"
                                                data-onstyle="success" data-offstyle="danger" data-style="ios"
                                                data-size="mini">
                                            </td>
                                            <td>
                                                <a class="btn btn-primary " data-toggle="tooltip" data-placement="top"
                                                    title="Sửa danh mục"
                                                    href="{{ route('backend.procatone.edit', $procatone->id) }}"><i
                                                        class="fa fa-edit"></i></a>
                                                <form method="POST"
                                                    action="{{ route('backend.procatone.destroy', $procatone->id) }}"
                                                    style="display: inline;">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button class="btn btn-danger del-confirm" data-toggle="tooltip"
                                                        data-placement="top" title="Xoá danh mục"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <a href="{{ route('backend.procatone.create') }}" class="btn btn-primary new-custom"><i
                                    class="fa fa-plus"></i> Thêm mới</a>
                            <a href="#" class="btn btn-danger delete-all new-custom"><i class="fa fa-trash"></i> Xoá
                                chọn</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('script')
    <script>
        function switchChange() {
            $('#procatones').on('change', 'input[class="hide_show"]', function() {
                var hide_show = $(this).prop('checked') == true ? 1 : 0;
                var procatone_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('backend.procatone.hideshow') }}',
                    data: {
                        'hide_show': hide_show,
                        'procatone_id': procatone_id
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
                $('#procatones').on('change', 'input[class="stt"]', function() {
                    var stt = $(this).val();
                    var procatone_id = $(this).data('id');
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: '{{ route('backend.procatone.changestt') }}',
                        data: {
                            'stt': stt,
                            'procatone_id': procatone_id
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
                                url: "{{ route('backend.procatone.deletemultiple') }}",
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
                                        'error'
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
        $(function() {
            $('#procatones').DataTable({
                'order': [1,3],
                'responsive': true,
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': true,
                'columnDefs': [{
                    'orderable': false,
                    'targets': [0,,2,4,5, 6]
                }],
                'language': {
                    "sProcessing": "Đang xử lý...",
                    "sLengthMenu": "Xem _MENU_ mục",
                    "sZeroRecords": "Không tìm thấy dòng nào phù hợp",
                    "sInfo": "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                    "sInfoEmpty": "Đang xem 0 đến 0 trong tổng số 0 mục",
                    "sInfoFiltered": "(được lọc từ _MAX_ mục)",
                    "sInfoPostFix": "",
                    "sSearch": "Tìm:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "Đầu",
                        "sPrevious": "Trước",
                        "sNext": "Tiếp",
                        "sLast": "Cuối"
                    }
                }
            })
        })
    </script>
@endpush
