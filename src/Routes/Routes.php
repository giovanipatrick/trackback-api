<?php

namespace App\Routes;

use Pecee\SimpleRouter\SimpleRouter;
use App\Methods\AjaxMessage;


class Listening extends SimpleRouter{

        public static function Initiliaze(){
            
            SimpleRouter::get('/rastreamento/',function(){
               echo AjaxMessage::return('error','Os parametros informados são inválidos, verifique a documentação!');
            });

            SimpleRouter::form('/rastreamento/getInformations/{id_objeto}',function($codigo_objeto){
                require 'src/App/Http/Controllers/TrackBackController.php';
            });

            SimpleRouter::error(function(){
                echo AjaxMessage::return('error','Os parametros informados são inválidos, verifique a documentação!');
            });

            SimpleRouter::start();

        }

}