<?php

class DocumentoModel extends ModelBase {

    private $table = "documento";
    private $idTable = "id";
    
    /**
     * Consulta todos los documentos registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listDocumento( $busqueda = "WHERE 1" , $order = "false" ) {
        //realizamos la consulta de todos los documentos
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
     * Consulta todos los documentos registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listarPaginador( $sql ) {
        //realizamos la consulta de todos los documentos
        $consulta = $this->db->prepare($sql);        
        $consulta->execute();
        //devolvemos la coleccion para que la vista la presente.
        return $consulta;
    }
    
    /**
     * Elimina el documento que el documento
     * que eligio en el sistema 
     * @param $id int 
     */
    public function delDocumento( $id ) {
        settype($id, "integer");
        //realizamos la consulta para eliminar el documento
        $this->db->exec('DELETE FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');
    }
    
    /**
     * Confirma si el documento se encuentra
     * en el sistema 
     * @param $id int
     * @return bool 
     */
    public function confirmDocumento( $id ) {
        settype($id, "integer");
        //realizamos la consulta de todos los documentos
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $documento = $consulta->fetch();
        if( count($documento) > 1 )
            return true;
        else
            return false;
    }
    
    /**
     * Crea en el sistema el documento
     * inscrito por el documento
     * @param $array array() 
     * @return $id int
     */
    public function newDocumento( $array ) {
        //creamos el sql para la insercion
        $consulta = $this->db->insert($this->table,$array);                 
        //realizamos la consulta para insertar el documento
        $this->db->exec($consulta);        
        return $this->db->lastInsertId();
    }
    
    /**
     * Modifica en el sistema el documento
     * elegido por el documento
     * @param $array array() 
     * @return $id int
     */
    public function modDocumento( $array ) {
        //condicion para modificar
        $condicion = $this->idTable ." = '".$array[$this->idTable]."'";
        //creamos el sql para la modificar
        $consulta = $this->db->update($this->table, $array , $condicion);                 
        //confirmamos si realmente el documento existe
        if( $this->confirmDocumento($array[$this->idTable]) )        
        {
            //realizamos la consulta para modificar el documento        
            $this->db->exec($consulta);
            
            return $array[$this->idTable];
        }
        else
            return 0;
                
    }
    
    
    /**
     * Consulta el documento solicitador por
     * el documento y se retorna en un array
     * @param $id int 
     * @return $documento array
     */
    public function consultDocumento( $id ) {
        //realizamos la consulta de todos los documentos
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $documento = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $documento;        
    }
    
    
    public function consultDocumentoWhere( $where ) {
        //realizamos la consulta de todos los documentos        
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$where);                 
        $consulta->execute();
        $documento = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $documento;        
    }
    
    /**
     * Retorna los campos de la estructura
     * de documento
     * @param $id int 
     */
    public function estructuraDocumento() {
        
        $array = array();

        //realizamos la consulta de todos los documentos
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