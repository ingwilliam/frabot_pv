<?php

class LoginModel extends ModelBase
{
    private $vars = array();
    private $table = "usuario";
    private $idTable = "id";
    
    //Con set vamos guardando nuestras variables.
    public function set($name, $value)
    {        
        if(!isset($this->vars[$name]))
        {
            $this->vars[$name] = $value;
        }
    }
    
    //Con get('nombre_de_la_variable') recuperamos un valor.
    public function get($name)
    {
        if(isset($this->vars[$name]))
        {
            return $this->vars[$name];
        }
    }
    
    
    /**
     * Toma los datos que el usuario ingreso
     * para verificar en la base de datos si existe     
     * @return $consulta string 
     */
    public function authentication()
    {
        //realizamos la consulta de todos los usuarios
        
        $consulta = $this->db->prepare('SELECT '.$this->table.'.id,'.$this->table.'.primer_nombre,'.$this->table.'.segundo_nombre,'.$this->table.'.primer_apellido,'.$this->table.'.segundo_apellido,'.$this->table.'.fecha_nacimiento,'.$this->table.'.celular,'.$this->table.'.telefono,'.$this->table.'.ubicacion,'.$this->table.'.barrio,'.$this->table.'.ciudad_ubicacion FROM '.$this->table.' WHERE '.$this->table.'.usuario = "'. Resources::replaceSymbols($this->get("email")).'" AND '.$this->table.'.clave = "'. Resources::replaceSymbols($this->get("clave")).'" AND '.$this->table.'.activo = 1');                
        
        $consulta->execute();
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
        
        $consulta = $this->db->prepare('SELECT up.usuario,mpp.* FROM usuario_perfil AS up
                                        INNER JOIN modulo_perfil_permiso AS mpp ON mpp.perfil=up.perfil
                                        WHERE up.usuario = '.$usuario["id"].'');                
        $consulta->execute();
        $arrayUsuarioPerfil = array();
        
        $arrayPerfil = array();
        
        while( $usuario_perfil = $consulta->fetch(PDO::FETCH_ASSOC) )
        {
                $arrayUsuarioPerfil[] = $usuario_perfil;            
                $arrayPerfil[$usuario_perfil["perfil"]] = $usuario_perfil["perfil"];
        }
        
        $usuario["usuario_perfil"]=$arrayUsuarioPerfil;
        $usuario["array_perfil"]=$arrayPerfil;
        
        return $usuario;        
    }
    
}

?>
