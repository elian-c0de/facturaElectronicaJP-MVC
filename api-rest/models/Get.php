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


    //PETICIONES GET SIN FILTRO
    public function obtenerData($table, $select, $orderBy, $orderMode, $startAt, $endAt, $orderAt)
    {

        //EN EL CASO QUE EL SELECT VENGAN MAS DE UN PARAMERTOS, LOS SEPARA POR COMAS EN UN ARRAY
        $selectArray = explode(",",$select);


        //VALIDA LA EXISTENCIA DE LA TABLA Y LAS COLUMNAS
        if (empty($this->db->getColumsData($table,$selectArray))) {
            return null;
        }


        //GET - SIN ORDENAR NI LIMITAR DATOS (DEVUELVE TODA LA INFORMACION DE LA TABLA)
        $this->db->query("SELECT $select FROM  $table");


        //GET - ORDENADOS SIN LIMITES (DEVUELVE DATOS ORDENADOS DE FORMA ASC O DSC EN UNA COLUMNA ESPECIFICA DE LA TABLA)
        if ($orderBy != null && $orderMode != null && $startAt == null && $endAt == null && $orderAt == null) {
            $this->db->query("SELECT $select FROM $table order by $orderBy $orderMode");
        }


        //GET - ORDENAR DATOS Y LIMINAR DATOS DE ACUERDO A UN RANGO ESPECIFICO
        if ($orderBy != null && $orderMode != null && $startAt != null && $endAt != null && $orderAt != null) {
            $this->db->query("SELECT $select FROM $table ORDER BY $orderAt,$orderBy $orderMode OFFSET $startAt ROWS FETCH NEXT $endAt ROWS ONLY");
        }


        //GET - OBTIENE LOS DATOS CON LA POSIBILIDAD DE LIMITARLOS PERO NO ORDENARLOS
        if ($orderBy == null && $orderMode == null && $startAt != null && $endAt != null && $orderAt != null) {
            $this->db->query("SELECT $select FROM $table ORDER BY $orderAt OFFSET $startAt ROWS FETCH NEXT $endAt ROWS ONLY");
        }


        $resultados = $this->db->registros();
        return $resultados;

    }

    
    //PETICIONES GET CON FILTRO
    public function obtenerDataFilter($table, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt, $orderAt)
    {   
        
        //SEPARA POR , EN UN ARRAY LO QUE INGRESOAMOS POR SELECT Y LINKTO 
        $selectArray = explode(",",$select);
        $linkToArray = explode(",",$linkTo);
       

     
        //RECORREMSO Y AGRGEAMOS LAS COLUMAS DE NUESTO LINKTO CON SELECT PARA VERIFICAR SI EXISTEN
        foreach($linkToArray as $key => $value){
            array_push($selectArray,$value);
        }
        $selectArray = array_unique($selectArray);

    
        //VALIDAMOS SI EXIETE LAS COLUMNAS Y LA TABLA
        if (empty($this->db->getColumsData($table,$selectArray))) {
            return null;
        }


        //SEPARAMOS NUESTRO EQUALSTO POR , Y LO GUARDAMOS EN UN ARRAY
        $equalToArray = explode(",", $equalTo);
        

        
        //CREAMOS UNA CADENA DE TEXTO CON LA FORMA ADECUADA PARA HACER UNA CONSULTA AND DESPUES DEL WHERE
        $linkToText = "";
        if (count($linkToArray) > 1) {
            foreach ($linkToArray as $key => $value) {
                if ($key > 0) {
                    $linkToText .= "AND " . $value . " = :" . $value . " ";
                    
                }
            }
        }
     
        //ordener sin limitar datos
        //OBTENER DATOS SIN ORDENAR NI LIMINAR PERO SI FILTRADO (DEVUELVE INFORMACION SI EXISTE LOS VALORES ESPECIFICADOS EN EQUALTO EN LA TABLA QUE SE ESPECIFICO EN LINKTO)
        $this->db->query("SELECT $select FROM  $table where $linkToArray[0] = :$linkToArray[0] $linkToText");


        //OBTENER DATOS ORDENANDO DE SEAS ASC O DESC EN LA COLUMNA ESPECIFICADA NI LIMINAR PERO SI FILTRADO (DEVUELVE INFORMACION SI EXISTE LOS VALORES ESPECIFICADOS EN EQUALTO EN LA TABLA QUE SE ESPECIFICO EN LINKTO)
        if ($orderBy != null && $orderMode != null && $startAt == null) {
            $this->db->query("SELECT $select FROM  $table where $linkToArray[0] = :$linkToArray[0] $linkToText order by $orderBy $orderMode");
        }


        //OBTENER DATOS ORDENANDO DE SEASE ASC O DESC EN LA COLUMNA ESPECIFICADA Y TAMBIEN LIMITADO CON FILTRADO (DEVUELVE INFORMACION SI EXISTE LOS VALORES ESPECIFICADOS EN EQUALTO EN LA TABLA QUE SE ESPECIFICO EN LINKTO)
        if ($orderBy != null && $orderMode != null && $startAt != null) {
            $this->db->query("SELECT $select FROM $table where $linkToArray[0] = :$linkToArray[0] $linkToText ORDER BY $orderAt, $orderBy $orderMode OFFSET $startAt ROWS FETCH NEXT $endAt ROWS ONLY");
        }


        //OBTENER DATOS LIMITADOS CON FILTRADO (DEVUELVE INFORMACION SI EXISTE LOS VALORES ESPECIFICADOS EN EQUALTO EN LA TABLA QUE SE ESPECIFICO EN LINKTO)
        if ($orderBy == null && $orderMode == null && $startAt != null) {
            $this->db->query("SELECT $select FROM $table where $linkToArray[0] = :$linkToArray[0] $linkToText ORDER BY $orderAt OFFSET $startAt ROWS FETCH NEXT $endAt ROWS ONLY");
        }


        //VINCULAR DATOS
        foreach ($linkToArray as $key => $value) {
            $this->db->bind(":" . $value, $equalToArray[$key]);
        }
        $resultados = $this->db->registros();
        return $resultados;

    }


    //PETICIONES GET BUSQUEDA
    public function obtenerDataSearch($table, $select, $linkTo, $search, $orderBy, $orderMode, $startAt, $endAt, $orderAt)
    {

        //SEPARA LA ENTRAS EN UN ARRAY PARA TRABAJAR MAS ADELANTE
        $selectArray = explode(",",$select);
        $linkToArray = explode(",",$linkTo);
        foreach($linkToArray as $key => $value){
            array_push($selectArray,$value);
        }

        $selectArray = array_unique($selectArray);

        //VALIDA DE EXISTE LA TABLA Y LA COLUMAS INGRESADAS
        if (empty($this->db->getColumsData($table,$selectArray))) {
            return null;
        }

        //CONSTRUYE LA CADENA DE TEXTO QUE SE UTILIZARA PARA LA CONSULTA
        $searchToArray = explode(",", $search);
        $linkToText = "";
        if (count($linkToArray) > 1) {
            foreach ($linkToArray as $key => $value) {
                if ($key > 0) {
                    $linkToText .= "AND " . $value . " = :" . $value . " ";
                }
            }
        }

        //OBTIENE LOS DATOS BUSCADOS SIN ORDENAR NI LIMITAR
        $this->db->query("SELECT $select FROM  $table where $linkToArray[0] like '%$searchToArray[0]%' $linkToText");


        //OBTIENE LOS DATOS BUSCADOS ORDENADOS SIN LIMITAR
        if ($orderBy != null && $orderMode != null && $startAt == null) {
            $this->db->query("SELECT $select FROM  $table where $linkToArray[0] like '%$searchToArray[0]%' $linkToText order by $orderBy $orderMode");
        }


        //OBTIENE LOS DATOS BUSCADOS ORDENADOS y LIMITADOS
        if ($orderBy != null && $orderMode != null && $startAt != null) {
            $this->db->query("SELECT $select FROM $table where $linkToArray[0] like '%$searchToArray[0]%' $linkToText ORDER BY $orderAt,$orderBy $orderMode OFFSET $startAt ROWS FETCH NEXT $endAt ROWS ONLY;");
        }


        //OBTIENE LOS DATOS BUSCADOS LIMITADOS PERO NO ORDENADOS
        if ($orderBy == null && $orderMode == null && $startAt != null) {
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
            
        }

        return $resultados;

    }


    //PETICIONES CON TABLAS RELACIONADOS SIN FILTRO
    public function obtenerRelData($rel, $type, $select, $orderBy, $orderMode, $startAt, $endAt, $orderAt)
    {
        //SE SEPARA LOS DATOS POR COMAS EN UN ARRAY
        $relArray = explode(",", $rel);
        $typeArray = explode(",", $type);
        $innerJoinText = "";
     

        if (count($relArray) > 1) {


            //VALIDAMOS EN EL CASO DE QUE SE QUIERA RELACIONAR MAS DE DOS COLUMNAS ENTRE LAS TABLAS
            if(count($relArray) == count($typeArray)){

                foreach ($relArray as $key => $value) {
        
                    //VALIDAMOS LA EXISTENCIA DE LAS TABLAS
                    if (empty($this->db->getColumsData($value,["*"]))) {
                        return null;
                    }

                    //ARMAMOS LA CADENA DE TEXTO QUE SE USAR PARA USAR EL INNER JOIN
                    if ($key > 0) {
                        $innerJoinText .= "INNER JOIN " . $value . " ON " . $relArray[0] . "." . $typeArray[0] . " = " . $value . "." . $typeArray[$key] . " ";
                    }
                }

            }else{

                if(count($relArray) < count($typeArray)){

                    foreach ($relArray as $key => $value) {
        
                        //VALIDAMOS LA EXISTENCIA DE LAS TABLAS
                        if (empty($this->db->getColumsData($value,["*"]))) {
                            return null;
                        }

                        //ARMAMOS LA CADENA DE TEXTO QUE SE USAR PARA USAR EL INNER JOIN
                        if ($key > 0) {
                            $innerJoinText .= "LEFT join " . $value . " ON " . $relArray[0] . "." . $typeArray[0] . " = " . $value . "." . $typeArray[$key] . " and " . $relArray[0] . "." . $typeArray[2] . " = " . $value . "." . $typeArray[$key+2] . " ";
                        }
                    }
                }

            }

           
            //SE OBTIENEN LOS DATOS DE LA TABLAS RELACIONADDAS SIN ORDENAR NI FILTRAR
            $this->db->query("SELECT $select FROM $relArray[0] $innerJoinText");
   
            
            //SE OBTIENEN LOS DATOS DE LA TABLAS RELACIONADDAS ORDENADOS SIN LIMITAR
            if ($orderBy != null && $orderMode != null && $startAt == null) {
                 $this->db->query("SELECT $select FROM  $relArray[0] $innerJoinText order by $orderBy $orderMode");
            }


            //SE OBTIENEN LOS DATOS DE LA TABLAS RELACIONADDAS ORDENADOS Y LIMITADOS
            if ($orderBy != null && $orderMode != null && $startAt != null) {
                $this->db->query("SELECT $select FROM $relArray[0] $innerJoinText ORDER BY $orderAt, $orderBy $orderMode OFFSET $startAt ROWS FETCH NEXT $endAt ROWS ONLY");   
            }


            //SE OBTIENEN LOS DATOS DE LA TABLAS RELACIONADDAS LIMITADOS SIN ORDENAR
            if ($orderBy == null && $orderMode == null && $startAt != null) {
                $this->db->query("SELECT $select FROM $relArray[0] $innerJoinText ORDER BY $orderAt  OFFSET $startAt ROWS FETCH NEXT $endAt ROWS ONLY");   
            }


            //VINCULA LOS DATOS
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

    //PETICIONES CON TABLAS RELACIONADOS CON FILTRO
    public function obtenerRelDataFilter($rel, $type, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt, $orderAt)
    {

        //SEPARA LOS DATOS EN UN ARRAY PARA TRABAJAR MAS ADELANTE
        $linkToArray = explode(",", $linkTo);
        $equalToArray = explode(",", $equalTo);
        $linkToText = "";


        //CONSTRUIMOS LA CADE DE TEXTO QUE IRA DESPUES DEL AND DE UN WHERE
        if (count($linkToArray) > 1) {
            foreach ($linkToArray as $key => $value) {
                if ($key > 0) {
                    $linkToText .= "AND ".$value ." = :".$value." ";
                    
                    
                }
            }
        }

       
        //SEPARAMOS LOS DATOS POR COMAS PARA LAS RELACIONES
        $relArray = explode(",", $rel);
        $typeArray = explode(",", $type);
        $innerJoinText = "";


        if (count($relArray) > 1) {

            //VALIDAMOS EN EL CASO DE QUE SE QUIERA RELACIONAR MAS DE DOS COLUMNAS ENTRE LAS TABLAS
            if(count($relArray) == count($typeArray)){

                foreach ($relArray as $key => $value) {
        
                    //VALIDAMOS LA EXISTENCIA DE LAS TABLAS
                    if (empty($this->db->getColumsData($value,["*"]))) {
                        return null;
                    }

                    //ARMAMOS LA CADENA DE TEXTO QUE SE USAR PARA USAR EL INNER JOIN
                    if ($key > 0) {
                        $innerJoinText .= "INNER JOIN " . $value . " ON " . $relArray[0] . "." . $typeArray[0] . " = " . $value . "." . $typeArray[$key] . " ";
                    }
                }

            }else{

                if(count($relArray) < count($typeArray)){

                    foreach ($relArray as $key => $value) {
        
                        //VALIDAMOS LA EXISTENCIA DE LAS TABLAS
                        if (empty($this->db->getColumsData($value,["*"]))) {
                            return null;
                        }

                        //ARMAMOS LA CADENA DE TEXTO QUE SE USAR PARA USAR EL INNER JOIN
                        if ($key > 0) {
                            $innerJoinText .= "LEFT join " . $value . " ON " . $relArray[0] . "." . $typeArray[0] . " = " . $value . "." . $typeArray[$key] . " and " . $relArray[0] . "." . $typeArray[2] . " = " . $value . "." . $typeArray[$key+2] . " ";
                        }
                    }
                }

            }

            
            //OBTENER DATOS CON TABLAS RELACIONADAS Y FILTRADAS SIN ORDENAR NI LIMITAR
            $this->db->query("SELECT $select FROM $relArray[0] $innerJoinText where $linkToArray[0] = :$linkToArray[0] $linkToText");

           
            //OBTENER DATOS CON TABLAS RELACIONADAS Y FILTRADAS, ORDENADAS SIN LIMITAR
            if ($orderBy != null && $orderMode != null && $startAt == null) {
                $this->db->query("SELECT $select FROM  $relArray[0] $innerJoinText where $linkToArray[0] = :$linkToArray[0] $linkToText order by $orderBy $orderMode");
            }


            //OBTENER DATOS CON TABLAS RELACIONADAS Y FILTRADAS, ORDENADAS, LIMITADO
            if ($orderBy != null && $orderMode != null && $startAt != null) {
                $this->db->query("SELECT $select FROM $relArray[0] $innerJoinText where $linkToArray[0] =:$linkToArray[0] $linkToText ORDER BY $orderAt,$orderBy $orderMode OFFSET $startAt ROWS FETCH NEXT $endAt ROWS ONLY");
            }


            //OBTENER DATOS CON TABLAS RELACIONADAS Y FILTRADAS CON LIMITADO
            if ($orderBy == null && $orderMode == null && $startAt != null) {
                $this->db->query("SELECT $select FROM $relArray[0] $innerJoinText where $linkToArray[0] =:$linkToArray[0] $linkToText ORDER BY $orderAt OFFSET $startAt ROWS FETCH NEXT $endAt ROWS ONLY;");
            }


            foreach ($linkToArray as $key => $value) {
                $this->db->bind(":".$value, $equalToArray[$key]);
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


    //PETICIONES GET BUSQUEDA CON TABLAS RELACIONADAS
    public function obtenerRelDataSearch($rel, $type, $select, $linkTo, $search, $orderBy, $orderMode, $startAt, $endAt, $orderAt)
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

            //VALIDAMOS EN EL CASO DE QUE SE QUIERA RELACIONAR MAS DE DOS COLUMNAS ENTRE LAS TABLAS
            if(count($relArray) == count($typeArray)){

                foreach ($relArray as $key => $value) {
        
                    //VALIDAMOS LA EXISTENCIA DE LAS TABLAS
                    if (empty($this->db->getColumsData($value,["*"]))) {
                        return null;
                    }

                    //ARMAMOS LA CADENA DE TEXTO QUE SE USAR PARA USAR EL INNER JOIN
                    if ($key > 0) {
                        $innerJoinText .= "INNER JOIN " . $value . " ON " . $relArray[0] . "." . $typeArray[0] . " = " . $value . "." . $typeArray[$key] . " ";
                    }
                }

            }else{

                if(count($relArray) < count($typeArray)){

                    foreach ($relArray as $key => $value) {
        
                        //VALIDAMOS LA EXISTENCIA DE LAS TABLAS
                        if (empty($this->db->getColumsData($value,["*"]))) {
                            return null;
                        }

                        //ARMAMOS LA CADENA DE TEXTO QUE SE USAR PARA USAR EL INNER JOIN
                        if ($key > 0) {
                            $innerJoinText .= "LEFT join " . $value . " ON " . $relArray[0] . "." . $typeArray[0] . " = " . $value . "." . $typeArray[$key] . " and " . $relArray[0] . "." . $typeArray[2] . " = " . $value . "." . $typeArray[$key+2] . " ";
                        }
                    }
                }

            }


           //BUSQUEDA EN TABLAS RELACIONADAS SIN ORDENAR NI LIMITAR
            $this->db->query("SELECT $select FROM $relArray[0] $innerJoinText where $linkToArray[0] like '%$searchToArray[0]%' $linkToText");


            //BUSQUEDA EN TABLAS RELACIONADAS ORDENADOS SIN LIMITAR
            if ($orderBy != null && $orderMode != null && $startAt == null) {
                $this->db->query("SELECT $select FROM  $relArray[0] $innerJoinText where $linkToArray[0] like '%$searchToArray[0]%' $linkToText order by $orderBy $orderMode");
            }


             //BUSQUEDA EN TABLAS RELACIONADAS ORDENADOS Y LIMITADOS
            if ($orderBy != null && $orderMode != null && $startAt != null) {
                $this->db->query("SELECT $select FROM $relArray[0] $innerJoinText where $linkToArray[0] like '%$searchToArray[0]%' $linkToText ORDER BY $orderAt,$orderBy $orderMode OFFSET $startAt ROWS FETCH NEXT $endAt ROWS ONLY;");
            }


              //BUSQUEDA EN TABLAS RELACIONADAS LIMITADOS SIN ORDENAR
            if ($orderBy == null && $orderMode == null && $startAt != null) {
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

    //PETICIONES GET CON RANGOS
    public function getDataRange($table, $select, $linkTo, $between1, $between2, $orderBy, $orderMode, $startAt,$endAt,$orderAt, $filterTo, $inTo)
    {
        //ORDENANDO DATOS EN UN ARRAY PARA USARLOS MAS ADELANTE
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

  
        //ARMANDO EL FILTRO A UTILIZAR
        $filter = "";
        if ($filterTo != null && $inTo != null) {
            $filter = 'AND ' . $filterTo . ' IN (' . $inTo . ')';
        }
 

        //OBTENER DATOS CON RANGOS SIN ORDENAR NI LIMITAR
        $this->db->query("SELECT $select FROM  $table where $linkTo between '$between1' and '$between2' $filter");
          

        //OBTENER DATOS CON RANGOS ORDENADOS SIN LIMITAR
        if ($orderBy != null && $orderMode != null && $startAt == null) {
            $this->db->query("SELECT $select FROM $table where $linkTo between '$between1' and '$between2' $filter  order by $orderBy $orderMode");
        }


        //OBTENER DATOS CON RANGOS ORDENADOS Y LIMITAR
        if ($orderBy != null && $orderMode != null && $startAt != null) {
            $this->db->query("SELECT $select FROM $table where $linkTo between '$between1' and '$between2' $filter ORDER BY $orderAt,$orderBy $orderMode OFFSET $startAt ROWS FETCH NEXT $endAt ROWS ONLY;");
        }


        //OBTENER DATOS CON RANGOS LIMITADOS SIN ORDENAR
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

    //PETICIONES GET CON TABLAS RELACIONALES Y RANGOS
    public function getRelDataRange($rel, $type, $select, $linkTo, $between1, $between2, $orderBy, $orderMode, $startAt,$endAt,$orderAt, $filterTo, $inTo)
    {

        //ORDENAR LOS DATOS PARA SER UTILZIADAS EN LAS CONSULTAS
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
        
                    //VALIDAMOS LA EXISTENCIA DE LAS TABLAS
                    if (empty($this->db->getColumsData($value,["*"]))) {
                        return null;
                    }

                    //ARMAMOS LA CADENA DE TEXTO QUE SE USAR PARA USAR EL INNER JOIN
                    if ($key > 0) {
                        $innerJoinText .= "INNER JOIN " . $value . " ON " . $relArray[0] . "." . $typeArray[0] . " = " . $value . "." . $typeArray[$key] . " ";
                    }
                }

            }else{

                if(count($relArray) < count($typeArray)){

                    foreach ($relArray as $key => $value) {
        
                        //VALIDAMOS LA EXISTENCIA DE LAS TABLAS
                        if (empty($this->db->getColumsData($value,["*"]))) {
                            return null;
                        }

                        //ARMAMOS LA CADENA DE TEXTO QUE SE USAR PARA USAR EL INNER JOIN
                        if ($key > 0) {
                            $innerJoinText .= "LEFT join " . $value . " ON " . $relArray[0] . "." . $typeArray[0] . " = " . $value . "." . $typeArray[$key] . " and " . $relArray[0] . "." . $typeArray[2] . " = " . $value . "." . $typeArray[$key+2] . " ";
                        }
                    }
                }

            }




            //OBTIENES DATOS CON TABLAS RELACIONADAS Y FILTRO, SIN ORDENAR NI LIMITAR
            $this->db->query("SELECT $select FROM  $relArray[0] $innerJoinText where $linkTo between '$between1' and '$between2' $filter");

             //OBTIENES DATOS CON TABLAS RELACIONADAS Y FILTRO, ORDENANDO SIN LOMITAR
            if ($orderBy != null && $orderMode != null && $startAt == null) {
                $this->db->query("SELECT $select FROM $relArray[0]  $innerJoinText where $linkTo between '$between1' and '$between2' $filter  order by $orderBy $orderMode");
            }

            //OBTENER DATOS CON TABLAS RELACIONADAS, FILTROS, ORDENADOS Y LIMITADOS
            if ($orderBy != null && $orderMode != null && $startAt != null) {
                $this->db->query("SELECT $select FROM $relArray[0] $innerJoinText where $linkTo between '$between1' and '$between2' $filter ORDER BY $orderAt,$orderBy $orderMode OFFSET $startAt ROWS FETCH NEXT $endAt ROWS ONLY;");
            }

            //OBTENER DATOS CON TABLAS RELACIONADAS, FILTROS,LIMITADOS SIN ORDENAR
            if ($orderBy == null && $orderMode == null && $startAt != null) {
                $this->db->query("SELECT $select FROM $relArray[0] $innerJoinText where $linkTo between '$between1' and '$between2' $filter ORDER BY $orderAt OFFSET $startAt ROWS FETCH NEXT $endAt ROWS ONLY;");
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



 



}