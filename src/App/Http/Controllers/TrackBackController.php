<?php

    namespace App\Http\Controllers;

    use App\Methods\AjaxMessage;
    use App\DTO\TrackBackDTO;
    use App\Http\Middlewares\TrackBackMiddleware;

    class TrackBackController extends TrackBackDTO{

            private $objeto;

            /* 
            Aguarda a ACTION que é enviada via POST ou GET e encaminha-a para a o metódo específico
            */
            public function index(){
                switch($this->getRequest()[2]){
                    case 'getInformations':
                        $session['VFX'] = 'teste';
                        if(TrackBackMiddleware::isAuthorized(base64_encode('webcontrol/mocabonita'),$session)){
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
                        }else{
                            echo AjaxMessage::return('error','Não foi possível realizar a autenticação na API!');
                        }
                    break;
                }
            }

            public function error(){
                echo AjaxMessage::return('error','Os parametros informados são inválidos, verifique a documentação!');
            }
            
            /* 
            Set dos atributos obrigatórios do Controller 
            São utilizados para identificar se a Requisição é $_POST ou $_GET
            */
            public function __construct(){
                $this->request = explode('/',$this->getURI());
                $this->post_request[2] = filter_input(INPUT_POST,'action',FILTER_SANITIZE_STRING);
                $this->post_request[3] = filter_input(INPUT_POST,'valor',FILTER_SANITIZE_STRING);
                $this->request = !empty($this->request[3]) ? $this->request : $this->post_request;
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
                foreach($this->objeto['objetos'] as $objetos){
                    foreach($objetos['eventos'] as $key => $value){
                        $this->setDescricao($objetos['eventos'][$key]['descricao']);
                        $this->setDataCriado($objetos['eventos'][$key]['dtHrCriado']);
                        $this->setCidade($objetos['eventos'][$key]['unidade']['endereco']['cidade']);
                        $this->setUF($objetos['eventos'][$key]['unidade']['endereco']['uf']);
                        $this->setTipo($objetos['eventos'][$key]['unidade']['tipo']);
                        $this->objeto['rastreio'][$key] = array(
                            "descricao"=>$this->getDescricao(),
                            "data_criado"=>$this->getDataCriado(),
                            "cidade"=>$this->getCidade(),
                            "uf"=>$this->getUF(),
                            "tipo"=>$this->getTipo()
                        );
                    }
                }
                return $this->objeto['rastreio'];
            }

    }

