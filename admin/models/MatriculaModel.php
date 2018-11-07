<?php

class MatriculaModel extends ModelBase {

    private $table = "matricula";
    private $idTable = "id";
    
    /**
     * Consulta todos los matriculas registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listMatricula( $busqueda = "WHERE 1" , $order = "false" ) {
        //realizamos la consulta de todos los matriculas
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
    
    public function listMatriculaSql( $sql ) {
        //realizamos la consulta de todos los matriculas
        $consulta = $this->db->prepare($sql);
        
        $consulta->execute();
        
        $arrayRegistro = array();
        
        while( $registro = $consulta->fetch(PDO::FETCH_ASSOC) )
        {
                $arrayRegistro[] = $registro;            
        }                
        //devolvemos la coleccion para que la vista la presente.
        return $arrayRegistro;
    }
    
    /**
     * Consulta todos los matriculas registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listarPaginador( $sql ) {
        //realizamos la consulta de todos los matriculas
        $consulta = $this->db->prepare($sql);        
        $consulta->execute();
        //devolvemos la coleccion para que la vista la presente.
        return $consulta;
    }
    
    /**
     * Elimina el matricula que el matricula
     * que eligio en el sistema 
     * @param $id int 
     */
    public function delMatricula( $id ) {
        settype($id, "integer");
        //realizamos la consulta para eliminar el matricula
        $this->db->exec('DELETE FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');
    }
    
    /**
     * Confirma si el matricula se encuentra
     * en el sistema 
     * @param $id int
     * @return bool 
     */
    public function confirmMatricula( $id ) {
        settype($id, "integer");
        //realizamos la consulta de todos los matriculas
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $matricula = $consulta->fetch();
        if( count($matricula) > 1 )
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
    public function confirmMatriculaWhere( $where ) {
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
     * Crea en el sistema el matricula
     * inscrito por el matricula
     * @param $array array() 
     * @return $id int
     */
    public function newMatricula( $array ) {
        //creamos el sql para la insercion
        $consulta = $this->db->insert($this->table,$array);                 
        //realizamos la consulta para insertar el matricula
        $this->db->exec($consulta);        
        return $this->db->lastInsertId();
    }
    
    /**
     * Modifica en el sistema el matricula
     * elegido por el matricula
     * @param $array array() 
     * @return $id int
     */
    public function modMatricula( $array ) {
        //condicion para modificar
        $condicion = $this->idTable ." = '".$array[$this->idTable]."'";
        //creamos el sql para la modificar
        $consulta = $this->db->update($this->table, $array , $condicion);                 
        //confirmamos si realmente el matricula existe
        if( $this->confirmMatricula($array[$this->idTable]) )        
        {
            //realizamos la consulta para modificar el matricula        
            $this->db->exec($consulta);
            
            return $array[$this->idTable];
        }
        else
            return 0;
                
    }
    
    
    /**
     * Consulta el matricula solicitador por
     * el matricula y se retorna en un array
     * @param $id int 
     * @return $matricula array
     */
    public function consultMatricula( $id ) {
        //realizamos la consulta de todos los matriculas
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $matricula = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $matricula;        
    }
    
    
    public function consultMatriculaWhere( $where ) {
        //realizamos la consulta de todos los matriculas        
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$where);                 
        $consulta->execute();
        $matricula = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $matricula;        
    }
    
    public function consultMatriculaSql( $sql ) {
        //realizamos la consulta de todos los matriculas        
        $consulta = $this->db->prepare($sql);                 
        $consulta->execute();
        $matricula = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $matricula;        
    }
    
    /**
     * Retorna los campos de la estructura
     * de matricula
     * @param $id int 
     */
    public function estructuraMatricula() {
        
        $array = array();

        //realizamos la consulta de todos los matriculas
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
    
    public function ejecutaSqlArray($sql) {        
        //realizamos la consulta de todos los usuarios        
        $consulta = $this->db->prepare($sql);                 
        $consulta->execute();
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $usuario;
    }
    
}

?>