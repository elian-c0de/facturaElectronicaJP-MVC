<?php

use Paginas as GlobalPaginas;

class Paginas extends Controlador{
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

    public function agregar(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $datos = [
                'cod_empresa' => trim($_POST['cod_empresa']),
                'nom_empresa' => trim($_POST['nom_empresa']),
                'nom_abreviado' => trim($_POST['nom_abreviado'])
            
                
                    ];
                if($this->usuarioModelo->agregarUsuario($datos)){
                    redireccionar('/paginas');
                }else{
                    die('algo salio mal');
                }
        }else{
            $datos = [
                'cod_empresa' => '',
                'nom_empresa' => '',
                'nom_abreviado' => ''
            ];

            $this->vista('paginas/agregar',$datos);
        }
        echo "hoa  perro";
    
    }

    public function editar($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $datos = [
                'cod_empresa' => trim($_POST['cod_empresa']),
                'nom_empresa' => trim($_POST['nom_empresa']),
                'nom_abreviado' => trim($_POST['nom_abreviado'])

                    ];

                    print_r($datos);
                if($this->usuarioModelo->actualizarUsuario($datos)){
                    redireccionar('/paginas');
                }else{
                    die('algo salio mal');
                }
        }else{
           //obtener informacion de usuario dede el modelo
           $empresa = $this->usuarioModelo->obtenerUsuarioId($id);

           $datos = [
            'cod_empresa' => $empresa->cod_empresa,
            'nom_empresa' => $empresa->nom_empresa,
            'nom_abreviado' => $empresa->nom_abreviado
            ];

            $this->vista('paginas/editar',$datos);
        }
    }

    public function borrar($id){

        //obtener informacion de usuario dede el modelo
        $empresa = $this->usuarioModelo->obtenerUsuarioId($id);
        $datos = [
            'cod_empresa' => $empresa->cod_empresa,
            'nom_empresa' => $empresa->nom_empresa,
            'nom_abreviado' => $empresa->nom_abreviado
            ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $datos = [
                'cod_empresa' => $id
                 ];

                if($this->usuarioModelo->borrarUsuario($datos)){
                    redireccionar('/paginas');
                }else{
                    die('algo salio mal');
                }
        }

            $this->vista('paginas/borrar',$datos);
        
    }





    
}






?>