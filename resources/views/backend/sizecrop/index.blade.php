@extends('backend.layout.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="pjax-container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h4>
                Hình thumb
            </h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
                <li><a href="{{ route('backend.sizecrop.index') }}">Hình thumb</a></li>
                <li class="active">Tất cả</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">

                        <div class="box-body">
                            <table id="language" class="table table-bordered table-striped set__width">
                                <a href="js:0" data-toggle="modal" data-target="#addmodel"
                                    class="btn btn-primary new-custom"><i class="fa fa-plus"></i> Thêm mới</a>

                                <thead>
                                    <tr>

                                        <th>#</th>
                                        <th>Size</th>
                                        <th>Dài </th>
                                        <th>Rộng</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($sizecrop as $k => $size)
                                    <!-- Modal edit-->
                                    <div class="modal fade" id="editmodel-{{ $size->id }}"
                                      tabindex="-1" role="dialog"
                                      aria-labelledby="modeledit{{ $size->id }}" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h3 class="modal-title"
                                                      id="modeleidt{{ $size->id }}">Sửa kích thước
                                                      </h3>
                                                  <button type="button" class="close" data-dismiss="modal"
                                                      aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                  </button>
                                              </div>
                                              <form method="POST"
                                                  action="{{ route('backend.sizecrop.update', $size->id) }}"
                                                  enctype="multipart/form-data">
                                                  @csrf
                                                  {{ method_field('PUT') }}
                                                  <div class="modal-body">
                                                      <div class="form-group">
                                                          <label for="">Size</label>
                                                      <input value="{{ $size->size }}" type="text" class="form-control" name="size"
                                                          placeholder="Loại size">
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="">Chiều dài</label>
                                                    <input value="{{ $size->width }}" type="text" class="form-control" name="width"
                                                        placeholder="Dài">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Chiều rộng</label>
                                                    <input value="{{ $size->height }}" type="text" class="form-control" name="height"
                                                        placeholder="Rộng">
                                                    </div>

                                                      <div class="modal-footer">
                                                          <button type="button" class="btn btn-secondary"
                                                              data-dismiss="modal">Hủy</button>
                                                          <button type="submit" class="btn btn-primary">Cập nhật</button>
                                                      </div>

                                                  </div>
                                              </form>
                                          </div>
                                      </div>
                                  </div>
                                        <tr>
                                            <td>
                                              {{ $k+1 }}
                                            </td>
                                            <td><strong><a
                                              data-toggle="modal"
                                              data-target="#editmodel-{{ $size->id }}">{{ strtoupper($size->size) }}</a></strong>

                                            </td>
                                            <td>
                                                {{ $size->width }}
                                            </td>
                                            <td>
                                                {{ $size->height }}
                                            </td>

                                            <td>
                                                <a  data-toggle="modal"
                                                data-target="#editmodel-{{ $size->id }}" class="btn btn-primary" data-toggle="tooltip" data-placement="top"
                                                    title="Sửa danh mục"><i
                                                        class="fa fa-edit"></i></a>
                                                <form method="POST"
                                                    action="{{ route('backend.sizecrop.destroy', $size->id) }}"
                                                    style="display: inline;">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button class="btn btn-danger del-confirm" data-toggle="tooltip"
                                                        data-placement="top" title="Xoá mục"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>
                            <a href="js:0" data-toggle="modal" data-target="#addmodel" class="btn btn-primary new-custom"><i
                                    class="fa fa-plus"></i> Thêm mới</a>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Modal  add -->
    <div class="modal fade" id="addmodel" tabindex="-1" role="dialog" aria-labelledby="modelcontent" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modelcontent">Thêm kích thước</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('backend.sizecrop.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Kí tự size</label>
                        <input type="text" class="form-control" name="size" placeholder="X,S,M,L,..." >
                        </div>
                        <div class="form-group">
                        <label for="">Chiều dài</label>
                        <input type="text" class="form-control" name="width" placeholder="vd : 60 ">
                        </div>
                        <div class="form-group">
                            <label for="">Chiều rộng</label>
                            <input type="text" class="form-control" name="height" placeholder="vd : 30" >
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(function() {
            $('#language').DataTable({
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
