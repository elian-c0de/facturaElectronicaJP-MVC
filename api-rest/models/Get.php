<?php

use function PHPSTORM_META\type;

require_once "conexion.php";
require_once "library/Base.php";

class Get
{
    private $db;



    public function __construct()
    {
        $this->db = new Base;
    }


    //peticiones get sin filtros
    public function obtenerData($table, $select, $orderBy, $orderMode, $startAt,$endAt,$orderAt)
    {

        $selectArray = explode(",",$select);

        //validar exitencia de la tabla y las columnas
        if (empty($this->db->getColumsData($table,$selectArray))) {
            return null;
        }


        // sin order ni limitar datos

        $this->db->query("SELECT $select FROM  $table");



        //ordenar datos sin limites
        if ($orderBy != null && $orderMode != null && $startAt == null && $endAt == null && $orderAt == null) {
            
            $this->db->query("SELECT $select FROM $table order by $orderBy $orderMode");
            
        }

        //ordernar datos y limitar datos
        if ($orderBy != null && $orderMode != null && $startAt != null && $endAt != null && $orderAt != null) {
            
            $this->db->query("SELECT $select FROM $table ORDER BY $orderAt,$orderBy $orderMode OFFSET $startAt ROWS FETCH NEXT $endAt ROWS ONLY;");
        }

        //limitar datos sin ordenar
        if ($orderBy == null && $orderMode == null && $startAt != null && $endAt != null && $orderAt != null) {
            $this->db->query("SELECT $select FROM $table ORDER BY $orderAt OFFSET $startAt ROWS FETCH NEXT $endAt ROWS ONLY;");

        }

        $resultados = $this->db->registros();
        return $resultados;
    }

    public function obtenerDataFilter($table, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt)
    {   
        $selectArray = explode(",",$select);
        $linkToArray = explode(",",$linkTo);
        foreach($linkToArray as $key => $value){
            array_push($selectArray,$value);
        }

        $selectArray = array_unique($selectArray);

        //validar exitencia de la tabla
        if (empty($this->db->getColumsData($table,$selectArray))) {
            return null;
        }

        
        $equalToArray = explode(",", $equalTo);
        $linkToText = "";

        if (count($linkToArray) > 1) {
            foreach ($linkToArray as $key => $value) {
                if ($key > 0) {
                    $linkToText .= "AND " . $value . " = :" . $value . " ";
                }
            }
        }
        // echo '<pre>'; print_r($linkToText); echo '</pre>';
        // return;

        //ordener sin limitar datos
        $this->db->query("SELECT $select FROM  $table where $linkToArray[0] = :$linkToArray[0] $linkToText");

        //ordener datos sin limites
        if ($orderBy != null && $orderMode != null && $startAt == null) {
            $this->db->query("SELECT $select FROM  $table where $linkToArray[0] = :$linkToArray[0] $linkToText order by $orderBy $orderMode");
        }

        //ordernar datos y limitar datos
        if ($orderBy != null && $orderMode != null && $startAt != null) {

            $this->db->query("SELECT top $startAt $select FROM  $table where $linkToArray[0] = :$linkToArray[0] $linkToText order by $orderBy $orderMode");
        }
        //limitar datos sin ordenar
        if ($orderBy == null && $orderMode == null && $startAt != null) {

            $this->db->query("SELECT top $startAt $select FROM  $table where $linkToArray[0] = :$linkToArray[0] $linkToText");
        }

        foreach ($linkToArray as $key => $value) {
            $this->db->bind(":" . $value, $equalToArray[$key]);
        }
        
        $resultados = $this->db->registros();
        
        return $resultados;
    }



    //peticiones get sin filtros entr tablas relacioanadas
    public function obtenerRelData($rel, $type, $select, $orderBy, $orderMode, $startAt)
    {
        $relArray = explode(",", $rel);
      
        $typeArray = explode(",", $type);
        
        $innerJoinText = "";
     

        if (count($relArray) > 1) {

            if(count($relArray) == count($typeArray)){

                
                foreach ($relArray as $key => $value) {
        
                    //validar exitencia de la tabla
                    if (empty($this->db->getColumsData($value,["*"]))) {
                        return null;
                    }
                    if ($key > 0) {
                        $innerJoinText .= "INNER JOIN " . $value . " ON " . $relArray[0] . "." . $typeArray[0] . " = " . $value . "." . $typeArray[$key] . " ";
                    }
                }

            }else{

                if(count($relArray) < count($typeArray)){


                    foreach ($relArray as $key => $value) {
        
                        //validar exitencia de la tabla
                        if (empty($this->db->getColumsData($value,["*"]))) {
                            return null;
                        }
                        if ($key > 0) {
                            $innerJoinText .= "LEFT join " . $value . " ON " . $relArray[0] . "." . $typeArray[0] . " = " . $value . "." . $typeArray[$key] . " and " . $relArray[0] . "." . $typeArray[2] . " = " . $value . "." . $typeArray[$key+2] . " ";
                            


                            // inner join ecmp_linea ON ecmp_inventario.cod_linea = ecmp_linea.cod_linea and ecmp_inventario.cod_sublinea = ecmp_linea.cod_sublinea

                        }
                    }


                  
                    


                }



            }

            
     
      

          

            // sin ordener y sin limitar datos
            $this->db->query("SELECT $select FROM $relArray[0] $innerJoinText");
            

            // //ordenar datos sin limites
            // if ($orderBy != null && $orderMode != null && $startAt == null) {
            //     $this->db->query("SELECT $select FROM  $relArray[0] $innerJoinText order by $orderBy $orderMode");
                
            // }

            // //ordernar datos y limitar datos
            // if ($orderBy != null && $orderMode != null && $startAt != null) {
            //     $this->db->query("SELECT top $startAt $select FROM  $relArray[0] $innerJoinText order by $orderBy $orderMode");
            // }

            // //limitar datos sin ordenar
            // if ($orderBy == null && $orderMode == null && $startAt != null) {
            //     $this->db->query("SELECT top $startAt $select FROM  $relArray[0] $innerJoinText");
            // }

            try {
                $resultados = $this->db->registros();
             
            } catch (PDOException $Exception) {
                return null;
                //throw $th;
            }
            
            return $resultados;
          
        } else {
            return null;
        }
    }

    public function obtenerRelDataFilter($rel, $type, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt)
    {

        //organizamos los filtros

        $linkToArray = explode(",", $linkTo);
        $equalToArray = explode(",", $equalTo);
        $linkToText = "";

        if (count($linkToArray) > 1) {
            foreach ($linkToArray as $key => $value) {
                     //validar exitencia de la tabla
                
                if ($key > 0) {
                    $linkToText .= "AND " . $value . " = :" . $value . " ";
                }
            }
        }

        $relArray = explode(",", $rel);
        $typeArray = explode(",", $type);
        $innerJoinText = "";

        if (count($relArray) > 1) {
            foreach ($relArray as $key => $value) {
                     //validar exitencia de la tabla
                     if (empty($this->db->getColumsData($value,["*"]))) {
                        return null;
                    }
                if ($key > 0) {
                    $innerJoinText .= "inner join " . $value . " ON " . $relArray[0] . "." . $typeArray[0] . " = " . $value . "." . $typeArray[$key] . " ";
                }
            }


            //organizamos las relaciones

            // sin ordener y sin limitar datos
            $this->db->query("SELECT $select FROM $relArray[0] $innerJoinText where $linkToArray[0] = :$linkToArray[0] $linkToText");

            //ordenar datos sin limites
            if ($orderBy != null && $orderMode != null && $startAt == null) {
                $this->db->query("SELECT $select FROM  $relArray[0] $innerJoinText where $linkToArray[0] = :$linkToArray[0] $linkToText order by $orderBy $orderMode");
            }

            //ordernar datos y limitar datos
            if ($orderBy != null && $orderMode != null && $startAt != null) {
                $this->db->query("SELECT top $startAt $select FROM  $relArray[0] $innerJoinText where $linkToArray[0] = :$linkToArray[0] $linkToText order by $orderBy $orderMode");
            }

            //limitar datos sin ordenar
            if ($orderBy == null && $orderMode == null && $startAt != null) {
                $this->db->query("SELECT top $startAt $select FROM  $relArray[0] $innerJoinText where $linkToArray[0] = :$linkToArray[0] $linkToText");
            }

            foreach ($linkToArray as $key => $value) {
                $this->db->bind(":" . $value, $equalToArray[$key]);
            }

            try {
                $resultados = $this->db->registros();
            } catch (PDOException $Exception) {
                return null;
                //throw $th;
            }
            return $resultados;
        } else {
            return null;
        }
    }





    public function obtenerDataSearch($table, $select, $linkTo, $search, $orderBy, $orderMode, $startAt, $endAt, $orderAt)
    {
        $selectArray = explode(",",$select);
        $linkToArray = explode(",",$linkTo);
        foreach($linkToArray as $key => $value){
            array_push($selectArray,$value);
        }

        $selectArray = array_unique($selectArray);

        //validar exitencia de la tabla
        if (empty($this->db->getColumsData($table,$selectArray))) {
            return null;
        }

        
        $searchToArray = explode(",", $search);
        $linkToText = "";

        if (count($linkToArray) > 1) {
            foreach ($linkToArray as $key => $value) {
                if ($key > 0) {
                    $linkToText .= "AND " . $value . " = :" . $value . " ";
                }
            }
        }

        // sin order ni limitar datos

        $this->db->query("SELECT $select FROM  $table where $linkToArray[0] like '%$searchToArray[0]%' $linkToText");



        //ordenar datos sin limites
        if ($orderBy != null && $orderMode != null && $startAt == null) {
            $this->db->query("SELECT $select FROM  $table where $linkToArray[0] like '%$searchToArray[0]%' $linkToText order by $orderBy $orderMode");
        }




        //ordernar datos y limitar datos
        if ($orderBy != null && $orderMode != null && $startAt != null) {
            $this->db->query("SELECT $select FROM $table where $linkToArray[0] like '%$searchToArray[0]%' $linkToText ORDER BY $orderAt,$orderBy $orderMode OFFSET $startAt ROWS FETCH NEXT $endAt ROWS ONLY;");

        }

        //limitar datos sin ordenar
        if ($orderBy == null && $orderMode == null && $startAt != null) {
            $this->db->query("SELECT top $startAt $select FROM  $table where $linkToArray[0] like '%$searchToArray[0]%' $linkToText'");
            $this->db->query("SELECT $select FROM $table where $linkToArray[0] like '%$searchToArray[0]%' $linkToText ORDER BY $orderAt OFFSET $startAt ROWS FETCH NEXT $endAt ROWS ONLY;");

        }

        foreach ($linkToArray as $key => $value) {
            if ($key > 0) {
                $this->db->bind(":" . $value, $searchToArray[$key]);
            }
        }

        try {
            $resultados = $this->db->registros();
        } catch (PDOException $Exception) {
            return null;
            //throw $th;
        }
        return $resultados;

        // $linkToArray = explode(",", $linkTo);
        // $equalToArray = explode("_", $sear);
        // $linkToText = "";

        // if (count($linkToArray) > 1) {
        //     foreach ($linkToArray as $key => $value) {
        //         if ($key > 0) {
        //             $linkToText .= "AND " . $value . " = :" . $value . " ";
        //         }
        //     }
        // }
        // // echo '<pre>'; print_r($linkToText); echo '</pre>';
        // // return;

        // //ordener sin limitar datos
        // $this->db->query("SELECT $select FROM  $table where $linkToArray[0] = :$linkToArray[0] $linkToText");

        // //ordener datos sin limites
        // if ($orderBy != null && $orderMode != null && $startAt == null) {
        //     $this->db->query("SELECT $select FROM  $table where $linkToArray[0] = :$linkToArray[0] $linkToText order by $orderBy $orderMode");
        // }

        // //ordernar datos y limitar datos
        // if ($orderBy != null && $orderMode != null && $startAt != null) {

        //     $this->db->query("SELECT top $startAt $select FROM  $table where $linkToArray[0] = :$linkToArray[0] $linkToText order by $orderBy $orderMode");
        // }
        // //limitar datos sin ordenar
        // if ($orderBy == null && $orderMode == null && $startAt != null) {

        //     $this->db->query("SELECT top $startAt $select FROM  $table where $linkToArray[0] = :$linkToArray[0] $linkToText");
        // }

        // foreach ($linkToArray as $key => $value) {
        //     $this->db->bind(":" . $value, $equalToArray[$key]);
        // }


        // $resultados = $this->db->registros();
        // return $resultados;
    }


    public function getDataRange($table, $select, $linkTo, $between1, $between2, $orderBy, $orderMode, $startAt,$endAt,$orderAt, $filterTo, $inTo)
    {

        $linkToArray = explode(",",$linkTo);
        if($filterTo != null){
            $filterToArray = explode(",",$filterTo);
        }else{
            $filterToArray = array();
        }
      
        $selectArray = explode(",",$select);
        foreach ($linkToArray as $key => $value) {
            array_push($selectArray, $value);
        }
        foreach ($filterToArray as $key => $value) {
            array_push($selectArray,$value);
        }
        $selectArray = array_unique($selectArray);

        if (empty($this->db->getColumsData($table,$selectArray))) {
            return null;
        }

  
        
        $filter = "";
        
        if ($filterTo != null && $inTo != null) {
            $filter = 'AND ' . $filterTo . ' IN (' . $inTo . ')';
        }
 
        $this->db->query("SELECT $select FROM  $table where $linkTo between '$between1' and '$between2' $filter");
        
  
        



        //ordenar datos sin limites
        if ($orderBy != null && $orderMode != null && $startAt == null) {
            $this->db->query("SELECT $select FROM $table where $linkTo between '$between1' and '$between2' $filter  order by $orderBy $orderMode");
        }

        // con rangos
        //ordernar datos y limitar datos
        if ($orderBy != null && $orderMode != null && $startAt != null) {
            // $this->db->query("SELECT top $startAt $select FROM $table where $linkTo between '$between1' and '$between2' $filter order by $orderBy $orderMode");
            $this->db->query("SELECT $select FROM $table where $linkTo between '$between1' and '$between2' $filter ORDER BY $orderAt,$orderBy $orderMode OFFSET $startAt ROWS FETCH NEXT $endAt ROWS ONLY;");
        }

        //limitar datos sin ordenar
        if ($orderBy == null && $orderMode == null && $startAt != null) {
     
            $this->db->query("SELECT $select FROM $table where $linkTo between '$between1' and '$between2' $filter ORDER BY $orderAt OFFSET $startAt ROWS FETCH NEXT $endAt ROWS ONLY;");

        }

        try {
            $resultados = $this->db->registros();
        } catch (PDOException $Exception) {
            return null;
            //throw $th;
        }
        return $resultados;
    }

    // peticiones get con seleccion de rangos y filtros y relaciones
    public function getRelDataRange($rel, $type, $select, $linkTo, $between1, $between2, $orderBy, $orderMode, $startAt,$endAt,$orderAt, $filterTo, $inTo)
    {
        // $linkToArray = explode(",",$linkTo);
        // $filterToArray = explode(",",$filterTo);
        // $selectArray = explode(",",$select);
        // foreach ($linkToArray as $key => $value) {
        //     array_push($selectArray, $value);
        // }
        // foreach ($filterToArray as $key => $value) {
        //     array_push($selectArray,$value);
        // }
        // $selectArray = array_unique($selectArray);
        

        $filter = "";
        if ($filterTo != null && $inTo != null) {
            $filter = 'AND ' . $filterTo . ' IN (' . $inTo . ')';
        }

        $relArray = explode(",", $rel);
        $typeArray = explode(",", $type);
        $innerJoinText = "";

        if (count($relArray) > 1) {
            if(count($relArray) == count($typeArray)){

                
                foreach ($relArray as $key => $value) {
        
                    //validar exitencia de la tabla
                    if (empty($this->db->getColumsData($value,["*"]))) {
                        return null;
                    }
                    if ($key > 0) {
                        $innerJoinText .= "INNER JOIN " . $value . " ON " . $relArray[0] . "." . $typeArray[0] . " = " . $value . "." . $typeArray[$key] . " ";
                    }
                }

            }else{

                if(count($relArray) < count($typeArray)){


                    foreach ($relArray as $key => $value) {
        
                        //validar exitencia de la tabla
                        if (empty($this->db->getColumsData($value,["*"]))) {
                            return null;
                        }
                        if ($key > 0) {
                            $innerJoinText .= "LEFT join " . $value . " ON " . $relArray[0] . "." . $typeArray[0] . " = " . $value . "." . $typeArray[$key] . " and " . $relArray[0] . "." . $typeArray[2] . " = " . $value . "." . $typeArray[$key+2] . " ";
                            


                            // inner join ecmp_linea ON ecmp_inventario.cod_linea = ecmp_linea.cod_linea and ecmp_inventario.cod_sublinea = ecmp_linea.cod_sublinea

                        }
                    }


                  
                    


                }



            }





            $this->db->query("SELECT $select FROM  $relArray[0] $innerJoinText where $linkTo between '$between1' and '$between2' $filter");



            //ordenar datos sin limites
            if ($orderBy != null && $orderMode != null && $startAt == null) {
            
                $this->db->query("SELECT $select FROM $relArray[0]  $innerJoinText where $linkTo between '$between1' and '$between2' $filter  order by $orderBy $orderMode");
            }

            //ordernar datos y limitar datos
            if ($orderBy != null && $orderMode != null && $startAt != null) {
                // echo '<pre>'; print_r("SELECT $select FROM $relArray[0] $innerJoinText where $linkTo between '$between1' and '$between2' $filter ORDER BY $orderAt,$orderBy $orderMode OFFSET $startAt ROWS FETCH NEXT $endAt ROWS ONLY;"); echo '</pre>';
                // $this->db->query("SELECT top $startAt $select FROM $relArray[0] $innerJoinText where $linkTo between '$between1' and '$between2' $filter order by $orderBy $orderMode");
                $this->db->query("SELECT $select FROM $relArray[0] $innerJoinText where $linkTo between '$between1' and '$between2' $filter ORDER BY $orderAt,$orderBy $orderMode OFFSET $startAt ROWS FETCH NEXT $endAt ROWS ONLY;");
                
            }

            //limitar datos sin ordenar
            if ($orderBy == null && $orderMode == null && $startAt != null) {
                
                $this->db->query("SELECT top $startAt $select FROM $relArray[0] $innerJoinText where $linkTo between '$between1' and '$between2' $filter");
            }

            try {
                $resultados = $this->db->registros();
            } catch (PDOException $Exception) {
                return null;
                //throw $th;
            }
            return $resultados;
        } else {
            return null;
        }
    }



    public function obtenerRelDataSearch($rel, $type, $select, $linkTo, $search, $orderBy, $orderMode, $startAt, $endAt, $orderAt,$filterTo,$inTo)
    {

       
        $linkToArray = explode(",",$linkTo);
     


        $searchToArray = explode(",", $search);
        $linkToText = "";

        if (count($linkToArray) > 1) {
            foreach ($linkToArray as $key => $value) {
                if ($key > 0) {
                    $linkToText .= "AND " . $value . " = :" . $value . " ";
                }
            }
        }

        $relArray = explode(",", $rel);
        $typeArray = explode(",", $type);
        $innerJoinText = "";

        if (count($relArray) > 1) {
            if(count($relArray) == count($typeArray)){

                
                foreach ($relArray as $key => $value) {
        
                    //validar exitencia de la tabla
                    if (empty($this->db->getColumsData($value,["*"]))) {
                        return null;
                    }
                    if ($key > 0) {
                        $innerJoinText .= "INNER JOIN " . $value . " ON " . $relArray[0] . "." . $typeArray[0] . " = " . $value . "." . $typeArray[$key] . " ";
                    }
                }

            }else{

                if(count($relArray) < count($typeArray)){


                    foreach ($relArray as $key => $value) {
        
                        //validar exitencia de la tabla
                        if (empty($this->db->getColumsData($value,["*"]))) {
                            return null;
                        }
                        if ($key > 0) {
                            $innerJoinText .= "LEFT join " . $value . " ON " . $relArray[0] . "." . $typeArray[0] . " = " . $value . "." . $typeArray[$key] . " and " . $relArray[0] . "." . $typeArray[2] . " = " . $value . "." . $typeArray[$key+2] . " ";
                            


                            // inner join ecmp_linea ON ecmp_inventario.cod_linea = ecmp_linea.cod_linea and ecmp_inventario.cod_sublinea = ecmp_linea.cod_sublinea

                        }
                    }


                  
                    


                }



            }


            //organizamos las relaciones

            // sin ordener y sin limitar datos
            $this->db->query("SELECT $select FROM $relArray[0] $innerJoinText where $linkToArray[0] like '%$searchToArray[0]%' $linkToText");

            //ordenar datos sin limites
            if ($orderBy != null && $orderMode != null && $startAt == null) {
                $this->db->query("SELECT $select FROM  $relArray[0] $innerJoinText where $linkToArray[0] like '%$searchToArray[0]%' $linkToText order by $orderBy $orderMode");
            }

            //ordernar datos y limitar datos
            if ($orderBy != null && $orderMode != null && $startAt != null) {
           
                $this->db->query("SELECT $select FROM $relArray[0] $innerJoinText where $inTo = $filterTo and $linkToArray[0] like '%$searchToArray[0]%' $linkToText ORDER BY $orderAt,$orderBy $orderMode OFFSET $startAt ROWS FETCH NEXT $endAt ROWS ONLY;");
                
                

            }

            //limitar datos sin ordenar
            if ($orderBy == null && $orderMode == null && $startAt != null) {
                // $this->db->query("SELECT top $startAt $select FROM  $relArray[0] $innerJoinText where $linkToArray[0] like '%$searchToArray[0]%' $linkToText");
                $this->db->query("SELECT $select FROM $relArray[0] $innerJoinText where $linkToArray[0] like '%$searchToArray[0]%' $linkToText ORDER BY $orderAt OFFSET $startAt ROWS FETCH NEXT $endAt ROWS ONLY;");

            }
            foreach ($linkToArray as $key => $value) {
                if ($key > 0) {
                    $this->db->bind(":" . $value, $searchToArray[$key]);
                }
            }

            try {
                $resultados = $this->db->registros();
            } catch (PDOException $Exception) {
                return null;
                //throw $th;
            }
            return $resultados;
        } else {
            return null;
        }
    }




    //

    public function agregarCajas($tabla, $datos)
    {
        $this->db->query("INSERT INTO $tabla (cod_empresa,cod_caja,txt_descripcion,cod_usuario,fec_actualiza) values (:cod_empresa,:cod_caja,:txt_descripcion,:cod_usuario,:fec_actualiza)");
        $this->db->bind(':cod_empresa', $datos['cod_empresa']);
        $this->db->bind(':cod_caja', $datos['cod_caja']);
        $this->db->bind(':txt_descripcion', $datos['txt_descripcion']);
        $this->db->bind(':cod_usuario', $datos['cod_usuario']);
        $this->db->bind(':fec_actualiza', $datos['fec_actualiza']);

        //ejecutar
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerCajaID($tabla, $id)
    {
        $this->db->query("SELECT * FROM  $tabla where $tabla.cod_caja = :id");
        $this->db->bind(':id', $id);
        $resultados = $this->db->registro();
        return $resultados;
    }


    public function actualizarCaja($tabla, $datos)
    {
        $this->db->query("UPDATE $tabla SET  txt_descripcion = :txt_descripcion, cod_usuario = :cod_usuario, fec_actualiza = :fec_actualiza where cod_caja = :id");

        //vincular valores
        // $this->db->bind(':cod_empresa',$datos['cod_empresa']);
        $this->db->bind(':id', $datos['cod_caja']);
        $this->db->bind(':txt_descripcion', $datos['txt_descripcion']);
        $this->db->bind(':cod_usuario', $datos['cod_usuario']);
        $this->db->bind(':fec_actualiza', $datos['fec_actualiza']);

        //ejecutar
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function eliminarCaja($tabla, $id1, $id2)
    {
        print_r($id2);
        $this->db->query("Delete from $tabla where $tabla.cod_empresa = :id and $tabla.cod_caja = :id2");

        //vincular valores
        $this->db->bind(':id', $id1);
        $this->db->bind(':id2', $id2);


        //ejecutar
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
