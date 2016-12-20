<?php
include ('../lib/php/liste_include.php');
include ('../../lib/php/fonctions.php');
$cnx = Connexion::getInstance($dsn, $user, $pass);
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../../lib/css/bootstrap-3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="../../lib/css/bootstrap-3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

        <link rel="stylesheet" href="../../lib/css/styleAdmin.css" type="text/css"/>

        <!-- Latest compiled and minified JavaScript -->
        <script src="../../lib/css/bootstrap-3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        
        <meta charset="UTF-8">
        <title>Projet Web - Côté Administrateurs</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-offset-3 col-md-6">
                    <br/><br/><br/><br/>
                    <h2 class="well text-center">Accés reservé au administrateurs</h2>
                    <hr><br/>
                    <form class="well" id="formulaire" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                        <h4 class="text-center">Login</h4>
                        <div class="row">
                            <div class="col-xs-offset-0 col-xs-12 col-md-offset-3 col-md-6 ">
                                <input name="login" id="login" class="form-control" type="text" placeholder="prenom.admin@entreprise.com" required>
                            </div>
                        </div>
                        <br/><br/>
                        <h4 class="text-center">Mot de passe</h4>
                        <div class="row">
                            <div class="col-xs-offset-0 col-xs-12 col-md-offset-3 col-md-6">
                                <input name="password" class="form-control" type="password" required>
                            </div>
                        </div> 
                        <br/><div class="col-xs-offset-4 col-xs-6"> 
                            <span id="remarque"></span></div>
                        <br/><br/>                        
                        <div class="row">
                            
                            <div class="col-xs-offset-0 col-xs-12 col-md-offset-3 col-md-6">
                                <br/><br/>
                                <button type="submit" name="access" id="access" class="col-xs-offset-2 col-xs-8  btn btn-success ">Se connecter</button>
                            </div>                         
                        </div>                           
                    </form>
                    <div class="col-xs-12">
                        <a href="backIndex.php"><button type="submit" name="retour" id="retour" class="col-xs-offset-2 col-xs-8  btn btn-danger ">Retour</button></a>
                    </div>    
                    <br/><br/>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
if (isset($_POST['access'])) {
    if (isset($_SESSION)) {
        unset($_SESSION);
        session_destroy();
    }
    session_start();
    $info = new InfoAdminDB($cnx);
    $utilisateur = $info->getVerifAdmin($_POST['login'], $_POST['password']);
    if ($utilisateur != null) {

        $_SESSION['nom'] = $utilisateur[0]->__get('nom_admin');
        $_SESSION['prenom'] = $utilisateur[0]->__get('prenom_admin');
        $_SESSION['page'] = "accueilAdmin";
        
        header('Location: accueilAdmin.php?page=home');
    } else {
        ?>
        <script>
            $('#remarque').html("Identifiants incorrects");
            $('#remarque').addClass("errorRed2");
        </script>
        <?php
    }
}
?>