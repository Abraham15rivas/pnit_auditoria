<?php

namespace pnit\Http\Controllers;

use pnit\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use pnit\Comun\AppComun;
use pnit\ProductoAll;

class ProductoController extends Controller {

    public function __construct() {

        $this->params = array();
    }

    public function index() {
        $productos_cargados = ProductoAll::get_productos_por_usuario(Session::get("usuario")->id);
        $proyectos_cargados = ProductoAll::get_proyectos_por_usuario(Session::get("usuario")->id);

        return view("producto.index", [
            'productos' => $productos_cargados,
            'proyectos' => $proyectos_cargados
                ]
        );
    }

    public function registerPro(Request $request) {
        $this->params ['tipo_prod'] = ProductoAll::get_tipo_producto();
        $this->params['linea_inv'] = ProductoAll::get_linea_investigacion();
        $this->params['area'] = ProductoAll::get_area();
        $this->params['motores'] = ProductoAll::get_motores();
        $this->params['tipo_patente'] = ProductoAll::get_modalidad_patente();
        $this->params['destino_producto'] = ProductoAll::get_destino_producto();
        $this->params['fuente_finan'] = ProductoAll::get_fuente_financiamiento();
        $this->params['estatus'] = ProductoAll::get_condicion_proyecto();
        $this->params['est_propuesta'] = ProductoAll::get_estado_propuesta();
        $this->params['ask1'] = ProductoAll::get_ask1();
        $this->params['ask2'] = ProductoAll::get_ask2();
        $this->params['ask3'] = ProductoAll::get_ask3();
        $this->params['part_proyecto'] = ProductoAll::get_part_proy();

        return view("producto.registro_pro", [
            'params' => $this->params
        ]);
    }

    public function sub_area(Request $request) {
        if ($request->ajax()) {
            $this->params['sub_area'] = ProductoAll::get_sub_area($request->id);

            return response()->json($this->params['sub_area']);
        }
    }

    public function especialidad(Request $request) {
        if ($request->ajax()) {
            $this->params['especialidad'] = ProductoAll::get_especialidad($request->id);
            return response()->json($this->params['especialidad']);
        }
    }

    public function deletepro(Request $request) {
        $id =  $request->id;
        $opcion = $request->opcion;

        if($opcion == 1){//opcion=1 es PRODUCTO
            $have_file_prod = ProductoAll::producto_tiene_archivo($id);
            if($have_file_prod != null){ //Tiene archivos, cambiar el estatus en la tabla
                $cam_estatus_file =  ProductoAll::cambiar_estatus_archivos($id);
                if($cam_estatus_file==true){
                    //Se cambia el estatus del producto
                    $cam_estatus_prod =  ProductoAll::cambiar_estatus_prod($id);
                    if($cam_estatus_prod==true){
                        return 1; //Exito en el proceso
                    }else{
                        return 3; //Error al actualizar en la tabla producto
                    }
                }else{
                    return 2; //Error al actualizar en la tabla archivo producto
                }

            }else{
                //Se cambia el estatus del producto
                $cam_estatus_prod =  ProductoAll::cambiar_estatus_prod($id);
                    if($cam_estatus_prod==true){
                        return 1; //Exito en el proceso
                    }else{
                        return 3; //Error al actualizar en la tabla producto
                    }                
            }


        }else{//opcion=2 es PROYECTO
            $have_file_proy = ProductoAll::proyecto_tiene_archivo($id);
            if($have_file_proy != null){ //Tiene archivos, cambiar el estatus en la tabla
                $cam_estatus_file_proy =  ProductoAll::cambiar_estatus_archivos_proy($id);
                if($cam_estatus_file_proy==true){
                    //Se cambia el estatus del producto
                    $cam_estatus_proy =  ProductoAll::cambiar_estatus_proy($id);
                    if($cam_estatus_proy==true){
                        return 1; //Exito en el proceso
                    }else{
                        return 3; //Error al actualizar en la tabla proyecto
                    }
                }else{
                    return 2; //Error al actualizar en la tabla archivo proyecto
                }

            }
            //Se cambia el estatus del producto
            $cam_estatus_proy =  ProductoAll::cambiar_estatus_proy($id);     
                    if($cam_estatus_proy==true){
                        return 1; //Exito en el proceso
                    }else{
                        return 3; //Error al actualizar en la tabla proyecto
                    }                   
        }

    }


    public function proc_reg_pro(Request $request) {
        try {
            //1) Parametros generales comunes
            $params['id_usuario'] = Session::get("usuario")->id;
            $params['titulo'] = strtoupper(trim($request['prod_tit']));
            $params['resumen'] = strtoupper(trim($request['prod_res']));
            $params['id_especialidad'] = (trim($request['prod_esp']));
            $params['id_motores'] = (trim($request['prod_mot']));
            $params['id_linea_investigacion'] = (trim($request['prod_lin']));
            $params['id_fuente_financiamiento'] = (trim($request['prod_ff']));
            $params['link_cloud_url'] = (trim($request['nubeurl']));

            if ($request->opc == 1) { //opc=1 producto
                $params['id_tipo_producto'] = trim($request['prod_tipo']);
                $params['id_tipo_patente'] = (trim($request['prod_tp']));
                $params['id_destino_producto'] = (trim($request['prod_des']));
                $params['id_estatus_producto'] = (trim($request['prod_est']));
                if ($params['id_estatus_producto'] == 1) {
                    $params['fecha_concluido'] = trim($request['fecha_con']);
                } else {
                    $params['fecha_concluido'] = null;
                }
            } else if ($request->opc == 2) { //opc=2 proyecto
                $params['objetivo'] = strtoupper(trim($request['pro_obj']));
                $params['id_estado_propuesta'] = (trim($request['proy_est']));
                $params['id_pregunta_1'] = (trim($request['proy_p1']));
                $params['id_pregunta_2'] = (trim($request['proy_p2']));
                $params['id_pregunta_3'] = (trim($request['proy_p3']));
                $params['id_participacion_proyecto'] = (trim($request['proy_p4']));
            }

            //2) Guardar en la tabla proyecto o producto
            ////////////////////////////////// PRODUCTO /////////////////////////////
            if ($request->opc == 1) {//Guardar en producto
                    //////Chequear que los campos requeridos no esten vacios, en caso de falla del Js
                if ($params['titulo'] == '' && $params['resumen'] == '' && $params['id_especialidad'] == 0 && $params['id_motores'] == 0 && $params['id_fuente_financiamiento'] == 0 && $params['id_tipo_producto'] == 0 && $params['id_estatus_producto'] == 0) {
                    return 5; //campos vacios
                } else {
                    $producto_id = ProductoAll::save_producto($params);
                    if ($producto_id != false) {
                        
                        //3 Guardar en la tabla de archivos y copiar en la carpeta
                        if ($request->hasFile('file')) {
                            $activo = true;
                            $contArch = count($request->file('file'));

                            foreach ($request->file('file') as $key => $f) {
                                $tipo = $f->getClientMimeType();
                                $tamanio = $f->getClientSize();
                                $ext = $f->getClientOriginalExtension();

                                if ($tamanio > 3145728) { //verificar por si supera los 3MB
                                    return 4; //Supera los 3Mb
                                } else { ////Puede cargar el o los archivos
                                    if ($ext == 'pdf' || $ext == 'jpg' || $ext == 'png' || $ext == 'jpeg') {
                                        $nombre_file = $params['id_usuario'] . '_' . $producto_id . '_prod_' . $key . '.' . $ext;
                                        $upload_success = $f->move(public_path() . '/files/product', $nombre_file);
                                        if ($upload_success) {
                                            $id_file = ProductoAll::save_file_prod($nombre_file, $producto_id, $activo);
                                            if ($key == 1 && $contArch == 2) {
                                                if ($id_file != false) {
                                                    return 1; ///Proceso exitoso
                                                }
                                            } else if (($key == 0 && $contArch == 1) || ($key == 1 && $contArch == 1)) { ///Cuando solo se carga uno de los archivos
                                                if ($id_file != false) {
                                                    return 1; ///Proceso exitoso
                                                }
                                            }
                                        } else {
                                            return 3; //No se pudo crear el archivo en la carpeta
                                        }
                                    } else { ///////FORMATO
                                        return 2; //Error de formato
                                    }
                                }
                            }///////////FOREACH
                        } else { /////////////No existe archivos adjuntos, e igual se guarda en producto
                            return 1; //Exitoso
                        }
                    } else {
                        return 0; ///Un error al guardar en producto
                    }
                }//////fin else campos no vacios
            }
            
            ////////////////////////////////// PROYECTO /////////////////////////////
            if ($request->opc == 2) {//Guardar en proyecto
                //////Chequear que los campos requeridos no esten vacios, en caso de falla del Js
                if ($params['titulo'] == '' && $params['resumen'] == '' && $params['id_especialidad'] == 0 && $params['id_motores'] == 0 && $params['id_fuente_financiamiento'] == 0 && $params['objetivo'] == 0 && $params['id_estado_propuesta'] == 0 && $params['id_pregunta_1'] == 0 && $params['id_pregunta_2'] == 0 && $params['id_pregunta_3'] == 0 && $params['id_participacion_proyecto'] == 0) {
                    return 5; //campos vacios
                } else {
                    $proyecto_id = ProductoAll::save_proyecto($params);
                    if ($proyecto_id != false) {

                        //3 Guardar en la tabla de archivos proyecto y copiar en la carpeta
                        if ($request->hasFile('file')) {
                            $activo = true;
                            $contArch = count($request->file('file'));
                            foreach ($request->file('file') as $key => $f) {
                                $tipo = $f->getClientMimeType();
                                $tamanio = $f->getClientSize();
                                $ext = $f->getClientOriginalExtension();

                                if ($ext == 'pdf' || $ext == 'jpg' || $ext == 'png' || $ext == 'jpeg') {
                                    $nombre_file = $params['id_usuario'] . '_' . $proyecto_id . '_proy_' . $key . '.' . $ext;
                                    $upload_success = $f->move(public_path() . '/files/project', $nombre_file);
                                    if ($upload_success) {
                                        $id_file = ProductoAll::save_file_proy($nombre_file, $proyecto_id, $activo);
                                        if ($key == 1 && $contArch == 2) {
                                            if ($id_file != false) {
                                                return 1; ///Proceso exitoso
                                            }
                                        } else if (($key == 0 && $contArch == 1) || ($key == 1 && $contArch == 1)) { ///Cuando solo se carga uno de los archivos
                                            if ($id_file != false) {
                                                return 1; ///Proceso exitoso
                                            }
                                        }
                                    } else {
                                        return 3; //No se pudo crear el archivo en la carpeta
                                    }
                                } else { ///////FORMATO
                                    return 2; //Error de formato
                                }
                            }///////////FOREACH
                        } else { /////////////No existe archivos adjuntos, e igual se guarda en producto
                            return 1; //Exitoso
                        }
                    } else {
                        return 0; //un error al guardar en proyecto
                    }
                }//////fin else campos no vacios
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
