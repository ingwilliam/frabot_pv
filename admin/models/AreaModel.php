<?php

class AreaModel extends ModelBase {

    private $table = "area";
    private $idTable = "id";
    
    /**
     * Consulta todos los areas registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listArea( $busqueda = "WHERE 1" , $order = "false" ) {
        //realizamos la consulta de todos los areas
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
     * Consulta todos los areas registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listarPaginador( $sql ) {
        //realizamos la consulta de todos los areas
        $consulta = $this->db->prepare($sql);        
        $consulta->execute();
        //devolvemos la coleccion para que la vista la presente.
        return $consulta;
    }
    
    /**
     * Elimina el area que el area
     * que eligio en el sistema 
     * @param $id int 
     */
    public function delArea( $id ) {
        settype($id, "integer");
        //realizamos la consulta para eliminar el area
        $this->db->exec('DELETE FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');
    }
    
    /**
     * Confirma si el area se encuentra
     * en el sistema 
     * @param $id int
     * @return bool 
     */
    public function confirmArea( $id ) {
        settype($id, "integer");
        //realizamos la consulta de todos los areas
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $area = $consulta->fetch();
        if( count($area) > 1 )
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
    public function confirmAreaWhere( $where ) {
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
     * Crea en el sistema el area
     * inscrito por el area
     * @param $array array() 
     * @return $id int
     */
    public function newArea( $array ) {
        //creamos el sql para la insercion
        $consulta = $this->db->insert($this->table,$array);                 
        //realizamos la consulta para insertar el area
        $this->db->exec($consulta);        
        return $this->db->lastInsertId();
    }
    
    /**
     * Modifica en el sistema el area
     * elegido por el area
     * @param $array array() 
     * @return $id int
     */
    public function modArea( $array ) {
        //condicion para modificar
        $condicion = $this->idTable ." = '".$array[$this->idTable]."'";
        //creamos el sql para la modificar
        $consulta = $this->db->update($this->table, $array , $condicion);                 
        //confirmamos si realmente el area existe
        if( $this->confirmArea($array[$this->idTable]) )        
        {
            //realizamos la consulta para modificar el area        
            $this->db->exec($consulta);
            
            return $array[$this->idTable];
        }
        else
            return 0;
                
    }
    
    
    /**
     * Consulta el area solicitador por
     * el area y se retorna en un array
     * @param $id int 
     * @return $area array
     */
    public function consultArea( $id ) {
        //realizamos la consulta de todos los areas
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $area = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $area;        
    }
    
    
    public function consultAreaWhere( $where ) {
        //realizamos la consulta de todos los areas        
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$where);                 
        $consulta->execute();
        $area = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $area;        
    }
    
    /**
     * Retorna los campos de la estructura
     * de area
     * @param $id int 
     */
    public function estructuraArea() {
        
        $array = array();

        //realizamos la consulta de todos los areas
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