<?php

//Creeaza URL-uri si incarca Core Controller
//URL Format -/controller/method/params

class Core
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        //print_r($this->getUrl());
        $url = $this->getUrl();

        //Ne uitam in Controller pentru prima valoare din array, definim calea ca si cum am fii in index.php
        if ((!empty($url[0]) && file_exists('../app/controllers/' . ucwords($url[0]) . '.php') && isset($url[0]))) {
            //verifica daca exista, si setam ca controllerul principal
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }
        //solicitare controller
        require_once '../app/controllers/' . $this->currentController . '.php';

        //Instatiere clasa controller
        $this->currentController = new $this->currentController;

        //Verificare pentru a doua parte din url
        if (isset($url[1])) {
            //verificare daca metoda exista in controller
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        // Preluare params
        //Daca sunt parametrii ii va adauga in array, daca nu va ramane un array gol
        $this->params = $url ? array_values($url) : [];

        //apelarea unui callbacl cu un array de parametri

        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl()
    {
        //preluare parametrii din URL
        if (isset($_GET['url'])) {
            //Eliminare / din Url
            $url = rtrim($_GET['url'], '/');
            //Curatare url de charactere nepermise
            $url = filter_var($url, FILTER_SANITIZE_URL);
            //Punerea intr-un array valoarea dupa fiecare /
            $url = explode('/', $url);
            return $url;
        }
    }
}