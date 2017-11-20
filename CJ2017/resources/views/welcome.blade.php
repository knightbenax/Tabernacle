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
    </head>
    <body>
        <div class="flex-center position-ref full-height top">
            <div class="logo">
                <img src="{{ asset('/images/YD1.png') }}" />
            </div>

            <div class="content">
                
            </div>

            <div class="big_header">
            <div class="large_guy">Camp<br/>Joseph<br/>2017</div>
            <div>Enlargement</div>
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
        </div>
        <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="{{ asset('/js/skrollr.min.js') }}"></script>
        <script type="text/javascript">
        var windowWidth = window.innerWidth;
        var windowHeight = window.innerHeight;

        var data_height = "data-" + windowHeight;

        var data_width = $(".bad_guy").innerWidth();

        //alert(data_height);
        $(".slide .bad_guy_two").attr("data-0", "left:-" + data_width + "px;opacity:0");
        $(".slide .bad_guy").attr("data-0", "left:0px;opacity:1");
        //$(".slide.two .bad_guy").attr(data_height, "margin-left:-600px");
        $(".slide .bad_guy_two").attr(data_height, "left:0px;opacity:1");
        $(".slide .bad_guy").attr(data_height, "left:-" + data_width + "px;opacity:0");

        
        //$(".bio_bounce").attr(data_height, "margin-top:-600px;opacity:0.3");
        //$(".bio_bounce_reverse").attr(data_height, "margin-top:600px;opacity:0.3");

        //intialize this after we have added te attribute
        var s = skrollr.init(
        );
      	</script>
    </body>
</html>
