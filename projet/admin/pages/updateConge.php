<?php

$id = $_GET['id'];
$val = $_GET['val'];
$nb= $_GET['nb'];
$ind = $_GET['individu'];
$info = new InfoIndividuDB($cnx);
if($val == strval(-1)){
    $result = $info->augmenteNb($ind,$nb);
}
$inf = new InfoCongesDB($cnx);
$resultat = $inf->updateConge($id, $val);
if($resultat == 1){
    $message = "Demande bien traitée!";
}else{
    $message = "Erreur lors du traitement! Veuillez contacter un administrateur!";
}
?>
<br/><br/>
<div class="row">
    <h1 class="text-center well bords"><?php echo $message?></h1>
    <a href="redirect.php"><button class="btn btn-danger col-lg-offset-4 col-lg-4 col-xs-offset-2 col-xs-8">Ok</button></a>
</div>