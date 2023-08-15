<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function update($action, $table, $where)
    {
        $this->db->update($table, $action, $where);
        return $this->db->insert_id();
    }
    public function update_staff($data, $id)
    {
        $this->db->where('id_staff', $id);
        $this->db->update('tbl_staff', $data);
    }
    public function auth_staff($where)
    {
        $this->db->select('*');
        $this->db->from('tbl_staff');
        $this->db->where($where);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_staff()
    {
        $this->db->select('p.*');
        $this->db->select('g.*');
        $this->db->select('r.*');
        $this->db->select('s.*');
        $this->db->from('tbl_staff p');
        $this->db->join('tbl_staff_grade g', 'g.id_staff_grade = p.grade_staff', 'LEFT');
        $this->db->join('tbl_rol r', 'r.id_rol = p.unit_staff', 'LEFT');
        $this->db->join('tbl_specialty s', 's.id_specialty = p.specialty_staff', 'LEFT');
        return $this->db->get()->result();
    }
    public function get_staff_row($where)
    {
        $this->db->select('p.*');
        $this->db->select('u.*');
        $this->db->select('g.*');
        $this->db->select('r.*');
        $this->db->select('s.*');
        $this->db->from('tbl_staff p');
        $this->db->from('tbl_users u', 'u.id_user = p.user_staff');
        $this->db->join('tbl_staff_grade g', 'g.id_staff_grade = p.grade_staff', 'LEFT');
        $this->db->join('tbl_rol r', 'r.id_rol = p.unit_staff', 'LEFT');
        $this->db->join('tbl_specialty s', 's.id_specialty = p.specialty_staff', 'LEFT');
        $this->db->where($where);
        return $this->db->get()->row();
    }

    public function get_data($table, $where)
    {
        if ($where) {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where($where);
            $query = $this->db->get();
            return $query->result();
        }
        $this->db->select('*');
        $this->db->from($table);
        return $this->db->get()->result();
    }
    public function get_select($val, $table)
    {
        if ($val) {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->like($val);
            $query = $this->db->get();
            return $query->result();
        }
    }
    public function get_origim($val, $table)
    {
        if ($val) {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->like('name_rol', $val);
            $this->db->or_like('descr_rol', $val);
            $query = $this->db->get();
            return $query->result();
        }
    }
    public function insert($data, $table)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    public function get_data_table($table, $where, $type = null, $row = null)
    {
        if ($row && $type == null) {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where($where);
            $query = $this->db->get();
            return $query->row();
        } else {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where($where);
            $this->db->where($type);
            $query = $this->db->get();
            return $query->result();
        }
    }
    public function delete($table, $id, $colum)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($colum, $id);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $this->db->where($colum, $id);
            $this->db->delete($table);
            return true;
        } else {
            return false;
        }
    }
    public function get_jobs($where)
    {
        $this->db->select('*');
        $this->db->from('tbl_staff_jobs');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_bck($where)
    {
        $this->db->select('*');
        $this->db->from('tbl_background');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }
    public function auth_user_login($where, $table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
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
            $this->db->select('g.*');
            $this->db->select('s.*');
            $this->db->select('stf.*');
            $this->db->from('tbl_users user');
            $this->db->join('tbl_rol rol', 'rol.id_rol = user.rol', 'LEFT');
            $this->db->join('tbl_status sts', 'sts.id_status = user.val_user', 'LEFT');
            $this->db->join('tbl_ranges ran', 'ran.id_range = user.range_user', 'LEFT');
            $this->db->join('tbl_staff stf', 'stf.user_staff = user.id_user', 'LEFT');
            $this->db->join('tbl_staff_grade g', 'g.id_staff_grade = user.id_user', 'LEFT');
            $this->db->join('tbl_specialty s', 's.id_specialty = user.id_user', 'LEFT');
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
    public function get_ubigeo($table, $where)
    {
        if ($where) {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->like('codigo_ubigeo', $where);
            $this->db->or_like('departamento', $where);
            $this->db->or_like('provincia', $where);
            $this->db->or_like('distrito', $where);
            $query = $this->db->get();
            return $query->result();
        }
        $this->db->select('*');
        $this->db->from($table);
        return $this->db->get()->result();
    }
}
