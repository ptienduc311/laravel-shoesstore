<div id="header-wp">
    <div class="wp-inner clearfix">
        <a href="{{ route('dashboard') }}" title="" id="logo" class="fl-left">ADMIN</a>
        <ul id="main-menu" class="fl-left">
            @canany(['page.view', 'page.add', 'page.edit', 'page.delete'])
                <li>
                    <a href="{{ url('admin/page') }}" title="">Trang</a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{ url('admin/page/add') }}" title="">Thêm trang mới</a>
                        </li>
                        <li>
                            <a href="{{ url('admin/page') }}" title="">Danh sách trang</a>
                        </li>
                    </ul>
                </li>
            @endcanany
            @canany(['post.view', 'post.add', 'post.edit', 'post.delete'])
                <li>
                    <a href="{{ url('admin/post') }}" title="">Bài viết</a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{ url('admin/post/add') }}" title="">Thêm bài viết mới</a>
                        </li>
                        <li>
                            <a href="{{ url('admin/post') }}" title="">Danh sách bài viết</a>
                        </li>
                        <li>
                            <a href="{{ url('admin/post/cat/add') }}" title="">Thêm danh mục bài viết</a>
                        </li>
                        <li>
                            <a href="{{ url('admin/post/cat') }}" title="">Danh mục bài viết</a>
                        </li>
                    </ul>
                </li>
            @endcanany
            @canany(['product.view', 'product.add', 'product.edit', 'product.delete'])
                <li>
                    <a href="{{ url('admin/product') }}" title="">Sản phẩm</a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{ url('admin/product/add') }}" title="">Thêm sản phẩm mới</a>
                        </li>
                        <li>
                            <a href="{{ url('admin/product') }}" title="">Danh sách sản phẩm</a>
                        </li>
                        <li>
                            <a href="{{ url('admin/product/cat/add') }}" title="">Thêm danh mục mới</a>
                        </li>
                        <li>
                            <a href="{{ url('admin/product/cat') }}" title="">Danh mục sản phẩm</a>
                        </li>
                        <li>
                            <a href="{{ url('admin/size/add') }}" title="">Thêm size giày mới</a>
                        </li>
                    </ul>
                </li>
            @endcanany
            @canany(['sell.order', 'sell.customer', 'sell.detail'])
                <li>
                    <a href="{{ url('admin/sell') }}" title="">Bán hàng</a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{ url('admin/sell') }}" title="">Danh sách đơn hàng</a>
                        </li>
                        <li>
                            <a href="{{ url('admin/sell/customer') }}" title="">Danh sách khách hàng</a>
                        </li>
                    </ul>
                </li>
            @endcanany
        </ul>
        <div id="dropdown-user" class="dropdown dropdown-extended fl-right">
            <button class="dropdown-toggle clearfix" type="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="true">
                <div id="thumb-circle" class="fl-left">
                    <img src="{{ asset('admin_style/images/img-admin.png') }}">
                </div>
                @if (Auth::check())
                    <h3 id="account" class="fl-right">{{ Auth::user()->name }}</h3>
                @else
                    <h3 id="account" class="fl-right">Admin</h3>
                @endif
            </button>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <ul class="dropdown-menu">
                <li>
                    <a href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Thoát</a>
                </li>
            </ul>
        </div>
    </div>
</div>
