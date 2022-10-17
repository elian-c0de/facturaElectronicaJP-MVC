<?php

use function PHPSTORM_META\type;
require_once "Get.php";
require_once "conexion.php";
require_once "library/Base.php";

class Put
{
    private $db;



    public function __construct()
    {
        $this->db = new Base;
    }
    
    public function putData($table,$data,$id,$nameId){
 
        

        $asd = new Get();
        $response = $asd->obtenerDataFilter($table, $nameId, $nameId, $id, null, null, null);
       

        if(empty($response)){
            // $response = array(
            //     "comment" => "Error: the id is not foun in the database"
            // );
          
            return null;
        }
       
        $set = "";
        foreach ($data as $key => $value) {
            $set .= $key." = :".$key.",";
            # code...
        }
        $set = substr($set,0,-1);

        $this->db->query("UPDATE $table SET $set WHERE $nameId = :$nameId");

        foreach ($data as $key => $value) {
            $this->db->bind(":".$key,$data[$key]);
        }

        $this->db->bind(":".$nameId,$id);

        try {
            if ($this->db->execute()) {
                $response = array(
                    "comment" => "the process was successful"
                );
                return $response;
            } else {
                $response = array(
                    "comment" => "error al agregar"
                );
            }
        } catch (PDOException $e) {
            return null;
        }

        
    }

    public function putData2ids($table,$data,$id,$nameId,$id2,$nameId2){

        $asd = new Get();
        $response = $asd->obtenerDataFilter($table, $nameId, $nameId, $id, null, null, null);
        $response2 = $asd->obtenerDataFilter($table, $nameId2, $nameId2, $id2, null, null, null);
    

        if(empty($response) && empty($response2)){
            // $response = array(
            //     "comment" => "Error: the id is not foun in the database"
            // );
            return null;
        }

        $set = "";
        foreach ($data as $key => $value) {
            $set .= $key." = :".$key.",";
            # code...
        }
        $set = substr($set,0,-1);
    
   
        $this->db->query("UPDATE $table SET $set WHERE $nameId = :$nameId and $nameId2 = :$nameId2");
        foreach ($data as $key => $value) {
            $this->db->bind(":".$key,$data[$key]);
        }
        $this->db->bind(":".$nameId,$id);
        $this->db->bind(":".$nameId2,$id2);

        try {
            if ($this->db->execute()) {
                $response = array(
                    "comment" => "the process was successful"
                );
                return $response;
            } else {
                $response = array(
                    "comment" => "error al agregar"
                );
            }
        } catch (PDOException $e) {
            return null;
        }

        
    }

}

?>