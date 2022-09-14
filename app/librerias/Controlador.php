<?php
    // clase controlador principal
    // se encarga de poder caragar los modelos y las vistas
    class Controlador{

        // metodo que nos permite cargar el modelo cargar modelo
        public function modelo($modelo){
            //cargar modelo
            require_once ('../app/modelos/' . $modelo . '.php');
            // instanaciar el modelo
           
            return new $modelo();
        }
        
        //Cargar vista
        public function vista($vista, $datos = []){
            //chequear ei el archivo vista existe
            if(file_exists('../app/vistas/' . $vista . '.php')){
                require_once '../app/vistas/' . $vista . '.php';
                
            }else{
                //si el archivo de la vista no existe 
                die("la vista no existe");
            }
            
        }

    }


?>