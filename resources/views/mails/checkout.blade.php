<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success - SHOES STORE</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
            text-align: center;
        }

        h1,
        h2 {
            margin-top: 0;
            font-size: 16px;
        }

        .success-message {
            background-color: #ffffff;
            color: #000000;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: left;
            max-width: 800px;
            margin: auto;
        }

        .info-order {
            border-bottom: 2px solid #8d7a7a;
        }

        .info-order p {
            margin: 0;
            color: red;
            font-weight: bold;
            padding: 5px 0;
        }

        .customer {
            display: flex;
            justify-content: space-between;
            border-bottom: 2px solid #8d7a7a;
            margin-bottom: 10px;
        }

        .customer .info-customer {
            margin-right: 20px;
        }

        .customer p>strong {
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #d6d6d6;
            padding: 10px;
            text-align: left;
            background-color: #e5e5e5;
        }

        th {
            background-color: #e40c0c;
            color: white;
        }

        th {
            text-align: center;
            text-transform: uppercase;
        }

        .total-row {
            font-weight: bold;
        }

        .order-details span {
            font-weight: 600;
            color: red;
        }
    </style>
</head>

<body>

    <div class="success-message">
        <h1>Xin chào {{$fullname}} ,</h1>
        <p>Đơn hàng # {{$code}} của bạn đã được đặt thành công ngày {{$currentDate}} </p>

        <div class="info-order">
            <p>MÃ ĐƠN HÀNG: #<span> {{$code}} </span></p>
            <p>THỜI GIAN ĐẶT: <span> {{$time}} </span></p>
        </div>

        <div class="customer">
            <div class="info-customer">
                <h3>Thông tin khách hàng</h3>
                <p><strong>Họ và tên khách hàng:</strong> {{$fullname}} </p>
                <p><strong>Số điện thoại:</strong> {{$phone}} </p>
                <p><strong>Email:</strong> {{$email}} </p>
            </div>
            <div class="address-customer">
                <h3>Địa chỉ giao hàng</h3>
                <p><strong>Địa chỉ:</strong> {{$address}} </p>
            </div>
        </div>

        <h2>THÔNG TIN ĐƠN HÀNG - DÀNH CHO NGƯỜI MUA</h2>
        <table>
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Size</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->options->size }}</td>
                        <td>{{ number_format($item->price) }}đ</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ number_format($item->total) }}đ</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="4">Tổng tiền</td>
                    <td>{{ $total_amout }}</td>
                </tr>
            </tfoot>
        </table>
        <div class="order-details">
            <p>Xin khách hàng hãy kiểm tra lại thông tin cá nhân của mình và thông tin đơn hàng. </p>
            <p>Nếu có bất ký sai sót hay thắc mắc gì xin hãy liên hệ ngay với chúng tôi</p>
            <p>Liên hệ Hotline: <span>0338.237.xxx</span>(24/24 bất cả ngày nào trong tuần)</p>
            <p><span>SHOES STORE</span> cảm ơn quý khách hàng đã tin tưởng và đặt hàng của chúng tôi.</p>
            <div class="signature">
                <p>Trân trọng,</p>
                <p>Shoes Store</p>
            </div>
        </div>
    </div>

</body>

</html>
