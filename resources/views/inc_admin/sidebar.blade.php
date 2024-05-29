<div id="sidebar" class="fl-left bg-white">
    <ul id="sidebar-menu">
        @canany(['page.view', 'page.add', 'page.edit', 'page.delete'])
        <li class="nav-link {{$mod_active=='page'?'active':''}}">
                <a class="nav-toggle" href="{{ url('admin/page') }}">
                    <i class="fa fa-map icon"></i>
                    <span class="title">Trang</span>
                </a>
                <i class="arrow fa fa-angle-right arrow"></i>
            <ul class="sub-menu">
                <li><a href="{{ url('admin/page/add') }}">Thêm trang mới</a></li>
                <li><a href="{{ url('admin/page') }}">Danh sách trang</a></li>
            </ul>
        </li>
        @endcanany
        @canany(['post.view', 'post.add', 'post.edit', 'post.delete'])
        <li class="nav-link {{$mod_active=='post'?'active':''}}">
            <a class="nav-toggle" href="{{ url('admin/post') }}">
                <i class="fa fa-pencil-square-o icon"></i>
                <span class="title">Bài viết</span>
            </a>
            <i class="arrow fa fa-angle-right arrow"></i>
            <ul class="sub-menu">
                <li><a href="{{ url('admin/post/add') }}">Thêm bài viết mới</a></li>
                <li><a href="{{ url('admin/post') }}">Danh sách bài viết</a></li>
                <li><a href="{{ url('admin/post/cat/add') }}">Thêm danh mục mới</a></li>
                <li><a href="{{ url('admin/post/cat') }}">Danh mục bài viết</a></li>
            </ul>
        </li>
        @endcanany
        @canany(['product.view', 'product.add', 'product.edit', 'product.delete'])
        <li class="nav-link {{$mod_active=='product'?'active':''}}">
            <a class="nav-toggle" href="{{ url('admin/product') }}">
                <i class="fa fa-shoe-prints icon"></i>
                <span class="title">Sản phẩm</span>
            </a>
            <i class="arrow fa fa-angle-right arrow"></i>
            <ul class="sub-menu">
                <li><a href="{{ url('admin/product/add') }}">Thêm sản phẩm mới</a></li>
                <li><a href="{{ url('admin/product') }}">Danh sách sản phẩm</a></li>
                <li><a href="{{ url('admin/product/cat/add') }}">Thêm danh mục mới</a></li>
                <li><a href="{{ url('admin/product/cat') }}">Danh mục sản phẩm</a></li>
                <li><a href="{{ url('admin/size/add') }}">Thêm size giày mới</a></li>
            </ul>
        </li>
        @endcanany
        @canany(['sell.order', 'sell.customer', 'sell.detail'])
        <li class="nav-link {{$mod_active=='sell'?'active':''}}">
            <a class="nav-toggle" href="{{ url('admin/sell') }}">
                <i class="fa fa-money-bill-trend-up icon"></i>
                <span class="title">Bán hàng</span>
            </a>
            <i class="arrow fa fa-angle-right arrow"></i>
            <ul class="sub-menu">
                <li><a href="{{ url('admin/sell') }}">Danh sách đơn hàng</a></li>
                <li><a href="{{ url('admin/sell/customer') }}">Danh sách khách hàng</a></li>
            </ul>
        </li>
        @endcanany
        @canany(['slider.view', 'slider.add', 'slider.edit', 'slider.delete'])
        <li class="nav-link {{$mod_active=='slider'?'active':''}}">
            <a class="nav-toggle" href="{{ url('admin/slider') }}">
                <i class="fa fa-sliders icon"></i>
                <span class="title">Slider</span>
            </a>
            <i class="arrow fa fa-angle-right arrow"></i>
            <ul class="sub-menu">
                <li><a href="{{ url('admin/slider/add') }}">Thêm slider mới</a></li>
                <li><a href="{{ url('admin/slider') }}">Danh sách slider</a></li>
            </ul>
        </li>
        @endcanany
        @can('admin.manager.user')
        <li class="nav-link {{$mod_active=='user'?'active':''}}">
            <a class="nav-toggle" href="{{ url('admin/user') }}">
                <i class="fa fa-users icon"></i>
                <span class="title">Users</span>
            </a>
            <i class="arrow fa fa-angle-right arrow"></i>
            <ul class="sub-menu">
                <li><a href="{{ url('admin/user/add') }}">Thêm user mới</a></li>
                <li><a href="{{ url('admin/user') }}">Danh sách user</a></li>
            </ul>
        </li>
        @endcan
        @can('admin.authorization')
        <li class="nav-link {{$mod_active=='permission'?'active':''}}">
            <a class="nav-toggle" href="{{ route('role.index') }}">
                <i class="fa fa-user-shield icon"></i>
                <span class="title">Phân quyền</span>
            </a>
            <i class="arrow fa fa-angle-right arrow"></i>
            <ul class="sub-menu">
                <li><a href="{{ route('permission.add') }}">Quyền</a></li>
                <li><a href="{{ route('role.index') }}">Danh sách vai trò</a></li>
                <li><a href="{{ route('role.add') }}">Thêm vai trò</a></li>
            </ul>
        </li>
        @endcan
    </ul>
</div>
