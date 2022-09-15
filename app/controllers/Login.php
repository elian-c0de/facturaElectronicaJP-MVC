<?php 

class Login extends Controlador{


    public function __construct(){
        $this->usuarioModelo = $this->modelo('usuario');
        //echo 'controlador paginas cargada';
        //$this->articuloModelo = $this->modelo('Articulo');
    }

    public function index(){
        //$articulos = $this->articuloModelo->obtenerArticulos();
        // obntenber los usuarios
        $empresa = $this->usuarioModelo->obtenerUsuarios();
        $datos = [
            'empresa' => $empresa
            //'articulos' => $articulos
        ];
        $this->vista('paginas/inicio', $datos);
    }

}


?>