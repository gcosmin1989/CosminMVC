<?php

//Redirect helpers, flashed messages,
//Toate controllere pe care le vom folosii va folosii acest Controller, este baza, va manipula Models si Views

class Controller{
    //Incarcare Model
    public function model($model){
    // Solicitare fisier model
        require_once '../app/models/' . $model .'.php';

        //Instantiere model
        return new $model();
    }

    //Incarcare View, va prelua 2 parametrii
    public function view($view, $data=[]){
        if(file_exists('../app/views/' .$view .'.php')){
            require_once '../app/views/' .$view .'.php';
        }else{
            //View nu exista
            die('View nu exista');
        }
    }
}