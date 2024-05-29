@extends('layouts.admin')

@section('title', 'Danh sách đơn hàng')
@section('content')
    <div id="content" class="fl-right">
        <div id="card" class="mb-5">
            <div class="card-header">
                <div class="d-flex justify-content-between w-40">
                    <h3 id="index">Danh sách đơn hàng</h3>
                </div>
            </div>
            <div class="card-end pb-5">
                <div class="filter-wp clearfix">
                    <ul class="post-status fl-left">
                        <li class="all"><a href="">Tất cả <span class="count">({{ $key_all }})</span></a> |
                        </li>
                        <li class="publish"><a href="">Hoàn thành<span
                                    class="count">({{ $key_delivered }})</span></a>
                            |</li>
                        <li class="pending"><a href="">Đã bị hủy<span class="count">({{ $key_canceled }})</span>
                                |</a></li>
                        <li class="pending"><a href="">Khác<span class="count">({{ $key_other }})</span></a></li>
                    </ul>
                </div>
                <div class="actions">
                    <form method="POST" action="" class="form-actions">
                        <select name="status">
                            <option value="">Chọn trạng thái</option>
                            <option value="delivered">Hoàn thành</option>
                            <option value="canceled">Đơn hủy</option>
                            <option value="different">Khác</option>
                        </select>
                        <input type="submit" name="sm_action" value="Áp dụng">
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="table-active">
                                <td><span class="thead-text">STT</span></td>
                                <td><span class="thead-text">Mã đơn hàng</span></td>
                                <td><span class="thead-text">Họ và tên</span></td>
                                <td><span class="thead-text">Số sản phẩm</span></td>
                                <td><span class="thead-text">Tổng giá</span></td>
                                <td><span class="thead-text">Trạng thái</span></td>
                                <td><span class="thead-text">Chi tiết</span></td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $temp = 1;
                            @endphp
                            @foreach ($orders as $item)
                                <tr>
                                    <td><span class="tbody-text">{{ $temp++ }}</h3></span>
                                    <td><span class="tbody-text">{{ $item->code }}</h3></span>
                                    <td>
                                        <div class="tb-title fl-left">
                                            <a href=""
                                                title="">{{ $item->find($item->customer_id)->customer->fullname }}</a>
                                        </div>

                                    </td>
                                    <td><span class="tbody-text">{{ $item->quantity }}</span></td>
                                    <td><span class="tbody-text">{{ number_format($item->total_amout) }}</span></td>
                                    <td><span class="tbody-text {{ $item->status }}">{{ $item->status_label }}</span></td>
                                    <td><a href="{{ route('sel.detailOrder', $item->id) }}" title=""
                                            class="tbody-text">Chi tiết</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="section" id="paging-wp">
            <div class="section-detail clearfix">
            </div>
        </div>
    </div>
@endsection
