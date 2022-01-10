<?php

namespace App\Methods;
use \Dotenv\Dotenv as DotEnvConverter;

    class InitiateEnv{
        /* 
        Transforma os itens do arquivo .env em variáveis Globais
        Em caso de Erro instanciar a Exception e utilizar Try Catch 
        */
        public static function constants(){
                $dir = realpath("./");
                $dotenv = DotEnvConverter::createImmutable($dir);
                $dotenv->load();
        }

    }