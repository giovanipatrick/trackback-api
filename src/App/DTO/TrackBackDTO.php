<?php

    namespace App\DTO;

    class TrackBackDTO{

        private $base_url;
        private $params;
        private $codigo;
        private $uri;
        private $request;
        private $values;

        public function setBaseURL(){
            $this->base_url = $_ENV['BASE_URL'];
        }

        public function getBaseURL(){
            $this->setBaseURL();
            return $this->base_url;
        }

        public function setParams(){
            $this->params = $_ENV['OBLIGATORY_PARAMS'];
        }

        public function getParams(){
            $this->setParams();
            return $this->params;
        }

        public function setCodigo($codigo){
            $this->codigo = $codigo;
        }

        public function getCodigo(){
            return $this->codigo;
        }

        public function setURI(){
            $this->uri = $_SERVER['REQUEST_URI'];
        }

        public function getURI(){
            $this->setURI();
            return $this->uri;
        }

        public function setRequest($request){
            $this->request = $request;
        }

        public function getRequest(){
            return $this->request;
        }

        public function setValueRequest($value){
            $this->values = $value;
        }

        public function getValueRequest(){
            return $this->values;
        }



    }



?>