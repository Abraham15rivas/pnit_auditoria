<!doctype html>
<html lang="{{ App::getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="_token" content="{{ csrf_token() }}">
        <title> PNIT :: Programa Nacional de Innovación Tecnologica | @yield('title') </title>
        @section('stylesheets')

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="{{ asset('ofplatform/vendors/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('ofplatform/vendors/bootstrap/css/bootstrap-theme.min.css') }}">
        <link href="{{ asset('ofplatform/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">        
        <link rel="stylesheet" href="{{ asset('css/85d38c6_bootstrap3-wysihtml5.min_4.css') }}">
        <link rel="stylesheet" href="{{ asset('css/85d38c6_select2_1.css') }}">  
        <link rel="stylesheet" href="{{ asset('css/85d38c6_AdminLTE_5.css') }}">
        <link rel="stylesheet" href="{{ asset('ofplatform/css/platform.css') }}">
        <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sweetAlert2.css') }}">
        @show
    </head>
    <body class="pace-done skin-blue">

        <header class="header">
            <a href="{{ route('inicio_sesion') }}" class="logo navbar-fixed-top">
                <img class="" style ="width:111px;height:43px;"alt="PNIT" src="{{ asset("imagenes/PNIT.png")}}">
            </a>
            <nav class="navbar navbar-fixed-top" role="navigation">
                <a href="#" class="navbar-btn sidebar-toggle pull-left visible-xs visible-sm" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>{{Session::get('usuario')->correo}}<i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="{{ asset("upload/noFoto.png")}}" class="img-circle" alt="User Image" />
                                    <p style="font-size: 14px;">
                                        {{Session::get('usuario')->nombres}} {{Session::get('usuario')->apellidos}}
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-12 text-center">
                                        <a href="{{ route('edit_perfil')}}">
                                            <div class="small-box bg-yellow">
                                                <div class="inner">
                                                    Editar Perfil de Usuario
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ route('cambclv')}}" class="btn btn-default btn-flat">Cambiar Contraseña</a>
                                    </div>

                                    <div class="pull-right">
                                        <a href="{{ route('cerrar_sesion') }}" class="btn btn-default btn-flat">Salir</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="hidden-xs">
                    <ul class="nav navbar-nav navbar-left">
                        <!--
                        -->
                    </ul>

                </div>
            </nav>
        </header>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="left-side sidebar-offcanvas">
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="box box-solid">
                            <img src="{{ asset("upload/noFoto.png")}}" class="img-thumbnail" alt="User Image" />
                        </div>
                        <div class="info">
                            {{Session::get('usuario')->nombres}} {{Session::get('usuario')->apellidos}}
                        </div>
                    </div>
                    <!-- sidebar menu -->
                    <!-- sidebar Buscador -->
                    <!-- End sidebar Buscador -->
                    <ul class="sidebar-menu">
                        <li>
                            <a href="{{ url('/admin/edit_perfil')}}">
                                <i class="fa fa-user"></i> <span>Perfil</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('reg_pro')}}">
                                <i class="fa fa-edit"></i> <span>Registro</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('reg_up')}}">
                                <i class="fa fa-eye"></i> <span>Registros cargados</span>
                            </a>
                        </li>                        
                    </ul>

                </section>
                <!-- /.sidebar -->
            </aside>

            @section('navigation')

            @show
            <aside class="right-side">
                @section('body')

                @show
            </aside>
        </div>

        <footer>
            <nav class="navbar navbar-default navbar-fixed-bottom line-red" role="navigation">
                <div class="container">
                    <div class="row">

                        <div class="hidden-xs col-md-7"><img style ="padding:10px; width:80%; height:20%;"class="flotar-izq" src="{{ asset("imagenes/cintillo horizontal.jpg") }}"></div>

                    </div>
                </div>
            </nav>
        </footer>

        @section('javascripts')
        <script src="{{ asset("ofplatform/vendors/jquery/jquery.min.js") }}"></script>
        <script src="{{ asset("ofplatform/vendors/bootstrap/js/bootstrap.min.js")}}"></script>
        <script src="{{ asset('js/9268527_select2.min_10.js') }}"></script>
        <script src="{{ asset('js/9268527_select2_locale_es_11.js') }}"></script>
        <script src="{{ asset('js/9268527_bootstrap3-wysihtml5.all.min_15.js') }}"></script>
        <script src="{{ asset('js/sweetAlert2.js') }}"></script>      
        <script src="{{ asset("js/jquery-ui.js")}}"></script>
        <script src="{{ asset("js/calendar.js")}}"></script> 
        @show
    </body>
