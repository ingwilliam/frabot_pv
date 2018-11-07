<?php

/**
 * Recursos del sistema
 *
 * @author William Alexander Barbosa Fuentes
 */
class Resources {

    protected $db;

    public function pre($array) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

    function encriptar($cadena, $clave = "una clave secreta") {
        $cifrado = MCRYPT_RIJNDAEL_256;
        $modo = MCRYPT_MODE_ECB;
        return mcrypt_encrypt($cifrado, $clave, $cadena, $modo, mcrypt_create_iv(mcrypt_get_iv_size($cifrado, $modo), MCRYPT_RAND)
        );
    }

    function desencriptar($cadena, $clave = "una clave secreta") {
        $cifrado = MCRYPT_RIJNDAEL_256;
        $modo = MCRYPT_MODE_ECB;
        return trim(mcrypt_decrypt($cifrado, $clave, $cadena, $modo, mcrypt_create_iv(mcrypt_get_iv_size($cifrado, $modo), MCRYPT_RAND))
        );
    }

    public static function sqlInyeccion($valor) {
        $valor = addslashes($valor);
        return $valor;
    }

    function fechaActual() {
        return date("Y-m-d H:i:s");
    }

    public function treeregistration($table, $key, $where, $orderby, $modulo, $nombreCampo) {
        $this->db = SPDO::singleton();
        $ArraySecciones = $this->db->listArray($table, $key, $where, $orderby);
        $nivel = 0;
        ?>        
        <ul id="browser" class="filetree">
            <?php
            foreach ($ArraySecciones as $ClaveSeccion => $ValorSecciones) {
                Resources::createtree($table, $key, $ValorSecciones, $orderby, $modulo, $nombreCampo, $nivel);
            }
            ?>
        </ul>
        <?php
    }

    public function createtree($table, $key, $ValorSecciones, $orderby, $modulo, $nombreCampo, $nivel) {
        $this->db = SPDO::singleton();
        $ArrayHijos = $this->db->listArray($table, $key, "idPadre = '" . $ValorSecciones[$key] . "'", $orderby);
        $nivel++;
        if ($ArrayHijos)
            $class = "class=\"folder\"";
        else
            $class = "class=\"file\"";

        if ($table == "capitulotutorial") {
            $arrayNivel = array("nivel" => $nivel);
            $sql = $this->db->update($table, $arrayNivel, $key . " = '" . $ValorSecciones[$key] . "' ");
            $consulta = $this->db->prepare($sql);
            $consulta->execute();
        }
        ?>
        <li>
            <span <?php echo $class; ?>><a href="index.php?controlador=<?php echo $modulo; ?>&accion=formMod<?php echo $modulo; ?>&iditem=<?php echo $ValorSecciones[$key] ?>"><?php echo $ValorSecciones[$nombreCampo]; ?></a></span>
            <?php
            if ($ArrayHijos) {
                ?>
                <ul>
                    <?php
                    foreach ($ArrayHijos as $clave => $valor)
                        Resources::createtree($table, $key, $valor, $orderby, $modulo, $nombreCampo, $nivel);
                    ?>
                </ul>
                <?php
            }
            ?>
        </li>
        <?php
    }

    public function arbolCapitulo($idTutorial) {

        $this->db = SPDO::singleton();
        $ArrayCapitulos = $this->db->listArray("capitulotutorial", "idCapituloTutorial", " idTutorial = '" . $idTutorial . "' ", "orden");

        print_r($ArrayCapitulos);
    }

    public function treeregistrationpagina($table, $key, $where, $orderby, $modulo, $nombreCampo, $idTutorial) {
        $this->db = SPDO::singleton();
        $ArraySecciones = $this->db->listArray($table, $key, $where . " AND idTutorial = '" . $idTutorial . "' ", $orderby);
        ?>        
        <ul id="browser" class="filetree">
            <?php
            foreach ($ArraySecciones as $ClaveSeccion => $ValorSecciones) {
                Resources::createtreepagina($table, $key, $ValorSecciones, $orderby, $modulo, $nombreCampo);
            }
            ?>
            <li><span class="folder"><a id="verJuego" class="atreepag" href="javascript:void(0)">Juego tutorial</a></span></li>

        </ul>
        <?php
    }

    public function createtreepagina($table, $key, $ValorSecciones, $orderby, $modulo, $nombreCampo) {
        $this->db = SPDO::singleton();
        $ArrayHijos = $this->db->listArray($table, $key, "idPadre = '" . $ValorSecciones[$key] . "'", $orderby);

        if ($ArrayHijos)
            $class = "class=\"folder\"";
        else
            $class = "class=\"file\"";
        ?>
        <li>
            <span <?php echo $class; ?>><a class="atreepag" href="index.php?controlador=<?php echo $modulo; ?>&accion=<?php echo $modulo; ?>&iditem=<?php echo $ValorSecciones[$key] ?>"><?php echo $ValorSecciones[$nombreCampo]; ?></a></span>
                <?php
                if ($ArrayHijos) {
                    ?>
                <ul>
                    <?php
                    foreach ($ArrayHijos as $clave => $valor)
                        Resources::createtreepagina($table, $key, $valor, $orderby, $modulo, $nombreCampo);
                    ?>
                </ul>
                <?php
            }
            ?>
        </li>
        <?php
    }

    static $TiposArchivos = array(
        "text/plain",
        "application/octet-stream",
        "application/pdf",
        "application/x-shockwave-flash",
        "application/msword",
        "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
        "application/vnd.ms-excel",
        "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
        "application/vnd.ms-powerpoint",
        "application/vnd.openxmlformats-officedocument.presentationml.presentation",
        "application/pdf",
        "image/tiff",
        "image/gif",
        "image/jpeg",
        "image/png",
        "audio/mpeg",
        "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
    );

    public function radio($id, $name, $value, $class, $title, $style = "", $arrayradio = array()) {

        foreach ($arrayradio as $clave => $valor) {
            if ($clave == $value)
                $check = "checked=\"checked\"";
            else
                $check = "";
            ?>
            <input type="radio" id="<?php echo $id; ?>" name="<?php echo $name; ?>" class="<?php echo $class; ?>" title="<?php echo $title; ?>" style="<?php echo $style; ?>" value="<?php echo $clave; ?>" <?php echo $check; ?> /><?php echo $valor; ?><br/>
            <?php
        }
    }

    public function edad($edad) {
        list($Y, $m, $d) = explode("-", $edad);
        $edad . '/' . date("md") . '/' . $m . $d;
        return( date("md") < $m . $d ? date("Y") - $Y - 1 : date("Y") - $Y );
    }

    public static function replaceSymbols($text) {
        
        /*
        $text = str_replace('#', '&#35;', $text);
        $text = str_replace('&', '&#38;', $text);
        $text = str_replace(';', '&#59;', $text);
        $text = str_replace(' ', '&#32;', $text);
        $text = str_replace('!', '&#33;', $text);
        $text = str_replace('"', '&#34;', $text);
        $text = str_replace('$', '&#36;', $text);
        $text = str_replace('%', '&#37;', $text);
        $text = str_replace("'", '&#39;', $text);
        $text = str_replace('(', '&#40;', $text);
        $text = str_replace(')', '&#41;', $text);
        $text = str_replace('*', '&#42;', $text);
        $text = str_replace('+', '&#43;', $text);
        $text = str_replace(',', '&#44;', $text);
        $text = str_replace('-', '&#45;', $text);
        $text = str_replace('.', '&#46;', $text);
        $text = str_replace('/', '&#47;', $text);
        $text = str_replace(':', '&#58;', $text);
        $text = str_replace('<', '&#60;', $text);
        $text = str_replace('=', '&#61;', $text);
        $text = str_replace('>', '&#62;', $text);
        $text = str_replace('?', '&#63', $text);
        $text = str_replace('[', '&#91;', $text);
        $text = str_replace('\\', '&#92;', $text);
        $text = str_replace(']', '&#93;', $text);
        $text = str_replace('^', '&#94;', $text);
        $text = str_replace('_', '&#95;', $text);
        $text = str_replace('`', '&#96;', $text);
        $text = str_replace('{', '&#123;', $text);
        $text = str_replace('|', '&#124;', $text);
        $text = str_replace('}', '&#125', $text);
        $text = str_replace('~', '&#126;', $text);
         */
        $text = str_replace('#', '', $text);
        $text = str_replace('&', '', $text);
        $text = str_replace(';', '', $text);
        $text = str_replace(' ', '', $text);
        $text = str_replace('!', '', $text);
        $text = str_replace('"', '', $text);
        $text = str_replace('$', '', $text);
        $text = str_replace('%', '', $text);
        $text = str_replace("'", '', $text);
        $text = str_replace('(', '', $text);
        $text = str_replace(')', '', $text);
        $text = str_replace('*', '', $text);
        $text = str_replace('+', '', $text);
        $text = str_replace(',', '', $text);
        $text = str_replace('-', '', $text);
        $text = str_replace('/', '', $text);
        $text = str_replace(':', '', $text);
        $text = str_replace('<', '', $text);
        $text = str_replace('=', '', $text);
        $text = str_replace('>', '', $text);
        $text = str_replace('?', '', $text);
        $text = str_replace('[', '', $text);
        $text = str_replace('\\', '', $text);
        $text = str_replace(']', '', $text);
        $text = str_replace('^', '', $text);
        $text = str_replace('`', '', $text);
        $text = str_replace('{', '', $text);
        $text = str_replace('|', '', $text);
        $text = str_replace('}', '', $text);
        $text = str_replace('~', '', $text);
        
        return $text;
    }
    
    public static function anio() {
        $ini_year =1993;
        $year_fin=date('Y');
        $c=0;
        for($i=$ini_year; $i<=$year_fin; $i++) { $anio[$i]=$i; $c++; }

        return $anio;        
    }

}
?>
