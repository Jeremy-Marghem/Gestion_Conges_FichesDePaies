<?php
    session_start();
    session_destroy();
    header('Location: indexAdmin.php');
    exit();
?>