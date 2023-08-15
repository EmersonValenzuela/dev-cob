<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Correspondence extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_login_user();
        $this->load->model('Correspondence_model');
    }

    public function received()
    {
        $boss = department_boss($this->session->userdata('user_id'), 'SJAPE');
        $depart = office_user($this->session->userdata('user_id'), array('name_office' => 'Mesa de Partes'), 'tbl_office');

        $data['title'] = 'Correspondecias-Recibidas';
        if ($boss || $depart == 1) {
            $data['rows'] = $this->Correspondence_model->data_rcvd(3, $boss, $depart);
        } else {
            $data['rows'] = $this->Correspondence_model->data_rcvd($this->session->userdata('user_type'), $boss, $depart);
        }

        $data['id_user'] = $this->session->userdata('user_id');

        $data['links'] = array(
            '<link href="' . base_url() . 'assets/node_modules/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/node_modules/Magnific-Popup-master/dist/magnific-popup.css">',
            '<link href="' . base_url() . 'assets/node_modules/select2/dist/css/select2.min.css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/node_modules/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">',

        );
        $data['scripts'] = array(
            '<script src="' . base_url() . 'assets/node_modules/moment/moment.js"></script>',
            '<script src="' . base_url() . 'assets/node_modules/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>',
            '<script src="' . base_url() . 'assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>',
            '<script src="' . base_url() . 'assets/node_modules/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>',
            '<script src="' . base_url() . 'assets/node_modules/select2/dist/js/select2.full.min.js"></script>',
            '<script src="' . base_url() . 'dist/js/copere/received.js"></script>',
        );
        $data['boss'] = $boss;
        $data['depart'] = $depart;
        $this->template->load('copere/template', 'copere/correspondence/received', $data);
    }
    public function saveRcvd()
    {
        if ($this->input->post('name_form') == "save") {
            if ($_FILES['file_1']['name'] != "") {
                $ext = pathinfo($_FILES['file_1']['name'], PATHINFO_EXTENSION);
                $data = array(
                    'sender_rcvd' => $this->input->post('tb_r'),
                    'class_rcvd' => $this->input->post('tb_c'),
                    'indicative_rcvd' => $this->input->post('tb_i'),
                    'date_rcvd' => $this->input->post('tb_d'),
                    'clasif_rcvd' => $this->input->post('tb_cl'),
                    'issue_rcvd' => $this->input->post('tb_as'),
                    'rcvd_by' => $this->input->post('tb_rp'),
                    'ext_rcvd' => $ext,
                    'decree' => "0",
                    'status' => "1",
                    'core_rcvd' => 3
                );
                $qy = $this->Correspondence_model->insert($data, 'tbl_received_corr');
                $id = str_pad($qy, 3, '0', STR_PAD_LEFT);
                $config['upload_path'] = 'assets/images/cr_recvd/';
                $config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG|pdf|doc|docx';
                $img = $qy . "." . pathinfo($_FILES['file_1']['name'], PATHINFO_EXTENSION);
                $config['file_name'] = $img;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('file_1')) {
                    $error = array('error' => $this->upload->display_errors());
                    var_dump($error) . "<br>";
                }
                $jsonData['key'] = 200;
                $jsonData['sd'] = 500;
                $jsonData['rsp'] = $id;
                $jsonData['id'] = $qy;
                $jsonData['ext'] = "'" . $ext . "'";
            } else {
                $jsonData['key'] = 400;
                $jsonData['sd'] = 500;
            }
        } elseif ($this->input->post('name_form') == "edit") {
            $jsonData['sd'] = 600;
            $jsonData['id'] = $this->input->post('name_form');
            $qy = $this->input->post('id_received');
            $ext = $this->input->post('extension');

            if ($_FILES['file_1']['name'] != "") {
                $ext = pathinfo($_FILES['file_1']['name'], PATHINFO_EXTENSION);
                $config['upload_path'] = 'assets/images/cr_recvd/';
                $config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG|pdf|doc|docx';
                $img = $qy . "." . pathinfo($_FILES['file_1']['name'], PATHINFO_EXTENSION);
                $config['file_name'] = $img;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('file_1')) {
                    $error = array('error' => $this->upload->display_errors());
                    var_dump($error) . "<br>";
                }
            }
            $data = array(
                'sender_rcvd' => $this->input->post('tb_r'),
                'class_rcvd' => $this->input->post('tb_c'),
                'indicative_rcvd' => $this->input->post('tb_i'),
                'date_rcvd' => $this->input->post('tb_d'),
                'clasif_rcvd' => $this->input->post('tb_cl'),
                'issue_rcvd' => $this->input->post('tb_as'),
                'rcvd_by' => $this->input->post('tb_rp'),
                'ext_rcvd' => $ext,
            );
            $this->Correspondence_model->updateResult($data, array("id_rcvd_cr" => $qy), 'tbl_received_corr');

            $id = str_pad($qy, 3, '0', STR_PAD_LEFT);

            $jsonData['rsp'] = $id;
            $jsonData['id'] = $qy;
            $jsonData['ext'] = "'" . $ext . "'";
        };

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }
    public function decreeTeam()
    {

        $id_rol = $this->input->post('id_rol');
        $id = $this->input->post('id_cr');
        $radio = $this->input->post('radio');
        $issue = $this->input->post('issue');
        $slcttxt = $this->input->post('slcttxt');
        $slct_decree = $this->input->post('slct_decree');
        $qy = $this->Correspondence_model->get_rol(array('name_rol' => 'SJAPE'));
        $jsonData = array();

        if ($this->session->userdata('user_id') != $qy->jefe_rol) {
            $jsonData['rsp'] = 400;
        } else {
            $data = array(
                'decree' => $id_rol,
                'status' => '2',
                'mode_decree' => $slct_decree,
                'urg' => $radio,
                'issue_decree' => $issue,
                'rcvd_by' => $slcttxt,
                'date_decree' => date("d-m-Y"),
                'hour_rcvd' => date("h:i"),
            );
            $row = $this->Correspondence_model->update($data, array('id_rcvd_cr ' => $id), 'tbl_received_corr');
            $jsonData['rsp'] = 200;
        }
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }
    public function decreeOffice()
    {

        $id_office = $this->input->post('id_office');
        $decree_id = $this->input->post('decree_id');
        $id_sub_decree = $this->input->post('id_sub_decree');
        $radio = $this->input->post('radio');
        $issue = $this->input->post('issue');
        $slcttxt = $this->input->post('slcttxt');
        $slct_decree = $this->input->post('slct_decree');
        $qy = $this->Correspondence_model->get_rol(array('name_rol' => 'PREVISIÓN SOCIAL'));
        $jsonData = array();

        if ($this->session->userdata('user_id') != $qy->jefe_rol) {
            $jsonData['rsp'] = 400;
        } else {
            $data = array(
                'office_decree' => $id_office,
                'mode_sub_decree' => $slct_decree,
                'sub_urg' => $radio,
                'issue_sub_decree' => $issue,
                'name_office' => $slcttxt,
                'decree_id' => $decree_id,
                'date_sub_decree' => date("d-m-Y"),
                'hour_sub_decree' => date("h:i"),
            );
            if ($id_sub_decree != '') {
                $row = $this->Correspondence_model->update($data, array('decree_id ' => $decree_id), 'tbl_sub_decre');
            }else{
                $row = $this->Correspondence_model->insert($data, 'tbl_sub_decre');
            }

            $jsonData['rsp'] = 200;
        }
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }

    public function forwarded()
    {
        $data['title'] = 'Correspondecias-Remitidas';

        $data['links'] = array(
            '<link href="' . base_url() . 'assets/node_modules/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/node_modules/Magnific-Popup-master/dist/magnific-popup.css">',
            '<link href="' . base_url() . 'assets/node_modules/select2/dist/css/select2.min.css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/node_modules/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">',
        );
        $data['scripts'] = array(
            '<script src="' . base_url() . 'assets/node_modules/moment/moment.js"></script>',
            '<script src="' . base_url() . 'assets/node_modules/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>',
            '<script src="' . base_url() . 'assets/node_modules/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>',
            '<script src="' . base_url() . 'assets/node_modules/select2/dist/js/select2.full.min.js"></script>',
            '<script src="' . base_url() . 'dist/js/pages/forwarded.js"></script>'
        );


        $data['rows'] = $this->Correspondence_model->dataForwarded('f.team_id', $this->session->userdata('user_type'));

        $this->template->load('copere/template', 'copere/correspondence/forwarded', $data);
    }


    //DRIVE FUNCTIONS -------------------------------------------------------

    public function driveRcvd()
    {
        $data['title'] = 'Archivos Adjuntos Recibidos';
        $data['rows'] = $this->Correspondence_model->dataDriveRcvd($_GET['id']);
        $data['id'] = $_GET['id'];

        $data['links'] = array(
            '<link href="' . base_url() . 'dist/css/pages/drive.css" rel="stylesheet">',
            '<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">'
        );
        $data['scripts'] = array(
            '<script src="' . base_url() . 'dist/js/pages/drive_rcvd.js"></script>'

        );

        $this->template->load('copere/template', 'copere/correspondence/drive_rcvd', $data);
    }
    public function saveFilesRcvd()
    {
        $id = $_POST['id_rcvd'];
        $conteo = count($_FILES["archivos"]["name"]);
        $path = "assets/files/received/" . $id;

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        for ($i = 0; $i < $conteo; $i++) {
            $ubicacionTemporal = $_FILES["archivos"]["tmp_name"][$i];
            $nombreArchivo = $_FILES["archivos"]["name"][$i];
            $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
            // Renombrar archivo
            $nuevoNombre = sprintf("%s_%d.%s", uniqid(), $i, $extension);
            // Mover del temporal al directorio actual
            move_uploaded_file($ubicacionTemporal, "$path/$nuevoNombre");
            $data = array(
                "rcvd_id" => $id,
                "name_rcvd" => $nuevoNombre,
                "ext_rcvd_d" => $extension,
            );
            $this->Correspondence_model->insert($data, 'tbl_drive_rcvd');
        }
        // Responder al cliente
        echo json_encode($id);
    }
    public function deleteFileRcvd()
    {
        $jsonData = array();
        $id = $this->input->post('id');
        $id_rcvd = $this->input->post('id_rcvd');
        $name = $this->input->post('name_rcvd');
        $qy = $this->Correspondence_model->delete('tbl_drive_rcvd', $id, 'id_file_rcvd ');


        if ($qy == true) {
            unlink('assets/files/received/' . $id_rcvd . '/' . $name);
            $jsonData['rsp'] = 200;
        } else {
            $jsonData['rsp'] = 400;
        }
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }

    //PDF VIEWS ----------------------------------------------------------------

    public function viewDecree($id)
    {
        $data['row'] = $this->Correspondence_model->dataCorrr(array('id_rcvd_cr' => $id));
        $qy = $this->Correspondence_model->get_rol(array('name_rol' => 'SJAPE'));
        $data['user'] = $this->Correspondence_model->get_user(array('id_user' => $qy->jefe_rol));
        $this->load->view("copere/correspondence/pdfjapce", $data);
    }

    // APIS AJAX ----------------------------------------------------------------
    public function userView()
    {
        $jsonData['rol'] = $this->Correspondence_model->get_record(array('core_rol' => '3'), 'tbl_rol');
        $jsonData['decree'] = $this->Correspondence_model->get_decree(array('rol_asist' => 'SJAPE'));
        $jsonData['corr'] = $this->Correspondence_model->dataCorr(array('id_rcvd_cr' => $this->input->post('id_corr')));

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }
    public function officeView()
    {
        $jsonData['rol'] = $this->Correspondence_model->get_record(array('core_office' => 3, 'rol' => $this->input->post('dec')), 'tbl_office');
        $jsonData['decree'] = $this->Correspondence_model->get_decree(array('rol_asist' => 'SJAPE'));
        $jsonData['corr'] = $this->Correspondence_model->dataOffice(array('decree_id' => $this->input->post('id_corr')));


        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }
    function viewFilesRcvd()
    {
        $limit = $this->input->post('amount');
        $id = $this->input->post('id');

        $jsonData['rows'] = $this->Correspondence_model->getFilesRcvd($limit, $id);

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }

    public function viewCorr()
    {
        $jsonData = array();
        if ($this->input->post('id_corr') != null) {
            $jsonData['corr'] = $this->Correspondence_model->dataCorr(array('id_rcvd_cr' => $this->input->post('id_corr')));
        }

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }
}
