<?php

class PermisoModel extends ModelBase {

    private $table = "permiso";
    private $idTable = "id";
    
    /**
     * Consulta todos los permisos registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listPermiso( $busqueda = "WHERE 1" , $order = "false" ) {
        //realizamos la consulta de todos los permisos
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
     * Consulta todos los permisos registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listarPaginador( $sql ) {
        //realizamos la consulta de todos los permisos
        $consulta = $this->db->prepare($sql);        
        $consulta->execute();
        //devolvemos la coleccion para que la vista la presente.
        return $consulta;
    }
    
    /**
     * Elimina el permiso que el permiso
     * que eligio en el sistema 
     * @param $id int 
     */
    public function delPermiso( $id ) {
        settype($id, "integer");
        //realizamos la consulta para eliminar el permiso
        $this->db->exec('DELETE FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');
    }
    
    /**
     * Confirma si el permiso se encuentra
     * en el sistema 
     * @param $id int
     * @return bool 
     */
    public function confirmPermiso( $id ) {
        settype($id, "integer");
        //realizamos la consulta de todos los permisos
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $permiso = $consulta->fetch();
        if( count($permiso) > 1 )
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
    public function confirmPermisoWhere( $where ) {
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
     * Crea en el sistema el permiso
     * inscrito por el permiso
     * @param $array array() 
     * @return $id int
     */
    public function newPermiso( $array ) {
        //creamos el sql para la insercion
        $consulta = $this->db->insert($this->table,$array);                 
        //realizamos la consulta para insertar el permiso
        $this->db->exec($consulta);        
        return $this->db->lastInsertId();
    }
    
    /**
     * Modifica en el sistema el permiso
     * elegido por el permiso
     * @param $array array() 
     * @return $id int
     */
    public function modPermiso( $array ) {
        //condicion para modificar
        $condicion = $this->idTable ." = '".$array[$this->idTable]."'";
        //creamos el sql para la modificar
        $consulta = $this->db->update($this->table, $array , $condicion);                 
        //confirmamos si realmente el permiso existe
        if( $this->confirmPermiso($array[$this->idTable]) )        
        {
            //realizamos la consulta para modificar el permiso        
            $this->db->exec($consulta);
            
            return $array[$this->idTable];
        }
        else
            return 0;
                
    }
    
    
    /**
     * Consulta el permiso solicitador por
     * el permiso y se retorna en un array
     * @param $id int 
     * @return $permiso array
     */
    public function consultPermiso( $id ) {
        //realizamos la consulta de todos los permisos
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $permiso = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $permiso;        
    }
    
    
    public function consultPermisoWhere( $where ) {
        //realizamos la consulta de todos los permisos        
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$where);                 
        $consulta->execute();
        $permiso = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $permiso;        
    }
    
    /**
     * Retorna los campos de la estructura
     * de permiso
     * @param $id int 
     */
    public function estructuraPermiso() {
        
        $array = array();

        //realizamos la consulta de todos los permisos
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