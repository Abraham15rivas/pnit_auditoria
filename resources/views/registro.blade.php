@extends('layout.base')

@section('title', "Regístrate")

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

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
            <div class="box box-solid" style="margin-top:70px; border: 1px solid #C9C9C9; margin-bottom: 80px;">
                <div class="box-header">
                    <h3 class="box-title">Registro de Usuario</h3>
                </div>
                <div id="alert" class="alert alert-danger alert-dismissable" style=" display: none;"></div>
                <div class="box-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col col-xs-12 col-md-4 col-lg-4">
                                <label class="control-label">Tipo</label>
                                <select class="form-control fomul" name="nac" id="nac" >
                                    <option value="0" selected>Seleccione...</option>
                                    @foreach($tipo_identificacion as $tid)
                                    <option value ="{{ $tid -> id}}"> {{ $tid -> codigo}} </option>
                                    @endforeach
                                </select>
                                <br><br>
                            </div>
                            <div class="form-inline col-xs-12 col-md-6 col-lg-6">
                                <label class="control-label">N° de Documento</label>
                                <br>
                                <input class="form-control fomul" maxlength="12" id="identificador" name="identificador" type="text" placeholder="ej: 019845256 ó J-0000000-0" class="form-control"/>
                            </div>
                            <div class="form-inline col-xs-12 col-md-2 col-lg-2">
                                <br>
                                <a id="bcedula" class="btn btn-flat btn-warning"><i class="fa fa-search"></i></a>
                            </div>

                            <div class="col col-xs-12 col-md-12 col-lg-12" style=" margin-top: 10px;">
                                <div id="cargando" class="col-sm-12 col-md-12 col-lg-12" style="display: none;">
                                    <div class="loading" style="text-align: center;">
                                        <img src="{{ asset("img/loader.gif") }}" alt="loading">
                                        <br/>Un momento, por favor...
                                    </div>
                                </div>
                                <form id="for_user_registration_natu" name="for_user_registration_natu" method=post action=submit>
                                    <div id="nuevo" class="col-sm-12 col-md-12 col-lg-12" style="display:none;">
                                        <h2 style=" text-align: center; color: #0059bc; margin-bottom: 50px;">Complete los datos básicos</h2> 
                                        <div class="row" style=" margin-top: 20px;">
                                            <div class="input-field col-sm-12 col-md-6 col-lg-6">
                                                <label class="control-label">Nacionalidad <span class="required">*</span></label>
                                                <input class="form-control" type="text"  id="nacio" name="nacio" validate/>
                                                <br>
                                            </div>
                                            <div class="input-field col-sm-12 col-md-6 col-lg-6">
                                                <label class="control-label">N° de Cédula / Pasaporte <span class="required">*</span></label>
                                                <input class="form-control" type="text" id="cedula" name="cedula"/>
                                                <br>
                                            </div>
                                        </div>
                                        <div class="row" style=" margin-top: 20px;">
                                            <div class="input-field col-sm-12 col-md-6 col-lg-6">
                                                <label class="control-label">Primer Nombre <span class="required">*</span></label>
                                                <input class="form-control fomul" type="text"  id="pnombre" name="pnombre" validate />
                                                <br>
                                            </div>
                                            <div class="input-field col-sm-12 col-md-6 col-lg-6">
                                                <label class="control-label">Segundo Nombre</label>
                                                <input class="form-control" type="text" id="snombre" name="snombre" />
                                                <br>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col-sm-12 col-md-6 col-lg-6">
                                                <label class="control-label">Primer Apellido <span class="required">*</span></label>
                                                <input class="form-control fomul" type="text" id="papellido" name="papellido" validate />
                                                <br>
                                            </div>
                                            <div class="input-field col-sm-12 col-md-6 col-lg-6">
                                                <label class="control-label">Segundo Apellido</label>
                                                <input class="form-control" type="text" id="sapellido" name="sapellido" />
                                                <br>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                <label class="control-label">Género Persona <span class="required">*</span></label>
                                                <select class="form-control fomul" name="genero" id="genero"  validate>
                                                    <option class="genn" value="0" selected>Seleccione...</option>
                                                    @foreach($genero as $gen)
                                                    <option class="genn" value ="{{ $gen -> id_genero}}"> {{ $gen -> genero}} </option>
                                                    @endforeach
                                                </select>
                                                <br><br>
                                            </div>
                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                <label class="control-label">Estado Civil <span class="required">*</span></label>
                                                <select class="form-control fomul" name="estadocivil" id="estadocivil" validate >
                                                    <option value="0" selected>Seleccione...</option>
                                                    @foreach($estadocivil as $estciv)
                                                    <option value ="{{ $estciv -> id}}"> {{ $estciv -> nombre}} </option>
                                                    @endforeach
                                                </select>
                                                <br><br>
                                            </div>
                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                <label class="control-label">Fecha Nacimiento <span class="required">*</span></label>
                                                <input id="fecnac" name="fecnac" type="text" class="form-control fomul datepicker fec" validate readonly>
                                                <input id="fecnac1" name="fecnac1" type="hidden">
                                                <br><br>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col-sm-12 col-md-12 col-lg-12">
                                                <label class="control-label">Correo electrónico <span class="required">*</span></label>
                                                <input class="form-control fomul" type="email" id="correo" name="correo" validate>
                                                <span id="erroremail" style=" color: red;"></span>
                                                <br>
                                            </div>
                                            <div class="input-field col-sm-12 col-md-6 col-lg-6">
                                                <label class="control-label">Teléfono contacto <span class="required">*</span></label>
                                                <input class="form-control fomul solonumero" type="text" minlength="11" maxlength="11" id="telf" name="telf"  validate>
                                                <br>
                                            </div>
                                            <div class="input-field col-sm-12 col-md-6 col-lg-6">
                                                <label class="control-label">Teléfono celular <span class="required">*</span></label>
                                                <input class="form-control fomul solonumero" type="text" minlength="11" maxlength="11" id="cel" name="cel"  validate>
                                                <br>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col-sm-12 col-md-84 col-lg-4">
                                                <label class="control-label">Código Postal <span class="required">*</span></label>
                                                <input class="form-control fomul solonumero" type="text" id="cod" name="cod"  validate>
                                                <br>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col-sm-12 col-md-4 col-lg-4">
                                                <label class="control-label">Estado <span class="required">*</span></label>
                                                <select class="form-control fomul" name="estado" id="estado" validate>
                                                    <option value="0" selected>Seleccione...</option>
                                                    @foreach($estados as $est)
                                                    <option value ="{{ $est -> id}}"> {{ $est -> nombre}} </option>
                                                    @endforeach
                                                </select>
                                                <br>
                                            </div>
                                            <div class="input-field col-sm-12 col-md-4 col-lg-4">
                                                <label class="control-label">Municipio <span class="required">*</span></label>
                                                <select class="form-control fomul" name="municipio" id="municipio" validate>
                                                    <option value="0" selected>Seleccione...</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="input-field col-sm-12 col-md-4 col-lg-4">
                                                <label class="control-label">Parroquia <span class="required">*</span></label>
                                                <select class="form-control fomul" name="parroquia" id="parroquia" validate>
                                                    <option value="0" selected>Seleccione...</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="input-field col-sm-12 col-md-12 col-lg-12">
                                                <label class="control-label">Dirección <span class="required">*</span></label>
                                                <br>
                                                <textarea class="form-control fomul" id="direc" name="direc" cols="50" style="resize: vertical;" validate></textarea>
                                                <br><br>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col-sm-12 col-md-6 col-lg-6">
                                                <label class="control-label">Usuario <span class="required">*</span></label>
                                                <input class="form-control fomul" type="text"  id="usuarioper" name="usuarioper" readonly="readonly"/>
                                                <br>
                                            </div>
                                            <div class="input-field col-sm-12 col-md-6 col-lg-6">
                                                <label class="control-label">Contraseña <span class="required">*</span></label>
                                                <input class="form-control fomul" type="password" minlength="8" id="clave" name="clave" validate/>
                                                <font color="blue"> La clave o contraseña debe ser mayor a 8 digitos, debe tener una letra mayúscula, letras minúsculas y caracteres numericos.</font>
                                                <br>
                                                <span id="errorpass" style="color: red; font-weight: bold;"></span>    
                                                <br><br><br>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12" style="text-align: center;">
                                            <input id="tipo" name="tipo" type="hidden">
                                            <!--<div id="RecaptchaField1"></div>-->
                                            <!--button type="button" id="enviar" name="enviar" class="btn btn-primary enviar">Enviar</button-->
                                        </div>
                                    </div>
                                </form>
                                <form id="for_user_registration_jur" name="for_user_registration_jur" method=post action=submit>
                                    <div id="nuevojur" class="col-sm-12 col-md-12 col-lg-12" style="display:none;">
                                        <h2 style=" text-align: center; color: #0059bc; margin-bottom: 50px;">Complete los datos básicos de la Empresa</h2> 
                                        <div class="row" style=" margin-top: 20px;">
                                            <div class="input-field col-sm-12 col-md-6 col-lg-6">
                                                <label class="control-label">RIF <span class="required">*</span></label>
                                                <input class="form-control" type="text" id="rif" name="rif" validate/>
                                                <br>
                                            </div>
                                            <div class="input-field col-sm-12 col-md-12 col-lg-12">
                                                <label class="control-label">Nombre de la Empresa <span class="required">*</span></label>
                                                <input class="form-control fomul" type="text"  id="emp" name="emp" validate/>
                                                <br>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="input-field col-sm-12 col-md-12 col-lg-12">
                                                <label class="control-label">Correo electrónico <span class="required">*</span></label>
                                                <input class="form-control fomul" type="email" id="correoe" name="correoe" validate>
                                                <span id="erroremaile" style=" color: red;"></span>
                                                <br>
                                            </div>
                                            <div class="input-field col-sm-12 col-md-6 col-lg-6">
                                                <label class="control-label">Teléfono contacto <span class="required">*</span></label>
                                                <input class="form-control fomul solonumero" type="text" minlength="11" maxlength="11" id="telfe" name="telfe"  validate>
                                                <br>
                                            </div>
                                            <div class="input-field col-sm-12 col-md-6 col-lg-6">
                                                <label class="control-label">Teléfono celular <span class="required">*</span></label>
                                                <input class="form-control fomul solonumero" type="text" minlength="11" maxlength="11" id="cele" name="cele"  validate>
                                                <br>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col-sm-12 col-md-84 col-lg-4">
                                                <label class="control-label">Código Postal <span class="required">*</span></label>
                                                <input class="form-control fomul solonumero" type="text" id="code" name="code"  validate>
                                                <br>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col-sm-12 col-md-4 col-lg-4">
                                                <label class="control-label">Estado <span class="required">*</span></label>
                                                <select class="form-control fomul" name="estadoe" id="estadoe" validate>
                                                    <option value="0" selected>Seleccione...</option>
                                                    @foreach($estados as $est)
                                                    <option value ="{{ $est -> id}}"> {{ $est -> nombre}} </option>
                                                    @endforeach
                                                </select>
                                                <br>
                                            </div>
                                            <div class="input-field col-sm-12 col-md-4 col-lg-4">
                                                <label class="control-label">Municipio <span class="required">*</span></label>
                                                <select class="form-control fomul" name="municipioe" id="municipioe" validate>
                                                    <option value="0" selected>Seleccione...</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="input-field col-sm-12 col-md-4 col-lg-4">
                                                <label class="control-label">Parroquia <span class="required">*</span></label>
                                                <select class="form-control fomul" name="parroquiae" id="parroquiae" validate>
                                                    <option value="0" selected>Seleccione...</option>
                                                </select>
                                                <br>
                                            </div>
                                            <div class="input-field col-sm-12 col-md-12 col-lg-12">
                                                <label class="control-label">Dirección <span class="required">*</span></label>
                                                <br>
                                                <textarea class="form-control fomul" id="direce" name="direce" cols="50" style="resize: vertical;"  validate></textarea>
                                                <br><br>
                                            </div>
                                        </div>
                                        <h2 style=" text-align: center; color: #0059bc; margin-bottom: 50px;">Complete los datos básicos del Representante Legal</h2> 
                                        <div id="alert2" class="alert alert-danger alert-dismissable" style=" display: none;"></div>
                                        <div class="row">
                                            <div class="col col-xs-12 col-md-4 col-lg-4">
                                                <label class="control-label">Nacionalidad <span class="required">*</span></label>
                                                <select class="form-control fomul" name="nacr" id="nacr" >
                                                    <option value="0" selected>Seleccione...</option>
                                                    <option value="1">V</option>
                                                    <option value="2">E</option>
                                                    <option value="6">P</option>
                                                </select>
                                                <br><br>
                                            </div>
                                            <div class="form-inline col-xs-12 col-md-6 col-lg-6">
                                                <label class="control-label">Nº de Identidad<span class="required">*</span></label>
                                                <br>
                                                <input class="form-control fomul" maxlength="12" id="identificadorr" name="identificadorr" type="text" placeholder="ej: 019845256" class="form-control"/>
                                            </div>
                                            <div class="form-inline col-xs-12 col-md-2 col-lg-2">
                                                <br>
                                                <a id="bcedulae" class="btn btn-flat btn-warning"><i class="fa fa-search"></i></a>
                                            </div>
                                        </div>
                                        <div id="darep" class="row" style=" margin-top: 20px; display: none;">
                                            <div class="row">
                                                <div class="input-field col-sm-12 col-md-6 col-lg-6">
                                                    <label class="control-label">Nacionalidad <span class="required">*</span></label>
                                                    <input class="form-control fomul" type="text"  id="nacior" name="nacior" validate/>
                                                    <br>
                                                </div>
                                                <div class="input-field col-sm-12 col-md-6 col-lg-6">
                                                    <label class="control-label">N° de Cédula / Pasaporte <span class="required">*</span></label>
                                                    <input class="form-control fomul" type="text" id="cedular" name="cedular" validate/>
                                                    <br>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="input-field col-sm-12 col-md-6 col-lg-6">
                                                    <label class="control-label">Primer Nombre <span class="required">*</span></label>
                                                    <input class="form-control fomul" type="text"  id="pnombrer" name="pnombrer" validate />
                                                    <br>
                                                </div>
                                                <div class="input-field col-sm-12 col-md-6 col-lg-6">
                                                    <label class="control-label">Segundo Nombre</label>
                                                    <input class="form-control" type="text" id="snombrer" name="snombrer" />
                                                    <br>
                                                </div>
                                            </div>                                                
                                            <div class="row">
                                                <div class="input-field col-sm-12 col-md-6 col-lg-6">
                                                    <label class="control-label">Primer Apellido <span class="required">*</span></label>
                                                    <input class="form-control fomul" type="text" id="papellidor" name="papellidor" validate />
                                                    <br>
                                                </div>
                                                <div class="input-field col-sm-12 col-md-6 col-lg-6">
                                                    <label class="control-label">Segundo Apellido</label>
                                                    <input class="form-control" type="text" id="sapellidor" name="sapellidor" />
                                                    <br>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6 col-lg-6">
                                                    <label class="control-label">Género Persona <span class="required">*</span></label>
                                                    <select class="form-control fomul" name="generor" id="generor" validate>
                                                        <option class="genn" value="0" selected>Seleccione...</option>
                                                        @foreach($genero as $gen)
                                                        <option class="genn" value ="{{ $gen -> id_genero}}"> {{ $gen -> genero}} </option>
                                                        @endforeach
                                                    </select>
                                                    <br><br>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-6">
                                                    <label class="control-label">Fecha Nacimiento <span class="required">*</span></label>
                                                    <input id="fecnacr" name="fecnacr" type="text" class="form-control fomul datepicker" validate readonly>
                                                    <input id="fecnac1r" name="fecnac1r" type="hidden">
                                                    <br><br>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col-sm-12 col-md-6 col-lg-6">
                                                    <label class="control-label">Usuario <span class="required">*</span></label>
                                                    <input class="form-control fomul" type="text"  id="usuarioperr" name="usuarioperr" readonly="readonly"/>
                                                    <br>
                                                </div>
                                                <div class="input-field col-sm-12 col-md-6 col-lg-6">
                                                    <label class="control-label">Contraseña <span class="required">*</span></label>
                                                    <input class="form-control fomul" type="password" minlength="8" id="clavee" name="clavee" validate/>
                                                    <font color="blue"> La clave o contraseña debe ser mayor a 8 digitos, debe tener una letra mayúscula, letras minúsculas y caracteres numericos.</font>
                                                    <br>
                                                    <span id="errorpassr" style="color: red; font-weight: bold;"></span>    
                                                    <br><br><br>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-12 col-md-12 col-lg-12" style="text-align: center;">
                                                <input id="tipo" name="tipo" type="hidden" value="3">
                                                <!--<div id="RecaptchaField1" ></div>-->
                                                <!--button type="button" id="enviar" name="enviar" class="btn btn-primary enviar">Enviar</button-->
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div id="captcha" class="form-group col-sm-12 col-md-12 col-lg-12" style="text-align: center; display: none;">
                                    <!--<input id="tipo" name="tipo" type="hidden">-->
                                    <div id="RecaptchaField1" ></div>
                                    <!--button type="button" id="enviar" name="enviar" class="btn btn-primary enviar">Enviar</button-->
                                </div>
                            </div>
                        </div>
                    </div>

                    {{ csrf_field()}}                   
                </div>
            </div>
            <br><br> <br><br> <br><br>
        </div>
    </div>
</div>

@endsection

@section('javascripts')
@parent
<script src="{{ asset("js/registro.js")}}"></script>
<script src="https://www.google.com/recaptcha/api.js?hl=es&onload=CaptchaCallback&render=explicit" type="text/javascript"></script>
@endsection
