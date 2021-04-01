<?php
    
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController {

    // o nome do metodo sempre vem acompanhado do tipo de requisição
    // ou seja, contato_get significa que é uma requisição do tipo "GET"
   // e o usuario vai requisitar apenas  /rest/api/contato
    public function contato_get(){
        $retorno =[
            'status' =>true,
            'nome'  => 'Dilci',
            'email' => 'dilcylopes@gmail.com',
            'error' => ''
        ];

        // para enviar uma resposta, a gente chama o response 
        // passando dois parametros: o corpo da resposta e o codigo de status
        $this->response( $retorno, 200 );
    }

    public function contato_post(){
        $retorno =  [
        'status' =>true,
            'nome'  => 'Dilci POST',
            'email' => 'teste@gmail.com',
            'error' => ''
        ];
        $this->response( $retorno, 201);
    }


    public function usuario_get(){ // sempre fica nulo nos parenteses
        //o primeiro parametro do load é o nome do model que queremos chamar
        //o segundo paramentro"um" é um 'apelido' o qual pode ser usado depois
        $this->load->model('usuario_model','um');

        $id = $this->get('id');
        if ($id > 0){
        $retorno = $this->um->get_one($id);  // get de um usuario
        } else {
            $retorno = $this->um->get_all();
        }

         $this->response($retorno, (($retorno)? 200 : 400));
    }

    public function usuario_post(){
        if((!$this->post('email')) || (!$this->post('senha'))){
            $this->response([
                'status' => false,
                'error' =>'Campos obrigatórios não preenchidos'
            ], 400);
            return;
        }


        $dados = [
            'email' => $this -> post('email'),
            'senha' => $this -> post('senha')
        ];

        //carregamos o model
        $this->load->model('usuario_model', 'um');
        //mandamos inserir na base através do metodo insert do usuario__model
        if($this->um->insert($dados)){
            $this->response([
                'status' => true,
                'mensage' => 'Usuario inserido com sucesso'
            ], 200); // 200 ok

        } else{
            $this->response([
                'status' => false,
                'error'  => 'Falha ao inserir usuario'
            ], 400); //400 bad request

        }
        
      }
}