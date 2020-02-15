<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- swiper-->
    <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.css">
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            /* height: 100vh; */
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .container {
            text-align: center;
            padding: 0;
        }

        .box {
            width: 100%;
            height: 10vh;
        }

        .title {
            font-size: 84px;
        }

        .title>a {
            color: #636b6f;
            /* padding: 0 25px; */
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .links>a {
            color: #636b6f;
            padding: 20px;
            font-size: 20px;
            font-weight: 600;
            letter-spacing: .2rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
    @yield('css')

</head>

<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            {{-- 登入頁要放在前台 --}}
            @auth
                {{-- 有登入 --}}
                @if (Auth::user()->role == "admin" || Auth::user()->role == "super_admin")
                    <!-- 系統管理者 -->
                    <a href="/admin">admin</a>

                    <a class=" " href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <!-- 一般使用者 -->
                    <a href="/cart">cart(<span id="TotalQuantity"></span>)</a>
                    <a href="/user_info/orders">user_info</a>

                    <a class=" " href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endif
            @else
            {{-- 沒登入 --}}
                <a href="/cart">cart(<span id="TotalQuantity"></span>)
                    <a href="{{ route('login') }}">Login</a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                    @endif
            @endauth
        </div>
        @endif

        <div class="container">
            <div class="box"></div>

            <div class="title m-b-md">
                <a href="/">MET</a>
            </div>

            <div class="links">
                <a href="/woman">woman</a>
                <a href="/man">man</a>
                <a href="/kid">kid</a>
                <a href="/accessories">
                    accessories</a>
                <a href="/media">media</a>
            </div>
            @yield('content')

        </div>
    </div>


    <!-- Optional JavaScript -->
    <script src="https://unpkg.com/swiper/js/swiper.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    @yield('js')

</body>

</html>
