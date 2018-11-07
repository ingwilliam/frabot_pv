<?php

class PensionController extends ControllerBase {

    private $url = "pension.php";
    private $modelo = "models/PensionModel.php";
    private $id = "id";
    private $pagina = "pension";

    //Accion index
    public function index() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Pension = new PensionModel();
        $modulo = new ModuloModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del grado logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')],true);
        
        $arrayModulo = $modulo->consultModuloWhere("pagina = '" . $this->pagina . "'");

        $arrayPermiso = array();
        foreach ($arrayDatosUser["usuario_perfil"] as $clave => $valor) {
            if ($valor["usuario"] == $arrayDatosUser["id"] && $valor["modulo"] == $arrayModulo["id"]) {
                $arrayPermiso[] = $valor["permiso"];
            }
        }

        if ($_GET["anio"] == "") {
            $_GET["anio"] = date('Y');
            $_GET["busqueda"] = "1";
        }
        
        //determina que consulta fue la que realizo en grado en la busqueda
        $parametros_busqueda="&busqueda=".$_GET["busqueda"];
        $busqueda = "";
        if ($_GET) {
            $arrayRegistro = $_GET;
            $arrayRegistro[$this->id] = "";
            if ($_GET["busqueda"]) {
                unset($_GET["busqueda"]);
                $eliminaCaracter = false;
                foreach ($_GET as $clave => $valor) {
                    if (($clave != "busqueda" ) && ($clave != "controlador" ) && ($clave != "accion" ) && ($clave != "page" )&& ($clave != "max" )&& ($clave != "item" )&& ($clave != "alerta" )) {
                        if ($valor) {
                            $eliminaCaracter = true;
                            if ( $clave == "nombre" )
                                $busqueda = $busqueda . " matricula.$clave LIKE '%" . $valor . "%' AND";
                            else
                                $busqueda = $busqueda . " matricula.$clave = '" . $valor . "' AND";
                        }
                    }
                }
                if ($eliminaCaracter)
                    $busqueda = " where " . substr($busqueda, 0, strlen($busqueda) - 3)." AND estado = 'Matriculado'";
            }
        }
        else {
            $arrayRegistro = $Pension->estructuraPension();
        }

        if(isset($_GET["curso"])&&$_GET["curso"]!="")
        {
        //Consulta sql del modulo
        $sql = "SELECT
                    matricula.id,
                    matricula.fecha_crear,
                    matricula.anio,
                    matricula.numero_documento ,
                    matricula.activo ,
                    matricula.estado ,
                    matricula.valor_pension ,
                    curso.nombre as curso,
                    usuario.primer_nombre ,
                    usuario.segundo_nombre ,
                    usuario.primer_apellido ,                                          
                    usuario.segundo_apellido,
                    usuario.fecha_nacimiento,
                    tipo_documento.nombre as tipo_documento,
                    CONCAT(usuario_crear.primer_nombre, ' ', usuario_crear.segundo_nombre, ' ', usuario_crear.primer_apellido, ' ', usuario_crear.segundo_apellido) AS usuario_crear
                FROM 
                    matricula
                INNER JOIN usuario ON matricula.estudiante=usuario.id
                INNER JOIN curso ON matricula.curso=curso.id
                LEFT JOIN tipo_documento ON matricula.tipo_documento=tipo_documento.id
                INNER JOIN usuario AS usuario_crear ON matricula.usuario_crear=usuario_crear.id
                ";
        //Se une los sql con las posibles concatenaciones
        $sql = $sql . $busqueda . " ORDER BY usuario.primer_apellido ASC,usuario.primer_nombre ASC";
                
        $arrayPaginador=$Pension->listArraySql($sql, "id",true);
        }
        
        $formXhtml = new Xhtml();
        $vars['anios'] = Resources::anio();
        $vars['arrayPaginador'] = $arrayPaginador;
        $vars['arrayRegistro'] = $arrayRegistro;
        $vars['arrayPermiso'] = $arrayPermiso;
        $vars['formularioNuevo'] = false;
        $vars['formXhtml'] = $formXhtml;
        $vars["dataUser"] = $arrayDatosUser;
        $vars["pension"] = $Pension;

        $this->view->show("pension.php", $vars);
    }    
    
    public function guardar() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Pension = new PensionModel();
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
        
        if (in_array("1", $arrayPermiso) == true || in_array("2", $arrayPermiso) == true) {
           
            
            $pension_actual = $Pension->consultPensionWhere("mes=".$_POST["mes"]." AND matricula = ".$_POST['matricula']."");
            
            if(isset($pension_actual["id"]))                
            {
                $pension_actual["estado"]=$_POST["estado"];
                if($_POST["observaciones"]!="")
                {
                $pension_actual["observaciones"]=$pension_actual["observaciones"]."<br/>(".date("Y-m-d H:i:s").") ".$arrayDatosUser["primer_nombre"]." ".$arrayDatosUser["segundo_nombre"]." ".$arrayDatosUser["primer_apellido"]." ".$arrayDatosUser["segundo_apellido"].": ".$_POST["observaciones"];
                }
                $Pension->modPension($pension_actual);
            }
            else
            {
                $_POST["fecha_registro"] = date("Y-m-d H:i:s");
                if($_POST["observaciones"]!="")
                {
                    $_POST["observaciones"] = "(".date("Y-m-d H:i:s").") ".$arrayDatosUser["primer_nombre"]." ".$arrayDatosUser["segundo_nombre"]." ".$arrayDatosUser["primer_apellido"]." ".$arrayDatosUser["segundo_apellido"].": ".$_POST["observaciones"];
                }
                $Pension->newPension($_POST);
            }            
                        
        }
        
        $formXhtml = new Xhtml();
        
        $formXhtml->location("index.php?controlador=Pension&accion=index&busqueda=1&anio=".$_POST["anio"]."&curso=".$_POST["curso"]."&alerta=1");
        exit;
        
    }
    
    public function exportarMorosos(){
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Pension = new PensionModel();
        $modulo = new ModuloModel();

        if(isset($_GET["curso"])&&$_GET["curso"]!="")
        {
        //Consulta sql del modulo
        $sql = "SELECT
                    matricula.id,
                    matricula.fecha_crear,
                    matricula.anio,
                    matricula.numero_documento ,
                    matricula.activo ,
                    matricula.estado ,
                    matricula.valor_pension ,
                    curso.nombre as curso,
                    usuario.primer_nombre ,
                    usuario.segundo_nombre ,
                    usuario.primer_apellido ,                                          
                    usuario.segundo_apellido,
                    usuario.fecha_nacimiento,
                    tipo_documento.nombre as tipo_documento,
                    CONCAT(usuario_crear.primer_nombre, ' ', usuario_crear.segundo_nombre, ' ', usuario_crear.primer_apellido, ' ', usuario_crear.segundo_apellido) AS usuario_crear
                FROM 
                    matricula
                INNER JOIN usuario ON matricula.estudiante=usuario.id
                INNER JOIN curso ON matricula.curso=curso.id
                LEFT JOIN tipo_documento ON matricula.tipo_documento=tipo_documento.id
                INNER JOIN usuario AS usuario_crear ON matricula.usuario_crear=usuario_crear.id
                ";
        //Se une los sql con las posibles concatenaciones
        $sql = $sql ." WHERE matricula.anio = '".$_GET["anio"]."' AND matricula.curso ='".$_GET["curso"]."' AND estado = 'Matriculado' ORDER BY usuario.primer_apellido ASC,usuario.primer_nombre ASC";
                
        $arrayPaginador=$Pension->listArraySql($sql, "id",true);
        
        
        }
        
        $formXhtml = new Xhtml();
        $vars['anios'] = Resources::anio();
        $vars['arrayPaginador'] = $arrayPaginador;
        $vars['arrayRegistro'] = $arrayRegistro;
        $vars['arrayPermiso'] = $arrayPermiso;
        $vars['formularioNuevo'] = false;
        $vars['formXhtml'] = $formXhtml;
        $vars["dataUser"] = $arrayDatosUser;
        $vars["pension"] = $Pension;

        $this->view->show("pension_moroso.php", $vars);
    }

}

?>