<?php
include ('../lib/php/liste_include.php');
include ('../../lib/php/fonctions.php');
$cnx = Connexion::getInstance($dsn, $user, $pass);
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <!--JQUERY-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->

        
        <!--BOOTSTRAP-->
        <link rel="stylesheet" href="../../lib/css/bootstrap-3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="../../lib/css/bootstrap-3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <!-- Latest compiled and minified JavaScript -->
        <script src="../../lib/css/bootstrap-3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->
        

        <!--PLUGIN BOOTSTRAP SELECT-->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>
        <!-- (Optional) Latest compiled and minified JavaScript translation files -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/i18n/defaults-*.min.js"></script>

        <!-- Bootstrap Date-Picker Plugin -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    
        <!--STYLE PERSONNEL-->
        <link rel="stylesheet" href="../../lib/css/styleAdmin.css" type="text/css"/>
        <!--||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||-->

        
        <meta charset="UTF-8">
        <title>Projet Web</title>
    </head>
    <header>
        <a href="logout.php"><button class="btn btn-danger">Se deconnecter</button></a>
    </header>
    <body>
        <div class="container">
            <?php
            if (file_exists('../lib/php/menu_admin.php')) {
                include_once('../lib/php/menu_admin.php');
            }
            ?>
            <?php
            if (!isset($_SESSION['page'])) {
                $_SESSION['page'] = "accueilAdmin";
            }
            if (isset($_GET['page'])) {
                $_SESSION['page'] = $_GET['page'];
            }

            $path = $_SESSION['page'] . '.php';

            if (file_exists($path)) {
                include_once($path);
            } else {
                echo "Oups! Page introuvable, merci de contacter le service informatique!";
            }
            ?>            
        </div>
    </body>
</html>