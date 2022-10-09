<?php

class TemplateController{

    static public function path(){
        return "http://localhost/facturaElectronicaJP-MVC/cliente/";
    }



    public function index(){
        include "views/template.php";
    }
}