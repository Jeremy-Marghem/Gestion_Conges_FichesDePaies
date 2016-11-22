<?php
function autoload($nom_classe) {

    if(file_exists($file = __DIR__.'/classes/'.$nom_classe.'.class.php')){
      require $file;  
    }
}
//fct qui appelle la méthode d'autochargement des classes
spl_autoload_register('autoload');