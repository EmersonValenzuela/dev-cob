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
$path = base_url() . "assets/images/docInstitute/";
$path2 = base_url() . "/";
if ($request->person == "2") {
  $fam = $request->relationship . " con Nombre " .  $request->ins_name_fam . " " .  $request->ins_last_fam . " y CIF " . $request->ins_cift_fam;
} elseif ($request->person == "1") {
  $fam = "Persona";
}


// Creación del objeto de la clase heredada
$pdf =  new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Helvetica', 'B', 11);
$fill = false;
$pdf->Image('assets/images/ri_5.png', 10, 5, 15);
$pdf->SetTextColor(155, 11, 11);

$pdf->Cell(183, 10, utf8_decode('MODELO DE SOLICITUD - DESCUENTO POR CONVENIO INSTITUTO'), '', 1, 'C', false);
$pdf->Image('assets/images/ri_4.png', 173, 5, 17);
$pdf->Ln();
$pdf->Ln();
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(1);
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(180, 1, utf8_decode('SOLICITA:  Descuento por convenio otorgado por el'), '', 1, 'R', false);
$pdf->Cell(180, 10, utf8_decode('INSTITUTO') . ' ' . utf8_decode($request->name_institute), '', 1, 'R', false);


$pdf->Cell(201, 5, '', '', 1, 'C', false);


$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Multicell(185, 4, utf8_decode('SEÑOR GENERAL DE BRIGADA CMDTE GRAL DEL COMANDO DE BIENESTAR DEL EJÉRCITO (DEPARTAMENTO DE APOYO SOCIAL)'), '', 'C', false);
$pdf->Ln();

$pdf->SetFont('Helvetica', '', 11);
$pdf->Ln();
$pdf->Cell(180, 5, 'S.G.', '', 1, '', false);
$pdf->Multicell(180, 7, utf8_decode('Yo ' . $request->name_user . ' ' . $request->lastname_user . ', Grado ' . $request->name_range . ' con CIP ' . $this->encryption->decrypt($request->cip_user) . ' y DNI ' . $this->encryption->decrypt($request->dni_user) . ' en actual servicio ' . $request->service . ' con teléf.  ' . $request->phone_user . '  ante Ud. con el debido respeto me presento y expongo:'), '', 'J', false);

$pdf->Ln();


$pdf->Ln();
$pdf->Multicell(180, 7, utf8_decode('                    Que teniendo conocimiento del convenio de cooperación interinstitucional con el instituto "' . $request->name_institute . '" respetuosamente solicito a Ud., se digne disponer a quien corresponda dar las facilidades para obtener el descuento por convenio en beneficio de mi ' .  $fam . ', para seguir estudios en la especialidad de ' . $request->ins_specialty), '', 'J', false);

$pdf->Ln();


$pdf->Cell(121, 5, utf8_decode('POR LO EXPUESTO:'), '', 1, 'R', false);
$pdf->Cell(170, 5, utf8_decode('A Ud. respetuosamente solicito acceder a mi pedido.'), '', 1, 'R', false);


$pdf->Ln();
$pdf->Cell(180, 5, ' Lima, ' . fecha($request->ins_create_date), '', 1, 'R', false);


if (exif_imagetype(base_url() . $request->signature_user)) {
  if ($request->person == "2") {
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Image(base_url() . $request->signature_user, 145, 174, 40, 19);
  } else {
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Image(base_url() . $request->signature_user, 145, 167, 40, 19);
  }
}


$pdf->Cell(180, 7, ' ..............................................', '', 1, 'R', false);
$pdf->Cell(180, 7, '                 Firma              ', '', 1, 'R', false);


$pdf->Cell(180, 7, ' Post Firma: ' . $request->name_user, '', 1, 'R', false);
$pdf->Cell(180, 7, $request->lastname_user, '', 1, 'R', false);
$pdf->Cell(180, 7, ' CIP: ' . $this->encryption->decrypt($request->cip_user), '', 1, 'R', false);

$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Helvetica', 'BU', 10);
$pdf->Cell(180, 5, utf8_decode('PIEZAS ADJUNTAS'), '', 1, '', false);

$pdf->SetFont('Helvetica', '', 11);


$pdf->Cell(201, 5, utf8_decode('02 Copias de CIP y DNI (Titular)'), '', 1, '', false);

$pdf->Cell(201, 5, utf8_decode('02 Copias de CIF y DNI (Familiar)'), '', 1, '', false);



$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(169, 189, 207);
$pdf->Cell(190, 5, 'Copia de CIP y DNI Titular', 'LRTB', 1, 'C', true);

if (exif_imagetype($path2 . $request->cip_image_user)) {
  $pdf->Image($path2 . $request->cip_image_user, 30, 30, 156, 90);
}
if (exif_imagetype(base_url($request->dni_image_user))) {
  $pdf->Image($path2 . $request->dni_image_user, 30, 140, 156, 90);
}

if ($request->person == "2") {
  $pdf->AddPage();

  $pdf->SetFont('Arial', 'B', 10);
  $pdf->SetFillColor(169, 189, 207);
  $pdf->Cell(190, 5, 'Copia de CIP y DNI Familiar', 'LRTB', 1, 'C', true);


  $pdf->Image($path . $request->ins_cif_fam, 30, 30, 156, 90);
  $pdf->Image($path . $request->ins_dni_fam, 30, 140, 156, 90);
}


$pdf->Output();
