@extends('backend.layout.master')
@section('title','Quản lí dịch vụ phòng')
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
                <li><a href="{{ route('backend.serviceroom.index') }}">Danh mục phòng</a></li>
                <li class="active">Tất cả</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">

                        <div class="box-body">
                            <table id="servicerooms" class="table table-bordered table-striped set__width">
                                <a href="{{ route('backend.serviceroom.create') }}" class="btn btn-primary new-custom"><i
                                        class="fa fa-plus"></i> Thêm mới</a>

                                <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>Tên</th>
                                        <th>Ảnh</th>
                                        <th>Giá tiền</th>
                                        <th>Đơn vị tính</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($servicerooms as $k => $serviceroom)
                                        <tr>
                                            <td>
                                               {{ $k + 1 }}
                                            </td>
                                            <td>
                                                {{ $serviceroom->name }}

                                            </td>
                                            <td><img width="150px" height="150px" class="img-thumbnail" src="{{ asset('storage') }}/uploads/serviceroom/{{ $serviceroom->img }}" alt="">
                                            </td>
                                            <td>
                                               {{ number_format($serviceroom->price) }} đ
                                            </td>
                                            <td>
                                               {{ $serviceroom->unit }}
                                            </td>

                                            <td>
                                                <a class="btn btn-primary " data-toggle="tooltip" data-placement="top"
                                                    title="Sửa danh mục"
                                                    href="{{ route('backend.serviceroom.edit', $serviceroom->id) }}"><i
                                                        class="fa fa-edit"></i></a>
                                                <form method="POST"
                                                    action="{{ route('backend.serviceroom.destroy', $serviceroom->id) }}"
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
                            <a href="{{ route('backend.serviceroom.create') }}" class="btn btn-primary new-custom"><i
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
        $(function() {
            $('#servicerooms').DataTable({
                'order': [3],
                'responsive': true,
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': true,
                'columnDefs': [{
                    'orderable': false,
                    'targets': [0,1,2,4,5]
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
