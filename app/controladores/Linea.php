<?php

// use Paginas as GlobalPaginas;

class Linea extends Controlador{
    public function __construct(){
        $this->lineaModelo = $this->modelo('Lineamodelo');
        //echo 'controlador paginas cargada';
        //$this->articuloModelo = $this->modelo('Articulo');
    }

    public function index(){
        //$articulos = $this->articuloModelo->obtenerArticulos();
        // obntenber los usuarios
        $linea = $this->lineaModelo->obtenerLinea();
        $datos = [
            'linea' => $linea
            //'articulos' => $articulos
        ];
        $this->vista('lineaproducto/inicio', $datos);
    }

    public function agregar(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $datos = [
                'cod_empresa' => trim($_POST['cod_empresa']),
                'cod_linea' => trim($_POST['cod_linea']),
                'cod_sublinea' => trim($_POST['cod_sublinea']),
                'txt_descripcion' => trim($_POST['txt_descripcion'])
                // 'fec_actualiza' => trim($_POST['fec_actualiza'])
            
                
                    ];
                    print_r($datos);
                if($this->lineaModelo->agregarLinea($datos)){
                    redireccionar('/linea');
                }else{
                    die('algo salio mal');
                }
        }else{
            $datos = [
                'cod_empresa' => '',
                'cod_linea' =>'',
                'cod_sublinea' => '',
                'txt_descripcion' => ''
                // 'fec_actualiza' => ''
            ];

            // $this->vista('linea/agregar',$datos);+
            $this->vista('lineaproducto',$datos);
        }
       
    
    }

    public function editar($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $datos = [
                'cod_empresa' => trim($_POST['cod_empresa']),
                'cod_linea' => trim($_POST['cod_linea']),
                'cod_sublinea' => trim($_POST['cod_sublinea']),
                'txt_descripcion' => trim($_POST['txt_descripcion']),
                'fec_actualiza' => trim($_POST['fec_actualiza'])

                    ];

                    print_r($datos);
                if($this->usuarioModelo->actualizarUsuario($datos)){
                    redireccionar('/lineaproducto');
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