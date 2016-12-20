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
                <tr class="acceptee">
                    <td class="text-center"><?php echo transform($data[$i]->__get('debut')) ?></td> <!-- Date de debut-->
                    <td class="text-center"><?php echo transform($data[$i]->__get('fin')) ?></td> <!-- Date de fin-->
                    <td class="text-center"><?php echo $data[$i]->__get('brut') ?> €</td> <!-- Salaire brut -->
                    <td class="text-center"><?php echo $data[$i]->__get('net') ?> €</td> <!-- Salaire net -->
                    <td class="text-center"><?php echo $data[$i]->__get('heures') ?> heures</td> <!-- Heures prestees -->
                    <td class="text-center"><a href="printFiche.php?id=<?php echo $data[$i]->__get('id_fiche') ?>&nom=<?php echo $_SESSION['nom']?>&prenom=<?php echo $_SESSION['prenom']?>" target="_blank"><span class="glyphicon glyphicon-download-alt"></span></a></td> <!-- Génération PDF -->            
                </tr>
                <?php
            }
            ?>            
    </div>
</div>


?>