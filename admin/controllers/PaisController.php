<?php

class PaisController extends ControllerBase {

    private $url = "pais.php";
    private $modelo = "models/PaisModel.php";
    private $table = "pais";
    private $id = "id";

    //Accion index
    public function pais() {
        //Incluye el modelo que corresponde
        require $this->modelo;

        //Creamos una instancia de nuestro "modelo"
        $Pais = new PaisModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del usuario logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')]);

        //determina que consulta fue la que realizo en usuario en la busqueda
        $busqueda = "";
        if ($_GET) {
            $arrayRegistro = $_GET;
            $arrayRegistro[$this->id] = "";
            if ($_GET["busqueda"]) {
                unset($_GET["busqueda"]);
                $eliminaCaracter = false;
                foreach ($_GET as $clave => $valor) {
                    if (($clave != "busqueda" ) && ($clave != "controlador" ) && ($clave != "accion" ) && ($clave != "page" )) {
                        if ($valor) {
                            $eliminaCaracter = true;
                            if (( $clave == "nombre"))
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
            $arrayRegistro = $Pais->estructuraPais();
        }

        //Consulta sql del modulo
        $sql = "SELECT $this->table.id,
                     $this->table.nombre ,
                     $this->table.activo
             FROM $this->table
            ";

        //Se une los sql con las posibles concatenaciones
        $sql = $sql . $busqueda . " ORDER BY $this->table.$this->id DESC";

        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();

        //Cramos el paginador
        $paginador = new PHPPaging;
        $paginador->agregarConsulta($sql);
        //Poniendo 10 resultados por pagina
        $paginador->porPagina(10);

        $arrayVariables[] = "controlador";
        $arrayVariables[] = "accion";
        $arrayVariables[] = "page";
        $arrayVariables[] = "nombre";
        $arrayVariables[] = "activo";
        $arrayVariables[] = "busqueda";

        $paginador->mantenerURLVar = $arrayVariables;

        //Cambiando el texto de la referencia a la pagina actual
        $paginador->mostrarActual("<span class=\"current\">{n}</span>");
        //Ejecutamos la paginaci�n
        $paginador->ejecutar();



        //Pasamos a la vista toda la informaci�n que se desea representar
        $vars = array();
        $vars['paginador'] = $paginador;
        $vars['arrayRegistro'] = $arrayRegistro;
        $vars['formularioNuevo'] = false;
        $vars['formXhtml'] = $formXhtml;
        $vars["arrayDatosUser"] = $arrayDatosUser;

        $this->view->show($this->url, $vars);
    }

    public function buscarPais() {
        header('Content-Type: text/html; charset=ISO-8859-1');
        //Incluye el modelo que corresponde
        require $this->modelo;
        //Creamos una instancia de nuestro "modelo"
        $Pais = new PaisModel();
        
        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del usuario logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')]);
        
        $sql = "SELECT 
                    p.*, 
                    up.usuario    
                FROM
                    pais AS p
                        LEFT JOIN
                    usuario_pais AS up ON up.pais = p.id AND up.usuario='".$_POST["usuario"]."'
                WHERE
                    p.activo = 1 AND p.nombre LIKE '%".utf8_decode($_POST["cadena"])."%'";
        
        $arrayPaises = $Pais->listArraySql( $sql , "id");

        foreach ($arrayPaises as $clave => $valor) {

            $checked = '';
            if ($valor["usuario"]!=null||$valor["usuario"]!="")
                    $checked = 'checked="checked"';
            ?>
            <div class="divItemCheck">
                <input <?php echo $checked; ?> onclick="checkBuscadorPais(this)" type="checkbox" name="arrayCheckBuscador<?php echo $this->table; ?>[]" value="<?php echo $valor[$this->idTable]; ?>"/> <?php echo $valor["nombre"]; ?>
            </div>            
            <?php
        }
        ?>
        <div style="clear: both"></div>             
        <?php
    }

    //Accion index
    public function nuevo() {
        //Incluye el modelo que corresponde
        require $this->modelo;

        //Creamos una instancia de nuestro "modelo"
        $Pais = new PaisModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del usuario logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')]);

        $arrayRegistro = $Pais->estructuraPais();

        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();

        //Pasamos a la vista toda la informaci�n que se desea representar
        $vars = array();
        $vars['arrayRegistro'] = $arrayRegistro;
        $vars['formularioNuevo'] = true;
        $vars['tituloMetodo'] = "Nuevo";
        $vars['accion'] = "nuevo";
        $vars['formXhtml'] = $formXhtml;
        $vars["arrayDatosUser"] = $arrayDatosUser;

        $this->view->show($this->url, $vars);
    }

    public function nuevoRegistro() {
        //Incluye el modelo que corresponde
        require $this->modelo;

        //Creamos una instancia de nuestro "modelo"
        $Pais = new PaisModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del usuario logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')]);

        $arrayRegistro = $Pais->estructuraPais();

        //creamos el usuario en el sistema
        $id = $Pais->newPais($_POST);

        //Creamos el array para el formulario del usuario
        $arrayRegistro = $Pais->consultPais($id);

        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();

        //Pasamos a la vista toda la informaci�n que se desea representar
        $vars = array();
        $vars['arrayRegistro'] = $arrayRegistro;
        $vars['formularioNuevo'] = true;
        $vars['tituloMetodo'] = "Editar";
        $vars['alerta'] = 1;
        $vars['accion'] = "editar";
        $vars['formXhtml'] = $formXhtml;
        $vars["arrayDatosUser"] = $arrayDatosUser;

        $this->view->show($this->url, $vars);
    }
    
    public function nuevoPaisUsuario() {
        //Incluye el modelo que corresponde
        require $this->modelo;

        //Creamos una instancia de nuestro "modelo"
        $Pais = new PaisModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del usuario logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')]);

        $Pais->ejecutaSql("INSERT INTO `usuario_pais`(`pais`, `usuario`) VALUES ('".$_POST["pais"]."','".$_POST["usuario"]."')");

    }
    
    public function delEntidadTipoServicio() {
        //Incluye el modelo que corresponde
        require $this->modelo;

        //Creamos una instancia de nuestro "modelo"
        $Pais = new PaisModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del usuario logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')]);

        $Pais->ejecutaSql("DELETE FROM `bono` WHERE `pais`='".$_POST["pais"]."' AND `usuario`='".$_POST["usuario"]."'");

    }

    public function editarRegistro() {
        //Incluye el modelo que corresponde
        require $this->modelo;

        //Creamos una instancia de nuestro "modelo"
        $Pais = new PaisModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos todos los datos del usuario logueado
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')]);

        $arrayRegistro = $Pais->estructuraPais();

        //creamos el objeto para el generador de etiquetas
        $formXhtml = new Xhtml();

        if ($_FILES["foto"]["name"] != null) {
            $_POST['foto'] = $formXhtml->unloadfile($_FILES["foto"], $config->get('USUARIOS_DIR'));
        }

        //creamos el usuario en el sistema
        $id = $Pais->modPais($_POST);

        //Creamos el array para el formulario del usuario
        if (isset($_GET["id"]))
            $arrayRegistro = $Pais->consultPais($_GET["id"]);
        else
            $arrayRegistro = $Pais->consultPais($id);



        //Pasamos a la vista toda la informaci�n que se desea representar
        $vars = array();
        $vars['arrayRegistro'] = $arrayRegistro;
        $vars['formularioNuevo'] = true;
        $vars['tituloMetodo'] = "Editar";
        if (!isset($_GET["id"]))
            $vars['alerta'] = 2;
        $vars['accion'] = "editar";
        $vars['formXhtml'] = $formXhtml;
        $vars["arrayDatosUser"] = $arrayDatosUser;

        $this->view->show($this->url, $vars);
    }

}
?>