<?php

class DirectorController extends ControllerBase {

    private $url = "director.php";
    private $modelo = "models/DirectorModel.php";
    private $table = "director_curso";
    private $id = "id";
    private $pagina = "director";

    //Accion index
    public function director() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Director = new DirectorModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del director logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')],true);
        
        $arrayModulo = $modulo->consultModuloWhere("pagina = '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }

        //determina que consulta fue la que realizo en director en la busqueda
        $parametros_busqueda="&busqueda=".$_GET["busqueda"];
        $busqueda = "";
        if ($_GET) {
            $arrayRegistro = $_GET;
            $arrayRegistro[$this->id] = "";
            if ($_GET["busqueda"]) {
                unset($_GET["busqueda"]);
                $eliminaCaracter = false;
                foreach ($_GET as $clave => $valor) {
                    if (($clave != "busqueda" ) && ($clave != "controlador" ) && ($clave != "accion" ) && ($clave != "page" )&& ($clave != "max" )&& ($clave != "item" )) {
                        if ($valor) {
                            $eliminaCaracter = true;
                            if ( $clave == "nombre" )
                                $busqueda = $busqueda . " $this->table.$clave LIKE '%" . $valor . "%' AND";
                            else
                                $busqueda = $busqueda . " $this->table.$clave = '" . $valor . "' AND";
                        }
                    }
                }
                if ($eliminaCaracter)
                    $busqueda = " where " . substr($busqueda, 0, strlen($busqueda) - 3);
            }
        }
        else {
            $arrayRegistro = $Director->estructuraDirector();
        }

        
        //Pasamos a la vista toda la información que se desea representar        
        $vars = array();
        if ($_GET["id"]) {
            if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
                if ($_GET["a"]) {
                    $array = array("id"=>$_GET["id"],"activo"=>"1");                   
                    $Director->modDirector($array);
                }
                else
                {
                    $array = array("id"=>$_GET["id"],"activo"=>"0");                   
                    $Director->modDirector($array);
                }
            } else {
                $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                $vars['alerta'] = 3;
            }
        }
        
        //Consulta sql del modulo
        $sql = "SELECT $this->table.*, usuario.primer_nombre , usuario.segundo_nombre, usuario.primer_apellido, usuario.segundo_apellido,curso.nombre as grado
                FROM $this->table
                INNER JOIN usuario ON usuario.id=$this->table.usuario
                INNER JOIN curso ON curso.id=$this->table.curso
                ";
        //Se une los sql con las posibles concatenaciones
        $sql = $sql . $busqueda . " ORDER BY $this->table.id";

        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();

        //Cramos el paginador
        $paginador = new PHPPaging($modulo->thisdb());
        $paginador->param = "&controlador=Director&accion=director".$parametros_busqueda;
        $paginador->rowCount($sql);
        $paginador->config(3, 50);
        
        $sql = $sql." LIMIT $paginador->start_row, $paginador->max_rows";
        
        $consulta = $modulo->listarPaginador($sql);        
        $arrayPaginador = array();        
        while( $registro = $consulta->fetch(PDO::FETCH_ASSOC) )
        {
                $arrayPaginador[] = $registro;            
        }
        
        if ($arrayRegistro["anio"] == "") {
            $arrayRegistro["anio"] = date('Y');
        }
        
        $vars['arrayPaginador'] = $arrayPaginador;
        $vars['paginador'] = $paginador;
        $vars['arrayRegistro'] = $arrayRegistro;
        $vars['arrayPermiso'] = $arrayPermiso;
        $vars['formularioNuevo'] = false;
        $vars['formXhtml'] = $formXhtml;
        $vars["dataUser"] = $arrayDatosUser;
        $vars['anios'] = Resources::anio();

        $this->view->show($this->url, $vars);
    }

    //Accion index
    public function nuevo() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Director = new DirectorModel();
        $modulo = new ModuloModel();
        
        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del director logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')],true);

        $arrayModulo = $modulo->consultModuloWhere("pagina= '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }
        
        $arrayRegistro = $Director->estructuraDirector();

        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();

        //Pasamos a la vista toda la información que se desea representar
        $vars = array();
        $vars['arrayRegistro'] = $arrayRegistro;
        $vars['arrayPermiso'] = $arrayPermiso;
        $vars['formularioNuevo'] = true;
        $vars['tituloMetodo'] = "Nuevo";
        $vars['accion'] = "nuevo";
        $vars['formXhtml'] = $formXhtml;
        $vars["dataUser"] = $arrayDatosUser;

        $this->view->show($this->url, $vars);
    }

    public function nuevoRegistro() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Director = new DirectorModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del director logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')],true);

        $arrayModulo = $modulo->consultModuloWhere("pagina= '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }
        
        //Creamos el array para el formulario del director
        $arrayRegistro = $_POST;
        
        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();
        
        //Pasamos a la vista toda la información que se desea representar
        $vars = array();
               
        if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
            $_POST["anio"] = date("Y");
            $_POST["fecha_crear"] = date("Y-m-d H:i:s");
            $_POST["usuario_crear"] = $arrayDatosUser["id"];        
            $id = $Director->newDirector($_POST);
            $arrayRegistro = $Director->consultDirector($id);
            $vars['alerta'] = 1;
            $vars['accion'] = "editar";
        } else {
            $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
            $vars['alerta'] = 3;
            $vars['accion'] = "listar";
        }
        
        $vars['accionDocumento'] = "nuevo";        
        $vars['arrayRegistro'] = $arrayRegistro;
        $vars['arrayPermiso'] = $arrayPermiso;
        $vars['formularioNuevo'] = true;
        $vars['tituloMetodo'] = "Editar";        
        $vars['formXhtml'] = $formXhtml;
        $vars["dataUser"] = $arrayDatosUser;

        $this->view->show($this->url, $vars);
    }

    public function editarRegistro() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";
        
        //Creamos una instancia de nuestro "modelo"
        $Director = new DirectorModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del director logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')],true);

        $arrayModulo = $modulo->consultModuloWhere("pagina= '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }
        
        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();

        //Pasamos a la vista toda la información que se desea representar
        $vars = array();
        
        //Creamos el array para el formulario del director
        if (isset($_GET["id"]))
            $id=$_GET["id"];
        else
            $id=$_POST["id"];

        if ($Director->confirmDirector($id)) {            
            $arrayRegistro = $Director->consultDirector($id);
            if (!isset($_GET["id"]))
            {
                if (in_array("1", $arrayPermiso)==true||in_array("2", $arrayPermiso)==true) {
                    $_POST["fecha_editar"] = date("Y-m-d H:i:s");
                    $_POST["usuario_editar"] = $arrayDatosUser["id"];
                    $Director->modDirector($_POST);                
                    $arrayRegistro = $Director->consultDirector($id);
                    $vars['alerta'] = 2;
                }
                else
                {
                    $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                    $vars['alerta'] = 3;
                }
            }
                        
            $vars['arrayRegistro'] = $arrayRegistro;
            $vars['arrayPermiso'] = $arrayPermiso;
            $vars['URLROOT'] = $config->get('URLROOT');
            $vars['formularioNuevo'] = true;
            $vars['tituloMetodo'] = "Editar";        
            $vars['accion'] = "editar";        
            $vars['formXhtml'] = $formXhtml;
            $vars["dataUser"] = $arrayDatosUser;
            $this->view->show($this->url, $vars);
        } else {
            $formXhtml->location("index.php?controlador=Director&accion=director");
        }
        
    }

}

?>