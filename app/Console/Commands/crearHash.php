<?php

namespace pnit\Console\Commands;

use Illuminate\Console\Command;
use pnit\Http\Controllers\MailController;
use Illuminate\Support\Facades\DB;
use pnit\Notificacion;
use pnit\Tools;
use pnit\Usuario;

class crearHash extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'correo:hash';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Agregar hash de los usuarios';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $usuarios = DB::table("ofertantes_sin_ofertas")->get();
     $conteo = 0;
      foreach($usuarios as $u){
        $dni = $u->n_dni;
        $email = $u->email;
        $v = 0;
        while($v == 0){
          $random = Tools::generateRandomString();
          $hash = sha1($dni."/".$random."-".$email);
          $d = Usuario::where("code", $hash)->count();
          if($d == 0){
            $v++;
          }
        }
        $ruta = route('aplicacion', [
            'codigo' => $hash,
            'salt' => $random
    ]);
	Usuario::where('id', $u->id_usuario)->update([
		"code" => $hash
	]);
	
        Notificacion::create([
          "email" => $email,
          "code" => $ruta,
          "tipo_email" => 1,
          "estatus" => false
        ]);
	$this->line($conteo." registros insertados");
	$conteo++;
      }
    }
}
