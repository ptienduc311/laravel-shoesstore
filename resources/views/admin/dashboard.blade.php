@extends('layouts.admin')

@section('title', 'Dashboard')
@section('content')
    <div id="content" class="fl-right">
        <div class="box-info">
            <div class="box box-success">
                <h2>ĐƠN HÀNG THÀNH CÔNG</h2>
                <p>{{$key_delivered}}</p>
                <p>Đơn hàng giao dịch thành công</p>
            </div>
            <div class="box box-processing">
                <h2>ĐANG XỬ LÝ</h2>
                <p>{{$key_processing}}</p>
                <p>Số lượng đơn hàng đang xử lý</p>
            </div>
            <div class="box box-cancel">
                <h2>ĐƠN HÀNG HỦY</h2>
                <p>{{$key_canceled}}</p>
                <p>Số đơn bị hủy trong hệ thống</p>
            </div>
            <div class="box box-total">
                <h2>TỔNG SỐ SẢN PHẨM TRONG KHO</h2>
                <p>{{$product_count}}</p>
                <p>sản phẩm</p>
            </div>

        </div>
        <div class="box-order">
            <table id="tb-dashboard">
                <thead>
                    <tr>
                        <th>Mã đơn</th>
                        <th>Tên khách hàng</th>
                        <th>Số lượng</th>
                        <th>Tổng giá trị đơn hàng</th>
                        <th>Trạng thái</th>
                        <th>Thời gian đặt</th>
                        <th>Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($orders as $item)
                    <tr>
                        <td>{{$item->code}}</td>
                        <td>{{$item->customer->fullname}}</td>
                        <td>{{$item->quantity}} sản phẩm</td>
                        <td>{{number_format($item->total_amout)}}đ</td>
                        <td><span class="{{$item->status}}">{{$item->status_label }}</span></td>
                        <td>{{$item->order_date}}</td>
                        <td class="actions">
                            <button>
                                <a href="{{route('sel.detailOrder', $item->id)}}"><i class="fa-solid fa-eye"></i></a>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
