<?php

class ArticuloController extends ControllerBase {

    private $url = "articulo.php";
    private $modelo = "models/ArticuloModel.php";
    private $table = "articulo";
    private $id = "id";
    private $pagina = "articulo";

    //Accion index
    public function articulo() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Articulo = new ArticuloModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del articulo logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        $arrayModulo = $modulo->consultModuloWhere("pagina = '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }

        //determina que consulta fue la que realizo en articulo en la busqueda
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
            $arrayRegistro = $Articulo->estructuraArticulo();
        }


        //Pasamos a la vista toda la información que se desea representar        
        $vars = array();
        if ($_GET["id"]) {
            if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
                if ($_GET["a"]) {
                    $array = array("id" => $_GET["id"], "activo" => "1");
                    $Articulo->modArticulo($array);
                } else {
                    $array = array("id" => $_GET["id"], "activo" => "0");
                    $Articulo->modArticulo($array);
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
        $paginador->param = "&controlador=Articulo&accion=articulo" . $parametros_busqueda;
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
    public function arreglo() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";
        require "models/BannerModel.php";        
        require "models/GaleriaModel.php";        

        $banner = new BannerModel();
        $articulo = new ArticuloModel();
        $galeria = new GaleriaModel();
        
        $config = Config::singleton();
        
//        $arrayBanner = $banner->listArraySql("SELECT * FROM banner", "id", true);
//        
//        echo "<pre>";
//        foreach($arrayBanner as $clave => $valor){
//            
//            $array_banner_modificar = array();
//            $array_banner_modificar["id"]=$valor["id"];
//            if(is_file("dist/img/banner/".$valor["archivo"]))
//            {
//                $punto_uno = strripos($valor["archivo"] , ".");
//                $ext_uno = substr($valor["archivo"], $punto_uno);             
//                $nuevo_nombre_uno = "uno_".$valor["id"]."_".date("YmdHis").$ext_uno;
//                if (!copy("dist/img/banner/".$valor["archivo"], "dist/img/banner/".$nuevo_nombre_uno))
//                {
//                    echo "error_uno_".$valor["id"]."<br/>";
//                }
//                else
//                {
//                    $array_banner_modificar["archivo"]=$nuevo_nombre_uno;
//                }
//                
//            }
//            
//            if(is_file("dist/img/banner/".$valor["archivo2"]))
//            {
//                $punto_dos = strripos($valor["archivo2"] , ".");
//                $ext_dos = substr($valor["archivo2"], $punto_dos);             
//                $nuevo_nombre_dos = "dos_".$valor["id"]."_".date("YmdHis").$ext_dos;
//                if (!copy("dist/img/banner/".$valor["archivo2"], "dist/img/banner/".$nuevo_nombre_dos))
//                {
//                    echo "error_dos_".$valor["id"]."<br/>";
//                }
//                else
//                {
//                    $array_banner_modificar["archivo2"]=$nuevo_nombre_dos;
//                }
//            }
//            
//            $banner->modBanner($array_banner_modificar);
//            
//        }
        
//        $arrayArticulo = $articulo->listArraySql("SELECT * FROM articulo", "id", true);
//        
//        echo "<pre>";
//        foreach($arrayArticulo as $clave => $valor){
//            
//            $array_articulo_modificar = array();
//            $array_articulo_modificar["id"]=$valor["id"];
//            if(is_file("dist/img/articulo/".$valor["archivo"]))
//            {
//                $punto_uno = strripos($valor["archivo"] , ".");
//                $ext_uno = substr($valor["archivo"], $punto_uno);             
//                $nuevo_nombre_uno = "uno_".$valor["id"]."_".date("YmdHis").$ext_uno;
//                if (!copy("dist/img/articulo/".$valor["archivo"], "dist/img/articulo/".$nuevo_nombre_uno))
//                {
//                    echo "error_uno_".$valor["id"]."<br/>";
//                }
//                else
//                {
//                    $array_articulo_modificar["archivo"]=$nuevo_nombre_uno;
//                }
//                
//            }                        
//            
//            $articulo->modArticulo($array_articulo_modificar);
//            
//        }
        

        $arrayGaleria = $galeria->listArraySql("SELECT * FROM galeria", "id", true);
        
        echo "<pre>";
        foreach($arrayGaleria as $clave => $valor){
            
            $array_galeria_modificar = array();
            $array_galeria_modificar["id"]=$valor["id"];
            if(is_file("dist/img/galeria/".$valor["archivo"]))
            {
                $punto_uno = strripos($valor["archivo"] , ".");
                $ext_uno = substr($valor["archivo"], $punto_uno);             
                $nuevo_nombre_uno = "uno_".$valor["id"]."_".date("YmdHis").$ext_uno;
                if (!copy("dist/img/galeria/".$valor["archivo"], "dist/img/galeria/".$nuevo_nombre_uno))
                {
                    echo "error_uno_".$valor["id"]."<br/>";
                }
                else
                {
                    $array_galeria_modificar["archivo"]=$nuevo_nombre_uno;
                }
                
            }                        
            
            $galeria->modGaleria($array_galeria_modificar);
            
        }        
                
        
    }

    //Accion index
    public function nuevo() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Articulo = new ArticuloModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del articulo logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        $arrayModulo = $modulo->consultModuloWhere("pagina= '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }

        $arrayRegistro = $Articulo->estructuraArticulo();

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
        $Articulo = new ArticuloModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del articulo logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        $arrayModulo = $modulo->consultModuloWhere("pagina= '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }

        //Creamos el array para el formulario del articulo
        $arrayRegistro = $_POST;

        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();

        //Pasamos a la vista toda la información que se desea representar
        $vars = array();

        if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
            $_POST["fecha_crear"] = date("Y-m-d H:i:s");
            $_POST["usuario_crear"] = $arrayDatosUser["id"];
            if ($_FILES["archivo"]["name"] != null) {
                $_POST['archivo'] = $formXhtml->unloadfile($_FILES["archivo"], $config->get('ARTICULO_DIR'),"articulo");
            }
            $id = $Articulo->newArticulo($_POST);
            $arrayRegistro = $Articulo->consultArticulo($id);
            $vars['alerta'] = 1;
            $vars['accion'] = "editar";
        } else {
            $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
            $vars['alerta'] = 3;
            $vars['accion'] = "listar";
        }

        $sql = "SELECT 
                        up.*    
                    FROM
                        articulo_seccion AS up 
                    WHERE
                        up.articulo='" . $arrayRegistro["id"] . "'";

        $arraySecciones = $Articulo->listArraySql($sql, "seccion", true);
        
        $vars['accionDocumento'] = "nuevo";
        $vars['arrayRegistro'] = $arrayRegistro;
        $vars['arraySecciones'] = $arraySecciones;
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
        $Articulo = new ArticuloModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del articulo logueado
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

        //Creamos el array para el formulario del articulo
        if (isset($_GET["id"]))
            $id = $_GET["id"];
        else
            $id = $_POST["id"];

        if ($Articulo->confirmArticulo($id)) {
            $arrayRegistro = $Articulo->consultArticulo($id);
            if (!isset($_GET["id"])) {
                if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
                    $_POST["fecha_editar"] = date("Y-m-d H:i:s");
                    $_POST["usuario_editar"] = $arrayDatosUser["id"];
                    if ($_FILES["archivo"]["name"] != null) {
                        $_POST['archivo'] = $formXhtml->unloadfile($_FILES["archivo"], $config->get('ARTICULO_DIR'),"articulo");
                    }
                    $Articulo->modArticulo($_POST);
                    $arrayRegistro = $Articulo->consultArticulo($id);
                    $vars['alerta'] = 2;
                } else {
                    $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                    $vars['alerta'] = 3;
                }
            }

            $sql = "SELECT 
                        up.*    
                    FROM
                        articulo_seccion AS up 
                    WHERE
                        up.articulo='" . $arrayRegistro["id"] . "'";

            $arraySecciones = $Articulo->listArraySql($sql, "seccion", true);

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
            $formXhtml->location("index.php?controlador=Articulo&accion=articulo");
        }
    }

    public function nuevoSeccion() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Articulo = new ArticuloModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del articulo logueado
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

        //Creamos el array para el formulario del articulo
        if (isset($_GET["id"]))
            $id = $_GET["id"];
        else
            $id = $_POST["id"];


        if ($Articulo->confirmArticulo($id)) {
            $arrayRegistro = $Articulo->consultArticulo($id);
            if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
                $Articulo->ejecutaSql("DELETE FROM `articulo_seccion` WHERE `articulo`='" . $arrayRegistro["id"] . "'");

                foreach ($_POST["arrayCheckBuscadorseccion"] as $clave => $valor) {
                    $Articulo->ejecutaSql("INSERT INTO `articulo_seccion`(`seccion`, `articulo`) VALUES ('" . $valor . "','" . $arrayRegistro["id"] . "')");
                }

                $vars['alerta'] = 1;
            } else {
                $vars['error'] = "No tienen permisos para ingresar ingresar información, Comunicarse con el administrador del sistema";
                $vars['alerta'] = 3;
            }

            $sql = "SELECT 
                        up.*    
                    FROM
                        articulo_seccion AS up 
                    WHERE
                        up.articulo='" . $arrayRegistro["id"] . "'";

            $arraySecciones = $Articulo->listArraySql($sql, "seccion", true);

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
            $formXhtml->location("index.php?controlador=Articulo&accion=articulo");
        }
    }

}

?>