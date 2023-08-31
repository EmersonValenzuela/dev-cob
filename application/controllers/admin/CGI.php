<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CGI extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        check_login_user();
        $this->load->model('Das_model');
        $this->load->model('CGI_model');
    }

    public function index()
    {

        $md5 = $this->session->userdata('user_id');
        $cgi = $this->CGI_model->row_data('tbl_cgi_person', array('user_cgi' => $md5));
        $user = $this->CGI_model->row_data('tbl_users', array('id_user' => $md5));

        if ($cgi == null) {
            $this->CGI_model->insert(array('user_cgi' => $md5), 'tbl_cgi_person');
        }

        $data['ub'] = string_ubigeo($user->ubigeo_birthday);
        $data['uh'] = string_ubigeo($user->ubigeo_housing);

        $data['title'] = 'Datos Adicionales';
        $data['range'] = $this->Das_model->auth_row('tbl_ranges', array('id_range' => $this->session->userdata('user_range')));

        $data['links'] = array(
            '<link href="' . base_url() . 'assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/node_modules/prism/prism.css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/node_modules/select2/dist/css/select2.min.css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/node_modules/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">',
            '<script src="' . base_url() . 'assets/node_modules/moment/moment.js"></script>',
            '<link href="' . base_url() . 'dist/css/pages/stylish-tooltip.css" rel="stylesheet">',
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

            '<script src="' . base_url() . 'dist/js/pages/cgi.js"></script>'
        );
        $this->template->load('admin/template', 'admin/cgi/data_additional', $data);
    }
    public function insert_general()
    {
        $data_user = array(
            'ubigeo_birthday' => $this->input->post('ubigeo_birthday'),
            'ubigeo_housing' => $this->input->post('ubigeo_home'),
            'date_birthday' => $this->input->post('birthday'),
            'home_phone' => $this->input->post('home_phone'),
            'civil_status' => $this->input->post('civil_status'),
        );

        $this->CGI_model->update($data_user, array('id_user' => $this->session->userdata('user_id')), 'tbl_users');


        $data = array(
            "current_ocupation" => $this->input->post("current_oc"),
            "conadis_did" => $this->input->post("conadis_did"),
            "level_education" => $this->input->post("level_education"),
            "size_cgi" => $this->input->post("size"),
            "cash_type" => $this->input->post("type_cash"),
            "high_resolution" => $this->input->post("high_resolution"),
            "situation_cgi" => $this->input->post("situation")
        );

        $this->CGI_model->update($data, array('user_cgi' => $this->session->userdata('user_id')), 'tbl_cgi_person');

        $jsonData['data'] = $data;
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }
    public function insert_reason()
    {
        $data = array(
            'causal' => $this->input->post('tb_ca'),
            'event' => $this->input->post('events_ej'),
            'invalidity_date' => $this->input->post('invalidate'),
            'accident_site' => $this->input->post('accident_site'),
            'diagnosis' => $this->input->post('tb_di'),
        );
        $this->CGI_model->update($data, array('user_cgi' => $this->session->userdata('user_id')), 'tbl_cgi_person');

        $jsonData = $data;
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }

    public function insert_requirements()
    {
        $data = array(
            'ubig_require' => $this->input->post('ubigeo_atention'),
            'hospital_require' => $this->input->post('hospital'),
            'weelchair' => $this->input->post('wheelchair'),
            'region_military	' => $this->input->post('rrmm'),
            'prosthesis' => $this->input->post('prosthesis'),
        );
        $this->CGI_model->update($data, array('user_cgi' => $this->session->userdata('user_id')), 'tbl_cgi_person');

        $jsonData = $data;
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }


    // FAMILY CODE
    public function up_cm()
    {
        $id = $this->session->userdata('user_id');
        $data = array(
            'user_family' => $id,
            'name_family' => $this->input->post('name'),
            'lastname_family' => $this->input->post('lastname'),
            'age_family' => $this->input->post('age'),
            /* 'cciiffs' => $this->input->post('CCIIFFS'),*/
            'relationship_family' => $this->input->post('relationship'),
            'dni_family' => $this->input->post('dni'),
        );
        $this->CGI_model->insert($data, 'tbl_family_user');
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
            /*'cciiffs' => $this->input->post('CCIIFFS'),*/
            'relationship_family' => $this->input->post('relationship'),
            'dni_family' => $this->input->post('dni'),

        );
        $this->CGI_model->update($data, array('id_family' => $id), 'tbl_family_user');
        $jsonData['q'] = $data;
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }
    function delete_family()
    {
        $id = $this->input->post('id');
        $q = $this->CGI_model->delete('tbl_family_user', array('id_family' => $id));
        $jsonData['q'] = $q;
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }

    /*----------------------------*/
    // AJAX API
    public function data_ubigeo()
    {
        $val = $_GET['q'];
        $result = $this->CGI_model->get_data('sunat_codigoubigeo', $val);
        if ($result != null) {
            foreach ($result as $row) {
                $id = $row->codigo_ubigeo;
                $text = $row->departamento . " - " . $row->provincia . " - " . $row->distrito;
                $data[] = array('id' => $id, 'text' => $text);
            }
        } else {
            $data[] = array('id' => 0, 'text' => 'No se enconto Ubigeo');
        }
        echo json_encode($data);
    }
    public function data_table()
    {
        $id = $this->session->userdata('user_id');
        $result = $this->CGI_model->result_data('tbl_family_user', array('user_family' => $id));
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
        $result = $this->CGI_model->result_data('tbl_family_user', array('id_family' => $id));

        $jsonData['result'] = $result;
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }
    public function loadPage()
    {
        $ubig_r = "";
        $md5 = $this->session->userdata('user_id');
        $cgi = $this->CGI_model->result_data('tbl_cgi_person', array('user_cgi' => $md5));
        $user = $this->CGI_model->result_data('tbl_users', array('id_user' => $md5));
        foreach ($cgi as $key => $value) {
            $ubig_r = $value->ubig_require;
        }

        $jsonData['ur'] = string_ubigeo($ubig_r);
        $jsonData['cgi'] = $cgi;
        $jsonData['user'] = $user;
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }
}
