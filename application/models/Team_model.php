
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Team_model extends CI_Model
{

    public function insert($data, $table)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function update($action, $id, $table)
    {
        $this->db->where($id);
        $this->db->update($table, $action);
        return $this->db->insert_id();
    }

    public function get_data($where = null)
    {
        if ($where) {
            $this->db->select('*');
            $this->db->from('tbl_rol');
            $this->db->where($where);
            $query = $this->db->get();
            return $query->row();
        }
        $this->db->select('*');
        $this->db->from('tbl_rol');
        return $this->db->get()->result();
    }

    public function get_n($where)
    {
        if ($where) {
            $this->db->select('*');
            $this->db->from('tbl_neogicates');
            $this->db->where($where);
            $query = $this->db->get();
            return $query->row();
        }
        $this->db->select('*');
        $this->db->from('tbl_neogicates');
        return $this->db->get()->result();
    }

    public function get_dresult($where)
    {

        $this->db->select('*');
        $this->db->from('tbl_rol');
        $this->db->where($where);
        return $this->db->get()->result();
    }

    public function get_office($where)
    {
        if ($where) {
            $this->db->select('*');
            $this->db->from('tbl_office');
            $this->db->where($where);
            $query = $this->db->get();
            return $query->row();
        }
        $this->db->select('*');
        $this->db->from('tbl_office');
        return $this->db->get()->result();
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

    public function get_rol($where = null)
    {
        if ($where != null) {
            $this->db->select('*');
            $this->db->from('tbl_rol');
            $this->db->where($where);
            return $this->db->get()->result();
        }
        $this->db->select('*');
        $this->db->from('tbl_rol');
        return $this->db->get()->result();
    }
    public function delete($where, $table)
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
}
