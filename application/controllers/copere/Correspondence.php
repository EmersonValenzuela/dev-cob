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
        $boss = department_boss($this->session->userdata('id_user'), 'SJAPE');
        $depart = office_user($this->session->userdata('user_id'), array('name_office' => 'Mesa de Partes'), 'tbl_office');

        $data['title'] = 'Correspondecias-Recibidas';
        $data['rows'] = $this->Correspondence_model->data_rcvd(3, $boss, $depart);
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


    // APIS AJAX

    public function userView()
    {
        $jsonData['rol'] = $this->Correspondence_model->get_record(array('core_rol' => '3'), 'tbl_rol');
        $jsonData['decree'] = $this->Correspondence_model->get_decree(null);
        $jsonData['corr'] = $this->Correspondence_model->dataCorr(array('id_rcvd_cr' => $this->input->post('id_corr')));


        header('Content-type: application/json; charset=utf-8');
        echo json_encode($jsonData);
    }
}
