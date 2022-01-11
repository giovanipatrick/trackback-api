<?php

    namespace App\Http\Middlewares;
    class TrackBackMiddleware{

        /* 
        Valida se  o requisitante tem acesso a API ou não
        É uma maneira simples, porém, funcional...
        o POST ou GET só vai partir de usuários que realmente estão logados no sistema e isso já evita a maior parte de ataques.
        */
        public static function isAuthorized($token,$session){
            $token = explode('/',base64_decode($token));
            $empresa = $token[0];
            $hostname = $token[1];
            if($empresa === 'webcontrol' && !empty($hostname) && !empty($session['VFX'])){
                return true;
            }else{
                return false;
            }
        }

    }

?>