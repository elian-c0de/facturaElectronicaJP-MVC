<?php
//clase para conectarse a la base de datos y ejecutar consultas
class Base{
    private $host = DB_HOST;
    private $usuario = DB_USUARIO;
    private $password = DB_PASSWORD;
    private $nombre_base = DB_NOMBRE;
    
    private $dbh;
    private $stmt;
    private $error;

    public function __construct(){
        //configyrar conexion
        // $dsn = 'mysql:host='. $this->host . ';dbname=' . $this->nombre_base;
        $dsn = 'sqlsrv:Server=' .$this->host . ';database=' . $this->nombre_base;
        $opciones = array(
            // PDO::ATTR_PERSISTENT => TRUE, 
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        
        //crear una instancia de PDO
        try{
            $this->dbh = new PDO($dsn, $this->usuario, $this->password, $opciones);
            // $this->dbh->exec('set names utf8');
        }catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
        
    }

    //recibe la consulta sql 
    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }
    // vinculamos la consulta con bind
    public function bind($parametro, $valor, $tipo = null){
        if(is_null($tipo)){
            switch(true){
                case is_int($valor):
                    $tipo = PDO::PARAM_INT;
                break;
                case is_bool($valor):
                    $tipo = PDO::PARAM_BOOL;
                break;
                case is_null($valor):
                    $tipo = PDO::PARAM_NULL;
                break;
                default:
                    $tipo = PDO::PARAM_STR;
                break;
            }
        }

        $this->stmt->bindValue($parametro, $valor, $tipo);

    }
    // funcion ejecuta la consulta
    public function execute(){
        return $this->stmt->execute();
    }

    //obtener los registro
    public function registros(){
        $this->execute();
        return $this->stmt->fetchALL(PDO::FETCH_OBJ);
    }

    //obtener los registro
    public function registro(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function rowCount(){
        return $this->stmt->rowCount();
    }

}


?>