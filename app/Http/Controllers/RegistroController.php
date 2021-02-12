<?php

namespace pnit\Http\Controllers;

use pnit\Http\Controllers\Controller;
use pnit\Principal;
use pnit\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistroController extends Controller {

    public function principal() {

        return view("login");
    }

    public function formReg() {

        $tipo_identificacion = Principal::tipoIdentificacion();
        $estadocivil = Principal::estadocivil();
        $estados = Principal::estados();
        $genero = Principal::genero();

        return view("registro")->with(compact('tipo_identificacion', 'estadocivil', 'estados', 'genero'));
    }

    public function bcacedula(Request $request) {

        $candidato = Principal::cedulaExiste($request->nac, $request->cedula, $request->nacio);

        return response()->json($candidato);
    }

    public function municipio(Request $request) {

        if ($request->ajax()) {
            $this->params['data']['municipio'] = Principal::municipio($request->id);

            return response()->json($this->params['data']['municipio']);
        }
    }

    public function parroquia(Request $request) {

        if ($request->ajax()) {
            $this->params['data']['parroquia'] = Principal::parroquia($request->id);

            return response()->json($this->params['data']['parroquia']);
        }
    }

    public function procesamiento(Request $request) {

        if ($request['tipo'] == 1 || $request['tipo'] == 2) {
            if ($request['correo'] != null) {
                $usuar = DB::table('usuario.usuario')->where('correo', $request['correo'])->first();
            } else {
                return 9;
            }
        } else {
            if ($request['correoe'] != null) {
                $usuar = DB::table('usuario.usuario')->where('correo', $request['correoe'])->first();
            } else {
                return 9;
            }
        }
        if ($usuar != null) {
            return 3;
        } else {
            #identificador ya fue utilizado
            if ($request['tipo'] == 1 || $request['tipo'] == 2) {
                $pers = DB::table('usuario.usuario')->where('identificador', $request['cedula'])->first();
            } else {
                $pers = DB::table('usuario.usuario')
                        ->where('identificador', '=', $request['rif'])
                        ->where('identificador_representante_legal', '=', $request['cedular'])
                        ->first();
            }
            if ($pers != null) {
                return 4;
            } else {

                if ($request['tipo'] == 1 || $request['tipo'] == 2) {
                    $guardarDatos = Usuario::processFormNat($request->all());
                } else {
                    $guardarDatos = Usuario::processFormJur($request->all());
                }

                if (is_numeric($guardarDatos)) {
                    return $guardarDatos;
                } else {
                    return 1;
                }
            }
        }
    }

}
