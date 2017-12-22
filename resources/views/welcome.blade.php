<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Brainframe Recall</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet">

        <!-- CSS -->
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

    </head>
    <body>
        <div id="app">
            @if (Route::has('login'))
                <div>
                    @auth
                        <nav class="navbar">
                            <div class="container">

                                <router-link class="navbar-item" to="/links">Links</router-link>
                                <a href="{{ route('logout') }}"
                                   class="navbar-item navbar-end"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </nav>
                    @else
                        <div id="app" class="container">
                            <div class="sm-panel">
                                <h1 class="block-brand">
                                    <span>BRAIN</span>
                                    <span>FRAME</span>
                                    <span>RECALL</span>
                                </h1>
                                    <a class="main-button hvr-bounce-to-right" href="{{ route('login') }}">Login</a>
                                    <a class="main-button hvr-bounce-to-right" href="{{ route('register') }}">Register</a>
                            </div>
                        </div>
                    @endauth
                </div>
            @endif

            <div class="content container">
                <router-view></router-view>
            </div>
        </div>

        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
