<div class="sidebar fl-left">
    <div class="section" id="category-product-wp">
        <div class="section-head">
            <h3 class="section-title">Danh mục sản phẩm</h3>
        </div>
        <div class="secion-detail">
            <ul class="list-item">
                <li>
                    <a href="?page=category_product" title="">Điện thoại</a>
                    <ul class="sub-menu">
                        <li>
                            <a href="?page=category_product" title="">Iphone</a>
                        </li>
                        <li>
                            <a href="?page=category_product" title="">Samsung</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?page=category_product" title="">Iphone X</a>
                                </li>
                                <li>
                                    <a href="?page=category_product" title="">Iphone 8</a>
                                </li>
                                <li>
                                    <a href="?page=category_product" title="">Iphone 8 Plus</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="?page=category_product" title="">Oppo</a>
                        </li>
                        <li>
                            <a href="?page=category_product" title="">Bphone</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="?page=category_product" title="">Máy tính bảng</a>
                </li>
                <li>
                    <a href="?page=category_product" title="">laptop</a>
                </li>
                <li>
                    <a href="?page=category_product" title="">Tai nghe</a>
                </li>
                <li>
                    <a href="?page=category_product" title="">Thời trang</a>
                </li>
                <li>
                    <a href="?page=category_product" title="">Đồ gia dụng</a>
                </li>
                <li>
                    <a href="?page=category_product" title="">Thiết bị văn phòng</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="section" id="selling-wp">
        <div class="section-head">
            <h3 class="section-title">Sản phẩm bán chạy</h3>
        </div>
        <div class="section-detail">
            <ul class="list-item">
                {{-- <?php
                foreach ($data_product_selling as $item) {
                    $featured_img = get_image_default($item['product_id']);
                ?>
                    <li class="clearfix">
                        <a href="?page=detail_product" title="" class="thumb fl-left">
                            <img src="<?php echo base_url(); ?>/admin/<?php echo $featured_img['image_url']; ?>" alt="">
                        </a>
                        <div class="info fl-right">
                            <a href="?page=detail_product" title="" class="product-name"><?php echo $item['product_name']; ?></a>
                            <div class="price">
                                <span class="new"><?php echo currency_format($item['product_price']); ?></span>
                                <span class="old"><?php echo currency_format($item['product_initial']); ?></span>
                            </div>
                            <a href="" title="" class="buy-now">Mua ngay</a>
                        </div>
                    </li>
                <?php
                }
                ?> --}}
            </ul>
        </div>
    </div>
    <div class="section" id="banner-wp">
        <div class="section-detail">
            <a href="" title="" class="thumb">
                <img src="{{asset('themes/images/banner.png')}}" alt="">
            </a>
        </div>
    </div>
</div>