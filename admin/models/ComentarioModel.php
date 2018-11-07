<?php

class ComentarioModel extends ModelBase {

    private $table = "comentario";
    private $idTable = "id";
    
    /**
     * Consulta todos los comentarios registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listComentario( $busqueda = "WHERE 1" , $order = "false" ) {
        //realizamos la consulta de todos los comentarios
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
     * Consulta todos los comentarios registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listarPaginador( $sql ) {
        //realizamos la consulta de todos los comentarios
        $consulta = $this->db->prepare($sql);        
        $consulta->execute();
        //devolvemos la coleccion para que la vista la presente.
        return $consulta;
    }
    
    /**
     * Elimina el comentario que el comentario
     * que eligio en el sistema 
     * @param $id int 
     */
    public function delComentario( $id ) {
        settype($id, "integer");
        //realizamos la consulta para eliminar el comentario
        $this->db->exec('DELETE FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');
    }
    
    /**
     * Confirma si el comentario se encuentra
     * en el sistema 
     * @param $id int
     * @return bool 
     */
    public function confirmComentario( $id ) {
        settype($id, "integer");
        //realizamos la consulta de todos los comentarios
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $comentario = $consulta->fetch();
        if( count($comentario) > 1 )
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
    public function confirmComentarioWhere( $where ) {
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
     * Crea en el sistema el comentario
     * inscrito por el comentario
     * @param $array array() 
     * @return $id int
     */
    public function newComentario( $array ) {
        //creamos el sql para la insercion
        $consulta = $this->db->insert($this->table,$array);        
        //realizamos la consulta para insertar el comentario
        $this->db->exec($consulta);        
        return $this->db->lastInsertId();
    }
    
    /**
     * Modifica en el sistema el comentario
     * elegido por el comentario
     * @param $array array() 
     * @return $id int
     */
    public function modComentario( $array ) {
        //condicion para modificar
        $condicion = $this->idTable ." = '".$array[$this->idTable]."'";
        //creamos el sql para la modificar
        $consulta = $this->db->update($this->table, $array , $condicion);                 
        //confirmamos si realmente el comentario existe
        if( $this->confirmComentario($array[$this->idTable]) )        
        {
            //realizamos la consulta para modificar el comentario        
            $this->db->exec($consulta);
            
            return $array[$this->idTable];
        }
        else
            return 0;
                
    }
    
    
    /**
     * Consulta el comentario solicitador por
     * el comentario y se retorna en un array
     * @param $id int 
     * @return $comentario array
     */
    public function consultComentario( $id ) {
        //realizamos la consulta de todos los comentarios
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $comentario = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $comentario;        
    }
    
    
    public function consultComentarioWhere( $where ) {
        //realizamos la consulta de todos los comentarios        
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$where);                 
        $consulta->execute();
        $comentario = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $comentario;        
    }
    
    /**
     * Retorna los campos de la estructura
     * de comentario
     * @param $id int 
     */
    public function estructuraComentario() {
        
        $array = array();

        //realizamos la consulta de todos los comentarios
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