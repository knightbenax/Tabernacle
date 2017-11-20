<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CJ 2017 - Enlargement</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Cabin:400,700|Passion+One:700" rel="stylesheet"> 

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/main.css') }}"  />

        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('/images/apple-icon-57x57.png')}}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('/images/apple-icon-60x60.png')}}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/images/apple-icon-72x72.png')}}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/images/apple-icon-76x76.png')}}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/images/apple-icon-114x114.png')}}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('/images/apple-icon-120x120.png')}}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('/images/apple-icon-144x144.png')}}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/images/apple-icon-152x152.png')}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/images/apple-icon-180x180.png')}}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('/images/android-icon-192x192.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/images/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('/images/favicon-96x96.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/images/favicon-16x16.png')}}">
        <link rel="manifest" href="{{ asset('/images/manifest.json')}}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('/images/ms-icon-144x144.png')}}">
        <meta name="theme-color" content="#ffffff">
    </head>
    <body>
        <div class="flex-center position-ref full-height top">
            <div class="logo">
                <img src="{{ asset('/images/YD1.png') }}" />
            </div>

            <div class="register">
                <a href="" class="button">Register</a>
            </div>

            <div class="content">
                
            </div>

            <div class="big_header" id="big_header">
                <div class="first_title">
                    <div class="large_guy title">Camp<br/>Joseph<br/>2017</div>
                    <div class="subtitle">Enlargement</div>
                    <div class="subtitle small">Dec 27th - 30th 2017</div>
                </div>
            </div>

            <div class="big_header" id="big_header_second">
                <div class="second_title">
                    <div class="sec_subtitle">Largest<br/> Homecoming Of</div>
                    <div class="large_guy sec_title">The<br/>Successor<br/>Generation</div>
                </div>
                
            </div>

            <div class='slide_container'>
                <div class="slide one" >
                </div>
                <div class="slide two" >
                    <div class="bad_guy"></div>
                    <div class="bad_guy_two"></div>
                </div>
                <div class="slide three">
                    <div class="bad_guy"></div>
                    <div class="bad_guy_two"></div>
                </div>
                <div class="slide four">
                    <div class="bad_guy"></div>
                    <div class="bad_guy_two"></div>
                </div>
            </div>

            <div class="talk_about">
                <div class="first_take">
                    <div class="sliver gallery">
                        <div class="first_image show"></div>
                        <div class="second_image show"></div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="{{ asset('/js/skrollr.min.js') }}"></script>
        <script type="text/javascript">
        var windowWidth = window.innerWidth;
        var windowHeight = window.innerHeight;

        var halfWindowHeight = windowHeight / 2;

        var data_height = "data-" + halfWindowHeight;
        var full_data_height = "data-" + (windowHeight + 300 + 200);
    
        var data_width = $(".bad_guy").innerWidth();

        var xc = halfWindowHeight + 300;

        //alert(data_height);
        $(".slide .bad_guy_two").attr("data-0", "left:-" + data_width + "px;opacity:0");
        $(".slide .bad_guy").attr("data-0", "left:0px;opacity:1");
        //$(".slide.two .bad_guy").attr(data_height, "margin-left:-600px");
        $(".slide .bad_guy_two").attr(data_height, "left:0px;opacity:1");
        $(".slide .bad_guy").attr(data_height, "left:-" + data_width + "px;opacity:0");

        $("#big_header").attr("data-0", "opacity:1; transform: translate(0px);");
        $("#big_header").attr(data_height, "opacity:0; transform: translate(-100%);");

        $("#big_header_second").attr("data-0", "opacity:0; transform: translate(-100%);");
        $("#big_header_second").attr(data_height, "opacity:1; transform: translate(0px);");

        $(".slide_container").attr("data-" + xc, "opacity:1; transform: translate(0px, 0px);");
        $(".slide_container").attr(full_data_height, "opacity:0; transform: translate(1500px, 0px);");

        $(".talk_about").attr("data-" + xc, "opacity:0;");
        $(".talk_about").attr(full_data_height, "opacity:1;");

        $("#big_header_second").attr(full_data_height, "opacity:0;");
        //$(".bio_bounce").attr(data_height, "margin-top:-600px;opacity:0.3");
        //$(".bio_bounce_reverse").attr(data_height, "margin-top:600px;opacity:0.3");

        //intialize this after we have added te attribute
        var s = skrollr.init(
        );
      	</script>
    </body>
</html>
