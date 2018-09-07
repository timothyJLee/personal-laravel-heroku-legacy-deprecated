<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TimsBlog</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    TimsBlog
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li><a href="{{ url('/about') }}">About&nbsp;&nbsp;</a></li>
                        <li><a href="{{ url('/news') }}">News&nbsp;&nbsp;</a></li>
                        <li><a href="{{ url('/projects') }}">Projects&nbsp;&nbsp;</a></li>
                        <li><a href="{{ url('/contact') }}">Contact&nbsp;&nbsp;</a></li>
                        <li><a href="https://www.linkedin.com/in/timothy-lee-233769b9/">Linkedin&nbsp;&nbsp;</a></li>
                        <li><a href="https://github.com/timothyJLee">Github&nbsp;&nbsp;</a></li>
                        <li><a href="https://twitter.com/timothyJLeeCS">Twitter&nbsp;&nbsp;</a></li>
                        <li><a href="https:/timsshowcase.wordpress.com">Wordpress&nbsp;&nbsp;</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Notifications <span class="badge">{{count(Auth::user()->unreadNotifications)}}</span></a>
                            <ul class="dropdown-menu" role="menu">
                            <li>
                            @foreach (Auth::user()->unreadNotifications as $notification)
                                <a href="{{ route('posts.show', $notification->data['post']['id']) }}"><i>{{ $notification->data["user"]["name"] }}</i> has commented in <b>{{ $notification->data["post"]["title"] }}</b></a>
                            @endforeach
                            </li>
                            </ul>
                            </li>
@role('administrator')
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Administration <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('admin.users.index') }}">
                                            Users
                                        </a>
                                    </li>
                                </ul>
                            </li>
@endrole
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
