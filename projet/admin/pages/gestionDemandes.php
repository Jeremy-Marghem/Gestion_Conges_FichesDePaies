<br/><br/>
<div class="row">
    <div class="table-responsive">
        <table class="well col-xs-12 table-bordered table-condensed table-hover">
            <tr>
                <th class="text-center">Nom</th>
                <th class="text-center">Prénom</th>
                <th class="text-center">Date de debut</th>
                <th class="text-center">Date de fin</th>
                <th class="text-center">Nombre de jours</th>
                <th class="text-center">Accepter</th>
                <th class="text-center">Refuser</th>
            </tr>
            <?php
            $info = new InfoCongesDB($cnx);
            $data = $info->getDemandes();
            $length = count($data);

            for ($i = 0; $i < $length; $i++) {
                ?>
                <tr>
                    <td class="text-center"><?php echo ucfirst($data[$i]->__get('nom_individu')) ?></td>
                    <td class="text-center"><?php echo ucfirst($data[$i]->__get('prenom_individu')) ?></td>
                    <td class="text-center"><?php echo transform($data[$i]->__get('date_debut')) ?></td>
                    <td class="text-center"><?php echo transform($data[$i]->__get('date_fin')) ?></td>
                    <td class="text-center"><?php echo $data[$i]->__get('nb_jours') ?></td>
                    <td class="text-center"><button class="btn btn-info" value="" OnClick='window.location.href="../pages/accueilAdmin.php?page=updateConge&id=<?php echo $data[$i]->__get('id_conges')?>&val=1"'><span class="glyphicon glyphicon-ok"></span></button></td>
                    <td class="text-center"><button class="btn btn-danger" value="" OnClick='window.location.href="../pages/accueilAdmin.php?page=updateConge&id=<?php echo $data[$i]->__get('id_conges')?>&val=-1"'><span class="glyphicon glyphicon-remove"></span></button></td>
                <?php }
                ?>
        </table>
    </div>
</div>