
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

    //var data = new FormData();

//     data.append("cod_usuario",$("#gen_usuario").val());
    
//     data.append("cod_empresa",localStorage.getItem('cod'));

    $url = "gen_punto_emision?linkTo=cod_establecimiento&equalTo=".$_POST['id'];
    
    $method = "GET";
    $fields = array();
    $response = CurlController::request($url, $method, $fields)->result;
    $response = json_encode($response);
    $response = json_decode($response,true);
    echo '<pre>'; print_r($response); echo '</pre>';
    //echo '<pre>'; print_r($response[0]); echo '</pre>';
    $html="";
    foreach ($response as $key => $value){
        $html.="<option value='".$value['cod_punto_emision']."'>".$value['cod_punto_emision']."</option>";
        echo $html;
    }
    return;
    //echo  json_encode($response->result);

}else{
    echo "NO HAY POST";
}

?>