<?php
require_once("library/Controlador.php");
class ControladorCajas extends Controlador
{
    public function __construct()
    {
        $this->instanciaModelo = $this->modelo("Get");
        //echo 'controlador paginas cargada';
        //$this->articuloModelo = $this->modelo('Articulo');
    }

    // el Index es para Obtener los registros
    public function index()
    {
        $cajas = $this->instanciaModelo->obtenerCajas("srja_caja");
        
        $json = array(

            "status" => 200,
            "total_registros" => count($cajas),
            "detalle" => $cajas

        );
        echo json_encode($json, true);
        return;
    }

    public function indexID($id)
    {



        $cajas = $this->instanciaModelo->obtenerCajaID("srja_caja", $id);
        if (!empty($cajas)) {
            $json = array(
                "status" => 200,
                "detalle" => $cajas
            );
            echo json_encode($json, true);
            return;
        } else {

            $json = array(

                "status" => 200,
                "total_registros" => 0,
                "detalles" => "No hay ningún curso registrado"

            );

            echo json_encode($json, true);

            return;
        }
    }

    public function create($datos)
    {
        //chequear si los datos se repiten
        $cajasR = $cajas = $this->instanciaModelo->obtenerCajas("srja_caja");
        foreach ($cajasR as $key => $value) {
          if ($value->cod_empresa == $datos["cod_empresa"] && $value->cod_caja == $datos["cod_caja"]) {
            $json = array(
              "status" => 404,
              "detalle" => "el cod_empresa y el cod_caja ya existen"
            );
            echo json_encode($json, true);
            return;
          }
          
        }

        $datos = array(
            "cod_empresa" => $datos["cod_empresa"],
            "cod_caja" => $datos["cod_caja"],
            "txt_descripcion" => $datos["txt_descripcion"],
            "cod_usuario" => $datos["cod_usuario"],
            "fec_actualiza" => date('Y-m-d h:i:s')

        );

        $cajas = $this->instanciaModelo->agregarCajas("srja_caja", $datos);

        if ($cajas = TRUE) {

            $json = array(
                "status" => 200,
                "detalle" => "Registro exitoso, su caja ha sido guardado"
            );

            echo json_encode($json, true);

            return;
        }
        echo "lo dañaste perro xd";
    }



    public function update($id, $datos)
    {


        $cajas = $this->instanciaModelo->obtenerCajaID("srja_caja", $id);
        print_r($cajas);

        if (!empty($cajas)) {

            $datos = array(
                // "cod_empresa" => $datos["cod_empresa"],
                "cod_caja" => $id,
                "txt_descripcion" => $datos["txt_descripcion"],
                "cod_usuario" => $datos["cod_usuario"],
                "fec_actualiza" => date('Y-m-d h:i:s')
            );

            $cajas = $this->instanciaModelo->actualizarCaja("srja_caja", $datos);

            if ($cajas == true) {
                $json = array(
                    "status" => 200,
                    "detalle" => "Registro exitoso, su curso ha sido actualizado"

                );

                echo json_encode($json, true);
                return;
            }
        } else {
            $json = array(

                "status" => 404,
                "detalle" => "No está autorizado para modificar este curso"

            );

            echo json_encode($json, true);

            return;
        }
    }






    public function delete($id1,$id2)
    {
        
        $cajas = $this->instanciaModelo->eliminarCaja("srja_caja", $id1,$id2);

        if($cajas == true){


              $json = array(

                            "status"=>200,
                            "detalle"=>"se ha borrado el curso"
                          
                          );

                        echo json_encode($json, true);

                        return;



        }
    }

    private function validacion()
    {

    }
}
