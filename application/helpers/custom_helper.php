<?php
if (!function_exists('check_login_user')) {
  function check_login_user()
  {
    $ci = get_instance();
    if ($ci->session->userdata('is_user_login') != TRUE) {

      $array_items = array('cip_md5', 'user_id', 'user_type', 'user_name', 'user_email', 'user_phone', 'user_cip', 'user_dni', 'is_user_login', 'core');

      $ci->session->sess_destroy();

      redirect(base_url());
    }
  }
}

function file_exists_safe($file)
{
  if (!$fd = fopen($file, 'xb')) {
    return true;  // the file already exists
  }
  fclose($fd);  // the file is now created, we don't need the file handler
  return false;
}

if (!function_exists("fecha")) {
  function fecha($fecha)
  {
    $dia = substr($fecha, 8, 2);
    $mes = substr($fecha, 5, 2);
    $anio = substr($fecha, 0, 4);
    switch ($mes) {
      case '01':
        $mes = "Enero";
        break;
      case '02':
        $mes = "Febrero";
        break;
      case '03':
        $mes = "Marzo";
        break;
      case '04':
        $mes = "Abril";
        break;
      case '05':
        $mes = "Mayo";
        break;
      case '06':
        $mes = "Junio";
        break;
      case '07':
        $mes = "Julio";
        break;
      case '08':
        $mes = "Agosto";
        break;
      case '09':
        $mes = "Septiembre";
        break;
      case '10':
        $mes = "Octubre";
        break;
      case '11':
        $mes = "Noviembre";
        break;
      case '12':
        $mes = "Diciembre";
        break;
    }
    $fecha = $dia . " de " . $mes . " de " . $anio;
    return $fecha;
  }
}


function generate_string($input, $strength)
{
  $input_length = strlen($input);
  $random_string = '';
  for ($i = 0; $i < $strength; $i++) {
    $random_character = $input[mt_rand(0, $input_length - 1)];
    $random_string .= $random_character;
  }
  return $random_string;
}
if (!function_exists("qr")) {
  function qr($url, $url2, $id)
  {
    require('phpqrcode/qrlib.php');
    QRcode::png($url2, $url, QR_ECLEVEL_L, 3, 0);
  }
}
if (!function_exists('get_random_password')) {
  function get_random_password($chars_min = 6, $chars_max = 8, $use_upper_case = false, $include_numbers = false, $include_special_chars = false)
  {
    $length = rand($chars_min, $chars_max);
    $selection = 'aeuoyibcdfghjklmnpqrstvwxz';
    if ($include_numbers) {
      $selection .= "1234567890";
    }
    if ($include_special_chars) {
      $selection .= "!@\" #$%&[]{}?|";
    }
    $password = "";
    for ($i = 0; $i < $length; $i++) {
      $current_letter = $use_upper_case ? (rand(0, 1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];
      $password .= $current_letter;
    }
    return $password;
  }
}
if (!function_exists('check_user')) {
  function check_user()
  {
    $ci = get_instance();
    if ($ci->session->userdata('user_type') != 1 || $ci->session->userdata('user_type') != 26) {

      return true;
    }
  }
}

function viewReportes($url)
{
  $subject = "Consultas COBIENE CONVENIOS";

  $emailsSend = ["beto1perk@gmail.com", "valenestradam1@gmail.com"];

  $to = "$emailsSend[0],$emailsSend[1]";

  $message = "
  <html>

  <head>
    <meta charset='gb18030'>
    <title>Consultas COEDE</title>
  </head>

  <body>
    <h3>Actualemente en la plataforma de convenios del COBIENE, han solicitado un tramite, Ingrese a la siguiente URL: " . base_url() . $url . "</h3><br>
    <center>
      <img src='https://tramites.cobiene.mil.pe/assets/images/cob.png' width='50%' heigth='50%'>
    </center>
  </body>

  </html>
  ";
  $headers = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'From: CONVENIOS COBIENE <contacto@cobiene.mil.pe>' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

  mail($to, $subject, $message, $headers);
}

function viewExtension($extension, $name, $id_frwrd, $path)
{
  $files_ext = array(
    'pdf' =>
    '<i class="fa fa-file-pdf-o text-danger"></i>',

    'zip' =>
    '<i class="fa fa-file-zip-o text-primary"></i>',

    'rar' =>
    '<i class="fa fa-file-zip-o text-primary"></i>',

    'ppt' =>
    '<i class="fa fa-file-powerpoint-o text-warning"></i>',

    'xlsx' =>
    '<i class="fa fa-file-excel-o text-success"></i>',

    'xls' =>
    '<i class="fa fa-file-excel-o text-success"></i>',

    'docx' =>
    '<i class="fa fa-file-word-o text-info"></i>',

    'txt' =>
    '<i class="fa fa-file-code-o text-primary"></i>',

    'sql' =>
    '<i class="fa fa-file-code-o text-primary"></i>'
  );

  $img_ext = array(
    'jpg' =>
    '<img class="img-responsive" src="' . base_url() . 'assets/files/' . $path . '/' . $id_frwrd . '/' . $name . '">',

    'png' =>
    '<img class="img-responsive" src="' . base_url() . 'assets/files/' . $path . '/' . $id_frwrd . '/' . $name . '">',

    'jpeg' =>
    '<img class="img-responsive" src="' . base_url() . 'assets/files/' . $path . '/' . $id_frwrd . '/' . $name . '">',

    'svg' =>
    '<img class="img-responsive" src="' . base_url() . 'assets/files/' . $path . '/' . $id_frwrd . '/' . $name . '">',
  );

  if (array_key_exists($extension, $files_ext)) {
    return $files_ext[$extension];
  } elseif (array_key_exists($extension, $img_ext)) {
    return $img_ext[$extension];
  } else {
    return '<i class="fa fa-file text-primary"></i>';
  }
}

function status_order($status, $id)
{
  if ($status == '01') {
    echo '<button OnClick="edit(' . $id . ')" class="btn btn-info">Pendiente</button>';
  } elseif ($status == '02') {
    echo '<button OnClick="edit(' . $id . ')" class="btn btn-warning">En Proceso</button>';
  } elseif ($status == '03') {
    echo '<button OnClick="edit(' . $id . ')" class="btn btn-success">Finalizado</button>';
  } elseif ($status == '04') {
    echo '<button OnClick="edit(' . $id . ')" class="btn btn-danger">Cancelado</button>';
  }
}

function status_received($status, $id, $id_frwrd, $url = "be")
{
  if ($status == 1) {
    echo '<td><span class="btn btn-danger">No Decretado</span></td>';
  } elseif ($status == 2) {
    echo '<td><a href="' . base_url($url . '/ver-decreto/' . $id) . '" class="btn btn-warning" target="_blank">Pendiente</a></td>';
  } elseif ($status == 3) {
    echo '<td><a href="' . base_url($url . '/archivos-adjuntos?id=' . $id_frwrd) . '" class="btn btn-info" target="_blank">En Proceso</a></td>';
  } elseif ($status == 4) {
    echo '<td><a href="' . base_url($url . '/archivos-adjuntos?id=' . $id_frwrd) . '" class="btn btn-success" target="_blank">Finalizado</a></td>';
  } elseif ($status == 5) {
  }
}

function img_users()
{
  $ci = get_instance();

  if ($ci->session->userdata('img_signature') == 'assets/images/no-photo.jpg' || $ci->session->userdata('img_cip') == 'assets/images/no-photo.jpg' || $ci->session->userdata('img_dni') == 'assets/images/no-photo.jpg') {
    echo "1";
  } else {
    echo "2";
  }
}

function jefeJem($id)
{
  $ci = get_instance();
  $ci->load->model('Correspondence_model');
  $qy = $ci->Correspondence_model->get_rol(array('name_rol' => 'JEM'));
  if ($qy->jefe_rol == $id) {
    return true;
  }
}

function department_boss($id, $name)
{
  $ci = get_instance();
  $ci->load->model('Correspondence_model');
  $qy = $ci->Correspondence_model->get_rol(array('name_rol' => $name));
  if ($qy->jefe_rol == $id) {
    return true;
  }
}
function rol_user($id, $where, $table)
{
  $ci = get_instance();
  $ci->load->model('Correspondence_model');
  $qy = $ci->Correspondence_model->get_rol($where);
  if ($qy->id_rol == $id) {
    return true;
  }
}
function office_user($id, $where, $table)
{
  $ci = get_instance();
  $ci->load->model('Correspondence_model');
  $qy = $ci->Correspondence_model->get_rol($where, $table);
  if ($qy->members_office != null) {
    return in_array($id, json_decode($qy->members_office));
  } else {
    return 0;
  }
}
function department_user($id, $where, $table)
{
  $ci = get_instance();
  $ci->load->model('Correspondence_model');
  $qy = $ci->Correspondence_model->get_rol($where, $table);
  if ($qy->array_int != null) {
    return in_array($id, json_decode($qy->array_int));
  } else {
    return 0;
  }
}

function remitida($id)
{
  $ci = get_instance();

  $ci->load->model('Correspondence_model');

  $qy = $ci->Correspondence_model->get_forwarded(array('rcvd_corr' => $id));
  if ($qy) {
    return $qy->id_frwd;
  }
}

function diminutive_range($name)
{
  $ci = get_instance();

  $ci->load->model('Admin_model');
  $q = $ci->Admin_model->get_range(array('id_range' => $name));
  return $q->diminutive;
}

function get_sub_decree($id)
{
  $ci = get_instance();
  $ci->load->model('Correspondence_model');
  $q = $ci->Correspondence_model->dataOffice(array('s.decree_id' => $id), 'row');
  if ($q->name_office != null) {
    return $q->name_office;
  }
}

function string_ubigeo($id_ubigeo = null)
{
  $ci = get_instance();

  $ci->load->model('CGI_model');
  $q = $ci->CGI_model->row_data('sunat_codigoubigeo', array('codigo_ubigeo' => $id_ubigeo));
  if ($q != null) {
    return '<option value="' . $q->codigo_ubigeo . '">' . $q->departamento . " - " . $q->provincia . " - " . $q->distrito . '</option>';
  }
  return false;
}
