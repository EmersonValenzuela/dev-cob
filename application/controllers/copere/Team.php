<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Team extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_login_user();
        $this->load->model('Team_model');
    }

    public function departments()
    {
        $data['links'] = array(
            '<link href="' . base_url() . 'assets/node_modules/select2/dist/css/select2.min.css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/node_modules/multiselect/css/multi-select.css"">',
            '<link href="' . base_url() . 'assets/node_modules/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">',
        );
        $data['scripts'] = array(
            '<script src="' . base_url() . 'assets/node_modules/select2/dist/js/select2.full.min.js"></script>',
            '<script src="' . base_url() . 'assets/node_modules/multiselect/js/jquery.multi-select.js"></script>',
            '<script src="' . base_url() . 'assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>',
            '<script src="' . base_url() . 'dist/js/copere/teams.js"></script>',

        );
        $data['title'] = 'Departamentos';
        $data['rows'] = $this->Team_model->get_dresult(array('core_rol' => 3));
        $this->template->load('copere/template', 'copere/teams', $data);
    }

    public function teamIn()
    {
        $name = $this->input->post('n');
        $des = $this->input->post('d');
        $j_dp = $this->input->post('j');
        $m = $this->input->post('m');
        $js_dp = $this->input->post('js');
        $core = $this->input->post('core');
        $jsonData = array();
        $data = array(
            'name_rol' => $name,
            'descr_rol' => $des,
            'jefe_rol' => $j_dp,
            'subjefe_rol' => $js_dp,
            'core_rol' => '3',
            'array_int' => json_encode($m)
        );
        $qy = $this->Team_model->insert($data, 'tbl_rol');
        if ($qy) {
            if ($this->input->post('core') != 0) :
                foreach ($m as $key) {
                    $this->Team_model->update(array('rol' => $qy, 'core' => $this->session->userdata('core')), array("id_user" => $key), 'tbl_users');
                }
            endif;
            $jsonData['rsp'] = 200;
            $jsonData['id'] = $qy;
            unset($data);
        } else {
            $jsonData['rsp'] = 400;
        }

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }

    public function teamUp()
    {
        $name = $this->input->post('n');
        $des = $this->input->post('d');
        $js_dp = $this->input->post('js');
        $j_dp = $this->input->post('j');
        $m = $this->input->post('m');
        $id = $this->input->post('i');
        $core = $this->input->post('core');
        $jsonData = array();

        $rol = $this->Team_model->get_data(array('id_rol' => $id));

        $data = array(
            'name_rol' => $name,
            'descr_rol' => $des,
            'subjefe_rol' => $js_dp,
            'jefe_rol' => $j_dp,
            'array_int' => json_encode($m)
        );
        $qy = $this->Team_model->update($data, array("id_rol" => $id), 'tbl_rol');

        $result = array_diff(json_decode($rol->array_int), $m);

        if (count($result) > 0) {
            foreach ($result as $key) {
                $this->Team_model->update(array('rol' => '2', 'core' => '0'), array("id_user" => $key), 'tbl_users');
            }
        }

        foreach ($m as $key) {
            $this->Team_model->update(array('rol' => $id, 'core' => $this->session->userdata('core')), array("id_user" => $key), 'tbl_users');
        }
        $jsonData['rsp'] = 200;
        $jsonData['array'] = $result;
        $jsonData['id'] = $qy;
        unset($data);

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }


    public function indexOffice()
    {
        $data['links'] = array(
            '<link href="' . base_url() . 'assets/node_modules/select2/dist/css/select2.min.css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/node_modules/multiselect/css/multi-select.css"">',
            '<link href="' . base_url() . 'assets/node_modules/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">',

        );
        $data['scripts'] = array(
            '<script src="' . base_url() . 'assets/node_modules/select2/dist/js/select2.full.min.js"></script>',
            '<script src="' . base_url() . 'assets/node_modules/multiselect/js/jquery.multi-select.js"></script>',
            '<script src="' . base_url() . 'assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>',
            '<script src="' . base_url() . 'dist/js/copere/office.js"></script>',

        );

        $data['title'] = 'Oficinas';
        $data['rows'] = $this->Team_model->get_office(null);
        $this->template->load('copere/template', 'copere/team/office', $data);
    }

    public function officeIn()
    {
        $name = $this->input->post('n');
        $des = $this->input->post('dp');
        $j_dp = $this->input->post('j');
        $m = $this->input->post('m');
        $core = $this->input->post('d');
        $jsonData = array();
        $data = array(
            'name_office' => $name,
            'descrip_office' => $des,
            'first_office' => $j_dp,
            'members_office' => json_encode($m),
            'core_office' => 3,
            'rol' => $core
        );
        $qy = $this->Team_model->insert($data, 'tbl_office');
        if ($qy) {
            if ($m != 0) {
                foreach ($m as $key) {
                    $this->Team_model->update(array('team_depart' => $qy), array("id_user" => $key), 'tbl_users');
                }
            }
            $jsonData['rsp'] = 200;
            $jsonData['id'] = $qy;
            unset($data);
        } else {
            $jsonData['rsp'] = 400;
        }


        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }

    public function officeUp()
    {
        $id = $this->input->post('i');
        $name = $this->input->post('n');
        $des = $this->input->post('dp');
        $j_dp = $this->input->post('j');
        $m = $this->input->post('m');
        $core = $this->input->post('d');
        $jsonData = array();
        $office = $this->Team_model->get_office(array('id_office' => $id));
        $result = array();
        $data = array(
            'name_office' => $name,
            'descrip_office' => $des,
            'first_office' => $j_dp,
            'members_office' => json_encode($m),
            'rol' => $core
        );
        $qy = $this->Team_model->update($data, array("id_office" => $id), 'tbl_office');
        if ($office->members_office != null) {
            $result = array_diff(json_decode($office->members_office), $m);
        }
        if (count($result) > 0) {
            foreach ($result as $key) {
                $this->Team_model->update(array('team_depart' => ''), array("id_user" => $key), 'tbl_users');
            }
        }
        if ($m != null) {
            foreach ($m as $key) {
                $this->Team_model->update(array('team_depart' => $id, 'core' => $this->session->userdata('core')), array("id_user" => $key), 'tbl_users');
            }
        }

        $jsonData['rsp'] = 200;
        $jsonData['array'] = $result;
        $jsonData['id'] = $qy;
        unset($data);

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }

    //AJAX REQUEST ***************************************

    public function getUser()
    {
        $jsonData['users'] = $this->Team_model->get_users(null);
        $jsonData['rols'] = $this->Team_model->get_rol(array('core_rol' => 3));
        $jsonData['rol'] = $this->Team_model->get_data(array('id_rol' => $this->input->post('id')));
        $jsonData['office'] = $this->Team_model->get_office(null);
        $jsonData['off'] = $this->Team_model->get_office(array('id_office' => $this->input->post('id')));
        $jsonData['neogi'] = $this->Team_model->get_n(null);
        $jsonData['neo'] = $this->Team_model->get_n(array('id_neogicates ' => $this->input->post('id')));
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }
    public function dep_user()
    {
        $id = $this->input->post('id');
        $jsonData['dep'] = $this->Team_model->get_users(array('rol' => $id));
        $jsonData['off'] = $this->Team_model->get_users(array('team_depart' => $id));
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }
}
