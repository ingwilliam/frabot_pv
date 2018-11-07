<?php

class MatriculaController extends ControllerBase {

    private $url = "matricula.php";
    private $modelo = "models/MatriculaModel.php";
    private $table = "matricula";
    private $id = "id";
    private $pagina = "matriculas";

    //Accion index
    public function matricula() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";

        /*
         * ME QUEDE EN EL PDF ENVIANDO EL ID Y MOSTRAR INFORMACION DINAMICA OK
         */


        //Creamos una instancia de nuestro "modelo"
        $Matricula = new MatriculaModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del matricula logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        $arrayModulo = $modulo->consultModuloWhere("pagina= '" . $this->pagina . "'");

        $arrayPermiso = array();


       
        
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }
        
        //determina que consulta fue la que realizo en matricula en la busqueda
        $parametros_busqueda = "&busqueda=" . $_GET["busqueda"];
        $busqueda_usuario = "";
        $busqueda_matricula = "";
        if ($_GET["estado"] == "2") {
            unset($_GET["estado"]);
        }
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
                            $parametros_busqueda = $parametros_busqueda."&$clave=$valor";
                            if ($clave == "primer_nombre" || $clave == "primer_apellido") {
                                $busqueda_usuario = $busqueda_usuario . " usuario.$clave LIKE '%" . $valor . "%' AND";
                            } else {
                                if ($clave == "numero_documento") {
                                    $busqueda_matricula = $busqueda_matricula . " $this->table.$clave LIKE '%" . $valor . "%' AND";
                                } else
                                    $busqueda_matricula = $busqueda_matricula . " $this->table.$clave = '" . $valor . "' AND";
                            }
                        }
                    }
                }

                if ($eliminaCaracter) {
                    $busqueda_usuario = " WHERE " . $busqueda_usuario;
                    $busqueda_matricula = substr($busqueda_matricula, 0, strlen($busqueda_matricula) - 3);
                }
            }
        } else {
            $arrayRegistro = $Matricula->estructuraMatricula();
        }

        //Pasamos a la vista toda la información que se desea representar        
        $vars = array();
        if ($_GET["id"]) {
            if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
                if ($_GET["a"]) {
                    $array = array("id" => $_GET["id"], "activo" => "1","fecha_editar" => date("Y-m-d H:i:s"),"usuario_editar" => $arrayDatosUser["id"]);                    
                    $Matricula->modMatricula($array);
                } else {
                    $array = array("id" => $_GET["id"], "activo" => "0","fecha_editar" => date("Y-m-d H:i:s"),"usuario_editar" => $arrayDatosUser["id"]);
                    $Matricula->modMatricula($array);
                }
            } else {
                $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                $vars['alerta'] = 3;
            }
        }

        if (isset($_POST["idEstado"])) {
            if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
                if ($_POST["estadoEditar"] == "Matriculado") {
                    if (in_array("1", $arrayDatosUser["array_perfil"]) == true || in_array("2", $arrayDatosUser["array_perfil"]) == true) {
                        $array = array("id" => $_POST["idEstado"], "estado" => $_POST["estadoEditar"],"fecha_editar" => date("Y-m-d H:i:s"),"usuario_editar" => $arrayDatosUser["id"]);
                        $Matricula->modMatricula($array);
                    }
                } else {
                    if (in_array("1", $arrayDatosUser["array_perfil"]) == true || in_array("2", $arrayDatosUser["array_perfil"]) == true || in_array("3", $arrayDatosUser["array_perfil"]) == true || in_array("4", $arrayDatosUser["array_perfil"]) == true) {
                        $array = array("id" => $_POST["idEstado"], "estado" => $_POST["estadoEditar"],"fecha_editar" => date("Y-m-d H:i:s"),"usuario_editar" => $arrayDatosUser["id"]);
                        $Matricula->modMatricula($array);
                    }
                }
            } else {
                $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                $vars['alerta'] = 3;
            }
        }


        //Consulta sql del modulo
        $sql = "SELECT
                    $this->table.id,
                    $this->table.fecha_crear,
                    $this->table.fecha_editar,
                    $this->table.anio,
                    curso.nombre as curso,
                    usuario.primer_nombre ,
                    usuario.segundo_nombre ,
                    usuario.primer_apellido ,                                          
                    usuario.segundo_apellido ,
                    $this->table.numero_documento ,
                    $this->table.activo ,
                    $this->table.estado ,
                    usuario.fecha_nacimiento,
                    tipo_documento.nombre as tipo_documento,
                    CONCAT(usuario_crear.primer_nombre, ' ', usuario_crear.segundo_nombre, ' ', usuario_crear.primer_apellido, ' ', usuario_crear.segundo_apellido) AS usuario_crear,
                    CONCAT(usuario_editar.primer_nombre, ' ', usuario_editar.segundo_nombre, ' ', usuario_editar.primer_apellido, ' ', usuario_editar.segundo_apellido) AS usuario_editar
                FROM 
                    $this->table
                INNER JOIN usuario ON $this->table.estudiante=usuario.id
                LEFT JOIN tipo_documento ON $this->table.tipo_documento=tipo_documento.id
                INNER JOIN curso ON $this->table.curso=curso.id
                INNER JOIN usuario AS usuario_crear ON $this->table.usuario_crear=usuario_crear.id
                LEFT JOIN usuario AS usuario_editar ON $this->table.usuario_editar=usuario_editar.id
                        ";
        //Se une los sql con las posibles concatenaciones
        $sql = $sql . $busqueda_usuario . $busqueda_matricula . " ORDER BY $this->table.fecha_crear DESC,$this->table.numero_documento ";

        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();

        //Cramos el paginador
        $paginador = new PHPPaging($modulo->thisdb());
        $paginador->param = "&controlador=Matricula&accion=matricula" . $parametros_busqueda;
        $paginador->rowCount($sql);
        $paginador->config(3, 30);

        $sql = $sql . " LIMIT $paginador->start_row, $paginador->max_rows";


        $consulta = $modulo->listarPaginador($sql);
        $arrayPaginador = array();
        while ($registro = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $arrayPaginador[] = $registro;
        }

        //Pasamos a la vista toda la información que se desea representar

        if ($arrayRegistro["anio"] == "") {
            $arrayRegistro["anio"] = date('Y');
        }
        
        $where="";
        if ($_GET["curso"] != "") {
            $where = " AND curso = ".$_GET["curso"];
        }
        
        

        $arrayMatriculados = $Matricula->listMatriculaSql("SELECT estado, count(id) AS total FROM matricula WHERE anio = '" . $arrayRegistro["anio"] . "' $where GROUP BY estado");

        $matriculados = 0;
        $revisados = 0;
        $inscritos = 0;
        foreach ($arrayMatriculados as $clave => $valor) {
            if ($valor["estado"] == "" || $valor["estado"] == null || $valor["estado"] == "Inscrito" || $valor["estado"] == "null") {
                $inscritos = $inscritos + $valor["total"];
            }

            if ($valor["estado"] == "Revisado") {
                $revisados = $revisados + $valor["total"];
            }

            if ($valor["estado"] == "Matriculado") {
                $matriculados = $matriculados + $valor["total"];
            }
        }

        $matriculadosp = 0;
        $revisadosp = 0;
        $inscritosp = 0;

        $total = $matriculados + $revisados + $inscritos;


        $matriculadosp = round($matriculados / $total * 100, 2);
        $revisadosp = round($revisados / $total * 100, 2);
        $inscritosp = round($inscritos / $total * 100, 2);


        if (!isset($_GET["estado"])) {
            $arrayRegistro["estado"] = "2";
        }

        $vars['arrayPaginador'] = $arrayPaginador;
        $vars['paginador'] = $paginador;
        $vars['anios'] = Resources::anio();
        $vars['arrayRegistro'] = $arrayRegistro;
        $vars['arrayPermiso'] = $arrayPermiso;
        $vars['formularioNuevo'] = false;
        $vars['formXhtml'] = $formXhtml;
        $vars["dataUser"] = $arrayDatosUser;
        $vars["matriculados"] = $matriculados;
        $vars["revisados"] = $revisados;
        $vars["inscritos"] = $inscritos;
        $vars["matriculadosp"] = $matriculadosp;
        $vars["revisadosp"] = $revisadosp;
        $vars["inscritosp"] = $inscritosp;

        $this->view->show($this->url, $vars);
    }

    //Accion index
    public function nuevo() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Matricula = new MatriculaModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del matricula logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        $arrayModulo = $modulo->consultModuloWhere("pagina= '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }
        //Pasamos a la vista toda la información que se desea representar
        $vars = array();

        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();

        //determina que consulta fue la que realizo en matricula en la busqueda
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
                            if ($clave == "numero_documento" || $clave == "primer_nombre" || $clave == "primer_apellido")
                                $busqueda = $busqueda . " $this->table.$clave LIKE '%" . $valor . "%' AND";
                            else
                                $busqueda = $busqueda . " $this->table.$clave = '" . $valor . "' AND";
                        }
                    }
                }
                if ($eliminaCaracter)
                    $busqueda = " WHERE " . substr($busqueda, 0, strlen($busqueda) - 3);

                //Consulta sql del modulo
                $sql = "SELECT
                    $this->table.id,
                    usuario.id AS usuario,    
                    $this->table.fecha_crear,
                    $this->table.anio,
                    curso.nombre as curso,
                    usuario.primer_nombre ,
                    usuario.segundo_nombre ,
                    usuario.primer_apellido ,                                          
                    usuario.segundo_apellido ,
                    $this->table.numero_documento ,
                    $this->table.activo ,
                    usuario.fecha_nacimiento,
                    tipo_documento.nombre as tipo_documento,
                    CONCAT(usuario_crear.primer_nombre, ' ', usuario_crear.segundo_nombre, ' ', usuario_crear.primer_apellido, ' ', usuario_crear.segundo_apellido) AS usuario_crear
                FROM 
                    $this->table
                INNER JOIN usuario ON $this->table.estudiante=usuario.id
                LEFT JOIN tipo_documento ON $this->table.tipo_documento=tipo_documento.id
                INNER JOIN curso ON $this->table.curso=curso.id
                INNER JOIN usuario AS usuario_crear ON $this->table.usuario_crear=usuario_crear.id
                        ";
                //Se une los sql con las posibles concatenaciones
                $sql = $sql . $busqueda . " ORDER BY $this->table.numero_documento";

                //Cramos el paginador
                $paginador = new PHPPaging($modulo->thisdb());
                $paginador->param = "&controlador=Usuario&accion=usuario" . $parametros_busqueda;
                $paginador->rowCount($sql);
                $paginador->config(3, 10);

                $sql = $sql . " LIMIT $paginador->start_row, $paginador->max_rows";

                $consulta = $modulo->listarPaginador($sql);
                $arrayPaginador = array();
                while ($registro = $consulta->fetch(PDO::FETCH_ASSOC)) {
                    $arrayPaginador[] = $registro;
                }


                $vars['arrayPaginador'] = $arrayPaginador;
                $vars['paginador'] = $paginador;
            }
        } else {
            $arrayRegistro = $Matricula->estructuraMatricula();
        }


        if ($arrayRegistro["anio"] == "") {
            $arrayRegistro["anio"] = date('Y') - 1;
        }

        $vars['anios'] = Resources::anio();
        $vars['arrayRegistro'] = $arrayRegistro;
        $vars['arrayPermiso'] = $arrayPermiso;
        $vars['formularioNuevo'] = true;
        $vars['tituloMetodo'] = "Nuevo";
        $vars['accion'] = "nuevoConfirmar";
        $vars['formXhtml'] = $formXhtml;
        $vars["dataUser"] = $arrayDatosUser;

        $this->view->show($this->url, $vars);
    }

    //Accion index
    public function registroConfirmado() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";
        require "models/UsuarioModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Matricula = new MatriculaModel();
        $modulo = new ModuloModel();
        $Usuario = new UsuarioModel();

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

        $arrayRegistro = $Matricula->estructuraMatricula();

        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();

        if ($arrayRegistro["anio"] == "") {
            $arrayRegistro["anio"] = date('Y');
        }

        //Pasamos a la vista toda la información que se desea representar
        $vars = array();

        //Creamos el array para el formulario del usuario
        if (isset($_GET["estudiante"])) {
            if ($Usuario->confirmUsuario($_GET["estudiante"])) {
                $vars['estudiante'] = $_GET["estudiante"];
                if ($Matricula->confirmMatricula($_GET["id"])) {
                    $arrayRegistroUsuario = $Usuario->ejecutaSqlArray("SELECT usuario.*,ciudad.nombre as ciudad_nacimiento FROM usuario
                                                                        INNER JOIN ciudad ON usuario.ciudad_nacimiento=ciudad.id   
                                                                       WHERE usuario.id = '" . $_GET["estudiante"] . "'");
                    $arrayRegistro = $Matricula->consultMatricula($_GET["id"]);
                    $arrayRegistro["primer_nombre"] = $arrayRegistroUsuario["primer_nombre"];
                    $arrayRegistro["segundo_nombre"] = $arrayRegistroUsuario["segundo_nombre"];
                    $arrayRegistro["primer_apellido"] = $arrayRegistroUsuario["primer_apellido"];
                    $arrayRegistro["segundo_apellido"] = $arrayRegistroUsuario["segundo_apellido"];
                    $arrayRegistro["genero"] = $arrayRegistroUsuario["genero"];
                    $arrayRegistro["ciudad_nacimiento"] = $arrayRegistroUsuario["ciudad_nacimiento"];
                    $arrayRegistro["fecha_nacimiento"] = $arrayRegistroUsuario["fecha_nacimiento"];
                    $arrayRegistro["rh"] = $arrayRegistroUsuario["rh"];
                    $arrayRegistro["usuario"] = $arrayRegistroUsuario["usuario"];
                } else {
                    $formXhtml->location("index.php?controlador=Matricula&accion=matricula");
                }
            } else {
                $formXhtml->location("index.php?controlador=Matricula&accion=matricula");
            }
        }


        $vars['anios'] = Resources::anio();
        $vars['arrayRegistro'] = $arrayRegistro;
        $vars['arrayPermiso'] = $arrayPermiso;
        $vars['formularioNuevo'] = true;
        $vars['tituloMetodo'] = "Nueva";
        $vars['accion'] = "nuevo";
        $vars['formXhtml'] = $formXhtml;
        $vars["dataUser"] = $arrayDatosUser;

        $this->view->show($this->url, $vars);
    }

    public function nuevoRegistro() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";
        require "models/UsuarioModel.php";
        require "models/DocumentoModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Matricula = new MatriculaModel();
        $modulo = new ModuloModel();
        $Usuario = new UsuarioModel();
        $documento = new DocumentoModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del matricula logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        $arrayModulo = $modulo->consultModuloWhere("pagina= '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }

        //Creamos el array para el formulario del matricula
        $arrayRegistro = $_POST;

        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();

        //Pasamos a la vista toda la información que se desea representar
        $vars = array();
        $crear_usuario = false;
        $crear_matricula = false;

        //Variable estudiante que viene de importar los datos, confirma si creo usuario o solo lo asocio
        if (isset($arrayRegistro["estudiante"])) {
            if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
                if (!$Matricula->confirmMatriculaWhere("anio = '" . $_POST["anio"] . "' AND numero_documento = '" . $_POST["numero_documento"] . "' AND tipo_documento = '" . $_POST["tipo_documento"] . "'")) {
                    $crear_matricula = true;
                } else {
                    $vars['error'] = "Los campos de identificacion (Año, Tipo de documento y Numero de documento) ya se encuentra en la base de datos, este estudiante ya esta matriculado para este año ('" . $_POST["anio"] . "')";
                    $vars['alerta'] = 3;
                    $vars['accion'] = "nuevo";

                    $vars['estudiante'] = $arrayRegistro["estudiante"];

                    if ($Usuario->confirmUsuario($arrayRegistro["estudiante"])) {
                        $arrayRegistroUsuario = $Usuario->ejecutaSqlArray("SELECT usuario.*,ciudad.nombre as ciudad_nacimiento FROM usuario
                                                                        INNER JOIN ciudad ON usuario.ciudad_nacimiento=ciudad.id   
                                                                       WHERE usuario.id = '" . $arrayRegistro["estudiante"] . "'");


                        $arrayRegistro["primer_nombre"] = $arrayRegistroUsuario["primer_nombre"];
                        $arrayRegistro["segundo_nombre"] = $arrayRegistroUsuario["segundo_nombre"];
                        $arrayRegistro["primer_apellido"] = $arrayRegistroUsuario["primer_apellido"];
                        $arrayRegistro["segundo_apellido"] = $arrayRegistroUsuario["segundo_apellido"];
                        $arrayRegistro["genero"] = $arrayRegistroUsuario["genero"];
                        $arrayRegistro["ciudad_nacimiento"] = $arrayRegistroUsuario["ciudad_nacimiento"];
                        $arrayRegistro["fecha_nacimiento"] = $arrayRegistroUsuario["fecha_nacimiento"];
                        $arrayRegistro["rh"] = $arrayRegistroUsuario["rh"];
                        $arrayRegistro["usuario"] = $arrayRegistroUsuario["usuario"];
                    } else {
                        $formXhtml->location("index.php?controlador=Matricula&accion=matricula");
                    }
                }
            } else {
                $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                $vars['alerta'] = 3;
                $vars['accion'] = "listar";
            }

            if ($crear_matricula == true) {
                $_POST["fecha_crear"] = date("Y-m-d H:i:s");
                $_POST["usuario_crear"] = $arrayDatosUser["id"];
                $_POST["activo"] = 1;
                $_POST["id"] = "";
                $id_matricula = $Matricula->newMatricula($_POST);
                $arrayRegistro = $Matricula->consultMatricula($id_matricula);
                $arrayRegistroUsuario = $Usuario->ejecutaSqlArray("SELECT usuario.*,ciudad.nombre as ciudad_nacimiento FROM usuario
                                                                        INNER JOIN ciudad ON usuario.ciudad_nacimiento=ciudad.id   
                                                                       WHERE usuario.id = '" . $_POST["estudiante"] . "'");
                $arrayDocumentos = $documento->listDocumento("WHERE usuario='" . $arrayRegistro["id"] . "'", "id DESC");
                $arrayDocumentosCertificados = $documento->listDocumento("WHERE usuario='" . $arrayRegistro["estudiante"] . "'", "tipo");
                $arrayAcudientes = $Matricula->listMatriculaSql("SELECT usuario.*,acudiente.parentesco FROM acudiente
                                                            INNER JOIN usuario ON usuario.id=acudiente.usuario
                                                            WHERE acudiente.matricula = '" . $id_matricula . "';");


                $vars['alerta'] = 1;
                $vars['accion'] = "editar";
                $vars['accionDocumento'] = "nuevo";
                $vars['estudiante'] = $arrayRegistro["estudiante"];

                $arrayRegistro["primer_nombre"] = $arrayRegistroUsuario["primer_nombre"];
                $arrayRegistro["segundo_nombre"] = $arrayRegistroUsuario["segundo_nombre"];
                $arrayRegistro["primer_apellido"] = $arrayRegistroUsuario["primer_apellido"];
                $arrayRegistro["segundo_apellido"] = $arrayRegistroUsuario["segundo_apellido"];
                $arrayRegistro["genero"] = $arrayRegistroUsuario["genero"];
                $arrayRegistro["ciudad_nacimiento"] = $arrayRegistroUsuario["ciudad_nacimiento"];
                $arrayRegistro["fecha_nacimiento"] = $arrayRegistroUsuario["fecha_nacimiento"];
                $arrayRegistro["rh"] = $arrayRegistroUsuario["rh"];
                $arrayRegistro["usuario"] = $arrayRegistroUsuario["usuario"];
            } else {
                $vars['error'] = $vars['error'] . "<br/>Se presento un error al crear el usuario y/o estudiante";
            }
        } else {
            if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
                if (!$Usuario->confirmUsuarioWhere("numero_documento = '" . $_POST["numero_documento"] . "' AND tipo_documento = '" . $_POST["tipo_documento"] . "'")) {
                    if (!$Usuario->confirmUsuarioWhere("usuario = '" . $_POST["usuario"] . "'")) {
                        $crear_usuario = true;
                    } else {
                        $vars['error'] = "El campo (usuario) que intenta ingresar ya se encuentra en la base de datos";
                        $vars['alerta'] = 3;
                        $vars['accion'] = "nuevo";
                    }
                } else {
                    $vars['error'] = "Los campos de identificacion (Tipo de documento y Numero de documento) ya se encuentra en la  base de datos de estudiantes";
                    $vars['alerta'] = 3;
                    $vars['accion'] = "nuevo";
                }

                if (!$Matricula->confirmMatriculaWhere("anio = '" . $_POST["anio"] . "' AND numero_documento = '" . $_POST["numero_documento"] . "' AND tipo_documento = '" . $_POST["tipo_documento"] . "'")) {
                    $crear_matricula = true;
                } else {
                    $vars['error'] = "Los campos de identificacion (Año, Tipo de documento y Numero de documento) ya se encuentra en la base de datos, este estudiante ya esta matriculado para este año ('" . $_POST["anio"] . "')";
                    $vars['alerta'] = 3;
                    $vars['accion'] = "nuevo";
                }
            } else {
                $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                $vars['alerta'] = 3;
                $vars['accion'] = "listar";
            }

            if ($crear_usuario == true && $crear_matricula == true) {
                $_POST["fecha_crear"] = date("Y-m-d H:i:s");
                $_POST["usuario_crear"] = $arrayDatosUser["id"];
                $_POST["clave"] = sha1($_POST["numero_documento"]);
                $_POST["activo"] = 1;
                //creamos usuario y clave
                $_POST["usuario"] = strtolower($_POST["primer_nombre"][0] . $_POST["segundo_nombre"][0] . $_POST["primer_apellido"] . $_POST["segundo_apellido"][0] . "@colegioelfuturo.edu.co");
                $id_usuario = $Usuario->newUsuario($_POST);
                $_POST["estudiante"] = $id_usuario;
                $_POST["activo"] = 1;
                $id_matricula = $Matricula->newMatricula($_POST);
                $arrayRegistro = $Matricula->consultMatricula($id_matricula);

                $vars['estudiante'] = $arrayRegistro["estudiante"];

                $arrayRegistroUsuario = $Usuario->ejecutaSqlArray("SELECT usuario.*,ciudad.nombre as ciudad_nacimiento FROM usuario
                                                                        INNER JOIN ciudad ON usuario.ciudad_nacimiento=ciudad.id   
                                                                       WHERE usuario.id = '" . $id_usuario . "'");



                $Usuario->ejecutaSql("INSERT INTO usuario_perfil(perfil, usuario) VALUES ('5','" . $id_usuario . "')");
                $arrayDocumentos = $documento->listDocumento("WHERE usuario='" . $arrayRegistro["id"] . "'", "id DESC");
                $arrayDocumentosCertificados = $documento->listDocumento("WHERE usuario='" . $arrayRegistro["estudiante"] . "'", "tipo");
                $arrayAcudientes = $Matricula->listMatriculaSql("SELECT usuario.*,acudiente.parentesco FROM acudiente
                                                            INNER JOIN usuario ON usuario.id=acudiente.usuario
                                                            WHERE acudiente.matricula = '" . $id_matricula . "';");


                $vars['alerta'] = 1;
                $vars['accion'] = "editar";
                $vars['accionDocumento'] = "nuevo";

                $arrayRegistro["primer_nombre"] = $arrayRegistroUsuario["primer_nombre"];
                $arrayRegistro["segundo_nombre"] = $arrayRegistroUsuario["segundo_nombre"];
                $arrayRegistro["primer_apellido"] = $arrayRegistroUsuario["primer_apellido"];
                $arrayRegistro["segundo_apellido"] = $arrayRegistroUsuario["segundo_apellido"];
                $arrayRegistro["genero"] = $arrayRegistroUsuario["genero"];
                $arrayRegistro["ciudad_nacimiento"] = $arrayRegistroUsuario["ciudad_nacimiento"];
                $arrayRegistro["fecha_nacimiento"] = $arrayRegistroUsuario["fecha_nacimiento"];
                $arrayRegistro["rh"] = $arrayRegistroUsuario["rh"];
                $arrayRegistro["usuario"] = $arrayRegistroUsuario["usuario"];
            } else {
                $vars['error'] = $vars['error'] . "<br/>Se presento un error al crear el usuario y/o estudiante";
            }
        }

        $vars['arrayRegistro'] = $arrayRegistro;
        $vars['anios'] = Resources::anio();
        $vars['arrayRegistroUsuario'] = $arrayRegistroUsuario;
        $vars['arrayDocumentos'] = $arrayDocumentos;
        $vars['arrayDocumentosCertificados'] = $arrayDocumentosCertificados;
        $vars['arrayAcudientes'] = $arrayAcudientes;
        $vars['URLROOT'] = $config->get('URLROOT');
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
        require "models/DocumentoModel.php";
        require "models/UsuarioModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Matricula = new MatriculaModel();
        $documento = new DocumentoModel();
        $modulo = new ModuloModel();
        $Usuario = new UsuarioModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del matricula logueado
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

        //Creamos el array para el formulario del matricula
        if (isset($_GET["id"]))
            $id = $_GET["id"];
        else
            $id = $_POST["id"];

        if ($Matricula->confirmMatricula($id)) {
            $arrayRegistro = $Matricula->consultMatricula($id);
            if (!isset($_GET["id"])) {
                if (!$Matricula->confirmMatriculaWhere("anio = '" . $_POST["anio"] . "' AND numero_documento = '" . $_POST["numero_documento"] . "' AND tipo_documento = '" . $_POST["tipo_documento"] . "' AND id<>'" . $id . "'")) {
                    if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
                        $_POST["fecha_editar"] = date("Y-m-d H:i:s");
                        $_POST["usuario_editar"] = $arrayDatosUser["id"];
                        if ($_POST["clave"] != "") {
                            $_POST["clave"] = sha1($_POST["clave"]);
                        }
                        $id = $Matricula->modMatricula($_POST);
                                                
                        $arrayUsuarioEdit=array();
                        $arrayUsuarioEdit["id"] = $_POST["estudiante"];
                        $arrayUsuarioEdit["primer_nombre"] = $_POST["primer_nombre"];
                        $arrayUsuarioEdit["segundo_nombre"] = $_POST["segundo_nombre"];
                        $arrayUsuarioEdit["primer_apellido"] = $_POST["primer_apellido"];
                        $arrayUsuarioEdit["segundo_apellido"] = $_POST["segundo_apellido"];
                        $arrayUsuarioEdit["genero"] = $_POST["genero"];
                        $arrayUsuarioEdit["fecha_nacimiento"] = $_POST["fecha_nacimiento"];
                        $arrayUsuarioEdit["rh"] = $_POST["rh"];
                        $Usuario->modUsuario($arrayUsuarioEdit);
                        
                        $arrayRegistro = $Matricula->consultMatricula($id);
                        $vars['alerta'] = 2;
                    } else {
                        $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                        $vars['alerta'] = 3;
                    }
                } else {
                    $vars['error'] = "Los campos de identificacion (Tipo de documento y Numero de documento) ya se encuentra en la base de datos";
                    $vars['alerta'] = 3;
                }
            }

            $vars['estudiante'] = $arrayRegistro["estudiante"];

            $arrayRegistroUsuario = $Usuario->ejecutaSqlArray("SELECT usuario.*,ciudad.nombre as ciudad_nacimiento FROM usuario
             INNER JOIN ciudad ON usuario.ciudad_nacimiento=ciudad.id   
            WHERE usuario.id = '" . $arrayRegistro["estudiante"] . "'");

            $arrayRegistro["primer_nombre"] = $arrayRegistroUsuario["primer_nombre"];
            $arrayRegistro["segundo_nombre"] = $arrayRegistroUsuario["segundo_nombre"];
            $arrayRegistro["primer_apellido"] = $arrayRegistroUsuario["primer_apellido"];
            $arrayRegistro["segundo_apellido"] = $arrayRegistroUsuario["segundo_apellido"];
            $arrayRegistro["genero"] = $arrayRegistroUsuario["genero"];
            $arrayRegistro["ciudad_nacimiento"] = $arrayRegistroUsuario["ciudad_nacimiento"];
            $arrayRegistro["fecha_nacimiento"] = $arrayRegistroUsuario["fecha_nacimiento"];
            $arrayRegistro["rh"] = $arrayRegistroUsuario["rh"];
            $arrayRegistro["usuario"] = $arrayRegistroUsuario["usuario"];

            $arrayDocumentos = $documento->listDocumento("WHERE matricula='" . $arrayRegistro["id"] . "'", "tipo");
            $arrayDocumentosCertificados = $documento->listDocumento("WHERE usuario='" . $arrayRegistro["estudiante"] . "'", "tipo");

            $arrayAcudientes = $Matricula->listMatriculaSql("SELECT usuario.*,acudiente.parentesco FROM acudiente
                                                            INNER JOIN usuario ON usuario.id=acudiente.usuario
                                                            WHERE acudiente.matricula = '" . $arrayRegistro["id"] . "';");

            $vars['anios'] = Resources::anio();
            $vars['arrayRegistro'] = $arrayRegistro;
            $vars['arrayPermiso'] = $arrayPermiso;
            $vars['arrayDocumentos'] = $arrayDocumentos;
            $vars['arrayDocumentosCertificados'] = $arrayDocumentosCertificados;
            $vars['arrayAcudientes'] = $arrayAcudientes;
            $vars['URLROOT'] = $config->get('URLROOT');
            $vars['formularioNuevo'] = true;
            $vars['tituloMetodo'] = "Editar";
            $vars['accion'] = "editar";
            $vars['formXhtml'] = $formXhtml;
            $vars["dataUser"] = $arrayDatosUser;
            $this->view->show($this->url, $vars);
        } else {
            $formXhtml->location("index.php?controlador=Matricula&accion=matricula");
        }
    }

    public function nuevoDocumento() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/DocumentoModel.php";
        require "models/ModuloModel.php";
        require "models/UsuarioModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Matricula = new MatriculaModel();
        $documento = new DocumentoModel();
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

        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();

        $arrayRegistro = $Matricula->consultMatricula($_GET["id"]);

        if (count($arrayRegistro) > 1) {

            //Pasamos a la vista toda la información que se desea representar
            $vars = array();

            if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {

                if ($_FILES["archivo"]["name"] != null) {
                    $_POST['archivo'] = $formXhtml->unloadfile($_FILES["archivo"], $config->get('MATRICULAS_DIR'),"matricula");
                }

                $_POST['matricula'] = $arrayRegistro["id"];
                $_POST['activo'] = 1;

                $documento->newDocumento($_POST);

                $vars['alerta'] = 1;
            } else {
                $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                $vars['alerta'] = 3;
            }

            $vars['estudiante'] = $arrayRegistro["estudiante"];

            $arrayRegistroUsuario = $Matricula->ejecutaSqlArray("SELECT usuario.*,ciudad.nombre as ciudad_nacimiento FROM usuario
             INNER JOIN ciudad ON usuario.ciudad_nacimiento=ciudad.id   
            WHERE usuario.id = '" . $arrayRegistro["estudiante"] . "'");

            $arrayRegistro["primer_nombre"] = $arrayRegistroUsuario["primer_nombre"];
            $arrayRegistro["segundo_nombre"] = $arrayRegistroUsuario["segundo_nombre"];
            $arrayRegistro["primer_apellido"] = $arrayRegistroUsuario["primer_apellido"];
            $arrayRegistro["segundo_apellido"] = $arrayRegistroUsuario["segundo_apellido"];
            $arrayRegistro["genero"] = $arrayRegistroUsuario["genero"];
            $arrayRegistro["ciudad_nacimiento"] = $arrayRegistroUsuario["ciudad_nacimiento"];
            $arrayRegistro["fecha_nacimiento"] = $arrayRegistroUsuario["fecha_nacimiento"];
            $arrayRegistro["rh"] = $arrayRegistroUsuario["rh"];
            $arrayRegistro["usuario"] = $arrayRegistroUsuario["usuario"];

            $arrayDocumentos = $documento->listDocumento("WHERE matricula='" . $arrayRegistro["id"] . "'", "tipo");
            $arrayDocumentosCertificados = $documento->listDocumento("WHERE usuario='" . $arrayRegistro["estudiante"] . "'", "tipo");

            $arrayAcudientes = $Matricula->listMatriculaSql("SELECT usuario.*,acudiente.parentesco FROM acudiente
                                                            INNER JOIN usuario ON usuario.id=acudiente.usuario
                                                            WHERE acudiente.matricula = '" . $arrayRegistro["id"] . "';");

            $vars['anios'] = Resources::anio();
            $vars['arrayRegistro'] = $arrayRegistro;
            $vars['arrayAcudientes'] = $arrayAcudientes;
            $vars['arrayRegistroAcudiente'] = $Usuario->estructuraUsuario();
            $vars['accion'] = "editar";
            $vars['arrayPermiso'] = $arrayPermiso;
            $vars['arrayDocumentos'] = $arrayDocumentos;
            $vars['arrayDocumentosCertificados'] = $arrayDocumentosCertificados;
            $vars['URLROOT'] = $config->get('URLROOT');
            $vars['formularioNuevo'] = true;
            $vars['tituloMetodo'] = "Editar";
            $vars['formXhtml'] = $formXhtml;
            $vars["dataUser"] = $arrayDatosUser;

            $this->view->show($this->url, $vars);
        } else {
            $formXhtml->location("index.php?controlador=Matricula&accion=matricula");
        }
    }

    public function nuevoDocumentoCertificado() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/DocumentoModel.php";
        require "models/ModuloModel.php";
        require "models/UsuarioModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Matricula = new MatriculaModel();
        $documento = new DocumentoModel();
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

        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();

        $arrayRegistro = $Matricula->consultMatricula($_GET["id"]);

        if (count($arrayRegistro) > 1) {

            //Pasamos a la vista toda la información que se desea representar
            $vars = array();

            if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {

                if ($_FILES["archivo"]["name"] != null) {
                    $_POST['archivo'] = $formXhtml->unloadfile($_FILES["archivo"], $config->get('USUARIOS_DIR'),"matricula");
                }

                $_POST['usuario'] = $arrayRegistro["estudiante"];
                $_POST['activo'] = 1;
                $_POST['tipo'] = "Certificado";

                $documento->newDocumento($_POST);

                $vars['alerta'] = 1;
            } else {
                $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                $vars['alerta'] = 3;
            }

            $vars['estudiante'] = $arrayRegistro["estudiante"];

            $arrayRegistroUsuario = $Matricula->ejecutaSqlArray("SELECT usuario.*,ciudad.nombre as ciudad_nacimiento FROM usuario
             INNER JOIN ciudad ON usuario.ciudad_nacimiento=ciudad.id   
            WHERE usuario.id = '" . $arrayRegistro["estudiante"] . "'");

            $arrayRegistro["primer_nombre"] = $arrayRegistroUsuario["primer_nombre"];
            $arrayRegistro["segundo_nombre"] = $arrayRegistroUsuario["segundo_nombre"];
            $arrayRegistro["primer_apellido"] = $arrayRegistroUsuario["primer_apellido"];
            $arrayRegistro["segundo_apellido"] = $arrayRegistroUsuario["segundo_apellido"];
            $arrayRegistro["genero"] = $arrayRegistroUsuario["genero"];
            $arrayRegistro["ciudad_nacimiento"] = $arrayRegistroUsuario["ciudad_nacimiento"];
            $arrayRegistro["fecha_nacimiento"] = $arrayRegistroUsuario["fecha_nacimiento"];
            $arrayRegistro["rh"] = $arrayRegistroUsuario["rh"];
            $arrayRegistro["usuario"] = $arrayRegistroUsuario["usuario"];

            $arrayDocumentos = $documento->listDocumento("WHERE matricula='" . $arrayRegistro["id"] . "'", "tipo");
            $arrayDocumentosCertificados = $documento->listDocumento("WHERE usuario='" . $arrayRegistro["estudiante"] . "'", "tipo");

            $arrayAcudientes = $Matricula->listMatriculaSql("SELECT usuario.*,acudiente.parentesco FROM acudiente
                                                            INNER JOIN usuario ON usuario.id=acudiente.usuario
                                                            WHERE acudiente.matricula = '" . $arrayRegistro["id"] . "';");

            $vars['anios'] = Resources::anio();
            $vars['arrayRegistro'] = $arrayRegistro;
            $vars['arrayAcudientes'] = $arrayAcudientes;
            $vars['arrayRegistroAcudiente'] = $Usuario->estructuraUsuario();
            $vars['accion'] = "editar";
            $vars['arrayPermiso'] = $arrayPermiso;
            $vars['arrayDocumentos'] = $arrayDocumentos;
            $vars['arrayDocumentosCertificados'] = $arrayDocumentosCertificados;
            $vars['URLROOT'] = $config->get('URLROOT');
            $vars['formularioNuevo'] = true;
            $vars['tituloMetodo'] = "Editar";
            $vars['formXhtml'] = $formXhtml;
            $vars["dataUser"] = $arrayDatosUser;

            $this->view->show($this->url, $vars);
        } else {
            $formXhtml->location("index.php?controlador=Matricula&accion=matricula");
        }
    }

    public function desactivarDocumento() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/DocumentoModel.php";
        require "models/ModuloModel.php";
        require "models/UsuarioModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Matricula = new MatriculaModel();
        $documento = new DocumentoModel();
        $modulo = new ModuloModel();
        $Usuario = new UsuarioModel();

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

        $arrayRegistro = $Matricula->consultMatricula($_GET["id"]);

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

                $vars['estudiante'] = $arrayRegistro["estudiante"];

                $arrayRegistroUsuario = $Matricula->ejecutaSqlArray("SELECT usuario.*,ciudad.nombre as ciudad_nacimiento FROM usuario
                 INNER JOIN ciudad ON usuario.ciudad_nacimiento=ciudad.id   
                WHERE usuario.id = '" . $arrayRegistro["estudiante"] . "'");

                $arrayRegistro["primer_nombre"] = $arrayRegistroUsuario["primer_nombre"];
                $arrayRegistro["segundo_nombre"] = $arrayRegistroUsuario["segundo_nombre"];
                $arrayRegistro["primer_apellido"] = $arrayRegistroUsuario["primer_apellido"];
                $arrayRegistro["segundo_apellido"] = $arrayRegistroUsuario["segundo_apellido"];
                $arrayRegistro["genero"] = $arrayRegistroUsuario["genero"];
                $arrayRegistro["ciudad_nacimiento"] = $arrayRegistroUsuario["ciudad_nacimiento"];
                $arrayRegistro["fecha_nacimiento"] = $arrayRegistroUsuario["fecha_nacimiento"];
                $arrayRegistro["rh"] = $arrayRegistroUsuario["rh"];
                $arrayRegistro["usuario"] = $arrayRegistroUsuario["usuario"];

                $arrayDocumentos = $documento->listDocumento("WHERE matricula='" . $_GET["id"] . "'", "tipo");
                $arrayDocumentosCertificados = $documento->listDocumento("WHERE usuario='" . $arrayRegistro["estudiante"] . "'", "tipo");

                $arrayAcudientes = $Matricula->listMatriculaSql("SELECT usuario.*,acudiente.parentesco FROM acudiente
                                                            INNER JOIN usuario ON usuario.id=acudiente.usuario
                                                            WHERE acudiente.matricula = '" . $arrayRegistro["id"] . "';");

                $vars['anios'] = Resources::anio();
                $vars['arrayRegistro'] = $arrayRegistro;
                $vars['arrayRegistroAcudiente'] = $Usuario->estructuraUsuario();
                $vars['arrayDocumentos'] = $arrayDocumentos;
                $vars['arrayDocumentosCertificados'] = $arrayDocumentosCertificados;
                $vars['arrayAcudientes'] = $arrayAcudientes;
                $vars['arrayPermiso'] = $arrayPermiso;
                $vars['formularioNuevo'] = true;
                $vars['URLROOT'] = $config->get('URLROOT');
                $vars['tituloMetodo'] = "Editar";
                $vars['accion'] = "editar";
                $vars['formXhtml'] = $formXhtml;
                $vars["dataUser"] = $arrayDatosUser;

                $this->view->show($this->url, $vars);
            } else {
                $formXhtml->location("index.php?controlador=Matricula&accion=matricula");
            }
        } else {
            $formXhtml->location("index.php?controlador=Matricula&accion=matricula");
        }
    }

    public function eliminarAcudiente() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/DocumentoModel.php";
        require "models/ModuloModel.php";
        require "models/UsuarioModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Matricula = new MatriculaModel();
        $documento = new DocumentoModel();
        $modulo = new ModuloModel();
        $Usuario = new UsuarioModel();

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

        $arrayRegistro = $Matricula->consultMatricula($_GET["id"]);

        if (count($arrayRegistro) > 1) {

            //Pasamos a la vista toda la información que se desea representar
            $vars = array();

            if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
                $Matricula->ejecutaSql("DELETE FROM acudiente WHERE usuario='" . $_GET["idd"] . "' andmatricula='" . $_GET["id"] . "';");
                $vars['alerta'] = 2;
            } else {
                $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                $vars['alerta'] = 3;
            }

            $vars['estudiante'] = $arrayRegistro["estudiante"];

            $arrayRegistroUsuario = $Matricula->ejecutaSqlArray("SELECT usuario.*,ciudad.nombre as ciudad_nacimiento FROM usuario
                 INNER JOIN ciudad ON usuario.ciudad_nacimiento=ciudad.id   
                WHERE usuario.id = '" . $arrayRegistro["estudiante"] . "'");

            $arrayRegistro["primer_nombre"] = $arrayRegistroUsuario["primer_nombre"];
            $arrayRegistro["segundo_nombre"] = $arrayRegistroUsuario["segundo_nombre"];
            $arrayRegistro["primer_apellido"] = $arrayRegistroUsuario["primer_apellido"];
            $arrayRegistro["segundo_apellido"] = $arrayRegistroUsuario["segundo_apellido"];
            $arrayRegistro["genero"] = $arrayRegistroUsuario["genero"];
            $arrayRegistro["ciudad_nacimiento"] = $arrayRegistroUsuario["ciudad_nacimiento"];
            $arrayRegistro["fecha_nacimiento"] = $arrayRegistroUsuario["fecha_nacimiento"];
            $arrayRegistro["rh"] = $arrayRegistroUsuario["rh"];
            $arrayRegistro["usuario"] = $arrayRegistroUsuario["usuario"];

            $arrayDocumentos = $documento->listDocumento("WHERE matricula='" . $_GET["id"] . "'", "tipo");
            $arrayDocumentosCertificados = $documento->listDocumento("WHERE usuario='" . $arrayRegistro["estudiante"] . "'", "tipo");

            $arrayAcudientes = $Matricula->listMatriculaSql("SELECT usuario.*,acudiente.parentesco FROM acudiente
                                                            INNER JOIN usuario ON usuario.id=acudiente.usuario
                                                            WHERE acudiente.matricula = '" . $arrayRegistro["id"] . "';");

            $vars['anios'] = Resources::anio();
            $vars['arrayRegistro'] = $arrayRegistro;
            $vars['arrayRegistroAcudiente'] = $Usuario->estructuraUsuario();
            $vars['arrayDocumentosCertificados'] = $arrayDocumentosCertificados;
            $vars['arrayDocumentos'] = $arrayDocumentos;
            $vars['arrayAcudientes'] = $arrayAcudientes;
            $vars['arrayPermiso'] = $arrayPermiso;
            $vars['formularioNuevo'] = true;
            $vars['URLROOT'] = $config->get('URLROOT');
            $vars['tituloMetodo'] = "Editar";
            $vars['accion'] = "editar";
            $vars['formXhtml'] = $formXhtml;
            $vars["dataUser"] = $arrayDatosUser;

            $this->view->show($this->url, $vars);
        } else {
            $formXhtml->location("index.php?controlador=Matricula&accion=matricula");
        }
    }

    public function activarDocumento() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/DocumentoModel.php";
        require "models/ModuloModel.php";
        require "models/UsuarioModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Matricula = new MatriculaModel();
        $documento = new DocumentoModel();
        $modulo = new ModuloModel();
        $Usuario = new UsuarioModel();

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

        $arrayRegistro = $Matricula->consultMatricula($_GET["id"]);

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

                $vars['estudiante'] = $arrayRegistro["estudiante"];

                $arrayRegistroUsuario = $Matricula->ejecutaSqlArray("SELECT usuario.*,ciudad.nombre as ciudad_nacimiento FROM usuario
                 INNER JOIN ciudad ON usuario.ciudad_nacimiento=ciudad.id   
                WHERE usuario.id = '" . $arrayRegistro["estudiante"] . "'");

                $arrayRegistro["primer_nombre"] = $arrayRegistroUsuario["primer_nombre"];
                $arrayRegistro["segundo_nombre"] = $arrayRegistroUsuario["segundo_nombre"];
                $arrayRegistro["primer_apellido"] = $arrayRegistroUsuario["primer_apellido"];
                $arrayRegistro["segundo_apellido"] = $arrayRegistroUsuario["segundo_apellido"];
                $arrayRegistro["genero"] = $arrayRegistroUsuario["genero"];
                $arrayRegistro["ciudad_nacimiento"] = $arrayRegistroUsuario["ciudad_nacimiento"];
                $arrayRegistro["fecha_nacimiento"] = $arrayRegistroUsuario["fecha_nacimiento"];
                $arrayRegistro["rh"] = $arrayRegistroUsuario["rh"];
                $arrayRegistro["usuario"] = $arrayRegistroUsuario["usuario"];

                $arrayDocumentos = $documento->listDocumento("WHERE matricula='" . $_GET["id"] . "'", "tipo");
                $arrayDocumentosCertificados = $documento->listDocumento("WHERE usuario='" . $arrayRegistro["estudiante"] . "'", "tipo");
                $arrayAcudientes = $Matricula->listMatriculaSql("SELECT usuario.*,acudiente.parentesco FROM acudiente
                                                            INNER JOIN usuario ON usuario.id=acudiente.usuario
                                                            WHERE acudiente.matricula = '" . $arrayRegistro["id"] . "';");


                $vars['anios'] = Resources::anio();
                $vars['arrayRegistro'] = $arrayRegistro;
                $vars['arrayRegistroAcudiente'] = $Usuario->estructuraUsuario();
                $vars['arrayDocumentosCertificados'] = $arrayDocumentosCertificados;
                $vars['arrayDocumentos'] = $arrayDocumentos;
                $vars['arrayAcudientes'] = $arrayAcudientes;
                $vars['arrayPermiso'] = $arrayPermiso;
                $vars['formularioNuevo'] = true;
                $vars['URLROOT'] = $config->get('URLROOT');
                $vars['tituloMetodo'] = "Editar";
                $vars['accion'] = "editar";
                $vars['formXhtml'] = $formXhtml;
                $vars["dataUser"] = $arrayDatosUser;

                $this->view->show($this->url, $vars);
            } else {
                $formXhtml->location("index.php?controlador=Matricula&accion=matricula");
            }
        } else {
            $formXhtml->location("index.php?controlador=Matricula&accion=matricula");
        }
    }

    public function crearAcudiente() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";
        require "models/DocumentoModel.php";
        require "models/UsuarioModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Matricula = new MatriculaModel();
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
                    $_POST["activo"] = 1;
                    $id = $Usuario->newUsuario($_POST);
                    $vars['alerta'] = 1;
                    $vars['accion'] = "editar";
                    $vars['accionDocumento'] = "nuevo";
                    $Usuario->ejecutaSql("INSERT INTO usuario_perfil(perfil, usuario) VALUES ('6','" . $id . "')");
                    $Usuario->ejecutaSql("INSERT INTO acudiente(matricula, usuario, parentesco) VALUES ('" . $_GET["id"] . "','" . $id . "','" . $_POST["parentesco"] . "')");
                    $vars['arrayRegistroAcudiente'] = $Usuario->estructuraUsuario();
                } else {
                    $vars['error'] = "El campo (usuario) que intenta ingresar ya se encuentra en la base de datos de acudientes";
                    $vars['alerta'] = 3;
                    $vars['dinamico_crear'] = 1;
                    $vars['accion'] = "nuevo";
                    $vars['arrayRegistroAcudiente'] = $_POST;
                }
            } else {
                $vars['error'] = "Los campos de identificacion (Tipo de documento y Numero de documento) ya se encuentra en la base de datos de acudientes";
                $vars['alerta'] = 3;
                $vars['dinamico_crear'] = 1;
                $vars['accion'] = "nuevo";
                $vars['arrayRegistroAcudiente'] = $_POST;
            }
        } else {
            $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
            $vars['alerta'] = 3;
            $vars['dinamico_crear'] = 1;
            $vars['accion'] = "listar";
        }

        $arrayDocumentos = $documento->listDocumento("WHERE matricula='" . $_GET["id"] . "'", "tipo");

        $arrayRegistro = $Matricula->consultMatricula($_GET["id"]);

        $arrayDocumentosCertificados = $documento->listDocumento("WHERE usuario='" . $arrayRegistro["estudiante"] . "'", "tipo");

        $vars['estudiante'] = $arrayRegistro["estudiante"];

        $arrayRegistroUsuario = $Usuario->ejecutaSqlArray("SELECT usuario.*,ciudad.nombre as ciudad_nacimiento FROM usuario
         INNER JOIN ciudad ON usuario.ciudad_nacimiento=ciudad.id   
        WHERE usuario.id = '" . $arrayRegistro["estudiante"] . "'");

        $arrayRegistro["primer_nombre"] = $arrayRegistroUsuario["primer_nombre"];
        $arrayRegistro["segundo_nombre"] = $arrayRegistroUsuario["segundo_nombre"];
        $arrayRegistro["primer_apellido"] = $arrayRegistroUsuario["primer_apellido"];
        $arrayRegistro["segundo_apellido"] = $arrayRegistroUsuario["segundo_apellido"];
        $arrayRegistro["genero"] = $arrayRegistroUsuario["genero"];
        $arrayRegistro["ciudad_nacimiento"] = $arrayRegistroUsuario["ciudad_nacimiento"];
        $arrayRegistro["fecha_nacimiento"] = $arrayRegistroUsuario["fecha_nacimiento"];
        $arrayRegistro["rh"] = $arrayRegistroUsuario["rh"];
        $arrayRegistro["usuario"] = $arrayRegistroUsuario["usuario"];

        /* ME QUEDE EN EL BUSCADOR DE LOS ACUDIENTES, FALTA CARGAR BARRIOS Y CIUDADES */


        $arrayAcudientes = $Matricula->listMatriculaSql("SELECT usuario.*,acudiente.parentesco FROM acudiente
                                                            INNER JOIN usuario ON usuario.id=acudiente.usuario
                                                            WHERE acudiente.matricula = '" . $arrayRegistro["id"] . "';");



        $vars['anios'] = Resources::anio();
        $vars['arrayRegistro'] = $arrayRegistro;
        $vars['arrayPermiso'] = $arrayPermiso;
        $vars['arrayAcudientes'] = $arrayAcudientes;
        $vars['arrayDocumentosCertificados'] = $arrayDocumentosCertificados;
        $vars['arrayDocumentos'] = $arrayDocumentos;
        $vars['URLROOT'] = $config->get('URLROOT');
        $vars['formularioNuevo'] = true;
        $vars['tituloMetodo'] = "Editar";
        $vars['accion'] = "editar";
        $vars['formXhtml'] = $formXhtml;
        $vars["dataUser"] = $arrayDatosUser;
        $this->view->show($this->url, $vars);
    }

    public function buscarAcudiente() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";
        require "models/DocumentoModel.php";
        require "models/UsuarioModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Matricula = new MatriculaModel();
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

        if ($_GET["numero_documento"] != "" || $_GET["primer_nombre"] != "" || $_GET["primer_apellido"] != "") {

            if ($_GET["numero_documento"] != "") {
                $a1 = $a1 . " usuario.numero_documento LIKE '%" . $_GET["numero_documento"] . "%' AND ";
            }

            if ($_GET["primer_nombre"] != "") {
                $a1 = $a1 . " usuario.primer_nombre LIKE '%" . $_GET["primer_nombre"] . "%' AND ";
            }

            if ($_GET["primer_apellido"] != "") {
                $a1 = $a1 . " usuario.primer_apellido LIKE '%" . $_GET["primer_apellido"] . "%' AND ";
            }
            
            $sql = "SELECT usuario.* FROM usuario WHERE $a1 usuario.activo = '1'                                                        ;";

            $arrayAcudientes = $Matricula->listMatriculaSql($sql);

            ?>
            <div class="box-header with-border">
                <h3 class="box-title">Resultado de la busqueda de acudientes</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Numero de Documento</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Telefono - Celular</th>
                            <th>Ubicacion</th>
                            <th>Asignar</th>
                        </tr>
                        <?php
                        foreach ($arrayAcudientes as $clave => $item) {
                            ?>
                            <tr>
                                <td><?php echo $item['numero_documento']; ?></td>
                                <td><?php echo $item['primer_nombre'] . " " . $item['segundo_nombre']; ?></td>
                                <td><?php echo $item['primer_apellido'] . " " . $item['segundo_apellido']; ?></td>
                                <td><?php echo $item['telefono'] . " - " . $item['celular']; ?></td>
                                <td><?php echo $item['ubicacion']; ?></td>
                                <td>
                                    <button title="<?php echo $item['id']; ?>" dir="<?php echo $_GET["id"]; ?>" data-toggle="modal" data-target="#asignar_acudiente" class="btn_acudiente btn" type="button"><i class="fa fa-user-plus"></i></button>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>    
                </table>
            </div>
            <?php
        } else {
            ?>
            <div class="box-header with-border">
                <h3 class="box-title">No hay resultados, en la base de datos de acudientes</h3>
            </div>
            <?php
        }
    }

    public function asignarAcudiente() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/DocumentoModel.php";
        require "models/ModuloModel.php";
        require "models/UsuarioModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Matricula = new MatriculaModel();
        $documento = new DocumentoModel();
        $modulo = new ModuloModel();
        $Usuario = new UsuarioModel();

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

        $arrayRegistro = $Matricula->consultMatricula($_GET["id"]);

        if (count($arrayRegistro) > 1) {

            //Pasamos a la vista toda la información que se desea representar
            $vars = array();

            if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
                $Usuario->ejecutaSql("INSERT INTO acudiente(matricula, usuario, parentesco) VALUES ('" . $_GET["id"] . "','" . $_GET["ida"] . "','" . $_GET["p"] . "')");
                $vars['alerta'] = 2;
            } else {
                $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                $vars['alerta'] = 3;
            }

            $vars['estudiante'] = $arrayRegistro["estudiante"];

            $arrayRegistroUsuario = $Matricula->ejecutaSqlArray("SELECT usuario.*,ciudad.nombre as ciudad_nacimiento FROM usuario
                 INNER JOIN ciudad ON usuario.ciudad_nacimiento=ciudad.id   
                WHERE usuario.id = '" . $arrayRegistro["estudiante"] . "'");

            $arrayRegistro["primer_nombre"] = $arrayRegistroUsuario["primer_nombre"];
            $arrayRegistro["segundo_nombre"] = $arrayRegistroUsuario["segundo_nombre"];
            $arrayRegistro["primer_apellido"] = $arrayRegistroUsuario["primer_apellido"];
            $arrayRegistro["segundo_apellido"] = $arrayRegistroUsuario["segundo_apellido"];
            $arrayRegistro["genero"] = $arrayRegistroUsuario["genero"];
            $arrayRegistro["ciudad_nacimiento"] = $arrayRegistroUsuario["ciudad_nacimiento"];
            $arrayRegistro["fecha_nacimiento"] = $arrayRegistroUsuario["fecha_nacimiento"];
            $arrayRegistro["rh"] = $arrayRegistroUsuario["rh"];
            $arrayRegistro["usuario"] = $arrayRegistroUsuario["usuario"];

            $arrayDocumentos = $documento->listDocumento("WHERE matricula='" . $_GET["id"] . "'", "tipo");
            $arrayDocumentosCertificados = $documento->listDocumento("WHERE usuario='" . $arrayRegistro["estudiante"] . "'", "tipo");


            $arrayAcudientes = $Matricula->listMatriculaSql("SELECT usuario.*,acudiente.parentesco FROM acudiente
                                                            INNER JOIN usuario ON usuario.id=acudiente.usuario
                                                            WHERE acudiente.matricula = '" . $arrayRegistro["id"] . "';");

            $vars['anios'] = Resources::anio();
            $vars['arrayRegistro'] = $arrayRegistro;
            $vars['arrayRegistroAcudiente'] = $Usuario->estructuraUsuario();
            $vars['arrayDocumentos'] = $arrayDocumentos;
            $vars['arrayDocumentosCertificados'] = $arrayDocumentosCertificados;
            $vars['arrayAcudientes'] = $arrayAcudientes;
            $vars['arrayPermiso'] = $arrayPermiso;
            $vars['formularioNuevo'] = true;
            $vars['URLROOT'] = $config->get('URLROOT');
            $vars['tituloMetodo'] = "Editar";
            $vars['accion'] = "editar";
            $vars['formXhtml'] = $formXhtml;
            $vars["dataUser"] = $arrayDatosUser;

            $this->view->show($this->url, $vars);
        } else {
            $formXhtml->location("index.php?controlador=Matricula&accion=matricula");
        }
    }

}
?>