<?php
$sal = '';
$heu = '';
if (isset($_POST['submit'])) {
    $sal = $_POST['brut'];
    $heu = $_POST['heures'];
}
?> <!-- PERMET DE CONSERVER LES DONNEES ENTREES -->
<br/><br/>
<div class="bootstrap-iso">
    <div class="container">
        <div class="row">
            <div class="well col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-4 col-sm-offset-3 col-sm-6 col-xs-offset-2 col-xs-8">
                <form name="formulaire" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                    <div class="col-xs-12 form-group">
                        <label class="labelHauteur34 col-sm-4 col-xs-12 control-label" for="date_debut">Individu: </label>
                        <select class="col-sm-8 col-xs-12 selectpicker" data-style="btn-info" id="listePersonnel" name="listePersonnel" data-live-search="true">
                        <?php
                            $info = new InfoIndividuDB($cnx);
                            $data = $info->getAllIndividu();
                            $length = count($data);
                            $tab = array();

                            for ($i = 0; $i < $length; $i++) {
                                $id = ($data[$i]->__get('id_individu'));
                                $perso = ucfirst($data[$i]->__get('nom_individu'))." ".ucfirst($data[$i]->__get('prenom_individu'));
                                ?>
                                <option value="<?php echo $id?>"><?php echo $perso?></option>
                                <?php
                            }
                        ?>
                        </select>
                    </div>
                    <div class="col-xs-12 form-group">
                        <label class="control-label">Salaire brut</label>
                        <input class="form-control" type="text" name="brut" value="<?php echo $sal ?>"/>
                        <span id="remarqueS" class="errorRed2"></span>
                    </div>
                    <div class="col-xs-12 form-group">
                        <label class="control-label">Heures prestées</label>
                        <input class="form-control" type="text" name="heures" value="<?php echo $heu ?>"/>
                        <span id="remarqueH" class="errorRed2"></span>
                    </div>
                    <div class="col-xs-12 form-group">
                        <label class="control-label" for="date_debut">Date de début</label>
                        <input class="form-control" id="date_debut" name="date_debut" placeholder="JJ MM AAAA" type="text"/>
                    </div>
                    <div class="col-xs-12 form-group">
                        <label class="control-label" for="date_fin">Date de fin</label>
                        <input class="form-control" id="date_fin" name="date_fin" placeholder="JJ MM AAAA" type="text"/>
                    </div>                    
                    <div class="form-group col-xs-12">
                        <div>
                            <input name="_honey" style="display:none" type="text"/>
                            <button class="col-xs-12 btn btn-primary" name="submit" type="submit">Encoder</button>
                        </div>
                    </div>
                    <div>
                        <span id="remarque"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_POST['submit'])) {

    $ok = true;

    $salaire = $_POST['brut'];
    $regexSalaire = "#\d(\,|\.)\d#";
    $heures = $_POST['heures'];

    if (!(preg_match($regexSalaire, $salaire))) {
        $ok = false;
        ?>
        <script>
            $('#remarqueS').html("Erreur, veuillez respecter ce format: 1250.0");
        </script>
        <?php
    }
    if (!is_numeric($heures)) {
        $ok = false;
        ?>
        <script>
            $('#remarqueH').html("Erreur");
        </script>
        <?php
    }

    if ($ok) {
        ///TRAITEMENT

        $dateAjd = new DateTime();

        //ON VERIFIE SI LE CHOIX DES DATES EST CORRECT
        if ($_POST['date_debut'] > $dateAjd || $_POST['date_fin'] < $_POST['date_debut']) {
            ?>
            <script>
                $('#remarque').html("Erreur dans le choix des dates!");
            </script>    
            <?php
        } else {
            $id = $_POST['listePersonnel'];
            $info = new InfoFichesDB($cnx);
            $resultat = $info->create($_POST['date_debut'], $id, $_POST['date_fin'], $salaire, $sal, $heures);
            if ($resultat == 1) {
                ?>
                <script>
                    $('#remarque').html("Fiche enregistrée!");
                </script>    
                <?php
            } else {
                ?>
                <script>
                    $('#remarque').html("Erreur lors de l'enregistrement!");
                </script>    
                <?php
            }
        }
    } else {
        $sal = $_POST['brut'];
        $heu = $_POST['heures'];
    }
}
?>
<script>
    $(document).ready(function () {
        var date_input = $('input[name="date_debut"]');
        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
        var options = {
            format: 'dd M yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
            weekStart: 1,
            daysOfWeekDisabled: "0,6"
        };
        date_input.datepicker(options);
    });
    $(document).ready(function () {
        var date_input = $('input[name="date_fin"]');
        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
        var options = {
            format: 'dd M yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
            weekStart: 1,
            daysOfWeekDisabled: "0,6"
        };
        date_input.datepicker(options);
    });
</script>
