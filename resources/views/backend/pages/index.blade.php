@extends('backend.layout.master')
@section('title','Quản lí trang tĩnh')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="pjax-container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h4>
                Quản lý Trang tĩnh
            </h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
                <li><a href="{{ route('backend.page.index') }}">Quản lý Trang tĩnh</a></li>
                <li class="active">Tất cả</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">

                        <div class="box-body">
                            <table id="pages" class="table table-bordered table-striped set__width">
                                <a href="{{ route('backend.page.create') }}" class="btn btn-primary new-custom"><i
                                        class="fa fa-plus"></i> Thêm mới</a>


                                <thead>
                                    <tr>
                                        <th>Hình ảnh</th>
                                        <th>Tên trang</th>
                                        <th>Hiển thị</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pages as $page)
                                        <tr>
                                            <td>
                                                <a href="{{ route('backend.page.edit', $page->id) }}"><img
                                                        src="{{ asset('storage') }}/uploads/pages/{{ $page->img }}"
                                                        class="img-thumbnail" style="max-width: 50px;margin-bottom: 0">
                                                </a>
                                            </td>
                                            <td><strong><a href="">{{ $page->translations->name }}</a></strong></td>
                                            <td>
                                                <input data-id="{{ $page->id }}" class="hide_show" type="checkbox"
                                                    data-on="<i class='fa fa-check'></i>"
                                                    data-off="<i class='fa fa-times'></i>"
                                                    {{ $page->hide_show ? 'checked' : '' }} data-toggle="toggle"
                                                    data-onstyle="success" data-offstyle="danger" data-style="ios"
                                                    data-size="mini">
                                            </td>
                                            <td>
                                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="top"
                                                    title="Sửa" href="{{ route('backend.page.edit', $page->id) }}"><i
                                                    class="fa fa-edit"></i>
                                                </a>
                                                <form method="POST"
                                                action="{{ route('backend.page.destroy', $page->id) }}"
                                                style="display: inline;">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger del-confirm" data-toggle="tooltip"
                                                    data-placement="top" title="Xoá trang"><i
                                                        class="fa fa-trash"></i></button>
                                            </form>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                            <a href="{{ route('backend.page.create') }}" class="btn btn-primary new-custom"><i
                                    class="fa fa-plus"></i> Thêm mới</a>


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
        $('#pages').on('change', 'input[class="hide_show"]', function() {
            var hide_show = $(this).prop('checked') == true ? 1 : 0;
            var page_id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('backend.page.hideshow') }}',
                data: {
                    'hide_show': hide_show,
                    'page_id': page_id
                },
                success: function(data) {
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Đã cập nhật trạng thái',
                    showConfirmButton: false,
                    timer: 1500
                    })
                }
            });
        })
    }

    $(document).ready(function() {
        switchChange();
    })
</script>
    <script>
        $(function() {
            $('#pages').DataTable({
                'order': [0],
                'responsive': true,
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': true,
                'columnDefs': [{
                    'orderable': false,
                    'targets': [0, 1, 2]
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
