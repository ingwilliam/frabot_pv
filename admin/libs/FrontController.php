<?php
class FrontController
{
	static function main()
	{
		//Incluimos algunas clases:
		
		require 'libs/Config.php'; //de configuracion
		require 'libs/SPDO.php'; //PDO con singleton
		require 'libs/ControllerBase.php'; //Clase controlador base
		require 'libs/ModelBase.php'; //Clase modelo base
		require 'libs/View.php'; //Mini motor de plantillas
		
                require 'libs/Resources.php'; //Recursos del sistema
                require 'libs/Xhtml.php'; //Formularios del sistema
                require 'libs/PHPPaging.php'; //Paginador del sistema                
                
		require 'config.php'; //Archivo con configuraciones.
		
		//Con el objetivo de no repetir nombre de clases, nuestros controladores
		//terminaran todos en Controller. Por ej, la clase controladora Items, ser� ItemsController
		
		//Formamos el nombre del Controlador o en su defecto, tomamos que es el IndexController
		if(! empty($_GET['controlador']))
		      $controllerName = $_GET['controlador'] . 'Controller';
		else
		      $controllerName = "LoginController";
		
		//Lo mismo sucede con las acciones, si no hay accion, tomamos index como accion
		if(! empty($_GET['accion']))
		      $actionName = $_GET['accion'];
		else
		      $actionName = "login";
		
		$controllerPath = $config->get('controllersFolder') . $controllerName . '.php';
			
		//Incluimos el fichero que contiene nuestra clase controladora solicitada	
		if(is_file($controllerPath))
		      require $controllerPath;
		else
		      header ("Location: index.php?controlador=Index&accion=index");
		
		//Si no existe la clase que buscamos y su accion, tiramos un error 404
		if (is_callable(array($controllerName, $actionName)) == false) 
		{
			header ("Location: index.php?controlador=Index&accion=index");
			return false;
		}
                
                $arrayModuloNoLogin = array("LoginController", "RecuperarClaveController");
                
                
                //valido siempre la session de usuario cuando no esten en el controlador LoginController
                if (!in_array($controllerName, $arrayModuloNoLogin))
                {
                    //Incluye el modelo que corresponde
                    require "controllers/LoginController.php";

                    //Creamos una instancia de nuestro "modelo"
                    $login = new LoginController();
                    
                    $arrayDatosUsuario = $login->confirmarUsuario(); 
                            
                    //si el usuario esta loguado lo dejo ingresar
                    if (isset($arrayDatosUsuario["id"]))
                    {                        
                        $_SESSION[$config->get('SESSIONADMINISTRADOR')] = json_encode($arrayDatosUsuario);                        
                        //Si todo esta bien, creamos una instancia del controlador y llamamos a la accion
                        $controller = new $controllerName();
                        $controller->$actionName();
                    }
                    else
                    {
                        header("Location: index.php?mensajeerror=Nombre de usuario o contraseña incorrecto..");            
                        exit;
                    }
                }
                else
                {
                    //Si todo esta bien, creamos una instancia del controlador y llamamos a la accion
                    $controller = new $controllerName();
                    $controller->$actionName();
                }
	}
}
?>