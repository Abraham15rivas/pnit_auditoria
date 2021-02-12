<?php

namespace pnit;

use Illuminate\Database\Eloquent\Model;
use DB;

class Principal extends Model {

    public static function tipoIdentificacion() {

        $consulta = DB::table('usuario.tipo_identificacion')
                ->select('id', 'codigo')
                ->orderBy('id')
                ->get();

        if (!sizeof($consulta) == 0) {

            foreach ($consulta as $tipo_identificacion) {

                $params[] = $tipo_identificacion;
            }

            return $params;
        }

        return false;
    }

    public static function estadocivil() {

        $consulta = DB::table('public.estado_civil')
                ->select('id', 'nombre')
                ->orderBy('nombre', 'asc')
                ->get();

        if (!sizeof($consulta) == 0) {

            foreach ($consulta as $estadocivil) {

                $params[] = $estadocivil;
            }

            return $params;
        }

        return false;
    }

    public static function estados() {

        $consulta = DB::table('public.estado')
                ->select('id', 'nombre')
                ->orderBy('nombre')
                ->get();

        if (!sizeof($consulta) == 0) {

            foreach ($consulta as $estado) {

                $params[] = $estado;
            }

            return $params;
        }

        return false;
    }

    public static function municipio($id) {

        $consulta = DB::table('public.municipio')
                ->select('id', 'nombre')
                ->where('estado_id', '=', $id)
                ->get();

        if (!sizeof($consulta) == 0) {

            foreach ($consulta as $municipio) {

                $params[] = $municipio;
            }

            return $params;
        }

        return false;
    }

    public static function parroquia($id) {

        $consulta = DB::table('public.parroquia')
                ->select('id', 'nombre')
                ->where('municipio_id', '=', $id)
                ->get();

        if (!sizeof($consulta) == 0) {

            foreach ($consulta as $parroquia) {

                $params[] = $parroquia;
            }

            return $params;
        }

        return false;
    }

    public static function genero() {

        $consulta = DB::table('public.genero')
                ->select('id_genero', 'genero')
                ->orderBy('genero', 'desc')
                ->get();

        if (!sizeof($consulta) == 0) {

            foreach ($consulta as $genero) {

                $params[] = $genero;
            }

            return $params;
        }

        return false;
    }

    public static function cedulaExiste($nac, $cedula, $nacio) {

        $consulta1 = DB::table('usuario.usuario')
                ->select('correo')
                ->where('id_identificador', '=', $nac)
                ->where('identificador', '=', $cedula)
                ->first();


        if ($consulta1 != null) {
            return 1; /* ya esta registrado */
        } else {
            if (($nac == 1 || $nac == 2) && is_numeric($cedula)) {

                //$url = "http://190.202.49.233:9010/io/gob/ve/buscaTripletaPorSujeto";
                $url = "http://webservices.mppeuct.gob.ve/saime/saime.wsdl";
                $url2 = "http://webservices.mppeuct.gob.ve/saime/saime.wsdl";
                //$options['sujeto'] = "http://io.saime.gob.ve/solvencia/".$letra."-".$id;
                ini_set("soap.wsdl_cache_enabled", "0");
                $params = array('cedula' => $cedula, 'nacionalidad' => $nacio);
                $client = new \SoapClient($url, array('cache_wsdl' => WSDL_CACHE_NONE, 'trace' => TRUE));
                //$client = new SoapClient("http://webservices.mppeuct.gob.ve/saime/saime.wsdl",array());
                //$client->__setLocation($url2);
                $soapstruct = new \SoapVar($params, SOAP_ENC_OBJECT, "params", "http://webservices.mppeuct.gob.ve/saime/schema.xsd");
                $consulta = $client->consultarSaime(new \SoapParam($soapstruct, "message"));
                $fecha = $consulta['fechanac'];
                list($anio) = explode("-", $fecha);
                if ($anio > '2004') {
                    return 5;
                } else {
                    if ($consulta != 0) {
                        foreach ($consulta as $persona) {
                            $params[] = $persona;
                        }
                        return $params;
                    }
                }
            } else if (($nac == 1 || $nac == 2) && !is_numeric($cedula)) {
                return 4;
            } else if ($nac == 3 || $nac == 4 || $nac == 5) {

                $consulta1 = DB::connection('seniat')
                        ->table('public.data')
                        ->select('rif', 'razon_social', 'direccion_fiscal', 'telefono_contacto_1', 'telefono_contacto_2', 'email_declarado', 'cedula_representante_legal')
                        ->where('rif', '=', $cedula)
                        ->first();

                if ($consulta1 != false) {

                    foreach ($consulta1 as $empresas) {

                        $params[] = $empresas;
                    }

                    return $params;
                }
            }
            return false;
        }
    }

    public static function nombre_identificador($id) {

        $consulta = DB::table('public.municipio')
                ->select('id', 'nombre')
                ->where('estado_id', '=', $id)
                ->get();

        if (!sizeof($consulta) == 0) {

            foreach ($consulta as $municipio) {

                $params[] = $municipio;
            }

            return $params;
        }

        return false;
    }

}
