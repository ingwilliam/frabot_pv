<?php

class Tipo_documentoModel extends ModelBase {

    private $table = "tipo_documento";
    private $idTable = "id";
    
    /**
     * Consulta todos los usuarios registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listTipo_documento( $busqueda = "WHERE 1" , $order = "false" ) {
        //realizamos la consulta de todos los usuarios
        if( $order == "false")
            $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' '.$busqueda);
        else
            $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' '.$busqueda.' ORDER BY '.$order);
        $consulta->execute();
        //devolvemos la coleccion para que la vista la presente.
        return $consulta;
    }
    
    /**
     * Consulta todos los usuarios registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listarPaginador( $sql ) {
        //realizamos la consulta de todos los usuarios
        $consulta = $this->db->prepare($sql);        
        $consulta->execute();
        //devolvemos la coleccion para que la vista la presente.
        return $consulta;
    }
    
    /**
     * Elimina el usuario que el usuario
     * que eligio en el sistema 
     * @param $id int 
     */
    public function delTipo_documento( $id ) {
        settype($id, "integer");
        //realizamos la consulta para eliminar el usuario
        $this->db->exec('DELETE FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');
    }
    
    /**
     * Confirma si el usuario se encuentra
     * en el sistema 
     * @param $id int
     * @return bool 
     */
    public function confirmTipo_documento( $id ) {
        settype($id, "integer");
        //realizamos la consulta de todos los usuarios
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $usuario = $consulta->fetch();
        if( count($usuario) > 1 )
            return true;
        else
            return false;
    }
    
    /**
     * Crea en el sistema el usuario
     * inscrito por el usuario
     * @param $array array() 
     * @return $id int
     */
    public function newTipo_documento( $array ) {
        //creamos el sql para la insercion
        $consulta = $this->db->insert($this->table,$array);                 
        //realizamos la consulta para insertar el usuario
        $this->db->exec($consulta);        
        return $this->db->lastInsertId();
    }
    
    /**
     * Modifica en el sistema el usuario
     * elegido por el usuario
     * @param $array array() 
     * @return $id int
     */
    public function modTipo_documento( $array ) {
        //condicion para modificar
        $condicion = $this->idTable ." = '".$array[$this->idTable]."'";
        //creamos el sql para la modificar
        $consulta = $this->db->update($this->table, $array , $condicion);                 
        //confirmamos si realmente el usuario existe
        if( $this->confirmTipo_documento($array[$this->idTable]) )        
        {
            //realizamos la consulta para modificar el usuario        
            $this->db->exec($consulta);
            
            return $array[$this->idTable];
        }
        else
            return 0;
                
    }
    
    
    /**
     * Consulta el usuario solicitador por
     * el usuario y se retorna en un array
     * @param $id int 
     * @return $usuario array
     */
    public function consultTipo_documento( $id ) {
        //realizamos la consulta de todos los usuarios
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $usuario;        
    }
    
    
    public function consultTipo_documentoWhere( $where ) {
        //realizamos la consulta de todos los usuarios        
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$where);                 
        $consulta->execute();
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $usuario;        
    }
    
    /**
     * Retorna los campos de la estructura
     * de usuario
     * @param $id int 
     */
    public function estructuraTipo_documento() {
        
        $array = array();

        //realizamos la consulta de todos los usuarios
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