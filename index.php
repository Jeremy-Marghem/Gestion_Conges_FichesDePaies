<?php
include ('./projet/admin/lib/php/liste_include.php');
$cnx = Connexion::getInstance($dsn, $user, $pass);
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="projet/lib/css/bootstrap-3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="projet/lib/css/bootstrap-3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

        <link rel="stylesheet" href="projet/lib/css/style.css" type="text/css"/>

        <!-- Latest compiled and minified JavaScript -->
        <script src="projet/lib/css/bootstrap-3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <meta charset="UTF-8">
        <title>Projet Web - Côté Personnel</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-offset-3 col-md-6">
                    <br/><br/><br/><br/>
                    <h1 class="well text-center txtBlack">Accés reservé au personnel</h1>
                    <hr><br/>
                    <form class="well" id="formulaire" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                        <h4 class="text-center txtBlack">Login</h4>
                        <div class="row">
                            <div class="col-xs-offset-0 col-xs-12 col-md-offset-3 col-md-6 ">
                                <input name="login" id="login" class="form-control" type="text" placeholder="prenom.nom@entreprise.com" required>
                            </div>
                        </div>
                        <br/><br/>
                        <h4 class="text-center txtBlack">Mot de passe</h4>
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
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    var touches = new Array();
    $(document).keyup(function (event) {
        touches.push(event.which);
        var n = touches.length - 1;
        if (touches[n] === 78 && touches[n - 1] === 73 && touches[n - 2] === 77 && touches[n - 3] === 68 && touches[n - 4] === 65)
        {
            window.location = "projet/admin/pages/indexAdmin.php";
        }
        ;
    });
</script>
<?php
if (isset($_POST['access'])) {
    if (isset($_SESSION)) {
        unset($_SESSION);
        session_destroy();
    }
    session_start();
    $info = new InfoIndividuDB($cnx);
    $utilisateur = $info->getVerifIndividu($_POST['login'], $_POST['password']);

    if ($utilisateur != null) {
        $_SESSION['id'] = $utilisateur[0]->__get('id_individu');
        $_SESSION['nom'] = $utilisateur[0]->__get('nom_individu');
        $_SESSION['prenom'] = $utilisateur[0]->__get('prenom_individu');
        $_SESSION['adresse'] = $utilisateur[0]->__get('adresse_individu') . " - " . $utilisateur[0]->__get('cp_individu') . " " . $utilisateur[0]->__get('localite_individu');
        $_SESSION['tel'] = $utilisateur[0]->__get('tel_individu');
        $_SESSION['conges'] = $utilisateur[0]->__get('nb_conges_individu');
        $_SESSION['anciennete'] = $utilisateur[0]->__get('anciennete');
        $_SESSION['page'] = "accueil";
        
        header('Location: projet/pages/accueil.php?page=home');
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
