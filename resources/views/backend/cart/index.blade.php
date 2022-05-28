@extends('backend.layout.master')
@section('title', 'Quản lí hóa đơn')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="pjax-container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h4>
                QUẢN LÍ ĐƠN ĐẶT PHÒNG
            </h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
                <li><a>Hóa đơn</a></li>
                <li><a href="{{ route('backend.cart.index') }}">Quản lý hóa đơn</a></li>
                <li class="active">Tất cả</li>
            </ol>
        </section>
        <section class="content" style="min-height: auto;padding-bottom: 0px">
            <form action="{{ route('backend.cart.postSearchTable') }}" method="POST" class="formAjax">
                @csrf
                @method('POST')
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <div class="box box-primary" style="margin-bottom: 0">
                            <div class="box-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <div class="form-group">
                                            <label>Từ ngày</label>
                                            <input type="date" name="fromday" value="{{ old('fromday') }}"
                                                class="form-control" data-toggle="tooltip" data-placement="bottom"
                                                title="Ngày bắt đầu">
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <div class="form-group">
                                            <label>Đến ngày</label>
                                            <input type="date" name="today" value="{{ old('today') }}"
                                                class="form-control" data-toggle="tooltip" data-placement="bottom"
                                                title="Ngày kết thúc">
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <div class="form-group" data-toggle="tooltip" data-placement="bottom"
                                            title="Tình trạng">
                                            <label>Tình trạng</label>
                                            <select class="form-control select2" id="status" name="status"
                                                style="width: 100%;">
                                                <option value="0">Tất cả</option>

                                                @foreach ($data['status_order'] as $i)
                                                    <option value="{{ $i->stt }}"
                                                        {{ old('status') == $i ? 'selected' : '' }}>{{ $i->name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <div class="form-group">
                                            <label>Thao tác</label>
                                            <button type="submit" class="form-control btn btn-success search-order-form"><i
                                                    class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
                            <table id="carts" class="table table-bordered table-striped set__width">
                                <a href="#" class="btn btn-danger delete-all new-custom"><i class="fa fa-trash"></i> Xoá
                                    chọn</a>
                                <thead>
                                    <tr>
                                        {{-- <th>
                                            <label>
                                                <input type="checkbox" id="selectall">
                                            </label>
                                        </th> --}}
                                        <th>STT</th>
                                        <th>Mã đơn</th>
                                        <th>Phòng</th>
                                        <th>N. đến</th>
                                        <th>N. đi</th>
                                        <th>Trạng thái</th>
                                        <th>T.tiền</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carts as $k => $cart)
                                        <tr>
                                            {{-- <td>
                                                <label>
                                                    <input type="checkbox" class="checkbox"
                                                        data-id="{{ $cart->id }}">
                                                </label>
                                            </td> --}}
                                            <td>{{ $k + 1 }}</td>
                                            {{-- <td>{{ $cart->order_code }}</td> --}}
                                            <td>{{ $cart->code }}</td>
                                            <td>{{ $cart->room->code }}</td>
                                            <td>{{ date('d/m/Y', strtotime($cart->from_date)) }}</td>
                                            <td>{{ date('d/m/Y', strtotime($cart->to_date)) }}</td>
                                            <td>
                                                <div class="badge {{ $cart->orderstatus->code }}">
                                                    {{ $cart->orderstatus->name }}
                                                </div>
                                            </td>
                                            <td>
                                                {{ number_format($cart->total) }} đ
                                            </td>
                                            <td>
                                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="top"
                                                    title="Sửa Đơn hàng"
                                                    href="{{ route('backend.cart.edit', $cart->id) }}"><i
                                                        class="fa fa-edit"></i></a>
                                                <form method="POST"
                                                    action="{{ route('backend.cart.destroy', $cart->id) }}"
                                                  style="display: inline;">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button class="btn btn-danger del-confirm" data-toggle="tooltip"
                                                        data-placement="top" title="Xoá Đơn hàng"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
        $(function() {
            $('#carts').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'colvis'
                ],

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
                    'targets': [0, 7]
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
                    alert("Vui lòng chọn ít nhất 1 thư để Xóa !");
                } else {
                    if (confirm("Bạn có chắc chắn, Xóa Tất Cả thư đã chọn ?")) {
                        var strIds = idsArr.join(",");
                        $.ajax({
                            url: "{{ route('backend.cart.deletemultiple') }}",
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: 'ids=' + strIds,
                            success: function(data) {
                                if (data['status'] == true) { // if true (1)
                                    setTimeout(function() { // wait for 3 secs(2)
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
                            error: function(data) {
                                alert(data.responseText);
                            }
                        });
                    }
                }
            });
        });
    </script>
@endpush
