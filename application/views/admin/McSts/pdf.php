<?php

require('assets/fpdf/fpdf.php');

class PDF extends FPDF
{
    function Footer()
    {
        // Go to 1.5 cm from bottom
        $this->SetY(-15);
        // Select Arial italic 8
        $this->SetFont('Arial', 'I', 8);

        // Print centered page number
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '-{nb}', 0, 0, 'C');
    }
}

$pdf =  new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);
$fill = false;
$pdf->Image($row->img_user, 170, 10, 30);



$text_qr = base_url() . 'ficha-mcsts/' . $row->id_user;
$ruta_qr = "assets/images/qr/mcsts" . $row->id_user . ".png";
if (!file_exists($ruta_qr)) {

    qr($ruta_qr, $text_qr, $row->id_user);
    //QRcode::png($text_qr, $ruta_qr,QR_ECLEVEL_L, 3, 0);
}
$pdf->Image($ruta_qr,  170, 262, -90);



$pdf->Cell(183, 5, utf8_decode('ASOCIACIÓN CIRCULO MILITAR DE SUPERVISORES,'), '', 1, 'C', false);
$pdf->Cell(183, 5, utf8_decode('TÉCNICOS Y SUBOFICIALES DEL EP'), '', 1, 'C', false);
$pdf->SetFont('Arial', 'BU', 13);
$pdf->Cell(183, 5, utf8_decode('FICHA DE INSCRIPCIÓN'), '', 1, 'C', false);


//$pdf->Image('assets/images/ri_4.png', 173, 5, 17);
$pdf->Ln();
$pdf->Ln();
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(1);
$pdf->SetFont('Helvetica', 'BU', 10);
$pdf->Cell(180, 10, 'PRIMERA PARTE', '', 1, '', false);
$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(180, 5, 'I      DATOS PERSONALES', '', 1, '', false);
$pdf->SetFont('Helvetica', '', 9);
$pdf->Cell(43, 5, 'APELLIDO PATERNO ', 'LTRB', 0, '', false);
$pdf->Cell(43, 5, 'APELLIDO MATERNO ', 'LTRB', 0, '', false);
$pdf->Cell(45, 5, 'NOMBRES', 'LTRB', 0, '', false);
$pdf->Cell(15, 5, 'SEXO', 'LTRB', 0, '', false);
$pdf->Cell(30, 5, 'ESTADO CIVIL', 'LTRB', 1, '', false);


$apellido = explode(' ', $this->session->userdata('user_lastname'));
$pdf->Cell(43, 7, utf8_decode($apellido[0]), 'LTRB', 0, '', false);
$pdf->Cell(43, 7, utf8_decode($apellido[1]), 'LTRB', 0, '', false);
$pdf->Cell(45, 7, $this->session->userdata('user_name'), 'LTRB', 0, '', false);
$pdf->Cell(15, 7, $row->gender, 'LTRB', 0, '', false);
$pdf->Cell(30, 7, utf8_decode($row->civil_status), 'LTRB', 1, '', false);


$pdf->Ln();
$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(180, 7, 'II.       LUGAR Y FECHA DE NACIMIENTO', '', 1, '', false);
$pdf->SetFont('Helvetica', '', 9);
$pdf->Cell(28, 5, 'NACIONALIDAD ', 'LTRB', 0, '', false);
$pdf->Cell(39, 5, 'DEPARTAMENTO', 'LTRB', 0, '', false);
$pdf->Cell(39, 5, 'PROVINCIA', 'LTRB', 0, '', false);
$pdf->Cell(39, 5, 'DISTRITO/CIUDAD', 'LTRB', 0, '', false);
$pdf->Cell(10, 5, 'DIA', 'LTRB', 0, '', false);
$pdf->Cell(10, 5, 'MES', 'LTRB', 0, '', false);
$pdf->Cell(11, 5, utf8_decode('AÑO'), 'LTRB', 1, '', false);

$pdf->Cell(28, 5, 'Peruano', 'LRB', 0, '', false);

$pdf->Cell(39, 5, utf8_decode($brithday_b->departamento), 'RB', 0, '', false);
$pdf->Cell(39, 5, utf8_decode($brithday_b->provincia), 'RB', 0, '', false);
$pdf->Cell(39, 5, utf8_decode($brithday_b->distrito), 'RB', 0, '', false);

$fecha_naci = explode('-', $row->date_birthday);
$pdf->Cell(10, 5, $fecha_naci[2], 'RB', 0, '', false);
$pdf->Cell(10, 5, $fecha_naci[1], 'RB', 0, '', false);
$pdf->Cell(11, 5, $fecha_naci[0], 'LRB', 1, '', false);





$pdf->Ln();
$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(180, 7, 'III.       DOMICILIO ACTUAL', '', 1, '', false);
$pdf->SetFont('Helvetica', '', 9);

$pdf->Cell(30, 5, 'DEPARTAMENTO', 'LTRB', 0, '', false);
$pdf->Cell(30, 5, 'PROVINCIA', 'LTRB', 0, '', false);
$pdf->Cell(32, 5, 'DISTRITO/CIUDAD', 'LTRB', 0, '', false);
$pdf->Cell(30, 5,  utf8_decode('URBANIZACIÓN'), 'LTRB', 0, '', false);

$pdf->Cell(54, 5, utf8_decode('DIRECCIÓN'), 'LTRB', 1, 'C', false);



$pdf->Cell(30, 5, utf8_decode($brithday_b->departamento), 'LRB', 0, '', false);
$pdf->Cell(30, 5, utf8_decode($brithday_b->provincia), 'RB', 0, '', false);
$pdf->Cell(32, 5, utf8_decode($brithday_b->distrito), 'RB', 0, '', false);

$pdf->Cell(30, 5,  utf8_decode($row->urbanization), 'LTRB', 0, '', false);
$pdf->Cell(54, 5, utf8_decode($row->address), 'LRB', 1, '', false);




$pdf->Ln();
$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(180, 7, 'IV.       DOCUMENTOS PERSONALES', '', 1, '', false);
$pdf->SetFont('Helvetica', '', 9);

$pdf->Cell(88, 5, 'CIP', 'LTRB', 0, 'C', false);
$pdf->Cell(88, 5, 'DNI', 'LTRB', 1, 'C', false);



$pdf->Ln(1.5);
$cip = str_split($this->encryption->decrypt($row->cip_user));
$pdf->Cell(25, 5, '', '', 0, '', false);
for ($i = 0; $i < count($cip); $i++) :
    $pdf->Cell(5, 5, $cip[$i], 'LTRB', 0, 'C', false);

endfor;

//dni


$dni = str_split($this->encryption->decrypt($row->dni_user));
$pdf->Cell(50, 5, '', '', 0, '', false);
for ($i = 0; $i < count($dni); $i++) :
    $pdf->Cell(5, 5, $dni[$i], 'LTRB', 0, 'C', false);

endfor;
$pdf->Cell(5, 5, '', '', 1, 'C', false);


$pdf->Ln();
$pdf->SetFont('Helvetica', 'BU', 10);
$pdf->Cell(180, 7, 'SEGUNDA PARTE', '', 1, '', false);

$pdf->SetFont('Helvetica', 'B', 10);


$pdf->Cell(180, 7, 'V.       FAMILIARES DIRECTOS DEL APORTANTE', '', 1, '', false);

$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(7, 5, utf8_decode('N°'), 'LTRB', 0, 'C', false);
$pdf->Cell(88, 5, 'APELLIDOS Y NOMBRES', 'LTRB', 0, 'C', false);
$pdf->Cell(32, 5, 'PARENTESCO', 'LTRB', 0, 'C', false);
$pdf->Cell(15, 5,  'EDAD', 'LTRB', 0, 'C', false);

$pdf->Cell(35, 5, 'NRO CCIIFFS', 'LTRB', 1, 'C', false);
$i = "";
$ubicacion = 189;
foreach ($members as $member) {
    $i++;
    $pdf->Cell(7, 5, $i, 'LTRB', 0, 'C', false);
    $pdf->Cell(88, 5,  utf8_decode($member->name_family) . " " . utf8_decode($member->lastname_family), 'LTRB', 0, 'C', false);
    $pdf->Cell(32, 5, utf8_decode($member->relationship_family), 'LTRB', 0, 'C', false);
    $pdf->Cell(15, 5,  utf8_decode($member->age_family), 'LTRB', 0, 'C', false);

    $pdf->Cell(35, 5, $member->cciiffs, 'LTRB', 1, 'C', false);
    $ubicacion = $ubicacion + 5;
}
if (file_exists($row->signature_user)) :
    $pdf->Image($row->signature_user, 155, $ubicacion, 30);
endif;
$pdf->Ln();
$pdf->SetFont('Helvetica', 'BU', 10);
$pdf->Cell(180, 7, 'OTROS ', '', 1, '', false);

$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(88, 5, utf8_decode('1. N° TELEFONO FIJO: ' . $row->emergency_cell), 'LTB', 0, '', false);
$pdf->Cell(88, 5, 'CELULAR: ' . $row->phone_user, 'TRB', 1, '', false);

$pdf->Cell(176, 5, utf8_decode('2. Correo electrónico: ' . $row->email_user), 'LTRB', 1, '', false);

$pdf->Ln();

$pdf->SetFont('Helvetica', 'B', 7.5);
$pdf->Cell(176, 4, utf8_decode('Recuerda que los beneficios que brinda la ACM-STS es única y exclusivamente para el titular y sus familiares directos previa presentación'), 'C', 1, '', false);

$pdf->Cell(176, 4, utf8_decode('de su carnet de identidad (hijos menores de 24 años de edad).'), '', 1, 'C', false);
$pdf->Cell(176, 4, utf8_decode('Para casos de retiro a solicitud el mínimo de aporte será de dieciocho meses. '), '', 1, 'C', false);

$pdf->Ln(2);
$pdf->Cell(15, 0, '', '', 0, 'C', false);
$pdf->Cell(20, 4, '', 'LTR', 0, 'C', false);

$pdf->Cell(145, 4, '', '', 1, 'R', false);


$pdf->Cell(15, 0, '', '', 0, 'C', false);
$pdf->Cell(20, 4, '', 'LR', 0, 'C', false);

$pdf->Cell(145, 4, '', '', 1, 'R', false);


$pdf->Cell(15, 4, '', '', 0, 'C', false);
$pdf->Cell(20, 4, '', 'LR', 0, 'C', false);
$pdf->SetFont('Helvetica', 'B', 10);

$pdf->Cell(145, 4, diminutive_range($row->range_user) .' ' .$row->lastname_user . ' '. $row->name_user.'        ......................................   ', '', 1, 'R', false);
$pdf->SetFont('Helvetica', 'B', 7.5);

$pdf->Cell(15, 4, '', '', 0, 'C', false);
$pdf->Cell(20, 4, '', 'LR', 0, 'C', false);

$pdf->Cell(190, 4, '(Grado y Nombre)                                                     Firma)              ', '', 1, 'C', false);
$pdf->Cell(15, 0, '', '', 0, 'C', false);
$pdf->Cell(20, 4, '', 'LR', 0, 'C', false);

$pdf->Cell(145, 4, '', '', 1, 'R', false);
$pdf->Cell(15, 0, '', '', 0, 'C', false);
$pdf->Cell(20, 4, '', 'LRB', 0, 'C', false);

$pdf->Cell(145, 4, '', '', 1, 'R', false);



$pdf->Cell(15, 0, '', '', 0, 'C', false);
$pdf->Cell(20, 4, 'INDICE DERECHO', '', 0, 'C', false);

$pdf->Cell(145, 4, '', '', 1, 'R', false);

$pdf->Cell(180, 0, 'Chorrillos,' . fecha($row->date_birthday), '', 1, 'R', false);

$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(169, 189, 207);

$pdf->Cell(190, 5, 'Copia de CIP y DNI Titular', 'LRTB', 1, 'C', true);

if (file_exists($row->dni_image_user)) :
    $pdf->Image($row->dni_image_user, 30, 30, 156, 90);
endif;
if (file_exists($row->cip_image_user)) :
    $pdf->Image($row->cip_image_user, 30, 140, 156, 90);
//$pdf->Image($url,  170,262,-90);
endif;




$pdf->Output();
