<?php

class ComentarioController extends ControllerBase {

    private $url = "comentario.php";
    private $modelo = "models/ComentarioModel.php";
    private $table = "comentario";
    private $id = "id";
    private $pagina = "comentario";

    //Accion index
    public function comentario() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Comentario = new ComentarioModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del comentario logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        $arrayModulo = $modulo->consultModuloWhere("pagina = '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }

        //determina que consulta fue la que realizo en comentario en la busqueda
        $parametros_busqueda = "&busqueda=" . $_GET["busqueda"];
        $busqueda = "";
        if ($_GET) {
            $arrayRegistro = $_GET;
            $arrayRegistro[$this->id] = "";
            if ($_GET["busqueda"]) {
                unset($_GET["busqueda"]);
                $eliminaCaracter = false;
                foreach ($_GET as $clave => $valor) {
                    if (($clave != "busqueda" ) && ($clave != "controlador" ) && ($clave != "accion" ) && ($clave != "page" ) && ($clave != "max" ) && ($clave != "item" )) {
                        if ($valor) {
                            $eliminaCaracter = true;
                            if ($clave == "nombre")
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
            $arrayRegistro = $Comentario->estructuraComentario();
        }


        //Pasamos a la vista toda la información que se desea representar        
        $vars = array();
        if ($_GET["id"]) {
            if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
                if ($_GET["a"]) {
                    $array = array("id" => $_GET["id"], "activo" => "1");
                    $Comentario->modComentario($array);
                } else {
                    $array = array("id" => $_GET["id"], "activo" => "0");
                    $Comentario->modComentario($array);
                }
            } else {
                $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                $vars['alerta'] = 3;
            }
        }

        //Consulta sql del modulo
        $sql = "SELECT $this->table.*,p.nombre as articulo,CONCAT(u.primer_nombre, ' ',u.primer_apellido) as usuario_crear FROM $this->table"
                . " INNER JOIN articulo AS p ON p.id=$this->table.articulo"
                . " INNER JOIN usuario AS u ON u.id=$this->table.usuario_crear";
        //Se une los sql con las posibles concatenaciones
        $sql = $sql . $busqueda . " ORDER BY $this->table.fecha_crear DESC";
        
        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();



        //Cramos el paginador
        $paginador = new PHPPaging($modulo->thisdb());
        $paginador->param = "&controlador=Comentario&accion=comentario" . $parametros_busqueda;
        $paginador->rowCount($sql);
        $paginador->config(3, 50);

        $sql = $sql . " LIMIT $paginador->start_row, $paginador->max_rows";

        $consulta = $modulo->listarPaginador($sql);
        $arrayPaginador = array();
        while ($registro = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $arrayPaginador[] = $registro;
        }

        $vars['arrayPaginador'] = $arrayPaginador;
        $vars['paginador'] = $paginador;
        $vars['arrayRegistro'] = $arrayRegistro;
        $vars['arrayPermiso'] = $arrayPermiso;
        $vars['formularioNuevo'] = false;
        $vars['formXhtml'] = $formXhtml;
        $vars["dataUser"] = $arrayDatosUser;

        $this->view->show($this->url, $vars);
    }

    //Accion index
    public function nuevo() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Comentario = new ComentarioModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del comentario logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        $arrayModulo = $modulo->consultModuloWhere("pagina= '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }

        $arrayRegistro = $Comentario->estructuraComentario();

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
        $Comentario = new ComentarioModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del comentario logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        $arrayModulo = $modulo->consultModuloWhere("pagina= '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }

        //Creamos el array para el formulario del comentario
        $arrayRegistro = $_POST;
        
        

        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();

        //Pasamos a la vista toda la información que se desea representar
        $vars = array();

        if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
            $_POST["fecha_crear"] = date("Y-m-d H:i:s");
            $_POST["usuario_crear"] = $arrayDatosUser["id"];            
            $id = $Comentario->newComentario($_POST);
            $arrayRegistro = $Comentario->consultComentario($id);
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
        $Comentario = new ComentarioModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del comentario logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

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

        //Creamos el array para el formulario del comentario
        if (isset($_GET["id"]))
            $id = $_GET["id"];
        else
            $id = $_POST["id"];

        if ($Comentario->confirmComentario($id)) {
            $arrayRegistro = $Comentario->consultComentario($id);
            if (!isset($_GET["id"])) {
                if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
                    $_POST["fecha_editar"] = date("Y-m-d H:i:s");
                    $_POST["usuario_editar"] = $arrayDatosUser["id"];
                    $Comentario->modComentario($_POST);
                    $arrayRegistro = $Comentario->consultComentario($id);
                    $vars['alerta'] = 2;
                } else {
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
            $formXhtml->location("index.php?controlador=Comentario&accion=comentario");
        }
    }

    public function nuevoSeccion() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Comentario = new ComentarioModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del comentario logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

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

        //Creamos el array para el formulario del comentario
        if (isset($_GET["id"]))
            $id = $_GET["id"];
        else
            $id = $_POST["id"];


        if ($Comentario->confirmComentario($id)) {
            $arrayRegistro = $Comentario->consultComentario($id);
            if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
                $Comentario->ejecutaSql("DELETE FROM `comentario_seccion` WHERE `comentario`='" . $arrayRegistro["id"] . "'");

                foreach ($_POST["arrayCheckBuscadorseccion"] as $clave => $valor) {
                    $Comentario->ejecutaSql("INSERT INTO `comentario_seccion`(`seccion`, `comentario`) VALUES ('" . $valor . "','" . $arrayRegistro["id"] . "')");
                }

                $vars['alerta'] = 1;
            } else {
                $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                $vars['alerta'] = 3;
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
            $formXhtml->location("index.php?controlador=Comentario&accion=comentario");
        }
    }

}

?>