<?php

use function PHPSTORM_META\type;

require_once "conexion.php";
require_once "library/Base.php";

class Post
{
    private $db;



    public function __construct()
    {
        $this->db = new Base;
    }
    
    public function postData($table,$data){

        $columns = "";
        $params = "";
        foreach ($data as $key => $value) {
            $columns .= $key.",";
            $params .= ":".$key.",";
        }
        $columns = substr($columns, 0, -1);
        $params = substr($params, 0, -1);


        $this->db->query("INSERT INTO $table ($columns) values ($params)");


        foreach ($data as $key => $value) {
            $this->db->bind(":".$key,$data[$key]);
        }
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
            // echo '<pre>'; print_r($e); echo '</pre>';
        
            return null;
        }
        

    }

}

?>