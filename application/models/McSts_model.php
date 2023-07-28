<?php
defined('BASEPATH') or exit('No direct script access allowed');

class McSts_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function get_data($table, $where)
    {
        if ($where) {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->like($where);
            $this->db->limit(10);
            $query = $this->db->get();
            return $query->result();
        }
        $this->db->select('*');
        $this->db->from($table);
        return $this->db->get()->result();
    }
    public function insert($data, $table)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    public function result_data($table, $where)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }
    public function update($action, $id, $table)
    {
      $this->db->where($id);
      $this->db->update($table, $action);
      return $this->db->insert_id();
    }

    public function delete($table, $where)
    {
      $this->db->select('*');
      $this->db->from($table);
      $this->db->where($where);
      $this->db->limit(1);
      $query = $this->db->get();
      if ($query->num_rows() == 1) {
  
        $this->db->where($where);
        $this->db->delete($table);
        return true;
      } else {
        return false;
      }
    }
    public function row_data($table, $where)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }

}
