<?php
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