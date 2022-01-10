<?php

    use App\DTO\TrackBackDTO;

    class TrackBackController extends TrackBackDTO{


            public function getInformations($codigo_objeto){
               echo $codigo_objeto;
            }

            public function awaitAnAction(){
                /* 
                Verifica se a Request é POST ou GET e coleta os valores repassados 
                */
                $this->request = explode('/',$this->getURI());
                $this->post_request[2] = filter_input(INPUT_POST,'action',FILTER_SANITIZE_STRING);
                $this->post_request[3] = filter_input(INPUT_POST,'valor',FILTER_SANITIZE_STRING);
                $this->request = !empty($this->request[2]) ? $this->request : $this->post_request;
                $this->setRequest($this->request);
                $this->setValueRequest($this->request[3]);
                    /* 
                    Destina a Action a função específica
                    */
                    switch($this->getRequest()[2]){
                        case 'getInformations':
                            $this->getInformations($this->getValueRequest());
                        break;
                    }
            }

    }

    $TrackBackController = new TrackBackController;
    $TrackBackController->awaitAnAction();