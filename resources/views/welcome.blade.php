<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
    <!-- Styles -->
    <style>
        html {
            background-color: #10151B;
            background: url(https://upload.wikimedia.org/wikipedia/commons/f/f0/Parkour_Foundation_Winter_%283090376739%29.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        body {
            font-family: 'Courgette', cursive;
            -webkit-font-smoothing: antialiased;
            font-smoothing: antialiased;
        }

        h1 {
            font-family: 'Dancing Script', cursive;
            line-height: .95;
            color: #e7643c;
            font-weight: 900;
            font-size: 150px;
            text-transform: uppercase;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            pointer-events: none;
            margin-left: -30%;
        }

        .center {
            position: absolute;
            margin: auto;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 581px;
            height: 50%;
        }

        .btn {
            margin: 0 auto;
            width: 170px;
            height: 60px;
            padding: 6px 0 0 3px;
            border: 2px solid #e74c3c;
            border-radius: 2px;
            background: none;
            font-size: 16px;
            line-height: 54px;
            color: #000;
            letter-spacing: .25em;
            text-decoration: none;
            display: inline-block;
            margin-right: 10px;
            font-weight: 600;
            text-transform: uppercase;
            vertical-align: middle;
            text-align: center;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            -webkit-transition: background .4s, color .4s;
            transition: background .4s, color .4s;
            cursor: pointer;
        }
        a{
            background-color: #ffffff7a
        }

        .btn:hover {
            background: #e74c3c;
            color: #fff;
        }
    </style>
</head>

<body>

    <div>
        <div class="center">
            <h1>UrbanZone</h1>
            @if (Route::has('login'))
                <div style="margin-left:20%; ">
                    @auth
                        <a style="text-decoration: none;  display: inline-block;  margin-right: 10px;"
                            href="{{ url('/Inicio') }}">
                            <div class="btn">Inicio </div>
                        </a>
                    @else
                        <a style="text-decoration: none;  display: inline-block;  margin-right: 10px;"
                            href="{{ route('login') }}">
                            <div class="btn">Login </div>
                        </a>

                        @if (Route::has('register'))
                            <a style="text-decoration: none;  display: inline-block;  margin-right: 10px;"
                                href="{{ route('register') }}">
                                <div class="btn">Register </div>
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

</body>
