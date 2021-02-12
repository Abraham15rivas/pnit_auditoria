@extends('layout.base')

@section('title', "Inicio de Sesión")

@section('stylesheets')
@parent
<style>
    .margin-top{
        margin-top:20px;
    }
    .correo-link{
        transform:translateY(36px);
        font-weight:bold
    }
    .disabled-element {
        opacity: 0.65;
        pointer-events: none;
    }
    .centered{
        margin-left: 20px;
    }
    .bad{
        border:1px solid red !important;
    }
</style>
@endsection

@section("body")

<div id="login">
    <div class="login-wrapper">
        <div id="box box-solid">
            <div class="box-header">
                <h3 class="box-title">Inicio de sesión</h3>
                <div id="alert" class="alert alert-danger alert-dismissable" style=" display: none;"></div>
            </div>
            <div class="box-body">
                <form id="logform" method=post action=submit>
                    <div class="input-group form-group">
                        <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                        <input title="Rellene este campo" class="form-control" placeholder="Correo Electrónico" type="text" id="username" name="username" required="required" />
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-addon"><i class="fa fa-unlock"></i></div>
                        <input class="form-control" placeholder="Contraseña" type="password" id="password" name="password" required="required" />
                    </div>
                    <div class="form-group">
                        <input type="checkbox" id="remember_me" name="_remember_me" value="on" />
                        <label style="font-weight: normal;" class="control-label" for="remember_me">Recordar</label>
                    </div>
                    <div class="form-group">
                        <div class="disabled-element" id="RecaptchaField1" ></div>
                    </div>
                    <div class="form-group" style=" text-align: right; margin-top: 10%; font-weight: bold; font-size: 14px;">
                        <a href="{{ route('cambio') }}" >¿Olvido su contraseña?</a>
                    </div>
                    {{ csrf_field()}}
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascripts')
@parent
<script src="{{ asset("js/login.js")}}"></script>
<script src="https://www.google.com/recaptcha/api.js?hl=es&onload=CaptchaCallback&render=explicit" type="text/javascript"></script>
@endsection
