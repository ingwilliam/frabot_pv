<?php

class UsuarioController extends ControllerBase {

    private $url = "usuario.php";
    private $modelo = "models/UsuarioModel.php";
    private $table = "usuario";
    private $id = "id";
    private $pagina = "usuario";

    //Accion index
    public function usuario() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Usuario = new UsuarioModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del usuario logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        $arrayModulo = $modulo->consultModuloWhere("pagina= '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }

        //determina que consulta fue la que realizo en usuario en la busqueda
        $parametros_busqueda = "&busqueda=" . $_GET["busqueda"];
        $busqueda = "";
        if ($_GET) {
            $arrayRegistro = $_GET;
            $arrayRegistro[$this->id] = "";
            if ($_GET["busqueda"]) {
                unset($_GET["busqueda"]);

                if ($_GET["perfil"] == "")
                    unset($_GET["perfil"]);

                $eliminaCaracter = false;
                foreach ($_GET as $clave => $valor) {
                    if (($clave != "busqueda" ) && ($clave != "controlador" ) && ($clave != "accion" ) && ($clave != "page" ) && ($clave != "max" ) && ($clave != "item" ) && ($clave != "perfil" )) {
                        if ($valor) {
                            $eliminaCaracter = true;
                            $parametros_busqueda = $parametros_busqueda . "&$clave=$valor";
                            if (( $clave == "numero_documento" ) || ( $clave == "primer_nombre" ) || ( $clave == "segundo_nombre" ) || ( $clave == "primer_apellido" ) || ( $clave == "segundo_apellido" ) || ( $clave == "usuario" ))
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
            $arrayRegistro = $Usuario->estructuraUsuario();
        }

        //Pasamos a la vista toda la información que se desea representar
        $vars = array();
        if ($_GET["id"]) {
            if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
                if ($_GET["a"]) {
                    $array = array("id" => $_GET["id"], "activo" => "1");
                    $Usuario->modUsuario($array);
                } else {
                    $array = array("id" => $_GET["id"], "activo" => "0");
                    $Usuario->modUsuario($array);
                }
            } else {
                $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                $vars['alerta'] = 3;
            }
        }

        //Consulta sql del modulo
        $sql = "SELECT $this->table.id,
                     $this->table.primer_nombre ,
                     $this->table.segundo_nombre ,
                     $this->table.primer_apellido ,                                          
                     $this->table.segundo_apellido ,
                     $this->table.numero_documento ,
                     $this->table.usuario ,
                     $this->table.clave ,                                
                     $this->table.activo ,
                     $this->table.fecha_nacimiento,
                     $this->table.fecha_crear,
                     CONCAT(usuario_crear.primer_nombre, ' ', usuario_crear.segundo_nombre, ' ', usuario_crear.primer_apellido, ' ', usuario_crear.segundo_apellido) AS usuario_crear,                        
                     tipo_documento.nombre as tipo_documento
             FROM $this->table
             LEFT JOIN tipo_documento
                ON $this->table.tipo_documento=tipo_documento.id
            INNER JOIN usuario AS usuario_crear ON $this->table.usuario_crear=usuario_crear.id
                ";
        if (isset($_GET["perfil"])) {
            $sql = $sql . " INNER JOIN usuario_perfil ON usuario_perfil.usuario = $this->table.id";
            $busqueda = $busqueda . " AND usuario_perfil.perfil = '" . $_GET["perfil"] . "'";
            $parametros_busqueda = $parametros_busqueda . "&perfil=" . $_GET["perfil"];
        }

        //Se une los sql con las posibles concatenaciones
        $sql = $sql . $busqueda . " ORDER BY $this->table.$this->id DESC";

        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();

        //Cramos el paginador
        $paginador = new PHPPaging($Usuario->thisdb());
        $paginador->param = "&controlador=Usuario&accion=usuario" . $parametros_busqueda;
        $paginador->rowCount($sql);
        $paginador->config(3, 10);

        $sql = $sql . " LIMIT $paginador->start_row, $paginador->max_rows";

        $consulta = $Usuario->listarPaginador($sql);
        $arrayPaginador = array();
        while ($registro = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $arrayPaginador[] = $registro;
        }

        $vars['arrayPaginador'] = $arrayPaginador;
        $vars['paginador'] = $paginador;
        $vars['anios'] = Resources::anio();
        $vars['arrayRegistro'] = $arrayRegistro;
        $vars['config'] = $config;
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
        $Usuario = new UsuarioModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del usuario logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        $arrayModulo = $modulo->consultModuloWhere("pagina= '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }

        $arrayRegistro = $Usuario->estructuraUsuario();

        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();

        //Pasamos a la vista toda la información que se desea representar
        $vars = array();
        $vars['arrayRegistro'] = $arrayRegistro;            
        $vars['config'] = $config;
        $vars['anios'] = Resources::anio();
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
        require "models/DocumentoModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Usuario = new UsuarioModel();
        $modulo = new ModuloModel();
        $documento = new DocumentoModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del usuario logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        $arrayModulo = $modulo->consultModuloWhere("pagina= '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }

        //Creamos el array para el formulario del usuario
        $arrayRegistro = $_POST;

        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();

        //Pasamos a la vista toda la información que se desea representar
        $vars = array();

        if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
            if (!$Usuario->confirmUsuarioWhere("numero_documento = '" . $_POST["numero_documento"] . "' AND tipo_documento = '" . $_POST["tipo_documento"] . "'")) {
                if (!$Usuario->confirmUsuarioWhere("usuario = '" . $_POST["usuario"] . "'")) {
                    $_POST["fecha_crear"] = date("Y-m-d H:i:s");
                    $_POST["usuario_crear"] = $arrayDatosUser["id"];
                    $_POST["clave"] = sha1($_POST["clave"]);
                    if ($_FILES["archivo"]["name"] != null) {
                        $_POST['archivo'] = $formXhtml->unloadfile($_FILES["archivo"], $config->get('USUARIOS_DIR'),"usuario");
                    }
                    $id = $Usuario->newUsuario($_POST);
                    $arrayRegistro = $Usuario->consultUsuario($id);
                    $vars['alerta'] = 1;
                    $vars['accion'] = "editar";
                    $vars['accionDocumento'] = "nuevo";
                } else {
                    $vars['error'] = "El campo (usuario) que intenta ingresar ya se encuentra en la base de datos";
                    $vars['alerta'] = 3;
                    $vars['accion'] = "nuevo";
                }
            } else {
                $vars['error'] = "Los campos de identificacion (Tipo de documento y Numero de documento) ya se encuentra en la base de datos";
                $vars['alerta'] = 3;
                $vars['accion'] = "nuevo";
            }
        } else {
            $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
            $vars['alerta'] = 3;
            $vars['accion'] = "listar";
        }

        $arrayRegistro["clave"] = "";

        $arrayDocumentos = $documento->listDocumento("WHERE usuario='" . $arrayRegistro["id"] . "'", "tipo");

        $sql = "SELECT 
                up.*    
            FROM
                usuario_perfil AS up 
            WHERE
                up.usuario='" . $arrayRegistro["id"] . "'";

        $arrayPerfiles = $Usuario->listArraySql($sql, "perfil", true);

        $vars['arrayRegistro'] = $arrayRegistro;            
        $vars['config'] = $config;
        $vars['anios'] = Resources::anio();
        $vars['arrayDocumentos'] = $arrayDocumentos;
        $vars['arrayPerfiles'] = $arrayPerfiles;
        $vars['URLROOT'] = $config->get('URLROOT');
        $vars['arrayPermiso'] = $arrayPermiso;
        $vars['formularioNuevo'] = true;
        $vars['tituloMetodo'] = "Editar";
        $vars['formXhtml'] = $formXhtml;
        $vars["dataUser"] = $arrayDatosUser;

        $this->view->show($this->url, $vars);
    }

    public function nuevoDocumento() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/DocumentoModel.php";

        require "models/ModuloModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Usuario = new UsuarioModel();
        $documento = new DocumentoModel();

        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del usuario logueado
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

        $arrayRegistro = $Usuario->consultUsuario($_GET["id"]);

        if (count($arrayRegistro) > 1) {

            //Pasamos a la vista toda la información que se desea representar
            $vars = array();

            if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {

                if ($_FILES["archivo"]["name"] != null) {
                    $_POST['archivo'] = $formXhtml->unloadfile($_FILES["archivo"], $config->get('USUARIOS_DIR'),"usuario");
                }

                $_POST['usuario'] = $arrayRegistro["id"];

                $documento->newDocumento($_POST);

                $vars['alerta'] = 1;
            } else {
                $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                $vars['alerta'] = 3;
            }

            $arrayRegistro["clave"] = "";

            $sql = "SELECT 
                        up.*    
                    FROM
                        usuario_perfil AS up 
                    WHERE
                        up.usuario='" . $arrayRegistro["id"] . "'";

            $arrayPerfiles = $Usuario->listArraySql($sql, "perfil", true);

            $arrayDocumentos = $documento->listDocumento("WHERE usuario='" . $arrayRegistro["id"] . "'", "tipo");

            $vars['arrayRegistro'] = $arrayRegistro;            
            $vars['config'] = $config;
            $vars['anios'] = Resources::anio();
            $vars['arrayPerfiles'] = $arrayPerfiles;
            $vars['accion'] = "editar";
            $vars['arrayPermiso'] = $arrayPermiso;
            $vars['arrayDocumentos'] = $arrayDocumentos;
            $vars['URLROOT'] = $config->get('URLROOT');
            $vars['formularioNuevo'] = true;
            $vars['tituloMetodo'] = "Editar";
            $vars['formXhtml'] = $formXhtml;
            $vars["dataUser"] = $arrayDatosUser;

            $this->view->show($this->url, $vars);
        } else {
            $formXhtml->location("index.php?controlador=Usuario&accion=usuario");
        }
    }

    public function nuevoPerfil() {
        //Incluye el modelo que corresponde
        require $this->modelo;

        require "models/DocumentoModel.php";
        require "models/ModuloModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Usuario = new UsuarioModel();
        $documento = new DocumentoModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del usuario logueado
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

        $arrayRegistro = $Usuario->consultUsuario($_GET["id"]);

        if (count($arrayRegistro) > 1) {

            //Pasamos a la vista toda la información que se desea representar
            $vars = array();

            if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {

                $Usuario->ejecutaSql("DELETE FROM `usuario_perfil` WHERE `usuario`='" . $arrayRegistro["id"] . "'");

                foreach ($_POST["arrayCheckBuscadorperfil"] as $clave => $valor) {
                    $Usuario->ejecutaSql("INSERT INTO `usuario_perfil`(`perfil`, `usuario`) VALUES ('" . $valor . "','" . $arrayRegistro["id"] . "')");
                }

                $vars['alerta'] = 1;
            } else {
                $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                $vars['alerta'] = 3;
            }

            $arrayRegistro["clave"] = "";

            $sql = "SELECT 
                        up.*    
                    FROM
                        usuario_perfil AS up 
                    WHERE
                        up.usuario='" . $arrayRegistro["id"] . "'";

            $arrayPerfiles = $Usuario->listArraySql($sql, "perfil", true);

            $arrayDocumentos = $documento->listDocumento("WHERE usuario='" . $arrayRegistro["id"] . "'", "tipo");

            $vars['arrayRegistro'] = $arrayRegistro;            
            $vars['config'] = $config;
            $vars['anios'] = Resources::anio();
            $vars['arrayPermiso'] = $arrayPermiso;
            $vars['arrayPerfiles'] = $arrayPerfiles;
            $vars['arrayDocumentos'] = $arrayDocumentos;
            $vars['URLROOT'] = $config->get('URLROOT');
            $vars['formularioNuevo'] = true;
            $vars['tituloMetodo'] = "Editar";
            $vars['accion'] = "editar";
            $vars['formXhtml'] = $formXhtml;
            $vars["dataUser"] = $arrayDatosUser;

            $this->view->show($this->url, $vars);
        } else {
            $formXhtml->location("index.php?controlador=Usuario&accion=usuario");
        }
    }

    public function desactivarDocumento() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/DocumentoModel.php";
        require "models/ModuloModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Usuario = new UsuarioModel();
        $documento = new DocumentoModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del usuario logueado
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

        $arrayRegistro = $Usuario->consultUsuario($_GET["id"]);

        if (count($arrayRegistro) > 1) {

            //Pasamos a la vista toda la información que se desea representar
            $vars = array();

            $arrayRegistroDocumento = $documento->consultDocumento($_GET["idd"]);

            if (count($arrayRegistroDocumento) > 1) {

                if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
                    $array = array("id" => $_GET["idd"], "activo" => "0");
                    $documento->modDocumento($array);
                    $vars['alerta'] = 2;
                } else {
                    $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                    $vars['alerta'] = 3;
                }

                $arrayRegistro["clave"] = "";

                $arrayDocumentos = $documento->listDocumento("WHERE usuario='" . $_GET["id"] . "'", "tipo");

                $sql = "SELECT 
                        up.*    
                    FROM
                        usuario_perfil AS up 
                    WHERE
                        up.usuario='" . $arrayRegistro["id"] . "'";

                $arrayPerfiles = $Usuario->listArraySql($sql, "perfil", true);

                $vars['arrayRegistro'] = $arrayRegistro;            
                $vars['config'] = $config;
                $vars['anios'] = Resources::anio();
                $vars['arrayDocumentos'] = $arrayDocumentos;
                $vars['arrayPermiso'] = $arrayPermiso;
                $vars['arrayPerfiles'] = $arrayPerfiles;
                $vars['formularioNuevo'] = true;
                $vars['URLROOT'] = $config->get('URLROOT');
                $vars['tituloMetodo'] = "Editar";
                $vars['accion'] = "editar";
                $vars['formXhtml'] = $formXhtml;
                $vars["dataUser"] = $arrayDatosUser;

                $this->view->show($this->url, $vars);
            } else {
                $formXhtml->location("index.php?controlador=Usuario&accion=usuario");
            }
        } else {
            $formXhtml->location("index.php?controlador=Usuario&accion=usuario");
        }
    }

    public function activarDocumento() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/DocumentoModel.php";
        require "models/ModuloModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Usuario = new UsuarioModel();
        $documento = new DocumentoModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del usuario logueado
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

        $arrayRegistro = $Usuario->consultUsuario($_GET["id"]);

        if (count($arrayRegistro) > 1) {

            //Pasamos a la vista toda la información que se desea representar
            $vars = array();

            $arrayRegistroDocumento = $documento->consultDocumento($_GET["idd"]);
            if (count($arrayRegistroDocumento) > 1) {

                if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
                    $array = array("id" => $_GET["idd"], "activo" => "1");

                    $documento->modDocumento($array);

                    $vars['alerta'] = 2;
                } else {
                    $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                    $vars['alerta'] = 3;
                }

                $arrayRegistro["clave"] = "";

                $arrayDocumentos = $documento->listDocumento("WHERE usuario='" . $_GET["id"] . "'", "tipo");

                $sql = "SELECT 
                        up.*    
                    FROM
                        usuario_perfil AS up 
                    WHERE
                        up.usuario='" . $arrayRegistro["id"] . "'";

                $arrayPerfiles = $Usuario->listArraySql($sql, "perfil", true);

                $vars['arrayRegistro'] = $arrayRegistro;            
                $vars['config'] = $config;
                $vars['anios'] = Resources::anio();
                $vars['arrayDocumentos'] = $arrayDocumentos;
                $vars['arrayPerfiles'] = $arrayPerfiles;
                $vars['arrayPermiso'] = $arrayPermiso;
                $vars['formularioNuevo'] = true;
                $vars['URLROOT'] = $config->get('URLROOT');
                $vars['tituloMetodo'] = "Editar";
                $vars['accion'] = "editar";
                $vars['formXhtml'] = $formXhtml;
                $vars["dataUser"] = $arrayDatosUser;

                $this->view->show($this->url, $vars);
            } else {
                $formXhtml->location("index.php?controlador=Usuario&accion=usuario");
            }
        } else {
            $formXhtml->location("index.php?controlador=Usuario&accion=usuario");
        }
    }

    public function editarRegistro() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/DocumentoModel.php";
        require "models/ModuloModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Usuario = new UsuarioModel();
        $documento = new DocumentoModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del usuario logueado
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

        //Creamos el array para el formulario del usuario
        if (isset($_GET["id"]))
            $id = $_GET["id"];
        else
            $id = $_POST["id"];

        if ($Usuario->confirmUsuario($id)) {
            $arrayRegistro = $Usuario->consultUsuario($id);
            if (!isset($_GET["id"])) {
                if (!$Usuario->confirmUsuarioWhere("numero_documento = '" . $_POST["numero_documento"] . "' AND tipo_documento = '" . $_POST["tipo_documento"] . "' AND id<>'" . $id . "'")) {
                    if (!$Usuario->confirmUsuarioWhere("usuario = '" . $_POST["usuario"] . "' AND id<>'" . $id . "'")) {
                        if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {

                            if ($_FILES["archivo"]["name"] != null) {
                                $_POST['archivo'] = $formXhtml->unloadfile($_FILES["archivo"], $config->get('USUARIOS_DIR'));
                            }

                            $_POST["fecha_editar"] = date("Y-m-d H:i:s");
                            $_POST["usuario_editar"] = $arrayDatosUser["id"];
                            if ($_POST["clave"] != "") {
                                $_POST["clave"] = sha1($_POST["clave"]);
                            } else {
                                unset($_POST["clave"]);
                            }
                            $id = $Usuario->modUsuario($_POST);
                            $arrayRegistro = $Usuario->consultUsuario($id);
                            $vars['alerta'] = 2;
                        } else {
                            $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                            $vars['alerta'] = 3;
                        }
                    } else {
                        $vars['error'] = "El campo (usuario) que intenta ingresar ya se encuentra en la base de datos";
                        $vars['alerta'] = 3;
                    }
                } else {
                    $vars['error'] = "Los campos de identificacion (Tipo de documento y Numero de documento) ya se encuentra en la base de datos";
                    $vars['alerta'] = 3;
                }
            }

            $arrayRegistro["clave"] = "";

            $arrayDocumentos = $documento->listDocumento("WHERE usuario='" . $arrayRegistro["id"] . "'", "tipo");

            $sql = "SELECT 
                        up.*    
                    FROM
                        usuario_perfil AS up 
                    WHERE
                        up.usuario='" . $arrayRegistro["id"] . "'";

            $arrayPerfiles = $Usuario->listArraySql($sql, "perfil", true);

            $vars['arrayRegistro'] = $arrayRegistro;
            $vars['config'] = $config;
            $vars['anios'] = Resources::anio();
            $vars['arrayPermiso'] = $arrayPermiso;
            $vars['arrayDocumentos'] = $arrayDocumentos;
            $vars['arrayPerfiles'] = $arrayPerfiles;
            $vars['URLROOT'] = $config->get('URLROOT');
            $vars['formularioNuevo'] = true;
            $vars['tituloMetodo'] = "Editar";
            $vars['accion'] = "editar";
            $vars['formXhtml'] = $formXhtml;
            $vars["dataUser"] = $arrayDatosUser;
            $this->view->show($this->url, $vars);
        } else {
            $formXhtml->location("index.php?controlador=Usuario&accion=usuario");
        }
    }

}

?>