<!DOCTYPE html>
<html>

<head>
    <title>Shoes store - @yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="{{ asset('admin_style/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_style/css/bootstrap/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="{{ asset('admin_style/reset.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_style/css/font-awesome/css/font-awesome.min.css') }}"rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_style/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_style/responsive.css') }}" rel="stylesheet" type="text/css" />
    @yield('custom-css')

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <script src="{{ asset('admin_style/js/jquery-2.2.4.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_style/js/bootstrap/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_style/js/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_style/js/main.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_style/js/custom.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

<body>
    <div id="site">
        <div id="container">
            @include('inc_admin.header')
            <div id="main-content-wp" class="add-cat-page">
                <div class="wrap clearfix">
                    @php
                        $mod_active = session('mod_active');
                    @endphp
                    @include('inc_admin.sidebar')
                    @yield('content')
                </div>
            </div>
            @include('inc_admin.footer')
        </div>
    </div>
    @yield('addJs')

</body>

</html>
