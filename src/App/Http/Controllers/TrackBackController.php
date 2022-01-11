<?php

    use App\DTO\TrackBackDTO;

    class TrackBackController extends TrackBackDTO{

            public function __construct(){
                $this->request = explode('/',$this->getURI());
                $this->post_request[2] = filter_input(INPUT_POST,'action',FILTER_SANITIZE_STRING);
                $this->post_request[3] = filter_input(INPUT_POST,'valor',FILTER_SANITIZE_STRING);
                $this->request = !empty($this->request[2]) ? $this->request : $this->post_request;
                $this->setRequest($this->request);
                $this->setValueRequest($this->request[3]);
            }

            public function getInformations($codigo_objeto){
               $this->setCodigo($codigo_objeto);
               $this->setGRequest($this->getBaseURL().$this->getParams().$this->getCodigo());
               echo $this->getGRequest();
            }

            public function awaitAnAction(){
                    switch($this->getRequest()[2]){
                        case 'getInformations':
                            $this->getInformations($this->getValueRequest());
                        break;
                    }
            }

    }

    $TrackBackController = new TrackBackController;
    $TrackBackController->awaitAnAction();