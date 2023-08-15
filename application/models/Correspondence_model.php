
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Correspondence_model extends CI_Model
{

    public function get_rol($where, $table = 'tbl_rol')
    {
        if ($where) {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where($where);
            $query = $this->db->get();
            return $query->row();
        }
        $this->db->select('*');
        $this->db->from('tbl_rol');
        return $this->db->get()->result();
    }

    public function get_user($where)
    {
        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_forwarded($where)
    {
        $this->db->select('*');
        $this->db->from('tbl_forwarded_corr');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }


    public function get_decree($where)
    {
        if ($where) {
            $this->db->select('*');
            $this->db->from('tbl_decree');
            $this->db->where($where);
            $query = $this->db->get();
            return $query->result();
        }
        $this->db->select('*');
        $this->db->from('tbl_decree');
        return $this->db->get()->result();
    }

    public function dataDrive($where)
    {

        $this->db->select('d.*');
        $this->db->select('c.*');
        $this->db->from('tbl_drive d');
        $this->db->join('tbl_forwarded_corr  c', 'c.id_frwd = d.frwrd_id');
        $this->db->where('d.frwrd_id', $where);
        return $this->db->get()->result();
    }
    public function dataDriveRcvd($where)
    {

        $this->db->select('d.*');
        $this->db->select('c.*');
        $this->db->from('tbl_drive_rcvd d');
        $this->db->join('tbl_received_corr  c', 'c.id_rcvd_cr = d.rcvd_id');
        $this->db->where('d.rcvd_id', $where);
        return $this->db->get()->result();
    }

    public function dataReceived($where)
    {
        // ubicación JSON online
        if ($where == 1 || $where == 11 || $where == 13) {
            $this->db->select('c.*');
            $this->db->select('d.*');
            $this->db->from('tbl_received_corr c');
            $this->db->join('tbl_rol d', 'd.id_rol = c.decree');
            return $this->db->get()->result();
        }
        $this->db->select('c.*');
        $this->db->select('d.*');
        $this->db->from('tbl_received_corr c');
        $this->db->join('tbl_rol d', 'd.id_rol = c.decree');
        $this->db->where('c.decree', $where);
        return $this->db->get()->result();
    }

    public function data_rcvd($where, $boss, $depart)
    {
        // ubicación JSON online
        if ($boss == true || $depart == 1) {
            $this->db->select('c.*');
            $this->db->select('d.*');
            $this->db->from('tbl_received_corr c');
            $this->db->join('tbl_rol d', 'd.id_rol = c.decree');
            $this->db->where('c.core_rcvd', $where);
            return $this->db->get()->result();
        }
        $this->db->select('c.*');
        $this->db->select('d.*');
        $this->db->from('tbl_received_corr c');
        $this->db->join('tbl_rol d', 'd.id_rol = c.decree');
        $this->db->where('c.decree', $where);
        return $this->db->get()->result();
    }

    public function dataForwarded($atr, $where)
    {
        // ubicación JSON online
        $this->db->select('f.*');
        $this->db->select('d.*');
        $this->db->from('tbl_forwarded_corr f');
        $this->db->join('tbl_rol d', 'd.id_rol = f.team_id');
        $this->db->where($atr, $where);
        return $this->db->get()->result();
    }
    public function getFiles($limit, $where)
    {
        $this->db->select("*");
        $this->db->from("tbl_drive");
        $this->db->where("frwrd_id", $where);
        $this->db->order_by('id_file', "DESC");
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
    public function getFilesRcvd($limit, $where)
    {
        $this->db->select("*");
        $this->db->from("tbl_drive_rcvd");
        $this->db->where("rcvd_id", $where);
        $this->db->order_by('id_file_rcvd', "DESC");
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
    function dataCorr($where)
    {
        $this->db->select('c.*');
        $this->db->select('d.*');
        $this->db->from('tbl_received_corr c');
        $this->db->join('tbl_rol d', 'd.id_rol = c.decree');
        $this->db->where($where);
        return $this->db->get()->result();
    }
    function dataOffice($where, $row = null)
    {
        if($row != null){
            $this->db->select('s.*');
            $this->db->select('c.*');
            $this->db->select('d.*');
            $this->db->from('tbl_sub_decre s');
            $this->db->join('tbl_received_corr c', 'c.id_rcvd_cr = s.decree_id');
            $this->db->join('tbl_rol d', 'd.id_rol = c.decree');
            $this->db->where($where);
            return $this->db->get()->row();
        }
        $this->db->select('s.*');
        $this->db->select('c.*');
        $this->db->select('d.*');
        $this->db->from('tbl_sub_decre s');
        $this->db->join('tbl_received_corr c', 'c.id_rcvd_cr = s.decree_id');
        $this->db->join('tbl_rol d', 'd.id_rol = c.decree');
        $this->db->where($where);
        return $this->db->get()->result();
    }
    function dataCorrr($where)
    {
        $this->db->select('c.*');
        $this->db->select('d.*');
        $this->db->from('tbl_received_corr c');
        $this->db->join('tbl_rol d', 'd.id_rol = c.decree');
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }
    public function get_record($where, $table)
    {
        if ($where != null) {
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
    public function insert($data, $table)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    public function updateResult($action, $id, $table)
    {
        $this->db->where($id);
        $this->db->update($table, $action);
        return $this->db->insert_id();
    }
    public function update($action, $id, $table)
    {
        $this->db->where($id);
        $this->db->update($table, $action);
        return $this->db->insert_id();
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
}
