<!-- resources/views/emails/orders/shipped.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Đơn hàng của bạn đã được gửi đi</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Đơn hàng của bạn đã được gửi đi!</h1>
    <p>Cảm ơn bạn đã mua sắm cùng chúng tôi. Dưới đây là chi tiết của đơn hàng của bạn:</p>

    <table>
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng</th>
            </tr>
        </thead>
        <tbody>
            @php
                $tongCong = 0;
            @endphp

            @foreach($products as $product)
                @php
                    $tongTien = $product['quantity'] * $product['price'];
                    $tongCong += $tongTien;
                @endphp

                <tr>
                    <td><strong>{{ $product['name'] }}</strong></td>
                    <td>{{ $product['quantity'] }}</td>
                    <td>{{ $product['price'] }}</td>
                    <td>{{ $tongTien }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Tổng cộng: {{ $tongCong }} $</strong></p>
</body>
</html>
