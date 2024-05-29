@extends('layouts.admin')

@section('title', 'Page Title')
@section('content')
    <div id="content" class="fl-right bg-white">
        <div id="info-customer">
            <h2>Thông tin đơn hàng</h2>
            <div class="title-info">
                <i class="fa-solid fa-id-card"></i>
                <p>Thông tin khách hàng</p>
            </div>
            <div class="table-info">
                <table>
                    <thead>
                        <tr>
                            <th>Họ và tên</th>
                            <th>Mã đơn</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Thời gian đặt</th>
                            <th>Chú thích</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$customer->fullname}}</td>
                            <td>{{$order->code}}</td>
                            <td>{{$customer->address}}</td>
                            <td>{{$customer->phone}}</td>
                            <td>{{$customer->email}}</td>
                            <td>{{$order->order_date}}</td>
                            <td>{{$customer->note}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <form action="{{route('update.status', $order->id)}}" method="post">
                @csrf
                <div class="order-status">
                    <div class="info-status">
                        <div class="title-info">
                            <i class="fa-brands fa-slack"></i>
                            <p>Trạng thái đơn hàng:</p>
                            <p class="{{$order->status}}">{{$order->status_label }}</p>

                        </div>
                        <div class="change-status">
                            <select name="select-status" id="">
                                <option value="">Cập nhật tình trạng đơn hàng</option>
                                <option @if ($order->status == 'pending') selected @endif value="pending">Chưa xử lý</option>
                                <option @if ($order->status == 'processing') selected @endif value="processing">Đang xử lý</option>
                                <option @if ($order->status == 'shipping') selected @endif value="shipping">Đang vận chuyển</option>
                                <option @if ($order->status == 'delivered') selected @endif value="delivered">Hoàn thành</option>
                                <option @if ($order->status == 'canceled') selected @endif value="canceled">Đã bị hủy</option>
                            </select>
                            <button name="btn-change" type="submit">Cập nhật</button>
                        </div>
                    </div>
                    <div class="table-info">
                        <table>
                            <thead>
                                <tr>
                                    <th>Tổng số lượng</th>
                                    <th>Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$order->quantity}} sản phẩm</td>
                                    <td>{{number_format($order->total_amout)}}đ</td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </form>
        </div>
        <div id="detail-order">
            <h2>Chi tiết đơn hàng</h2>
            <div class="table-info data-product">
                <table>
                    <thead>
                        <tr>
                            <th>Ảnh</th>
                            <th>Tên</th>
                            <th>Size</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order_items as $item)
                            <tr>
                            <td><img src="{{asset($item->image_url)}}" id="proudct-thumb-img" alt="{{$item->product_name}}"></td>
                            <td>{{$item->product_name}}</td>
                            <td>{{$item->size}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{number_format($item->price)}}đ</td>
                            <td>{{number_format($item->price * $item->quantity)}}đ</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <button class="btn-print-bill">
            <a href="{{route('printBill', $order->id)}}" style="color:#fff;" target="_blank">In hóa đơn</a>
        </button>
    </div>
@endsection
