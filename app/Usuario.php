<?php

namespace pnit;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use DB;

class Usuario extends Model {

    public static function buscarUsuario($datos) {

        try {

            DB::table('usuario.usuario')->where('correo', '=',$datos['username'])->update(['password' =>  \Hash::make('secret')]);
            $usuario = DB::table('usuario.usuario')
                    ->select('usuario.correo as correo', 'usuario.password as clave', 'usuario.identificador', 'usuario.nombres', 'usuario.apellidos', 'usuario.id', 'tipo_identificacion.codigo', 'usuario.id_identificador')
                    ->whereRaw('usuario.correo = ?', $datos['username'])
                    ->join('usuario.tipo_identificacion', 'tipo_identificacion.id', '=', 'usuario.id_identificador')
                    ->first();

            if ($usuario == null) {
                return 2;
            }

            if (!password_verify($datos['password'], $usuario->clave)) {
                return 3;
            }

            unset($usuario->clave);
            session(["usuario" => $usuario]);
            return 1;
        } catch (LoginException $e) {
            error_log($e, 0);
            return false;
        }
    }

    public static function buscarUsuarioId() {

        $usuarioId = DB::table('usuario.usuario')
                ->select('usuario.id', 'usuario.nombres', 'usuario.apellidos', 'usuario.identificador', 'tipo_identificacion.codigo', 'usuario.direccion', 'usuario.id_identificador', 'usuario.id_estado_civil', 'usuario.correo', 'usuario.codigo_postal', 'usuario.telefono', 'usuario.celular', 'genero.genero', 'parroquia.id AS parroquia_id', 'municipio.id AS municipio_id', 'estado.id AS estado_id')
                ->where('usuario.id', Session::get('usuario')->id)
                ->join('usuario.tipo_identificacion', 'tipo_identificacion.id', '=', 'usuario.id_identificador')
                ->join('public.genero', 'genero.id_genero', '=', 'usuario.id_genero')
                ->join('public.parroquia', 'parroquia.id', '=', 'usuario.id_parroquia')
                ->join('public.municipio', 'municipio.id', '=', 'parroquia.municipio_id')
                ->join('public.estado', 'estado.id', '=', 'municipio.estado_id')
                ->distinct()
                ->get();

        if ($usuarioId != null) {

            return $usuarioId;
        }
    }

    public static function bcamcla($busqueda) {

        $consulta = DB::table('usuario.usuario')
                ->select('id')
                ->where('correo', '=', $busqueda['username'])
                ->where('identificador', '=', $busqueda['identificador'])
                ->where('fecha_nac', '=', $busqueda['fecnacrec'])
                ->first();

        if ($consulta != null) {

            return $consulta;
        }

        return false;
    }

    public static function buscaUsuarioId($id) {

        $usuarioId = DB::table('usuario.usuario')
                ->select('id', 'nombres', 'apellidos')
                ->whereRaw('id = ?', $id)
                ->first();

        if ($usuarioId != null) {

            return $usuarioId;
        }
    }

    public static function comparaUsuario($quienes) {

        $id = $quienes->id;
        $nomb = explode(' ', strtoupper($quienes->nombres));
        $apell = explode(' ', strtoupper($quienes->apellidos));

        $consulta = DB::table('usuario.usuario')
                ->select('id', 'nombres', 'apellidos')
                ->where('nombres', 'LIKE', '%' . $nomb[0] . '%')
                ->orWhere('apellidos', 'LIKE', '%' . $apell[0] . '%')
                ->limit(4)
                ->get();

        $consulta1 = DB::table('usuario.usuario')
                ->select('id', 'nombres', 'apellidos')
                ->where('id', '=', $id)
                ->get();

        if (!sizeof($consulta) == 0) {

            foreach ($consulta as $usuario) {

                $params[] = $usuario;
            }
            foreach ($consulta1 as $usuario1) {

                $params[] = $usuario1;
            }

            return $params;
        }

        return false;
    }

    public static function cambioClave($clave, $id_usu) {

        try {
            DB::beginTransaction();

            $clav = password_hash($clave, PASSWORD_DEFAULT);

            $persona = DB::table('usuario.usuario')
                    ->whereRaw('id = ?', $id_usu)
                    ->update(['password' => $clav]);

            DB::commit();

            if ($persona >= 1) {
                return 1;
            } else {
                return 2;
            }

            $ess = 'Intente de nuevo';
        } catch (\Exception $ess) {
            error_log($ess, 0);
            DB::rollBack();
            return false;
        }
    }

    public static function actualizar($actpers) {

        try {
            DB::beginTransaction();

            $id_iden = Session::get('usuario')->id_identificador;

            if ($id_iden == 1 || $id_iden == 2 || $id_iden == 6) {

                $actusu = DB::table('usuario.usuario')
                        ->whereRaw('id = ?', Session::get('usuario')->id)
                        ->update(['id_estado_civil' => $actpers['estadocivil'],
                    'codigo_postal' => $actpers['cod'],
                    'telefono' => $actpers['telf'],
                    'celular' => $actpers['cel'],
                    'id_parroquia' => $actpers['parroquia'],
                    'direccion' => $actpers['direc']]);
            } else {

                $actusu = DB::table('usuario.usuario')
                        ->whereRaw('id = ?', Session::get('usuario')->id)
                        ->update(['codigo_postal' => $actpers['cod'],
                    'telefono' => $actpers['telf'],
                    'celular' => $actpers['cel'],
                    'id_parroquia' => $actpers['parroquia'],
                    'direccion' => $actpers['direc']]);
            }
            DB::commit();

            if ($actusu >= 1) {
                return 1;
            } else {
                return 2;
            }

            $ess = 'Intente de nuevo';
        } catch (\Exception $ess) {
            error_log($ess, 0);
            DB::rollBack();
            return false;
        }
    }

    public static function processFormNat($formul) {

        try {
            DB::beginTransaction();

            if ($formul['tipo'] == 1 || $formul['tipo'] == 2) {

                if ($formul['pnombre'] == null && $formul['papellido'] == null) {
                    return 5;
                } else {
                    if ($formul['snombre'] == null) {
                        $nombres = $formul['pnombre'];
                    } else {
                        $nombres = $formul['pnombre'] . ' ' . $formul['snombre'];
                    }
                    if ($formul['sapellido'] == null) {
                        $pellidos = $formul['papellido'];
                    } else {
                        $pellidos = $formul['papellido'] . ' ' . $formul['sapellido'];
                    }
                }
                if ($formul['genero'] == 0) {
                    return 6;
                } else {
                    $gen = $formul['genero'];
                }
                if ($formul['estadocivil'] == 0) {
                    return 7;
                } else {
                    $est = $formul['estadocivil'];
                }
                if ($formul['fecnac'] == null) {
                    return 8;
                } else {
                    $naci = $formul['fecnac'];
                }
                if ($formul['correo'] == null) {
                    return 9;
                } else {
                    $correo = $formul['correo'];
                }
                if ($formul['telf'] == null) {
                    return 10;
                } else {
                    $telf = $formul['telf'];
                }
                if ($formul['cel'] == null) {
                    return 11;
                } else {
                    $cel = $formul['cel'];
                }
                if ($formul['parroquia'] == 0) {
                    return 12;
                } else {
                    $parr = $formul['parroquia'];
                }
                if ($formul['direc'] == null) {
                    return 13;
                } else {
                    $dir = $formul['direc'];
                }
                if ($formul['usuarioper'] == null) {
                    return 14;
                }
                if ($formul['clave'] == null) {
                    return 15;
                } else {
                    $clave = $formul['clave'];
                }
                if ($formul['cod'] == null) {
                    return 16;
                } else {
                    $cod = $formul['cod'];
                }
                $iden = $formul['cedula'];


                $clav = password_hash($clave, PASSWORD_DEFAULT);

                $persona = DB::table('usuario.usuario')->insertGetId([
                    'identificador' => $iden,
                    'nombres' => $nombres,
                    'apellidos' => $pellidos,
                    'id_genero' => $gen,
                    'id_estado_civil' => $est,
                    'fecha_nac' => $naci,
                    'id_identificador' => $formul['fecnac1'],
                    'correo' => $correo,
                    'telefono' => $telf,
                    'celular' => $cel,
                    'codigo_postal' => $cod,
                    'id_parroquia' => $parr,
                    'direccion' => $dir,
                    'password' => $clav,
                    'activo' => true,
                ]);
            }

            DB::commit();
            if ($persona >= 1) {
                return true;
            } else {
                return 2;
            }

            $ess = 'Intente de nuevo';
        } catch (\Exception $ess) {
            error_log($ess, 0);
            DB::rollBack();

            return response()->json(['error' => 'Intente de nuevo']);
        }
    }

    public static function processFormJur($formul) {



        if ($formul['tipo'] == 3) {

            if ($formul['emp'] == null) {
                return 17;
            } else {
                $emp = $formul['emp'];
            }
            if ($formul['correoe'] == null) {
                return 9;
            } else {
                $correo = $formul['correoe'];
            }
            if ($formul['telfe'] == null) {
                return 10;
            } else {
                $telf = $formul['telfe'];
            }
            if ($formul['cele'] == null) {
                return 11;
            } else {
                $cel = $formul['cele'];
            }
            if ($formul['code'] == null) {
                return 16;
            } else {
                $cod = $formul['code'];
            }
            if ($formul['parroquiae'] == 0) {
                return 12;
            } else {
                $parr = $formul['parroquiae'];
            }
            if ($formul['direce'] == null) {
                return 13;
            } else {
                $dir = $formul['direce'];
            }
            if ($formul['pnombrer'] == null && $formul['papellidor'] == null) {
                return 5;
            } else {
                if ($formul['snombrer'] == null) {
                    $nombres = $formul['pnombrer'];
                } else {
                    $nombres = $formul['pnombrer'] . ' ' . $formul['snombrer'];
                }
                if ($formul['sapellidor'] == null) {
                    $pellidos = $formul['papellidor'];
                } else {
                    $pellidos = $formul['papellidor'] . ' ' . $formul['sapellidor'];
                }
            }
            if ($formul['generor'] == 0) {
                return 6;
            } else {
                $gen = $formul['generor'];
            }
            if ($formul['fecnacr'] == null) {
                return 8;
            } else {
                $naci = $formul['fecnacr'];
            }
            if ($formul['usuarioperr'] == null) {
                return 14;
            }
            if ($formul['clavee'] == null) {
                return 15;
            } else {
                $clave = $formul['clavee'];
            }
            $iden = $formul['rif'];
            $cdre = $formul['cedular'];
            $tipore = $formul['fecnac1r'];

            $clav = password_hash($clave, PASSWORD_DEFAULT);

            try {
                DB::beginTransaction();

                $persona = DB::table('usuario.usuario')->insertGetId([
                    'identificador' => $iden,
                    'nombres' => $nombres,
                    'apellidos' => $pellidos,
                    'id_genero' => $gen,
                    'fecha_nac' => $naci,
                    'id_identificador' => $formul['fecnac1r'],
                    'correo' => $correo,
                    'telefono' => $telf,
                    'celular' => $cel,
                    'codigo_postal' => $cod,
                    'id_parroquia' => $parr,
                    'direccion' => $dir,
                    'password' => $clav,
                    'nombre_empresa' => $emp,
                    'identificador_representante_legal' => $cdre,
                    'id_identificador_representante_legal' => $tipore,
                    'activo' => true,
                ]);

                DB::commit();

                if (is_numeric($persona)) {
                    return true;
                } else {
                    return 2;
                }
                $ess = 'Intente de nuevo';
            } catch (\Exception $ess) {
                error_log($ess, 0);
                DB::rollBack();

                return false;
            }
        }
    }

}
