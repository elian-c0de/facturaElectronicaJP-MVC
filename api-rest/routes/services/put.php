<?php
require_once "library/Base.php";
include_once "controllers/put.controller.php";


if (isset($_GET["id"]) && isset($_GET["nameId"]) && !isset($_GET["id2"]) && !isset($_GET["nameId2"])) {

    $data = array();

    parse_str(file_get_contents('php://input'), $data);

    $columns = array();

    foreach (array_keys($_POST) as $key => $value) {
        array_push($columns, $value);
    }
    array_push($columns, $_GET['nameId']);

    $columns = array_unique($columns);

    $this->db = new Base;

    //validar que la tabla y las columas existan en la base de datos
    if (empty($this->db->getColumsData($table, $columns))) {
        $json = array(
            'status' => 400,
            'result' => "Error: los datos del formulario no coinciden con la base de datos"
        );

        echo json_encode($json, http_response_code($json["status"]));
        return;
    }


    if (isset($_GET["token"])) {
        $validate = Base::tokenValidate($_GET["token"]);


        //cuando el token es valido
        if ($validate == "ok") {

     //solictamos respuesta del controlador para crear datos en cualquier tabla
     $response = new PutController();
     $response->putData($table, $data, $_GET["id"], $_GET["nameId"]);
        }

        // error cuando el token a expirado
        if ($validate == "expired") {
            $json = array(
                'status' => 303,
                'result' => "Error: the token has expired"
            );

            echo json_encode($json, http_response_code($json["status"]));
            return;
        }

        // error cuanel el token no coinciden en bd
        if ($validate == "no-auth") {
            $json = array(
                'status' => 400,
                'result' => "Error: the user is not authorized"
            );

            echo json_encode($json, http_response_code($json["status"]));
            return;
        }



        // erroc cuandos e solicita el token para realizar la accion
    } else {

        $json = array(
            'status' => 400,
            'result' => "Error: Authorization required"
        );

        echo json_encode($json, http_response_code($json["status"]));
        return;
    }


}







if (isset($_GET["id"]) && isset($_GET["nameId"]) && isset($_GET["id2"]) && isset($_GET["nameId2"])) {
    
    $data = array();
 
   

    parse_str(file_get_contents('php://input'), $data);

    $columns = array();

    foreach (array_keys($_POST) as $key => $value) {
        array_push($columns, $value);
    }

    array_push($columns, $_GET['nameId']);
    array_push($columns, $_GET['nameId2']);

    $columns = array_unique($columns);




    $this->db = new Base;

    //validar que la tabla y las columas existan en la base de datos
    if (empty($this->db->getColumsData($table, $columns))) {

        $json = array(
            'status' => 400,
            'result' => "Error: los datos del formulario no coinciden con la base de datos"
        );

        echo json_encode($json, http_response_code($json["status"]));
        return;
    }

    if (isset($_GET["token"])) {
        $validate = Base::tokenValidate($_GET["token"]);


        //cuando el token es valido
        if ($validate == "ok") {

            //solictamos respuesta del controlador para crear datos en cualquier tabla
            $response = new PutController();
            $response->putData2ids($table, $data, $_GET["id"], $_GET["nameId"], $_GET["id2"], $_GET["nameId2"]);
        }

        // error cuando el token a expirado
        if ($validate == "expired") {
            $json = array(
                'status' => 303,
                'result' => "Error: the token has expired"
            );

            echo json_encode($json, http_response_code($json["status"]));
            return;
        }

        // error cuanel el token no coinciden en bd
        if ($validate == "no-auth") {
            $json = array(
                'status' => 400,
                'result' => "Error: the user is not authorized"
            );

            echo json_encode($json, http_response_code($json["status"]));
            return;
        }



        // erroc cuandos e solicita el token para realizar la accion
    } else {

        $json = array(
            'status' => 400,
            'result' => "Error: Authorization required"
        );

        echo json_encode($json, http_response_code($json["status"]));
        return;
    }
}
