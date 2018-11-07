<?php
abstract class ControllerBase {
    
    protected $view;
    
    function __construct()
    {
        if(!isset($_SESSION)) 
        {
            session_start();
        }
        $this->view = new View();
    }
}
?>