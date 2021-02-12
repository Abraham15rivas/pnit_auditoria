<?php

namespace pnit\Console\Commands;

use Illuminate\Console\Command;
use pnit\Http\Controllers\MailController;
use Illuminate\Support\Facades\DB;
use pnit\Notificacion;
use pnit\Tools;
use pnit\Usuario;

class segundoHash extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hash:arreglo';

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
      $ofertantes = DB::table("ofertante")->whereRaw("email != 'gmquintero@mppeuct.gob.ve'")->get();
      $notificacion = DB::table("notificacion")->get();
      $text = "";
      $count = 0;
      foreach($ofertantes as $o){
        $dni = $o->n_dni;
        foreach($notificacion as $n){
          $correo = $n->email;
          $exp = explode("@",$n->code);
          $crypt = $exp[1];
          $hash = explode("/",$exp[0])[4];
          if(sha1($dni."/".$crypt."-".$correo) == $hash){
            $text.="'UPDATE usuario SET email = '".$correo."' WHERE id = ".$o->id."'\n";
            break;
          }
        }
        $count++;
      }
      $this->info($text);
    }
}
