<?php

class MetaModel extends ModelBase {

    private $table = "meta";
    private $idTable = "id";
    
    /**
     * Consulta todos los metas registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listMeta( $busqueda = "WHERE 1" , $order = "false" ) {
        //realizamos la consulta de todos los metas
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
     * Consulta todos los metas registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listarPaginador( $sql ) {
        //realizamos la consulta de todos los metas
        $consulta = $this->db->prepare($sql);        
        $consulta->execute();
        //devolvemos la coleccion para que la vista la presente.
        return $consulta;
    }
    
    /**
     * Elimina el meta que el meta
     * que eligio en el sistema 
     * @param $id int 
     */
    public function delMeta( $id ) {
        settype($id, "integer");
        //realizamos la consulta para eliminar el meta
        $this->db->exec('DELETE FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');
    }
    
    /**
     * Confirma si el meta se encuentra
     * en el sistema 
     * @param $id int
     * @return bool 
     */
    public function confirmMeta( $id ) {
        settype($id, "integer");
        //realizamos la consulta de todos los metas
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $meta = $consulta->fetch();
        if( count($meta) > 1 )
            return true;
        else
            return false;
    }
    
    /**
     * Crea en el sistema el meta
     * inscrito por el meta
     * @param $array array() 
     * @return $id int
     */
    public function newMeta( $array ) {
        //creamos el sql para la insercion
        $consulta = $this->db->insert($this->table,$array);                 
        //realizamos la consulta para insertar el meta
        $this->db->exec($consulta);        
        return $this->db->lastInsertId();
    }
    
    /**
     * Modifica en el sistema el meta
     * elegido por el meta
     * @param $array array() 
     * @return $id int
     */
    public function modMeta( $array ) {
        //condicion para modificar
        $condicion = $this->idTable ." = '".$array[$this->idTable]."'";
        //creamos el sql para la modificar
        $consulta = $this->db->update($this->table, $array , $condicion);                 
        //confirmamos si realmente el meta existe
        if( $this->confirmMeta($array[$this->idTable]) )        
        {
            //realizamos la consulta para modificar el meta        
            $this->db->exec($consulta);
            
            return $array[$this->idTable];
        }
        else
            return 0;
                
    }
    
    
    /**
     * Consulta el meta solicitador por
     * el meta y se retorna en un array
     * @param $id int 
     * @return $meta array
     */
    public function consultMeta( $id ) {
        //realizamos la consulta de todos los metas
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $meta = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $meta;        
    }
    
    
    public function consultMetaWhere( $where ) {
        //realizamos la consulta de todos los metas        
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$where);                 
        $consulta->execute();
        $meta = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $meta;        
    }
    
    /**
     * Retorna los campos de la estructura
     * de meta
     * @param $id int 
     */
    public function estructuraMeta() {
        
        $array = array();

        //realizamos la consulta de todos los metas
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