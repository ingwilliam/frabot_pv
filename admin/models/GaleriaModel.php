<?php

class GaleriaModel extends ModelBase {

    private $table = "galeria";
    private $idTable = "id";
    
    /**
     * Consulta todos los galerias registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listGaleria( $busqueda = "WHERE 1" , $order = "false" ) {
        //realizamos la consulta de todos los galerias
        if( $order == "false")
            $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' '.$busqueda);
        else
            $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' '.$busqueda.' ORDER BY '.$order);
        $consulta->execute();
        
        $arrayRegistro = array();
        
        while( $registro = $consulta->fetch(PDO::FETCH_ASSOC) )
        {
                $arrayRegistro[$registro[$this->idTable]] = $registro;            
        }                
        //devolvemos la coleccion para que la vista la presente.
        return $arrayRegistro;
    }
    
    /**
     * Consulta todos los galerias registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listarPaginador( $sql ) {
        //realizamos la consulta de todos los galerias
        $consulta = $this->db->prepare($sql);        
        $consulta->execute();
        //devolvemos la coleccion para que la vista la presente.
        return $consulta;
    }
    
    /**
     * Elimina el galeria que el galeria
     * que eligio en el sistema 
     * @param $id int 
     */
    public function delGaleria( $id ) {
        settype($id, "integer");
        //realizamos la consulta para eliminar el galeria
        $this->db->exec('DELETE FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');
    }
    
    /**
     * Confirma si el galeria se encuentra
     * en el sistema 
     * @param $id int
     * @return bool 
     */
    public function confirmGaleria( $id ) {
        settype($id, "integer");
        //realizamos la consulta de todos los galerias
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $galeria = $consulta->fetch();
        if( count($galeria) > 1 )
            return true;
        else
            return false;
    }
    
     /**
     * Confirma si el Persona se encuentra
     * en el sistema 
     * @param $id string
     * @return bool 
     */
    public function confirmGaleriaWhere( $where ) {
        //realizamos la consulta de todos los Persona
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$where );                 
        $consulta->execute();
        $Persona = $consulta->fetch();
        if( count($Persona) > 1 )
            return true;
        else
            return false;
    }
    
    
    /**
     * Crea en el sistema el galeria
     * inscrito por el galeria
     * @param $array array() 
     * @return $id int
     */
    public function newGaleria( $array ) {
        //creamos el sql para la insercion
        $consulta = $this->db->insert($this->table,$array);        
        //realizamos la consulta para insertar el galeria
        $this->db->exec($consulta);        
        return $this->db->lastInsertId();
    }
    
    /**
     * Modifica en el sistema el galeria
     * elegido por el galeria
     * @param $array array() 
     * @return $id int
     */
    public function modGaleria( $array ) {
        //condicion para modificar
        $condicion = $this->idTable ." = '".$array[$this->idTable]."'";
        //creamos el sql para la modificar
        $consulta = $this->db->update($this->table, $array , $condicion);                 
        //confirmamos si realmente el galeria existe
        if( $this->confirmGaleria($array[$this->idTable]) )        
        {
            //realizamos la consulta para modificar el galeria        
            $this->db->exec($consulta);
            
            return $array[$this->idTable];
        }
        else
            return 0;
                
    }
    
    
    /**
     * Consulta el galeria solicitador por
     * el galeria y se retorna en un array
     * @param $id int 
     * @return $galeria array
     */
    public function consultGaleria( $id ) {
        //realizamos la consulta de todos los galerias
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $galeria = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $galeria;        
    }
    
    
    public function consultGaleriaWhere( $where ) {
        //realizamos la consulta de todos los galerias        
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$where);                 
        $consulta->execute();
        $galeria = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $galeria;        
    }
    
    /**
     * Retorna los campos de la estructura
     * de galeria
     * @param $id int 
     */
    public function estructuraGaleria() {
        
        $array = array();

        //realizamos la consulta de todos los galerias
        $estructura = $this->db->table_fields($this->table);                 
        
        foreach( $estructura as $clave => $valor )
        {
            $array[$valor] = "" ;
        }
        
        return $array;
    }
    
    public function listArraySql( $sql , $key , $consecutivo = false) {
        return $this->db->listArraySql($sql , $key , $consecutivo);
    }
    
    public function ejecutaSql($sql) {
        $this->db->exec($sql);        
    }
    
}

?>