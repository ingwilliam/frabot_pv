<?php

class ModuloModel extends ModelBase {

    private $table = "modulo";
    private $idTable = "id";
    
    /**
     * Consulta todos los modulos registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listModulo( $busqueda = "WHERE 1" , $order = "false" ) {
        //realizamos la consulta de todos los modulos
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
     * Consulta todos los modulos registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listarPaginador( $sql ) {
        //realizamos la consulta de todos los modulos
        $consulta = $this->db->prepare($sql);        
        $consulta->execute();
        //devolvemos la coleccion para que la vista la presente.
        return $consulta;
    }
    
    /**
     * Elimina el modulo que el modulo
     * que eligio en el sistema 
     * @param $id int 
     */
    public function delModulo( $id ) {
        settype($id, "integer");
        //realizamos la consulta para eliminar el modulo
        $this->db->exec('DELETE FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');
    }
    
    /**
     * Confirma si el modulo se encuentra
     * en el sistema 
     * @param $id int
     * @return bool 
     */
    public function confirmModulo( $id ) {
        settype($id, "integer");
        //realizamos la consulta de todos los modulos
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $modulo = $consulta->fetch();
        if( count($modulo) > 1 )
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
    public function confirmModuloWhere( $where ) {
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
     * Crea en el sistema el modulo
     * inscrito por el modulo
     * @param $array array() 
     * @return $id int
     */
    public function newModulo( $array ) {
        //creamos el sql para la insercion
        $consulta = $this->db->insert($this->table,$array);                 
        //realizamos la consulta para insertar el modulo        
        $this->db->exec($consulta);                
        return $this->db->lastInsertId();
    }
    
    /**
     * Modifica en el sistema el modulo
     * elegido por el modulo
     * @param $array array() 
     * @return $id int
     */
    public function modModulo( $array ) {
        //condicion para modificar
        $condicion = $this->idTable ." = '".$array[$this->idTable]."'";
        //creamos el sql para la modificar
        $consulta = $this->db->update($this->table, $array , $condicion);                         
        //confirmamos si realmente el modulo existe
        if( $this->confirmModulo($array[$this->idTable]) )        
        {
            //realizamos la consulta para modificar el modulo        
            $this->db->exec($consulta);
            
            return $array[$this->idTable];
        }
        else
            return 0;
                
    }
    
    
    /**
     * Consulta el modulo solicitador por
     * el modulo y se retorna en un array
     * @param $id int 
     * @return $modulo array
     */
    public function consultModulo( $id ) {
        //realizamos la consulta de todos los modulos
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $modulo = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $modulo;        
    }
    
    
    public function consultModuloWhere( $where ) {
        //realizamos la consulta de todos los modulos        
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$where);                 
        $consulta->execute();
        $modulo = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $modulo;        
    }
    
    /**
     * Retorna los campos de la estructura
     * de modulo
     * @param $id int 
     */
    public function estructuraModulo() {
        
        $array = array();

        //realizamos la consulta de todos los modulos
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
    
    public function thisdb() {
        return $this->db;        
    }
    
}

?>