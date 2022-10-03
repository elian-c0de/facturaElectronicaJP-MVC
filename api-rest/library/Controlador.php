<?php
    // clase controlador principal
    // se encarga de poder caragar los modelos y las vistas
    class Controlador{

        // metodo que nos permite cargar el modelo cargar modelo
        public function modelo($modelo){
            //cargar modelo
            require_once ('models/' . $modelo . '.php');
            
            // instanaciar el modelo
           
            return new $modelo();
        }
    }

?>