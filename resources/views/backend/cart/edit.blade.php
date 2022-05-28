  @extends('backend.layout.master')
  @section('title', 'Cập nhật đơn hàng')
  @push('script')
  @endpush

  @section('content')

      <div class="content-wrapper" id="pjax-container">
          <!-- Content Header (Page header) -->
          <section class="content-header">
              <h4>
                  CẬP NHẬT HÓA ĐƠN
              </h4>
              <ol class="breadcrumb">
                  <li><a href="{{ route('backend.dashboard.index') }}"><i class="fa fa-dashboard"></i></a></li>
                  <li><a>Hóa đơn</a></li>
                  <li><a href="{{ route('backend.cart.index') }}">Quản lý hóa đơn</a></li>
                  <li class="active">Cập nhật</li>
              </ol>
          </section>
          <!-- Main content -->
          <section class="content">
              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              <form method="POST" action="{{ route('backend.cart.update', $data['cart']->id) }}">
                  @csrf
                  {{ method_field('PUT') }}
                  <div class="row">
                      <!-- left column -->
                      <div class="col-md-9">
                          <div class="box box-primary">
                              <div class="box-header with-border">
                                  <h4 class="box-title">Thông tin hóa đơn<b style="color: #3c8dbc"> PHÒNG
                                          {{ $data['cart']->room->code }} </b></h4>
                              </div>
                              <div class="box-body">
                                  <div class="row">
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label>Mã hóa đơn</label>
                                              <input type="text" name="code" id="code" data-length=120
                                                  value="@if (isset($data['cart']->code)) {{ old('code', $data['cart']->code) }}@else{{ old('code') }} @endif"
                                                  class="form-control" data-toggle="tooltip" data-placement="top"
                                                  readonly>
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label>Tên Khách hàng</label>
                                              <input readonly type="text" name="name" id="name" data-length=120
                                                  value="@if (isset($data['cart']->customer->name)) {{ old('name', $data['cart']->customer->name) }}@else{{ old('name') }} @endif"
                                                  class="form-control" data-toggle="tooltip" data-placement="top">
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label>Điện thoại Khách hàng</label>
                                              <input readonly type="text" name="phone" id="phone" data-length=120
                                                  value="@if (isset($data['cart']->customer->phone)) {{ old('phone', $data['cart']->customer->phone) }}@else{{ old('phone') }} @endif"
                                                  class="form-control" data-toggle="tooltip" data-placement="top">
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label>Email Khách hàng</label>
                                              <input readonly type="text" name="email" id="email" data-length=120
                                                  value="@if (isset($data['cart']->customer->email)) {{ old('email', $data['cart']->customer->email) }}@else{{ old('email') }} @endif"
                                                  class="form-control" data-toggle="tooltip" data-placement="top">
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label>Ngày đến</label>
                                              <input class="form-control" data-id="{{ $data['cart']->id }}" id="from_date" type="date" name="from_date"
                                                  value="{{ \Carbon\Carbon::parse($data['cart']->from_date)->toDateString() }}">
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label>Ngày đi</label>
                                              <input class="form-control"  data-id="{{ $data['cart']->id }}" id="to_date" type="date" name="to_date"
                                                  value="{{ \Carbon\Carbon::parse($data['cart']->to_date)->toDateString() }}">
                                          </div>
                                      </div>
                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <label for="">Ghi chú của khách hàng</label>
                                              <textarea class="form-control" name="note" id="note" data-length=400 rows="3" data-toggle="tooltip"
                                                  data-placement="top"
                                                  title="Nhập ghi chú">{{ $data['cart']->note }}</textarea>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <div class="box box-primary">
                              <div class="header">
                                  <div class="box-header with-border ">
                                      <div class=" justify-content-space-between">
                                          <h4 class="box-title">Chi tiết hóa đơn</h4>
                                          <button type="button" class="btn btn-success" data-toggle="modal"
                                              data-target="#ModalAdd">
                                              + Thêm dịch vụ
                                          </button>
                                          <a href="{{ route('backend.cart.print', $data['cart']->id) }}" target="_blank"
                                              class="btn btn-primary">
                                              Xuất hóa đơn
                                          </a>
                                      </div>
                                  </div>


                              </div>
                              <div class="box-body">
                                  <table class="table table-bordered table-striped">
                                      <thead>
                                          <tr>
                                              <th>Thao tác</th>
                                              <th>Tên dịch vụ</th>
                                              <th>Số lượng</th>
                                              <th>Đơn vị tính</th>
                                              <th>Giá bán</th>
                                              <th>Thành tiền</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <tr >
                                            <td></td>
                                            <td><b> Tiền phòng</b></td>
                                            <td id="date_total_update">{{ $data['night'] }} </td>
                                            <td>Đêm</td>
                                            <td>{{ number_format($data['cart']->room->procatone->selling_price) }} đ</td>
                                            {{-- <td></td>   --}}
                                            <td id="price_total_update">{{ number_format($data['price_room']) }} đ</td>
                                        </tr>
                                          @forelse ($data['detailsv'] as $k => $detail)
                                              <tr>
                                                  <td>
                                                      <span data-id="{{ $detail->id }}" class="btn btn-danger del-sv"
                                                          data-toggle="tooltip" data-placement="top" title="Xoá"><i
                                                              class="fa fa-trash"></i>
                                                      </span>
                                                  </td>
                                                  <td><strong>{{ $detail->name }}</strong></td>
                                                  <td style="width: 20%">
                                                    <input style="width: 50%" type="number" class="change_quantity" value="{{ $detail->quantity }}" data-id="{{ $detail->id }}">
                                                    </td>
                                                  <td>{{ $detail->unit }}</td>
                                                  <td>{{ number_format($detail->price) }} đ</td>
                                                  <td id="total_price_update{{ $detail->id }}">{{ number_format($detail->quantity * $detail->price) }}
                                                      đ</td>
                                              </tr>

                                          @empty
                                          @endforelse

                                          <tr>

                                              <td style="text-align: right" colspan="5"><b>TIỀN DỊCH VỤ</b> </td>
                                              <td> {{ number_format($data['total_price_service']) }} đ</td>
                                          </tr>

                                          @if ($data['cart']->vat > 0)
                                              <tr>
                                                  <td style="text-align: right" colspan="5"><b>VAT (
                                                          {{ $data['cart']->vat }}% ) </b></td>
                                                  <td> {{ number_format($data['vat']) }} đ</td>
                                              </tr>
                                          @endif
                                          <tr>
                                              <td style="text-align: right" colspan="5"><b>TỔNG CỘNG </b></td>
                                              <td><b id="reload_price" style="color: #dd4b39">{{ number_format($data['cart']->total) }}
                                                      đ</b></td>
                                          </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </div>

                      </div>
                      <!-- left column -->
                      <!-- right column -->
                      <div class="col-md-3">
                          <div class="box box-primary">
                              <div class="box-header with-border">
                                  <label>Tình trạng</label>
                              </div>
                              <div class="box-body">
                                  <div class="form-group">
                                      <select class="form-control select2" id="status" name="status" style="width: 100%;">
                                          @foreach ($data['status_order'] as $item)
                                              <option {{ $item->id == $data['cart']->orderstatus->id ? 'selected' : '' }}
                                                  value="{{ $item->id }}">{{ $item->name }}</option>
                                          @endforeach
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="box box-primary">
                              <div class="box-header with-border">
                                  <label>VAT ( % )</label>
                              </div>
                              <div class="box-body">
                                  <div class="form-group">
                                      <input type="text" class="form-control" name="vat"
                                          value="{{ $data['cart']->vat }}">
                                  </div>
                              </div>
                          </div>
                          <div class="box box-primary">
                              <div class="box-header with-border">
                                  <label>Thao tác</label>
                              </div>
                              <div class="box-body">
                                  <button class="btn btn-primary"><i class="fa fa-save"></i> Lưu</button>
                                  <a href="{{ route('backend.cart.index') }}" class="btn btn-danger"><i
                                          class="fa fa-times-circle"></i> Thoát</a>
                              </div>
                          </div>
                      </div>
                      <!-- right column -->
                  </div>
          </section>
      </div>
      </form>
      <!-- Modal -->
      <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="ModalAdd" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      <h5 class="modal-title" id="ModalAdd">Thêm dịch vụ phòng {{ $data['cart']->room->code }}</h5>
                  </div>

                  {{-- <form action="{{ route('backend.addservice.store') }}" method="post">
                    @csrf --}}
                  <div class="col-md-12">
                      <div class="row">
                          <div class="col-md-12">
                              <label for="">Dịch vụ</label>
                              <input type="text" name="name" id="name_sv" class="form-control">
                          </div>
                          <div class="col-md-12">
                              <label for="">Giá tiền</label>
                              <input type="number" name="price" id="price_sv" class="form-control">
                          </div>
                          <div class="col-md-12">
                              <label for="">Đơn vị tính</label>
                              <input type="text" name="unit" id="unit_sv" class="form-control">
                          </div>
                          <div class="col-md-12">
                              <label for="">Số lượng</label>
                              <div class="form-group">
                                  <input type="number" name="quantity" id="quantity_sv" class="form-control">
                              </div>
                          </div>
                          <input type="text" name="order_id" value="{{ $data['cart']->id }}" id="order_id_sv">
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                      <button type="button" id="add_sv" class="btn btn-primary">Thêm</button>
                  </div>
                  {{-- </form> --}}
              </div>
          </div>
      </div>
  @endsection
  @push('script')
      <script>
          $(document).ready(function() {
              $('#add_sv').click(function() {
                  var name = $('#name_sv').val();
                  var price = $('#price_sv').val();
                  var unit = $('#unit_sv').val();
                  var quantity = $('#quantity_sv').val();
                  var order_id = $('#order_id_sv').val();
                  $.ajax({
                      type: "POST",
                      url: "{{ route('backend.addservice.store') }}",
                      data: {
                          name: name,
                          price: price,
                          unit: unit,
                          quantity: quantity,
                          order_id: order_id,
                          _token: '{{ csrf_token() }}'
                      },
                      success: function(msg) {
                          if (msg.status == 'success') {
                              Swal.fire({
                                  icon: 'success',
                                  title: 'Thành công',
                                  showConfirmButton: false,
                                  timer: 4000,
                                  text: 'Đã thêm dịch vụ',
                              })
                          }
                          setTimeout(function() { // wait for 3 secs(2)
                              location
                                  .reload(); // then reload the page.(3)
                          }, 3000);
                      },

                  });
              });
          });
      </script>

      <script>
          $(document).ready(function() {
              $('.del-sv').click(function() {
                  var id_sv = $(this).attr('data-id');
                  Swal.fire({
                      title: 'Bạn có chắc?',
                      text: "Không thể hoàn tác sau khi xóa",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Đồng ý xóa',
                      cancelButtonText: 'Hủy'

                  }).then((result) => {
                      if (result.isConfirmed) {
                          $.ajax({
                              type: "DELETE",
                              url: "{{ route('backend.deleteservice.delete') }}",
                              data: {
                                  id: id_sv,
                                  _token: '{{ csrf_token() }}'
                              },
                              success: function(msg) {
                                  if (msg.status == 'success') {
                                      Swal.fire({
                                          icon: 'success',
                                          title: 'Thành công',
                                          showConfirmButton: false,
                                          timer: 4000,
                                          text: 'Đã xóa dịch vụ',
                                      })
                                  }
                                  setTimeout(function() { // wait for 3 secs(2)
                                      location
                                          .reload(); // then reload the page.(3)
                                  }, 3000);
                              },

                          });
                      }
                  })

              });
          });
      </script>

<script>
    $(document).ready(function() {
        $('.change_quantity').change(function() {

            var quantity = $(this).val();
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: "{{ route('backend.updateservice.update') }}",
                data: {
                    id: id,
                    quantity: quantity,
                    _token: '{{ csrf_token() }}'
                },
                success: function(msg) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công',
                            showConfirmButton: false,
                            timer: 4000,
                            text: 'Đã cập nhật dịch vụ',
                        })
                        $('#total_price_update' +id).html(msg.update_price + ' đ')
                },

            });
        });
    });

    $(document).ready(function() {
        $('input[type="date"]').change(function(){
            var from = $('#from_date').val();
            var from_date = new Date(from);
            var to = $('#to_date').val();
            var to_date = new Date(to);
            var Difference_In_Time = from_date.getTime() - to_date.getTime();
            var result = Difference_In_Time / (1000 * 3600 * 24);
            var date = Math.abs(result ) ;
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: "{{ route('backend.updatedate.update') }}",
                data: {
                    id: id,
                    from_date:from,
                    to_date:to,
                    date :date,
                    _token: '{{ csrf_token() }}'
                },
                success: function(msg) {
                    if(msg.status == 'success'){
                       Swal.fire({
                            icon: 'success',
                            title: 'Thành công',
                            showConfirmButton: false,
                            timer: 4000,
                            text: 'Đã cập nhật dịch vụ',
                        })
                        $('#price_total_update').html(msg.price + ' đ')
                        $('#date_total_update').html(date);
                        $('#reload_price').html('Loading...')
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            showConfirmButton: false,
                            timer: 4000,
                            text: 'Ngày đến không thể sau ngày đi',
                        })
                    }


                },

            });
        });
    });
</script>

  @endpush
