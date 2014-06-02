<?php

use Illuminate\Support\ServiceProvider;

/**
 * Description of RepositoriesServiceProvider
 *
 * @author carlos
 */
class RepositoriesServiceProvider extends ServiceProvider {

      public function register()
      {
            $this->app->bind(
                  'CorreosRepository', 'CorreosRepositoryEloquent'
            );
            $this->app->bind(
                  'UsuariosRepository', 'UsuariosRepositoryEloquent'
            );
            $this->app->bind(
                  'DominioRepository', 'DominioRepositoryEloquent'
            );
            $this->app->bind(
                  'FtpsRepository', 'FtpsRepositoryEloquent'
            );
            $this->app->bind(
                  'DatabaseRepository', 'DatabaseRepositoryEloquent'
            );
            $this->app->bind(
                  'PlanRepository', 'PlanRepositoryEloquent'
            );            
            $this->app->bind(
                  'CalendarioRepository', 'CalendarioRepositoryEloquent'
            );
      }

}
