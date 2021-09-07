<?php

//Creaza URL-uri si incarca Core Controller
//URL Format -/controller/method/params

class Core{
    protected $currentController ='Pages';
    protected $currentMethod = 'index';
    protected $params =[];

    public function __construct(){
        $this->getUrl();
    }

    public function getUrl(){
        //preluare parametrii din URL
        echo $_GET['url'];
    }
}