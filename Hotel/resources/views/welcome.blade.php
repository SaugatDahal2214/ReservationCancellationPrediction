<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Hotel Booking</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway';
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
                text-align: center;
                flex-direction: column;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
                margin-bottom: 30px;
            }

            .button-container {
                padding: 20px;
                border: 1px solid #ddd;
                border-radius: 10px;
                background-color: #f9f9f9;
                display: flex;
                gap: 20px;
                justify-content: center;
            }

            .btn {
                padding: 10px 20px;
                background-color: #D32F2F;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                text-decoration: none;
                transition: background-color 0.3s, color 0.3s;
            }

            .btn:hover {
                background-color: #E53935;
            }

            .btn .btn-text{
                font-size: 24px;
                font-weight: bolder;
            }
        </style>
    </head>
    <body>
        <div class="flex-center full-height position-ref">
            <div class="content">
                <div class="title">
                    Welcome Admin Panel
                </div>
                <div class="button-container">
                    @if (Route::has('login'))
                        @if (Auth::check())
                            <a href="{{ url('/dashboard') }}" class="btn"><span class="btn-text">Dashboard</span></a>
                        @else
                            <a href="{{ url('/login') }}" class="btn"><span class="btn-text">Login</span></a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
