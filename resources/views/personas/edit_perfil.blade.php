@extends('layout.base2')

@section('title', "Editar Perfil")

@section('stylesheets')
@parent

@endsection

@section("body")


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Información General <small>Datos Personales</small>
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
                <form id="editar">
                    <div class="box-body">
                        <h4>{{Session::get('usuario')->nombres}} {{Session::get('usuario')->apellidos}}</h4>
                        <br>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <label class="required">Correo Electrónico: </label>
                                {{$usuarioid[0]->correo}}
                                <br><br>
                            </div>
                            <?php $id_iden = Session::get('usuario')->id_identificador; ?>
                            @if($id_iden == 1 || $id_iden == 2 || $id_iden == 6)
                            <div class="input-field col-sm-12 col-md-6 col-lg-6">
                                <label class="control-label">Estado Civil <span class="required">*</span></label>
                                <select class="form-control fomul" name="estadocivil" id="estadocivil" disabled>
                                    <option value="0" selected>Seleccione...</option>
                                    @foreach($estadocivil as $estciv)
                                    @if($usuarioid[0]->id_estado_civil == $estciv->id)
                                    <option value="{{ $estciv -> id}}" selected="selected">{{ $estciv -> nombre}}</option>
                                    @else
                                    <option value ="{{ $estciv -> id}}"> {{ $estciv -> nombre}} </option>
                                    @endif
                                    @endforeach
                                </select>
                                <br><br>
                            </div>
                            <div class="input-field col-sm-12 col-md-6 col-lg-6">
                                <label class="control-label">Código Postal <span class="required">*</span></label>
                                <input class="form-control fomul solonumero" type="text" id="cod" name="cod"  value="{{$usuarioid[0]->codigo_postal}}" disabled>
                                <br><br>
                            </div>
                            <div class="input-field col-sm-12 col-md-6 col-lg-6">
                                <label class="control-label">Teléfono contacto <span class="required">*</span></label>
                                <input class="form-control fomul solonumero" type="text" minlength="11" maxlength="11" id="telf" name="telf" value="{{$usuarioid[0]->telefono}}" disabled>
                                <br>
                            </div>
                            <div class="input-field col-sm-12 col-md-6 col-lg-6">
                                <label class="control-label">Teléfono celular <span class="required">*</span></label>
                                <input class="form-control fomul solonumero" type="text" minlength="11" maxlength="11" id="cel" name="cel"  value="{{$usuarioid[0]->celular}}" disabled>
                                <br>
                            </div>
                            <div class="input-field col-sm-12 col-md-4 col-lg-4">
                                <label class="control-label">Estado <span class="required">*</span> </label>
                                <select class="form-control fomul" name="estado" id="estado" disabled>
                                    <option value="0">Seleccione...</option>
                                    @foreach($estados as $est)
                                    @if($usuarioid[0]->estado_id == $est -> id)
                                    <option value="{{ $est -> id}}" selected="selected">{{ $est -> nombre}}</option>
                                    @else
                                    <option value ="{{ $est -> id}}"> {{ $est -> nombre}} </option>
                                    @endif
                                    @endforeach
                                </select>
                                <br>
                            </div>
                            <div class="input-field col-sm-12 col-md-4 col-lg-4">
                                <label class="control-label">Municipio <span class="required">*</span> </label>
                                <select class="form-control fomul" name="municipio" id="municipio" disabled>
                                    <option value="0">Seleccione...</option>
                                    @foreach($municipio as $munc)
                                    @if($usuarioid[0]->municipio_id == $munc -> id)
                                    <option value="{{$munc->id}}" selected="selected">{{$munc-> nombre}}</option>
                                    @else
                                    <option value ="{{$munc->id}}"> {{$munc-> nombre}} </option>
                                    @endif
                                    @endforeach
                                </select>
                                <br>
                            </div>
                            <div class="input-field col-sm-12 col-md-4 col-lg-4">
                                <label class="control-label">Parroquia <span class="required">*</span></label>
                                <select class="form-control fomul" name="parroquia" id="parroquia" disabled >
                                    <option value="0">Seleccione...</option>
                                    @foreach($parroquia as $parr)
                                    @if($usuarioid[0]->parroquia_id == $parr -> id)
                                    <option value="{{ $parr -> id}}" selected="selected">{{ $parr -> nombre}}</option>
                                    @else
                                    <option value ="{{ $parr -> id}}"> {{ $parr -> nombre}} </option>
                                    @endif
                                    @endforeach
                                </select>
                                <br>
                            </div>
                            <div class="input-field col-sm-12 col-md-12 col-lg-12">
                                <label class="control-label">Dirección <span class="required">*</span></label>
                                <br>
                                <textarea class="form-control fomul" id="direc" name="direc" cols="50" style="resize: vertical;" disabled>{{$usuarioid[0]->direccion}}</textarea>
                                <br><br>
                            </div>
                            @else
                            <div class="input-field col-sm-12 col-md-6 col-lg-6">
                                <label class="control-label">Teléfono contacto <span class="required">*</span></label>
                                <input class="form-control fomul solonumero" type="text" minlength="11" maxlength="11" id="telf" name="telf" value="{{$usuarioid[0]->telefono}}" disabled>
                                <br>
                            </div>
                            <div class="input-field col-sm-12 col-md-6 col-lg-6">
                                <label class="control-label">Teléfono celular <span class="required">*</span></label>
                                <input class="form-control fomul solonumero" type="text" minlength="11" maxlength="11" id="cel" name="cel"  value="{{$usuarioid[0]->celular}}" disabled>
                                <br>
                            </div>
                            <div class="input-field col-sm-12 col-md-4 col-lg-4">
                                <label class="control-label">Estado <span class="required">*</span> </label>
                                <select class="form-control fomul" name="estado" id="estado" disabled>
                                    <option value="0">Seleccione...</option>
                                    @foreach($estados as $est)
                                    @if($usuarioid[0]->estado_id == $est -> id)
                                    <option value="{{ $est -> id}}" selected="selected">{{ $est -> nombre}}</option>
                                    @else
                                    <option value ="{{ $est -> id}}"> {{ $est -> nombre}} </option>
                                    @endif
                                    @endforeach
                                </select>
                                <br>
                            </div>
                            <div class="input-field col-sm-12 col-md-4 col-lg-4">
                                <label class="control-label">Municipio <span class="required">*</span> </label>
                                <select class="form-control fomul" name="municipio" id="municipio" disabled>
                                    <option value="0">Seleccione...</option>
                                    @foreach($municipio as $munc)
                                    @if($usuarioid[0]->municipio_id == $munc -> id)
                                    <option value="{{$munc->id}}" selected="selected">{{$munc-> nombre}}</option>
                                    @else
                                    <option value ="{{$munc->id}}"> {{$munc-> nombre}} </option>
                                    @endif
                                    @endforeach
                                </select>
                                <br>
                            </div>
                            <div class="input-field col-sm-12 col-md-4 col-lg-4">
                                <label class="control-label">Parroquia <span class="required">*</span></label>
                                <select class="form-control fomul" name="parroquia" id="parroquia" disabled >
                                    <option value="0">Seleccione...</option>
                                    @foreach($parroquia as $parr)
                                    @if($usuarioid[0]->parroquia_id == $parr -> id)
                                    <option value="{{ $parr -> id}}" selected="selected">{{ $parr -> nombre}}</option>
                                    @else
                                    <option value ="{{ $parr -> id}}"> {{ $parr -> nombre}} </option>
                                    @endif
                                    @endforeach
                                </select>
                                <br>
                            </div>
                            <div class="input-field col-sm-12 col-md-4 col-lg-4">
                                <label class="control-label">Código Postal <span class="required">*</span></label>
                                <input class="form-control fomul solonumero" type="text" id="cod" name="cod"  value="{{$usuarioid[0]->codigo_postal}}" disabled>
                                <br><br>
                            </div>
                            <div class="input-field col-sm-12 col-md-12 col-lg-12">
                                <label class="control-label">Dirección <span class="required">*</span></label>
                                <br>
                                <textarea class="form-control fomul" id="direc" name="direc" cols="50" style="resize: vertical;" disabled>{{$usuarioid[0]->direccion}}</textarea>
                                <br><br>
                            </div>
                            @endif

                            <div class="col-sm-12 col-md-12 col-lg-12" style="text-align: center;">
                                <div id="esp" class="col-sm-12 col-md-12 col-lg-12" style="text-align: center;">
                                    <button type="button" id="eData" name="eData" class="btn btn-outline-primary">Editar</button>
                                </div>
                                <div id="act" class="col-sm-12 col-md-12 col-lg-12" style="text-align: center; display: none;">
                                    <button type="button" id="actualizarData" name="actualizarData" class="btn btn-primary" style="margin-right: 15%;">Enviar</button>
                                    <button type="button" id="cancelar" name="cancelar" class="btn btn-danger">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div> 
                    {{ csrf_field()}}  
                </form>
            </div>
        </div>

        <div class="col-md-4 col-xs-12">
            <div class="box box-primary" style="padding-bottom:1px;">
                <div class="box-header">
                    <h3 class="box-title">Foto del Aspirante</h3>
                </div>

                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <a class="thumbnail" style="margin: 10px;">
                            <div id="of_userbundle_aspirante_fileAvatar_img" data-toggle="tooltip" data-placement="top" title="Cambiar Imágen">
                                <img src="{{ asset("upload/noFoto.png")}}" />
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('javascripts')
@parent
<script src="{{ asset("js/usu.js")}}"></script>
@endsection
