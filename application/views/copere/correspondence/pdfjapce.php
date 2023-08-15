<?php
require('assets/fpdf/fpdf.php');


$url1 = 'assets/images/qr/copere/decree_' .  $row->id_rcvd_cr . '.png';
$url2 = base_url() . 'COPERE/ver-decreto/' . $row->id_rcvd_cr;

if (!file_exists($url1)) {
    qr($url1, $url2, $row->id_rcvd_cr);
}

$url3 = 'assets/images/qr/copere/rcvd_' .  $row->id_rcvd_cr . '.png';
$url4 = base_url() . 'assets/images/cr_recvd/' . $row->id_rcvd_cr . '.' . $row->ext_rcvd;

if (!file_exists($url3)) {
    qr($url3, $url4, $row->id_rcvd_cr);
}

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(190, 7, 'CUARTEL GENERAL DEL EJERCITO SUR', '', 1, 'C', false);
$pdf->Cell(190, 7, utf8_decode('JEFATURA DE ADMINISTRACIÓN DE PERSONAL'), '', 1, 'C', false);
$pdf->Cell(190, 7, utf8_decode('CIVIL DEL EJÉRCITO'), '', 1, 'C', false);

$pdf->Ln();

$pdf->SetFont('Arial', '', 11);
$pdf->Cell(30, 5, utf8_decode('DECRETO N°  '), '',  0, 'L', false);
$pdf->SetFont('Arial', 'U', 11);
$pdf->Cell(30, 5,"  " . str_pad($row->id_rcvd_cr, 4, '0', STR_PAD_LEFT). "  ", '',  0, 'L', false);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(20, 5, utf8_decode('FECHA'), '',  0, 'L', false);
$pdf->SetFont('Arial', 'U', 11);
$pdf->Cell(40, 5, "   " . $row->date_decree . "   ", '',  0, 'L', false);
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(20, 5, utf8_decode('HORA'), '',  0, 'L', false);
$pdf->SetFont('Arial', 'U', 11);
$pdf->Cell(30, 5, "   " . $row->hour_rcvd . "   ", '',  1, 'L', false);

$pdf->Ln();

$pdf->SetFont('Arial', 'u', 1);
$pdf->Cell(188, 2, '', '', 1, 'C', true);
$pdf->SetFont('Arial', '', 11);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$pdf->Cell(46, 5, 'EJECUTIVO', '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->rcvd_by == 'EJECUTIVO') ? 'X' : '', 'LRTB', 0, 'C', false);

$pdf->Cell(10, 5, '  ', '', 0, 'R', false);
$pdf->Cell(46, 5, 'DPTO SALUD 1', '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->rcvd_by == 'DPTO SALUD 1') ? 'X' : '', 'LRTB', 0, 'C', false);

$pdf->Cell(10, 5, '  ', '', 0, 'R', false);
$pdf->Cell(46, 5, 'CAFAE', '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->rcvd_by == 'CAFAE') ? 'X' : '', 'LRTB', 1, 'C', false);

$pdf->Ln();

$pdf->Cell(46, 5, utf8_decode('DTO TÉCNICO'), '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->rcvd_by == 'DTO TÉCNICO') ? 'X' : '', 'LRTB', 0, 'C', false);

$pdf->Cell(10, 5, '  ', '', 0, 'R', false);
$pdf->Cell(46, 5, 'DPTO SALUD 2', '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->rcvd_by == 'DPTO SALUD 2') ? 'X' : '', 'LRTB', 0, 'C', false);

$pdf->Cell(10, 5, '  ', '', 0, 'R', false);
$pdf->Cell(46, 5, 'DPTO PROF', '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->rcvd_by == 'DPTO PROF') ? 'X' : '', 'LRTB', 1, 'C', false);

$pdf->Ln();

$pdf->Cell(46, 5, utf8_decode('PREVISIÓN SOCIAL'), '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->rcvd_by == 'PREVISIÓN SOCIAL') ? 'X' : '', 'LRTB', 0, 'C', false);

$pdf->Cell(10, 5, '  ', '', 0, 'R', false);
$pdf->Cell(46, 5, 'DPTO AUXILIARES', '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->rcvd_by == 'DPTO AUXILIARES') ? 'X' : '', 'LRTB', 0, 'C', false);

$pdf->Cell(10, 5, '  ', '', 0, 'R', false);
$pdf->Cell(46, 5, 'DPTO ADM', '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->rcvd_by == 'DPTO ADM') ? 'X' : '', 'LRTB', 1, 'C', false);

$pdf->Ln();

$pdf->Cell(46, 5, utf8_decode('CONTROL INTERNO'), '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->rcvd_by == 'CONTROL INTERNO') ? 'X' : '', 'LRTB', 0, 'C', false);

$pdf->Cell(10, 5, '  ', '', 0, 'R', false);
$pdf->Cell(46, 5, 'DPTO LEYES Y ', '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->rcvd_by == 'DPTO LEYES Y NORMAS') ? 'X' : '', 'LRTB', 0, 'C', false);

$pdf->Cell(10, 5, '  ', '', 0, 'R', false);
$pdf->Cell(46, 5, 'SEC TELEM Y', '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->rcvd_by == 'SEC TELEM Y ESTADISTICA') ? 'X' : '', 'LRTB', 1, 'C', false);

$pdf->Cell(46, 5, '', '', 0, 'L', false);
$pdf->Cell(7, 5, '', '', 0, 'L', false);

$pdf->Cell(10, 5, '  ', '', 0, 'R', false);
$pdf->Cell(46, 5, 'NORMAS', '', 0, 'L', false);
$pdf->Cell(7, 5, '', '', 0, 'L', false);

$pdf->Cell(10, 5, '  ', '', 0, 'R', false);
$pdf->Cell(46, 5, 'ESTADISTICA', '', 0, 'L', false);
$pdf->Cell(7, 5, '', '', 1, 'L', false);

$pdf->Ln();

$pdf->SetFont('Arial', 'u', 1);
$pdf->Cell(188, 2, '', '', 1, 'C', true);
$pdf->SetFont('Arial', '', 11);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$pdf->Cell(10, 5, '1.', '', 0, 'L', false);
$pdf->Cell(70, 5, utf8_decode('ACCIÓN'), '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->mode_decree == '14') ? 'X' : '', 'LRTB', 0, 'C', false);

$pdf->Cell(10, 5, '', '', 0, 'R', false);
$pdf->Cell(10, 5, '9.', '', 0, 'L', false);
$pdf->Cell(70, 5, utf8_decode('EXPLOTACIÓN ARCHIVO'), '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->mode_decree == '22') ? 'X' : '', 'LRTB', 1, 'C', false);

$pdf->Ln();

$pdf->Cell(10, 5, '2.', '', 0, 'L', false);
$pdf->Cell(70, 5, utf8_decode('ACUSE DE RECIBO'), '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->mode_decree == '15') ? 'X' : '', 'LRTB', 0, 'C', false);

$pdf->Cell(10, 5, '', '', 0, 'R', false);
$pdf->Cell(10, 5, '10.', '', 0, 'L', false);
$pdf->Cell(70, 5, 'HABLE CONMIGO', '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->mode_decree == '23') ? 'X' : '', 'LRTB', 1, 'C', false);

$pdf->Ln();

$pdf->Cell(10, 5, '3.', '', 0, 'L', false);
$pdf->Cell(70, 5, utf8_decode('COORDINACIÓN'), '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->mode_decree == '16') ? 'X' : '', 'LRTB', 0, 'C', false);

$pdf->Cell(10, 5, '', '', 0, 'R', false);
$pdf->Cell(10, 5, '11.', '', 0, 'L', false);
$pdf->Cell(70, 5, utf8_decode('HOJA DE COORDINACIÓN'), '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->mode_decree == '24') ? 'X' : '', 'LRTB', 1, 'C', false);

$pdf->Ln();

$pdf->Cell(10, 5, '4.', '', 0, 'L', false);
$pdf->Cell(70, 5, utf8_decode('CONOCIMIENTO Y FINES'), '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->mode_decree == '17') ? 'X' : '', 'LRTB', 0, 'C', false);

$pdf->Cell(10, 5, '', '', 0, 'R', false);
$pdf->Cell(10, 5, '12.', '', 0, 'L', false);
$pdf->Cell(70, 5, utf8_decode('HOJA DE TRÁMITE'), '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->mode_decree == '25') ? 'X' : '', 'LRTB', 1, 'C', false);

$pdf->Ln();

$pdf->Cell(10, 5, '5.', '', 0, 'L', false);
$pdf->Cell(70, 5, utf8_decode('CUMPLIMIENTO'), '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->mode_decree == '18') ? 'X' : '', 'LRTB', 0, 'C', false);

$pdf->Cell(10, 5, '', '', 0, 'R', false);
$pdf->Cell(10, 5, '13.', '', 0, 'L', false);
$pdf->Cell(70, 5, utf8_decode('LEGAJO PERSONAL'), '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->mode_decree == '26') ? 'X' : '', 'LRTB', 1, 'C', false);

$pdf->Ln();

$pdf->Cell(10, 5, '6.', '', 0, 'L', false);
$pdf->Cell(70, 5, utf8_decode('DIFUSIÓN'), '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->mode_decree == '19') ? 'X' : '', 'LRTB', 0, 'C', false);

$pdf->Cell(10, 5, '', '', 0, 'R', false);
$pdf->Cell(10, 5, '14.', '', 0, 'L', false);
$pdf->Cell(70, 5, utf8_decode('SEGUIMIENTO'), '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->mode_decree == '27') ? 'X' : '', 'LRTB', 1, 'C', false);

$pdf->Ln();

$pdf->Cell(10, 5, '7.', '', 0, 'L', false);
$pdf->Cell(70, 5, utf8_decode('ESTUDIO Y RECOMENDACIÓN'), '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->mode_decree == '20') ? 'X' : '', 'LRTB', 0, 'C', false);

$pdf->Cell(10, 5, '', '', 0, 'R', false);
$pdf->Cell(10, 5, '15.', '', 0, 'L', false);
$pdf->Cell(70, 5, utf8_decode('TRAMITACIÓN'), '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->mode_decree == '28') ? 'X' : '', 'LRTB', 1, 'C', false);

$pdf->Ln();

$pdf->Cell(10, 5, '8.', '', 0, 'L', false);
$pdf->Cell(70, 5, utf8_decode('ESTUDIOS Y RESPUESTA'), '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->mode_decree == '21') ? 'X' : '', 'LRTB', 1, 'C', false);
$pdf->Ln(7);

$pdf->SetFont('Arial', '', 11);
$pdf->Cell(60, 10, 'RESPUESTA:', '', 1, 'L', false);
$pdf->Ln(2);

$pdf->Cell(2, 5, '', '', 0, 'L', false);
$pdf->Cell(35, 5, 'MUY URGENTE', '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->urg == '2') ? 'X' : '', 'LRTB', 0, 'C', false);

$pdf->Cell(7, 5, '  ', '', 0, 'L', false);
$pdf->Cell(25, 5, 'URGENTE', '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->urg == '1') ? 'X' : '', 'LRTB', 0, 'C', false);

$pdf->Cell(7, 5, '  ', '', 0, 'L', false);
$pdf->Cell(32, 5, 'EN LA FECHA', '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->urg == '3') ? 'X' : '', 'LRTB', 0, 'C', false);

$pdf->Cell(7, 5, '  ', '', 0, 'L', false);
$pdf->Cell(40, 5, 'CONOCMIENTO Y', '', 0, 'L', false);
$pdf->Cell(7, 5, $r = ($row->urg == '4') ? 'X' : '', 'LRTB', 1, 'C', false);


$pdf->Cell(2, 5, '', '', 0, 'L', false);
$pdf->Cell(35, 5, '', '', 0, 'L', false);
$pdf->Cell(7, 5, '', '', 0, 'C', false);

$pdf->Cell(7, 5, '  ', '', 0, 'L', false);
$pdf->Cell(25, 5, '', '', 0, 'L', false);
$pdf->Cell(7, 5, '', '', 0, 'C', false);

$pdf->Cell(7, 5, '  ', '', 0, 'L', false);
$pdf->Cell(32, 5, '', '', 0, 'L', false);
$pdf->Cell(7, 5, '', '', 0, 'C', false);

$pdf->Cell(7, 5, '  ', '', 0, 'L', false);
$pdf->Cell(40, 5, 'ARCHIVO', '', 0, 'L', false);
$pdf->Cell(7, 5, '', '', 1, 'C', false);


$pdf->Cell(60, 8, 'OBSERVACIONES:', '', 1, 'L', false);


$pdf->Multicell(185, 4, utf8_decode($row->issue_decree), '', 'J', false);
$pdf->Ln(7);

$pdf->SetY(240);
$pdf->SetFont('Arial', 'B', 10);
// Arial italic 8

$pdf->Ln(20);

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetAutoPageBreak(true,2); 


$pdf->Cell(190, 6, '______________________________', '', 1, 'C', false);

$pdf->Image($url1,  10, 262, -90);
$pdf->Image($url3,  175, 262, -90);
if (file_exists(base_url($user->signature_user))) :
    $pdf->Image(base_url($user->signature_user),  123, 228, -205);
endif;
$pdf->Cell(190, 4, 'O- 224534372- O+', '', 1, 'C', false);

$pdf->Cell(190, 4, utf8_decode('ALEXEI CHIRINOS ZUÑIGA'), '', 1, 'C', false);

$pdf->SetFont('Arial', '', 10);

$pdf->Cell(190, 4, 'CRL INF', '', 1, 'C', false);
$pdf->Cell(190, 4, utf8_decode('Jefe de la Sub Jefatura de administración'), '', 1, 'C', false);
$pdf->Cell(190, 4,  utf8_decode('de personal Civil del Ejército'), '', 1, 'C', false);
$pdf->Output();
