<?php

//Incarcare config si va arata ruta
require_once 'config/config.php';

//Autoload Librariile din Core

spl_autoload_register(function ($className){
    //Fisierele trebuie sa aibe acelasi nume precum clasele
    require_once 'libraries/' . $className .'.php';
});