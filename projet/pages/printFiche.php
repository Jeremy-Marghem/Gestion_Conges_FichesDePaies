<?php
session_start();

require '../admin/lib/php/dbConnect.php';
require '../admin/lib/php/classes/Connexion.class.php';
require '../admin/lib/php/autoload.php';
require('../admin/lib/php/fpdf/fpdf.php');
require('../lib/php/fonctions.php');

$cnx = Connexion::getInstance($dsn, $user, $pass);

$id_fiche = $_GET['id'];

$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$adresse = $_SESSION['adresse'];
$telephone = $_SESSION['tel'];
$individu ="\nNom: ".ucfirst($nom)."\nPrenom: ".ucfirst($prenom)."\nAdresse: ".$adresse."\nT".utf8_decode("é")."l".utf8_decode("é")."phone: ".$telephone;

$fiche = new InfoFichesDB($cnx);
$data = $fiche->getInfoFichesParIdFiche($id_fiche);
      
$pdf = new FPDF('p','cm','A4');
$pdf->AddPage();
$pdf->SetDrawColor(180,0,0);
$pdf->SetFillColor(180,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(1,1);
$pdf->SetFont('Arial','B',20);

$pdf->MultiCell(0,1,"Fiche de paie\ndu ".transform(strval($data[1]->__get('debut')))." au ".transform(strval($data[1]->__get('fin')))."\nR".utf8_decode("é")."f".utf8_decode("é")."rence: ".$data[1]->__get('id_fiche'),0,'C',0);

$pdf->Line(0, 4.5, $pdf->GetPageWidth(),4.5);

$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,2,"",0,'L',0);
$pdf->MultiCell(0,1,$individu,0,'L',0);
$pdf->MultiCell(0,1,"\nBrut: ".$data[1]->__get('brut').chr(128)."\nNet: ".$data[1]->__get('net').chr(128),0,'L',0);
$pdf->MultiCell(0,1,"\nHeures prest".utf8_decode("é")."es: ".$data[1]->__get('heures')." heures",0,'L',0);

$pdf->Output();