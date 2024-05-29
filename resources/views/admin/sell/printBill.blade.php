<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shoes store - In hóa đơn</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>In hóa đơn</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('admin_style/css/pdf.css') }}" />
    <script src="{{ asset('admin_style/js/pdf.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

</head>

<body>
    <div class="container d-flex justify-content-center mt-50 mb-50">
        <div class="row">
            <div class="col-md-12 text-right mb-3">
                <button class="btn btn-primary" id="download">In hóa đơn</button>
            </div>
            <div class="col-md-12">
                <form action="" method="post">
                    <div class="card" id="invoice">
                        <div class="card-header bg-transparent header-elements-inline">
                            <h6 class="card-title" style="color: #ff0000; font-weight: bold; font-size: 24px;">PHIẾU HÓA
                                ĐƠN</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-4 pull-left">

                                        <ul class="list list-unstyled mb-0 text-left">
                                            <li style="font-size: 18px; font-weight: bold; color: #3e56e7;">SHOES STORE
                                            </li>
                                            <li>145 Hoàng Cầu</li>
                                            <li>Quận Đống Đa</li>
                                            <li>Hà Nội</li>
                                            <li>+(84) 837 4712 312</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-4 ">
                                        <div class="text-sm-right">
                                            <h4 class="invoice-color mb-2 mt-md-2">Hóa đơn <span id="invoice-code"
                                                    style="font-size: 14px;">#{{ $order->code }}</span></h4>
                                            <ul class="list list-unstyled mb-0">
                                                <li style="font-weight: bold">Ngày đặt hàng: <span
                                                        class="font-weight-semibold"
                                                        style="font-weight: normal">{{ $order->order_date }}</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-md-flex flex-md-wrap">
                                <div class="mb-4 mb-md-2 text-left"> <span class="text-muted">Hóa đơn đến:</span>
                                    <ul class="list list-unstyled mb-0">
                                        <li>
                                            <h5 class="my-2">{{ $customer->fullname }}</h5>
                                        </li>
                                        <li><span class="font-weight-semibold">{{ $customer->address }}</span></li>
                                        <li>{{ $customer->phone }}</li>
                                        <li>{{ $customer->email }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-lg">
                                <thead>
                                    <tr>
                                        <th>Hình ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Size</th>
                                        <th>Số lượng</th>
                                        <th>Giá</th>
                                        <th>Thành tiền tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order_items as $item)
                                        <tr>
                                            <td>
                                                <img src="{{ asset($item->image_url) }}" id="proudct-thumb-img"
                                                    alt="{{ $item->product_name }}">
                                            </td>
                                            <td>
                                                <h6 class="mb-0">{{ $item->product_name }}</h6>
                                            </td>
                                            <td>{{ $item->size }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td><span
                                                    class="font-weight-semibold">{{ number_format($item->price) }}đ</span>
                                            </td>
                                            <td><span
                                                    class="font-weight-semibold">{{ number_format($item->price * $item->quantity) }}đ</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-body">
                            <div class="d-md-flex flex-md-wrap">
                                <div class="pt-2 mb-3 wmin-md-400 ml-auto">
                                    <h6 class="mb-3 text-left">Tổng chi phí</h6>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th class="text-left">Thành tiền:</th>
                                                    <td class="text-right">{{ number_format($order->total_amout) }}đ
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</body>

</html>
