@extends('layouts.admin')

@section('title', 'Page Title')
@section('custom-css')
    <link href="{{ asset('admin_style/css/user/list_user.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div id="content" class="fl-right">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div id="card" class="mb-5">
            <div class="card-header">
                <div class="d-flex justify-content-between w-40">
                    <h3 id="index">Danh sách sản phẩm</h3>
                    <a href="{{ route('product.add') }}" title="" id="add-new">Thêm mới</a>
                </div>
                <div class="controls">
                    <form action="">
                        <input type="text" name="keyword" value="{{ request()->input('keyword') }}"
                            placeholder="Tìm kiếm" id="keywordInput" />
                        <input type="hidden" value="product" id="urlLoad">
                        <button class="search-btn">Tìm kiếm</button>
                    </form>
                </div>
            </div>
            <div class="card-end pb-5">
                <div class="card-body mb-3 w-100 px-0">
                    <div>
                        <ul class="post-status">
                            <li class="all">Hiển thị <span>{{ $count }}</span> trên
                                <span>{{ $total }}<span> sản phẩm
                            </li>
                        </ul>
                    </div>
                    <div>
                        <button class="reset-btn" id="resetBtn">Mặc định</button>
                    </div>
                    <div class="d-flex">
                        <form class="mx-2">
                            <select name="orderBy" id="orderby">
                                <option value="default" {{ $order == 'default' ? 'selected' : '' }}>Mặc định</option>
                                <option value="active" {{ $order == 'active' ? 'selected' : '' }}>Công khai</option>
                                <option value="inactive" {{ $order == 'inactive' ? 'selected' : '' }}>Không công khai
                                </option>
                                <option value="out_of_stock" {{ $order == 'out_of_stock' ? 'selected' : '' }}>Hết hàng
                                </option>
                                <option value="new" {{ $order == 'new' ? 'selected' : '' }}>Mới nhất</option>
                                <option value="old" {{ $order == 'old' ? 'selected' : '' }}>Cũ nhất</option>
                            </select>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-primary">
                                <td><span class="thead-text">STT</span></td>
                                <td><span class="thead-text">Mã sản phẩm</span></td>
                                <td><span class="thead-text">Hình ảnh</span></td>
                                <td><span class="thead-text">Tên sản phẩm</span></td>
                                <td><span class="thead-text">Giá bán</span></td>
                                <td><span class="thead-text">Danh mục</span></td>
                                <td><span class="thead-text">Trạng thái</span></td>
                                <td><span class="thead-text">Người tạo</span></td>
                                <td><span class="thead-text">Thời gian</span></td>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($products->total() > 0)
                                @php
                                    $temp = 1;
                                @endphp
                                @foreach ($products as $product)
                                    <tr>
                                        <td><span class="tbody-text">{{ $temp++ }}</span>
                                        <td><span class="tbody-text">{{ $product->code }}</span>
                                        <td>
                                            <div class="tbody-thumb">
                                                <img src="{{ asset($product::find($product->id)->images[0]['src']) }}"
                                                    alt="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="tb-title fl-left">
                                                <a href="{{ route('product.edit', $product->id) }}"
                                                    title="">{{ $product->name }}</a>
                                            </div>
                                            <ul class="list-operation fl-right">
                                                <li><a href="{{ route('product.edit', $product->id) }}" title="Sửa"
                                                        class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                </li>
                                                <li><a href="{{ route('product.delete', $product->id) }}" title="Xóa"
                                                        class="delete"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"><i
                                                            class="fa fa-trash" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </td>
                                        <td><span class="tbody-text">{{ number_format($product->price) }}đ</span></td>
                                        <td><span
                                                class="tbody-text">{{ $product::find($product->id)->category['category_name'] }}</span>
                                        </td>
                                        <td><span
                                                class="tbody-text {{ $product->status }}">{{ $product->status_label }}</span>
                                        </td>
                                        <td><span class="tbody-text">{{$product->created_by}}</span></td>
                                        <td><span class="tbody-text">{{ $product->created_at }}</span></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9" class="nullResult">Không tìm thấy sản phẩm</td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="section" id="paging-wp">
            <div class="section-detail">
                {{ $products->links() }}
            </div>
        </div>
    </div>
    <form method="GET" id="frmFilter">
        <input type="hidden" id="order" name="order" value="{{ $order }}" />
    </form>
@endsection

@section('addJs')
    <script>
        $("#orderby").on("change", function() {
            $("#order").val($("#orderby option:selected").val());
            $("#frmFilter").submit();
        });
    </script>
@endsection