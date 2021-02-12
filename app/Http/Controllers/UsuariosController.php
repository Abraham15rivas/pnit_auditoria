<?php

namespace pnit\Http\Controllers;

use Illuminate\Http\Request;
use pnit\Usuario;
use pnit\Principal;

class LoginException extends \Exception {
    
}

class UsuariosController extends Controller {

    public function checkAction(Request $request) {
        if ($request->ajax()) {
            $usu_per = Usuario::buscarUsuario($request->all());
            if ($usu_per) {
                return $usu_per;
            }
        }
    }

    public static function eperfil() {

        $usuarioid = Usuario::buscarUsuarioId();
        $estadocivil = Principal::estadocivil();
        $estados = Principal::estados();
        $municipio = Principal::municipio($usuarioid[0]->estado_id);
        $parroquia = Principal::parroquia($usuarioid[0]->municipio_id);

        return view("personas.edit_perfil")->with(compact('usuarioid', 'estadocivil', 'estados', 'municipio', 'parroquia'));
    }

    public function cambio() {

        return view("cambio");
    }

    public function bcamcla(Request $request) {

        $bcamcla = Usuario::bcamcla($request->all());

        if ($bcamcla != false) {

            return response()->json($bcamcla);
        } else {

            return response()->json(false);
        }

        return view("cambio");
    }

    public function cambiodos(Request $request) {

        $nombre = Usuario::buscaUsuarioId($request->id_usu);

        $compara = Usuario::comparaUsuario($nombre);

        shuffle($compara);

        return view("continue")->with(compact('compara', 'nombre'));
    }

    public function selecccionado(Request $request) {

        if ($request->id_usu == $request->comparacion) {

            return response()->json(1);
        } else {

            return response()->json(false);
        }
    }

    public function resetear(Request $request) {

        if ($request['clavee'] == null) {
            return 3;
        } else {
            $guardarDatos = Usuario::cambioClave($request['clavee'], $request['id_usu']);
            if ($guardarDatos >= 1) {
                return 1;
            } else {
                return 2;
            }
        }
    }

    public function actualizarData(Request $request) {

        $guardarDatos = Usuario::actualizar($request->all());

        if ($guardarDatos >= 1) {
            return 1;
        } else {
            return 2;
        }
    }

    public function cambclv() {

        return view("personas.cambioclv");
    }

}
