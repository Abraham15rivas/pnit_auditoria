@extends('layout.base2')
@section('title', "Formulario de registro")
@section('stylesheets')
@parent
<style>
.date-form { margin: 10px; }
label.control-label span { cursor: pointer; }

.with-errors {
    border:1px solid red;
}
.has-error {
  border-color: #a94442;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
}
</style>
@endsection

@section("body")
<section class="content-header">
    <h1>PNIT <small>Formulario de registro</small></h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class=""></div>
            <div class="box box-danger col-md-12">
                <div class="box-header ">
                    <h3 class="box-title">Formulario de registro</h3> 
                </div>
                <div class="box-body">
                    <div class="row" id="prod">
                        <div class="col col-xs-12 col-md-12 col-lg-12">
                            <form role="form" name="reg_save" id="reg_save" method="post" action="" enctype="multipart/form-data">
                                <div class="box-body">
                                    <input id="user_id" name="user_id" type="hidden" value="{{ Session::get("usuario")->id  }}">
                                    <div class="row">
                                        <div class="form-group">
            
                                            <div class="col-sm-12 col-md-4 col-lg-4"> 
                                                <div class="form-group" >
                                                  <label for="pro" class="required" id="radios">
                                                    &nbsp;&nbsp;Seleccione:&nbsp;&nbsp;  <span class="required" titulo="Requerido">*&nbsp;&nbsp;</span>
                                                </label>
                                                    <label><input type="radio" name="opc" id="prod" checked value="1"> Producto</label> &nbsp;&nbsp;&nbsp;
                                                    <label><input type="radio" name="opc" id="proy" value="2"> Proyecto</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-4 col-lg-4" id="tipo_producto">
                                                <label for="prod_tipo" class="required">
                                                    Tipo: <span class="required" titulo="Requerido">*</span>
                                                </label>
                                                <select id="prod_tipo" name="prod_tipo" class="form-control">
                                                    <option value="0" selected>Seleccione...</option>
                                                    @foreach($params['tipo_prod'] as $tp)
                                                    <option value ="{{ $tp->id_tipo_producto}}"> {{ $tp->descripcion}} </option>
                                                    @endforeach

                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">                                            
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <label for="prod_tit" class="required">
                                                    Título:<span class="required" titulo="Requerido">*</span>
                                                </label>
                                                <textarea id="prod_tit" name="prod_tit" class="form-control" ></textarea>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12"><br>
                                                <label for="prod_res" class="required">
                                                    Resumen: <span class="required" titulo="Requerido">*</span>
                                                </label>
                                                <textarea id="prod_res" name="prod_res" class="form-control" rows="4" cols="50"></textarea>
                                            </div>                                            
                                        </div>
                                    </div>
                                    <div class="row" id="objetivo" style="display:none">
                                        <div class="form-group"><br>
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <label for="pro_obj" class="">
                                                    Objetivo: <span class="required" titulo="Requerido">*</span>
                                                </label>
                                                <textarea id="pro_obj" name="pro_obj" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row"><br>
                                            <div class="form-group">
                                                <div class="col-sm-12 col-md-4 col-lg-4">
                                                    <label for="prod_lin" class="">
                                                        Línea de investicación: 
                                                    </label>
                                                    <select id="prod_lin" name="prod_lin" class="form-control">
                                                        <option value="0" selected>Seleccione...</option>
                                                        @foreach($params['linea_inv'] as $li)
                                                        <option value ="{{ $li->id_linea_inv }}"> {{  mb_strtoupper($li->linea_inv, 'UTF-8')}} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                <label for="prod_mot" class="required">
                                                    Motores: <span class="required" titulo="Requerido">*</span>
                                                </label>
                                                <select id="prod_mot" name="prod_mot" class="form-control">
                                                    <option value="0" selected>Seleccione...</option>
                                                    @foreach($params['motores'] as $mo)
                                                    <option value ="{{ $mo->id_motor}}">
                                                        {{ mb_strtoupper($mo->nombre, 'UTF-8') }} 
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>   

                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                <label for="prod_ff" class="required">
                                                    Fuente de financiamiento: <span class="required" titulo="Requerido">*</span>
                                                </label>
                                                <select id="prod_ff" name="prod_ff" class="form-control">
                                                    <option value="0" selected>Seleccione...</option>
                                                    @foreach($params['fuente_finan'] as $ff)
                                                    <option value ="{{ $ff->id}}"> {{ $ff->nombre}} </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            </div>
                                    </div>

                                    <div class="row"><br>
                                        <div class="form-group">
                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                <label for="prod_ar" class="required">
                                                    Área: <span class="required" titulo="Requerido">*</span>
                                                </label>
                                                <select id="prod_ar" name="prod_ar" class="form-control">
                                                    <option value="0" selected>Seleccione...</option>
                                                    @foreach($params['area'] as $ar)
                                                    <option value ="{{ $ar->id_area}}"> {{ $ar->area}} </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                <label for="prod_sar" class="required">
                                                    Sub Área: <span class="required" titulo="Requerido">*</span>
                                                </label>
                                                <select id="prod_sar" name="prod_sar" class="form-control">
                                                    <option value="0" selected>Seleccione...</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                <label for="prod_esp" class="required">
                                                    Especialidad: <span class="required" titulo="Requerido">*</span>
                                                </label>
                                                <select id="prod_esp" name="prod_esp" class="form-control">
                                                    <option value="0" selected>Seleccione...</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    

                                    <div class="row" id="preguntas" style="display:none"><br>
                                        <div class="form-group">
                                            <div class="col-sm-12 col-md-3 col-lg-3">
                                                <label for="proy_est" class="">
                                                    Estado de la propuesta: <span class="required" titulo="Requerido">*</span>
                                                </label>
                                                <select id="proy_est" name="proy_est" class="form-control">
                                                    <option value="0" selected>Seleccione...</option>
                                                    @foreach($params['est_propuesta'] as $epr)
                                                    <option value ="{{ $epr->id_estado_propuesta}}"> {{ $epr->nombre}} </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-sm-12 col-md-5 col-lg-5">
                                                <label for="proy_p1" class="">
                                                    ¿Qué lo indujo a Ud. a plantear el desarrollo de esta propuesta?
                                                    <span class="required" titulo="Requerido">*</span>
                                                </label>
                                                <select id="proy_p1" name="proy_p1" class="form-control">
                                                    <option value="0" selected>Seleccione...</option>
                                                    @foreach($params['ask1'] as $ak1)
                                                    <option value ="{{ $ak1->id_pregunta_1}}"> {{ $ak1->descripcion}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                <label for="proy_p2" class="">
                                                    ¿Ha realizado consulta con especialistas y/o tecnólogos, conocedores del tema para el desarrollo de su propuesta?
                                                    <span class="required" titulo="Requerido">*</span>
                                                </label>
                                                <select id="proy_p2" name="proy_p2" class="form-control">
                                                    <option value="0" selected>Seleccione...</option>
                                                    @foreach($params['ask2'] as $ak)
                                                    <option value ="{{ $ak->id_pregunta_2 }}"> {{ $ak->descripcion}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group"> 
                                            <div class="col-sm-12 col-md-6 col-lg-6"><br>
                                                <label for="proy_p3" class="">
                                                    ¿Posee Ud. información técnica, experiencia y el conocimiento suficiente para desarrollar la propuesta?
                                                    <span class="required" titulo="Requerido">*</span>
                                                </label>
                                                <select id="proy_p3" name="proy_p3" class="form-control">
                                                    <option value="0" selected>Seleccione...</option>
                                                    @foreach($params['ask3'] as $ak)
                                                    <option value ="{{ $ak->id_pregunta_3 }}"> {{ $ak->descripcion}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6"><br>
                                                <label for="proy_p4" class="">
                                                    Participación en el Proyecto:
                                                    <span class="required" titulo="Requerido">*</span>
                                                </label>
                                                <select id="proy_p4" name="proy_p4" class="form-control">
                                                    <option value="0" selected>Seleccione...</option>
                                                    @foreach($params['part_proyecto'] as $ak)
                                                    <option value ="{{ $ak->id }}"> {{ $ak->participacion}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row" id="tipo_pat_destino"><br>
                                        <div class="form-group">
                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                                <label for="prod_tp">
                                                    Tipo patente:
                                                </label>
                                                <select id="prod_tp" name="prod_tp" class="form-control">
                                                    <option value="0" selected>Seleccione...</option>
                                                    @foreach($params['tipo_patente'] as $tp)
                                                    <option value ="{{ $tp->id}}"> {{ $tp->nombre}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                                <label for="prod_des">
                                                    Destino: 
                                                </label>
                                                <select id="prod_des" name="prod_des" class="form-control">
                                                    <option value="0" selected>Seleccione...</option>
                                                    @foreach($params['destino_producto'] as $tp)
                                                    <option value ="{{ $tp->id_destino_producto}} "> {{  mb_strtoupper($tp->destino_producto, 'UTF-8')}} </option>
                                                    @endforeach
                                                </select>
                                            </div>                                            
                                        </div>
                                    </div>

                                    <div class="row" id="est_prod_fecha"><br>
                                        <div class="form-group">
                                            <div class="col-sm-12 col-md-6 col-lg-6">
                                                <label for="prod_est" class="required">
                                                    Estatus: <span class="required" titulo="Requerido">*</span>
                                                </label>
                                                <select id="prod_est" name="prod_est" class="form-control">
                                                    <option value="0" selected>Seleccione...</option>
                                                    @foreach($params['estatus'] as $es)
                                                    <option value ="{{ $es->id }}"> {{ $es->nombre}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6" id="fecha_conlusion" style="display:none ">
                                            <label class="control-label">Fecha 
                                                <span class="required">*</span>
                                            </label>
                                                <input id="fecha_con" name="fecha_con" type="text" class="form-control" readonly="">
                                                <br><br>
                                            </div>                                            
                                        </div>
                                    </div>

                                    <div class="row"><br>
                                        <div class="form-group">
                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                <label for="prod_ar1">
                                                    Resumen: 
                                                </label>
                                                <input type="file" class="btn bg-purple btn-flat" id="prod_ar1" name="prod_ar1"lang="es" accept="application/pdf">
                                                <i><small>Archivo en formato pdf </small></i>
                                            </div>

                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                <label for="prod_ar2">
                                                    Imagen o Pdf:
                                                </label>
                                                <input type="file" class="btn bg-purple btn-flat" id="prod_ar2" name="prod_ar2"lang="es" accept="application/pdf, image/png, .jpeg, .jpg">
                                                <i><small>Archivo en formato jpg, png, jpeg o pdf </small></i>
                                            </div>
                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                <label for="prod_ar2">
                                                    Url de la nube:
                                                </label>
                                                <input type="text" class="form-control" id="nubeurl" name="nubeurl" placeholder="https://example.com">
                                            </div>

                                        </div>
                                    </div>


                                    <div><br> 
                                        <div class="box-footer"> 
                                            <button id="prod_reg" name="reg_save" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </div> <br> <br> 
                                </div>
                                {{ csrf_field()}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('javascripts')
@parent

<script src="{{ asset("js/producto.js")}}"></script>
@endsection
