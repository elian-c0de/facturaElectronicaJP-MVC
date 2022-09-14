<?php

//para redirecionar pagina
function redireccionar($pagina){
    header('location: ' . RUTA_URL . $pagina);
}


?>