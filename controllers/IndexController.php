<?php

class IndexController extends ControllerBase {

    public function index() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';

        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos los usuarios logueados
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        $formXhtml = new Xhtml();

        //Pasamos a la vista toda la información que se desea representar 
        $data['config'] = Config::singleton();

        $data['logo'] = $indexModel->arraySql("SELECT * FROM banner WHERE activo = 1 AND ubicacion = 'Logo'");

        $data['informativo'] = $indexModel->arraySql("SELECT * FROM banner WHERE activo = 1 AND ubicacion = 'Informativo'");

        //productos del carrito        
        $data['carrito'] = $indexModel->listArraySql("SELECT carrito.*,articulo.nombre,articulo.precio,articulo.archivo,articulo.marca,articulo.codigo,articulo.precio_publico FROM carrito INNER JOIN articulo ON articulo.id=carrito.articulo WHERE carrito.cotizacion IS NULL AND carrito.usuario = " . $arrayDatosUser["id"] . " ORDER BY fecha_crear");

        $data['total_cotizacion'] = 0;

        foreach ($data['carrito'] as $clave => $valor) {
            $data['total_cotizacion'] = $data['total_cotizacion'] + ($valor["precio"] * $valor["cantidad"]);
        }

        //es el principal
        $data['menu_primero'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion like '%MenuPrimero%' AND padre IS NULL ORDER BY padre , orden");

        //es todas la categorias
        $data['menu_segundo'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion like '%MenuSegundo%' AND padre IS NULL ORDER BY padre , orden");

        //es la animacion
        $data['animacion'] = $indexModel->listArraySql("SELECT * FROM banner WHERE activo = 1 AND ubicacion = 'Animacion' ORDER BY orden");

        //es la derecha
        $data['derecho'] = $indexModel->listArraySql("SELECT * FROM banner WHERE activo = 1 AND ubicacion = 'Derecho' ORDER BY orden LIMIT 2");

        //es el medio
        $data['medio'] = $indexModel->listArraySql("SELECT * FROM banner WHERE activo = 1 AND ubicacion = 'Medio' ORDER BY orden");

        //es el las mejores ofertas
        $data['mejores_ofertas'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion like '%LasMejoresOfertas%' ORDER BY orden");

        $data['pie_pagina'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion like '%PiePagina%' ORDER BY orden");

        $data['indexModel'] = $indexModel;

        $data['menu_primero_categoria'] = 65;

        $data["dataUser"] = $arrayDatosUser;

        $data['formXhtml'] = $formXhtml;
        
        $data['title'] = "";

        $data['keywords'] = "Clubman, Razor, Repuestos, Planchas, Lamparas de uñas";
                
        //Finalmente presentamos nuestra plantilla
        $this->view->show("index.php", $data);
    }

    public function interna() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';

        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos los usuarios logueados
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        //Pasamos a la vista toda la información que se desea representar 
        $data['config'] = Config::singleton();

        $data['logo'] = $indexModel->arraySql("SELECT * FROM banner WHERE activo = 1 AND ubicacion = 'Logo'");

        $data['informativo'] = $indexModel->arraySql("SELECT * FROM banner WHERE activo = 1 AND ubicacion = 'Informativo'");
        
        //productos del carrito        
        $data['carrito'] = $indexModel->listArraySql("SELECT carrito.*,articulo.nombre,articulo.precio,articulo.archivo,articulo.marca,articulo.codigo,articulo.precio_publico FROM carrito INNER JOIN articulo ON articulo.id=carrito.articulo WHERE carrito.cotizacion IS NULL AND carrito.usuario = " . $arrayDatosUser["id"] . " ORDER BY fecha_crear");

        $data['total_cotizacion'] = 0;

        foreach ($data['carrito'] as $clave => $valor) {
            $data['total_cotizacion'] = $data['total_cotizacion'] + ($valor["precio"] * $valor["cantidad"]);
        }

        //es el principal
        $data['menu_primero'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion = 'MenuPrimero' AND padre IS NULL ORDER BY padre , orden");

        //es todas la categorias
        $data['menu_segundo'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion = 'MenuSegundo' AND padre IS NULL ORDER BY padre , orden");

        $data['pie_pagina'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion like '%PiePagina%' ORDER BY orden");

        $data['indexModel'] = $indexModel;

        $formXhtml = new Xhtml();

        $data['seccion'] = $indexModel->arraySql("SELECT * FROM seccion WHERE activo = 1 AND id = '" . $_GET["id"] . "'");

        $data['menu_primero_categoria'] = $data['seccion']["id"];
        
        $data['producto'] = $indexModel->arraySql("SELECT * FROM articulo WHERE activo = 1 AND id = '" . $_GET["idp"] . "'");

        $data['comentarios'] = $indexModel->listArraySql("SELECT c.*,CONCAT(u.primer_nombre,' ',u.segundo_nombre,' ',u.primer_apellido,' ',u.segundo_apellido) as usuario_crear FROM comentario as c INNER JOIN usuario AS u ON u.id=c.usuario_crear WHERE c.activo = 1 AND c.articulo = '" . $_GET["idp"] . "' ORDER BY c.fecha_crear DESC");        
        
        $data['galeria'] = $indexModel->listArraySql("SELECT * FROM galeria WHERE activo = 1 AND articulo = '" . $_GET["idp"] . "' ORDER BY orden");

        $data['formXhtml'] = $formXhtml;

        $data["dataUser"] = $arrayDatosUser;
        
        $data['title'] = " - ".$data['producto']["nombre"];
        
        $data['keywords'] = $data['seccion']["palabras_claves"];

        //Finalmente presentamos nuestra plantilla
        $this->view->show("interna.php", $data);
    }

    public function noticia() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';

        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos los usuarios logueados
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        //Pasamos a la vista toda la información que se desea representar 
        $data['config'] = Config::singleton();

        $data['logo'] = $indexModel->arraySql("SELECT * FROM banner WHERE activo = 1 AND ubicacion = 'Logo'");

        $data['informativo'] = $indexModel->arraySql("SELECT * FROM banner WHERE activo = 1 AND ubicacion = 'Informativo'");

        //productos del carrito        
        $data['carrito'] = $indexModel->listArraySql("SELECT carrito.*,articulo.nombre,articulo.precio,articulo.archivo,articulo.marca,articulo.codigo,articulo.precio_publico FROM carrito INNER JOIN articulo ON articulo.id=carrito.articulo WHERE carrito.cotizacion IS NULL AND carrito.usuario = " . $arrayDatosUser["id"] . " ORDER BY fecha_crear");

        $data['total_cotizacion'] = 0;

        foreach ($data['carrito'] as $clave => $valor) {
            $data['total_cotizacion'] = $data['total_cotizacion'] + ($valor["precio"] * $valor["cantidad"]);
        }

        //es el principal
        $data['menu_primero'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion = 'MenuPrimero' AND padre IS NULL ORDER BY padre , orden");

        //es todas la categorias
        $data['menu_segundo'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion = 'MenuSegundo' AND padre IS NULL ORDER BY padre , orden");

        $data['pie_pagina'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion like '%PiePagina%' ORDER BY orden");

        $data['indexModel'] = $indexModel;

        $data['seccion'] = $indexModel->arraySql("SELECT * FROM seccion WHERE activo = 1 AND id = '" . $_GET["id"] . "'");

        $data['menu_primero_categoria'] = $data['seccion']["id"];
        
        $data['producto'] = $indexModel->arraySql("SELECT * FROM articulo WHERE activo = 1 AND id = '" . $_GET["idp"] . "'");

        $data['otros_producto'] = $indexModel->listArraySql("SELECT * FROM articulo INNER JOIN articulo_seccion ON articulo_seccion.articulo = articulo.id WHERE activo = 1 AND articulo_seccion.seccion = '" . $_GET["id"] . "' ORDER BY orden");

        $data['title'] = " - ".$data['producto']["nombre"];
        
        $data['keywords'] = $data['seccion']["palabras_claves"];
        
        //Finalmente presentamos nuestra plantilla
        $this->view->show("noticia.php", $data);
    }

    public function categoria() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';

        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos los usuarios logueados
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        $formXhtml = new Xhtml();

        //Pasamos a la vista toda la información que se desea representar 
        $data['config'] = Config::singleton();

        $data['logo'] = $indexModel->arraySql("SELECT * FROM banner WHERE activo = 1 AND ubicacion = 'Logo'");

        $data['informativo'] = $indexModel->arraySql("SELECT * FROM banner WHERE activo = 1 AND ubicacion = 'Informativo'");

        //productos del carrito        
        $data['carrito'] = $indexModel->listArraySql("SELECT carrito.*,articulo.nombre,articulo.precio,articulo.archivo,articulo.marca,articulo.codigo,articulo.precio_publico FROM carrito INNER JOIN articulo ON articulo.id=carrito.articulo WHERE carrito.cotizacion IS NULL AND carrito.usuario = " . $arrayDatosUser["id"] . " ORDER BY fecha_crear");

        $data['total_cotizacion'] = 0;

        foreach ($data['carrito'] as $clave => $valor) {
            $data['total_cotizacion'] = $data['total_cotizacion'] + ($valor["precio"] * $valor["cantidad"]);
        }

        //es el principal
        $data['menu_primero'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion = 'MenuPrimero' AND padre IS NULL ORDER BY padre , orden");

        //es todas la categorias
        $data['menu_segundo'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion = 'MenuSegundo' AND padre IS NULL ORDER BY padre , orden");

        $data['pie_pagina'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion like '%PiePagina%' ORDER BY orden");

        $data['indexModel'] = $indexModel;

        $data['seccion'] = $indexModel->arraySql("SELECT * FROM seccion WHERE activo = 1 AND id = '" . $_GET["id"] . "'");
        
        $data['menu_primero_categoria'] = $data['seccion']["id"];

        $data['productos'] = $indexModel->listArraySql("SELECT articulo.*, (SELECT archivo AS archivo_galeria FROM galeria WHERE articulo = articulo.id ORDER BY id LIMIT 1 ) AS archivo_galeria  FROM articulo INNER JOIN articulo_seccion ON articulo_seccion.articulo = articulo.id WHERE activo = 1 AND articulo_seccion.seccion = '" . $_GET["id"] . "'");

        $data['formXhtml'] = $formXhtml;

        $data["dataUser"] = $arrayDatosUser;
        
        $data['title'] = " - ".$data['productos'][1]["nombre"];
        
        $data['keywords'] = $data['seccion']["palabras_claves"];

        //Finalmente presentamos nuestra plantilla
        $this->view->show("categoria.php", $data);
    }

    public function micarrito() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';

        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos los usuarios logueados
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        //Verifico si exite la session
        if(count($arrayDatosUser)<=0)
        {
            header("Location: index.php?controlador=Index&accion=registro&msg=Debe registrarse como cliente, para disfrutar de nuestros productos y poder realizar cotizaciones en linea.");
            exit;
        }
        
        $formXhtml = new Xhtml();

        //Pasamos a la vista toda la información que se desea representar 
        $data['config'] = Config::singleton();

        $data['logo'] = $indexModel->arraySql("SELECT * FROM banner WHERE activo = 1 AND ubicacion = 'Logo'");

        $data['informativo'] = $indexModel->arraySql("SELECT * FROM banner WHERE activo = 1 AND ubicacion = 'Informativo'");

        //productos del carrito        
        $data['carrito'] = $indexModel->listArraySql("SELECT carrito.*,articulo.nombre,articulo.precio,articulo.archivo,articulo.marca,articulo.codigo,articulo.precio_publico FROM carrito INNER JOIN articulo ON articulo.id=carrito.articulo WHERE carrito.cotizacion IS NULL AND carrito.usuario = " . $arrayDatosUser["id"] . " ORDER BY fecha_crear");

        $data['total_cotizacion'] = 0;

        foreach ($data['carrito'] as $clave => $valor) {
            $data['total_cotizacion'] = $data['total_cotizacion'] + ($valor["precio"] * $valor["cantidad"]);
        }

        //es el principal
        $data['menu_primero'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion = 'MenuPrimero' AND padre IS NULL ORDER BY padre , orden");

        //es todas la categorias
        $data['menu_segundo'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion = 'MenuSegundo' AND padre IS NULL ORDER BY padre , orden");

        $data['pie_pagina'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion like '%PiePagina%' ORDER BY orden");

        $data['indexModel'] = $indexModel;

        $data['menu_primero_categoria'] = 1;

        $data['seccion'] = $indexModel->arraySql("SELECT * FROM seccion WHERE activo = 1 AND id = '" . $_GET["id"] . "'");

        $data['productos'] = $indexModel->listArraySql("SELECT * FROM articulo INNER JOIN articulo_seccion ON articulo_seccion.articulo = articulo.id WHERE activo = 1 AND articulo_seccion.seccion = '" . $_GET["id"] . "'");

        $data['formXhtml'] = $formXhtml;

        $data["dataUser"] = $arrayDatosUser;

        if ($_POST["insert"] == 1) {
            
            if(count($data["carrito"])>0)
            {
                //Realizamos la consulta para insertar el cotizacion            
                $_POST["estado"]='Notificado';
                $_POST["cliente"]=$arrayDatosUser["id"];
                $_POST["fecha_envio"]=date("Y-m-d H:i:s");;
                $consulta = $indexModel->thisdb()->insert("cotizacion",$_POST);             
                $indexModel->thisdb()->exec($consulta);        
                $id_cotizacion = $indexModel->thisdb()->lastInsertId();

                //Editamos carrito para colocar los productos en la cotizacion

                $indexModel->ejecutaSql("UPDATE carrito SET cotizacion = " . $id_cotizacion . " WHERE usuario = " . $arrayDatosUser["id"]." AND cotizacion IS NULL");

                //Generamos el pdf
                $url = "http://" . $_SERVER["HTTP_HOST"]."/admin/libs/TCPDF-master/examples/formato_cotizacion.php?cliente=".$arrayDatosUser["id"]."&cotizacion=$id_cotizacion";
                
                $ch = curl_init();
                curl_setopt($ch,CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $pdf_cotizacion = curl_exec($ch);
                curl_close($ch);

                sleep(2);

                //Create a new PHPMailer instance
                $mail = new PHPMailer;
                $mail->CharSet = "UTF-8";
                //Tell PHPMailer to use SMTP
                $mail->isSMTP();
                //Enable SMTP debugging
                // 0 = off (for production use)
                // 1 = client messages
                // 2 = client and server messages
                $mail->SMTPDebug = 0;
                //Set the hostname of the mail server
                $mail->Host = 'p3plcpnl0797.prod.phx3.secureserver.net';
                //Set the SMTP port number - likely to be 25, 465 or 587
                $mail->Port = 587;
                //Whether to use SMTP authentication
                $mail->SMTPAuth = true;
                //Username to use for SMTP authentication
                $mail->Username = 'cotizacion@frabot.co';
                //Password to use for SMTP authentication
                $mail->Password = 'ingwilliam10';
                //Set who the message is to be sent from
                $mail->setFrom('cotizacion@frabot.co', 'FRABOT Cotización en Línea');
                //Set who the message is to be sent to
                $mail->addAddress('francisco.botero@frabot.co', 'Francisco Botero');
                $mail->addBCC('ingeniero.wb@gmail.com', 'Willy');
                //Set the subject line
                $mail->Subject = 'FRABOT Cotización #'.$id_cotizacion.' del Señor(a) '.$arrayDatosUser["primer_nombre"].' '.$arrayDatosUser["segundo_nombre"].' '.$arrayDatosUser["primer_apellido"].' '.$arrayDatosUser["segundo_apellido"];
                //Read an HTML message body from an external file, convert referenced images to embedded,
                //convert HTML into a basic plain-text alternative body
                $mail->msgHTML("<b>Señor Javier Botero.</b><p>Unos de sus clientes esta solicitando una cotización, por favor ver el detalle en el archivo adjunto</p><br/><a href='http://www.frabot.co/'>FRABOT</a>");
                //Replace the plain text body with one created manually
                $mail->AltBody = 'Señor Javier Botero. Unos de sus clientes esta solicitando una cotización, por favor ver el detalle en el archivo adjunto.';
                //Attach an image file
                $mail->addStringAttachment($pdf_cotizacion, "formato_cotizacion.pdf");
                //send the message, check for errors
                if (!$mail->send()) {
                    $data["msg"] = 'El sistema presento el siguiente error '. $mail->ErrorInfo;
                } else {
                    $data["msg2"] = 'La cotización se envió correctamente, FRABOT estará en contacto muy pronto con usted.';
                }
            }
            else
            {
                $data["msg"] = 'El carrito de cotización esta vació, por favor agregar productos al carrito para poder hacer la cotización';
            }  
            
            //productos del carrito        
            $data['carrito'] = $indexModel->listArraySql("SELECT carrito.*,articulo.nombre,articulo.precio,articulo.archivo,articulo.marca,articulo.codigo,articulo.precio_publico FROM carrito INNER JOIN articulo ON articulo.id=carrito.articulo WHERE carrito.cotizacion IS NULL AND carrito.usuario = " . $arrayDatosUser["id"] . " ORDER BY fecha_crear");

            $data['total_cotizacion'] = 0;

            foreach ($data['carrito'] as $clave => $valor) {
                $data['total_cotizacion'] = $data['total_cotizacion'] + ($valor["precio"] * $valor["cantidad"]);
            }
                                   
        }

        $data['title'] = "";

        $data['keywords'] = "Clubman, Razor, Repuestos, Planchas, Lamparas de uñas";
        
        //Finalmente presentamos nuestra plantilla
        $this->view->show("micarrito.php", $data);
    }

    public function buscador() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';

        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos los usuarios logueados
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        $formXhtml = new Xhtml();

        //Pasamos a la vista toda la información que se desea representar 
        $data['config'] = Config::singleton();

        $data['logo'] = $indexModel->arraySql("SELECT * FROM banner WHERE activo = 1 AND ubicacion = 'Logo'");

        $data['informativo'] = $indexModel->arraySql("SELECT * FROM banner WHERE activo = 1 AND ubicacion = 'Informativo'");

        //productos del carrito        
        $data['carrito'] = $indexModel->listArraySql("SELECT carrito.*,articulo.nombre,articulo.precio,articulo.archivo,articulo.marca,articulo.codigo,articulo.precio_publico FROM carrito INNER JOIN articulo ON articulo.id=carrito.articulo WHERE carrito.cotizacion IS NULL AND carrito.usuario = " . $arrayDatosUser["id"] . " ORDER BY fecha_crear");

        $data['total_cotizacion'] = 0;

        foreach ($data['carrito'] as $clave => $valor) {
            $data['total_cotizacion'] = $data['total_cotizacion'] + ($valor["precio"] * $valor["cantidad"]);
        }

        //es el principal
        $data['menu_primero'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion = 'MenuPrimero' AND padre IS NULL ORDER BY padre , orden");

        //es todas la categorias
        $data['menu_segundo'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion = 'MenuSegundo' AND padre IS NULL ORDER BY padre , orden");

        $data['pie_pagina'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion like '%PiePagina%' ORDER BY orden");

        $data['indexModel'] = $indexModel;

        $data['menu_primero_categoria'] = 1;

        $data['productos'] = $indexModel->listArraySql("SELECT articulo.*, (SELECT archivo AS archivo_galeria FROM galeria WHERE articulo = articulo.id ORDER BY id LIMIT 1 ) AS archivo_galeria FROM articulo WHERE activo = 1 AND nombre LIKE '%" . $_GET["search"] . "%' OR descripcion LIKE '%" . $_GET["search"] . "%' OR html LIKE '%" . $_GET["search"] . "%'");

        $data['formXhtml'] = $formXhtml;

        $data["dataUser"] = $arrayDatosUser;
       
        $data['title'] = " - ".$data['productos'][1]["nombre"];
        
        $data['seccion'] = $indexModel->arraySql("SELECT seccion.* FROM articulo_seccion INNER JOIN seccion ON seccion.id=articulo_seccion.seccion WHERE articulo_seccion.articulo= '" . $data['productos'][1]["id"] . "' LIMIT 1");
        
        $data['keywords'] = $data['seccion']["palabras_claves"];
        
        //Finalmente presentamos nuestra plantilla
        $this->view->show("buscador.php", $data);
    }

    public function registro() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';
        require 'admin/models/UsuarioModel.php';

        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();
        $usuario = new UsuarioModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos los usuarios logueados
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        $formXhtml = new Xhtml();

        $arrayRegistro = $usuario->estructuraUsuario();

        //Pasamos a la vista toda la información que se desea representar 
        $data['config'] = Config::singleton();

        $data['logo'] = $indexModel->arraySql("SELECT * FROM banner WHERE activo = 1 AND ubicacion = 'Logo'");

        $data['informativo'] = $indexModel->arraySql("SELECT * FROM banner WHERE activo = 1 AND ubicacion = 'Informativo'");

        //productos del carrito        
        $data['carrito'] = $indexModel->listArraySql("SELECT carrito.*,articulo.nombre,articulo.precio,articulo.archivo,articulo.marca,articulo.codigo,articulo.precio_publico FROM carrito INNER JOIN articulo ON articulo.id=carrito.articulo WHERE carrito.cotizacion IS NULL AND carrito.usuario = " . $arrayDatosUser["id"] . " ORDER BY fecha_crear");

        $data['total_cotizacion'] = 0;

        foreach ($data['carrito'] as $clave => $valor) {
            $data['total_cotizacion'] = $data['total_cotizacion'] + ($valor["precio"] * $valor["cantidad"]);
        }

        //es el principal
        $data['menu_primero'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion = 'MenuPrimero' AND padre IS NULL ORDER BY padre , orden");

        //es todas la categorias
        $data['menu_segundo'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion = 'MenuSegundo' AND padre IS NULL ORDER BY padre , orden");

        $data['pie_pagina'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion like '%PiePagina%' ORDER BY orden");

        $data['indexModel'] = $indexModel;

        $data['menu_primero_categoria'] = 1;

        $data['formXhtml'] = $formXhtml;

        $data["dataUser"] = $arrayDatosUser;

        if (isset($_POST["email"])) {
            $arrayRegistro["usuario"] = $_POST["email"];
        }

        $data['arrayRegistro'] = $arrayRegistro;

        if(isset($_GET["msg"]))
        {
            $data["msg"] = $_GET["msg"];
        }
        
        $data['title'] = "";

        $data['keywords'] = "Clubman, Razor, Repuestos, Planchas, Lamparas de uñas";
        
        if ($_POST["insert"] == 1) {
            $array_usuarios = $usuario->listArraySql("SELECT * FROM usuario WHERE usuario ='" . $_POST["usuario"] . "'", "id");
            if (count($array_usuarios) > 0) {

                $data["msg"] = 'El correo electrónico que intenta registrar ya se encuentra registrado, por favor ingresar otro correo electrónico';
                $this->view->show("registro.php", $data);
            } else {
                $_POST["fecha_crear"] = date("Y-m-d H:i:s");
                $_POST["usuario_crear"] = 1;
                $_POST["activo"] = 1;
                $clave = $_POST["clave"];
                $_POST["clave"] = sha1($_POST["clave"]);
                $id_usuario = $usuario->newUsuario($_POST);
                $usuario->ejecutaSql("INSERT INTO `usuario_perfil`(`perfil`, `usuario`) VALUES ('4','" . $id_usuario . "')");
                
                
                //Create a new PHPMailer instance
                $mail = new PHPMailer;
                $mail->CharSet = "UTF-8";
                //Tell PHPMailer to use SMTP
                $mail->isSMTP();
                //Enable SMTP debugging
                // 0 = off (for production use)
                // 1 = client messages
                // 2 = client and server messages
                $mail->SMTPDebug = 0;
                //Set the hostname of the mail server
                $mail->Host = 'p3plcpnl0797.prod.phx3.secureserver.net';
                //Set the SMTP port number - likely to be 25, 465 or 587
                $mail->Port = 587;
                //Whether to use SMTP authentication
                $mail->SMTPAuth = true;
                //Username to use for SMTP authentication
                $mail->Username = 'cotizacion@frabot.co';
                //Password to use for SMTP authentication
                $mail->Password = 'ingwilliam10';
                //Set who the message is to be sent from
                $mail->setFrom('cotizacion@frabot.co', 'FRABOT Cotización en Línea');
                //Set who the message is to be sent to
                $mail->addAddress($_POST["usuario"], $_POST["primer_nombre"]." ".$_POST["segundo_nombre"]." ".$_POST["primer_apellido"]." ".$_POST["segundo_apellido"]);
                //Set the subject line
                $mail->Subject = 'Felicitaciones, ya tienes usuario de FRABOT';
                //Read an HTML message body from an external file, convert referenced images to embedded,
                //convert HTML into a basic plain-text alternative body
                $mail->msgHTML("<b>Señor(a) ".$_POST["primer_nombre"]." ".$_POST["segundo_nombre"]." ".$_POST["primer_apellido"]." ".$_POST["segundo_apellido"].".</b> Se creo el siguiente usuario:<br/><ul><li>Usuario: ".$_POST["usuario"]."</li><li>Nueva contraseña: ".$clave."</li></ul><br/><center><a href='http://www.frabot.co/'><b>FRABOT</b></a></center><br/>");
                //Replace the plain text body with one created manually
                $mail->AltBody = "Señor(a) ".$_POST["primer_nombre"]." ".$_POST["segundo_nombre"]." ".$_POST["primer_apellido"]." ".$_POST["segundo_apellido"].". Se creo el siguiente usuario: Usuario: ".$_POST["usuario"]." Clave: ".$_POST["clave"]." http://www.frabot.co/";
                //send the message, check for errors
                if (!$mail->send()) {
                    $data["msg"] = 'El sistema presento el siguiente error '. $mail->ErrorInfo;
                } else {
                    $data["msg"] = 'Por favor ingresar con su correo electrónico y su contraseña con el que se registro.';
                }
                
                $this->view->show("login.php", $data);
            }
        } else {
            //Finalmente presentamos nuestra plantilla
            $this->view->show("registro.php", $data);
        }
    }
    
    public function perfil() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';
        require 'admin/models/UsuarioModel.php';

        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();
        $usuario = new UsuarioModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos los usuarios logueados
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        $formXhtml = new Xhtml();

        //Pasamos a la vista toda la información que se desea representar 
        $data['config'] = Config::singleton();

        $data['logo'] = $indexModel->arraySql("SELECT * FROM banner WHERE activo = 1 AND ubicacion = 'Logo'");

        $data['informativo'] = $indexModel->arraySql("SELECT * FROM banner WHERE activo = 1 AND ubicacion = 'Informativo'");

        //productos del carrito        
        $data['carrito'] = $indexModel->listArraySql("SELECT carrito.*,articulo.nombre,articulo.precio,articulo.archivo,articulo.marca,articulo.codigo,articulo.precio_publico FROM carrito INNER JOIN articulo ON articulo.id=carrito.articulo WHERE carrito.cotizacion IS NULL AND carrito.usuario = " . $arrayDatosUser["id"] . " ORDER BY fecha_crear");

        $data['total_cotizacion'] = 0;

        foreach ($data['carrito'] as $clave => $valor) {
            $data['total_cotizacion'] = $data['total_cotizacion'] + ($valor["precio"] * $valor["cantidad"]);
        }

        //es el principal
        $data['menu_primero'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion = 'MenuPrimero' AND padre IS NULL ORDER BY padre , orden");

        //es todas la categorias
        $data['menu_segundo'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion = 'MenuSegundo' AND padre IS NULL ORDER BY padre , orden");

        $data['pie_pagina'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion like '%PiePagina%' ORDER BY orden");

        $data['indexModel'] = $indexModel;

        $data['menu_primero_categoria'] = 1;

        $data['formXhtml'] = $formXhtml;

        $data["dataUser"] = $arrayDatosUser;
        
        $data['arrayRegistro'] = $usuario->ejecutaSqlArray("SELECT * FROM usuario WHERE id ='" . $arrayDatosUser["id"] . "'");
        
        $data['arrayRegistro']["clave"]="";
        
        if ($_POST["insert"] == 1) {
            
            $array_usuarios = $usuario->listArraySql("SELECT * FROM usuario WHERE id ='" . $_POST["id"] . "'", "id");
            
            if (count($array_usuarios) > 0) {
                
                $_POST["fecha_editar"] = date("Y-m-d H:i:s");
                $_POST["usuario_editar"] = 1;
                $_POST["clave"] = sha1($_POST["clave"]);                
                
                $usuario->modUsuario($_POST);                                
                
                $data["msg"]="Se modifico su perfil correctamente.";
                
                $this->view->show("perfil.php", $data);
                
            }
        } else {
            //Finalmente presentamos nuestra plantilla
            $this->view->show("perfil.php", $data);
        }
    }

    public function login() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';
        require 'admin/models/UsuarioModel.php';

        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();
        $usuario = new UsuarioModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos los usuarios logueados
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        $formXhtml = new Xhtml();

        //Pasamos a la vista toda la información que se desea representar 
        $data['config'] = Config::singleton();

        $data['logo'] = $indexModel->arraySql("SELECT * FROM banner WHERE activo = 1 AND ubicacion = 'Logo'");

        $data['informativo'] = $indexModel->arraySql("SELECT * FROM banner WHERE activo = 1 AND ubicacion = 'Informativo'");

        //productos del carrito        
        $data['carrito'] = $indexModel->listArraySql("SELECT carrito.*,articulo.nombre,articulo.precio,articulo.archivo,articulo.marca,articulo.codigo,articulo.precio_publico FROM carrito INNER JOIN articulo ON articulo.id=carrito.articulo WHERE carrito.cotizacion IS NULL AND carrito.usuario = " . $arrayDatosUser["id"] . " ORDER BY fecha_crear");

        $data['total_cotizacion'] = 0;

        foreach ($data['carrito'] as $clave => $valor) {
            $data['total_cotizacion'] = $data['total_cotizacion'] + ($valor["precio"] * $valor["cantidad"]);
        }

        //es el principal
        $data['menu_primero'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion = 'MenuPrimero' AND padre IS NULL ORDER BY padre , orden");

        //es todas la categorias
        $data['menu_segundo'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion = 'MenuSegundo' AND padre IS NULL ORDER BY padre , orden");

        $data['pie_pagina'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion like '%PiePagina%' ORDER BY orden");

        $data['indexModel'] = $indexModel;

        $data['menu_primero_categoria'] = 1;

        $data['formXhtml'] = $formXhtml;

        $data["dataUser"] = $arrayDatosUser;

        if(isset($_POST["msg"]))
        {
            $data["msg"] = $_POST["msg"];
        }
        
        $data['title'] = "";

        $data['keywords'] = "Clubman, Razor, Repuestos, Planchas, Lamparas de uñas";
        
        //Finalmente presentamos nuestra plantilla
        $this->view->show("login.php", $data);
    }
    
    public function recordar() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';
        require 'admin/models/UsuarioModel.php';
        
        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();
        $usuario = new UsuarioModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos los usuarios logueados
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        $formXhtml = new Xhtml();

        //Pasamos a la vista toda la información que se desea representar 
        $data['config'] = Config::singleton();

        $data['logo'] = $indexModel->arraySql("SELECT * FROM banner WHERE activo = 1 AND ubicacion = 'Logo'");

        $data['informativo'] = $indexModel->arraySql("SELECT * FROM banner WHERE activo = 1 AND ubicacion = 'Informativo'");

        //productos del carrito        
        $data['carrito'] = $indexModel->listArraySql("SELECT carrito.*,articulo.nombre,articulo.precio,articulo.archivo,articulo.marca,articulo.codigo,articulo.precio_publico FROM carrito INNER JOIN articulo ON articulo.id=carrito.articulo WHERE carrito.cotizacion IS NULL AND carrito.usuario = " . $arrayDatosUser["id"] . " ORDER BY fecha_crear");

        $data['total_cotizacion'] = 0;

        foreach ($data['carrito'] as $clave => $valor) {
            $data['total_cotizacion'] = $data['total_cotizacion'] + ($valor["precio"] * $valor["cantidad"]);
        }

        //es el principal
        $data['menu_primero'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion = 'MenuPrimero' AND padre IS NULL ORDER BY padre , orden");

        //es todas la categorias
        $data['menu_segundo'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion = 'MenuSegundo' AND padre IS NULL ORDER BY padre , orden");

        $data['pie_pagina'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion like '%PiePagina%' ORDER BY orden");

        $data['indexModel'] = $indexModel;

        $data['menu_primero_categoria'] = 1;

        $data['formXhtml'] = $formXhtml;

        $data["dataUser"] = $arrayDatosUser;

        if(isset($_POST["msg"]))
        {
            $data["msg"] = $_POST["msg"];
        }
        
        $data['title'] = "";

        $data['keywords'] = "Clubman, Razor, Repuestos, Planchas, Lamparas de uñas";
        
        if ($_POST["insert"] == 1) {
            
            $array_usuarios = $usuario->ejecutaSqlArray("SELECT * FROM usuario WHERE usuario ='" . $_POST["email"] . "'");
            
            if (count($array_usuarios) > 0) {
                
                $clave = "frabot".mt_rand(5, 15);       
                $array_usuarios["fecha_editar"] = date("Y-m-d H:i:s");
                $array_usuarios["usuario_editar"] = 1;
                $array_usuarios["clave"] = sha1($clave);
                
                $usuario->modUsuario($array_usuarios);
                
                //Create a new PHPMailer instance
                $mail = new PHPMailer;
                $mail->CharSet = "UTF-8";
                //Tell PHPMailer to use SMTP
                $mail->isSMTP();
                //Enable SMTP debugging
                // 0 = off (for production use)
                // 1 = client messages
                // 2 = client and server messages
                $mail->SMTPDebug = 0;
                //Set the hostname of the mail server
                $mail->Host = 'p3plcpnl0797.prod.phx3.secureserver.net';
                //Set the SMTP port number - likely to be 25, 465 or 587
                $mail->Port = 587;
                //Whether to use SMTP authentication
                $mail->SMTPAuth = true;
                //Username to use for SMTP authentication
                $mail->Username = 'cotizacion@frabot.co';
                //Password to use for SMTP authentication
                $mail->Password = 'ingwilliam10';
                //Set who the message is to be sent from
                $mail->setFrom('cotizacion@frabot.co', 'FRABOT Cotización en Línea');
                //Set who the message is to be sent to
                $mail->addAddress($array_usuarios["usuario"], $array_usuarios["primer_nombre"]." ".$array_usuarios["segundo_nombre"]." ".$array_usuarios["primer_apellido"]." ".$array_usuarios["segundo_apellido"]);
                //Set the subject line
                $mail->Subject = 'Felicitaciones, se cambio con éxito su contraseña FRABOT';
                //Read an HTML message body from an external file, convert referenced images to embedded,
                //convert HTML into a basic plain-text alternative body
                $mail->msgHTML("<b>Señor(a) ".$array_usuarios["primer_nombre"]." ".$array_usuarios["segundo_nombre"]." ".$array_usuarios["primer_apellido"]." ".$array_usuarios["segundo_apellido"].".</b> Se cambio la contraseña para el usuario:<br/><ul><li>Usuario: ".$array_usuarios["usuario"]."</li><li>Nueva contraseña: ".$clave."</li></ul><br/><center><a href='http://www.frabot.co/'><b>FRABOT</b></a></center><br/>");
                //Replace the plain text body with one created manually
                $mail->AltBody = "Señor(a) ".$array_usuarios["primer_nombre"]." ".$array_usuarios["segundo_nombre"]." ".$array_usuarios["primer_apellido"]." ".$array_usuarios["segundo_apellido"].". Se cambio la contraseña para el usuario: Usuario: ".$array_usuarios["usuario"]." Nueva contraseña: ".$clave." http://www.frabot.co/";
                //send the message, check for errors
                if (!$mail->send()) {
                    $data["msg"] = 'El sistema presento el siguiente error '. $mail->ErrorInfo;
                } else {
                    $data["msg"] = 'Por favor ingresar con su correo electrónico y su nueva contraseña que se le envió a su bandeja de entrada.';
                }
                
                $this->view->show("login.php", $data);
                               
            } else {
                
                $data["msg"] = 'El correo electrónico que ingreso no se encuentra registrado, por favor registrarse para disfrutar de nuestros productos y poder realizar cotizaciones en linea.';
                $this->view->show("registro.php", $data);
                
            }
        } else {
            //Finalmente presentamos nuestra plantilla
            $this->view->show("recordar.php", $data);
        }                                
    }

    public function autenticar() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';
        require 'admin/models/UsuarioModel.php';
        require 'admin/models/LoginModel.php';

        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();
        $usuario = new UsuarioModel();
        $login = new LoginModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos los usuarios logueados
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        $formXhtml = new Xhtml();

        //Pasamos a la vista toda la información que se desea representar 
        $data['config'] = Config::singleton();

        $data['logo'] = $indexModel->arraySql("SELECT * FROM banner WHERE activo = 1 AND ubicacion = 'Logo'");

        $data['informativo'] = $indexModel->arraySql("SELECT * FROM banner WHERE activo = 1 AND ubicacion = 'Informativo'");

        //productos del carrito        
        $data['carrito'] = $indexModel->listArraySql("SELECT carrito.*,articulo.nombre,articulo.precio,articulo.archivo,articulo.marca,articulo.codigo,articulo.precio_publico FROM carrito INNER JOIN articulo ON articulo.id=carrito.articulo WHERE carrito.cotizacion IS NULL AND carrito.usuario = " . $arrayDatosUser["id"] . " ORDER BY fecha_crear");

        $data['total_cotizacion'] = 0;

        foreach ($data['carrito'] as $clave => $valor) {
            $data['total_cotizacion'] = $data['total_cotizacion'] + ($valor["precio"] * $valor["cantidad"]);
        }

        //es el principal
        $data['menu_primero'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion = 'MenuPrimero' AND padre IS NULL ORDER BY padre , orden");

        //es todas la categorias
        $data['menu_segundo'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion = 'MenuSegundo' AND padre IS NULL ORDER BY padre , orden");

        $data['pie_pagina'] = $indexModel->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion like '%PiePagina%' ORDER BY orden");

        $data['indexModel'] = $indexModel;

        $data['menu_primero_categoria'] = 1;

        $data['formXhtml'] = $formXhtml;

        $data["dataUser"] = $arrayDatosUser;

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos los usuarios logueados
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        //seteamos las variables de usuario y contraseña
        $login->set("email", $_POST["email"]);
        $login->set("clave", sha1($_POST["clave"]));

        $arrayUsuario = $login->authentication();

        if (isset($arrayUsuario["id"])) {
            //Se crea la variable de sesion del usuario para el ingreso al sistema	            
            $_SESSION[$config->get('SESSIONADMINISTRADOR')] = json_encode($arrayUsuario);
            header("Location: index.php");
            exit;
        } else {
            $data['msg'] = "Correo electrónico o contraseña incorrecto....";
            //Finalmente presentamos nuestra plantilla
            $this->view->show("login.php", $data);
        }
    }

    public function logout() {
        session_destroy();
        $parametros_cookies = session_get_cookie_params();
        setcookie(session_name(), 0, 1, $parametros_cookies["path"]);
        header("Location: index.php");
        exit;
    }

    public function agregarcarrito() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';

        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos los usuarios logueados
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        $formXhtml = new Xhtml();

        $array_articulo = $indexModel->listArraySql("SELECT * FROM carrito WHERE usuario = " . $arrayDatosUser["id"] . " AND articulo = " . $_POST["articulo"] . " AND cotizacion IS NULL");
        if (count($array_articulo) <= 0) {
            $indexModel->ejecutaSql("INSERT INTO carrito (usuario,articulo,fecha_crear,cantidad)VALUES(" . $arrayDatosUser["id"] . "," . $_POST["articulo"] . ",'" . date("Y-m-d H:i:s") . "',1)");
        }

        $data['carrito'] = $indexModel->listArraySql("SELECT carrito.*,articulo.nombre,articulo.precio,articulo.archivo,articulo.marca,articulo.codigo,articulo.precio_publico FROM carrito INNER JOIN articulo ON articulo.id=carrito.articulo WHERE carrito.cotizacion IS NULL AND carrito.usuario = " . $arrayDatosUser["id"] . " ORDER BY fecha_crear");

        foreach ($data['carrito'] as $clave => $valor) {
            $settings = array('w' => 50, 'h' => 50, 'canvas-color' => '#ffffff');
            ?>
            <tr>
                <td class="text-center" style="width:70px">
                    <img src="<?php echo $formXhtml->resize($config->get('ARTICULOS_ROOT') . $valor["archivo"], $settings) ?>" style="width:70px" alt="<?php echo $valor["nombre"]; ?>" title="<?php echo $valor["nombre"]; ?>" class="preview">
                </td>
                <td class="text-left"> <a class="cart_product_name" href="product.html"><?php echo $valor["nombre"]; ?></a> </td>
                <td class="text-center"> x<?php echo $valor["cantidad"]; ?> </td>
                <td class="text-center"> $<?php echo number_format($valor["precio"] * $valor["cantidad"]); ?> </td>
                <td class="text-right">
                    <a href="javascript::void(0)" onclick="cart.remove(<?php echo $valor["id"]; ?>, '<?php echo $_POST["redirect"]; ?>');" class="fa fa-times fa-delete"></a>
                </td>
            </tr>
            <?php
        }
    }
    
    public function comentar() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';

        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos los usuarios logueados
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        $formXhtml = new Xhtml();

        if(isset($arrayDatosUser))
        {
            //Create a new PHPMailer instance
            $mail = new PHPMailer;
            $mail->CharSet = "UTF-8";
            //Tell PHPMailer to use SMTP
            $mail->isSMTP();
            //Enable SMTP debugging
            // 0 = off (for production use)
            // 1 = client messages
            // 2 = client and server messages
            $mail->SMTPDebug = 0;
            //Set the hostname of the mail server
            $mail->Host = 'p3plcpnl0797.prod.phx3.secureserver.net';
            //Set the SMTP port number - likely to be 25, 465 or 587
            $mail->Port = 587;
            //Whether to use SMTP authentication
            $mail->SMTPAuth = true;
            //Username to use for SMTP authentication
            $mail->Username = 'cotizacion@frabot.co';
            //Password to use for SMTP authentication
            $mail->Password = 'ingwilliam10';
            //Set who the message is to be sent from
            $mail->setFrom('cotizacion@frabot.co', 'FRABOT Cotización en Línea');
            //Set who the message is to be sent to
            $mail->addAddress('javier.botero@frabot.co', 'Javier Botero');
            $mail->addAddress('yurany.prieto@frabot.co', 'Yurany Prieto');            
            //Set the subject line
            $mail->Subject = 'FRABOT Comentario del Señor(a) '.$arrayDatosUser["primer_nombre"].' '.$arrayDatosUser["segundo_nombre"].' '.$arrayDatosUser["primer_apellido"].' '.$arrayDatosUser["segundo_apellido"];
            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            $mail->msgHTML("<b>Señor Javier Botero, Su cliente comento lo siguiente.</b><p>".$_POST["comentario"]."</p><br/><a href='http://www.frabot.co/'>FRABOT</a>");
            //Replace the plain text body with one created manually
            $mail->AltBody = 'Señor Javier Botero, Su cliente comento lo siguiente. '.$_POST["comentario"];
            //send the message, check for errors
            $mail->send();
            
            $_POST["fecha_crear"] = date("Y-m-d H:i:s");
            $_POST["usuario_crear"] = $arrayDatosUser["id"];                        
            $_POST["activo"] = "1";                                    
            $consulta = $indexModel->thisdb()->insert("comentario",$_POST);                         
            $indexModel->thisdb()->exec($consulta);                                                        
            
            $comentarios = $indexModel->listArraySql("SELECT c.*,CONCAT(u.primer_nombre,' ',u.segundo_nombre,' ',u.primer_apellido,' ',u.segundo_apellido) as usuario_crear FROM comentario as c INNER JOIN usuario AS u ON u.id=c.usuario_crear WHERE c.activo = 1 AND c.articulo = '" . $_POST["articulo"] . "' ORDER BY c.fecha_crear DESC");        
            
            foreach($comentarios as $clave => $valor)
            {
            ?>
            <table class="table table-striped table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 50%;"><strong><?php echo $valor["usuario_crear"];?></strong></td>
                        <td class="text-right"><?php echo $valor["fecha_crear"];?></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p><?php echo $valor["comentario"];?></p>                                                                
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="text-right"></div>
            <?php
            }
        }
        else
        {
            echo "0";
        }
    }

    public function cantidadcarrito() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';

        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos los usuarios logueados
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        $indexModel->ejecutaSql("UPDATE carrito SET cantidad = " . $_POST["cantidad"] . " WHERE usuario = " . $arrayDatosUser["id"] . " AND id = " . $_POST["carrito"]);
    }

    public function eliminarcarrito() {
        //Incluye el modelo que corresponde
        require 'models/IndexModel.php';

        //Creamos una instancia de nuestro "modelo"
        $indexModel = new IndexModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //traemos los usuarios logueados
        $arrayDatosUser = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')], true);

        $indexModel->ejecutaSql("DELETE FROM carrito WHERE usuario = " . $arrayDatosUser["id"] . " AND id = " . $_POST["carrito"] . " LIMIT 1");
    }

}
?>