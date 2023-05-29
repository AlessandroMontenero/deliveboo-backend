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

    {{-- bootstrap icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">


        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <div class="logo_laravel">
                        
                    </div>
                    {{-- config('app.name', 'Laravel') --}}
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @guest
                        <li class="nav-item d-none d-md-block me-none me-md-3">
                            <div class="d-flex align-items-center" style="height:100%">
                                <img src="logo.png" alt="logo" style="width: 150px">
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/') }}">{{ __('Home') }}</a>
                        </li>
                        @else
                        <li class="nav-item d-flex align-items-center">
                            <a class="nav-link button-fix" href="{{url('/dashboard') }}">{{ __('Dashboard') }}</a>
                        </li>
                        @if (auth()->user()->restaurant != null)     
                        <li class=" nav-item">
                            <button type="button" class=" btn position-relative">
                                <a class="nav-link button-fix" href="{{url('/orders') }}">{{ __('Ordini') }}</a>
                                <span class="orders-badge rounded-pill px-2">
                                  {{auth()->user()->restaurant->unshippedOrders()}}
                                  <span class="visually-hidden">unread messages</span>
                                </span>
                            </button>
                        </li>
                        @endif
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link ms-2" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif

                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle button-fix" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('profile') }}">{{__('Profile')}}</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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

        <main class="">
            <div class="container">
                <div class="alert-messages mt-2">
                    @if (session('message_content'))
                        <div class="alert alert-{{ session('message_type') ? session('message_type') : 'success' }}">
                            {{ session('message_content') }}
                        </div>
                    @endif
                </div>
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>

