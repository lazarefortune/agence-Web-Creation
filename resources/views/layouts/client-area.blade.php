<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ asset('assets/espace-client/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/espace-client/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/espace-client/css/bootadmin.min.css') }}">

    <title>BootAdmin</title>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand navbar-dark bg-primary">
    <a class="sidebar-toggle mr-3" href="#"><i class="fa fa-bars"></i></a>
    <a class="navbar-brand" href="{{ route('client.area') }}">Web Creation 241</a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">
            <!-- <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-envelope"></i> 5</a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-bell"></i> 3</a></li> -->
            @auth
            <li class="nav-item dropdown">
                <a href="#" id="dd_user" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ auth()->user()->name }} </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd_user">
                    <a href="{{ route('account') }}" class="dropdown-item">Profil</a>
                    <!-- <a href="#" class="dropdown-item">Logout</a> -->
                    <a href="{{ route('logout') }}" class="dropdown-item"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Se déconnecter') }}
                            </a>
                            <form  id="logout-form" action="{{ route('logout') }}" method="POST" >
                                @csrf

                            </form>
                </div>
            </li>
            @endauth
        </ul>
    </div>
</nav>

<div class="d-flex">
    <div class="sidebar sidebar-dark bg-dark">
        <ul class="list-unstyled">
            <li><a href="{{ url('/') }}"><i class="fa fa-fw fa-link"></i>Retour au site principal</a></li>
            <li>
                <a href="#sm_expand_1" data-toggle="collapse">
                    <i class="fa fa-fw fa-link"></i> Expandable Menu Item
                </a>
                <ul id="sm_expand_1" class="list-unstyled collapse">
                    <li><a href="#">Submenu Item</a></li>
                    <li><a href="#">Submenu Item</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-fw fa-link"></i> Menu Item</a></li>
            <li><a href="#"><i class="fa fa-fw fa-link"></i> Menu Item</a></li>
            <li><a href="#"><i class="fa fa-fw fa-link"></i> Menu Item</a></li>
        </ul>
    </div>

    <div class="content p-4">
        @yield('content')
    </div>
</div>

<script src="{{ asset('assets/espace-client/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/espace-client/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/espace-client/js/bootadmin.min.js') }}"></script>

</body>
</html>
