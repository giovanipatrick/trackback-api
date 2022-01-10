<?php
    namespace App\Methods;

    class AjaxMessage{

        public static function return($type,$message){
            return json_encode(array(
                "type"=>$type,
                "message"=>$message
            ));
        }

    }