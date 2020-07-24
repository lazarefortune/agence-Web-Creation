<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- <script src="https://use.fontawesome.com/f89d3d1805.js"></script> -->

    <!-- Extra-js -->
    @yield('extra-js')

    <!-- Fonts -->
    <!-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->

    <style >
    @import url('https://fonts.googleapis.com/css2?family=Baloo+Da+2:wght@400;500;600;700;800&display=swap');


    body{
      /* font-family: 'Nunito', sans-serif; */
      font-family: 'Baloo Da 2', cursive !important;

    }
    </style>

    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('assets/forum/css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('forum.topics.index') }}">
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

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown2" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('changer de service') }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown2">
                                <a class="dropdown-item" href="{{ url('/') }}">
                                    {{ __('Accueil') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('monboncoin.ads.index') }}">
                                    {{ __('Espace annonces') }}
                                </a>


                            </div>
                        </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else



                            @unless (auth()->user()->unreadNotifications->isEmpty())
                            <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <span class="badge badge-warning">{{ auth()->user()->unreadNotifications->count() }}</span> notification(s) <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                              @foreach (auth()->user()->unreadNotifications as $unreadNotification)
                                <a href="{{ route('forum.topics.showFromNotification', ['topic' => $unreadNotification->data['topicId'], 'notification' => $unreadNotification->id]) }}" class="dropdown-item text-wrap">{{ $unreadNotification->data['name'] }} a écrit sur votre sujet <strong>{{ $unreadNotification->data['topicTitle'] }}</strong></a>
                              @endforeach
                            </div>
                            </li>
                            @endunless

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="{{ route('forum.topics.create') }}" class="dropdown-item">Créer un topic</a>
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
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 " style="margin-bottom: 100px;">
          @yield('content')
        </main>

        <footer class="footer mt-auto py-3 border fixed-bottom d-sm-block d-md-none d-lg-none " style="background-color: white;">
          <div class="container">
            <span class="text-muted">Place sticky footer content here.</span>
            <a href="{{ route('forum.topics.create') }}" type="button"  class="btn btn-primary btn-sm" name="button">Créer un sujet</a>
          </div>
        </footer>

    </div>
    <!-- Scripts -->
    <script src="{{ asset('assets/forum/js/app.js') }}" defer></script>
    <!-- jquery local -->
    <!-- <script src="{{ asset('bootstrap/jquery-3.5.1.slim.min.js') }}"></script>
    <script src="{{ asset('bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script> -->
</body>
</html>
