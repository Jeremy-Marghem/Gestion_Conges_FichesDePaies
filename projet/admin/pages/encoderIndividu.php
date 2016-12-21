<?php
$mat = '';
$nom = '';
$prenom = '';
$adresse = '';
$cp = '';
$tel = '';
$localite = '';
$conges = '';
$mdp = '';
if (isset($_POST['submit'])) {
    $mat = $_POST['matricule'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['adresse'];
    $cp = $_POST['cp'];
    $localite = $_POST['localite'];
    $tel = $_POST['tel'];
    $conges = $_POST['conges'];
    $mdp = $_POST['mdp'];
}
?> <!-- PERMET DE CONSERVER LES DONNEES ENTREES -->
<br/><br/>
<div class="bootstrap-iso">
    <div class="container">
        <div class="row">
            <div class="well col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-4 col-sm-offset-3 col-sm-6 col-xs-offset-2 col-xs-8">
                <form name="formulaire" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                    <div class="col-xs-12 form-group">
                        <label class="labelHauteur34 col-xs-6 control-label" for="choixPays">Pays</label>
                        <select class="col-xs-6 selectpicker" data-style="btn-info" id="pays" name="pays">
                            <option value="1">Belgique</option>
                            <option value="2">France</option>
                            <option value="3">Suisse</option>
                            <option value="4">Luxembourg</option>
                        </select>
                    </div>    
                    <div class="col-xs-12 form-group">
                        <label class="control-label" for="matricule">Matricule</label>
                        <input class="form-control" type="text" name="matricule" id="matricule" value="<?php echo $mat ?>"/>
                    </div>
                    <div class="col-xs-12 form-group">
                        <label class="control-label">Nom</label>
                        <input class="form-control" type="text" name="nom" id="nom" value="<?php echo $nom ?>"/>
                    </div>
                    <div class="col-xs-12 form-group">
                        <label class="control-label">Prenom</label>
                        <input class="form-control" type="text" name="prenom" id="prenom" value="<?php echo $prenom ?>"/>
                        <span id="remarqueH" class="errorRed2"></span>
                    </div> 
                    <div class="col-xs-12 form-group">
                        <label class="control-label">Adresse</label>
                        <input class="form-control" type="text" name="adresse" id="adresse" value="<?php echo $adresse ?>"/>
                    </div>  

                    <div class="col-xs-12 form-group">
                        <label class="control-label">Code postal</label>
                        <input class="form-control" type="text" name="cp" id="cp" value="<?php echo $cp ?>"/>
                        <span id="remarqueCp" class="errorRed2"></span>
                    </div>  
                    <div class="col-xs-12 form-group">
                        <label class="control-label">Localite</label>
                        <input class="form-control" type="text" name="localite" id="localite" value="<?php echo $localite ?>"/>
                    </div>                      
                    <div class="col-xs-12 form-group">
                        <label class="control-label">Téléphone</label>
                        <input class="form-control" type="text" name="tel" id="tel" value="<?php echo $tel ?>"/>
                        <span id="remarqueTel" class="errorRed2"></span>
                    </div> 
                    <div class="col-xs-12 form-group">
                        <label class="control-label">Nombre de jours de congés</label>
                        <input class="form-control" type="text" name="conges" id="conges" value="<?php echo $conges ?>"/>
                        <span id="remarqueConges" class="errorRed2"></span>                        
                    </div>  
                    <div class="col-xs-12 form-group">
                        <label class="control-label">Mot de passe</label>
                        <input class="form-control" type="text" name="mdp" id="mdp" value="<?php echo $mdp ?>"/>
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
<?php
if (isset($_POST['submit'])) {

    $ok = true;

    $cp = $_POST['cp'];
    $regexCp = "#[0-9]{4}#";
    $tel = $_POST['tel'];
    $regexTel = "#[0-9]{9,10}$#";
    $nbConges = $_POST['conges'];
    $regexConges = '#[0-9]{1,2}$#';

    if (!(preg_match($regexCp, $cp))) {
        $ok = false;
        ?>
        <script>
            $('#cp').val("");
            $('#remarqueCp').html("Erreur");
        </script>
        <?php
    }
    if (!(preg_match($regexTel, $tel))||  strlen($tel)>10) {
        $ok = false;
        ?>
        <script>
            $('#tel').val("");
            $('#remarqueTel').html("Erreur");
        </script>
        <?php
    }
    if (!(preg_match($regexConges, $nbConges))) {
        $ok = false;
        ?>
        <script>
            $('#conges').val("");
            $('#remarqueConges').html("Erreur");
        </script>
        <?php
    }

    if ($ok) {
        
        $id_pays = $_POST['pays'];
        $id_statut=1;
        $matricule = $_POST['matricule'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $adresse = $_POST['adresse'];
        $cp = $_POST['cp'];
        $localite = $_POST['localite'];
        $tel = $_POST['tel'];
        $conges = $_POST['conges'];
        $mdp = $_POST['mdp'];

        $info = new InfoIndividuDB($cnx);
        $resultat = $info->create($id_pays,$id_statut,$matricule,strtolower($nom),strtolower($prenom),$adresse,$cp,$localite,$tel,$conges,$mdp);
        if($resultat==1){
        ?>
        <script>
            $('#matricule').val("");
            $('#nom').val("");
            $('#prenom').val("");
            $('#adresse').val("");
            $('#cp').val("");
            $('#localite').val("");
            $('#tel').val("");
            $('#conges').val("");
            $('#mdp').val("");

            $('#remarqueCp').html("");
            $('#remarqueTel').html("");
            $('#remarqueConges').html("");
            
            $('#remarque').html("Individu enregistré!");
        </script>
        <?php
        }
        else{
        ?>
        <script>
            $('#remarqueCp').html("");
            $('#remarqueTel').html("");
            $('#remarqueConges').html("");
            
            $('#remarque').html("Erreur lors de l'enregistrement!");
        </script>
        <?php 
        }
    }
}