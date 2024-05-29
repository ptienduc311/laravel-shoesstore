@extends('layouts.app')

@section('title', 'Sản phẩm theo danh mục')
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
                            <a href="{{route('list')}}" title="">Sản phẩm</a>
                        </li>
                        <li>
                            <a class="path_active" href="" title=""
                                style="text-transform: uppercase;">{{ $nameCat }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-content fl-right">
                <div class="section" id="list-product-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title fl-left"> </h3>
                        <div class="filter-wp fl-right">
                            <p class="desc">Hiển thị {{ $count }} trên {{ $total }} sản phẩm</p>
                            <div class="form-filter">
                                <form>
                                    <select name="orderby" id="orderby">
                                        <option value="-1" {{ $order == -1 ? 'selected' : '' }}>Mặc định</option>
                                        <option value="1" {{ $order == 1 ? 'selected' : '' }}>Từ A-Z</option>
                                        <option value="2" {{ $order == 2 ? 'selected' : '' }}>Từ Z-A</option>
                                        <option value="3" {{ $order == 3 ? 'selected' : '' }}>Giá cao xuống thấp</option>
                                        <option value="4" {{ $order == 4 ? 'selected' : '' }}>Giá thấp lên cao</option>
                                    </select>
                                </form>
                            </div>
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
                                    <a href="{{ route('product.category', $item->category_slug) }}"
                                        title="{{ $item->category_name }}">{{ $item->category_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="section" id="selling-wp">
                    <div class="section-head">
                        <h3 class="section-title">Sản phẩm bán chạy</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            @foreach ($products_selling as $product)
                                <li class="clearfix">
                                    <a href="{{ route('detail', $product->slug) }}" title="" class="thumb fl-left">
                                        <img src="{{ asset($product->images[0]['src']) }}" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="{{ route('detail', $product->slug) }}" title=""
                                            class="product-name">{{ $product->name }}</a>
                                        <div class="price">
                                            <span class="new">{{ number_format($product->price) }}đ</span>
                                            <span class="old">{{ number_format($product->initial) }}đ</span>
                                        </div>
                                        <a href="{{ route('detail', $product->slug) }}" title="" class="buy-now">Mua
                                            ngay</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="section" id="banner-wp">
                    <div class="section-detail">
                        <a href="?page=detail_product" title="" class="thumb">
                            <img src="{{ asset('themes/images/banner-shoes.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
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
