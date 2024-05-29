@extends('layouts.app')

@section('title', 'Danh sách sản phẩm')
@section('content')
    <div id="main-content-wp" class="clearfix category-product-page">
        <div class="wp-inner">
            <div class="secion" id="breadcrumb-wp">
                <div class="secion-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="/" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a class="path_active" href="{{route('list')}}" title="">Sản phẩm</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-content fl-right">
                <div class="section" id="list-product-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title fl-left">Danh sách sản phẩm</h3>
                        <div class="filter-wp fl-right">
                            <p class="desc">Hiển thị {{ $count }} trên {{ $total }} sản phẩm</p>
                        </div>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            @foreach ($products as $product)
                                <li>
                                    <a href="{{ route('detail', $product->slug) }}" title="" class="thumb-same">
                                        <img src="{{ asset($product->images[0]->src) }}">
                                    </a>
                                    <a href="{{ route('detail', $product->slug) }}" title=""
                                        class="product-name">{{ $product->name }}</a>
                                    <div class="price">
                                        <span class="new">{{ number_format($product->price) }}đ</span>
                                        <span class="old">{{ number_format($product->initial) }}đ</span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="{{ route('detail', $product->slug) }}" title="" class="buy-now">Mua
                                            ngay</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="section" id="paging-wp">
                    <div class="section-detail">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
            <div class="sidebar fl-left">
                <div class="section" id="category-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Danh mục sản phẩm</h3>
                    </div>
                    <div class="secion-detail">
                        <ul class="list-item">
                            @foreach ($categories as $item)
                                <li>
                                    <a href="{{ route('product.category', $item->category_slug) }}" title="{{ $item->category_name }}">{{ $item->category_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="section" id="filter-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Bộ lọc</h3>
                    </div>
                    <div class="section-detail">
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Giá</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="price" value="1"
                                            @if (in_array(1, explode(',', $q_price))) checked="checked" @endif
                                            onchange="filterProductsByPrice(this)" id="filterPrice">
                                    </td>
                                    <td>Dưới 500.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="price" value="2"
                                            @if (in_array(2, explode(',', $q_price))) checked="checked" @endif
                                            onchange="filterProductsByPrice(this)" id="filterPrice">
                                    </td>
                                    <td>500.000đ - 1.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="price" value="3"
                                            @if (in_array(3, explode(',', $q_price))) checked="checked" @endif
                                            onchange="filterProductsByPrice(this)" id="filterPrice">
                                    </td>
                                    <td>1.000.000đ - 2.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="price" value="4"
                                            @if (in_array(4, explode(',', $q_price))) checked="checked" @endif
                                            onchange="filterProductsByPrice(this)" id="filterPrice">
                                    </td>
                                    <td>2.000.000đ - 4.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="price" value="5"
                                            @if (in_array(5, explode(',', $q_price))) checked="checked" @endif
                                            onchange="filterProductsByPrice(this)" id="filterPrice">
                                    </td>
                                    <td>Trên 4.000.000đ</td>
                                </tr>
                            </tbody>
                        </table>
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Hãng giày</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $item)
                                    <tr>
                                        <td><input type="checkbox" name="categories" value="{{ $item->id }}"
                                                class="filter" @if (in_array($item->id, explode(',', $q_categories))) checked="checked" @endif
                                                onchange="filterProductsByCategory(this)"></td>
                                        <td>{{ $item->category_name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="section" id="banner-wp">
                    <div class="section-detail">
                        <a href="" title="" class="thumb">
                            <img src="{{ asset('themes/images/banner-shoes.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form method="GET" id="frmFilter">
        <input type="hidden" name="categories" id="categories" value="{{ $q_categories }}">
        <input type="hidden" name="price" id="price" value="{{ $q_price }}">
    </form>
@endsection

@section('addJs')
    <script>
        function filterProductsByCategory(brand) {
            var categories = "";
            $("input[name='categories']:checked").each(function() {
                if (categories == "") {
                    categories += this.value;
                } else {
                    categories += "," + this.value;
                }
            });
            $("#categories").val(categories);
            $("#frmFilter").submit();
        }

        function filterProductsByPrice(price) {
            var price = "";
            $("input[name='price']:checked").each(function() {
                if (price == "") {
                    price += this.value;
                } else {
                    price += "," + this.value;
                }
            });
            $("#price").val(price);
            $("#frmFilter").submit();
        }
    </script>
@endsection
