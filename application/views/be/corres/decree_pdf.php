<?php
require('assets/fpdf/fpdf.php');


$url1 = 'assets/images/qr/decree_' .  $row->id_rcvd_cr . '.png';
$url2 = base_url() . 'be/ver-decreto/' . $row->id_rcvd_cr;

if (!file_exists($url1)) {
    qr($url1, $url2, $row->id_rcvd_cr);
}


$url3 = 'assets/images/qr/rcvd_' .  $row->id_rcvd_cr . '.png';
$url4 = base_url() . 'assets/images/cr_recvd/' . $row->id_rcvd_cr . '.' . $row->ext_rcvd;

if (!file_exists($url3)) {

    qr($url3, $url4, $row->id_rcvd_cr);
}


$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(60, 10, 'MINISTERIO DE DEFENSA', '', 0, 'L', false);
$pdf->Cell(96, 10, utf8_decode('N° REG'), '',  0, 'R', false);
$pdf->Cell(30, 10,  str_pad($row->id_rcvd_cr, 3, '0', STR_PAD_LEFT), '',  1, 'R', false);

$pdf->Cell(60, 10, 'COBIENE - JEM', '', 0, 'L', false);
$pdf->Cell(96, 10, utf8_decode('FECHA'), '',  0, 'R', false);
$pdf->Cell(30, 10, utf8_decode($row->date_rcvd), '',  1, 'R', false);

$pdf->Ln();

$pdf->SetFont('Arial', 'BU', 13);

$pdf->Cell(180, 8, utf8_decode('EL CRL EP JEFE DEL ESTADO MAYOR DEL COBIENE'), '', 1, 'C', false);

$pdf->Ln();

$pdf->SetFont('Arial', 'B', 13);

$pdf->Cell(180, 8, utf8_decode('DEPARTAMENTO DECRETADO: ' . $row->name_rol), '', 1, 'C', false);

$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Arial', 'B', 13);
$pdf->SetFillColor(169, 189, 207);
$pdf->Cell(188, 7, 'DECRETO', 'LRTB', 0, 'C', true);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial', '', 13);

$pdf->Cell(9, 5, $r = ($row->mode_decree == '1') ? ' X' : '', 'LRTB', 0, 'L', false);
$pdf->Cell(25, 5, 'ARCHIVO', '', 0, 'L', false);
$pdf->Cell(60, 5, '                                      ', '', 0, 'R', false);
$pdf->Cell(9, 5, $r = ($row->mode_decree == '8') ? ' X' : '', 'LRTB', 0, 'L', false);
$pdf->Cell(25, 5, 'ESTUDIO', '', 1, 'L', false);
$pdf->Ln();
$pdf->Cell(9, 5, $r = ($row->mode_decree == '2') ? ' X' : '', 'LRTB', 0, 'L', false);
$pdf->Cell(25, 5, 'TRAMITE', '', 0, 'L', false);
$pdf->Cell(60, 5, '                                      ', '', 0, 'L', false);
$pdf->Cell(9, 5, $r = ($row->mode_decree == '9') ? ' X' : '', 'LRTB', 0, 'R', false);
$pdf->Cell(25, 5, 'HABLE CONMIGO', '', 1, 'L', false);
$pdf->Ln();
$pdf->Cell(9, 5, $r = ($row->mode_decree == '3') ? ' X' : '', 'LRTB', 0, 'L', false);
$pdf->Cell(25, 5, 'CONOCIMIENTO', '', 0, 'L', false);
$pdf->Cell(60, 5, '                                      ', '', 0, 'R', false);
$pdf->Cell(9, 5, $r = ($row->mode_decree == '10') ? ' X' : '', 'LRTB', 0, 'R', false);
$pdf->Cell(25, 5, 'INFORME', '', 1, 'L', false);
$pdf->Ln();
$pdf->Cell(9, 5, $r = ($row->mode_decree == '4') ? ' X' : '', 'LRTB', 0, 'R', false);
$pdf->Cell(25, 5, 'COORDINAR', '', 0, 'L', false);
$pdf->Cell(60, 5, '                                      ', '', 0, 'R', false);
$pdf->Cell(9, 5,  $r = ($row->mode_decree == '10') ? ' X' : '', 'LRTB', 0, 'R', false);
$pdf->Cell(32, 5, utf8_decode('RECOMENDACIÓN'), '', 1, 'L', false);
$pdf->Ln();
$pdf->Cell(9, 5, $r = ($row->mode_decree == '5') ? ' X' : '', 'LRTB', 0, 'L', false);
$pdf->Cell(25, 5, 'CUMPLIMIENTO', '', 0, 'L', false);
$pdf->Cell(60, 5, '                                      ', '', 0, 'R', false);
$pdf->Cell(9, 5, $r = ($row->mode_decree == '11') ? ' X' : '', 'LRTB', 0, 'L', false);
$pdf->Cell(32, 5, 'RESPUESTA', '', 1, 'L', false);
$pdf->Ln();
$pdf->Cell(9, 5, $r = ($row->mode_decree == '6') ? ' X' : '', 'LRTB', 0, 'L', false);
$pdf->Cell(25, 5, 'DIFUSION', '', 0, 'L', false);
$pdf->Cell(60, 5, '                                      ', '', 0, 'R', false);
$pdf->Cell(9, 5, $r = ($row->mode_decree == '12') ? ' X' : '', 'LRTB', 0, 'L', false);
$pdf->Cell(32, 5, 'SEGUIMIENTO', '', 1, 'L', false);
$pdf->Ln();
$pdf->Cell(9, 5, $r = ($row->mode_decree == '7') ? ' X' : '', 'LRTB', 0, 'L', false);
$pdf->Cell(25, 5, 'EXPLOTACION', '', 0, 'L', false);
$pdf->Cell(60, 5, '                                      ', '', 0, 'R', false);
$pdf->Cell(9, 5, $r = ($row->mode_decree == '13') ? ' X' : '', 'LRTB', 0, 'L', false);
$pdf->Cell(32, 5, 'ACCION CORRESPONDIENTE', '', 1, 'L', false);
$pdf->Ln();

$pdf->SetFillColor(169, 189, 207);
$pdf->SetFont('Arial', 'B', 13);

$pdf->Cell(15, 6,  $r = ($row->urg == '1') ? '   X' : '', 'LRTB', 0, 'L', true);

$pdf->Cell(77, 6, 'URGENTE', 'LRTB', 0, 'L', true);
$pdf->Cell(15, 6, $r = ($row->urg == '2') ? '   X' : '', 'LRTB', 0, 'L', true);

$pdf->Cell(80, 6, 'MUY URGENTE', 'LRTB', 0, 'L', true);
$pdf->Ln(8);

$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(60, 10, 'OBSERVACIONES:', '', 1, 'L', false);
$pdf->SetFont('Arial', '', 13);

$pdf->Multicell(185, 10, utf8_decode($row->issue_decree), '', 'J', false);
$pdf->Ln(2);

$pdf->SetY(240);
$pdf->SetFont('Arial', 'B', 12);
// Arial italic 8
$pdf->Cell(90, 3, '', '', 0, 'C', false);
$pdf->Cell(90, 4, '', '', 1, 'C', false);

$pdf->Cell(90, 3, '', '', 0, 'C', false);
$pdf->Cell(90, 4, '', '', 1, 'C', false);

$pdf->SetFont('Arial', 'B', 12);


$pdf->Cell(90, 4, '', '', 0, 'C', false);
$pdf->Cell(90, 6, '______________________________', '', 1, 'C', false);

$pdf->Image($url1,  10,262,-90);
$pdf->Image($url3,  50,262,-105);
if(file_exists(base_url($user->signature_user))):
$pdf->Image(base_url($user->signature_user),  123,228,-205);
endif;
$pdf->Cell(90, 4, '', '', 0, 'C', false);
$pdf->Cell(90, 4, 'O- 224534372- O+', '', 1, 'C', false);

$pdf->Cell(90, 4, '', '', 0, 'C', false);
$pdf->Cell(90, 4, 'JORGE LUIS JARAMILLO LAM', '', 1, 'C', false);

$pdf->SetFont('Arial', '', 12);

$pdf->Cell(90, 4, '', '', 0, 'C', false);
$pdf->Cell(90, 4, 'CRL INT', '', 1, 'C', false);
$pdf->Cell(90, 4, '', '', 0, 'C', false);
$pdf->Cell(90, 4, 'JEFE DEL ESTADO MAYOR', '', 1, 'C', false);
$pdf->Output();
