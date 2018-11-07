<?php

class DirectorModel extends ModelBase {

    private $table = "director_curso";
    private $idTable = "id";
    
    /**
     * Consulta todos los directors registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listDirector( $busqueda = "WHERE 1" , $order = "false" ) {
        //realizamos la consulta de todos los directors
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
     * Consulta todos los directors registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listarPaginador( $sql ) {
        //realizamos la consulta de todos los directors
        $consulta = $this->db->prepare($sql);        
        $consulta->execute();
        //devolvemos la coleccion para que la vista la presente.
        return $consulta;
    }
    
    /**
     * Elimina el director que el director
     * que eligio en el sistema 
     * @param $id int 
     */
    public function delDirector( $id ) {
        settype($id, "integer");
        //realizamos la consulta para eliminar el director
        $this->db->exec('DELETE FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');
    }
    
    /**
     * Confirma si el director se encuentra
     * en el sistema 
     * @param $id int
     * @return bool 
     */
    public function confirmDirector( $id ) {
        settype($id, "integer");
        //realizamos la consulta de todos los directors
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $director = $consulta->fetch();
        if( count($director) > 1 )
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
    public function confirmDirectorWhere( $where ) {
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
     * Crea en el sistema el director
     * inscrito por el director
     * @param $array array() 
     * @return $id int
     */
    public function newDirector( $array ) {
        //creamos el sql para la insercion
        $consulta = $this->db->insert($this->table,$array);                 
        //realizamos la consulta para insertar el director
        $this->db->exec($consulta);        
        return $this->db->lastInsertId();
    }
    
    /**
     * Modifica en el sistema el director
     * elegido por el director
     * @param $array array() 
     * @return $id int
     */
    public function modDirector( $array ) {
        //condicion para modificar
        $condicion = $this->idTable ." = '".$array[$this->idTable]."'";
        //creamos el sql para la modificar
        $consulta = $this->db->update($this->table, $array , $condicion);                 
        //confirmamos si realmente el director existe
        if( $this->confirmDirector($array[$this->idTable]) )        
        {
            //realizamos la consulta para modificar el director        
            $this->db->exec($consulta);
            
            return $array[$this->idTable];
        }
        else
            return 0;
                
    }
    
    
    /**
     * Consulta el director solicitador por
     * el director y se retorna en un array
     * @param $id int 
     * @return $director array
     */
    public function consultDirector( $id ) {
        //realizamos la consulta de todos los directors
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $director = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $director;        
    }
    
    
    public function consultDirectorWhere( $where ) {
        //realizamos la consulta de todos los directors        
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$where);                 
        $consulta->execute();
        $director = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $director;        
    }
    
    /**
     * Retorna los campos de la estructura
     * de director
     * @param $id int 
     */
    public function estructuraDirector() {
        
        $array = array();

        //realizamos la consulta de todos los directors
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