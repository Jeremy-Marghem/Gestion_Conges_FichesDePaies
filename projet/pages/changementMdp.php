<br/><br/>
<div class="bootstrap-iso">
    <div class="container">
        <div class="row">
            <div class="well col-lg-offset-4 col-lg-4 col-md-offset-4 col-md-4 col-sm-offset-3 col-sm-6 col-xs-offset-2 col-xs-8">
                <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                    <div class="form-group">
                        <label class="control-label" for="mdp_actuel">Entrez le mot de passe actuel</label>
                        <input class="form-control" id="mdp_actuel" name="mdp_actuel" type="password"/>
                        <span id="errorMdp"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="new_mdp">Entrez le nouveau mot de passe</label>
                        <input class="form-control" id="new_mdp" name="new_mdp" type="password"/>
                        <span class="errorNewMdp"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="new_mdp2">Confirmer le nouveau mot de passe</label>
                        <input class="form-control" id="new_mdp2" name="new_mdp2" type="password"/>
                        <span class="errorNewMdp"></span>
                    </div>                    
                    <br/> 
                    <span id="remarque"></span>
                    <br/><br/>
                    <div class="form-group">
                        <div>
                            <input name="_honey" style="display:none" type="text"/>
                            <button class="btn btn-primary" name="submit" type="submit">Changer le mot de passe</button>
                        </div>
                    </div>
                    <div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_POST['submit'])) {

    $ok = true;
    $mdp = $_POST['mdp_actuel'];

    $info = new InfoIndividuDB($cnx);
    $verif = $info->getVerifMdp($_SESSION['id'], $mdp);

    if ($verif == 0) {
        $ok = false;
        ?>
        <script>
            $('#errorMdp').html("   Incorrect");
            $('#errorMdp').addClass("errorRed2");
        </script>
        <?php
    }

    $new_mdp = $_POST['new_mdp'];
    $new_mdp2 = $_POST['new_mdp2'];
    
    if (strcmp($new_mdp, $new_mdp2) != 0) {
        $ok = false;
        ?>
        <script>
            $('#errorNewMdp').html("Mots de passe différents");
            $('#errorNewMdp').addClass("errorRed2");
        </script>
        <?php
    }elseif(strlen($new_mdp)<5){
        $ok = false;
        ?>
        <script>
            $('#remarque').html("Le nouveau mot de passe doit contenir 5 caractères minimum");
            $('#remarque').addClass("errorRed2");
        </script>
        <?php           
    }

    if ($ok) {
        $verif = $info->getMajMdp($_SESSION['id'], $mdp, $new_mdp);

        if ($verif == 0) {
            ?>
            <script>
                $('#remarque').html("Ereur lors de la mise à jour");
                 $('#remarque').addClass("errorRed2");
            </script>
        <?php}else{
            ?>
            <script>
                $('#remarque').html("Mot de passe bien mis à jour");
                $('#remarque').css("color","green");
            </script>
            <?php
        }
    }
}
