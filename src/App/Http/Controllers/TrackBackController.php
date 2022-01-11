<?php

    use App\Methods\AjaxMessage;
    use App\DTO\TrackBackDTO;

    class TrackBackController extends TrackBackDTO{

            private $objeto;
            
            /* 
            Set dos atributos obrigatórios do Controller 
            São utilizados para identificar se a Requisição é $_POST ou $_GET
            */
            public function __construct(){
                $this->request = explode('/',$this->getURI());
                $this->post_request[2] = filter_input(INPUT_POST,'action',FILTER_SANITIZE_STRING);
                $this->post_request[3] = filter_input(INPUT_POST,'valor',FILTER_SANITIZE_STRING);
                $this->request = !empty($this->request[2]) ? $this->request : $this->post_request;
                $this->setRequest($this->request);
                $this->setValueRequest($this->request[3]);
            }

            /* 
            Realiza a requisição para a API dos Correios
            */
            public function getInformations($codigo_objeto){
               $this->setCodigo($codigo_objeto);
               $this->setGRequest($this->getBaseURL().$this->getParams().$this->getCodigo());
               return $this->getGRequest();
            }

            /* 
            Trata os erros retornados pela API dos Correios
            */
            public function verifyThisData($data){
                $this->objeto = $data;
                $this->objeto = json_decode($data,true);
                if(!empty($this->objeto['objetos'][0]['mensagem'])){
                    return $this->objeto['objetos'][0]['mensagem'];
                }else{
                    return false;
                }
            }

            /* 
            Formata  recebidos através da conexão com a API dos Correios 
            */
            public function formatJsonData($data){
                $this->objeto = $data;
                $this->objeto = json_decode($data,true);
                $this->setDescricao($this->objeto['objetos'][0]['eventos'][0]['descricao']);
                $this->setDataCriado($this->objeto['objetos'][0]['eventos'][0]['dtHrCriado']);
                $this->setCidade($this->objeto['objetos'][0]['eventos'][0]['unidade']['endereco']['cidade']);
                $this->setUF($this->objeto['objetos'][0]['eventos'][0]['unidade']['endereco']['uf']);
                $this->setTipo($this->objeto['objetos'][0]['eventos'][0]['unidade']['tipo']);
                $this->objeto = array(
                    "descricao"=>$this->getDescricao(),
                    "data_criado"=>$this->getDataCriado(),
                    "cidade"=>$this->getCidade(),
                    "uf"=>$this->getUF(),
                    "tipo"=>$this->getTipo()
                );
                return $this->objeto;
            }

            public function awaitAnAction(){
                    switch($this->getRequest()[2]){
                        case 'getInformations':
                            $data = &$this->getInformations($this->getValueRequest());
                                if($data){
                                    if(!$this->verifyThisData($data)){
                                        echo AjaxMessage::return('success',$this->formatJsonData($data));
                                    }else{
                                        echo AjaxMessage::return('error',$this->verifyThisData($data));
                                    }
                                }else{
                                    echo AjaxMessage::return('error','A consulta na API dos Correios não retornou dados!');
                                }
                        break;
                    }
            }

    }

    $TrackBackController = new TrackBackController;
    $TrackBackController->awaitAnAction();