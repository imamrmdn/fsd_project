<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PT FAN Integrasi Teknologi</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {

                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                margin-top: -50px;
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                margin-top: 30px;
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .logo{

                background-size: 180px;
                width: 180px;
                height: 160px;
                background-image: url('css/Fan.png');
                display: inline-block;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                </div>
              <div class="content">
                  <div class="logo"></div>
                  <div class="title m-b-md">
                      <b>FAN Integrasi Teknologi</b>
                  </div>
                  <div class="links">
                      <a href="{{ url('/login') }}">Login</a>
                      <!-- <a href="{{ url('/register') }}">Register</a> -->
                  </div>
                    @endif
                </div>
            @endif
        </div>
    </body>
</html>
