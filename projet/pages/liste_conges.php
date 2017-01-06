<br/><br/>
<div class="row">
    <div class="table-responsive">
        <table class="well col-xs-offset-1 col-xs-10 table-bordered table-condensed table-hover">
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

            for ($i = 0; $i < $length; $i++) {
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