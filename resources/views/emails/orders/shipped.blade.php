<!-- resources/views/emails/orders/shipped.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Đơn hàng của bạn đã được gửi đi</title>
</head>
<body>
    <h1>Đơn hàng của bạn đã được gửi đi!</h1>
    <p>Cảm ơn bạn đã mua sắm cùng chúng tôi. Dưới đây là chi tiết của đơn hàng của bạn:</p>

    <ul>
        @php
            $tongCong = 0;
        @endphp

        @foreach($products as $product)
            @php
                $tongTien = $product['soLuong'] * $product['gia'];
                $tongCong += $tongTien;
            @endphp

            <li>
                <strong>{{ $product['tenSanPham'] }}</strong> -
                Số lượng: {{ $product['soLuong'] }} -
                Giá: {{ $product['gia'] }} $ -
                Tổng: {{ $tongTien }} $
            </li>
        @endforeach
    </ul>

    <p><strong>Tổng cộng: {{ $tongCong }} $</strong></p>
</body>
</html>
