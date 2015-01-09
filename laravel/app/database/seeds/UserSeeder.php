<?php

/**
 * Archivo para crear el primer usuario
 *
 * @author carlos
 */
class UserSeeder extends DatabaseSeeder {

      public function run()
      {
            $users = array(
                /*array(
                    "username" => "Carlos juarez",
                    "password" => Hash::make("klendactu"),
                    "email"    => "carlos.juarez@t7marketing.com",
                    "is_admin" => true),*/
                array(
                    "username" => "Proyectos T7",
                    "password" => Hash::make("T7marketing_1"),
                    "email"    => "isabel.guizar@t7marketing.com",
                    "is_admin" => 2),
            );
            foreach ($users as $user) {
                  User::create($user);
            }
      }

}
