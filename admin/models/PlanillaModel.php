<?php

class PlanillaModel extends ModelBase {

    private $table = "grado";
    private $idTable = "id";
    
    /**
     * Consulta todos los grados registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listPlanilla( $busqueda = "WHERE 1" , $order = "false" ) {
        //realizamos la consulta de todos los grados
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
     * Consulta todos los grados registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listarPaginador( $sql ) {
        //realizamos la consulta de todos los grados
        $consulta = $this->db->prepare($sql);        
        $consulta->execute();
        //devolvemos la coleccion para que la vista la presente.
        return $consulta;
    }
    
    /**
     * Elimina el grado que el grado
     * que eligio en el sistema 
     * @param $id int 
     */
    public function delPlanilla( $id ) {
        settype($id, "integer");
        //realizamos la consulta para eliminar el grado
        $this->db->exec('DELETE FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');
    }
    
    /**
     * Confirma si el grado se encuentra
     * en el sistema 
     * @param $id int
     * @return bool 
     */
    public function confirmPlanilla( $id ) {
        settype($id, "integer");
        //realizamos la consulta de todos los grados
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $grado = $consulta->fetch();
        if( count($grado) > 1 )
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
    public function confirmPlanillaWhere( $where ) {
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
     * Crea en el sistema el grado
     * inscrito por el grado
     * @param $array array() 
     * @return $id int
     */
    public function newPlanilla( $array ) {
        //creamos el sql para la insercion
        $consulta = $this->db->insert($this->table,$array);                 
        //realizamos la consulta para insertar el grado
        $this->db->exec($consulta);        
        return $this->db->lastInsertId();
    }
    
    /**
     * Modifica en el sistema el grado
     * elegido por el grado
     * @param $array array() 
     * @return $id int
     */
    public function modPlanilla( $array ) {
        //condicion para modificar
        $condicion = $this->idTable ." = '".$array[$this->idTable]."'";
        //creamos el sql para la modificar
        $consulta = $this->db->update($this->table, $array , $condicion);                 
        //confirmamos si realmente el grado existe
        if( $this->confirmPlanilla($array[$this->idTable]) )        
        {
            //realizamos la consulta para modificar el grado        
            $this->db->exec($consulta);
            
            return $array[$this->idTable];
        }
        else
            return 0;
                
    }
    
    
    /**
     * Consulta el grado solicitador por
     * el grado y se retorna en un array
     * @param $id int 
     * @return $grado array
     */
    public function consultPlanilla( $id ) {
        //realizamos la consulta de todos los grados
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $grado = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $grado;        
    }
    
    
    public function consultPlanillaWhere( $where ) {
        //realizamos la consulta de todos los grados        
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$where);                 
        $consulta->execute();
        $grado = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $grado;        
    }
    
    /**
     * Retorna los campos de la estructura
     * de grado
     * @param $id int 
     */
    public function estructuraPlanilla() {
        
        $array = array();

        //realizamos la consulta de todos los grados
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