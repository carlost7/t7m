<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class dominiosRenovacionCommand extends Command {

      /**
       * The console command name.
       *
       * @var string
       */
      protected $name = 'dominios:renovacion';

      /**
       * The console command description.
       *
       * @var string
       */
      protected $description = 'Obtiene los dominios proximos a vencer y envia correo';
      protected $Calendario;

      /*
       * Create a new command instance.
       *
       * @return void
       */

      public function __construct(CalendarioRepository $calendario)
      {
            parent::__construct();
            $this->Calendario = $calendario;
      }

      /**
       * Execute the console command.
       *
       * @return mixed
       */
      public function fire()
      {
            $calendarios = $this->Calendario->obtenerDominiosPorVencer();
            foreach ($calendarios as $calendario)
            {
                  $data = array(
                        'dominio' => $calendario->dominio,
                        'fin' => $calendario->fin,
                        'registrador' => $calendario->registrador,
                  );
                  Mail::queue('email.vencimiento_dominio', $data, function($message) {
                        $message->to('webmaster@t7marketing.com', 'T7M')->subject('DOMINIO PRÓXIMO A VENCER');
                  });
            }
      }

      /**
       * Get the console command arguments.
       *
       * @return array
       */
      /* protected function getArguments()
        {
        return array(
        array('example', InputArgument::REQUIRED, 'An example argument.'),
        );
        }

        /**
       * Get the console command options.
       *
       * @return array
       */
      /* protected function getOptions()
        {
        return array(
        array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
        );
        } */
}
