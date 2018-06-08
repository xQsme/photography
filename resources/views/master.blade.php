<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ config('app.name') }} @stack('page_name') </title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">

    <script src="{{asset('/js/jquery.min.js')}}"></script>
    @yield('styles')
    @stack('master_header')

</head>
<body>
<div id="app">
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <li><a href="{{ route('home') }}"><img src="{{asset('/Signature.png')}}" alt="logo"
                                                   style="width:150px"></a></li>
        </div>
        <div class="collapse navbar-collapse" id="app-navbar-collapse">

            <ul class="nav navbar-nav">

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="">Galerias
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @php($count=0)
                        @foreach($galerias as $galeria)
                            @php(++$count)
                            <li><a href="{{ route('galeria', $galeria->id) }}">{{$galeria->nome}}</a></li>
                        @endforeach
                        @if($count == 0)
                            <li><a href="{{ route('default') }}">Galeria</a></li>
                        @endif
                    </ul>
                </li>
                <li><a href="{{ route('sobre') }}">Sobre</a></li>
                <li><a href="{{ route('workshop') }}">Workshop</a></li>
                @if(Auth::check())
                    <li><a href="{{ route('logout') }}"><img src="{{asset('/logout.png')}}" alt="Logout" style="width: 30px;
                 position:absolute; top: 10px;"></a>
                @endif
                </li>
            </ul>
        </div>
    </div>
</nav>
</div>
@yield('content')
</body>
</html>