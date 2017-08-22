<!DOCTYPE html>
<html lang="en">
<head>
    @prod
        @if(config('services.gtm.id'))
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer', '{{ config('services.gtm.id') }}');</script>
        <!-- End Google Tag Manager -->
        @endif
    @endprod

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- Styles -->
    @yield('styles', '')

    <!-- Scripts -->
    @yield('scripts', '')

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <script>
        function LightenDarkenColor(col, amt) {

            var usePound = false;

            if (col[0] == "#") {
                col = col.slice(1);
                usePound = true;
            }

            var num = parseInt(col,16);

            var r = (num >> 16) + amt;

            if (r > 255) r = 255;
            else if  (r < 0) r = 0;

            var b = ((num >> 8) & 0x00FF) + amt;

            if (b > 255) b = 255;
            else if  (b < 0) b = 0;

            var g = (num & 0x0000FF) + amt;

            if (g > 255) g = 255;
            else if (g < 0) g = 0;

            return (usePound?"#":"") + (g | (b << 8) | (r << 16)).toString(16);

        }

        var sheet = (function() {
            // Create the <style> tag
            var style = document.createElement("style");

            // Add a media (and/or media query) here if you'd like!
            // style.setAttribute("media", "screen")
            // style.setAttribute("media", "only screen and (max-width : 1024px)")

            // WebKit hack :(
            style.appendChild(document.createTextNode(""));

            // Add the <style> element to the page
            document.head.appendChild(style);

            return style.sheet;
        })();

        sheet.insertRule(".btn-forgot-password:hover { color:" + LightenDarkenColor('{{ $bpContext->getPrimaryColor() }}',-50) + "}", 0);
    </script>

    <style>
        .passport-authorize .container {
            margin-top: 30px;
        }

        .passport-authorize .scopes {
            margin-top: 20px;
        }

        .passport-authorize .buttons {
            margin-top: 25px;
            text-align: center;
        }

        .passport-authorize .btn {
            min-width: 125px;
        }

        .passport-authorize .btn-approve {
            margin-right: 15px;
        }

        .passport-authorize form {
            display: inline;
        }

        .panel-default > .panel-heading {
            background-color: {{ $bpContext->getPrimaryColor() }};
            color: #FFF;
        }

        .header-logo {
            background-color: @if($bpContext->whiteLogoBackground()) #FFF @else {{  $bpContext->getPrimaryColor() }} @endif;
            margin-bottom: 10px;
        }

        .header-logo img {
            display:block;
            margin: 0 auto;
            max-width: 100%;
        }

        .panel, .btn, .form-control, .alert {
            border-radius: 0;
        }

        .panel-body hr {
            margin-top: 0;
        }

        form .form-group {
            margin-top: 20px;
        }

        .btn-forgot-password {
            color: {{ $bpContext->getSecondaryColor() }};
        }

        /*btn-forgot-password:hover {
            color: LightenDarkenColor(#ed4b36);
        }*/

        .btn-register {
            color: {{ $bpContext->getSecondaryColor() }};
            margin: 0 auto;
            margin-bottom: 0;
        }

        .product-info {
            padding: 20px 0 0;
            display: inline-block;
        }
        .product-info img {
            margin: 0 auto;
        }
        .product-title {
            color: #00395c;
            font-size: 22px;
            font-weight: 400;
        }
        .product-description {
            font-weight: 300;
        }
    </style>
</head>
<body>


@prod
@if(config('services.gtm.id'))
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ config('services.gtm.id') }}"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
@endif
@endprod

    <div id="app">
        <div class="passport-authorize">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="header-logo">
                            <img src="{{$bpContext->getLogo()}}" alt="">
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                @yield('heading')
                            </div>
                            <div class="panel-body">
                                @yield('body')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
