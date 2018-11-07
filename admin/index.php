<?php
// Notificar todos los errores excepto E_NOTICE
/*error_reporting(E_ALL);
ini_set('display_errors', '1');
 */
require 'libs/FrontController.php';
FrontController::main();
?>