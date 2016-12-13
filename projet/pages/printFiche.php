<?php
require '../admin/lib/php/dbConnect.php';
require '../admin/lib/php/classes/Connexion.class.php';
require '../admin/lib/php/autoload.php';
require('../admin/lib/php/fpdf/fpdf.php');

$cnx = Connexion::getInstance($dsn, $user, $pass);

$id_fiche = $_GET['id'];
$nom = $_GET['nom'];
$prenom = $_GET['prenom'];
$fiche = new InfoFichesDB($cnx);
$data = $fiche->getInfoFichesParIdFiche($id_fiche);
        
$pdf = new FPDF('p','cm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->SetDrawColor(180,0,0);
$pdf->SetFillColor(180,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(1,1);
$pdf->MultiCell(0,1,"Fiche de paie\ndu ".transform(strval($data[1]->__get('debut')))." au ".transform(strval($data[1]->__get('fin'))),1,'C',0);
$pdf->MultiCell(0,1,"Nom: ".$_GET['nom']."  Prenom: ".$_GET['prenom'],1,'C',0);
$pdf->MultiCell(0,1,"Brut: ".$data[1]->__get('brut').chr(128)."  Net: ".$data[1]->__get('net').chr(128),1,'C',0);
$pdf->MultiCell(0,1,"Heures prest".utf8_decode("é")."es: ".$data[1]->__get('heures')." heures",1,'C',0);

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