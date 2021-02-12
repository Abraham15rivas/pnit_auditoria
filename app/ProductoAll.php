<?php

namespace pnit;

use Illuminate\Database\Eloquent\Model;
use DB;

class ProductoAll extends Model {

    public static function get_tipo_producto() {
        $params = DB::table('public.tipo_producto as tp')
                ->select('tp.id_tipo_producto', 'tp.descripcion')
                ->whereRaw('tp.activo = ?', [true])
                ->orderBy('tp.descripcion', 'asc')
                ->get();
        if ($params != null) {
            return $params;
        } else {
            return null;
        }
    }

    public static function get_linea_investigacion() {
        $params = DB::table('public.linea_investigacion as li')
                ->select('li.id as id_linea_inv', 'li.nombre as linea_inv')
                ->whereRaw('li.activo = ?', [true])
                ->orderBy('li.nombre', 'asc')
                ->get();
        if ($params != null) {
            return $params;
        } else {
            return null;
        }
    }

    public static function get_area() {
        $params = DB::table('public.area_unesco as au')
                ->select('au.id as id_area', 'au.nombre as area')
                ->orderBy('au.nombre', 'asc')
                ->get();
        if ($params != null) {
            return $params;
        } else {
            return null;
        }
    }

    public static function get_sub_area($id) {
        $params = DB::table('public.sub_area_unesco as sa')
                ->select('sa.id', 'sa.nombre')
                ->whereRaw('sa.area_unesco_id = ?', [$id])
                ->orderBy('sa.nombre', 'asc')
                ->get();
        if ($params != null) {
            return $params;
        } else {
            return null;
        }
    }

    public static function get_especialidad($id) {
        $params = DB::table('public.especialidad_unesco as es')
                ->select('es.id', 'es.nombre')
                ->whereRaw('es.sub_area_unesco_id = ?', [$id])
                ->orderBy('es.nombre', 'asc')
                ->get();
        if ($params != null) {
            return $params;
        } else {
            return null;
        }
    }

    public static function get_motores() {
        $params = DB::table('public.motores as mo')
                ->select('mo.id_motor', 'mo.nombre')
                ->whereRaw('mo.activo = ?', [true])
                ->orderBy('mo.nombre', 'asc')
                ->get();
        if ($params != null) {
            return $params;
        } else {
            return null;
        }
    }

    public static function get_modalidad_patente() {
        $params = DB::table('public.modalidad_patente as mp')
                ->select('mp.id', 'mp.nombre')
                ->orderBy('mp.nombre', 'asc')
                ->get();
        if ($params != null) {
            return $params;
        } else {
            return null;
        }
    }

    public static function get_destino_producto() {
        $params = DB::table('public.destino_producto as dp')
                ->select('dp.id_destino_producto', 'dp.destino_producto')
                ->whereRaw('dp.activo = ?', [true])
                ->orderBy('dp.destino_producto', 'asc')
                ->get();
        if ($params != null) {
            return $params;
        } else {
            return null;
        }
    }

    public static function get_fuente_financiamiento() {
        $params = DB::table('public.institucion_financiamiento as ff')
                ->select('ff.id', 'ff.nombre')
                ->orderBy('ff.nombre', 'asc')
                ->get();
        if ($params != null) {
            return $params;
        } else {
            return null;
        }
    }

    public static function get_condicion_proyecto() {
        $params = DB::table('public.condicion_proyecto as cp')
                ->select('cp.id', 'cp.nombre')
                ->orderBy('cp.nombre', 'asc')
                ->get();
        if ($params != null) {
            return $params;
        } else {
            return null;
        }
    }

    public static function get_estado_propuesta() {
        $params = DB::table('public.estado_propuesta as ep')
                ->select('ep.id_estado_propuesta', 'ep.nombre')
                ->orderBy('ep.nombre', 'asc')
                ->get();
        if ($params != null) {
            return $params;
        } else {
            return null;
        }
    }

    public static function get_ask1() {
        $params = DB::table('public.pregunta_1 as ap')
                ->select('ap.id_pregunta_1', 'ap.descripcion')
                ->whereRaw('ap.activo = ?', [true])
                ->orderBy('ap.descripcion', 'asc')
                ->get();
        if ($params != null) {
            return $params;
        } else {
            return null;
        }
    }

    public static function get_ask2() {
        $params = DB::table('public.pregunta_2 as ap')
                ->select('ap.id_pregunta_2', 'ap.descripcion')
                ->whereRaw('ap.activo = ?', [true])
                ->orderBy('ap.descripcion', 'asc')
                ->get();
        if ($params != null) {
            return $params;
        } else {
            return null;
        }
    }

    public static function get_ask3() {
        $params = DB::table('public.pregunta_3 as ap')
                ->select('ap.id_pregunta_3', 'ap.descripcion')
                ->whereRaw('ap.activo = ?', [true])
                ->orderBy('ap.descripcion', 'asc')
                ->get();

        if ($params != null) {
            return $params;
        } else {
            return null;
        }
    }

    public static function get_part_proy() {
        $params = DB::table('public.participacion_proyecto as ap')
                ->select('ap.id', 'ap.participacion')
                ->whereRaw('ap.activo = ?', [true])
                ->orderBy('ap.participacion', 'asc')
                ->get();

        if ($params != null) {
            return $params;
        } else {
            return null;
        }
    }

    public static function get_productos_por_usuario($user_id) {
        $params = DB::table('proyecto.view_productos_usuario as vpu')
                ->select('vpu.id_producto as id','vpu.tipo_producto', 'vpu.titulo', 'vpu.motor', 'vpu.estatus_producto', 'vpu.created_at')
                ->whereRaw('vpu.id_usuario = ?', [$user_id])
              //  ->where("vpu.activo", "=", true)
                ->get();
        if ($params != null) {
            return $params;
        } else {
            return null;
        }
    }

    public static function get_proyectos_por_usuario($user_id) {
        $params = DB::table('proyecto.view_proyectos_usuario as vpu')
                ->select('vpu.id_proyecto as id','vpu.titulo', 'vpu.motor', 'vpu.estado_propuesta', 'vpu.created_at')
                ->whereRaw('vpu.id_usuario = ?', [$user_id])
             //   ->where("vpu.activo", "=", true)
                ->get();
        if ($params != null) {
            return $params;
        } else {
            return null;
        }
    }


    public static function producto_tiene_archivo($id) {
        $params = DB::table('proyecto.archivo_producto as p')
                ->select('p.id')
                ->whereRaw('p.id_producto = ?', [$id])
                ->get();
        if ($params != null) {
            return $params;
        } else {
            return null;
        }
    }


    public static function proyecto_tiene_archivo($id) {
        $params = DB::table('proyecto.archivo_proyecto as p')
                ->select('p.id')
                ->whereRaw('p.id_proyecto = ?', [$id])
                ->get();
        if ($params != null) {
            return $params;
        } else {
            return null;
        }
    }

///////////////////////////////////////////////////////       ///////////////////////////////////////////
    public static function save_producto($params) { 
        DB::beginTransaction();
        try {
            $id = DB::table('proyecto.producto')->insertGetId(
                    [
                        'id_tipo_producto' => $params['id_tipo_producto'],
                        'titulo' => $params['titulo'],
                        'resumen' => $params['resumen'],
                        'id_especialidad' => $params['id_especialidad'],
                        'id_motores' => $params['id_motores'],
                        'id_tipo_patente' => $params['id_tipo_patente'],
                        'id_destino_producto' => $params['id_destino_producto'],
                        'id_fuente_financiamiento' => $params['id_fuente_financiamiento'],
                        'id_estatus_producto' => $params['id_estatus_producto'],
                        'id_linea_investigacion' => $params['id_linea_investigacion'],
                        'id_usuario' => $params['id_usuario'],
                        'fecha_concluido' => $params['fecha_concluido'],
                        'link_cloud_url' => $params['link_cloud_url']
                    ]
            );

            DB::commit();
            return $id;
        } catch (\Exception $exc) {
            error_log($exc, 0);
            DB::rollback();
            return false;
        }
    }

    public static function save_proyecto($params) { 
        DB::beginTransaction();
        try {
            $id = DB::table('proyecto.proyecto')->insertGetId(
                    [
                        'titulo' => $params['titulo'],
                        'resumen' => $params['resumen'],
                        'objetivo' => $params['objetivo'],
                        'id_especialidad' => $params['id_especialidad'],
                        'id_estado_propuesta' => $params['id_estado_propuesta'],
                        'id_pregunta_1' => $params['id_pregunta_1'],
                        'id_pregunta_2' => $params['id_pregunta_2'],
                        'id_pregunta_3' => $params['id_pregunta_3'],
                        'id_participacion_proyecto' => $params['id_participacion_proyecto'],
                        'id_financiado_por' => $params['id_fuente_financiamiento'],
                        'id_motores' => $params['id_motores'],
                        'id_linea_investigacion' => $params['id_linea_investigacion'],
                        'id_usuario' => $params['id_usuario'],
                        'link_cloud_url' => $params['link_cloud_url']
                    ]
            );

            DB::commit();
            return $id;
        } catch (\Exception $exc) {
            error_log($exc, 0);
            DB::rollback();
            return false;
        }
    }

    public static function save_file_prod($nombre_file, $producto_id, $activo) {
        DB::beginTransaction();
        try {
            $id_archivo = DB::table('proyecto.archivo_producto')->insertGetId(
                    [
                        'nombre_archivo' => $nombre_file,
                        'activo' => $activo,
                        'id_producto' => $producto_id
                    ]
            );
            DB::commit();

            return $id_archivo;
        } catch (\Exception $exc) {
            error_log($exc, 0);
            DB::rollback();
            return false;
        }
    }

    public static function save_file_proy($nombre_file, $proyecto_id, $activo) {
        DB::beginTransaction();
        try {
            $id_archivo = DB::table('proyecto.archivo_proyecto')->insertGetId(
                    [
                        'nombre_archivo' => $nombre_file,
                        'activo' => $activo,
                        'id_proyecto' => $proyecto_id
                    ]
            );
            DB::commit();

            return $id_archivo;
        } catch (\Exception $exc) {
            error_log($exc, 0);
            DB::rollback();
            return false;
        }
    }


    public static function cambiar_estatus_archivos($id) {
        DB::beginTransaction();
        try {

            DB::table('proyecto.archivo_producto')
            ->whereRaw('id_producto = ?', [$id])
            ->delete();


            DB::commit();

            return true;
        } catch (\Exception $exc) {
            error_log($exc, 0);
            DB::rollback();
            return false;
        }
    }

    public static function cambiar_estatus_prod($id) {
        DB::beginTransaction();
        try {

            DB::table('proyecto.producto')
            ->whereRaw('id = ?', [$id])
            ->delete();

            DB::commit();

            return true;
        } catch (\Exception $exc) {
            error_log($exc, 0);
            DB::rollback();
            return false;
        }
    }


    public static function cambiar_estatus_archivos_proy($id) {
        DB::beginTransaction();
        try {

            DB::table('proyecto.archivo_proyecto')
            ->whereRaw('id_proyecto = ?', [$id])
            ->delete();

            DB::commit();

            return true;
        } catch (\Exception $exc) {
            error_log($exc, 0);
            DB::rollback();
            return false;
        }
    }

    public static function cambiar_estatus_proy($id) {
        DB::beginTransaction();
        try {

            DB::table('proyecto.proyecto')
            ->whereRaw('id = ?', [$id])
            ->delete();
            DB::commit();

            return true;
        } catch (\Exception $exc) {
            error_log($exc, 0);
            DB::rollback();
            return false;
      }
  }

}
