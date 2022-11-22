<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @notifyCss
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/fontawesome.min.css" integrity="sha512-U/gkPvaqpUI9k7UC1ivfLUO+hb1dPzQyWskzeYoDjZENrWvLVZ40mg510RvWsVP3YcuKW4lAkfxgU9khbNhTrg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css')}}">

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script>
        window.Laravel = {!! json_encode([
            'user' => auth()->check() ? auth()->user()->id : null,
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                @auth                
                    <a  href="{{ route('posts.create') }}">
                        <button type="button" class="btn btn-outline-primary">Create A Post</button>
                    </a>
                @endauth

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
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
                            <div class="col-12 px-0 d-flex justify-content-center align-items-center" style="width: 120px;">
                                <div class="btn-group" id="notificationDropdown">
                                    @php
                                    $notifications=auth()->user()->notifications()->orderBy('created_at','DESC')->limit(50)->get();
                                    $unreadNotifications=auth()->user()->unreadNotifications()->count();
                                    /*dd($notifications[0]->data['level']);*/
                                    @endphp
                                    <div class="col-12 px-0 d-flex justify-content-center align-items-center btn" style="width: 60px;" data-bs-toggle="dropdown" aria-expanded="false" id="dropdown-notifications">
                                        <span class="fas fa-bell fa-lg font-4 d-inline-block" style="color: #ff9800;"></span>
                                        <span style="position: absolute;width: 20px;height: 20px;
                                            @if($unreadNotifications!=0)
                                                display: inline-block;
                                            @else
                                                display: none;
                                            @endif
                                        right: 8px;top: -8px;border-radius: 50%;background: #c00;color:#fff;font-size: 14px" id="dropdown-notifications-icon">{{$unreadNotifications}}</span>
                                    </div>
                                    <!-- Example single danger button -->
                                    <ul class="dropdown-menu rounded-0 border-0 shadow pb-3" style="right: 17px;left: unset;cursor: auto!important;z-index: 9999999999999999;">
                                        <div class="col-12 pb-3" style="overflow: auto;width: 400px;height: 400px;" id="notification-content">
                                            @foreach($notifications as $notification)
                                            
                                            <div class="col-12 px-3 text-left" style="background: {{$notification->read_at==null?'#f7f7f7':''}}">
                                                {!!$notification->data['message']!!}
                                                <div class="col-12 border-bottom pb-3">
                                                    <span class="font-1">
                                                        <span class="fas fa-clock"></span> {{\Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}
                                                    </span>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </ul>
                                </div>
                            </div>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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
    <x:notify-messages />
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{asset('assets/js/validation.js')}}"></script>
    @notifyJs
    @include('layouts.scripts')
    
</body>
</html>
