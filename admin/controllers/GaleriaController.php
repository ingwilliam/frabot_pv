<?php

class GaleriaController extends ControllerBase {

    private $url = "galeria.php";
    private $modelo = "models/GaleriaModel.php";
    private $table = "galeria";
    private $id = "id";
    private $pagina = "galeria";

    //Accion index
    public function galeria() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Galeria = new GaleriaModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del galeria logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        $arrayModulo = $modulo->consultModuloWhere("pagina = '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }

        //determina que consulta fue la que realizo en galeria en la busqueda
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
            $arrayRegistro = $Galeria->estructuraGaleria();
        }


        //Pasamos a la vista toda la información que se desea representar        
        $vars = array();
        if ($_GET["id"]) {
            if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
                if ($_GET["a"]) {
                    $array = array("id" => $_GET["id"], "activo" => "1");
                    $Galeria->modGaleria($array);
                } else {
                    $array = array("id" => $_GET["id"], "activo" => "0");
                    $Galeria->modGaleria($array);
                }
            } else {
                $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                $vars['alerta'] = 3;
            }
        }

        //Consulta sql del modulo
        $sql = "SELECT $this->table.* FROM $this->table";
        //Se une los sql con las posibles concatenaciones
        $sql = $sql . $busqueda . " ORDER BY $this->table.nombre";

        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();



        //Cramos el paginador
        $paginador = new PHPPaging($modulo->thisdb());
        $paginador->param = "&controlador=Galeria&accion=galeria" . $parametros_busqueda;
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
        $Galeria = new GaleriaModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del galeria logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        $arrayModulo = $modulo->consultModuloWhere("pagina= '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }

        $arrayRegistro = $Galeria->estructuraGaleria();

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
        $Galeria = new GaleriaModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del galeria logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        $arrayModulo = $modulo->consultModuloWhere("pagina= '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }

        //Creamos el array para el formulario del galeria
        $arrayRegistro = $_POST;
        
        

        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();

        //Pasamos a la vista toda la información que se desea representar
        $vars = array();

        if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
            $_POST["fecha_crear"] = date("Y-m-d H:i:s");
            $_POST["usuario_crear"] = $arrayDatosUser["id"];
            if ($_FILES["archivo"]["name"] != null) {
                $_POST['archivo'] = $formXhtml->unloadfile($_FILES["archivo"], $config->get('GALERIA_DIR'),"galeria");
            }
            $id = $Galeria->newGaleria($_POST);
            $arrayRegistro = $Galeria->consultGaleria($id);
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
        $Galeria = new GaleriaModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del galeria logueado
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

        //Creamos el array para el formulario del galeria
        if (isset($_GET["id"]))
            $id = $_GET["id"];
        else
            $id = $_POST["id"];

        if ($Galeria->confirmGaleria($id)) {
            $arrayRegistro = $Galeria->consultGaleria($id);
            if (!isset($_GET["id"])) {
                if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
                    $_POST["fecha_editar"] = date("Y-m-d H:i:s");
                    $_POST["usuario_editar"] = $arrayDatosUser["id"];
                    if ($_FILES["archivo"]["name"] != null) {
                        $_POST['archivo'] = $formXhtml->unloadfile($_FILES["archivo"], $config->get('GALERIA_DIR'),"galeria");
                    }
                    $Galeria->modGaleria($_POST);
                    $arrayRegistro = $Galeria->consultGaleria($id);
                    $vars['alerta'] = 2;
                } else {
                    $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                    $vars['alerta'] = 3;
                }
            }

            $sql = "SELECT 
                        up.*    
                    FROM
                        galeria_seccion AS up 
                    WHERE
                        up.galeria='" . $arrayRegistro["id"] . "'";

            $arraySecciones = $Galeria->listArraySql($sql, "seccion", true);

            $vars['arrayRegistro'] = $arrayRegistro;
            $vars['arrayPermiso'] = $arrayPermiso;
            $vars['arraySecciones'] = $arraySecciones;
            $vars['URLROOT'] = $config->get('URLROOT');
            $vars['formularioNuevo'] = true;
            $vars['tituloMetodo'] = "Editar";
            $vars['accion'] = "editar";
            $vars['formXhtml'] = $formXhtml;
            $vars["dataUser"] = $arrayDatosUser;
            $this->view->show($this->url, $vars);
        } else {
            $formXhtml->location("index.php?controlador=Galeria&accion=galeria");
        }
    }

    public function nuevoSeccion() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Galeria = new GaleriaModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del galeria logueado
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

        //Creamos el array para el formulario del galeria
        if (isset($_GET["id"]))
            $id = $_GET["id"];
        else
            $id = $_POST["id"];


        if ($Galeria->confirmGaleria($id)) {
            $arrayRegistro = $Galeria->consultGaleria($id);
            if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
                $Galeria->ejecutaSql("DELETE FROM `galeria_seccion` WHERE `galeria`='" . $arrayRegistro["id"] . "'");

                foreach ($_POST["arrayCheckBuscadorseccion"] as $clave => $valor) {
                    $Galeria->ejecutaSql("INSERT INTO `galeria_seccion`(`seccion`, `galeria`) VALUES ('" . $valor . "','" . $arrayRegistro["id"] . "')");
                }

                $vars['alerta'] = 1;
            } else {
                $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                $vars['alerta'] = 3;
            }

            $sql = "SELECT 
                        up.*    
                    FROM
                        galeria_seccion AS up 
                    WHERE
                        up.galeria='" . $arrayRegistro["id"] . "'";

            $arraySecciones = $Galeria->listArraySql($sql, "seccion", true);

            $vars['arrayRegistro'] = $arrayRegistro;
            $vars['arrayPermiso'] = $arrayPermiso;
            $vars['arraySecciones'] = $arraySecciones;
            $vars['URLROOT'] = $config->get('URLROOT');
            $vars['formularioNuevo'] = true;
            $vars['tituloMetodo'] = "Editar";
            $vars['accion'] = "editar";
            $vars['formXhtml'] = $formXhtml;
            $vars["dataUser"] = $arrayDatosUser;
            $this->view->show($this->url, $vars);
        } else {
            $formXhtml->location("index.php?controlador=Galeria&accion=galeria");
        }
    }

}

?>