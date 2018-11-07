<?php

class AsignaturaModel extends ModelBase {

    private $table = "asignatura";
    private $idTable = "id";
    
    /**
     * Consulta todos los asignaturas registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listAsignatura( $busqueda = "WHERE 1" , $order = "false" ) {
        //realizamos la consulta de todos los asignaturas
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
     * Consulta todos los asignaturas registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listarPaginador( $sql ) {
        //realizamos la consulta de todos los asignaturas
        $consulta = $this->db->prepare($sql);        
        $consulta->execute();
        //devolvemos la coleccion para que la vista la presente.
        return $consulta;
    }
    
    /**
     * Elimina el asignatura que el asignatura
     * que eligio en el sistema 
     * @param $id int 
     */
    public function delAsignatura( $id ) {
        settype($id, "integer");
        //realizamos la consulta para eliminar el asignatura
        $this->db->exec('DELETE FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');
    }
    
    /**
     * Confirma si el asignatura se encuentra
     * en el sistema 
     * @param $id int
     * @return bool 
     */
    public function confirmAsignatura( $id ) {
        settype($id, "integer");
        //realizamos la consulta de todos los asignaturas
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $asignatura = $consulta->fetch();
        if( count($asignatura) > 1 )
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
    public function confirmAsignaturaWhere( $where ) {
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
     * Crea en el sistema el asignatura
     * inscrito por el asignatura
     * @param $array array() 
     * @return $id int
     */
    public function newAsignatura( $array ) {
        //creamos el sql para la insercion
        $consulta = $this->db->insert($this->table,$array);                 
        //realizamos la consulta para insertar el asignatura
        $this->db->exec($consulta);        
        return $this->db->lastInsertId();
    }
    
    /**
     * Modifica en el sistema el asignatura
     * elegido por el asignatura
     * @param $array array() 
     * @return $id int
     */
    public function modAsignatura( $array ) {
        //condicion para modificar
        $condicion = $this->idTable ." = '".$array[$this->idTable]."'";
        //creamos el sql para la modificar
        $consulta = $this->db->update($this->table, $array , $condicion);                 
        //confirmamos si realmente el asignatura existe
        if( $this->confirmAsignatura($array[$this->idTable]) )        
        {
            //realizamos la consulta para modificar el asignatura        
            $this->db->exec($consulta);
            
            return $array[$this->idTable];
        }
        else
            return 0;
                
    }
    
    
    /**
     * Consulta el asignatura solicitador por
     * el asignatura y se retorna en un array
     * @param $id int 
     * @return $asignatura array
     */
    public function consultAsignatura( $id ) {
        //realizamos la consulta de todos los asignaturas
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $asignatura = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $asignatura;        
    }
    
    
    public function consultAsignaturaWhere( $where ) {
        //realizamos la consulta de todos los asignaturas        
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$where);                 
        $consulta->execute();
        $asignatura = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $asignatura;        
    }
    
    /**
     * Retorna los campos de la estructura
     * de asignatura
     * @param $id int 
     */
    public function estructuraAsignatura() {
        
        $array = array();

        //realizamos la consulta de todos los asignaturas
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