<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body onload="window.print();">
{{-- <body> --}}

    <style>

        table{
            width: 100%;
            border: dotted 1px grey;
        }
        td{
            border: dotted 1px black;
        }
    </style>


        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-3">
                        <img width="150" src="{{ asset('storage') }}/uploads/setting/{{ $setting->logoindex }}" alt="">
                        <span>Liên 1</span>

                    </div>
                    <div class="col-md-9">
                        <div class="text-center">
                            <div class="text-uppercase"><b>{{ $setting->translations->name }}</b> </div>
                            <div style="font-size:14px" class="text-capitalize"><i>{{ $setting->translations->address }}</i></div>
                            <b>{{ $setting->hotline_1 }}</b>
                            <br>
                            <a href="">{{ $setting->web }}</a>
                            <div class="text-uppercase"> <b>hóa đơn cung cấp dịch vụ</b> </div>
                        </div>
                    </div>
                </div>


                <div class="d-flex justify-content-between">
                    <span class="text-capitalize"><i>Mã đơn hàng : </i>{{ $data['cart']->code }}</span>
                    <span class="text-danger text-uppercase">Số phòng: {{ $data['cart']->room->code }}</span>

                </div>


                <div class="d-flex justify-content-between">

                    <span class="text-capitalize"><i>Tên khách hàng : </i>{{ $data['cart']->customer->name }}</span>
                    <span > Từ:  {{ date('d/m/Y', strtotime( $data['cart']->from_date));
                    }} - {{ date('d/m/Y', strtotime( $data['cart']->to_date));
                    }}</span>

                </div>
                <table class="text-center">
                    <tr >
                        <th>STT</th>
                        <th>DỊCH VỤ</th>
                        <th>SL</th>
                        <th>ĐVT</th>
                        <th> GIÁ</th>
                        {{-- <th>CHIẾT KHẤU</th> --}}
                        <th>T TIỀN</th>
                    </tr>
                    <tr >
                        <td>1</td>
                        <td><b> Tiền phòng</b></td>
                        <td>{{ $data['night'] }} </td>
                        <td>Đêm</td>
                        <td>{{ number_format($data['cart']->room->procatone->price) }} đ</td>
                        {{-- <td></td>   --}}
                        <td>{{ number_format($data['price_room']) }} đ</td>
                    </tr>
                    @forelse ($data['detailsv'] as $k => $detail)
                    <tr >
                        <td>{{ $k +2 }}</td>
                        <td><strong>{{ $detail->name }}</strong></td>
                        <td>{{ $detail->quantity }}</td>
                        <td >{{ $detail->unit }}</td>
                        <td>{{ number_format($detail->price) }} đ</td>
                        <td>{{ number_format($detail->quantity * $detail->price) }}
                            đ</td>
                    </tr>
                @empty
                @endforelse
                    <tr >
                        <td colspan="3"  rowspan="3"> <b>TỔNG</b> </td>
                        <td colspan="2"><b>TRƯỚC THUẾ</b></td>
                        <td>{{ number_format($data['total_price_service'] + $data['price_room']) }} đ</td>
                    </tr>
                    <tr >
                        <td colspan="2"><b>VAT ({{ $data['cart']->vat }} %)</b></td>
                        <td>{{ number_format($data['vat']) }} đ</td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>SAU THUẾ</b></td>
                        <td>{{ number_format($data['cart']->total) }} đ</td>
                    </tr>
                </table>

                <div class="d-flex justify-content-end mt-2 text-center">
                    <div >
                        <div class="text-capitalize">phú quốc, ngày {{ date('d') }} tháng {{ date('m') }} năm {{ date('Y') }}</div>
                        <b>Đại diện Thanh Hotel & Resort</b>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-3">
                        <img width="150" src="{{ asset('storage') }}/uploads/setting/{{ $setting->logoindex }}" alt="">
                        <span>Liên 2</span>

                    </div>
                    <div class="col-md-9">
                        <div class="text-center">
                            <div class="text-uppercase"><b>{{ $setting->translations->name }}</b> </div>
                            <div style="font-size:14px" class="text-capitalize"><i>{{ $setting->translations->address }}</i></div>
                            <b>{{ $setting->hotline_1 }}</b>
                            <br>
                            <a href="">{{ $setting->web }}</a>
                            <div class="text-uppercase"> <b>hóa đơn cung cấp dịch vụ</b> </div>
                        </div>
                    </div>
                </div>


                <div class="d-flex justify-content-between">
                    <span class="text-capitalize"><i>Mã đơn hàng : </i>{{ $data['cart']->code }}</span>
                    <span class="text-danger text-uppercase">Số phòng: {{ $data['cart']->room->code }}</span>

                </div>


                <div class="d-flex justify-content-between">

                    <span class="text-capitalize"><i>Tên khách hàng : </i>{{ $data['cart']->customer->name }}</span>
                    <span > Từ:  {{ date('d/m/Y', strtotime( $data['cart']->from_date));
                    }} - {{ date('d/m/Y', strtotime( $data['cart']->to_date));
                    }}</span>

                </div>
                <table class="text-center">
                    <tr >
                        <th>STT</th>
                        <th>DỊCH VỤ</th>
                        <th>SL</th>
                        <th>ĐVT</th>
                        <th> GIÁ</th>
                        {{-- <th>CHIẾT KHẤU</th> --}}
                        <th>T TIỀN</th>
                    </tr>
                    <tr >
                        <td>1</td>
                        <td><b> Tiền phòng</b></td>
                        <td>{{ $data['night'] }} </td>
                        <td>Đêm</td>
                        <td>{{ number_format($data['cart']->room->procatone->price) }} đ</td>
                        {{-- <td></td>   --}}
                        <td>{{ number_format($data['price_room']) }} đ</td>
                    </tr>
                    @forelse ($data['detailsv'] as $k => $detail)
                    <tr >
                        <td>{{ $k +2 }}</td>
                        <td><strong>{{ $detail->name }}</strong></td>
                        <td>{{ $detail->quantity }}</td>
                        <td >{{ $detail->unit }}</td>
                        <td>{{ number_format($detail->price) }} đ</td>
                        <td>{{ number_format($detail->quantity * $detail->price) }}
                            đ</td>
                    </tr>
                @empty
                @endforelse
                    <tr >
                        <td colspan="3"  rowspan="3"> <b>TỔNG</b> </td>
                        <td colspan="2"><b>TRƯỚC THUẾ</b></td>
                        <td>{{ number_format($data['total_price_service'] + $data['price_room']) }} đ</td>
                    </tr>
                    <tr >
                        <td colspan="2"><b>VAT ({{ $data['cart']->vat }} %)</b></td>
                        <td>{{ number_format($data['vat']) }} đ</td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>SAU THUẾ</b></td>
                        <td>{{ number_format($data['cart']->total) }} đ</td>
                    </tr>
                </table>

                <div class="d-flex justify-content-end mt-2 text-center">
                    <div >
                        <div class="text-capitalize">phú quốc, ngày {{ date('d') }} tháng {{ date('m') }} năm {{ date('Y') }}</div>
                        <b>Đại diện Thanh Hotel & Resort</b>
                    </div>
                </div>
            </div>
        </div>

</body>
</html>
