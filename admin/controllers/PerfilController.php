<?php

class PerfilController extends ControllerBase {

    private $url = "perfil.php";
    private $modelo = "models/PerfilModel.php";
    private $table = "perfil";
    private $id = "id";
    private $pagina = "perfil";

    public function buscarPerfil() {
        header('Content-Type: text/html; charset=ISO-8859-1');
        //Incluye el modelo que corresponde
        require $this->modelo;
        //Creamos una instancia de nuestro "modelo"
        $Perfil = new PerfilModel();
        
        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del usuario logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')],true);
        
        $sql = "SELECT 
                    p.*, 
                    up.usuario    
                FROM
                    perfil AS p
                        LEFT JOIN
                    usuario_perfil AS up ON up.perfil = p.id AND up.usuario='".$_POST["usuario"]."'
                WHERE
                    p.activo = 1 AND p.nombre LIKE '%".utf8_decode($_POST["cadena"])."%'";
        
        $arrayPerfiles = $Perfil->listArraySql( $sql , "id");

        foreach ($arrayPerfiles as $clave => $valor) {

            $checked = '';
            if ($valor["usuario"]!=null||$valor["usuario"]!="")
                    $checked = 'checked="checked"';
            ?>
            <div class="divItemCheck">
                <input <?php echo $checked; ?> type="checkbox" name="arrayCheckBuscador<?php echo $this->table; ?>[]" value="<?php echo $valor[$this->id]; ?>"/> <?php echo $valor["nombre"]; ?>
            </div>            
            <?php
        }
        ?>
        <div style="clear: both"></div>             
        <?php
    }
    
    //Accion index
    public function perfil() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Perfil = new PerfilModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del perfil logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')],true);
        
        $arrayModulo = $modulo->consultModuloWhere("pagina = '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }

        //determina que consulta fue la que realizo en perfil en la busqueda
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
            $arrayRegistro = $Perfil->estructuraPerfil();
        }

        
        //Pasamos a la vista toda la información que se desea representar        
        $vars = array();
        if ($_GET["id"]) {
            if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
                if ($_GET["a"]) {
                    $array = array("id"=>$_GET["id"],"activo"=>"1");                   
                    $Perfil->modPerfil($array);
                }
                else
                {
                    $array = array("id"=>$_GET["id"],"activo"=>"0");                   
                    $Perfil->modPerfil($array);
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
        $paginador->param = "&controlador=Usuario&accion=usuario".$parametros_busqueda;
        $paginador->rowCount($sql);
        $paginador->config(3, 10);
        
        $sql = $sql." LIMIT $paginador->start_row, $paginador->max_rows";
        
        $consulta = $modulo->listarPaginador($sql);        
        $arrayPaginador = array();        
        while( $registro = $consulta->fetch(PDO::FETCH_ASSOC) )
        {
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
        $Perfil = new PerfilModel();
        $modulo = new ModuloModel();
        
        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del perfil logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')],true);

        $arrayModulo = $modulo->consultModuloWhere("pagina= '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }
        
        $arrayRegistro = $Perfil->estructuraPerfil();

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
        $Perfil = new PerfilModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del perfil logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')],true);

        $arrayModulo = $modulo->consultModuloWhere("pagina= '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }
        
        //Creamos el array para el formulario del perfil
        $arrayRegistro = $_POST;
        
        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();
        
        //Pasamos a la vista toda la información que se desea representar
        $vars = array();
               
        if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
            $_POST["fecha_crear"] = date("Y-m-d H:i:s");
            $_POST["usuario_crear"] = $arrayDatosUser["id"];        
            $id = $Perfil->newPerfil($_POST);
            $arrayRegistro = $Perfil->consultPerfil($id);
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
        $Perfil = new PerfilModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del perfil logueado
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
        
        //Creamos el array para el formulario del perfil
        if (isset($_GET["id"]))
            $id=$_GET["id"];
        else
            $id=$_POST["id"];

        if ($Perfil->confirmPerfil($id)) {            
            $arrayRegistro = $Perfil->consultPerfil($id);
            if (!isset($_GET["id"]))
            {
                if (in_array("1", $arrayPermiso)==true||in_array("2", $arrayPermiso)==true) {
                    $_POST["fecha_editar"] = date("Y-m-d H:i:s");
                    $_POST["usuario_editar"] = $arrayDatosUser["id"];
                    $Perfil->modPerfil($_POST);                
                    $arrayRegistro = $Perfil->consultPerfil($id);
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
            $formXhtml->location("index.php?controlador=Perfil&accion=perfil");
        }
        
    }

}

?>