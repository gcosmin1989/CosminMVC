<?php

//Incarcare config si va arata ruta
require_once 'config/config.php';
require_once 'helpers/session_helper.php';
require_once 'helpers/url_helper.php';
//Autoload Librariile din Core

spl_autoload_register(function ($className) {
    //Fisierele trebuie sa aibe acelasi nume precum clasele
    require_once 'libraries/' . $className . '.php';
});