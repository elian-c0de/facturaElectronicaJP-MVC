<?php

// use Paginas as GlobalPaginas;

class Establecimientos extends Controlador{
    public function __construct(){
        $this->establecimientosModelo = $this->modelo('establecimientosmodelo');
        //echo 'controlador paginas cargada';
        //$this->articuloModelo = $this->modelo('Articulo');
    }

    public function index(){
        //$articulos = $this->articuloModelo->obtenerArticulos();
        // obntenber los usuarios
        $establecimientos = $this->establecimientosModelo->obtenerestablecimientos();
        $datos = [
            'establecimientos' => $establecimientos
            //'articulos' => $articulos
        ];
        $this->vista('establecimientos/inicio', $datos);
    }

    public function agregar(){

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $datos = [
                'cod_empresa' => trim('2'),
                'cod_establecimiento' => trim($_POST['cod_establecimiento']),
                'txt_descripcion' => trim($_POST['txt_descripcion']),
                'txt_direccion' => trim($_POST['txt_direccion']),
                'sts_matriz' => trim('C'),
                // if(isset($_POST['sts_matriz'])){
                //     'sts_matriz' => trim($_POST['sts_matriz']),
                // }
                'sts_local' => trim('C'),
                // if(isset($_POST['sts_local'])){
                //     'sts_local' => trim($_POST['sts_local']),
                // }
                'fec_actualiza' => date('m-d-Y h:i:s a', time())
            
                
                    ];
                    print_r($datos);
                if($this->establecimientosModelo->agregarEstablecimientos($datos)){
                    redireccionar('/establecimientos');
                }else{
                    die('algo salio mal');
                }
        }else{
            $datos = [
                'cod_establecimiento' => '',
                'txt_descripcion' =>'',
                'txt_direccion' => '',
                'sts_matriz' => '',
                'sts_local' => ''
            ];

            // $this->vista('linea/agregar',$datos);+
            $this->vista('establecimientos',$datos);
        }
       
    
    }

    public function editar($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $datos = [
                'cod_empresa' => trim($_POST['cod_empresa']),
                'cod_linea' => trim($_POST['cod_linea']),
                'cod_sublinea' => trim($_POST['cod_sublinea']),
                'txt_descripcion' => trim($_POST['txt_descripcion']),
                'fec_actualiza' => date('m-d-Y h:i:s a', time())

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

    public function borrar($id,$idsub){

        //obtener informacion de linea dede el modelo
        $linea = $this->lineaModelo->obtenerLineaId($id,$idsub);
        print_r($linea);
        var_dump($linea);
        $datos = [
            'cod_linea' => $linea->cod_linea,
            'cod_sublinea' => $linea->cod_sublinea
            ];

        // if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //     $datos = [
        //         'cod_empresa' => $id
        //          ];

                if($this->lineaModelo->borrarLinea($datos)){
                    // redireccionar('/Linea');
                }else{
                    die('algo salio mal');
                }
        // }

            $this->vista('Linea/borrar',$datos);
        
    }
}
?>