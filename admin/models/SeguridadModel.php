<?php

class SeguridadModel extends ModelBase {

    private $table = "modulo_perfil_permiso";
    
    /**
     * Elimina el seguridad que el seguridad
     * que eligio en el sistema 
     * @param $perfil int
     * @param $modulo int 
     */
    public function delSeguridad( $perfil , $modulo ) {
        //realizamos la consulta para eliminar la seguridad
        $this->db->exec('DELETE FROM '.$this->table.' WHERE perfil = "'.$perfil.'" AND modulo = "'.$modulo.'"');
    }
    
    /**
     * Crea en el sistema el usuario
     * inscrito por el usuario
     * @param $array array() 
     * @return $id int
     */
    public function newSeguridad( $array ) {
        //creamos el sql para la insercion
        $consulta = $this->db->insert($this->table,$array);                 
        //realizamos la consulta para insertar el seguridad
        $this->db->exec($consulta);        
        return $this->db->lastInsertId();
    }
    
    /**
     * Confirma si la seguridad se encuentra
     * en el sistema 
     * @param $retorna int
     * @param $perfil int
     * @param $modulo int
     * @return  $retorna
     */
    public function confirmSeguridad( $retorna , $perfil , $modulo )
    {
        //realizamos la consulta de todos los uao
        $consulta = $this->db->prepare('SELECT '.$retorna.' FROM '.$this->table.' WHERE perfil = "'.$perfil.'" AND modulo = "'.$modulo.'" ');                 
        $consulta->execute();
        $registro = $consulta->fetch();        
        return $registro[$retorna];            
    }
    
    
}
?>