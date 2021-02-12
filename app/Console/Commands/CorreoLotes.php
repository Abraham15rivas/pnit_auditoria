<?php

namespace pnit\Console\Commands;

use Illuminate\Console\Command;
use pnit\Http\Controllers\MailController;
use pnit\Notificacion;

class CorreoLotes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'correo:lotes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comenzar correo por lotes';

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
	    $registros = $this->getData();
        if(count($registros) > 0){
          MailController::distribuirAction($registros);
          $this->line("Se realizaron ".$this->rand." intentos de envio de correo");
        } else if(count($registros) <= $this->rand && count($registros) > 1){
          MailController::distribuirAction($registros);
          $this->line("Se realizaron ".count($registros)." intentos de envio de correo");
        } else {
          $this->line("No hay correos por enviar");
          die();
        }

    }

    private function getData(){
      $this->rand = rand(100,160);
      return Notificacion::where("estatus", "false")
          ->where("intentos","<","2")
          ->limit($this->rand)
          ->get()
          ->toArray();
    }
}
