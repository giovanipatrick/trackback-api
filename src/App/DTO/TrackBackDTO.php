<?php

    namespace App\DTO;

    class TrackBack{

        private $base_url;
        private $params;
        private $codigo;

        public function setBaseURL(){
            $this->base_url = $_ENV['BASE_URL'];
        }

        public function getBaseURL(){
            return $this->base_url;
        }

        public function setParams(){
            $this->params = $_ENV['OBLIGATORY_PARAMS'];
        }

        public function getParams(){
            return $this->params;
        }

        public function setCodigo($codigo){
            $this->codigo = $codigo;
        }

        public function getCodigo(){
            return $this->codigo;
        }

    }



?>