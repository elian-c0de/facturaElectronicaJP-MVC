<?php


class Lineamodelo{
    private $db;
    public function __construct(){
        $this->db = new Base;
    }
    
    public function obtenerLinea(){
        $this->db->query('select * from ecmp_linea');
        $resultados = $this->db->registros();
        return $resultados;
    }    
    
    public function agregarLinea($datos){
        $this->db->query('INSERT INTO ecmp_linea (cod_empresa,cod_linea,cod_sublinea,txt_descripcion,fec_actualiza) values (:cod_empresa,:cod_linea,:cod_sublinea,:txt_descripcion,:fec_actualiza)');
        //vincular valores
    
        $this->db->bind(':cod_empresa', $datos['cod_empresa']);
        $this->db->bind(':cod_linea', $datos['cod_linea']);
        $this->db->bind(':cod_sublinea', $datos['cod_sublinea']);
        $this->db->bind(':txt_descripcion', $datos['txt_descripcion']);
        $this->db->bind(':fec_actualiza', $datos['fec_actualiza']);
        
        //ejecutar
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function obtenerLineaId($id,$idsub){
        print_r($idsub);
        print_r($id);
        $this->db->query('select * from ecmp_linea where cod_linea = :id and cod_sublinea = :idsub');
        $this->db->bind(':id',$id);
        $this->db->bind(':idsub',$idsub);

        $fila = $this->db->registros();
        print_r($fila);

        return $fila;

    }


    public function actualizarLinea($datos){
        $this->db->query('UPDATE gen_empresa SET nom_empresa = :nom_empresa, nom_abreviado = :nom_abreviado where cod_empresa = :id');

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

    public function borrarLinea($datos){
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