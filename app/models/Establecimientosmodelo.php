<?php


class Establecimientosmodelo{
    private $db;
    public function __construct(){
        $this->db = new Base;
    }
    
    public function obtenerEstablecimientos(){
        $this->db->query('select * from gen_local');
        $resultados = $this->db->registros();
        return $resultados;
    }    
    
    public function agregarEstablecimientos($datos){
        $this->db->query('INSERT INTO gen_local (cod_empresa, cod_establecimiento ,txt_descripcion ,txt_direccion ,sts_matriz ,sts_local,fec_actualiza) values (:cod_empresa,:cod_establecimiento,:txt_descripcion,:txt_direccion,:sts_matriz:sts_local:fec_actualiza)');
        //vincular valores
    
        $this->db->bind(':cod_empresa', $datos['cod_empresa']);
        $this->db->bind(':cod_establecimiento', $datos['cod_establecimiento']);
        $this->db->bind(':txt_descripcion', $datos['txt_descripcion']);
        $this->db->bind(':txt_direccion', $datos['txt_direccion']);
        $this->db->bind(':sts_matriz', $datos['sts_matriz']);
        $this->db->bind(':sts_local', $datos['sts_local']);
        $this->db->bind(':fec_actualiza', $datos['fec_actualiza']);
        
        //ejecutar
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function obtenerEstablecimientosId($id){
        $this->db->query('select * from gen_local where cod_establecimiento = :id');
        $this->db->bind(':id',$id);

        $fila = $this->db->registros();
        print_r($fila);

        return $fila;

    }


    public function actualizarEstablecimientos($datos){
        $this->db->query('UPDATE gen_local SET nom_empresa = :nom_empresa, nom_abreviado = :nom_abreviado where cod_establecimiento = :id');

        //vincular valores
        $this->db->bind(':cod_empresa', $datos['cod_empresa']);
        $this->db->bind(':cod_linea', $datos['cod_linea']);
        $this->db->bind(':cod_sublinea', $datos['cod_sublinea']);
        $this->db->bind(':txt_descripcion', $datos['txt_descripcion']);

        //ejecutar
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function borrarEstablecimientos($datos){
        var_dump($datos);
        $this->db->query('Delete from ecmp_linea where cod_linea = :cod_linea and cod_sublinea = :cod_sublinea');

        //vincular valores
        $this->db->bind(':cod_linea', $datos['cod_linea']);
        $this->db->bind(':cod_sublinea', $datos['cod_sublinea']);

        //ejecutar
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

}

?>