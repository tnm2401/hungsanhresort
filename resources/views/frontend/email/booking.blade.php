@php
    // $items = Cart::getContent();
    // $count_item = $items->count();
    // $count = Cart::getTotalQuantity();
    // dd($count);
@endphp
<p style="font-family:Arial,Helvetica,sans-serif;font-size:10pt;">Kính gửi Quý Khách Hàng!</b></p>
<p style="font-family:Arial,Helvetica,sans-serif;font-size:10pt;">Cảm ơn quý khách <b>{{ $account_name }}</b></p>
<p style="font-family:Arial,Helvetica,sans-serif;font-size:10pt;">HungSanh Resort xin chân thành cảm ơn quý khách. Đơn đặt phòng của của khách đã được cập nhập. Nhân viên của chúng tôi sẽ nhanh chóng liên hệ để xác nhận lại thông tin đặt phòng với quý khách. Trong trường hợp vì một vài lý do quý khách không nhận được cuộc gọi xác nhận, xin vui lòng liên hệ :  <b>0962.586.038 </b> để được hỗ trợ trực tiếp.
   </p>
<p style="font-family:Arial,Helvetica,sans-serif;font-size:10pt;"><b>Chi tiết đặt phòng của quý khách như sau:</b></p>
{{-- <p><b>Ngày đặt hàng:</b> {{ $order->order_date }}</p> --}}
<table style="border-collapse:collapse;border-style:1px solid;border-color:#2b3a42;font-family:Arial,Helvetica,sans-serif;font-size:10pt;line-height: 24px;" width="100%" cellspacing="0" cellpadding="0" border="1">
    <thead>
        <tr colspan="2" style="background-color:#2b3a42;color:#fff;padding:8px">
            <th style="font-family:Arial,Helvetica,sans-serif;font-size:10pt;font-weight:bold;line-height: 24px;padding:8px 8px;">STT</th>
            <th style="font-family:Arial,Helvetica,sans-serif;font-size:10pt;font-weight:bold;line-height: 24px;padding:8px 8px;">Phòng</th>
            <th style="font-family:Arial,Helvetica,sans-serif;font-size:10pt;font-weight:bold;line-height: 24px;padding:8px 8px;">Ngày đến</th>
            <th style="font-family:Arial,Helvetica,sans-serif;font-size:10pt;font-weight:bold;line-height: 24px;padding:8px 8px;">Ngày đi</th>
            <th style="font-family:Arial,Helvetica,sans-serif;font-size:10pt;font-weight:bold;line-height: 24px;padding:8px 8px;">Giá phòng</th>

            {{-- <th style="font-family:Arial,Helvetica,sans-serif;font-size:10pt;font-weight:bold;line-height: 24px;padding:8px 8px;">Thành tiền</th> --}}
        </tr>
    </thead>
    <tbody>

        @foreach($items as $item)
        <tr>
            <td style="line-height: 24px;text-align: center;padding:8px 8px;">{{ $loop->iteration }}</td>
            <td style="line-height: 24px;text-align: center;padding:8px 8px;">{{ $item['name'] }}
            </td>
            <td style="line-height: 24px;text-align: center;padding:8px 8px;">
                {{  date("d-m-Y", strtotime($from_date))}}
            </td>
            <td style="line-height: 24px;text-align: center;padding:8px 8px;">
                {{  date("d-m-Y", strtotime($to_date))}}
            </td>
            <td style="line-height: 24px;text-align: center;padding:8px 8px;">{{ number_format($item['sale_price']) }}₫</td>
        </tr>

        @endforeach
        {{-- <tr>
            <td colspan="5" style="padding:8px 8px"><b style="color:red;line-height: 24px;">Tổng tiền: </b><b>{{ number_format($total_price) }}₫  </b>
            </td>
        </tr> --}}
    </tbody>
</table>
<p style="font-family:Arial,Helvetica,sans-serif;font-size:10pt;line-height: 24px;">Trân trọng cảm ơn Quý khách hàng <b>{{ $account_name }}</b></p>
<p style="font-family:Arial,Helvetica,sans-serif;font-size:10pt;line-height: 24px;">
    Hungsanh Resort
    179 Trần Hưng Đạo, Dương Tơ, Phú Quốc
    0962.586.038
    www.hungsanhreort.com

</p>
