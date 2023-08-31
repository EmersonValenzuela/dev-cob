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
$path = base_url() . "assets/images/docbritanico/";
$path2 = base_url();
if ($request->person == "2") {
  $fam = $request->relationship . " con Nombre " .  $request->bri_name_fam . " " .  $request->bri_last_fam . " y CIF " . $request->bri_cift_fam;
} elseif ($request->person == "1") {
  $fam = "Persona";
}
// Creación del objeto de la clase heredada
$pdf =  new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Helvetica', 'B', 10);
$fill = false;
$pdf->Image('assets/images/ri_5.png', 10, 5, 15);
$pdf->SetTextColor(155, 11, 11);

$pdf->Cell(183, 10, utf8_decode('MODELO DE SOLICITUD PARA TARIFA PREFERENCIAL EN EL INST. BRITANICO'), '', 1, 'C', false);
$pdf->Image('assets/images/ri_4.png', 173, 5, 17);
$pdf->Ln();
$pdf->Ln();
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(180, 1, utf8_decode('SOLICITA:   Tarifa Preferencial otorgado'), '', 1, 'R', false);
$pdf->Cell(180, 10, utf8_decode('por el Instituto BRITANICO'), '', 1, 'R', false);


$pdf->Cell(201, 5, '', '', 1, 'C', false);


$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Multicell(185, 4, utf8_decode('SEÑOR GENERAL DE BRIGADA CMDTE GRAL DEL COMANDO DE BIENESTAR DEL EJÉRCITO (DEPARTAMENTO DE APOYO SOCIAL)'), '', 'C', false);
$pdf->Ln();

$pdf->SetFont('Helvetica', '', 11);
$pdf->Ln();
$pdf->Cell(180, 5, 'S.G.', '', 1, '', false);
$pdf->Multicell(180, 7, utf8_decode('Yo ' . $request->name_user . ' ' . $request->lastname_user . ', Grado ' . $request->name_range . ' con CIP ' . $this->encryption->decrypt($request->cip_user) . ' y DNI ' . $this->encryption->decrypt($request->dni_user) . ' en actual servicio ' . $request->service . ' con Telf ' . $request->phone_user . ' ante Ud. con el debido respeto me presento y expongo:'), '', 'J', false);

$pdf->Ln();


$pdf->Ln();
$pdf->Multicell(180, 7, utf8_decode('                    Que teniendo conocimiento que el Instituto BRITANICO por intermedio del COBIENE DAS está otorgando la Tarifa Preferencial al personal militar y civil del Ejército, solicito a Ud., Mi General disponer a quien corresponda se me inscriba a fin de obtener este beneficio, para mí ' .  $fam . ', en la carrera de ' . $request->bri_specialty), '', 'J', false);

$pdf->Ln();


$pdf->Cell(121, 5, utf8_decode('POR LO EXPUESTO:'), '', 1, 'R', false);
$pdf->Cell(170, 5, utf8_decode('A Ud. respetuosamente solicito acceder a mi pedido.'), '', 1, 'R', false);


$pdf->Ln();
$pdf->Cell(180, 5, ' Lima, ' . fecha($request->bri_create_date), '', 1, 'R', false);



if ($request->person == "2") {
  $pdf->Ln();
  $pdf->Ln();
  if (exif_imagetype($request->signature_user)) {
    $pdf->Image(base_url() . $request->signature_user, 145, 167, 40, 19);
  }
} else {
  $pdf->Ln();
  $pdf->Ln();
  $pdf->Ln();
  if (exif_imagetype(base_url() . $request->signature_user)) {
    $pdf->Image(base_url() . $request->signature_user, 145, 160, 40, 19);
  }
}
$pdf->Cell(180, 7, ' ..............................................', '', 1, 'R', false);
$pdf->Cell(180, 7, '                 Firma              ', '', 1, 'R', false);


$pdf->Cell(180, 7, ' Post Firma :  ' . $request->name_user, '', 1, 'R', false);
$pdf->Cell(180, 7, $request->lastname_user, '', 1, 'R', false);
$pdf->Cell(180, 7, ' CIP : ' . $this->encryption->decrypt($request->cip_user), '', 1, 'R', false);


$pdf->SetFont('Helvetica', 'BU', 10);
$pdf->Cell(180, 9, utf8_decode('NOTA.- ANTES DE MATRICULARSE, ENVIAR SUS DATOS AL CORREO'), '', 1, '', false);

$pdf->SetFont('Helvetica', '', 13);
$pdf->SetFillColor(236, 240, 241);
$pdf->SetTextColor(40, 116, 166);
$pdf->Cell(60, 5, utf8_decode('convenios@britanico.edu.pe'), '', 1, '', true, 'mailto:convenios@britanico.edu.pe');

$pdf->Ln();
$pdf->Ln();
$pdf->SetTextColor(0, 0, 0);

$pdf->SetFont('Helvetica', 'BU', 10);
$pdf->Cell(180, 5, utf8_decode('PIEZAS ADJUNTAS'), '', 1, '', false);

$pdf->SetFont('Helvetica', '', 11);

$pdf->Cell(201, 5, utf8_decode('02 Copias de Liquidación de Haberes del Titular'), '', 1, '', false);

$pdf->Cell(201, 5, utf8_decode('02 Copias de CIP y DNI fedateada por actuario militar (Titular)'), '', 1, '', false);

$pdf->Cell(201, 5, utf8_decode('02 Copias de CIF y DNI fedateadas por actuario militar (Familiar)'), '', 1, '', false);

$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(169, 189, 207);

$pdf->Cell(190, 5, utf8_decode(' Copia de Liquidación de Haberes del Titular'), 'LRTB', 1, 'C', true);
if (exif_imagetype($path . $request->bri_settlement)) {
  $pdf->Image($path . $request->bri_settlement,  27, 40, 160, 180);
}

$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(169, 189, 207);
$pdf->Cell(190, 5, 'Copia de CIP y DNI Titular', 'LRTB', 1, 'C', true);

if (exif_imagetype(base_url($request->dni_image_user))) {

  $pdf->Image(base_url($request->dni_image_user), 30, 30, 156, 90);
}
if (exif_imagetype(base_url($request->cip_image_user))) {

  $pdf->Image(base_url($request->cip_image_user), 30, 140, 156, 90);
}
if ($request->person == "2") {
  $pdf->AddPage();

  $pdf->SetFont('Arial', 'B', 10);
  $pdf->SetFillColor(169, 189, 207);
  $pdf->Cell(190, 5, 'Copia de CIP y DNI Familiar', 'LRTB', 1, 'C', true);

  if (exif_imagetype(base_url($request->bri_cif_fam))) {

    $pdf->Image(base_url($request->bri_cif_fam), 30, 30, 156, 90);
  }
  if (exif_imagetype(base_url($request->bri_dni_fam))) {

    $pdf->Image(base_url($request->bri_dni_fam), 30, 140, 156, 90);
  }
}

$pdf->Output();
