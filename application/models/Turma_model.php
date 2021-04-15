<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Turma_model
extends CI_Model
{

    const table = "turma";

    public function get_all()
    {

        $query = $this->db->get(self::table);
        return $query->result();
    }

    public function get_one($id)
    {
        if ($id > 0) {
            $this->db->where('id', $id);
            $query = $this->db->get(self::table);
            return $query->row(0);
        }
    }

    public function insert($dados = array())
    {
        $this->db->insert(self::table, $dados);
        return $this->db->affected_rows();
    }
    public function update($id = 0, $dados = array())
    {
        if ($id > 0) {
            $this->db->where('id', $id);
            $this->db->update(self::table, $dados);
            return $this->db->affected_rows();
        }
    }

    public function delete($id = 0) {
        if ($id > 0) {
            $this->db->where('id', $id);
            $this->db->delete(self::table);
           return $this->db->affected_rows();
        }
    }
}