<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cmsts extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_login_user();
        $this->load->model('McSts_model');
    }

    public function index()
    {
        $data['links'] = array(
            '<link href="' . base_url() . 'assets/node_modules/select2/dist/css/select2.min.css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/node_modules/multiselect/css/multi-select.css"">',
            '<link href="' . base_url() . 'assets/node_modules/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">',
        );
        $data['scripts'] = array(
            '<script src="' . base_url() . 'assets/node_modules/select2/dist/js/select2.full.min.js"></script>',
            '<script src="' . base_url() . 'dist/js/pages/cmsts.js"></script>'
        );

        $data['title'] = 'Lista de CMSTS';
        $this->template->load('be/template', 'be/mcsts/list', $data);
    }

    public function pdf_cmsts($id)
    {
        $result = $this->McSts_model->result_data('tbl_family_user', array('user_family' => $id));
        $row = $this->McSts_model->row_data('tbl_users',  array('id_user' => $this->session->userdata('user_id')));

        $data['brithday_b'] = $this->McSts_model->row_data('sunat_codigoubigeo', array('codigo_ubigeo' => $row->ubigeo_birthday));

        $data['brithday_u'] = $this->McSts_model->row_data('sunat_codigoubigeo', array('codigo_ubigeo' => $row->ubigeo_housing));

        $data['row'] = $row;
        $data['members'] = $result;
        $this->load->view('be/mcsts/pdf', $data);
    }

    public function pdf_active($id)
    {
        $result = $this->McSts_model->result_data('tbl_family_user', array('user_family' => $id));
        $row = $this->McSts_model->row_data('tbl_users',  array('id_user' => $this->session->userdata('user_id')));

        $data['brithday_b'] = $this->McSts_model->row_data('sunat_codigoubigeo', array('codigo_ubigeo' => $row->ubigeo_birthday));

        $data['brithday_u'] = $this->McSts_model->row_data('sunat_codigoubigeo', array('codigo_ubigeo' => $row->ubigeo_housing));

        $data['row'] = $row;
        $data['members'] = $result;
        $this->load->view('be/mcsts/pdf_active', $data);
    }

    public function pdf_inactive($id)
    {
        $result = $this->McSts_model->result_data('tbl_family_user', array('user_family' => $id));
        $row = $this->McSts_model->row_data('tbl_users',  array('id_user' => $this->session->userdata('user_id')));

        $data['brithday_b'] = $this->McSts_model->row_data('sunat_codigoubigeo', array('codigo_ubigeo' => $row->ubigeo_birthday));

        $data['brithday_u'] = $this->McSts_model->row_data('sunat_codigoubigeo', array('codigo_ubigeo' => $row->ubigeo_housing));

        $data['row'] = $row;
        $data['members'] = $result;
        $this->load->view('be/mcsts/pdf_inactive', $data);
    }

    public function list_cmsts()
    {
        $result = $this->McSts_model->result_data('tbl_users', array('cmsts' => 1));
        if ($result) {
            foreach ($result as $row) {
                $row->cip_user = $this->encryption->decrypt($row->cip_user);
                $row->dni_user = $this->encryption->decrypt($row->dni_user);

                $array['data'][] = $row;
            }
        } else {
            $array['data'] = array();
        }
        echo json_encode($array);
    }
}
