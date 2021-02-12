@extends('layout.base')

@section('title', "Recuperación de Clave de Usuario | Paso 1")

@section('stylesheets')
@parent

@endsection

@section("body")

<div id="login" style="padding-bottom: 10%;">
    <div class="login-wrapper">
        <div id="box box-solid">
            <div class="box-header">
                <h3 class="box-title" style="text-align: center">Recuperación de Clave de Usuario</h3>
            </div>
            <div class="box-body">
                <form action="{{ route('cambiodos') }}" method="post">
                    <div class="input-group form-group">
                        <label class="control-label">N° de Identificación <span class="required">*</span></label>
                        <input title="Rellene este campo" class="form-control" type="text" id="identificador" name="identificador" placeholder="Ej: 019845256 ó J-0000000-0 ó 10900800"/>                   
                    </div>
                    <div class="input-group form-group">
                        <label class="control-label">Correo Eletrónico registrado <span class="required">*</span></label>
                        <input title="Rellene este campo" class="form-control" placeholder="Correo Electrónico" type="text" id="username" name="username" required="required" />
                        <span id="erroremail" style=" color: red;"></span>
                    </div>
                    <div class="input-group form-group">
                        <label class="control-label">Fecha de Nacimiento <span class="required">*</span></label>
                        <input id="fecnacrec" name="fecnacrec" type="text" class="form-control fomul datepicker fec" placeholder="Fecha de Nacimiento">
                        <br><br>                    
                    </div>
                    <div class="form-group" style="text-align: center;">
                        <input id="id_usu" name="id_usu" type="hidden"/>
                        <input class="buscar-submit btn btn-primary col-md-4 col-md-offset-4" value="Buscar"/>
                        <input class="cambiodos-submit btn btn-primary col-md-4 col-md-offset-4" type="submit" value="Continuar" style="display: none;"/>
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
