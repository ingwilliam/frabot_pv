<?php
class LoginController extends ControllerBase
{
    
    private $url = "login.php";
    private $modelo = "models/LoginModel.php";
    
    public function login()
    {
        $this->view->show($this->url, $vars);
    }
    
    public function autenticar()
    {
        //Incluye el modelo que corresponde
        require $this->modelo;

        //Creamos una instancia de nuestro "modelo"
        $login = new LoginModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        //seteamos las variables de usuario y contraseña
        $login->set("email", $_POST["email"]);
        $login->set("clave", sha1($_POST["clave"]));
        
        $arrayUsuario = $login->authentication();
        
        if (isset($arrayUsuario["id"])) {
            
            //Se crea la variable de sesion del usuario para el ingreso al sistema	            
            $_SESSION[$config->get('SESSIONADMINISTRADOR')] = json_encode($arrayUsuario);
            header("Location: index.php?controlador=Index&accion=index");
            exit;
        } else {
            //Pasamos a la vista toda la información que se desea representar
            $vars = array();
            $vars['mensajeerror'] = "Nombre de usuario o contraseña incorrecto....";
            //Finalmente presentamos nuestra plantilla
            $this->view->show($this->url, $vars);
        }
        
        
        
    }
    
    /**
     * Verifica si la session esta activa
     * para poder ingresar al sistema
     */
    public function confirmarUsuario() {
        
        //Incluye el modelo que corresponde
        require $this->modelo;

        //Creamos una instancia de nuestro "modelo"
        $login = new LoginModel();

        //incluimos las variables globales del config
        $config = Config::singleton();

        
        
        //si el usuario no se ha logueado
        if (!$_SESSION[$config->get('SESSIONADMINISTRADOR')]) {
            
            // Inicializar la sesión.
            // Si está usando session_name("algo"), ¡no lo olvide ahora!
            session_start();

            // Destruir todas las variables de sesión.
            $_SESSION = array();

            // Si se desea destruir la sesión completamente, borre también la cookie de sesión.
            // Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }

            // Finalmente, destruir la sesión.
            session_destroy();
            
            header("Location: index.php?mensajeerror=Nombre de usuario o contraseña incorrecto...");            
            exit;                
        }

        return json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')],true);
        
    }
    
    /**
     * Elimina la session del usuario
     * activo en el sistema 
     */
    public function salir() {
        session_destroy();        
        $parametros_cookies = session_get_cookie_params();
        setcookie(session_name(),0,1,$parametros_cookies["path"]);        
        header("Location: index.php?mensajeok=Cerro exitosamente su sesión");
        exit;
    }
    
    
}
?>