<?php

namespace App\Routes;

use Pecee\SimpleRouter\SimpleRouter;
use App\Http\Controllers\TrackBackController;
use App\Methods\AjaxMessage;


class Listening extends SimpleRouter{

        public static function Initiliaze(){

            
            SimpleRouter::get('/rastreamento/',[TrackBackController::class,'error']);

            SimpleRouter::post('/rastreamento/getInformations/',[TrackBackController::class,'index']);

            SimpleRouter::get('/rastreamento/getInformations/{id_objeto}',[TrackBackController::class,'index']);

            SimpleRouter::error(function(){
                echo AjaxMessage::return('error','Os parametros informados são inválidos, verifique a documentação!');
            });

            SimpleRouter::start();

        }

}