<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/theme/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/theme/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/theme/dataTables.bootstrap.min.css')}}">
        <link href="{{ asset('css/datepicker.css') }}" rel="stylesheet">
        <link href="{{ asset('css/application.css') }}" rel="stylesheet">
    </head>
    <body>
        <script type="text/javascript">
            var APP_URL = '<?php echo url('/'); ?>';
        </script>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                            @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @endif

                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else
                            @if(Auth::user()->role=='super admin')
                            <li class="nav-item {{ (Request::is('users') || Request::is('users/create')||Request::is('users/*/edit')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('users') }}">Users</a>
                            </li>
                            @endif
                            <li class="nav-item {{ (Request::is('products') || Request::is('products/create')||Request::is('products/*/edit')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('products') }}">Products</a>
                            </li>
                            <li class="nav-item {{( Request::is('category') || Request::is('category/create')||Request::is('category/*/edit'))? 'active' : ''}}">
                                <a class="nav-link" href="{{ url('category') }}">Category</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->full_name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                @yield('content')
            </main>
        </div>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{asset('js/theme/jquery.min.js')}}"></script>
        <script src="{{asset('js/theme/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/theme/jquery.validate.min.js')}}"></script>
        <script src="{{asset('js/theme/jquery-ui.min.js')}}"></script>
        <script src="{{asset('js/theme/jquery.dataTables.min.js')}}" defer></script>
        <script src="{{asset('js/theme/dataTables.bootstrap.min.js')}}" ></script>
        <script src="{{ asset('js/bootstrap-datepicker.js') }}" defer></script>
        @yield('javascript')
    </body>
</html>
