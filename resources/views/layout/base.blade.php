<!doctype html>
<html lang="{{ App::getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="_token" content="{{ csrf_token() }}">
        <title> PNIT ::: Programa Nacional de Innovación Tecnologica | @yield('title') </title>
        @section('stylesheets')
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="{{ asset('ofplatform/vendors/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('ofplatform/vendors/bootstrap/css/bootstrap-theme.min.css') }}">
        <link href="{{ asset('ofplatform/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <!-- ****** THEME ****** -->
        <link rel="stylesheet" href="{{ asset('ofplatform/css/theme/ionicons.min.css') }}">

        <link rel="stylesheet" href="{{ asset('ofplatform/css/theme/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('ofplatform/css/theme/AdminLTE.css') }}">
        <!-- ****** END THEME ****** -->
         <link rel="stylesheet" href="{{ asset('ofplatform/css/platform.css') }}">
        <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sweetAlert2.css') }}">
        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>


        @show
    </head>
    <body class="pace-done skin-blue">

        <header class="header">
            <a href="{{ route('inicio_sesion') }}" class="logo navbar-fixed-top">
                <img class="" alt="PNIT" style ="width:111px;height:43px;" src="{{ asset("imagenes/PNIT.png") }}" >
            </a>
            <nav class="navbar navbar-fixed-top" role="navigation">
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li><a href="{{ route('inicio_sesion') }}" >Inicio</a></li>
                        <li><a href="{{ route('register') }}" >Regístrate</a></li>
                        <li><a href="{{ route('inicio_sesion') }}" >Inicia Sesión</a></li>
                    </ul>
                </div>
                <div class="hidden-xs"></div>
            </nav>
        </header>

        @section('navigation')

        @show
        <div>
            @section('body')

            @show
        </div>

        <footer>
            <nav class="navbar navbar-default navbar-fixed-bottom line-red" role="navigation">
                <div class="container">
                    <div class="row">
                        <div class="hidden-xs col-md-7">
                            <img style ="padding:10px; width:80%; height:20%;"class="flotar-izq" src="{{ asset("imagenes/cintillo horizontal.jpg") }}">
                        </div>
                    </div>
                </div>
            </nav>
        </footer>


        @section('javascripts')
        <script src="{{ asset("ofplatform/vendors/jquery/jquery.min.js") }}"></script>
        <script src="{{ asset("ofplatform/vendors/bootstrap/js/bootstrap.min.js")}}"></script>
        <script src="{{ asset("ofplatform/js/theme/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js")}}"></script>
        <script src="{{ asset("ofplatform/js/theme/AdminLTE/my-app.js")}}"></script>
        <!-- ****** END THEME ****** -->
        <script src="{{ asset('js/sweetAlert2.js') }}"></script>
        <script src="{{ asset("js/jquery-ui.js")}}"></script>
        <script src="{{ asset("js/calendar.js")}}"></script>

        @show

    </body>
