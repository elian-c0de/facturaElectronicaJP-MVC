
<?php
require_once ("../controllers/usuarios.controller.php");
require_once ("../controllers/curl.controller.php");
if (isset($_POST['id'])) {
    // require_once "conexion.php";
    // $user=new Conexion();
    // $u=$user->buscar("gen_punto_emision","cod_punto_emision=".$_POST['id']);
    // $html="";
    // //
    // foreach ($u as $value){
    //     $html.="<option value='".$value['id']."'>".$value['cod_punto_emision']."</option>";
    //     echo $html;
    // }
    $url = "gen_punto_emision?linkTo=cod_establecimiento&equalTo=".$_POST['id'];
    
    $method = "GET";
    $fields = array();
    $response = CurlController::request($url, $method, $fields)->result;
    //echo '<pre>'; print_r($response[0]); echo '</pre>';
    foreach ($response as $value){
        //$html.="<option value='".$value['cod_punto_emision']."'>".$value['cod_punto_emision']."</option>";
        echo '<pre>'; print_r($value[0]["cod_punto_emision"]); echo '</pre>';
        //echo $html;
    }
    //echo  json_encode($response->result);

}else{
    echo "NO HAY POST";
}

?>