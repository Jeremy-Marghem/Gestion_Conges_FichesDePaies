<?php

$id = $_GET['id'];
$val = $_GET['val'];
$inf = new InfoCongesDB($cnx);
$resultat = $inf->updateConge($id, $val);
if($resultat == 1){
    $message = "Demande bien traitée!";
}else{
    $message = "Erreur lors du traitement! Veuillez contacter un adminiastrateur!";
}
?>
<br/><br/>
<div class="row">
    <h1 class="text-center well"><?php echo $message?></h1>
        <a href="redirect.php"><button class="btn btn-danger col-lg-offset-1 col-lg-2">Ok</button></a>
</div>