<?php

class UsuarioModel extends ModelBase {

    private $table = "usuario";
    private $idTable = "id";
    
    /**
     * Consulta todos los usuarios registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listUsuario( $busqueda = "WHERE 1" , $order = "false" ) {
        //realizamos la consulta de todos los usuarios
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
    public function delUsuario( $id ) {
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
    public function confirmUsuario( $id ) {
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
     * Confirma si el Persona se encuentra
     * en el sistema 
     * @param $id string
     * @return bool 
     */
    public function confirmUsuarioWhere( $where ) {
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
     * Crea en el sistema el usuario
     * inscrito por el usuario
     * @param $array array() 
     * @return $id int
     */
    public function newUsuario( $array ) {
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
    public function modUsuario( $array ) {
        //condicion para modificar
        $condicion = $this->idTable ." = '".$array[$this->idTable]."'";
        //creamos el sql para la modificar
        $consulta = $this->db->update($this->table, $array , $condicion);                 
        //confirmamos si realmente el usuario existe
        if( $this->confirmUsuario($array[$this->idTable]) )        
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
    public function consultUsuario( $id ) {
        //realizamos la consulta de todos los usuarios
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $usuario;        
    }
    
    
    public function consultUsuarioWhere( $where ) {
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
    public function estructuraUsuario() {
        
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
    
    public function thisdb() {
        return $this->db;        
    }
    
    public function ejecutaSqlArray($sql) {        
        //realizamos la consulta de todos los usuarios        
        $consulta = $this->db->prepare($sql);                 
        $consulta->execute();
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $usuario;
    }
    
}

?>