@extends('layout.base')

@section('title', "Recuperación de Clave de Usuario | Paso 2")

@section('stylesheets')
@parent

@endsection

@section("body")

<div id="login" style="padding-bottom: 10%;">
    <div class="login-wrapper">
        <div id="box box-solid">
            <div class="box-header">
                <h3 class="box-title" style="text-align: center">Recuperación de Clave de Usuario</h3>
                <div id="alert" class="alert alert-danger alert-dismissable" style=" display: none;"></div>
            </div>
            <div class="box-body">
                <h3 id="sle" class="box-title" style="text-align: center">Seleccione la opción correcta.</h3>
                <h3 id="datos" class="box-title" style="text-align: center; display:none ">Escriba su nueva contraseña Sr(a) {{strtoupper($nombre->nombres)}} {{strtoupper($nombre->apellidos)}}.</h3>
                <br>
                <form id="clavesss">
                    <div id="combo" class="input-group form-group">
                        @foreach($compara as $tid)
                        <input type="radio" id="comparacion{{ $tid -> id}}" name="comparacion" value="{{ $tid -> id}}"> {{ strtoupper($tid -> nombres)}} {{ strtoupper($tid -> apellidos)}}<br><br>
                        @endforeach
                    </div>
                    <div id="contra" class="input-group form-group" style="display: none">
                        <label class="control-label">Contraseña Nueva<span class="required">*</span></label>
                        <input class="form-control fomul" type="password" minlength="8" id="clave" name="clavee" validate/>
                        <font color="blue"> La clave o contraseña debe ser mayor a 8 digitos, debe tener una letra mayúscula, letras minúsculas y caracteres numericos.</font>
                        <br>
                        <span id="errorpassr" style="color: red; font-weight: bold;"></span>    
                        <br><br>
                    </div>
                    <div class="form-group" style="text-align: center;">
                        <input class="resent-submit btn btn-primary "  value="Enviar"/>
                        <input id="id_usu" name="id_usu" type="hidden" value="{{$nombre->id}}" />
                        <input id="guarda" class="btn btn-primary" style="display: none" value="Guardar"/>
                        <br><br>
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
<script src="{{ asset("js/usu.js")}}"></script>

@endsection
