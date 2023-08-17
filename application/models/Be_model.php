<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Be_model extends CI_Model
{
  //Count table rows

  public function record($table)
  {
    $this->db->select('*');
    $this->db->from($table);
    $query = $this->db->get();
    return $query->num_rows();
  }
  public function insert($data, $table)
  {
    $this->db->insert($table, $data);
    return $this->db->insert_id();
  }

  public function get_record($where, $table)
  {

    if ($where != null) {
      $this->db->select('*');
      $this->db->from($table);
      $this->db->where($where);
      $query = $this->db->get();
      return $query->row();
    }
    $this->db->select('*');
    $this->db->from($table);
    return $this->db->get()->result();
  }

  public function get_data($where = null)
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
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row();
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

  public function update($action, $id, $table)
  {
    $this->db->where($id);
    $this->db->update($table, $action);
    return $this->db->insert_id();
  }

  public function list_dace($where = null)
  {
    $this->db->select('*');
    $this->db->from('tbl_form_dace');
    return $this->db->get()->result();
  }
  public function get_univ_list($where = null)
  {
    if ($where) {
      $this->db->select('table.*');
      $this->db->select('user.*');
      $this->db->select('rg.*');
      $this->db->select('uni.*');
      $this->db->from('tbl_data_univ table');
      $this->db->join('tbl_users user', 'user.id_user = table.user', 'LEFT');
      $this->db->join('tbl_universities uni', 'uni.id_university = table.university', 'LEFT');
      $this->db->join('tbl_ranges rg', 'rg.id_range = table.grado', 'LEFT');
      $this->db->where($where);
      $query = $this->db->get();
      return $query->row();
    }
    $this->db->select('table.*');
    $this->db->select('user.*');
    $this->db->select('uni.*');
    $this->db->from('tbl_data_univ table');
    $this->db->join('tbl_users user', 'user.id_user = table.user', 'LEFT');
    $this->db->join('tbl_universities uni', 'uni.id_university = table.university', 'LEFT');
    return $this->db->get()->result();
  }

  public function get_inst_list($where = null)
  {
    if ($where) {
      $this->db->select('table.*');
      $this->db->select('user.*');
      $this->db->select('ins.*');
      $this->db->select('rg.*');
      $this->db->from('tbl_data_institute table');
      $this->db->join('tbl_users user', 'user.id_user = table.user', 'LEFT');
      $this->db->join('tbl_institute ins', 'ins.id_institute = table.institute', 'LEFT');
      $this->db->join('tbl_ranges rg', 'rg.id_range = table.ins_grade', 'LEFT');
      $this->db->where($where);
      $query = $this->db->get();
      return $query->row();
    }
    $this->db->select('table.*');
    $this->db->select('user.*');
    $this->db->select('ins.*');
    $this->db->from('tbl_data_institute table');
    $this->db->join('tbl_users user', 'user.id_user = table.user', 'LEFT');
    $this->db->join('tbl_institute ins', 'ins.id_institute = table.institute', 'LEFT');
    return $this->db->get()->result();
  }

  public function get_brit_list($where = null)
  {
    if ($where) {
      $this->db->select('table.*');
      $this->db->select('user.*');
      $this->db->select('rg.*');
      $this->db->from('tbl_data_britanico table');
      $this->db->join('tbl_users user', 'user.id_user = table.user', 'LEFT');
      $this->db->join('tbl_ranges rg', 'rg.id_range = table.bri_grade', 'LEFT');
      $this->db->where($where);
      $query = $this->db->get();
      return $query->row();
    }
    $this->db->select('table.*');
    $this->db->select('user.*');
    $this->db->from('tbl_data_britanico table');
    $this->db->join('tbl_users user', 'user.id_user = table.user', 'LEFT');
    return $this->db->get()->result();
  }

  public function getRes($where)
  {
    $this->db->select('*');
    $this->db->from('tbl_resolution');
    $this->db->where($where);
    $query = $this->db->get();
    return $query->row();
  }

  public function getResNum($where)
  {
    $this->db->select('*');
    $this->db->from('tbl_resolution');
    $this->db->where($where);
    $query = $this->db->get();
    return $query->num_rows();
  }
}