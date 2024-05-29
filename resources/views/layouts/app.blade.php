    <!DOCTYPE html>
<html>

<head>
    <title>Shoes store - @yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('themes/css/bootstrap/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('themes/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="{{ asset('themes/reset.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('themes/css/carousel/owl.carousel.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('themes/css/carousel/owl.theme.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('themes/css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('themes/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('themes/responsive.css') }}" rel="stylesheet" type="text/css" />

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <script src="{{ asset('themes/js/jquery-2.2.4.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('themes/js/elevatezoom-master/jquery.elevatezoom.js') }}" type="text/javascript"></script>
    <script src="{{ asset('themes/js/bootstrap/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('themes/js/carousel/owl.carousel.js') }}" type="text/javascript"></script>
    <script src="{{ asset('themes/js/main.js') }}" type="text/javascript"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <div id="container">
        @include('inc_themes.header')
    </div>
    <div id="overlay"></div>
    <script src="{{ asset('themes/js/login_logout.js') }}"></script>
    @yield('content')
    @include('inc_themes.footer')
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=849340975164592";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    @yield('addJs')
</body>

</html>