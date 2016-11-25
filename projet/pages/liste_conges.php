<br/><br/>
<div class="row">
    <div class="table-responsive">
        <table class="well col-lg-12 table-bordered table-condensed table-hover">
            <tr>
                <th class="text-center">Date de debut</th>
                <th class="text-center">Date de fin</th>
                <th class="text-center">Nombre de jours</th>
                <th class="text-center">Statut de la demande</th>
            </tr>
            <?php
            $info = new InfoCongesDB($cnx);
            $data = $info->getInfoConges($_SESSION['id']);
            $length = count($data);

            for ($i = 1; $i < $length; $i++) {
                if ($data[$i]->__get('validite') == -1) {
                    $fond = "refusee";
                    $validite = "Demande refusée";
                } else if ($data[$i]->__get('validite') == 0) {
                    $fond = "en_attente";
                    $validite = "Demande en attente";
                } else {
                    $fond = "acceptee";
                    $validite = "Demande accepté";
                }
                ?>
                <tr class="<?php echo $fond ?>">
                    <td class="text-center"><?php echo transform($data[$i]->__get('debut')) ?></td>
                    <td class="text-center"><?php echo transform($data[$i]->__get('fin')) ?></td>

                    <td class="text-center"><?php echo $data[$i]->__get('jours') ?></td>
                    <td class="text-center"><?php echo $validite ?></td>
                <?php }
                ?>
        </table>
    </div>
</div>
<?php
function transform($string) {
    $annee = 0;
    $annee = substr($string, 0, 4);
    $mois = 0;
    $mois = substr($string, 5, 2);
    switch ($mois) {
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
    $jour = 0;
    $jour = substr($string, 8, 2);
    return $jour . " " . $mois . " " . $annee;
}
?>