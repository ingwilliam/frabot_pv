<?php

class BannerModel extends ModelBase {

    private $table = "banner";
    private $idTable = "id";
    
    /**
     * Consulta todos los banners registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listBanner( $busqueda = "WHERE 1" , $order = "false" ) {
        //realizamos la consulta de todos los banners
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
     * Consulta todos los banners registrados
     * en el sistema 
     * @return $consulta string 
     */
    public function listarPaginador( $sql ) {
        //realizamos la consulta de todos los banners
        $consulta = $this->db->prepare($sql);        
        $consulta->execute();
        //devolvemos la coleccion para que la vista la presente.
        return $consulta;
    }
    
    /**
     * Elimina el banner que el banner
     * que eligio en el sistema 
     * @param $id int 
     */
    public function delBanner( $id ) {
        settype($id, "integer");
        //realizamos la consulta para eliminar el banner
        $this->db->exec('DELETE FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');
    }
    
    /**
     * Confirma si el banner se encuentra
     * en el sistema 
     * @param $id int
     * @return bool 
     */
    public function confirmBanner( $id ) {
        settype($id, "integer");
        //realizamos la consulta de todos los banners
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $banner = $consulta->fetch();
        if( count($banner) > 1 )
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
    public function confirmBannerWhere( $where ) {
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
     * Crea en el sistema el banner
     * inscrito por el banner
     * @param $array array() 
     * @return $id int
     */
    public function newBanner( $array ) {
        //creamos el sql para la insercion
        $consulta = $this->db->insert($this->table,$array); 
        
        //realizamos la consulta para insertar el banner
        $this->db->exec($consulta);        
        return $this->db->lastInsertId();
    }
    
    /**
     * Modifica en el sistema el banner
     * elegido por el banner
     * @param $array array() 
     * @return $id int
     */
    public function modBanner( $array ) {
        //condicion para modificar
        $condicion = $this->idTable ." = '".$array[$this->idTable]."'";
        //creamos el sql para la modificar
        $consulta = $this->db->update($this->table, $array , $condicion);                 
        //confirmamos si realmente el banner existe
        if( $this->confirmBanner($array[$this->idTable]) )        
        {
            //realizamos la consulta para modificar el banner        
            $this->db->exec($consulta);
            
            return $array[$this->idTable];
        }
        else
            return 0;
                
    }
    
    
    /**
     * Consulta el banner solicitador por
     * el banner y se retorna en un array
     * @param $id int 
     * @return $banner array
     */
    public function consultBanner( $id ) {
        //realizamos la consulta de todos los banners
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$this->idTable.' = "'.$id.'"');                 
        $consulta->execute();
        $banner = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $banner;        
    }
    
    
    public function consultBannerWhere( $where ) {
        //realizamos la consulta de todos los banners        
        $consulta = $this->db->prepare('SELECT * FROM '.$this->table.' WHERE '.$where);                 
        $consulta->execute();
        $banner = $consulta->fetch(PDO::FETCH_ASSOC);        
        return $banner;        
    }
    
    /**
     * Retorna los campos de la estructura
     * de banner
     * @param $id int 
     */
    public function estructuraBanner() {
        
        $array = array();

        //realizamos la consulta de todos los banners
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