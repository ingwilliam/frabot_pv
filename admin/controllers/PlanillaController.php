<?php

class PlanillaController extends ControllerBase {

    private $url = "planilla.php";
    private $modelo = "models/PlanillaModel.php";
    private $id = "id";
    private $pagina = "planilla";

    //Accion index
    public function planilla_grado() {
        //Incluye el modelo que corresponde
        require $this->modelo;
        require "models/ModuloModel.php";

        //Creamos una instancia de nuestro "modelo"
        $Planilla = new PlanillaModel();
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
                    if (($clave != "busqueda" ) && ($clave != "controlador" ) && ($clave != "accion" ) && ($clave != "page" )&& ($clave != "max" )&& ($clave != "item" )) {
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
            $arrayRegistro = $Planilla->estructuraPlanilla();
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
                
        $arrayPaginador=$Planilla->listArraySql($sql, "id",true);
        }
        
        $formXhtml = new Xhtml();
        $vars['anios'] = Resources::anio();
        $vars['arrayPaginador'] = $arrayPaginador;
        $vars['arrayRegistro'] = $arrayRegistro;
        $vars['arrayPermiso'] = $arrayPermiso;
        $vars['formularioNuevo'] = false;
        $vars['formXhtml'] = $formXhtml;
        $vars["dataUser"] = $arrayDatosUser;

        $this->view->show("grado_planilla.php", $vars);
    }    

}

?>