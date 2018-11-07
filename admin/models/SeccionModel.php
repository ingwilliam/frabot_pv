<?php

class SeccionModel extends ModelBase {

    private $table = "seccion";
    private $idTable = "id";
    
    /**
     * Consulta todos los seccions registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listSeccion( $busqueda = "WHERE 1" , $order = "false" ) {
        //realizamos la consulta de todos los seccions
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
     * Consulta todos los seccions registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listarPaginador( $sql ) {
        //realizamos la consulta de todos los seccions
        $consulta = $this->db->prepare($sql);        
        $consulta->execute();
        //devolvemos la coleccion para que la vista la presente.
        return $consulta;
    }
    
    /**
     * Elimina el seccion que el seccion
     * que eligio en el sistema 
     * @param $id int 
     */
    public function delSeccion( $id ) {
        settype($id, "integer");
        //realizamos la consulta para eliminar el seccion
        $this->db->exec('DELETE FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');
    }
    
    /**
     * Confirma si el seccion se encuentra
     * en el sistema 
     * @param $id int
     * @return bool 
     */
    public function confirmSeccion( $id ) {
        settype($id, "integer");
        //realizamos la consulta de todos los seccions
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $seccion = $consulta->fetch();
        if( count($seccion) > 1 )
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
    public function confirmSeccionWhere( $where ) {
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
     * Crea en el sistema el seccion
     * inscrito por el seccion
     * @param $array array() 
     * @return $id int
     */
    public function newSeccion( $array ) {
        //creamos el sql para la insercion
        $consulta = $this->db->insert($this->table,$array);                 
        //realizamos la consulta para insertar el seccion
        $this->db->exec($consulta);        
        return $this->db->lastInsertId();
    }
    
    /**
     * Modifica en el sistema el seccion
     * elegido por el seccion
     * @param $array array() 
     * @return $id int
     */
    public function modSeccion( $array ) {
        //condicion para modificar
        $condicion = $this->idTable ." = '".$array[$this->idTable]."'";
        //creamos el sql para la modificar
        $consulta = $this->db->update($this->table, $array , $condicion);                 
        //confirmamos si realmente el seccion existe
        if( $this->confirmSeccion($array[$this->idTable]) )        
        {
            //realizamos la consulta para modificar el seccion        
            $this->db->exec($consulta);
            
            return $array[$this->idTable];
        }
        else
            return 0;
                
    }
    
    
    /**
     * Consulta el seccion solicitador por
     * el seccion y se retorna en un array
     * @param $id int 
     * @return $seccion array
     */
    public function consultSeccion( $id ) {
        //realizamos la consulta de todos los seccions
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $seccion = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $seccion;        
    }
    
    
    public function consultSeccionWhere( $where ) {
        //realizamos la consulta de todos los seccions        
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$where);                 
        $consulta->execute();
        $seccion = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $seccion;        
    }
    
    /**
     * Retorna los campos de la estructura
     * de seccion
     * @param $id int 
     */
    public function estructuraSeccion() {
        
        $array = array();

        //realizamos la consulta de todos los seccions
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