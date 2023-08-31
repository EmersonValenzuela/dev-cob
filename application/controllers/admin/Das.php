<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Das extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		check_login_user();
		$this->load->model('Das_model');
	}

	public function index()
	{

		$data['title'] = 'Lista Documentos DAS';

		$data['univ'] = $this->Das_model->get_univ_list(array('table.user' => $this->session->userdata('user_id')));
		$data['inst'] = $this->Das_model->get_inst_list(array('table.user' => $this->session->userdata('user_id')));
		$data['brit'] = $this->Das_model->get_brit_list(array('table.user' => $this->session->userdata('user_id')));

		$data['links'] = array(
			'<link href="' . base_url() . 'assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">',
			'<link href="' . base_url() . 'assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css" rel="stylesheet">',
			'<link href="' . base_url() . 'assets/node_modules/prism/prism.css" rel="stylesheet">'

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
			'<script src="' . base_url() . 'dist/js/datatable.js"></script>',
			'<script src="' . base_url() . 'dist/js/alerts.js"></script>',
			'<script src="' . base_url() . 'dist/js/das.js"></script>'

		);
		$this->template->load('admin/template', 'admin/das/list_doc', $data);
	}

	public function university()
	{
		$data['range'] = $this->Das_model->auth_row('tbl_ranges', array('id_range' => $this->session->userdata('user_range')));
		$data['title'] = 'Formulario Dace';
		$data['links'] = array(
			'<link href="' . base_url() . 'assets/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet">',
			'<link href="' . base_url() . 'assets/node_modules/switchery/dist/switchery.min.css" rel="stylesheet">'

		);
		$data['scripts'] = array(
			'<script src="' . base_url() . 'assets/node_modules/switchery/dist/switchery.min.js"></script>',
			'<script src="' . base_url() . 'dist/js/das.js"></script>',
			'<script> $(function () {
				var elems = Array.prototype.slice.call(document.querySelectorAll(".js-switch"));
				$(".js-switch").each(function () {
					new Switchery($(this)[0], $(this).data()); 
				});
			});</script>',

			'<script src="' . base_url() . 'assets/node_modules/dropify/dist/js/dropify.min.js"></script>',
			'<script>$(document).ready(function() {$(".dropify").dropify();});</script>',
			'<script>
				$(function () {
					$(".select2").select2();
				});
			</script>'
		);

		$data['universities'] = $this->Das_model->get_universities();
		$data['rlt'] = $this->Das_model->relation();

		$this->template->load('admin/template', 'admin/das/university/form_university', $data);
	}

	public function pdf_university($id)
	{
		$rowData = $this->Das_model->get_data(array('id_univ' => $id));
		$data['request'] = $rowData;
		$this->load->view('admin/das/university/pdf', $data);
	}

	public function addUniversity()
	{
		//Data family
		$uni_name_fam = $this->input->post('uni_name_fam');
		$uni_last_fam = $this->input->post('uni_last_fam');
		$uni_cift_fam = $this->input->post('uni_cift_fam');
		$uni_email_fam = $this->input->post('uni_email_fam');

		//Data University

		$type_process = $this->input->post('type_process');
		$university = $this->input->post('university');
		$uni_specialty = $this->input->post('uni_specialty');
		$relationship = $this->input->post('relationship');
		$service = $this->input->post('service');

		if ($_FILES['uni_grades']['name'] != "") {

			$config['upload_path'] = 'assets/images/docuniversity/';
			$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG';

			$image_uni_grades = date('dmYhis') . '_' . rand(0, 99999) . "." . pathinfo($_FILES['uni_grades']['name'], PATHINFO_EXTENSION);

			$config['file_name'] = $image_uni_grades;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('uni_grades')) {
				$error = array('error' => $this->upload->display_errors());

				var_dump($error) . "<br>";
			}
		} else {
			$image_uni_grades = "";
		}

		if ($_FILES['uni_tuition']['name'] != "") {

			$config['upload_path'] = 'assets/images/docuniversity/';
			$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG';

			$image_uni_tuition = date('dmYhis') . '_' . rand(0, 99999) . "." . pathinfo($_FILES['uni_tuition']['name'], PATHINFO_EXTENSION);

			$config['file_name'] = $image_uni_tuition;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('uni_tuition')) {
				$error = array('error' => $this->upload->display_errors());

				var_dump($error) . "<br>";
			}
		} else {
			$image_uni_tuition = "";
		}
		if ($_FILES['uni_settlement']['name'] != "") {

			$config['upload_path'] = 'assets/images/docuniversity/';
			$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG';

			$image_uni_settlement = date('dmYhis') . '_' . rand(0, 99999) . "." . pathinfo($_FILES['uni_settlement']['name'], PATHINFO_EXTENSION);

			$config['file_name'] = $image_uni_settlement;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('uni_settlement')) {
				$error = array('error' => $this->upload->display_errors());

				var_dump($error) . "<br>";
			}
		} else {
			$image_uni_settlement = "";
		}

		if ($_FILES['uni_cif_fam']['name'] != "") {

			$config['upload_path'] = 'assets/images/docuniversity/';
			$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG';

			$image_uni_cif_fam = date('dmYhis') . '_' . rand(0, 99999) . "." . pathinfo($_FILES['uni_cif_fam']['name'], PATHINFO_EXTENSION);

			$config['file_name'] = $image_uni_cif_fam;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('uni_cif_fam')) {
				$error = array('error' => $this->upload->display_errors());

				var_dump($error) . "<br>";
			}
		} else {
			$image_uni_cif_fam = "";
		}

		if ($_FILES['uni_dni_fam']['name'] != "") {

			$config['upload_path'] = 'assets/images/docuniversity/';
			$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG';

			$image_uni_dni_fam = date('dmYhis') . '_' . rand(0, 99999) . "." . pathinfo($_FILES['uni_dni_fam']['name'], PATHINFO_EXTENSION);

			$config['file_name'] = $image_uni_dni_fam;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('uni_dni_fam')) {
				$error = array('error' => $this->upload->display_errors());

				var_dump($error) . "<br>";
			}
		} else {
			$image_uni_dni_fam = "";
		}

		if ($_POST['person']) {
			$person = "2";
		} else {
			$person = "1";
			$uni_name_fam = "";
			$uni_last_fam = "";
			$uni_cift_fam = "";
			$uni_email_fam = "";
			$image_uni_cif_fam = "";
			$image_uni_dni_fam = "";
		}
		if ($type_process == "1") {
			$image_uni_grades = "";
		} elseif ($type_process == "2") {
			$image_uni_settlement = "";
		}
		$data_university = array(
			'user' => $this->session->userdata('user_id'),
			'uni_name_fam' => $uni_name_fam,
			'uni_last_fam' => $uni_last_fam,
			'uni_cift_fam' => $uni_cift_fam,
			'uni_email_fam' => $uni_email_fam,
			'university' => $university,
			'type_process' => $type_process,
			'uni_specialty' => $uni_specialty,
			'uni_tuition' => $image_uni_tuition,
			'uni_settlement' => $image_uni_settlement,
			'uni_cip' => $this->session->userdata('user_img_dni'),
			'uni_dni' => $this->session->userdata('user_img_cip'),
			'uni_cif_fam' => $image_uni_cif_fam,
			'uni_dni_fam' => $image_uni_dni_fam,
			'uni_grades' => $image_uni_grades,
			'uni_create_date' => date(DATE_W3C),
			'person' => $person,
			'grado' => $this->session->userdata('user_range'),
			'relationship' => $relationship,
			'service' => $service
		);

		$last_id = $this->Das_model->insert($data_university, 'tbl_data_univ');
		$data['rlt'] = $this->Das_model->relation();
		viewReportes('das/pdf-universidad/' . $last_id);


		redirect(base_url('das/pdf-universidad/' . $last_id));
	}

	public function editUniversity($id)
	{
		$data['range'] = $this->Das_model->auth_row('tbl_ranges', array('id_range' => $this->session->userdata('user_range')));

		$data['title'] = 'Editar Solicitud';
		$data['r'] = $this->Das_model->get_data(array('id_univ' => $id));

		$data['links'] = array(
			'<link href="' . base_url() . 'assets/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet">',
			'<link href="' . base_url() . 'assets/node_modules/switchery/dist/switchery.min.css" rel="stylesheet">'

		);
		$data['scripts'] = array(
			'<script src="' . base_url() . 'assets/node_modules/switchery/dist/switchery.min.js"></script>',
			'<script src="' . base_url() . 'dist/js/das.js"></script>',
			'<script> $(function () {
				var elems = Array.prototype.slice.call(document.querySelectorAll(".js-switch"));
				$(".js-switch").each(function () {
					new Switchery($(this)[0], $(this).data()); 
				});
			});</script>',

			'<script src="' . base_url() . 'assets/node_modules/dropify/dist/js/dropify.min.js"></script>',
			'<script>$(document).ready(function() {$(".dropify").dropify();});</script>',
			'<script>
				$(function () {
					$(".select2").select2();
				});
			</script>'
		);

		$rowData = $this->Das_model->get_data(array('id_univ' => $id));

		if ($rowData->person == "1") {
			$d = array(
				'check' => "",
				'style' => "style='display: none;'",
				'path' => base_url() . "assets/images/docuniversity/"
			);
		} else {
			$d = array(
				'check' => "checked",
				'style' => "",
				'path' => base_url() . "assets/images/docuniversity/"

			);
		}

		if ($rowData->type_process == "1") {
			$s = array(
				'Cdi' => "style='display: block;'",
				'Cdn' => "style='display: none;'",
			);
		} else {
			$s = array(
				'Cdi' => "style='display: none;'",
				'Cdn' => "style='display: block;'",
			);
		}

		$data['d'] = $d;
		$data['s'] = $s;

		$data['universities'] = $this->Das_model->get_universities();
		$data['rlt'] = $this->Das_model->relation();

		$this->template->load('admin/template', 'admin/das/university/edit', $data);
	}

	public function editUni()
	{

		$uni_name_fam = $this->input->post('uni_name_fam');
		$uni_last_fam = $this->input->post('uni_last_fam');
		$uni_cift_fam = $this->input->post('uni_cift_fam');
		$uni_email_fam = $this->input->post('uni_email_fam');

		$id_univ = $this->input->post('id_univ');

		$r = $this->Das_model->get_data(array('id_univ' => $id_univ));

		//Data University

		$type_process = $this->input->post('type_process');


		$university = $this->input->post('university');
		$uni_specialty = $this->input->post('uni_specialty');
		$relationship = $this->input->post('relationship');
		$service = $this->input->post('service');


		if ($_FILES['uni_grades']['name'] != "") {

			$config['upload_path'] = 'assets/images/docuniversity/';
			$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG';

			$image_uni_grades = date('dmYhis') . '_' . rand(0, 99999) . "." . pathinfo($_FILES['uni_grades']['name'], PATHINFO_EXTENSION);

			$config['file_name'] = $image_uni_grades;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('uni_grades')) {
				$error = array('error' => $this->upload->display_errors());

				var_dump($error) . "<br>";
			}
		} else {
			$image_uni_grades = $r->uni_grades;
		}


		if ($_FILES['uni_tuition']['name'] != "") {

			$config['upload_path'] = 'assets/images/docuniversity/';
			$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG';

			$image_uni_tuition = date('dmYhis') . '_' . rand(0, 99999) . "." . pathinfo($_FILES['uni_tuition']['name'], PATHINFO_EXTENSION);

			$config['file_name'] = $image_uni_tuition;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('uni_tuition')) {
				$error = array('error' => $this->upload->display_errors());

				var_dump($error) . "<br>";
			}
		} else {
			$image_uni_tuition = $r->uni_tuition;
		}


		if ($_FILES['uni_settlement']['name'] != "") {

			$config['upload_path'] = 'assets/images/docuniversity/';
			$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG';

			$image_uni_settlement = date('dmYhis') . '_' . rand(0, 99999) . "." . pathinfo($_FILES['uni_settlement']['name'], PATHINFO_EXTENSION);

			$config['file_name'] = $image_uni_settlement;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('uni_settlement')) {
				$error = array('error' => $this->upload->display_errors());

				var_dump($error) . "<br>";
			}
		} else {
			$image_uni_settlement = $r->uni_settlement;
		}

		if ($_FILES['uni_cif_fam']['name'] != "") {

			$config['upload_path'] = 'assets/images/docuniversity/';
			$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG';

			$image_uni_cif_fam = date('dmYhis') . '_' . rand(0, 99999) . "." . pathinfo($_FILES['uni_cif_fam']['name'], PATHINFO_EXTENSION);

			$config['file_name'] = $image_uni_cif_fam;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('uni_cif_fam')) {
				$error = array('error' => $this->upload->display_errors());

				var_dump($error) . "<br>";
			}
		} else {
			$image_uni_cif_fam = $r->uni_cif_fam;
		}


		if ($_FILES['uni_dni_fam']['name'] != "") {

			$config['upload_path'] = 'assets/images/docuniversity/';
			$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG';

			$image_uni_dni_fam = date('dmYhis') . '_' . rand(0, 99999) . "." . pathinfo($_FILES['uni_dni_fam']['name'], PATHINFO_EXTENSION);

			$config['file_name'] = $image_uni_dni_fam;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('uni_dni_fam')) {
				$error = array('error' => $this->upload->display_errors());

				var_dump($error) . "<br>";
			}
		} else {
			$image_uni_dni_fam = $r->uni_dni_fam;
		}

		if ($type_process == "1") {
			$image_uni_grades = "";
		} elseif ($type_process == "2") {
			$image_uni_settlement = "";
		}

		if (isset($_POST['person'])) {
			$person = "2";
		} else {
			$person = "1";
			$uni_name_fam = "";
			$uni_last_fam = "";
			$uni_cift_fam = "";
			$uni_email_fam = "";
			$image_uni_cif_fam = "";
			$image_uni_dni_fam = "";
			$relationship = "";
		}
		if ($type_process == "1") {
			$image_uni_grades = "";
		} elseif ($type_process == "2") {
			$image_uni_settlement = "";
		}

		$data_univ = array(
			'uni_name_fam' => $uni_name_fam,
			'uni_last_fam' => $uni_last_fam,
			'uni_cift_fam' => $uni_cift_fam,
			'uni_email_fam' => $uni_email_fam,
			'university' => $university,
			'type_process' => $type_process,
			'uni_specialty' => $uni_specialty,
			'uni_tuition' => $image_uni_tuition,
			'uni_settlement' => $image_uni_settlement,
			'uni_cif_fam' => $image_uni_cif_fam,
			'uni_dni_fam' => $image_uni_dni_fam,
			'uni_grades' => $image_uni_grades,
			'person' => $person,
			'relationship' => $relationship,
			'service' => $service
		);
		$last_id = $this->Das_model->update($data_univ, $id_univ, 'tbl_data_univ', 'id_univ');

		redirect(base_url('das/editar-solicitud/' . $id_univ));
	}

	public function institute()
	{
		$data['range'] = $this->Das_model->auth_row('tbl_ranges', array('id_range' => $this->session->userdata('user_range')));

		$data['title'] = 'Formulario Dace';
		$data['links'] = array(
			'<link href="' . base_url() . 'assets/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet">',
			'<link href="' . base_url() . 'assets/node_modules/switchery/dist/switchery.min.css" rel="stylesheet">'

		);
		$data['scripts'] = array(
			'<script src="' . base_url() . 'assets/node_modules/switchery/dist/switchery.min.js"></script>',
			'<script src="' . base_url() . 'dist/js/das.js"></script>',
			'<script> $(function () {
				var elems = Array.prototype.slice.call(document.querySelectorAll(".js-switch"));
				$(".js-switch").each(function () {
					new Switchery($(this)[0], $(this).data());
				});
			});</script>',

			'<script src="' . base_url() . 'assets/node_modules/dropify/dist/js/dropify.min.js"></script>',
			'<script>$(document).ready(function() {$(".dropify").dropify();});</script>',
			'<script>
				$(function () {
					$(".select2").select2();
				});
			</script>'
		);
		$data['rlt'] = $this->Das_model->relation();

		$data['institutes'] = $this->Das_model->get_institutes();
		$data['academies'] = $this->Das_model->get_academies();

		$this->template->load('admin/template', 'admin/das/institute/form_institute', $data);
	}

	public function editInstituto($id)
	{
		$data['range'] = $this->Das_model->auth_row('tbl_ranges', array('id_range' => $this->session->userdata('user_range')));

		$data['title'] = 'Editar Solicitud';
		$rowData = $this->Das_model->get_data_institute(array('id_ins' => $id));
		$data['r'] = $rowData;

		$data['links'] = array(
			'<link href="' . base_url() . 'assets/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet">',
			'<link href="' . base_url() . 'assets/node_modules/switchery/dist/switchery.min.css" rel="stylesheet">'

		);
		$data['scripts'] = array(
			'<script src="' . base_url() . 'assets/node_modules/switchery/dist/switchery.min.js"></script>',
			'<script src="' . base_url() . 'dist/js/das.js"></script>',
			'<script> $(function () {
				var elems = Array.prototype.slice.call(document.querySelectorAll(".js-switch"));
				$(".js-switch").each(function () {
					new Switchery($(this)[0], $(this).data()); 
				});
			});</script>',

			'<script src="' . base_url() . 'assets/node_modules/dropify/dist/js/dropify.min.js"></script>',
			'<script>$(document).ready(function() {$(".dropify").dropify();});</script>',
			'<script>
				$(function () {
					$(".select2").select2();
				});
			</script>'
		);
		if ($rowData->person == "1") {
			$d = array(
				'check' => "",
				'style' => "style='display: none;'",
				'path' => base_url() . "assets/images/docinstitute/"
			);
		} else {
			$d = array(
				'check' => "checked",
				'style' => "",
				'path' => base_url() . "assets/images/docinstitute/"

			);
		}
		$data['rlt'] = $this->Das_model->relation();

		$data['institutes'] = $this->Das_model->get_institutes();
		$data['academies'] = $this->Das_model->get_academies();
		$data['d'] = $d;

		$this->template->load('admin/template', 'admin/das/institute/edit', $data);
	}

	public function editIns()
	{
		//Data family
		$ins_name_fam = $this->input->post('ins_name_fam');
		$ins_last_fam = $this->input->post('ins_last_fam');
		$ins_cift_fam = $this->input->post('ins_cift_fam');
		$ins_email_fam = $this->input->post('ins_email_fam');

		//Data University

		$institute = $this->input->post('institut');
		$id_ins = $this->input->post('id_ins');

		$r = $this->Das_model->get_data_institute(array('id_ins' => $id_ins));

		$ins_specialty = $this->input->post('ins_specialty');
		$range = $this->input->post('range_user');
		$service = $this->input->post('service');

		$relationship = $this->input->post('relationship');

		if ($_FILES['ins_cif_fam']['name'] != "") {

			$config['upload_path'] = 'assets/images/docinstitute/';
			$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG';

			$image_ins_cif_fam = date('dmYhis') . '_' . rand(0, 99999) . "." . pathinfo($_FILES['ins_cif_fam']['name'], PATHINFO_EXTENSION);

			$config['file_name'] = $image_ins_cif_fam;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('ins_cif_fam')) {
				$error = array('error' => $this->upload->display_errors());

				var_dump($error) . "<br>";
			}
		} else {
			$image_ins_cif_fam = $r->ins_cif_fam;
		}
		if ($_FILES['ins_dni_fam']['name'] != "") {

			$config['upload_path'] = 'assets/images/docinstitute/';
			$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG';

			$image_ins_dni_fam = date('dmYhis') . '_' . rand(0, 99999) . "." . pathinfo($_FILES['ins_dni_fam']['name'], PATHINFO_EXTENSION);

			$config['file_name'] = $image_ins_dni_fam;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('ins_dni_fam')) {
				$error = array('error' => $this->upload->display_errors());

				var_dump($error) . "<br>";
			}
		} else {
			$image_ins_dni_fam = $r->ins_dni_fam;
		}

		if (isset($_POST['person'])) {
			$person = "2";
		} else {
			$person = "1";
			$ins_name_fam =  "";
			$ins_last_fam = "";
			$ins_cift_fam = "";
			$ins_email_fam = "";
			$image_ins_cif_fam = "";
			$image_ins_dni_fam = "";
			$relationship = "";
		}

		$data_institute = array(
			'user' => $this->session->userdata('user_id'),
			'institute' => $institute,
			'ins_name_fam' => $ins_name_fam,
			'ins_last_fam' => $ins_last_fam,
			'ins_cift_fam' => $ins_cift_fam,
			'ins_email_fam' => $ins_email_fam,
			'ins_specialty' => $ins_specialty,
			'ins_cif_fam' => $image_ins_cif_fam,
			'ins_dni_fam' => $image_ins_dni_fam,
			'ins_create_date' => date(DATE_W3C),
			'person' => $person,
			'ins_grade' => $range,
			'relationship' => $relationship,
			'service' => $service
		);

		$last_id = $this->Das_model->update($data_institute, $id_ins, 'tbl_data_institute', 'id_ins');

		redirect(base_url('das/editar-solicitud-instituto/' . $id_ins));
	}

	public function addInstitute()
	{
		//Data family
		$ins_name_fam = $this->input->post('ins_name_fam');
		$ins_last_fam = $this->input->post('ins_last_fam');
		$ins_cift_fam = $this->input->post('ins_cift_fam');
		$ins_email_fam = $this->input->post('ins_email_fam');

		//Data University

		$institute = $this->input->post('institut');
		$ins_specialty = $this->input->post('ins_specialty');
		$range = $this->input->post('range_user');
		$relationship = $this->input->post('relationship');
		$service = $this->input->post('service');


		if ($_FILES['ins_cif_fam']['name'] != "") {

			$config['upload_path'] = 'assets/images/docinstitute/';
			$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG';

			$image_ins_cif_fam = date('dmYhis') . '_' . rand(0, 99999) . "." . pathinfo($_FILES['ins_cif_fam']['name'], PATHINFO_EXTENSION);

			$config['file_name'] = $image_ins_cif_fam;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('ins_cif_fam')) {
				$error = array('error' => $this->upload->display_errors());

				var_dump($error) . "<br>";
			}
		} else {
			$image_ins_cif_fam = "";
		}
		if ($_FILES['ins_dni_fam']['name'] != "") {

			$config['upload_path'] = 'assets/images/docinstitute/';
			$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG';

			$image_ins_dni_fam = date('dmYhis') . '_' . rand(0, 99999) . "." . pathinfo($_FILES['ins_dni_fam']['name'], PATHINFO_EXTENSION);

			$config['file_name'] = $image_ins_dni_fam;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('ins_dni_fam')) {
				$error = array('error' => $this->upload->display_errors());

				var_dump($error) . "<br>";
			}
		} else {
			$image_ins_dni_fam = "";
		}

		if (isset($_POST['person'])) {
			$person = "2";
		} else {
			$person = "1";
			$ins_name_fam =  "";
			$ins_last_fam = "";
			$ins_cift_fam = "";
			$ins_email_fam = "";
			$image_ins_cif_fam = "";
			$image_ins_dni_fam = "";
			$relationship = "";
		}
		$data_institute = array(
			'user' => $this->session->userdata('user_id'),
			'institute' => $institute,
			'ins_name_fam' => $ins_name_fam,
			'ins_last_fam' => $ins_last_fam,
			'ins_cift_fam' => $ins_cift_fam,
			'ins_email_fam' => $ins_email_fam,
			'ins_specialty' => $ins_specialty,
			'ins_cip' => $this->session->userdata('user_img_dni'),
			'ins_dni' => $this->session->userdata('user_img_cip'),
			'ins_cif_fam' => $image_ins_cif_fam,
			'ins_dni_fam' => $image_ins_dni_fam,
			'ins_create_date' => date(DATE_W3C),
			'person' => $person,
			'ins_grade' => $range,
			'relationship' => $relationship,
			'service' => $service

		);

		$last_id = $this->Das_model->insert($data_institute, 'tbl_data_institute');
		viewReportes('das/pdf-instituto/' . $last_id);

		redirect(base_url('das/pdf-instituto/' . $last_id));
	}

	public function pdf_institute($id)
	{
		$data['request'] = $this->Das_model->get_data_institute(array('id_ins' => $id));
		$this->load->view('admin/das/institute/pdf', $data);
	}

	public function britanico()
	{
		$data['range'] = $this->Das_model->auth_row('tbl_ranges', array('id_range' => $this->session->userdata('user_range')));

		$data['title'] = 'Formulario Dace Britanico';
		$data['links'] = array(
			'<link href="' . base_url() . 'assets/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet">',
			'<link href="' . base_url() . 'assets/node_modules/switchery/dist/switchery.min.css" rel="stylesheet">'

		);
		$data['scripts'] = array(
			'<script src="' . base_url() . 'assets/node_modules/switchery/dist/switchery.min.js"></script>',
			'<script src="' . base_url() . 'dist/js/das.js"></script>',
			'<script> $(function () {
				var elems = Array.prototype.slice.call(document.querySelectorAll(".js-switch"));
				$(".js-switch").each(function () {
					new Switchery($(this)[0], $(this).data());
				});
			});</script>',

			'<script src="' . base_url() . 'assets/node_modules/dropify/dist/js/dropify.min.js"></script>',
			'<script>$(document).ready(function() {$(".dropify").dropify();});</script>',
			'<script>
				$(function () {
					$(".select2").select2();
				});
			</script>'
		);
		$data['rlt'] = $this->Das_model->relation();

		$this->template->load('admin/template', 'admin/das/britanico/form_britanico', $data);
	}

	public function addBritanico()
	{
		//Data family


		$bri_name_fam = $this->input->post('bri_name_fam');
		$bri_last_fam = $this->input->post('bri_last_fam');
		$bri_cift_fam = $this->input->post('bri_cift_fam');
		$bri_email_fam = $this->input->post('bri_email_fam');


		//Data University

		$bri_specialty = $this->input->post('bri_specialty');
		$range = $this->input->post('range_user');
		$relationship = $this->input->post('relationship');

		$service = $this->input->post('service');

		if ($_FILES['bri_settlement']['name'] != "") {

			$config['upload_path'] = 'assets/images/docbritanico/';
			$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG';

			$image_bri_settlement = date('dmYhis') . '_' . rand(0, 99999) . "." . pathinfo($_FILES['bri_settlement']['name'], PATHINFO_EXTENSION);

			$config['file_name'] = $image_bri_settlement;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('bri_settlement')) {
				$error = array('error' => $this->upload->display_errors());

				var_dump($error) . "<br>";
			}
		} else {
			$image_bri_settlement = "";
		}

		if ($_FILES['bri_cif_fam']['name'] != "") {

			$config['upload_path'] = 'assets/images/docbritanico/';
			$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG';

			$image_bri_cif_fam = date('dmYhis') . '_' . rand(0, 99999) . "." . pathinfo($_FILES['bri_cif_fam']['name'], PATHINFO_EXTENSION);

			$config['file_name'] = $image_bri_cif_fam;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('bri_cif_fam')) {
				$error = array('error' => $this->upload->display_errors());

				var_dump($error) . "<br>";
			}
		} else {
			$image_bri_cif_fam = "";
		}
		if ($_FILES['bri_dni_fam']['name'] != "") {

			$config['upload_path'] = 'assets/images/docbritanico/';
			$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG';

			$image_bri_dni_fam = date('dmYhis') . '_' . rand(0, 99999) . "." . pathinfo($_FILES['bri_dni_fam']['name'], PATHINFO_EXTENSION);

			$config['file_name'] = $image_bri_dni_fam;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('bri_dni_fam')) {
				$error = array('error' => $this->upload->display_errors());

				var_dump($error) . "<br>";
			}
		} else {
			$image_bri_dni_fam = "";
		}
		if ($_POST['person']) {
			$person = "2";
		} else {
			$person = "1";
			$bri_name_fam = "";
			$bri_last_fam = "";
			$bri_cift_fam = "";
			$bri_email_fam = "";
			$image_bri_cif_fam = "";
			$image_bri_dni_fam = "";
			$relationship = "";
		}
		$data_britanico = array(
			'user' => $this->session->userdata('user_id'),
			'bri_name_fam' => $bri_name_fam,
			'bri_last_fam' => $bri_last_fam,
			'bri_cift_fam' => $bri_cift_fam,
			'bri_email_fam' => $bri_email_fam,
			'bri_specialty' => $bri_specialty,
			'bri_settlement' => $image_bri_settlement,
			'bri_cip' => $this->session->userdata('user_img_dni'),
			'bri_dni' => $this->session->userdata('user_img_cip'),
			'bri_cif_fam' => $image_bri_cif_fam,
			'bri_dni_fam' => $image_bri_dni_fam,
			'bri_create_date' => date(DATE_W3C),
			'person' => $person,
			'bri_grade' => $range,
			'relationship' => $relationship,
			'service' => $service
		);

		$last_id = $this->Das_model->insert($data_britanico, 'tbl_data_britanico');
		viewReportes('das/pdf-britanico/' . $last_id);

		redirect(base_url('das/pdf-britanico/' . $last_id));
	}

	public function editBritanico($id)
	{
		$data['range'] = $this->Das_model->auth_row('tbl_ranges', array('id_range' => $this->session->userdata('user_range')));
		$data['rlt'] = $this->Das_model->relation();

		$data['title'] = 'Editar consulta Britanico';
		$data['links'] = array(
			'<link href="' . base_url() . 'assets/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet">',
			'<link href="' . base_url() . 'assets/node_modules/switchery/dist/switchery.min.css" rel="stylesheet">'

		);
		$data['scripts'] = array(
			'<script src="' . base_url() . 'assets/node_modules/switchery/dist/switchery.min.js"></script>',
			'<script src="' . base_url() . 'dist/js/das.js"></script>',
			'<script> $(function () {
				var elems = Array.prototype.slice.call(document.querySelectorAll(".js-switch"));
				$(".js-switch").each(function () {
					new Switchery($(this)[0], $(this).data());
				});
			});</script>',

			'<script src="' . base_url() . 'assets/node_modules/dropify/dist/js/dropify.min.js"></script>',
			'<script>$(document).ready(function() {$(".dropify").dropify();});</script>',
			'<script>
				$(function () {
					$(".select2").select2();
				});
			</script>'
		);
		$rowData = $this->Das_model->get_data_britanico(array('id_bri' => $id));
		$data['r'] = $rowData;

		if ($rowData->person == "1") {
			$d = array(
				'check' => "",
				'style' => "style='display: none;'",
				'path' => base_url() . "assets/images/docbritanico/"
			);
		} else {
			$d = array(
				'check' => "checked",
				'style' => "",
				'path' => base_url() . "assets/images/docbritanico/"

			);
		}
		$data['d'] = $d;

		$this->template->load('admin/template', 'admin/das/britanico/edit', $data);
	}

	public function editBri()
	{
		$bri_name_fam = $this->input->post('bri_name_fam');
		$bri_last_fam = $this->input->post('bri_last_fam');
		$bri_cift_fam = $this->input->post('bri_cift_fam');
		$bri_email_fam = $this->input->post('bri_email_fam');


		//Data University
		$id_bri = $this->input->post('id_bri');

		$r = $this->Das_model->get_data_britanico(array('id_bri' => $id_bri));
		$bri_specialty = $this->input->post('bri_specialty');
		$range = $this->input->post('range_user');
		$relationship = $this->input->post('relationship');
		$service = $this->input->post('service');


		if ($_FILES['bri_settlement']['name'] != "") {

			$config['upload_path'] = 'assets/images/docbritanico/';
			$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG';

			$image_bri_settlement = date('dmYhis') . '_' . rand(0, 99999) . "." . pathinfo($_FILES['bri_settlement']['name'], PATHINFO_EXTENSION);

			$config['file_name'] = $image_bri_settlement;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('bri_settlement')) {
				$error = array('error' => $this->upload->display_errors());

				var_dump($error) . "<br>";
			}
		} else {
			$image_bri_settlement = $r->bri_settlement;
		}

		if ($_FILES['bri_cif_fam']['name'] != "") {

			$config['upload_path'] = 'assets/images/docbritanico/';
			$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG';

			$image_bri_cif_fam = date('dmYhis') . '_' . rand(0, 99999) . "." . pathinfo($_FILES['bri_cif_fam']['name'], PATHINFO_EXTENSION);

			$config['file_name'] = $image_bri_cif_fam;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('bri_cif_fam')) {
				$error = array('error' => $this->upload->display_errors());

				var_dump($error) . "<br>";
			}
		} else {
			$image_bri_cif_fam = $r->bri_cif_fam;
		}
		if ($_FILES['bri_dni_fam']['name'] != "") {

			$config['upload_path'] = 'assets/images/docbritanico/';
			$config['allowed_types'] = 'jpg|png|jpeg|PNG|JPG|JPEG';

			$image_bri_dni_fam = date('dmYhis') . '_' . rand(0, 99999) . "." . pathinfo($_FILES['bri_dni_fam']['name'], PATHINFO_EXTENSION);

			$config['file_name'] = $image_bri_dni_fam;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('bri_dni_fam')) {
				$error = array('error' => $this->upload->display_errors());

				var_dump($error) . "<br>";
			}
		} else {
			$image_bri_dni_fam = $r->bri_dni_fam;
		}
		if (isset($_POST['person'])) {
			$person = "2";
		} else {
			$person = "1";
			$bri_name_fam = "";
			$bri_last_fam = "";
			$bri_cift_fam = "";
			$bri_email_fam = "";
			$image_bri_cif_fam = "";
			$image_bri_dni_fam = "";
			$relationship = "";
		}
		$data_britanico = array(
			'user' => $this->session->userdata('user_id'),
			'bri_name_fam' => $bri_name_fam,
			'bri_last_fam' => $bri_last_fam,
			'bri_cift_fam' => $bri_cift_fam,
			'bri_email_fam' => $bri_email_fam,
			'bri_specialty' => $bri_specialty,
			'bri_settlement' => $image_bri_settlement,
			'bri_cif_fam' => $image_bri_cif_fam,
			'bri_dni_fam' => $image_bri_dni_fam,
			'bri_create_date' => date(DATE_W3C),
			'person' => $person,
			'bri_grade' => $range,
			'relationship' => $relationship,
			'service' => $service


		);


		$last_id = $this->Das_model->update($data_britanico, $id_bri, 'tbl_data_britanico', 'id_bri');

		redirect(base_url('das/editar-solicitud-britanico/' . $id_bri));
	}

	public function pdf_britanico($id)
	{
		$data['request'] = $this->Das_model->get_data_britanico(array('id_bri' => $id));
		$this->load->view('admin/das/britanico/pdf', $data);
	}


	public function deleteUni()
	{

		$id =  $this->input->post("delete_id");
		$r = $this->Das_model->get_data(array('id_univ' => $id));
		$path = "assets/images/docuniversity/";

		if ($r->uni_tuition) {
			unlink($path . $r->uni_tuition);
		}
		if ($r->uni_settlement) {
			unlink($path . $r->uni_settlement);
		}
		if ($r->uni_cif_fam) {
			unlink($path . $r->uni_cif_fam);
		}
		if ($r->uni_dni_fam) {
			unlink($path . $r->uni_dni_fam);
		}
		if ($r->uni_grades) {
			unlink($path . $r->uni_grades);
		}
		$this->Das_model->delete('tbl_data_univ', $id, 'id_univ');

		redirect(base_url('Das/Lista'));
	}
	public function deleteIns()
	{

		$id =  $this->input->post("delete_id2");
		$r = $this->Das_model->get_data_institute(array('id_ins' => $id));
		$path = "assets/images/docinstitute/";

		if ($r->ins_settlement) {
			unlink($path . $r->ins_settlement);
		}
		if ($r->ins_cif_fam) {
			unlink($path . $r->ins_cif_fam);
		}
		if ($r->ins_dni_fam) {
			unlink($path . $r->ins_dni_fam);
		}

		$this->Das_model->delete('tbl_data_institute', $id, 'id_ins');

		redirect(base_url('Das/Lista'));
	}
	public function deleteBri()
	{

		$id =  $this->input->post("delete_id3");
		$r = $this->Das_model->get_data_britanico(array('id_bri' => $id));
		$path = "assets/images/docbritanico/";

		if ($r->bri_settlement) {
			unlink($path . $r->bri_settlement);
		}

		if ($r->bri_cif_fam) {
			unlink($path . $r->bri_cif_fam);
		}
		if ($r->bri_dni_fam) {
			unlink($path . $r->bri_dni_fam);
		}

		$this->Das_model->delete('tbl_data_britanico', $id, 'id_bri');

		redirect(base_url('Das/Lista'));
	}
}
