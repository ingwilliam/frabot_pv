<?php

class PlanModel extends ModelBase {

    private $table = "plan_estudio";
    private $idTable = "id";
    
    /**
     * Consulta todos los plans registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listPlan( $busqueda = "WHERE 1" , $order = "false" ) {
        //realizamos la consulta de todos los plans
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
     * Consulta todos los plans registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listarPaginador( $sql ) {
        //realizamos la consulta de todos los plans
        $consulta = $this->db->prepare($sql);        
        $consulta->execute();
        //devolvemos la coleccion para que la vista la presente.
        return $consulta;
    }
    
    /**
     * Elimina el plan que el plan
     * que eligio en el sistema 
     * @param $id int 
     */
    public function delPlan( $id ) {
        settype($id, "integer");
        //realizamos la consulta para eliminar el plan
        $this->db->exec('DELETE FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');
    }
    
    /**
     * Confirma si el plan se encuentra
     * en el sistema 
     * @param $id int
     * @return bool 
     */
    public function confirmPlan( $id ) {
        settype($id, "integer");
        //realizamos la consulta de todos los plans
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $plan = $consulta->fetch();
        if( count($plan) > 1 )
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
    public function confirmPlanWhere( $where ) {
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
     * Crea en el sistema el plan
     * inscrito por el plan
     * @param $array array() 
     * @return $id int
     */
    public function newPlan( $array ) {
        //creamos el sql para la insercion
        $consulta = $this->db->insert($this->table,$array);                 
        //realizamos la consulta para insertar el plan
        $this->db->exec($consulta);        
        return $this->db->lastInsertId();
    }
    
    /**
     * Modifica en el sistema el plan
     * elegido por el plan
     * @param $array array() 
     * @return $id int
     */
    public function modPlan( $array ) {
        //condicion para modificar
        $condicion = $this->idTable ." = '".$array[$this->idTable]."'";
        //creamos el sql para la modificar
        $consulta = $this->db->update($this->table, $array , $condicion);                 
        //confirmamos si realmente el plan existe
        if( $this->confirmPlan($array[$this->idTable]) )        
        {
            //realizamos la consulta para modificar el plan        
            $this->db->exec($consulta);
            
            return $array[$this->idTable];
        }
        else
            return 0;
                
    }
    
    
    /**
     * Consulta el plan solicitador por
     * el plan y se retorna en un array
     * @param $id int 
     * @return $plan array
     */
    public function consultPlan( $id ) {
        //realizamos la consulta de todos los plans
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $plan = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $plan;        
    }
    
    
    public function consultPlanWhere( $where ) {
        //realizamos la consulta de todos los plans        
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$where);                 
        $consulta->execute();
        $plan = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $plan;        
    }
    
    /**
     * Retorna los campos de la estructura
     * de plan
     * @param $id int 
     */
    public function estructuraPlan() {
        
        $array = array();

        //realizamos la consulta de todos los plans
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