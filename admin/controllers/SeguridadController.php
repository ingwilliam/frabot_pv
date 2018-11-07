<?php

class SeguridadController extends ControllerBase {

    private $pagina = "seguridad";
    private $url = "seguridad.php";
    private $modelo = "models/SeguridadModel.php";
    private $table = "modulo_perfil_permiso";
    
    //Accion index
    public function seguridad() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";       
        require "models/PerfilModel.php";
        require "models/PermisoModel.php";        
        
        //Creamos una instancia de nuestro "modelo"
        $seguridad = new SeguridadModel();
        $perfil = new PerfilModel();
        $modulo = new ModuloModel();
        $permiso = new PermisoModel();
        
        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del usuario logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')],true);
        
        $arrayModulo = $modulo->consultModuloWhere("pagina= '" . $this->pagina . "'");

        $arrayPermiso=array();
        foreach($arrayDatosUser["usuario_perfil"] as $clave => $valor)
        {
            if($valor["usuario"]==$arrayDatosUser["id"]&&$valor["modulo"]==$arrayModulo["id"])
            {
                $arrayPermiso[] = $valor["permiso"];
            }                
        }
        
        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();
        
        //creamos los array de la vista
        $arrayPerfiles = $perfil->listArraySql("SELECT * FROM perfil WHERE activo = true","id");
        $arrayModulos = $modulo->listArraySql("SELECT * FROM modulo WHERE activo = true","id");
        $arrayPermisos = $permiso->listArraySql("SELECT * FROM permiso WHERE activo = true","id");
        
        //Pasamos a la vista toda la información que se desea representar
        $vars = array();
        $vars['arrayPerfiles'] = $arrayPerfiles;
        $vars['arrayModulos'] = $arrayModulos;
        $vars['arrayPermisos'] = $arrayPermisos;
        $vars['arrayPermiso'] = $arrayPermiso;
        $vars['objSeguridad'] = $seguridad;
        $vars['formularioNuevo'] = true;
        $vars['formXhtml'] = $formXhtml;
        $vars["dataUser"] = $arrayDatosUser;

        $this->view->show($this->url, $vars);
    }
    
    public function genPermiso(){
        //Incluye el modelo que corresponde
        require $this->modelo;

        //Creamos una instancia de nuestro "modelo"
        $seguridad = new SeguridadModel();

        if( $_POST["permiso"] == 0 )
        {
            //Elimino el registro del perfil y el modulo
            $seguridad->delSeguridad($_POST["perfil"], $_POST["modulo"]);
        }
        else
        {
            //Elimino el registro del perfil y el modulo
            $seguridad->delSeguridad($_POST["perfil"], $_POST["modulo"]);
            
            

            //Metodo para ingresar el registro
            $seguridad->newSeguridad( $_POST );
            
            print_r($_POST);
        exit;
        }
    }

}
?>