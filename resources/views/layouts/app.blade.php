<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-js">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Remy Cointreau') }}</title>
    <link rel="shortcut icon" href="{{ asset('public/images/logo_rounded.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('public/css/icon.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/solid.css"
        integrity="sha384-+0VIRx+yz1WBcCTXBkVQYIBVNEFH1eP6Zknm16roZCyeNg2maWEpk/l/KsyFKs7G" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/brands.css"
        integrity="sha384-1KLgFVb/gHrlDGLFPgMbeedi6tQBLcWvyNUN+YKXbD7ZFbjX6BLpMDf0PJ32XJfX" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/fontawesome.css"
        integrity="sha384-jLuaxTTBR42U2qJ/pm4JRouHkEDHkVqH0T1nyQXn1mZ7Snycpf6Rl25VBNthU4z0" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/styles/github.min.css">
    <link rel="stylesheet" href="{{ asset('public/css/vendor/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/vendor/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/responsive.css') }}">    

    <style>
        :root {
            --banner_background: {{isset($bar) && $bar->background_color ? $bar->background_color : '#092D4D'}};
            --banner_text: {{isset($bar) && $bar->font_color ? $bar->font_color : '#fff'}};
            --banner_font_size: {{isset($bar) && $bar->font_size ? $bar->font_size : '40px'}};
            --banner_font_style: {{isset($bar) && $bar->fonts && $bar->font ? $bar->font->name : 'NimbuSanTBolCon'}};    
            --heading : {{isset($bar) && $bar->settings ? $bar->settings->color->heading : '#092D4D' }};
            --item_name: {{isset($bar) && $bar->settings ? $bar->settings->color->item_name : '#5B6772' }};
            --item_price: {{isset($bar) && $bar->settings ? $bar->settings->color->item_price : '#092D4D' }};;
            --highlight: {{isset($bar) && $bar->settings ? $bar->settings->color->highlight : '#FA4616' }};;
        }

        
        /* @font-face {
            font-family: Harmond;
            src: url("{{asset('public/fonts/Nighty/Nightydemo.otf')}}") format("opentype");
            font-weight: bold;
            font-style: normal;
            font-display: swap;
        } */
    </style>
    @if(isset($bar) && $bar->fonts && $bar->font)
    @php
        $path = "public/fonts/".$bar->font->name."/".$bar->font->filename;
    @endphp
        <style>
            @font-face {
                font-family: "{{$bar->font->name}}";
                src: url("{{ asset($path) }}") format("opentype");
                font-weight: normal;
                font-style: normal;
                font-display: swap;
            }
        </style>
    @endif

</head>

<body {{ isset($body_class) ? "class=$body_class" : null }}>
    <div id="wrapper">

        @yield('content')

    </div>
    <!--/#wrapper-->
    <script src="{{ asset('public/js/jquery.js') }}"></script>
    <script src="{{ asset('public/js/stickyfill.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.13.1/highlight.min.js"></script>
    <script src="{{ asset('public/js/vendor/stickyfill.min.js') }}"></script>
    <script src="{{ asset('public/js/vendor/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('public/js/jquery.c-share.js') }}"></script>
    <script src="{{ asset('public/js/general.js') }}"></script>

    <script>
        $(function() {
            $('.share-btn-container').cShare({
                description: 'jQuery plugin - C Share buttons...',
                showButtons: ['fb', 'line', 'plurk', 'weibo', 'twitter', 'tumblr', 'email']
            });

            $(".share-btn").click((e) => {
                e.preventDefault();
                $(".share-button-wrap").slideToggle("slow");

            });

            // $('.back-btn').click(function(e){
            //     // prevent default behavior
            //     e.preventDefault();
            //     // Go back 1 page
            //     window.history.back();
            //     // can also use
            //     // window.history.go(-1);
            // });
        });
    </script>
</body>

</html>
