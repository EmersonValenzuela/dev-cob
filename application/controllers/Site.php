<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Site extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		$this->load->model('Admin_model');
	}

	public function index()
	{

		if ($this->session->userdata('user_type') == "2") {
			if ($this->session->userdata('signature_user') == "assets/images/no-photo.jpg" || $this->session->userdata('user_img_cip') == "assets/images/no-photo.jpg" || $this->session->userdata('user_img_dni') == "assets/images/no-photo.jpg") {
				redirect(base_url() . 'mi-perfil', 'refresh');
			} else {
				redirect(base_url() . 'admin', 'refresh');
			}
		} elseif ($this->session->userdata('is_user_login') == "1") {
			if ($this->session->userdata('core') == '2') {
				redirect(base_url() . 'copere', 'refresh');
			} else {
				redirect(base_url() . 'be/admin', 'refresh');
			}
		}
		$this->load->view('login');
	}

	public function verifyPass()
	{
		$id = md5($this->input->post('id'));
		$pass = $this->input->post('pass');
		$jsonData = array();
		$rowData = $this->Admin_model->auth_user_login(array('encrypt_cip' => $id));

		if ($rowData->password == null) {
			$this->Admin_model->update(array('password' => $pass), $rowData->id_user, 'tbl_users');
			$jsonData['password'] = $pass;
		} else {
			$jsonData['password'] = $rowData->password;
		}

		$jsonData['phone_user'] = $rowData->phone_user;
		//Mostrando mi respuesta en formato Json
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsonData);
	}

	public function login($data)
	{

		$cip = $data;

		$rowData = $this->Admin_model->auth_user_login(array('phone_user' => $cip));

		if ($rowData->rol == "2") {
			$data = array(
				'cip_md5' => $rowData->encrypt_cip,
				'user_id' => $rowData->id_user,
				'user_type' => $rowData->rol,
				'user_name' => $rowData->name_user,
				'user_lastname' => $rowData->lastname_user,
				'user_email' => $rowData->email_user,
				'user_phone' => $rowData->phone_user,
				'user_cip' => $this->encryption->decrypt($rowData->cip_user),
				'user_dni' => $rowData->dni_user,
				'is_user_login' => "2",
				'user_range' => $rowData->range_user,
				'user_signature' => $rowData->signature_user,
				'user_img_dni' => $rowData->dni_image_user,
				'user_img_cip' => $rowData->cip_image_user,
				'user_img_profile' => $rowData->img_user,
				'val_user' => $rowData->val_user,
				'condition_user' => $rowData->condition_user,
				'img_signature' => $rowData->signature_user,
				'img_dni' => $rowData->dni_image_user,
				'img_cip' => $rowData->cip_image_user,
				'core' => $rowData->core,
				'user_cgi' => $rowData->cgi_status
			);
			$this->session->set_userdata($data);

			if ($rowData->signature_user == "assets/images/no-photo.jpg" || $rowData->dni_image_user == "assets/images/no-photo.jpg" || $rowData->cip_image_user == "assets/images/no-photo.jpg") {
				redirect(base_url() . 'mi-perfil', 'refresh');
			} else {
				redirect(base_url() . 'admin', 'refresh');
			}
		} elseif ($rowData->rol != "2") {
			$data = array(
				'cip_md5' => $rowData->encrypt_cip,
				'user_id' => $rowData->id_user,
				'user_type' => $rowData->rol,
				'user_name' => $rowData->name_user,
				'user_lastname' => $rowData->lastname_user,
				'user_email' => $rowData->email_user,
				'user_phone' => $rowData->phone_user,
				'user_cip' => $this->encryption->decrypt($rowData->cip_user),
				'user_dni' => $rowData->dni_user,
				'is_user_login' => "1",
				'user_range' => $rowData->range_user,
				'user_signature' => $rowData->signature_user,
				'user_img_dni' => $rowData->dni_image_user,
				'user_img_cip' => $rowData->cip_image_user,
				'user_img_profile' => $rowData->img_user,
				'val_user' => $rowData->val_user,
				'condition_user' => $rowData->condition_user,
				'img_signature' => $rowData->signature_user,
				'img_dni' => $rowData->dni_image_user,
				'img_cip' => $rowData->cip_image_user,
				'core' => $rowData->core,
				'user_cgi' => $rowData->cgi_status

			);
			$this->session->set_userdata($data);

			if ($rowData->core == '2') {
				redirect(base_url() . 'copere', 'refresh');
			} else {
				redirect(base_url() . 'be/admin', 'refresh');
			}
		} else {
			redirect(base_url(), 'refresh');
		}

		$this->load->view('login');
	}

	public function register()
	{
		$data['range1'] = $this->Admin_model->get_ranges(array('category_range' => '1'));
		$data['range2'] = $this->Admin_model->get_ranges(array('category_range' => '2'));
		$data['range3'] = $this->Admin_model->get_ranges(array('category_range' => '3'));
		$this->load->view('register', $data);
	}

	public function initReg()
	{
		$cip = $this->encryption->encrypt($this->input->post('cip'));
		$encrypt_cip = md5($this->input->post('cip'));
		$cgi = "";
		if ($this->input->post('switch_cgi') == true) {
			$cgi = 1;
		} else {
			$cgi = 0;
		}
		$rowData = $this->Admin_model->auth_user_login(array('rol' => '2', 'cip_user' => $cip));

		if (empty($rowData)) {
			$data = array(
				'rol' => '2',
				'cip_user' => $cip,
				'encrypt_cip' => $encrypt_cip,
				'dni_user' => $this->encryption->encrypt($this->input->post('dni')),
				'name_user' => $this->input->post('name'),
				'lastname_user' => $this->input->post('lastname'),
				'email_user' => $this->input->post('email'),
				'phone_user' => $this->input->post('phone'),
				'cip_image_user' =>	"assets/images/no-photo.jpg",
				'dni_image_user' =>	"assets/images/no-photo.jpg",
				'create_user' => date(DATE_W3C),
				'condition_user' => '0',
				'val_user' => "1",
				'range_user' => $this->input->post('range_user'),
				'signature_user' => "assets/images/no-photo.jpg",
				'img_user' => "assets/images/no-image.png",
				'cgi_status' => $cgi
			);

			$data = $this->security->xss_clean($data);
			$result = $this->Admin_model->insert($data, 'tbl_users');
			$this->Admin_model->insert(array('user_staff' => $encrypt_cip), 'tbl_staff');


			if ($result) {
				$jsonData['status'] = 1;
				//Mostrando mi respuesta en formato Json
				header('Content-type: application/json; charset=utf-8');
				echo json_encode($jsonData);
			}
		}
	}

	public function authentication($data)
	{
		$rowData = $this->Admin_model->auth_user_login(array('rol' => '2', 'encrypt_cip' => md5($data)));
		$Data['phone_user'] = $rowData->phone_user;
		$this->load->view('authentication', $Data);
	}
	public function token($code)
	{
		$data['code'] =  $code;

		$rowData = $this->Admin_model->auth_user_login(array('phone_user' => $code));

		$data = array(
			'condition_user' => 1
		);
		$id = $rowData->id_user;

		$this->Admin_model->update($data, $id, 'tbl_users');

		if (!empty($rowData)) {

			$data = array(
				'user_id' => $rowData->id_user,
				'user_type' => $rowData->rol,
				'user_name' => $rowData->name_user,
				'user_lastname' => $rowData->lastname_user,
				'user_email' => $rowData->email_user,
				'user_phone' => $rowData->phone_user,
				'user_cip' => $this->encryption->decrypt($rowData->cip_user),
				'user_dni' => $rowData->dni_user,
				'is_user_login' => "2",
				'user_range' => $rowData->range_user,
				'user_signature' => $rowData->signature_user,
				'user_img_dni' => $rowData->dni_image_user,
				'user_img_cip' => $rowData->cip_image_user,
				'user_img_profile' => $rowData->img_user,
				'val_user' => $rowData->val_user,
				'condition_user' => $rowData->condition_user
			);

			$this->session->set_userdata($data);

			redirect(base_url(), 'refresh');
		} else {
			echo "No encontramos nada";
		}
	}


	public function confirm_mail($data)
	{
		$this->load->view('confirm', $data);
	}

	public function resend_mail()
	{
		$data['cip'] =  $this->input->post('cip');
		$data['code'] = $this->input->post('code');

		$this->load->view('confirm', $data);
	}


	public function reception($code = null)
	{

		$this->load->view('email');
	}

	public function check_mail($code)
	{
		$data['code'] =  $code;

		$rowData = $this->Admin_model->auth_user_login(array('rol' => '2', 'cod_validation_user' => $code));

		if (!empty($rowData)) {

			$data = array(
				'user_id' => $rowData->id_user,
				'user_type' => $rowData->rol,
				'user_name' => $rowData->name_user,
				'lastname_user' => $rowData->lastname_user,
				'user_email' => $rowData->email_user,
				'user_phone' => $rowData->phone_user,
				'user_cip' => $rowData->cip_user,
				'user_dni' => $rowData->dni_user,
				'is_user_login' => TRUE,
				'user_range' => $rowData->range_user,
				'user_signature' => $rowData->signature_user,
				'user_dni' => $rowData->cip_image_user,
				'user_cip' => $rowData->dni_image_user
			);

			$this->session->set_userdata($data);

			redirect('/', 'refresh');
		} else {
			echo "No encontramos nada";
		}
	}

	public function logout()
	{
		$array_items = array('user_id', 'user_type', 'user_name', 'user_email', 'user_phone', 'user_cip', 'user_dni', 'is_user_login', 'signature_user', 'cod_validation');

		$this->session->unset_userdata($array_items);

		if (isset($_SERVER['HTTP_REFERER']))
			redirect($_SERVER['HTTP_REFERER']);
		else
			redirect('/', 'refresh');
	}

	public function validateCip()
	{
		$cip    = md5($_GET['cip']);
		$jsonData = array();
		$rowData = $this->Admin_model->validate(array('encrypt_cip' => $cip));

		//Validamos que la consulta haya retornado información
		if ($rowData <= 0) {
			$jsonData['success'] = 0;
			// $jsonData['message'] = 'No existe Cédula ' .$cedula;
			$jsonData['message'] = '';
		} else {
			//Si hay datos entonces retornas algo
			$jsonData['success'] = 1;
			$jsonData['message'] = '<p style="color:red;">Ya esta en uso el CIP  <strong>(' . $_GET['cip'] . ')<strong></p>';
		}

		//Mostrando mi respuesta en formato Json
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsonData);
	}

	public function validateMail()
	{
		$mail  = $_GET['mail'];
		$jsonData = array();
		$rowData = $this->Admin_model->validate(array('email_user' => $mail));

		//Validamos que la consulta haya retornado información
		if ($rowData <= 0) {
			$jsonData['success'] = 0;
			// $jsonData['message'] = 'No existe Cédula ' .$cedula;
			$jsonData['message'] = '';
		} else {
			//Si hay datos entonces retornas algo
			$jsonData['success'] = 1;
			$jsonData['message'] = '<p style="color:red;">Ya esta en uso el Correo <strong>(' . $_GET['mail'] . ')<strong></p>';
		}

		//Mostrando mi respuesta en formato Json
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsonData);
	}

	public function validatePhone()
	{

		$phone    = $_GET['phone'];
		$jsonData = array();
		$rowData = $this->Admin_model->validate(array('phone_user' => $phone));

		//Validamos que la consulta haya retornado información
		if ($rowData <= 0) {
			$jsonData['success'] = 0;
			// $jsonData['message'] = 'No existe Cédula ' .$cedula;
			$jsonData['message'] = '';
		} else {
			//Si hay datos entonces retornas algo
			$jsonData['success'] = 1;
			$jsonData['message'] = '<p style="color:red;">Ya esta en uso el Número  <strong>(' . $_GET['phone'] . ')<strong></p>';
		}

		//Mostrando mi respuesta en formato Json
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsonData);
	}
	public function validateDni()
	{

		$dni    = $_GET['dni'];
		$jsonData = array();
		$rowData = $this->Admin_model->validate(array('dni_user' => $dni));

		//Validamos que la consulta haya retornado información
		if ($rowData <= 0) {
			$jsonData['success'] = 0;
			// $jsonData['message'] = 'No existe Cédula ' .$cedula;
			$jsonData['message'] = '';
		} else {
			//Si hay datos entonces retornas algo
			$jsonData['success'] = 1;
			$jsonData['message'] = '<p style="color:red;">Ya esta en uso el DNI  <strong>(' . $_GET['dni'] . ')<strong></p>';
		}

		//Mostrando mi respuesta en formato Json
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsonData);
	}
	public function existsCip()
	{

		$mail  = $_GET['cip'];
		$jsonData = array();
		$rowData = $this->Admin_model->validate(array('encrypt_cip' => md5($mail)));

		//Validamos que la consulta haya retornado información
		if ($rowData <= 0) {
			$jsonData['success'] = 0;
			// $jsonData['message'] = 'No existe Cédula ' .$cedula;
			$jsonData['message'] = '<p style="color:red;"><strong>CIP no se encuentra registrado<strong></p>';
		} else {
			//Si hay datos entonces retornas algo
			$row = $this->Admin_model->auth_user_login(array('encrypt_cip' => md5($mail)));
			$phone = $row->phone_user;
			$jsonData['status'] = $row->val_user;
			$jsonData['phone'] = $phone;
			$jsonData['success'] = 1;
			$jsonData['message'] = '';
		}

		//Mostrando mi respuesta en formato Json
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($jsonData);
	}
}
