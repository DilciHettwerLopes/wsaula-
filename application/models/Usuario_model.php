<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model
 extends CI_Model {

    const table = "usuario"; // faz assim para facilitar manutenção, para alterar em um só lugar a tabela.

    public function get_all(){

       $query = $this->db->get(self:: table);
        return $query->result();
        
    }

    public function get_one($id){
        if ($id > 0){
            $this->db->where('id', $id);
            $query = $this->db->get(self::table);
            return $query->row(0);
        }
    }

    public function insert($dados = array()){
      $query = $this->db->insert(self::table, $dados);
      return $this->db->affected_rows();
      
    }

}

/* End of file Usuario_model
.php */
