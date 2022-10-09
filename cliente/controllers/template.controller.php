<?php

class TemplateController{

    static public function path(){
        return "http://localhost/sistemaF/cliente/";
    }



    public function index(){
        include "views/template.php";
    }
}