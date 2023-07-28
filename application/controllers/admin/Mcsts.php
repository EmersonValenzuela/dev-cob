<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mcsts extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_login_user();
        $this->load->model('McSts_model');
    }

    public function index()
    {
        $data['title'] = 'Datos Adicionales';

        $data['links'] = array(
            '<link href="' . base_url() . 'assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/node_modules/prism/prism.css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/node_modules/select2/dist/css/select2.min.css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/node_modules/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">',
            '<script src="' . base_url() . 'assets/node_modules/moment/moment.js"></script>',
            '<link href="' . base_url() . 'dist/css/pages/stylish-tooltip.css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">',
        );
        $data['scripts'] = array(
            '<script src="' . base_url() . 'assets/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>',
            '<script src="' . base_url() . 'assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>',
            '<script src="' . base_url() . 'buttons/1.5.1/js/dataTables.buttons.min.js"></script>',
            '<script src="' . base_url() . 'buttons/1.5.1/js/buttons.flash.min.js"></script>',
            '<script src="' . base_url() . 'ajax/libs/jszip/3.1.3/jszip.min.js"></script>',
            '<script src="' . base_url() . 'ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>',
            '<script src="' . base_url() . 'ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>',
            '<script src="' . base_url() . 'buttons/1.5.1/js/buttons.html5.min.js"></script>',
            '<script src="' . base_url() . 'buttons/1.5.1/js/buttons.print.min.js"></script>',
            '<script src="' . base_url() . 'assets/node_modules/select2/dist/js/select2.full.min.js"></script>',
            '<script src="' . base_url() . 'assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>',

            '<script src="' . base_url() . 'dist/js/pages/mcsts.js"></script>'
        );
        $this->template->load('admin/template', 'admin/McSts/form', $data);
    }

    public function up_cm()
    {
        $id = $this->session->userdata('user_id');
        $data = array(
            'user_family' => $id,
            'name_family' => $this->input->post('name'),
            'lastname_family' => $this->input->post('lastname'),
            'age_family' => $this->input->post('age'),
            'cciiffs' => $this->input->post('CCIIFFS'),
            'relationship_family' => $this->input->post('relationship'),
        );
        $this->McSts_model->insert($data, 'tbl_family_user');
        $jsonData['q'] = $data;
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }

    public function edit_cm()
    {
        $id = $this->input->post('id_family');
        $data = array(
            'name_family' => $this->input->post('name'),
            'lastname_family' => $this->input->post('lastname'),
            'age_family' => $this->input->post('age'),
            'cciiffs' => $this->input->post('CCIIFFS'),
            'relationship_family' => $this->input->post('relationship'),
        );
        $this->McSts_model->update($data, array('id_family' => $id), 'tbl_family_user');
        $jsonData['q'] = $data;
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }

    function delete_family()
    {
        $id = $this->input->post('id');
        $q = $this->McSts_model->delete('tbl_family_user', array('id_family' => $id));
        $jsonData['q'] = $q;
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }

    public function data_table()
    {
        $id = $this->session->userdata('user_id');
        $result = $this->McSts_model->result_data('tbl_family_user', array('user_family' => $id));
        if ($result) {
            foreach ($result as $row) {
                $array['data'][] = $row;
            }
        } else {
            $array['data'] = array();
        }
        echo json_encode($array);
    }
    public function get_family()
    {
        $id = $this->input->post('id');
        $result = $this->McSts_model->result_data('tbl_family_user', array('id_family' => $id));

        $jsonData['result'] = $result;
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }
    function init_data()
    {
        $row = $this->McSts_model->row_data('tbl_users',  array('id_user' => $this->session->userdata('user_id')));

        $h = $this->McSts_model->row_data('sunat_codigoubigeo', array('codigo_ubigeo' => $row->ubigeo_birthday));

        $h2 = $this->McSts_model->row_data('sunat_codigoubigeo', array('codigo_ubigeo' => $row->ubigeo_housing));
        if ($h) :
            $birthday = $h->departamento . " - " . $h->provincia . " - " . $h->distrito;
        else :
            $birthday = false;
        endif;
        if ($h2) :
            $housing = $h2->departamento . " - " . $h2->provincia . " - " . $h2->distrito;
        else :
            $housing = false;
        endif;
        $jsonData = array(
            'status' => $row->civil_status,
            'ubigeo_birthday' => $row->ubigeo_birthday,
            'date_birthday' => $row->date_birthday,
            'urbanization' => $row->urbanization,
            'ubigeo_housing' => $row->ubigeo_housing,
            'gender' => $row->gender,
            'address' => $row->address,
            'emergency' => $row->emergency_cell,
            'housing' => $housing,
            'birthday' => $birthday
        );

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }
    public function edit_user()
    {
        $id = $this->session->userdata('user_id');
        $data = array(
            'civil_status' => $this->input->post('civil_status'),
            'ubigeo_birthday' => $this->input->post('place_birth'),
            'date_birthday' => $this->input->post('date_birthday'),
            'urbanization' => $this->input->post('urbanization'),
            'ubigeo_housing' => $this->input->post('place_housing'),
            'address' => $this->input->post('address'),
            'gender' => $this->input->post('gender'),
            'emergency_cell' => $this->input->post('emergency'),
        );

        $this->McSts_model->update($data, array('id_user' => $id), 'tbl_users');

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($data);
    }
    public function form_pdf($id)
    {

        $result = $this->McSts_model->result_data('tbl_family_user', array('user_family' => $id));
        $row = $this->McSts_model->row_data('tbl_users',  array('id_user' => $this->session->userdata('user_id')));

        $data['brithday_b'] = $this->McSts_model->row_data('sunat_codigoubigeo', array('codigo_ubigeo' => $row->ubigeo_birthday));

        $data['brithday_u'] = $this->McSts_model->row_data('sunat_codigoubigeo', array('codigo_ubigeo' => $row->ubigeo_housing));

        $data['row'] = $row;
        $data['members'] = $result;
        $this->load->view('admin/mcsts/pdf',$data);
    }
}
