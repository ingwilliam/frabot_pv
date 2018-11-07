<?php
class IndexController extends ControllerBase
{
    private $url = "index.php";
    
    //Accion index
    public function index()
    {
        require "models/IndexModel.php";
        
        $config = Config::singleton();
        
        $index = new IndexModel();
        
        $vars["dataUser"] = json_decode($_SESSION[$config->get('SESSIONADMINISTRADOR')],true);
        
        $cotizaciones = $index->listArraySql("SELECT Date_format(fecha_crear,'%Y-%m') AS fecha,count(id) AS cantidad FROM frabot.comentario GROUP BY 1 LIMIT 5;","",true);
        
        $vars["cotizaciones"] = "";
        
        foreach($cotizaciones as $clave => $valor)
        {
            $vars["cotizaciones"]=$vars["cotizaciones"]."{device: '".$valor["fecha"]."', geekbench: ".$valor["cantidad"]."},";            
        }                        
        
        $vars["cotizaciones"] = substr($vars["cotizaciones"], 0, -1);
        
        $carritos = $index->listArraySql("SELECT Date_format(fecha_crear,'%Y-%m') AS fecha,count(id) AS cantidad FROM frabot.carrito WHERE cotizacion IS NOT NULL GROUP BY 1 LIMIT 5;","",true);
        
        $vars["carritos"] = "";
        
        foreach($carritos as $clave => $valor)
        {
            $vars["carritos"]=$vars["carritos"]."{device: '".$valor["fecha"]."', geekbench: ".$valor["cantidad"]."},";            
        }                        
        
        $vars["carritos"] = substr($vars["carritos"], 0, -1);
        
        $this->view->show($this->url, $vars);
    }
    
    public function testView()
    {
        $vars['nombre'] = "Federico";
        $vars['lugar'] = $this->getLugar();
        $this->view->show("test.php", $vars);
    }
    
    private function getLugar()
    {
        return "Buenos Aires, Argentina";
    }
}
?>