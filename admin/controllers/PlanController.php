<?php

class PlanController extends ControllerBase {

    private $url = "plan.php";
    private $modelo = "models/PlanModel.php";
    private $table = "plan_estudio";
    private $id = "id";
    private $pagina = "plan";

    //Accion index
    public function plan() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Plan = new PlanModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del plan logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')],true);
        
        $arrayModulo = $modulo->consultModuloWhere("pagina = '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }

        //determina que consulta fue la que realizo en plan en la busqueda
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
                            {
                                if ( $clave == "curso" )
                                {
                                    $busqueda = $busqueda . " plan_estudio_curso.$clave = '" . $valor . "' AND";
                                }
                                else
                                {
                                    $busqueda = $busqueda . " $this->table.$clave = '" . $valor . "' AND";
                                }                                
                            }
                        }
                    }
                }
                if ($eliminaCaracter)
                    $busqueda = " where " . substr($busqueda, 0, strlen($busqueda) - 3);
            }
        }
        else {
            $arrayRegistro = $Plan->estructuraPlan();
        }

        
        //Pasamos a la vista toda la información que se desea representar        
        $vars = array();
        if ($_GET["id"]) {
            if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
                if ($_GET["a"]) {
                    $array = array("id"=>$_GET["id"],"activo"=>"1");                   
                    $Plan->modPlan($array);
                }
                else
                {
                    $array = array("id"=>$_GET["id"],"activo"=>"0");                   
                    $Plan->modPlan($array);
                }
            } else {
                $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                $vars['alerta'] = 3;
            }
        }
        
        //Consulta sql del modulo
        $sql = "SELECT 
                $this->table.id,
                $this->table.anio,    
                $this->table.activo,    
                $this->table.periodo,    
                asignatura.nombre AS asignatura,
                CONCAT(usuario_crear.primer_nombre, ' ', usuario_crear.segundo_nombre, ' ', usuario_crear.primer_apellido, ' ', usuario_crear.segundo_apellido) AS usuario_crear,
                CONCAT(usuario_editar.primer_nombre, ' ', usuario_editar.segundo_nombre, ' ', usuario_editar.primer_apellido, ' ', usuario_editar.segundo_apellido) AS usuario_editar,
                GROUP_CONCAT(curso.nombre) AS curso
                FROM $this->table
                LEFT JOIN asignatura ON asignatura.id=$this->table.asignatura                
                INNER JOIN usuario AS usuario_crear ON $this->table.usuario_crear=usuario_crear.id
                LEFT JOIN usuario AS usuario_editar ON $this->table.usuario_editar=usuario_editar.id
                LEFT JOIN plan_estudio_curso ON plan_estudio_curso.plan_estudio=$this->table.id
                LEFT JOIN curso ON curso.id=plan_estudio_curso.curso
                ";
        //Se une los sql con las posibles concatenaciones
        $sql = $sql . $busqueda . "GROUP BY 1,2,3,4,5,6,7 ORDER BY $this->table.anio, asignatura.nombre";

        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();

        //Cramos el paginador
        $paginador = new PHPPaging($modulo->thisdb());
        $paginador->param = "&controlador=Plan&accion=plan".$parametros_busqueda;
        $paginador->rowCount($sql);
        $paginador->config(3, 50);
        
        $sql = $sql." LIMIT $paginador->start_row, $paginador->max_rows";
        
        $consulta = $modulo->listarPaginador($sql);        
        $arrayPaginador = array();        
        while( $registro = $consulta->fetch(PDO::FETCH_ASSOC) )
        {
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
        
        $vars['anios'] = Resources::anio();
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
        $Plan = new PlanModel();
        $modulo = new ModuloModel();
        
        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del plan logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')],true);

        $arrayModulo = $modulo->consultModuloWhere("pagina= '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }
        
        $arrayRegistro = $Plan->estructuraPlan();

        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();

        if ($arrayRegistro["anio"] == "") {
            $arrayRegistro["anio"] = date('Y');
        }
        
        //Pasamos a la vista toda la información que se desea representar
        $vars = array();
        $vars['anios'] = Resources::anio();
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
        $Plan = new PlanModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del plan logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')],true);

        $arrayModulo = $modulo->consultModuloWhere("pagina= '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }
        
        //Creamos el array para el formulario del plan
        $arrayRegistro = $_POST;
        
        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();
        
        if ($arrayRegistro["anio"] == "") {
            $arrayRegistro["anio"] = date('Y');
        }
        
        //Pasamos a la vista toda la información que se desea representar
        $vars = array();
        
        if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
            $_POST["fecha_crear"] = date("Y-m-d H:i:s");
            $_POST["usuario_crear"] = $arrayDatosUser["id"];        
            $id = $Plan->newPlan($_POST);
            $arrayRegistro = $Plan->consultPlan($id);
            $vars['alerta'] = 1;
            $vars['accion'] = "editar";
            
            $Plan->ejecutaSql("DELETE FROM `plan_estudio_curso` WHERE `plan_estudio`='" . $arrayRegistro["id"] . "'");

            foreach ($_POST["arrayCheckBuscadorcurso"] as $clave => $valor) {
                $Plan->ejecutaSql("INSERT INTO `plan_estudio_curso`(`curso`, `plan_estudio`) VALUES ('" . $valor . "','" . $arrayRegistro["id"] . "')");
            }
            
        } else {
            $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
            $vars['alerta'] = 3;
            $vars['accion'] = "listar";
        }
        
        $sql = "SELECT 
                        up.*    
                    FROM
                        plan_estudio_curso AS up 
                    WHERE
                        up.plan_estudio='" . $arrayRegistro["id"] . "'";

        $arrayCursos = $Plan->listArraySql($sql, "curso", true);
        
        
        $vars['anios'] = Resources::anio();       
        $vars['accion'] = "editar";        
        $vars['arrayRegistro'] = $arrayRegistro;
        $vars['arrayPermiso'] = $arrayPermiso;
        $vars['arrayCursos'] = $arrayCursos;
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
        require "models/MetaModel.php";
        
        //Creamos una instancia de nuestro "modelo"
        $Plan = new PlanModel();
        $modulo = new ModuloModel();
        $Meta = new MetaModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del plan logueado
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

        if ($arrayRegistro["anio"] == "") {
            $arrayRegistro["anio"] = date('Y');
        }
        
        //Pasamos a la vista toda la información que se desea representar
        $vars = array();
        
        //Creamos el array para el formulario del plan
        if (isset($_GET["id"]))
            $id=$_GET["id"];
        else
            $id=$_POST["id"];

        if ($Plan->confirmPlan($id)) {            
            $arrayRegistro = $Plan->consultPlan($id);
            if (!isset($_GET["id"]))
            {
                if (in_array("1", $arrayPermiso)==true||in_array("2", $arrayPermiso)==true) {
                    $_POST["fecha_editar"] = date("Y-m-d H:i:s");
                    $_POST["usuario_editar"] = $arrayDatosUser["id"];
                    $Plan->modPlan($_POST);                
                    $arrayRegistro = $Plan->consultPlan($id);
                    $vars['alerta'] = 2;
                    
                    
                    $Plan->ejecutaSql("DELETE FROM `plan_estudio_curso` WHERE `plan_estudio`='" . $arrayRegistro["id"] . "'");

                    foreach ($_POST["arrayCheckBuscadorcurso"] as $clave => $valor) {
                        $Plan->ejecutaSql("INSERT INTO `plan_estudio_curso`(`curso`, `plan_estudio`) VALUES ('" . $valor . "','" . $arrayRegistro["id"] . "')");
                    }
                    
                }
                else
                {
                    $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                    $vars['alerta'] = 3;
                }
            }
             
            $arrayMetas = $Meta->listMeta("WHERE plan_estudio='" . $arrayRegistro["id"] . "'", "id");
            
            $sql = "SELECT 
                        up.*    
                    FROM
                        plan_estudio_curso AS up 
                    WHERE
                        up.plan_estudio='" . $arrayRegistro["id"] . "'";

            $arrayCursos = $Meta->listArraySql($sql, "curso", true);
            
            $vars['arrayMetas'] = $arrayMetas;
            $vars['anios'] = Resources::anio();
            $vars['arrayRegistro'] = $arrayRegistro;
            $vars['arrayCursos'] = $arrayCursos;
            $vars['arrayPermiso'] = $arrayPermiso;
            $vars['URLROOT'] = $config->get('URLROOT');
            $vars['formularioNuevo'] = true;
            $vars['tituloMetodo'] = "Editar";        
            $vars['accion'] = "editar";        
            $vars['formXhtml'] = $formXhtml;
            $vars["dataUser"] = $arrayDatosUser;
            $this->view->show($this->url, $vars);
        } else {
            $formXhtml->location("index.php?controlador=Plan&accion=plan");
        }
        
    }
    
    public function nuevoMeta() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/MetaModel.php";
        require "models/ModuloModel.php";
        
        //Creamos una instancia de nuestro "modelo"
        $Plan = new PlanModel();
        $Meta = new MetaModel();
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

        $arrayRegistro = $Plan->consultPlan($_GET["id"]);

        if (count($arrayRegistro) > 1) {

            //Pasamos a la vista toda la información que se desea representar
            $vars = array();

            if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
                $_POST["fecha_crear"] = date("Y-m-d H:i:s");
                $_POST["usuario_crear"] = $arrayDatosUser["id"];                    
                $_POST['plan_estudio'] = $arrayRegistro["id"];
                $_POST['activo'] = 1;
                $Meta->newMeta($_POST);

                $vars['alerta'] = 1;
            } else {
                $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                $vars['alerta'] = 3;
            }

            $arrayMetas = $Meta->listMeta("WHERE plan_estudio='" . $arrayRegistro["id"] . "'", "id");
            
            $sql = "SELECT 
                        up.*    
                    FROM
                        plan_estudio_curso AS up 
                    WHERE
                        up.plan_estudio='" . $arrayRegistro["id"] . "'";

            $arrayCursos = $Meta->listArraySql($sql, "curso", true);
            
            $vars['anios'] = Resources::anio();
            $vars['arrayRegistro'] = $arrayRegistro;
            $vars['arrayMetas'] = $arrayMetas;
            $vars['accion'] = "editar";
            $vars['arrayPermiso'] = $arrayPermiso;
            $vars['arrayCursos'] = $arrayCursos;
            $vars['formularioNuevo'] = true;
            $vars['tituloMetodo'] = "Editar";
            $vars['formXhtml'] = $formXhtml;
            $vars["dataUser"] = $arrayDatosUser;

            $this->view->show($this->url, $vars);
        } else {
            $formXhtml->location("index.php?controlador=Plan&accion=plan");
        }
    }

    public function desactivarMeta() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/MetaModel.php";
        require "models/ModuloModel.php";
        require "models/UsuarioModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Plan = new PlanModel();
        $Meta = new MetaModel();
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

        $arrayRegistro = $Plan->consultPlan($_GET["id"]);

        if (count($arrayRegistro) > 1) {

            //Pasamos a la vista toda la información que se desea representar
            $vars = array();

            $arrayRegistroMeta = $Meta->consultMeta($_GET["idd"]);

            if (count($arrayRegistroMeta) > 1) {

                if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
                    $array = array("id" => $_GET["idd"], "activo" => "0");
                    $Meta->modMeta($array);
                    $vars['alerta'] = 2;
                } else {
                    $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                    $vars['alerta'] = 3;
                }

                $arrayMetas = $Meta->listMeta("WHERE plan_estudio='" . $_GET["id"] . "'", "id");
                
                
                $sql = "SELECT 
                                        up.*    
                                    FROM
                                        plan_estudio_curso AS up 
                                    WHERE
                                        up.plan_estudio='" . $arrayRegistro["id"] . "'";

                $arrayCursos = $Meta->listArraySql($sql, "curso", true);
                
                $vars['anios'] = Resources::anio();
                $vars['arrayRegistro'] = $arrayRegistro;
                $vars['arrayRegistroAcudiente'] = $Usuario->estructuraUsuario();
                $vars['arrayMetas'] = $arrayMetas;
                $vars['arrayCursos'] = $arrayCursos;
                $vars['arrayPermiso'] = $arrayPermiso;
                $vars['formularioNuevo'] = true;
                $vars['tituloMetodo'] = "Editar";
                $vars['accion'] = "editar";
                $vars['formXhtml'] = $formXhtml;
                $vars["dataUser"] = $arrayDatosUser;

                $this->view->show($this->url, $vars);
            } else {
                $formXhtml->location("index.php?controlador=Plan&accion=plan");
            }
        } else {
            $formXhtml->location("index.php?controlador=Plan&accion=plan");
        }
    }
    
    public function activarMeta() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/MetaModel.php";
        require "models/ModuloModel.php";
        require "models/UsuarioModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Plan = new PlanModel();
        $Meta = new MetaModel();
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

        $arrayRegistro = $Plan->consultPlan($_GET["id"]);

        if (count($arrayRegistro) > 1) {

            //Pasamos a la vista toda la información que se desea representar
            $vars = array();

            $arrayRegistroMeta = $Meta->consultMeta($_GET["idd"]);
            if (count($arrayRegistroMeta) > 1) {

                if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
                    $array = array("id" => $_GET["idd"], "activo" => "1");

                    $Meta->modMeta($array);

                    $vars['alerta'] = 2;
                } else {
                    $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                    $vars['alerta'] = 3;
                }

                $arrayMetas = $Meta->listMeta("WHERE plan_estudio='" . $_GET["id"] . "'", "id");
                
                $sql = "SELECT 
                        up.*    
                    FROM
                        plan_estudio_curso AS up 
                    WHERE
                        up.plan_estudio='" . $arrayRegistro["id"] . "'";

                $arrayCursos = $Meta->listArraySql($sql, "curso", true);
                
                $vars['anios'] = Resources::anio();
                $vars['arrayRegistro'] = $arrayRegistro;
                $vars['arrayMetas'] = $arrayMetas;
                $vars['arrayPermiso'] = $arrayPermiso;
                $vars['arrayCursos'] = $arrayCursos;
                $vars['formularioNuevo'] = true;
                $vars['tituloMetodo'] = "Editar";
                $vars['accion'] = "editar";
                $vars['formXhtml'] = $formXhtml;
                $vars["dataUser"] = $arrayDatosUser;

                $this->view->show($this->url, $vars);
            } else {
                $formXhtml->location("index.php?controlador=Plan&accion=plan");
            }
        } else {
            $formXhtml->location("index.php?controlador=Plan&accion=plan");
        }
    }
    
}

?>