<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_login_user();
        $this->load->model('Staff_model');
    }
    public function index()
    {
        $data['links'] = array();
        $data['scripts'] = array(
            '<script src="' . base_url() . 'dist/js/pages/staff_list.js"></script>'
        );

        $data['rows'] = $this->Staff_model->get_users(array('ran.id_range' => 22));

        $data['title'] = 'Lista Personal';
        $this->template->load('be/template', 'copere/staff/index', $data);
    }

    public function formStaff()
    {
        $data['links'] = array(
            '<link href="' . base_url() . 'assets/node_modules/select2/dist/css/select2.min.css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/node_modules/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">',
            '<link href="' . base_url() . 'dist/css/pages/stylish-tooltip.css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/node_modules/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">',

        );
        $data['scripts'] = array(
            '<script src="' . base_url() . 'assets/node_modules/moment/moment.js"></script>',
            '<script src="' . base_url() . 'assets/node_modules/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>',
            '<script src="' . base_url() . 'assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>',
            '<script src="' . base_url() . 'assets/node_modules/select2/dist/js/select2.full.min.js"></script>',
            '<script src="' . base_url() . 'dist/js/pages/staff.js"></script>'

        );

        $data['grades'] = $this->Staff_model->get_data('tbl_staff_grade', null);
        $data['teams'] = $this->Staff_model->get_data('tbl_rol', null);
        $data['specialties'] = $this->Staff_model->get_data('tbl_specialty', null);
        $data['title'] = 'Agregar Personal';
        $this->template->load('be/template', 'copere/staff/form', $data);
    }
    public function up_personal()
    {
        $workplace = $this->input->post('workplace');
        $start_date = $this->input->post('start_date');
        $finish_date = $this->input->post('finish_date');
        $data = array(
            'name_staff' => $this->input->post('n_staff'),
            'lastname_staff' => $this->input->post('ls_staff'),
            'cip_staff' => $this->input->post('cip'),
            'dni_staff' => $this->input->post('dni'),
            'place_staff' => $this->input->post('place_birth'),
            'birthday_staff' => $this->input->post('date_birth'),
            'address' => $this->input->post('home_address'),
            'cell_holder' => $this->input->post('cell_holder'),
            'emergency_cell' => $this->input->post('emergency_cell'),
            'status_staff' => $this->input->post('civil_status'),
            'sons_staff' => $this->input->post('number_children'),
            'condition_staff' => $this->input->post('condition_staff'),
            'hired_staff' => $this->input->post('date_contracted'),
            'named_staff' => $this->input->post('date_named'),
            'ascent_staff' => $this->input->post('date_ascent'),
            'grade_staff' => $this->input->post('grade_staff'),
            'unit_staff' => $this->input->post('unit_staff'),
            'ocupation_staff' => $this->input->post('group_occup'),
            'specialty_staff' => $this->input->post('speciality'),
            'position_staff' => $this->input->post('position'),
        );
        $last_id = $this->Staff_model->insert($data, 'tbl_staff');

        for ($i = 0; $i < count($workplace); $i++) {
            $jobbs = array(
                'name_jobb' => $workplace[$i],
                'start_jobb' => $start_date[$i],
                'finalized_jobb' => $finish_date[$i],
                'id_personal' => $last_id
            );
            $this->Staff_model->insert($jobbs, 'tbl_staff_jobs');
        }

        $jsonData['data'] = $data;
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }

    public function data_table()
    {
        $id = $this->input->post('id');
        $result = $this->Staff_model->get_data_table('tbl_background', array('person_bck' => $id));
        if ($result) {
            foreach ($result as $row) {
                $array['data'][] = $row;
            }
        } else {
            $array['data'] = array();
        }

        echo json_encode($array);
    }
    public function up_bck()
    {
        if ($_FILES['doc_bck']['name']) {
            $name = date('dmYhis') . '_' . rand(0, 99999) . "." . pathinfo($_FILES['doc_bck']['name'], PATHINFO_EXTENSION);
            $config['upload_path'] = 'assets/images/bck_images/';
            $config['allowed_types'] = '*';

            $config['file_name'] = $name;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('doc_bck')) {
                $error = array('error' => $this->upload->display_errors());

                var_dump($error) . "<br>";
            }

            $data = array(
                'type_bck' => $this->input->post('type_bck'),
                'name_bck' => $this->input->post('name_bck'),
                'doc_bck' => $name,
                'person_bck' => $this->input->post('id_pr'),
            );
            $last_id = $this->Staff_model->insert($data, 'tbl_background');

            $jsonData['data'] = $data;
            $jsonData['up_id'] = $last_id;
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($jsonData);
        }
    }
    public function update_bck()
    {

        if ($_FILES['doc_bck']['name']) {
            $name = date('dmYhis') . '_' . rand(0, 99999) . "." . pathinfo($_FILES['doc_bck']['name'], PATHINFO_EXTENSION);
            $config['upload_path'] = 'assets/images/bck_images/';
            $config['allowed_types'] = '*';

            $config['file_name'] = $name;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('doc_bck')) {
                $error = array('error' => $this->upload->display_errors());

                var_dump($error) . "<br>";
            }

            $data = array(
                'type_bck' => $this->input->post('type_bck'),
                'name_bck' => $this->input->post('name_bck'),
                'doc_bck' => $name
            );
            $this->Staff_model->update($data, 'tbl_background', array('id_bck' => $this->input->post('id_bck')));

            $jsonData['data'] = $data;
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($jsonData);
        } else {
            $data = array(
                'type_bck' => $this->input->post('type_bck'),
                'name_bck' => $this->input->post('name_bck'),
                'person_bck' => $this->input->post('id_pr'),
            );
            $this->Staff_model->update($data, 'tbl_background', array('id_bck' => $this->input->post('id_bck')));
            $jsonData['data'] = $data;
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($jsonData);
        }
    }
    public function data_grade()
    {
        $result = $this->Staff_model->get_select(array('name_grade_staff' => $_GET['q']), 'tbl_staff_grade');
        if ($result != null) {
            foreach ($result as $row) {
                $id = $row->id_staff_grade;
                $text = $row->name_grade_staff;
                $data[] = array('id' => $id, 'text' => $text);
            }
        } else {
            $data[] = array('id' => 0, 'text' => 'No se encontro Grado');
        }
        echo json_encode($data);
    }
    public function data_specialty()
    {
        $result = $this->Staff_model->get_select(array('name_specialty' => $_GET['q']), 'tbl_specialty');
        if ($result != null) {
            foreach ($result as $row) {
                $id = $row->id_specialty;
                $text = $row->name_specialty;
                $data[] = array('id' => $id, 'text' => $text);
            }
        } else {
            $data[] = array('id' => 0, 'text' => 'No se encontro Especialidad');
        }
        echo json_encode($data);
    }
    public function data_origin()
    {
        $result = $this->Staff_model->get_origim($_GET['q'], 'tbl_rol');
        if ($result != null) {
            foreach ($result as $row) {
                if ($row->id_rol == "0" || $row->id_rol == "1" || $row->id_rol == "2") {
                } else {
                    $id = $row->id_rol;
                    $text = $row->name_rol;
                    $data[] = array('id' => $id, 'text' => $text);
                }
            }
        } else {
            $data[] = array('id' => 0, 'text' => 'No se encontro Unidad de Origen');
        }
        echo json_encode($data);
    }
    public function get_bck()
    {
        $id = $this->input->post('id');
        $result = $this->Staff_model->get_data_table('tbl_background', array('id_bck' => $id));

        $jsonData['data'] = $result;
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }
    public function delete_bck()
    {
        $id = $this->input->post('id');
        $row = $this->Staff_model->get_data_table('tbl_background', array('id_bck' => $id), 'row');
        unlink('assets/images/bck_images/' . $row->doc_bck);

        $q = $this->Staff_model->delete('tbl_background', $id, 'id_bck');
        if ($q) {
            $jsonData['rsp'] = true;
        }
        $jsonData['img'] = $row->doc_bck;
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }

    public function edit_personal($id)
    {
        $data['links'] = array(
            '<link href="' . base_url() . 'assets/node_modules/select2/dist/css/select2.min.css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/node_modules/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">',
            '<link href="' . base_url() . 'dist/css/pages/stylish-tooltip.css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/node_modules/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">',

        );
        $data['scripts'] = array(
            '<script src="' . base_url() . 'assets/node_modules/moment/moment.js"></script>',
            '<script src="' . base_url() . 'assets/node_modules/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>',
            '<script src="' . base_url() . 'assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>',
            '<script src="' . base_url() . 'assets/node_modules/select2/dist/js/select2.full.min.js"></script>',
            '<script src="' . base_url() . 'dist/js/pages/staff_edit.js"></script>'

        );
        $row = $this->Staff_model->auth_staff(array('user_staff' => $id));
        if ($row == false) :
            $this->Staff_model->insert(array('user_staff' => $id), 'tbl_staff');
            for ($i = 0; $i < 3; $i++) :
                $this->Staff_model->insert(array('id_personal' => $id), 'tbl_staff_jobs');
            endfor;
        endif;
        $rows = $this->Staff_model->get_jobs(array('id_personal' => $id));

        $data['jobs'] = $rows;
        $data['id'] = $id;
        $data['title'] = 'Editar Personal';
        $this->template->load('be/template', 'copere/staff/edit', $data);
    }
    public function data_personal()
    {
        $id = $this->input->post('id');
        $row = $this->Staff_model->get_users(array('user.id_user' => $id));
        $user = $this->Staff_model->auth_user_login(array('id_user' => $id));

        $jsonData['row'] = $row;
        $jsonData['name'] = $user->name_user;
        $jsonData['lastname'] = $user->lastname_user;
        $jsonData['dni'] = $this->encryption->decrypt($user->cip_user);
        $jsonData['cip'] = $this->encryption->decrypt($user->dni_user);
        $jsonData['phone'] = $user->phone_user;
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }
    public function gp_personal()
    {
        $id = $this->input->post('user_staff');
        $workplace = $this->input->post('workplace');
        $start_date = $this->input->post('start_date');
        $finish_date = $this->input->post('finish_date');
        $id_jobb = $this->input->post('id_jobbs');

        $data = array(
            'place_staff' => $this->input->post('place_birth'),
            'birthday_staff' => $this->input->post('date_birth'),
            'address' => $this->input->post('home_address'),
            'emergency_cell' => $this->input->post('emergency_cell'),
            'status_staff' => $this->input->post('civil_status'),
            'sons_staff' => $this->input->post('number_children'),
            'condition_staff' => $this->input->post('condition_staff'),
            'hired_staff' => $this->input->post('date_contracted'),
            'named_staff' => $this->input->post('date_named'),
            'ascent_staff' => $this->input->post('date_ascent'),
            'grade_staff' => $this->input->post('grade_staff'),
            'unit_staff' => $this->input->post('unit_staff'),
            'ocupation_staff' => $this->input->post('group_occup'),
            'specialty_staff' => $this->input->post('speciality'),
            'position_staff' => $this->input->post('position')
        );

        $lsat_id = $this->Staff_model->update($data, 'tbl_staff', array('user_staff' => $id));

        for ($i = 0; $i < count($workplace); $i++) {
            $jobbs = array(
                'name_jobb' => $workplace[$i],
                'start_jobb' => $start_date[$i],
                'finalized_jobb' => $finish_date[$i],
            );
            $this->Staff_model->update($jobbs, 'tbl_staff_jobs', array('id_jobb' => $id_jobb[$i]));
        }

        $jsonData['data'] = $data;
        $jsonData['last'] = $lsat_id;

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }
    public function single_personal($id)
    {
        $data['row'] = $this->Staff_model->get_staff_row(array('p.user_staff' => $id));
        $data['jobs']  = $this->Staff_model->get_jobs(array('id_personal' => $id));
        $user = $this->Staff_model->auth_user_login(array('id_user' => $id));
        $data['name'] = $user->name_user;
        $data['lastname'] = $user->lastname_user;
        $data['dni'] = $this->encryption->decrypt($user->cip_user);
        $data['cip'] = $this->encryption->decrypt($user->dni_user);
        $data['phone'] = $user->phone_user;

        $this->load->view('copere/staff/pdf', $data);
    }
}
