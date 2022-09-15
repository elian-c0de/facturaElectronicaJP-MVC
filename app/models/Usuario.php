<?php


class Usuario{
    private $db;
    public function __construct(){
        $this->db = new Base;
    }
    
    public function obtenerUsuarios(){
        $this->db->query('select * from gen_empresa');
        $resultados = $this->db->registros();
        return $resultados;
    }    
    
    public function agregarUsuario($datos){
        $this->db->query('INSERT INTO gen_empresa (cod_empresa,nom_empresa,nom_abreviado) values (:cod_empresa,:nom_empresa,:nom_abreviado)');
        //vincular valores
    
        $this->db->bind(':cod_empresa', $datos['cod_empresa']);
        $this->db->bind(':nom_empresa', $datos['nom_empresa']);
        $this->db->bind(':nom_abreviado', $datos['nom_abreviado']);
        
        //ejecutar
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function obtenerUsuarioId($id){
        $this->db->query('select * from gen_empresa where cod_empresa = :id');
        $this->db->bind(':id',$id);

        $fila = $this->db->registro();

        return $fila;

    }


    public function actualizarUsuario($datos){
        $this->db->query('UPDATE gen_empresa SET nom_empresa = :nom_empresa, nom_abreviado = :nom_abreviado where cod_empresa = :id');

        //vincular valores
        $this->db->bind(':id', $datos['cod_empresa']);
        $this->db->bind(':nom_empresa', $datos['nom_empresa']);
        $this->db->bind(':nom_abreviado', $datos['nom_abreviado']);

        //ejecutar
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function borrarUsuario($datos){
        $this->db->query('Delete from gen_empresa where cod_empresa = :id');

        //vincular valores
        $this->db->bind(':id', $datos['cod_empresa']);

        //ejecutar
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

}

?>