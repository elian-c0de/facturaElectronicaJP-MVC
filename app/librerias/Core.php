<?php

    // Mapear el url ingresada en el url del navegador
    /*
    1 controlador
    2- metodo
    3- parametro
    */

    class Core {
        protected $controladorActual = 'Login';
        protected $metodoActual = 'index';
        protected $parametros = [];

        public function __construct(){
            //print_r($this->getUrl());
            $url = $this->getUrl();
            
            if(isset($url)){
                 // buscar en controlador si el controlador existe
                 if (file_exists('../app/controladores/' . ucwords($url[0]) . '.php')){
                    // si exite se setear como controlador por defecto
                    $this->controladorActual = ucwords($url[0]);

                    //unset indice
                    unset($url[0]); 
                }

                
            }
           
            // requiere el controlador
            require_once '../app/controladores/' . $this->controladorActual . '.php';
            $this->controladorActual = new $this ->controladorActual;

            //verificar la segunda parte del url que seria el metodo
            if(isset($url[1])){
                if(method_exists($this->controladorActual, $url[1])){
                    //si se cargo chuequemos el metodo
                    $this->metodoActual = $url[1];
                    unset($url[1]);
                }
            }
            // echo $this->metodoActual;

             //obtener los posibles parametros
            $this->parametros = $url ? array_values($url) : [];
    
              //llmar callback con parametros array
            call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);
      
            unset($url[0]);

        }

        public function getUrl(){
            //echo $_GET['url'];

            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }

        }
    }




?>