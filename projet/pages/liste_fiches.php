<br/><br/>
<div class="row">
    <div class="table-responsive">
        <table class="col-lg-12 table-bordered table-striped table-condensed table-hover">
            <tr class="well">
                <th class="text-center">Du</th>
                <th class="text-center">Au</th>
                <th class="text-center">Salaire brut</th>
                <th class="text-center">Salaire net</th>
                <th class="text-center">Heures prestées</th>
                <th class="text-center">Générer PDF</th>
            </tr>
            <?php
            $info=new InfoFichesDB($cnx);
            $data=$info->getInfoFiches($_SESSION['id']);
            $length = count($data);

            for ($i = 1; $i < $length; $i++) {
                ?>
                <tr>
                    <td class="text-center"><?php echo transform($data[$i]->__get('debut')) ?></td> <!-- Date de debut-->
                    <td class="text-center"><?php echo transform($data[$i]->__get('fin')) ?></td> <!-- Date de fin-->
                    <td class="text-center"><?php echo $data[$i]->__get('brut') ?> €</td> <!-- Salaire brut -->
                    <td class="text-center"><?php echo $data[$i]->__get('net') ?> €</td> <!-- Salaire net -->
                    <td class="text-center"><?php echo $data[$i]->__get('heures') ?> heures</td> <!-- Heures prestees -->
                    <td class="text-center"><span id="<?php echo $data[$i]->__get('id_fiche') ?>" class="glyphicon glyphicon-download-alt"></span></td> <!-- Génération PDF -->            
                </tr>
                <?php
            }
            ?>            
    </div>
</div>

<?php
function transform($string){
$annee=0;
$annee=substr($string,0,4);
$mois=0;	
$mois=substr($string,5,2);
switch($mois){
    case 1: $mois = "Janvier";
        break;
    case 1: $mois = "Fevrier";
        break;
    case 1: $mois = "Mars";
        break;
    case 1: $mois = "Avril";
        break;
    case 1: $mois = "Mai";
        break;
    case 1: $mois = "Juin";
        break;
    case 1: $mois = "Juillet";
        break;
    case 1: $mois = "Aout";
        break;
    case 1: $mois = "Septembre";
        break;
    case 1: $mois = "Octobre";
        break;
    case 1: $mois = "Novembre";
        break;    
    case 12: $mois = "Decembre";
        break;    
}
$jour=0;	
$jour=substr($string,8,2);
return $jour." ".$mois." ".$annee;
}
?>