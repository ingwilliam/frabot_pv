<?php

class ArticuloModel extends ModelBase {

    private $table = "articulo";
    private $idTable = "id";
    
    /**
     * Consulta todos los articulos registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listArticulo( $busqueda = "WHERE 1" , $order = "false" ) {
        //realizamos la consulta de todos los articulos
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
     * Consulta todos los articulos registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listarPaginador( $sql ) {
        //realizamos la consulta de todos los articulos
        $consulta = $this->db->prepare($sql);        
        $consulta->execute();
        //devolvemos la coleccion para que la vista la presente.
        return $consulta;
    }
    
    /**
     * Elimina el articulo que el articulo
     * que eligio en el sistema 
     * @param $id int 
     */
    public function delArticulo( $id ) {
        settype($id, "integer");
        //realizamos la consulta para eliminar el articulo
        $this->db->exec('DELETE FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');
    }
    
    /**
     * Confirma si el articulo se encuentra
     * en el sistema 
     * @param $id int
     * @return bool 
     */
    public function confirmArticulo( $id ) {
        settype($id, "integer");
        //realizamos la consulta de todos los articulos
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $articulo = $consulta->fetch();
        if( count($articulo) > 1 )
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
    public function confirmArticuloWhere( $where ) {
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
     * Crea en el sistema el articulo
     * inscrito por el articulo
     * @param $array array() 
     * @return $id int
     */
    public function newArticulo( $array ) {
        //creamos el sql para la insercion
        $consulta = $this->db->insert($this->table,$array); 
        
        //realizamos la consulta para insertar el articulo
        $this->db->exec($consulta);        
        return $this->db->lastInsertId();
    }
    
    /**
     * Modifica en el sistema el articulo
     * elegido por el articulo
     * @param $array array() 
     * @return $id int
     */
    public function modArticulo( $array ) {
        //condicion para modificar
        $condicion = $this->idTable ." = '".$array[$this->idTable]."'";
        //creamos el sql para la modificar
        $consulta = $this->db->update($this->table, $array , $condicion);                 
        //confirmamos si realmente el articulo existe
        if( $this->confirmArticulo($array[$this->idTable]) )        
        {
            //realizamos la consulta para modificar el articulo        
            $this->db->exec($consulta);
            
            return $array[$this->idTable];
        }
        else
            return 0;
                
    }
    
    
    /**
     * Consulta el articulo solicitador por
     * el articulo y se retorna en un array
     * @param $id int 
     * @return $articulo array
     */
    public function consultArticulo( $id ) {
        //realizamos la consulta de todos los articulos
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $articulo = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $articulo;        
    }
    
    
    public function consultArticuloWhere( $where ) {
        //realizamos la consulta de todos los articulos        
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$where);                 
        $consulta->execute();
        $articulo = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $articulo;        
    }
    
    /**
     * Retorna los campos de la estructura
     * de articulo
     * @param $id int 
     */
    public function estructuraArticulo() {
        
        $array = array();

        //realizamos la consulta de todos los articulos
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