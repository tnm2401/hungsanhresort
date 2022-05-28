@extends('frontend.layout.master')
@section('title')
    {{ __('Xác nhận đặt phòng') }}
@endsection
<style>
    .img-checkout {
        padding: .25rem;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: .25rem;
        max-width: 100%;
        height: auto;
    }
    button.book-room-now3  {
    background: #ffbf00;
    height: 40px;
    display: inline-block;
    vertical-align: middle;
    line-height: 40px;
    padding: 0 36px;
    color: #000;
    text-transform: uppercase;
    position: relative;
    z-index: 10;
    transition: 0.2s all linear;
    border: 0;
}
.form-control{
    font-size: 1.5rem !important;
}
</style>
@section('content')
    <div class="banner_share">
        {{-- <img src="{{ asset('frontend') }}/assets/img/Classic (1).jpg" alt=""> --}}
        <div class="container">
            <div class="title">
                <h2>XÁC NHẬN ĐẶT PHÒNG</h2>
            </div>
        </div>
    </div>
    <div style="background-color: white" class="banner-detail-rooms">
        <div style="padding-top:5%" class="container">
            <div class="row">
                <div class="col-md-4">
                    <form class="form" action="{{ route('frontend.booking.index') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Tên </label>
                            <input type="text" name="name" class="form-control" placeholder="{{ __('Nhập tên') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="{{ __('Nhập email') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại</label>
                            <input type="text" name="phone" class="form-control"
                                placeholder="{{ __('Nhập số điện thoại') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Ghi chú</label>
                            <textarea name="note" cols="10" rows="5" class="form-control" placeholder="{{ __('Nhập ghi chú') }}"></textarea>
                        </div>
                        <button type="submit" class="book-room-now3">
                         {{__('Xác nhận') }}
                        </button>
                        <button type="button" class="book-room-now3 float-right">
                           <a href="{{ route('frontend.checking.index') }}"> {{__('Đặt thêm phòng') }}</a>
                           </button>

                </div>
                <div class="col-md-8" style="margin-top: 30px">
                    <table style="font-size:13px" class="table table-striped table-inverse table-hover">
                        <thead>
                            <tr class=text-center>
                                <th>{{ __('Số phòng') }}</th>
                                <th>{{ __('Ngày đến') }}</th>
                                <th>{{ __('Ngày đi') }}</th>
                                <th>{{ __('Số đêm') }}</th>
                                <th>{{ __('Đơn giá') }}</th>
                                <th>{{ __('Thành tiền') }}</th>
                                <th>{{ __('Thao tác') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($order->items as $i => $item)
                                <tr class="text-center">
                                    <td >
                                        <a href="{{ route('frontend.slug',$item['slug']) }}">
                                         {{ $item['code'] }}</td>
                                    </a>
                                    <td>
                                        {{  date("d-m-Y", strtotime(session('checking')['from_date'])) }}
                                    </td>
                                    <td>
                                        {{  date("d-m-Y", strtotime(session('checking')['to_date'])) }}
                                    </td>
                                    <td>
                                        {{ $item['time'] }}
                                    </td>
                                    <td class="text-right"> {{ number_format($item['sale_price']) }}₫</td>
                                    <td class="text-right">
                                        {{ number_format($item['sale_price'] * $item['time']) }} đ
                                    </td>
                                    <td class="text-center">
                                        <a  href="{{ route('order.remove',$item['id']) }}"><i style="color:rgb(212, 97, 97)" class="fa-solid fa-trash del-confirm"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif(Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
                </form>

            </div>
        </div>
    </div>


@endsection
@push('script')
    <style>
        .book-room-now3 a:hover{
            color: black;

        }
    </style>
@endpush

