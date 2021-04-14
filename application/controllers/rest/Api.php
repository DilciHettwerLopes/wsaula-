<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController
{

    public function turma_get()
    { // sempre fica nulo nos parenteses
        //o primeiro parametro do load é o nome do model que queremos chamar
        //o segundo paramentro"tm" é tm 'apelido' o qual pode ser usado depois
        $this->load->model('turma_model', 'tm');

        $id = $this->get('id');
        if ($id > 0) {
            $retorno = $this->tm->get_one($id);  // get de tm usuario
        } else {
            $retorno = $this->tm->get_all();
        }

        $this->response($retorno, (($retorno) ? 200 : 400));
    }

    public function turma_post()
    {
        if ((!$this->post('aluno')) || (!$this->post('nota'))) {
            $this->response([
                'status' => false,
                'error' => 'Campos obrigatórios não preenchidos'
            ], 400);
            return;
        }

        $dados = [
            'aluno' => $this->post('aluno'),
            'nota' => $this->post('nota')
        ];

        //carregamos o model
        $this->load->model('turma_model', 'tm');
        //mandamos inserir na base através do metodo insert do usuario__model
        if ($this->tm->insert($dados)) {
            $this->response([
                'status' => true,
                'mensage' => 'Nota inserida com sucesso'
            ], 200); // 200 ok

        } else {
            $this->response([
                'status' => false,
                'error'  => 'Falha ao inserir a nota'
            ], 400); //400 bad request

        }
    }
    
    public function turma_delete() {

        $id = $this->get('id'); // pode ser atraves de post tambem
        
        $this->load->model('turma_model', 'tm');
        if ($this->tm->delete($id)) {
            $this->response([
                'status' => true,
                'mensage' => 'Nota inserida com sucesso'
            ], 200); // 200 ok
        } else {
            $this->response([
                'status' => false,
                'error'  => 'Falha ao inserir a nota'
            ], 400); //400 bad request
        }
    }

    public function turma_put()
    {
        $id = $this->get('id'); // pode ser atraves de post tambem
        if ((!$this->put('aluno')) || (!$this->put('nota')) || $id <= 0) {
            $this->response([
                'status' => false,
                'error' => 'Campos obrigatórios não preenchidos'
            ], 400);
            return;
        }

        $dados = [
            'aluno' => $this->put('aluno'),
            'nota' => $this->put('nota')
        ];

        //carregamos o model
        $this->load->model('turma_model', 'tm');
        if ($this->tm->update($id, $dados)) {
            $this->response([
                'status' => true,
                'mensage' => 'Nota inserida com sucesso'
            ], 200); // 200 ok

        } else {
            $this->response([
                'status' => false,
                'error'  => 'Falha ao inserir a nota'
            ], 400); //400 bad request

        }
    }
}
