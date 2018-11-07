<?php

class PerfilModel extends ModelBase {

    private $table = "perfil";
    private $idTable = "id";
    
    /**
     * Consulta todos los perfils registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listPerfil( $busqueda = "WHERE 1" , $order = "false" ) {
        //realizamos la consulta de todos los perfils
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
     * Consulta todos los perfils registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listarPaginador( $sql ) {
        //realizamos la consulta de todos los perfils
        $consulta = $this->db->prepare($sql);        
        $consulta->execute();
        //devolvemos la coleccion para que la vista la presente.
        return $consulta;
    }
    
    /**
     * Elimina el perfil que el perfil
     * que eligio en el sistema 
     * @param $id int 
     */
    public function delPerfil( $id ) {
        settype($id, "integer");
        //realizamos la consulta para eliminar el perfil
        $this->db->exec('DELETE FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');
    }
    
    /**
     * Confirma si el perfil se encuentra
     * en el sistema 
     * @param $id int
     * @return bool 
     */
    public function confirmPerfil( $id ) {
        settype($id, "integer");
        //realizamos la consulta de todos los perfils
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $perfil = $consulta->fetch();
        if( count($perfil) > 1 )
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
    public function confirmPerfilWhere( $where ) {
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
     * Crea en el sistema el perfil
     * inscrito por el perfil
     * @param $array array() 
     * @return $id int
     */
    public function newPerfil( $array ) {
        //creamos el sql para la insercion
        $consulta = $this->db->insert($this->table,$array);                 
        //realizamos la consulta para insertar el perfil
        $this->db->exec($consulta);        
        return $this->db->lastInsertId();
    }
    
    /**
     * Modifica en el sistema el perfil
     * elegido por el perfil
     * @param $array array() 
     * @return $id int
     */
    public function modPerfil( $array ) {
        //condicion para modificar
        $condicion = $this->idTable ." = '".$array[$this->idTable]."'";
        //creamos el sql para la modificar
        $consulta = $this->db->update($this->table, $array , $condicion);                 
        //confirmamos si realmente el perfil existe
        if( $this->confirmPerfil($array[$this->idTable]) )        
        {
            //realizamos la consulta para modificar el perfil        
            $this->db->exec($consulta);
            
            return $array[$this->idTable];
        }
        else
            return 0;
                
    }
    
    
    /**
     * Consulta el perfil solicitador por
     * el perfil y se retorna en un array
     * @param $id int 
     * @return $perfil array
     */
    public function consultPerfil( $id ) {
        //realizamos la consulta de todos los perfils
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $perfil = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $perfil;        
    }
    
    
    public function consultPerfilWhere( $where ) {
        //realizamos la consulta de todos los perfils        
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$where);                 
        $consulta->execute();
        $perfil = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $perfil;        
    }
    
    /**
     * Retorna los campos de la estructura
     * de perfil
     * @param $id int 
     */
    public function estructuraPerfil() {
        
        $array = array();

        //realizamos la consulta de todos los perfils
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