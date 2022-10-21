<?php

use function PHPSTORM_META\type;
require_once "Get.php";
require_once "conexion.php";
require_once "library/Base.php";

class Delete
{
    private $db;



    public function __construct()
    {
        $this->db = new Base;
    }
    
    public function deleteData($table,$id,$nameId){

        $asd = new Get();
        $response = $asd->obtenerDataFilter($table, $nameId, $nameId, $id, null, null, null,null,null);
    

        if(empty($response)){
            // $response = array(
            //     "comment" => "Error: the id is not foun in the database"
            // );
            return null;
        }

       
        $this->db->query("DELETE FROM $table WHERE $nameId = :$nameId");
    
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

    public function deleteData2ids($table,$id,$nameId,$id2,$nameId2){

        $asd = new Get();
        $response = $asd->obtenerDataFilter($table, $nameId, $nameId, $id, null, null, null,null,null);
        $response2 = $asd->obtenerDataFilter($table, $nameId2, $nameId2, $id2, null, null, null,null,null);
    

        if(empty($response) && empty($response2)){
            // $response = array(
            //     "comment" => "Error: the id is not foun in the database"
            // );
            return null;
        }

        
        $this->db->query("DELETE FROM $table WHERE $nameId = :$nameId and $nameId2 = :$nameId2");

       
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

    public function deleteData3ids($table,$id,$nameId,$id2,$nameId2,$id3,$nameId3){

        $asd = new Get();
        $response = $asd->obtenerDataFilter($table, $nameId, $nameId, $id, null, null, null,null,null);
        $response2 = $asd->obtenerDataFilter($table, $nameId2, $nameId2, $id2, null, null, null,null,null);
        $response2 = $asd->obtenerDataFilter($table, $nameId3, $nameId3, $id3, null, null, null,null,null);
    

        if(empty($response) && empty($response2)){
            // $response = array(
            //     "comment" => "Error: the id is not foun in the database"
            // );
            return null;
        }

        
        $this->db->query("DELETE FROM $table WHERE $nameId = :$nameId and $nameId2 = :$nameId2 and $nameId3 = :$nameId3");

       
        $this->db->bind(":".$nameId,$id);
        $this->db->bind(":".$nameId2,$id2);
        $this->db->bind(":".$nameId3,$id3);

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