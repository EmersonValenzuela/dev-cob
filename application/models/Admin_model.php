
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
  // check if the user exists

  public function auth_user_login($where)
  {
    $this->db->select('*');
    $this->db->from('tbl_users');
    $this->db->where($where);
    $this->db->limit(1);
    $query = $this->db->get();
    if ($query->num_rows() == 1) {
      return $query->row();
    } else {
      return false;
    }
  }

  public function get_ranges($where)
  {
    $this->db->select('*');
    $this->db->from('tbl_ranges');
    $this->db->where($where);
    return $this->db->get()->result_array();
  }

  public function insert($data, $table)
  {
    $this->db->insert($table, $data);
    return $this->db->insert_id();
  }

  public function update($action, $id, $table)
  {
    $this->db->where('id_user', $id);
    $this->db->update($table, $action);
    return $this->db->insert_id();
  }

  public function validate($where)
  {
    $this->db->select('*');
    $this->db->from('tbl_users');
    $this->db->where($where);
    $this->db->limit(1);
    $query = $this->db->get();
    if ($query->num_rows() == 1) {
      return $query->num_rows();
    } else {
      return false;
    }
  }

  public function get_users($where)
  {
    if ($where) {
      $this->db->select('user.*');
      $this->db->select('rol.*');
      $this->db->select('ran.*');
      $this->db->select('sts.*');
      $this->db->from('tbl_users user');
      $this->db->join('tbl_rol rol', 'rol.id_rol = user.rol', 'LEFT');
      $this->db->join('tbl_status sts', 'sts.id_status = user.val_user', 'LEFT');
      $this->db->join('tbl_ranges ran', 'ran.id_range = user.range_user', 'LEFT');
      $this->db->order_by('user.lastname_user', 'ASC');
      $this->db->where($where);
      return $this->db->get()->result();
    }
    $this->db->select('user.*');
    $this->db->select('rol.*');
    $this->db->select('ran.*');
    $this->db->select('sts.*');
    $this->db->from('tbl_users user');
    $this->db->join('tbl_rol rol', 'rol.id_rol = user.rol', 'LEFT');
    $this->db->join('tbl_status sts', 'sts.id_status = user.val_user', 'LEFT');
    $this->db->join('tbl_ranges ran', 'ran.id_range = user.range_user', 'LEFT');
    return $this->db->get()->result();
  }
  function get_range($where)
  {
    $this->db->select('*');
    $this->db->from('tbl_ranges');
    $this->db->where($where);
    $this->db->limit(1);
    $query = $this->db->get();
    if ($query->num_rows() == 1) {
      return $query->row();
    } else {
      return false;
    }
  }
}
