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
        $response = $asd->obtenerDataFilter($table, $nameId, $nameId, $id, null, null, null,null,null);
       

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
        $response = $asd->obtenerDataFilter($table, $nameId, $nameId, $id, null, null, null,null,null);
        $response2 = $asd->obtenerDataFilter($table, $nameId2, $nameId2, $id2, null, null, null,null,null);
    

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

    public function putData3ids($table,$data,$id,$nameId,$id2,$nameId2,$id3,$nameId3){

        $asd = new Get();
        $response = $asd->obtenerDataFilter($table, $nameId, $nameId, $id, null, null, null,null,null);
        $response2 = $asd->obtenerDataFilter($table, $nameId2, $nameId2, $id2, null, null, null,null,null);
        $response3 = $asd->obtenerDataFilter($table, $nameId3, $nameId3, $id3, null, null, null,null,null);
    

        if(empty($response) && empty($response2) && empty($response3)){
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
    
   
        $this->db->query("UPDATE $table SET $set WHERE $nameId = :$nameId and $nameId2 = :$nameId2 and $nameId3 = :$nameId3");
        foreach ($data as $key => $value) {
            $this->db->bind(":".$key,$data[$key]);
        }
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


    public function putData4ids($table,$data,$id,$nameId,$id2,$nameId2,$id3,$nameId3,$id4,$nameId4){
 
   
        $asd = new Get();
        
        $response = $asd->obtenerDataFilter($table, $nameId, $nameId, $id, null, null, null,null,null);
        $response2 = $asd->obtenerDataFilter($table, $nameId2, $nameId2, $id2, null, null, null,null,null);
        $response3 = $asd->obtenerDataFilter($table, $nameId3, $nameId3, $id3, null, null, null,null,null);
        $response4 = $asd->obtenerDataFilter($table, $nameId4, $nameId4, $id4, null, null, null,null,null);
    

        if(empty($response) && empty($response2) && empty($response3) && empty($response4)){
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

    
   
        $this->db->query("UPDATE $table SET $set WHERE $nameId = :$nameId and $nameId2 = :$nameId2 and $nameId3 = :$nameId3 and $nameId4 = :$nameId4");
        foreach ($data as $key => $value) {
            $this->db->bind(":".$key,$data[$key]);
        }
        $this->db->bind(":".$nameId,$id);
        $this->db->bind(":".$nameId2,$id2);
        $this->db->bind(":".$nameId3,$id3);
        $this->db->bind(":".$nameId4,$id4);

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