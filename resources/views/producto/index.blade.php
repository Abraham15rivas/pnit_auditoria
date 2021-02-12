@extends('layout.base2')
@section('title', "Registros")
@section('stylesheets')
@parent
<link rel="stylesheet" href="{{ asset('datatables/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('datatables/buttons.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables/responsive.bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables/fixedHeader.bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables/scroller.bootstrap.css') }}">  
@endsection

@section("body")
<section class="content-header">
    <h1>PNIT <small>Registros cargados</small></h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-lg-12">
            <div class=""></div>
            <div class="box box-danger col-md-12">
                <div class="box-header ">
                    <h3 class="box-title">Registros cargados</h3> 
                </div>
                <div class="box-body">
                    <div class="row" id="prod">
                        <div class="col col-xs-12 col-md-12 col-lg-12">
                            <form role="form" name="seepro" id="seepro" method="post" action="">
                                <div class="box-body">
                                    <input id="user_id" name="user_id" type="hidden" value="{{ Session::get("usuario")->id  }}">
                                    <div class="row">
                                        <div class="form-group">    
                                            <div class="col-sm-12 col-md-6 col-lg-6"> 
                                                <div class="form-group" >
                                                    <label for="prov" class="required">
                                                        &nbsp;&nbsp;Seleccione:&nbsp;&nbsp;
                                                    </label>
                                                    <label><input type="radio" name="prov" id="prod" value="1">&nbsp;&nbsp;&nbsp;  Producto</label> &nbsp;&nbsp;&nbsp;
                                                    <label><input type="radio" name="prov" id="proy" value="2">&nbsp;&nbsp;&nbsp;  Proyecto</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" id="ver_prods" style="display: none">
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6 col-lg-6">
                                                <h4><strong>Productos cargados</strong></h4>
                                            </div>
                                        </div><br>

                                        <div class="table-responsive">
                                            <table id="lista_reg" class="table table-striped table-bordered tabla_consulta"  cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="10%" class="center">Tipo</th>
                                                        <th width="40%" class="center">Título</th>
                                                        <th width="30%" class="center">Motor</th>
                                                        <th width="10%" class="center">Estatus</th>
                                                        <th width="10%" class="center">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody> 
                                                    @foreach ($productos as  $pev)
                                                    <tr>
                                                        <td style=" text-align: justify;" width="10%">{{ $pev->tipo_producto }}</td>
                                                        <td style=" text-align: justify" width="40%">{{  $pev->titulo }}</td>
                                                        <td style=" text-align: justify;" width="30%">{{ mb_strtoupper($pev->motor, 'UTF-8') }}</td>
                                                        <td style=" text-align: justify" width="10%">{{  $pev->estatus_producto }}</td> 
                                                        <td style=" text-align: justify" width="10%">
                                                            <a class="btn btn-danger" onclick="down_pro({{$pev->id}},{{1}})">Eliminar</a>
                                                        </td>                                                   
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>                                        
                                    </div>

                                    <div class="row" id="ver_proys" style="display: none">
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6 col-lg-6">
                                                <h4><strong>Proyectos cargados</strong></h4>
                                            </div>
                                        </div><br>
                                        <div class="table-responsive">
                                            <table id="list_regpr" class="table table-striped table-bordered tabla_consulta"  cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th width="40%" class="center">Título</th>
                                                        <th width="30%" class="center">Motor</th>
                                                        <th width="15%" class="center">Estado de la propuesta</th>
                                                        <th width="15%" class="center">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                       
                                                    @foreach ($proyectos as  $pev)
                                                    <tr>
                                                        <td style=" text-align: justify" width="40%">{{  $pev->titulo }}</td>
                                                        <td style=" text-align: justify;" width="30%">{{ mb_strtoupper($pev->motor, 'UTF-8') }}</td>
                                                        <td style=" text-align: justify" width="15%">{{  $pev->estado_propuesta }}</td> <td style=" text-align: justify" width="15%">
                                                            <a class="btn btn-danger" onclick="down_pro({{$pev->id}},{{2}})">Eliminar</a>
                                                        </td>                                                   
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>                                            
                                    </div>
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
<script src="{{ asset('js/formatoConsultaTabla.js') }}"></script>
<script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('datatables/dataTables.buttons.min.js') }}"></script>       
<script src="{{ asset('datatables/jszip.min.js') }}"></script>        
<script src="{{ asset('datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('js/dataTables/dataTables.scroller.js') }}"></script>
<script src="{{ asset('js/dataTables/dataTables.responsive.js') }}"></script>
<script src="{{ asset('js/dataTables/dataTables.fixedHeader.js') }}"></script> 
<script src="{{ asset("js/lista_registros.js") }}"></script>
@endsection
