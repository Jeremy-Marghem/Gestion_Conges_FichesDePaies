<?php
$sal = '';
$heu = '';


if (isset($_POST['submit'])) {
    $sal = $_POST['brut'];
    $heu = $_POST['heures'];
}
?> <!-- PERMET DE CONSERVER LES DONNEES ENTREES -->
<br/><br/><br/><br/>
<div class="bootstrap-iso">
    <div class="container">
        <div class="row">
            <div class="well col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-4 col-sm-offset-3 col-sm-6 col-xs-offset-2 col-xs-8">
                <form name="formulaire" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                    <div class="col-xs-12 form-group">
                        <label class="labelHauteur34 col-xs-6 control-label" for="date_debut">Statut: </label>
                        <select class="col-xs-6 selectpicker" data-style="btn-info" id="statut" name="statut">
                            <option value="employe">Employé</option>
                            <option value="ouvrier">Ouvrier</option>
                        </select>
                    </div>    
                    <div class="col-xs-12 form-group">
                        <label class="labelHauteur34 col-xs-6 control-label" for="date_debut">Nom: </label>
                        <select class="col-xs-6 selectpicker" data-style="btn-info" id="listePersonnel" data-live-search="true">
                        </select>
                    </div>
                    <div class="col-xs-12 form-group">
                        <label class="col-xs-6" id="taux">TAUX: 32.38%</label> <!-- SI OUVRIER 38.38%-->
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
                            <button class="col-xs-offset-3 col-xs-6 btn btn-primary" name="submit" type="submit">Encoder la fiche</button>
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
<?php
if (isset($_POST['submit'])) {

    $ok = true;

    $salaire = $_POST['brut'];
    $regexSalaire = "#\d(\,|\.)\d#";
    $heures = $_POST['heures'];
    $regexHeures = "#\d*#";

    if (!(preg_match($regexSalaire, $salaire))) {
        $ok = false;
        ?>
        <script>
            $('#remarqueS').html("Erreur");
        </script>
        <?php
    }
    if (!(is_numeric($heures))) {
        $ok = false;
        ?>
        <script>
            $('#remarqueH').html("Erreur");
        </script>
        <?php
    }

    if ($ok) {
        $IDtemporaire = 1;
        $statut = $_POST['statut'];
        switch ($statut) {
            case 'employe':
                $statut = 1;
                $sal = $salaire - ($salaire * 0.3238);
                break;
            case 'ouvrier':
                $statut = 2;
                $sal = $salaire - (($salaire * 1.08) * 0.3838);
                break;
        }

        ///TRAITEMENT
        
        $dateAjd= new DateTime();
        $debut = date_create($_POST['date_debut']);
        $fin = date_create($_POST['date_fin']);
        
        //ON VERIFIE SI LE CHOIX DES DATES EST CORRECT
        if($_POST['date_debut']<$dateAjd||$_POST['date_fin']<$_POST['date_debut']){
            ?>
            <script>
                $('#remarque').html("Erreur dans le choix des dates!");
            </script>    
            <?php  
        }else{
             ///CREATION VIA DAO RENVOIE 1 SI OK
        if ($resultat == 1) {
            ?>
            <script>
                $('#remarque').html("Demande enregistrée!");
            </script>    
            <?php
        }}        
    }
}
?>
<script>
    var listeEmploye;
    var listeOuvrier;
    $('document').ready(function () {
        chargementEmploye();
        chargementOuvrier();
        remplirPersonnel(0);
    });

    $('#statut').change(function () {
        var option = $(this).find("option:selected");
        $('#listePersonnel').empty();
        if (option.val() === "ouvrier") {
            $('#taux').html("TAUX: 38.38%");
            remplirPersonnel(1);
        } else {
            $('#taux').html("TAUX: 32.38%");
            remplirPersonnel(0);
        }
    });

    function remplirPersonnel(code) {
        var liste = null;
        if (code === 0) {
            liste = listeEmploye;
        }
        if (code === 1) {
            liste = listeOuvrier;
        }
        $('#listePersonnel').empty(); //On vide le select
        for (var i = 0; i < liste.length; i++) {
            $('#listePersonnel').append($('<option>', {value: i, text: liste[i]['nom']}));
        }
        $('.selectpicker').selectpicker('refresh'); //On refresh le select
    }
    ;
    function chargementEmploye() {
        ///INCLURE ICI AJAX 
<?php
$info = new InfoIndividuDB($cnx);
$data = $info->getAllIndividu(1);
$length = count($data);

$tab = array();

for ($i = 0; $i < $length; $i++) {
    $tab[$i]['id'] = ($data[$i]->__get('id_individu'));
    $tab[$i]['nom'] = ($data[$i]->__get('nom_individu'));
    $tab[$i]['prenom'] = ($data[$i]->__get('prenom_individu'));
}
?>
        listeEmploye = <?php echo json_encode($tab) ?>;
    }
    ;
    function chargementOuvrier() {
        ///INCLURE ICI AJAX        
<?php
$info2 = new InfoIndividuDB($cnx);
$data2 = $info2->getAllIndividu(2);
$length2 = count($data2);

$tab2 = array();

for ($i = 0; $i < $length2; $i++) {
    $tab2[$i]['id'] = ($data2[$i]->__get('id_individu'));
    $tab2[$i]['nom'] = ($data2[$i]->__get('nom_individu'));
    $tab2[$i]['prenom'] = ($data2[$i]->__get('prenom_individu'));
}
?>
        listeOuvrier = <?php echo json_encode($tab2) ?>;
    }
    ;
</script>
