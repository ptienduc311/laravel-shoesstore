@extends('layouts.admin')

@section('title', 'Danh sách khách hàng')
@section('content')
    <div id="content" class="fl-right">
        <div id="card" class="mb-5">
            <div class="card-header">
                <div class="d-flex justify-content-between w-40">
                    <h3 id="index">Danh sách khách hàng</h3>
                </div>
            </div>
            <div class="card-end pb-5">
                <div class="filter-wp clearfix">
                    <ul class="post-status fl-left">
                        <li class="all"><a href="">Tất cả <span
                                    class="count">({{ $customers->count() }})</span></a>
                        </li>
                    </ul>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="table-active">
                                <td><span class="thead-text">STT</span></td>
                                <td><span class="thead-text">Họ và tên</span></td>
                                <td><span class="thead-text">Số điện thoại</span></td>
                                <td><span class="thead-text">Email</span></td>
                                <td><span class="thead-text">Địa chỉ</span></td>
                                <td><span class="thead-text">Số lượng</span></td>
                                <td><span class="thead-text">Thời gian đặt</span></td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $temp = 1;
                            @endphp
                            @foreach ($customers as $item)
                                <tr>
                                    <td><span class="tbody-text">{{ $temp++ }}</h3></span>
                                    <td>
                                        <div class="tb-title fl-left">
                                            <a href="{{ route('sel.detailOrder', $item->order->id) }}"
                                                title="">{{ $item->fullname }}</a>
                                        </div>
                                    </td>
                                    <td><span class="tbody-text">{{ $item->phone }}</span></td>
                                    <td><span class="tbody-text">{{ $item->email }}</span></td>
                                    <td><span class="tbody-text">{{ $item->address }}</span></td>
                                    <td><span class="tbody-text">{{ $item->order->quantity }} sản phẩm</span></td>
                                    <td><span class="tbody-text">{{ $item->order->order_date }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="section" id="paging-wp">
        </div>
    </div>
@endsection
