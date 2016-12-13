<?php
session_start();

require '../admin/lib/php/dbConnect.php';
require '../admin/lib/php/classes/Connexion.class.php';
require '../admin/lib/php/autoload.php';
require('../admin/lib/php/fpdf/fpdf.php');

$cnx = Connexion::getInstance($dsn, $user, $pass);

$id_fiche = $_GET['id'];

$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$adresse = $_SESSION['adresse'];
$telephone = $_SESSION['tel'];
$individu ="\nNom: ".$nom."\nPrenom: ".$prenom."\nAdresse: ".$adresse."\nT".utf8_decode("é")."l".utf8_decode("é")."phone: ".$telephone;

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


function transform($string){
$annee=0;
$annee=substr($string,0,4);
$mois=0;	
$mois=substr($string,5,2);
switch($mois){
    case 1: $mois = "Janvier";
        break;
    case 2: $mois = "Fevrier";
        break;
    case 3: $mois = "Mars";
        break;
    case 4: $mois = "Avril";
        break;
    case 5: $mois = "Mai";
        break;
    case 6: $mois = "Juin";
        break;
    case 7: $mois = "Juillet";
        break;
    case 8: $mois = "Aout";
        break;
    case 9: $mois = "Septembre";
        break;
    case 10: $mois = "Octobre";
        break;
    case 11: $mois = "Novembre";
        break;    
    case 12: $mois = "Decembre";
        break;    
}
$jour=0;	
$jour=substr($string,8,2);
return $jour." ".$mois." ".$annee;

}