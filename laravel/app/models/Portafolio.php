<?php

use LaravelBook\Ardent\Ardent;

class Portafolio extends Ardent {

      // Add your validation rules here
      public static $rules = [
          'proyecto'    => 'required',
          'imagen'      => '',
          'thumb'       => '',
          'url'         => 'url',
          'descripción' => '',
          'categoria'   => 'required',          
      ];
      // Don't forget to fill this array
      protected $fillable  = ['proyecto', 'imagen', 'thumb', 'url', 'descripcion', 'categoria'];
      protected $table = 'portafolios';
      public $autoHydrateEntityFromInput    = true;
      public $forceEntityHydrationFromInput = true;
      public $autoPurgeRedundantAttributes  = true;
      
      public function setCategoriaAttribute(Array $categorias){
            
            if(!is_array($categorias)){
                  $this->attributes['categoria'] = "";
            }
            
            $this->attributes['categoria'] = json_encode($categorias);
      }
      
      public function getCategoriaAttribute(){
            
            return json_decode($this->attributes['categoria']);
      }
      

}
