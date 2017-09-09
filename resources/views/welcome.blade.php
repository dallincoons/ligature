<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->

        <!-- CSS -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <link href="{{ mix('css/app-less.css') }}" rel="stylesheet">

    </head>
    <body>
        <div class="flex-center position-ref is-fullheight hero is-primary is-large" id="app">
            @if (Route::has('login'))
                <div class="top-right links">
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
                            <div class="hero-body" style="flex-direction: column;">
                                <div class="container has-text-centered">
                                    <a class="button is-outlined is-white is-fullwidth" href="{{ route('login') }}">Login</a>
                                </div>
                                <div class="container has-text-centered">
                                    <a class="button is-outlined is-white is-fullwidth m-lg-t-5" href="{{ route('register') }}">Register</a>
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
