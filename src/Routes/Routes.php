<?php

namespace App\Routes;

use Pecee\SimpleRouter\SimpleRouter;

class Listening extends SimpleRouter{

        public static function Initiliaze(){

            SimpleRouter::get('/rastreamento/',function(){
               echo $_ENV['BASE_URL'].$_ENV['OBLIGATORY_PARAMS'];
            });

            SimpleRouter::error(function(){
                echo 'ERRO 404';
            });

            SimpleRouter::start();

        }

}