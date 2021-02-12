@extends('layout.base2')

@section('title', "Cambio de Clave de Usuario")

@section('stylesheets')
@parent

@endsection

@section("body")


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Información General <small>Cambio de Clave de Usuario</small>
    </h1>
</section>
<!-- Main content -->

<section class="content">
    <div class="row">
        <div class="col-md-8 col-xs-12">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">{{Session::get('usuario')->codigo}} - {{Session::get('usuario')->identificador}} / INNOVADOR(A)</h3>
                </div>
                <form id="clavesss">
                    <div class="box-body">
                        <h4>{{Session::get('usuario')->nombres}} {{Session::get('usuario')->apellidos}}</h4><br><br>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <center>
                                    <div id="contra" class="input-group form-group col col-xs-12 col-md-6 col-lg-6">
                                        <label class="control-label">Escriba la nueva contraseña<span class="required">*</span></label>
                                        <input class="form-control fomul" type="password" minlength="8" id="clave" name="clavee" validate/>
                                        <font color="blue"> La clave o contraseña debe ser mayor a 8 digitos, debe tener una letra mayúscula, letras minúsculas y caracteres numericos.</font>
                                        <br>
                                        <span id="errorpassr" style="color: red; font-weight: bold;"></span>    
                                        <br><br>
                                    </div>
                                    <div class="form-group" style="text-align: center;">
                                        <input id="id_usu" name="id_usu" type="hidden" value="{{Session::get('usuario')->id}}" />
                                        <input id="guarda" class="btn btn-primary" value="Guardar"/>
                                        <br><br>
                                    </div>
                                </center>
                            </div>
                        </div>
                    </div> 
                    {{ csrf_field()}}  
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@section('javascripts')
@parent
<script src="{{ asset("js/usu.js")}}"></script>
@endsection
