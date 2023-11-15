<?php

spl_autoload_register( function ($class) {
    if (file_exists($class . '.php')) {
        require_once $class . '.php';
    }
});

$classe = isset($_REQUEST['class']) ? $_REQUEST['class'] : null;
$metodo = isset($_REQUEST['metodo']) ? $_REQUEST['metodo'] : null;

if(class_exists($classe)){
    $pagina = new $classe($_REQUEST);//chama inicialmente o construtor da classe

    if(!empty($metodo) AND method_exists($classe, $metodo)){
        $pagina->$metodo($_REQUEST);//chama o metodo da classe
    }
    $pagina->$show;
}
