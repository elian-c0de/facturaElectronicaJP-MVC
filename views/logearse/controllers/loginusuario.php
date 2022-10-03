<?php
    session_start();
    include '../../../config/config.php';

    $usuario =$_POST['txtusuario'];
    $contrasena = $_POST['txtcontra'];

    // $queryone="SELECT * FROM gen_usuario WHERE cod_usuario='$usuario' and cod_passwd='$contrasena'";
    // $validar_login = sqlsrv_query($conn,$queryone);
    // $rowone = sqlsrv_fetch_array($validar_login);
    $query="  SELECT *  FROM gen_usuario u, gen_empresa e WHERE u.cod_usuario='$usuario' and u.cod_passwd='$contrasena' and u.cod_empresa = e.cod_empresa";
    $validar_user = sqlsrv_query($conn,$query);
    $row = sqlsrv_fetch_array($validar_user);

    if($row>0){
        if($usuario == 'administrador'){
            $_SESSION['user'] = $row['nom_usuario'];
            $_SESSION['empresa'] = $row['nom_empresa'];
            header("location: ../../../views/administrador");
            exit;
        }else{
            $_SESSION['user'] = $row['nom_usuario'];
            $_SESSION['empresa'] = $row['nom_empresa'];
            header("location: ../../../views/InformacionGeneral");
            exit;
        }
    }else{
        echo '
            <script>
                alert("!!Usuario o Contraseña Incorrectos!!, por favor Ingrese Correctamente los datos");
                window.location = "../../../views/logearse/"
            </script>
        ';
        exit;
    }

    // if($row>0){
    //     $_SESSION['user'] = $row['nom_usuario'];
    //     header("location: ../../../views/InformacionGeneral/");
    //     exit;
    // }else{
    //     echo '
    //         <script>
    //             alert("!!Usuario o Contraseña Incorrectos!!, por favor Ingrese Correctamente los datos");
    //             window.location = "../../../views/logearse/"
    //         </script>
    //     ';
    //     exit;
    // }
?>
