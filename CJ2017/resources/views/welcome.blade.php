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
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                
            </div>

            <div class="big_header">
            <div class="large_guy">Camp<br/>Joseph<br/>2017</div>
            <div>Enlargement</div>
            </div>

            <div class='slide_container'>
                <div class="slide one">
                </div>
                <div class="slide two">
                </div>
                <div class="slide three"></div>
                <div class="slide four"></div>
            </div>
        </div>
    </body>
</html>
