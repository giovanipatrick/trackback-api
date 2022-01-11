<?php

    namespace App\DTO;

    class TrackBackDTO{

        private $base_url;
        private $params;
        private $codigo;
        private $uri;
        private $request;
        private $values;
        private $gContext;
        private $gRequest;
        private $gResponse;

        public function setBaseURL(){
            $this->base_url = 'https://proxyapp.correios.com.br/';
        }

        public function getBaseURL(){
            $this->setBaseURL();
            return $this->base_url;
        }

        public function setParams(){
            $this->params = 'v1/sro-rastro/';
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

        public function setContext(){
            $this->gContext = array(
                "ssl"=>array(
                    "verify_peer"=>false,
                    "verify_peer_name"=>false,
                ),
            );  
        }

        public function getContext(){
            $this->setContext();
            return $this->gContext;
        }

        public function setGRequest($url){
            $this->gRequest = file_get_contents("$url",false,stream_context_create($this->getContext()));
        }

        public function getGRequest(){
            return $this->gRequest;
        }



    }



?>