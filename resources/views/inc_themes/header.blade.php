<div id="header-wp">
    <div id="head-top" class="clearfix">
        <div class="wp-inner">
            <div class="d-flex justify-content-between">
                <a href="/" title="" id="payment-link">Hình thức thanh toán</a>
                <div id="main-menu-wp">
                    <ul id="main-menu">
                        <li>
                            <a href="/" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="{{ route('list') }}" title="">Sản phẩm</a>
                        </li>
                        <li>
                            <a href="{{ route('post') }}" title="">Bài viết</a>
                        </li>
                        <li>
                            <a href="{{ route('page', 'lien-he') }}" title="">Liên hệ</a>
                        </li>
                        <li>
                            <a href="{{ route('page', 'gioi-thieu') }}" title="">Giới thiệu</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="head-body" class="clearfix nav-container">
        <div class="wp-inner d-flex justify-content-between ">
            <div id="logo">
                <a href="/" title="Trang chủ">
                    <img src="{{ asset('themes/images/logo.png') }}" />
                </a>
            </div>

            <div id="action-wp" class="d-flex">
                <div id="advisory-wp">
                    <span class="title">Tư vấn</span>
                    <span class="phone">0987.654.321</span>
                </div>
                <div id="btn-respon"><i class="fa fa-bars" aria-hidden="true"></i></div>
                <a href="{{ route('cart.show') }}" title="giỏ hàng" id="cart-respon-wp">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    <span id="num">{{ Cart::count() }}</span>
                </a>
                <div id="cart-wp">
                    <a href="{{ route('cart.show') }}" style="color: #fff;">
                        <div id="btn-cart">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            @if (Cart::count() == 0)
                                <span id="num"></span>
                            @else
                                <span id="num">{{ Cart::count() }}</span>
                            @endif
                        </div>
                    </a>
                    <div id="dropdown">
                        @if (Cart::count() == 0)
                            <p class="desc_empty">Giỏ hàng chưa có sản phẩm nào</p>
                            <img src="{{ asset('themes/images/empty_cart.png') }}" alt="">
                        @else
                            <p class="desc">Có <span>{{ Cart::count() }}</span> sản phẩm trong giỏ hàng</p>
                            <ul class="list-cart">
                                @php
                                    $temp = 0;
                                @endphp
                                @foreach (Cart::content() as $item)
                                    @php
                                        $temp++;
                                    @endphp
                                    @if ($temp <= 2)
                                        <li class="clearfix">
                                            <a href="{{ route('detail', $item->options->slug) }}" title=""
                                                class="thumb fl-left">
                                                <img src="{{ asset($item->options->image_url) }}" alt="">
                                            </a>

                                            <div class="info fl-right">
                                                <a href="{{ route('detail', $item->options->slug) }}" title=""
                                                    class="product-name">{{ $item->name }}</a>
                                                <p class="price">{{ number_format($item->total) }}đ</p>
                                                <p class="qty">Số lượng: <span>{{ $item->qty }}</span></p>
                                                <p class="qty">Size: <span
                                                        style="font-weight: bold; color: #282424;">{{ $item->options->size }}</span>
                                                </p>
                                            </div>
                                        </li>
                                    @else
                                        <a href="{{ route('cart.show') }}" class="see_more">Xem thêm .... </a>
                                    @endif
                                @endforeach
                            </ul>
                            <div class="total-price clearfix">
                                <p class="title fl-left">Tổng:</p>
                                <p class="price fl-right"><?php echo Cart::total(); ?>đ</p>
                            </div>
                            <dic class="action-cart clearfix">
                                <a href="{{ route('cart.show') }}" title="Giỏ hàng" class="view-cart fl-left">Giỏ
                                    hàng</a>
                                <a href="{{ route('checkout') }}" title="Thanh toán" class="checkout fl-right">Thanh
                                    toán</a>
                            </dic>
                        @endif
                    </div>
                </div>
                <div id="login-btn">
                    <button class="about__box-icon" id="show-login">
                        <span class="input-icon"><i class="fa fa-user"></i></span>
                    </button>
                </div>

                @if (Auth::check() && Auth::user()->hasRole('Member'))
                    <div class="dropdown">
                        <div id="member-btn"type="button" data-toggle="dropdown">
                            <button class="about__box-icon" id="show-login">
                                <span class="input-icon"><i class="fa fa-user"></i></span>
                                <div class="member-name">
                                    <span>{{ Auth::user()->name }}</span>
                                </div>
                            </button>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('member') }}">Shoes Member</a></li>
                            <li class="divider"></li>
                            <li><a href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng
                                    xuất</a></li>
                        </ul>
                    </div>
                @else
                    <div class="popup">
                        <div class="close-btn">&times;</div>
                        <div>
                            <h2 style="color: red;">SHOES STORE</h2>
                            <div class="text">
                                <p>Vui lòng đăng nhập để có trải nghiệm mua sắm tốt hơn</p>
                            </div>
                            <div class="button-group">
                                <div class="login-btn">
                                    <a href="{{ route('login') }}">Đăng nhập ngay</a>
                                </div>
                                <div class="register-btn">
                                    <a href="{{ route('register') }}">Đăng ký</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
    <div id="header-footer">
        <div id="sub-menu-wp">
            <ul id="sub-menu">
                <li>
                    <a href="/" title="">Trang chủ</a>
                </li>
                <li>
                    <a href="{{ route('list') }}" title="">Sản phẩm</a>
                </li>
                <li>
                    <a href="{{ route('post') }}" title="">Bài viết</a>
                </li>
                <li>
                    <a href="{{ route('page', 'lien-he') }}" title="">Liên hệ</a>
                </li>
                <li>
                    <a href="{{ route('page', 'gioi-thieu') }}" title="">Giới thiệu</a>
                </li>
            </ul>
        </div>
    </div>
</div>
