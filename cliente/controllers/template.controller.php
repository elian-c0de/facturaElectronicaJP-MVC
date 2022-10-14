<?php

class TemplateController{

    static public function path(){
        return "http://localhost/facturaElectronicaJP-MVC/cliente/";
    }



    public function index(){
        include "views/template.php";
    }


    static public function htmlClean($code){

		$search = array('/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s');

		$replace = array('>','<','\\1');

		$code = preg_replace($search, $replace, $code);

		$code = str_replace("> <", "><", $code);

		return $code;	
	}


}