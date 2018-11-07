<?php

/**
 * Clase generadora de etiquetas XHTML
 * Cada metodo es una etiqueda XHTML, con sus respectivos atributos
 * para ser utilizado por cualquier estilo css o valores a cada atributo
 *
 * @author William Alexander Barbosa Fuentes
 */
class Xhtml extends SPDO {

    private static $instance;

    public static function singleton() {
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
    }

    /**
     * Esta etiqueta nos permite mostrarle al usuario que el navegador que esta 
     * utilizando no tiene habilitada el javascript
     */
    public function noscript() {
        echo "<noscript>
<p>Bienvenido a Mi Sitio</p>
<p>La página que estás viendo requiere para su funcionamiento el uso de JavaScript.
Si lo has deshabilitado intencionadamente, por favor vuelve a activarlo.</p>
</noscript>";
    }

    /**
     * Mensaje de alerta para el usuario en javascript.
     * @param $mensaje = valor que se muestra de mensaje de alerta
     */
    public function alert($mensaje) {
        echo "<script type=\"text/javascript\">alert(\"" . $mensaje . "\");</script> ";
        return true;
    }

    /**
     * Url para direccionar en javascript.
     * @param $href = valor que redirecciona
     */
    public function actualizarPaginaPadre() {
        echo "<script type=\"text/javascript\">window.opener.location.reload();</script> ";
        return true;
    }

    public function cerrarVentana() {
        echo "<script type=\"text/javascript\">window.close();</script> ";
        return true;
    }

    /**
     * Url para direccionar en javascript.
     * @param $href = valor que redirecciona
     */
    public function location($href) {
        echo "<script type=\"text/javascript\">location.href=\"" . $href . "\";</script> ";
        return true;
    }

    /**
     * Url para direccionar en un tiempo determinado en javascript.
     * @param $href = valor que redirecciona
     * @param $time = tiempo en redireccionar el $href
     */
    public function locationtime($href, $time) {
        echo "<script type=\"text/javascript\">setTimeout(\"location.href='" . $href . "'\", " . $time . ");</script> ";
        return true;
    }

    public function inputtext($type, $id, $name, $value, $class, $title, $style = "", $size = "", $maxlength = "", $readonly = "", $disabled = "", $dir = "", $calendar = false) {
        $ecal = "";
        if ($calendar) {
            $ecal = "data-inputmask=\"'alias': 'yyyy-mm-dd'\" data-mask";
        }
        ?>
        <input dir="<?php echo $dir; ?>" type="<?php echo $type; ?>" id="<?php echo $id; ?>" name="<?php echo $name; ?>" value="<?php echo $value; ?>" class="<?php echo $class; ?>" title="<?php echo $title; ?>" style="<?php echo $style; ?>" size="<?php echo $size; ?>" maxlength="<?php echo $maxlength; ?>"  <?php echo $readonly; ?>  <?php echo $disabled; ?> <?php echo $ecal; ?>/>
        <?php
    }

    public function textarea($id, $name, $value, $class, $title, $style = "", $cols = "88", $rows = "5", $eventos = "") {
        ?>
        <textarea cols="<?php echo $cols; ?>" rows="<?php echo $rows; ?>" id="<?php echo $id; ?>" name="<?php echo $name; ?>" class="<?php echo $class; ?>" title="<?php echo $title; ?>" style="<?php echo $style; ?>"  <?php echo $eventos; ?>><?php echo $value; ?></textarea>
        <?php
    }

    public function fckeditor($name, $value, $width, $height) {
        //creo el objeto enriquecido
        $FCKeditor = new FCKeditor($name);
        $FCKeditor->BasePath = 'jquery/fckeditor/';
        $FCKeditor->Value = $value;
        $FCKeditor->Width = $width;
        $FCKeditor->Height = $height;
        $FCKeditor->Create();
    }

    public function inputfile($idObj, $id, $name, $value, $class, $title, $style = "", $urlfile = "", $modulo = "") {
        if ($value != "") {
            ?>
            <a target='_blank' href='<?php echo $urlfile . $value; ?>'><img src='dist/img/ver_documento.png' alt='file' border='0'/></a>
            <br/>
            <input type="file" id="<?php echo $id; ?>" name="<?php echo $name; ?>" class="<?php echo $class; ?>" title="<?php echo $title; ?>" style="<?php echo $style; ?>" />
            <?php
        } else {
            ?>
            <input type="file" id="<?php echo $id; ?>" name="<?php echo $name; ?>" class="<?php echo $class; ?>" title="<?php echo $title; ?>" style="<?php echo $style; ?>" />
            <?php
        }
    }

    public function inputfileinterna($idObj, $id, $name, $value, $class, $title, $style = "", $urlfile = "", $modulo = "", $accion = "", $parametros = "") {
        if ($value != "") {
            ?>
            <a target='_blank' href='<?php echo $urlfile . $value; ?>'><img src='images/documento.png' alt='file' border='0'/></a>
            <br/><br/>
            <a style="text-decoration: none" href="index.php?controlador=<?php echo $modulo; ?>&accion=<?php echo $accion; ?>&iditem=<?php echo $idObj; ?>&nombreCampo=<?php echo $name; ?><?php echo $parametros; ?>">[X]</a>
            <?php
        } else {
            ?>
            <input type="file" id="<?php echo $id; ?>" name="<?php echo $name; ?>" class="<?php echo $class; ?>" title="<?php echo $title; ?>" style="<?php echo $style; ?>" />
            <?php
        }
    }

    public function unloadfile($file, $destino,$nombre) {
        if (in_array($file["type"], Resources::$TiposArchivos)) {
            
            $pos = strrpos($file["name"], ".");
            
            $ext = substr($file["name"], $pos);
                        
            $NameFile = substr(md5(uniqid(rand())), 0, 6) . "_" . $nombre.$ext;
            
            if (move_uploaded_file($file["tmp_name"], $destino . $NameFile)) {
                return $NameFile;
            } else {
                $this->alert("Problemas Al Cargar");
                $this->location($_SERVER['HTTP_REFERER']);
                exit;
            }
        } else {
            $this->alert("Archivo no permitido");
            $this->location($_SERVER['HTTP_REFERER']);
            exit;
        }
    }

    public function radio($id, $name, $value, $class, $title, $style = "", $arrayradio = array(), $disable = "") {

        foreach ($arrayradio as $clave => $valor) {
            if ($clave == $value)
                $check = "checked=\"checked\"";
            else
                $check = "";
            ?>
            <input type="radio" id="<?php echo $id; ?>" name="<?php echo $name; ?>" class="<?php echo $class; ?>" title="<?php echo $title; ?>" style="<?php echo $style; ?>" value="<?php echo $clave; ?>" <?php echo $check; ?> <?php echo $disable; ?> /><?php echo $valor; ?> &nbsp;
            <?php
            $class = "";
        }
    }

    public function select($id, $name, $value, $class, $title, $style = "", $table = "", $key = "", $muestra = "", $extra = "", $where = "1", $orderby = "", $arrayselect = array(), $dir = "", $textoSelect = ":: Seleccione ::", $disable = "") {

        if ($table != "") {

            $arrayselect = $this->listArray($table, $key, $where, $orderby);
        }
        ?>
        <select id="<?php echo $id; ?>" name="<?php echo $name; ?>" class="<?php echo $class; ?>" title="<?php echo $title; ?>" style="<?php echo $style; ?>" size="1" dir="<?php echo $dir; ?>" <?php echo $disable; ?> >
            <option value=""><?php echo $textoSelect; ?></option>
            <?php
            $check = "";
            foreach ($arrayselect as $clave => $valor) {
                if ($clave == $value)
                    $check = "selected=\"selected\"";
                else
                    $check = "";
                ?>
                <option value="<?php echo $clave; ?>" <?php echo $check; ?>>
                    <?php
                    if ($table != "") {
                        echo $valor[$muestra];
                        if ($extra != "") {
                            echo " - " . $valor[$extra];
                        }
                    } else {
                        echo $valor;
                    }
                    ?>
                </option>
                <?php
            }
            ?>
        </select>
        <?php
    }

    public function selectPerfil($id, $name, $value, $class, $title, $style = "", $table = "", $key = "", $muestra = "", $extra = "", $where = "1", $orderby = "", $arrayselect = array(), $dir = "", $textoSelect = ":: Seleccione ::", $disable = "", $idPerfil = "") {

        $arrayPerfilesReparacion = array(1, 8);

        if ($table != "") {

            $arrayselect = $this->listArray($table, $key, $where, $orderby);
        }
        ?>
        <select id="<?php echo $id; ?>" name="<?php echo $name; ?>" class="<?php echo $class; ?>" title="<?php echo $title; ?>" style="<?php echo $style; ?>" size="1" dir="<?php echo $dir; ?>" <?php echo $disable; ?> >
            <option value=""><?php echo $textoSelect; ?></option>
            <?php
            $check = "";
            foreach ($arrayselect as $clave => $valor) {
                if ($clave == $value)
                    $check = "selected=\"selected\"";
                else
                    $check = "";

                $muestraOption = true;
                if ($clave == 16) {
                    if (in_array($idPerfil, $arrayPerfilesReparacion)) {
                        $muestraOption = true;
                    } else {
                        $muestraOption = false;
                    }
                }

                if ($muestraOption) {
                    ?>
                    <option value="<?php echo $clave; ?>" <?php echo $check; ?>>
                        <?php
                        if ($table != "") {
                            echo $valor[$muestra];
                            if ($extra != "") {
                                echo " - " . $valor[$extra];
                            }
                        } else {
                            echo $valor;
                        }
                        ?>
                    </option>
                    <?php
                }
            }
            ?>
        </select>
        <?php
    }

    public function selectExtra($id, $name, $value, $class, $title, $style = "", $table = "", $key = "", $muestra = "", $extra = "", $where = "1", $orderby = "", $arrayselect = array(), $dir = "", $textoSelect = ":: Seleccione ::", $disable = "", $tableextra = "") {

        if ($table != "") {

            $sql = "SELECT $table.* , $tableextra.$extra as extra FROM $table LEFT JOIN $tableextra ON $table.departamento=$tableextra.id WHERE $where ORDER BY $orderby";

            $arrayselect = $this->listArraySql($sql, $key);
        }
        ?>
        <select id="<?php echo $id; ?>" name="<?php echo $name; ?>" class="<?php echo $class; ?>" title="<?php echo $title; ?>" style="<?php echo $style; ?>" size="1" dir="<?php echo $dir; ?>" <?php echo $disable; ?> >
            <option value=""><?php echo $textoSelect; ?></option>
            <?php
            $check = "";
            foreach ($arrayselect as $clave => $valor) {
                if ($clave == $value)
                    $check = "selected=\"selected\"";
                else
                    $check = "";
                ?>
                <option value="<?php echo $clave; ?>" <?php echo $check; ?>>
                    <?php
                    if ($table != "") {
                        if ($extra != "") {
                            echo $valor[$muestra] . " - " . $valor["extra"];
                        } else {
                            echo $valor[$muestra];
                        }
                    } else {
                        echo $valor;
                    }
                    ?>
                </option>
                <?php
            }
            ?>
        </select>
        <?php
    }

    public function selectExtraDirector($id, $name, $value, $class, $title, $style = "", $table = "", $key = "", $muestra = "", $extra = "", $where = "1", $orderby = "", $arrayselect = array(), $dir = "", $textoSelect = ":: Seleccione ::", $disable = "", $tableextra = "") {

        if ($table != "") {

            $sql = "SELECT $table.* , $tableextra.$extra as extra FROM $table LEFT JOIN $tableextra ON $table.id=$tableextra.usuario WHERE $where ORDER BY $orderby";

            $arrayselect = $this->listArraySql($sql, $key);
        }
        ?>
        <select id="<?php echo $id; ?>" name="<?php echo $name; ?>" class="<?php echo $class; ?>" title="<?php echo $title; ?>" style="<?php echo $style; ?>" size="1" dir="<?php echo $dir; ?>" <?php echo $disable; ?> >
            <option value=""><?php echo $textoSelect; ?></option>
            <?php
            $check = "";
            foreach ($arrayselect as $clave => $valor) {
                if ($clave == $value)
                    $check = "selected=\"selected\"";
                else
                    $check = "";
                ?>
                <option value="<?php echo $clave; ?>" <?php echo $check; ?>>
                    <?php
                    if ($table != "") {
                        echo $valor["primer_nombre"] . " " . $valor["segundo_nombre"] . " " . $valor["primer_apellido"] . " " . $valor["segundo_apellido"];
                    } else {
                        echo $valor;
                    }
                    ?>
                </option>
                <?php
            }
            ?>
        </select>
        <?php
    }

    public function selectConcatena($id, $name, $value, $class, $title, $style = "", $table = "", $key = "", $arrayMuestra = array(), $where = "1", $orderby = "", $arrayselect = array(), $dir = "", $textoSelect = ":: Seleccione ::") {

        if ($table != "") {

            $arrayselect = $this->listArray($table, $key, $where, $orderby);
        }
        ?>
        <select id="<?php echo $id; ?>" name="<?php echo $name; ?>" class="<?php echo $class; ?>" title="<?php echo $title; ?>" style="<?php echo $style; ?>" size="1" dir="<?php echo $dir; ?>">
            <option value=""><?php echo $textoSelect; ?></option>
            <?php
            $check = "";
            foreach ($arrayselect as $clave => $valor) {
                if ($clave == $value)
                    $check = "selected=\"selected\"";
                else
                    $check = "";
                ?>
                <option value="<?php echo $clave; ?>" <?php echo $check; ?>>
                    <?php
                    if ($table != "") {
                        foreach ($arrayMuestra as $clavemuestra => $valormuestra) {
                            echo $valor[$valormuestra] . " ";
                        }
                    } else {
                        echo $valor;
                    }
                    ?>
                </option>
                <?php
            }
            ?>
        </select>
        <?php
    }

    public function subMenuPrincipal($id) {
        return $this->listArray("seccion", "idSeccion", "idPadre = '$id' AND ubicacion = 'Menu'", "orden");
    }

    public function divCheckBuscador($table, $key, $where, $orderby, $muestra, $controlador, $accion, $arrayCheckValor, $keyRelacion, $keyRelacionDos, $keyRelacionValor, $tableunion = "") {

        if ($tableunion == "") {
            $arrayCheck = $this->listArray($table, $key, $where, $orderby);
        } else {

            $sql = "select $table.* from $table where $table.$key not in (select $table.$key from $tableunion where $tableunion.$key = $table.$key) AND " . $where . " ORDER BY $table.idBono ASC";

            $arrayCheck = $this->listArraySql($sql, $key);
            /*
              <br/>
              Buscador: <input type="text" id="textCheckBuscador<?php echo $table; ?>" />
              <br/><br/>
              <input type="hidden" id="controladorCheckBuscador" value="<?php echo $controlador; ?>" />
              <input type="hidden" id="accionCheckBuscador" value="<?php echo $accion; ?>" />
             */
        }
        ?>
        <div id="divCheckBuscador<?php echo $table; ?>" class="divCheckBuscador">
            <?php
            foreach ($arrayCheck as $clave => $valor) {

                $checked = '';
                foreach ($arrayCheckValor as $clavedos => $valordos) {
                    if (( $valordos[$keyRelacion] == $keyRelacionValor ) && ( $valordos[$keyRelacionDos] == $valor[$key] ))
                        $checked = 'checked="checked"';
                }
                ?>
                <div class="divItemCheck">
                    <input <?php echo $checked; ?> type="checkbox" name="arrayCheckBuscador<?php echo $table; ?>[]" value="<?php echo $valor[$key]; ?>"/> <?php echo $valor[$muestra]; ?>
                </div>            
                <?php
            }
            ?>
            <div style="clear: both"></div>    
        </div>    
        <div style="clear: both"></div>    
        <?php
    }

    function generarThumb($pathNombre, $ImgOriginal, $anchoLimite, $altoLimite) {
        $original = imagecreatefromjpeg($ImgOriginal);

        //Defino variables
        $anchoFoto = "";
        $altoFoto = "";
        //Armo las dimesiones de la imagen
        $ancho = imagesx($original);
        $alto = imagesy($original);
        if ($ancho > $anchoLimite) {
            $anchoFoto = $anchoLimite;
            $altoFoto = ($alto * $anchoLimite) / $ancho;
        }
        if ($alto > $altoLimite) {
            $altoFoto = $altoLimite;
            $anchoFoto = ($ancho * $altoLimite) / $alto;
        }
        if ($anchoFoto > $anchoLimite) {
            $anchoFoto = $anchoLimite;
            $altoFoto = ($alto * $anchoLimite) / $ancho;
        }
        if ($altoFoto > $altoLimite) {
            $altoFoto = $altoLimite;
            $anchoFoto = ($ancho * $altoLimite) / $alto;
        }
        if ($anchoFoto != "" && $altoFoto != "") {
            $thumb = imagecreatetruecolor($anchoFoto, $altoFoto); // Lo haremos de un tama?o 150x150        
            imagecopyresampled($thumb, $original, 0, 0, 0, 0, $anchoFoto, $altoFoto, $ancho, $alto);
        } else {
            $thumb = imagecreatetruecolor($ancho, $alto); // Lo haremos de un tama?o 150x150        
            imagecopyresampled($thumb, $original, 0, 0, 0, 0, $ancho, $alto, $ancho, $alto);
        }

        return imagejpeg($thumb, $pathNombre, 100);
    }

    /**
     * function by Wes Edling .. http://joedesigns.com
     * feel free to use this in any project, i just ask for a credit in the source code.
     * a link back to my site would be nice too.
     *
     *
     * Changes: 
     * 2012/01/30 - David Goodwin - call escapeshellarg on parameters going into the shell
     * 2012/07/12 - Whizzkid - Added support for encoded image urls and images on ssl secured servers [https://]
     */
    /**
     * SECURITY:
     * It's a bad idea to allow user supplied data to become the path for the image you wish to retrieve, as this allows them
     * to download nearly anything to your server. If you must do this, it's strongly advised that you put a .htaccess file 
     * in the cache directory containing something like the following :
     * <code>php_flag engine off</code>
     * to at least stop arbitrary code execution. You can deal with any copyright infringement issues yourself :)
     */

    /**
     * @param string $imagePath - either a local absolute/relative path, or a remote URL (e.g. http://...flickr.com/.../ ). See SECURITY note above.
     * @param array $opts  (w(pixels), h(pixels), crop(boolean), scale(boolean), thumbnail(boolean), maxOnly(boolean), canvas-color(#abcabc), output-filename(string), cache_http_minutes(int))
     * @return new URL for resized image.
     */
    function resize($imagePath, $opts = null) {
        $imagePath = urldecode($imagePath);
        # start configuration
        $cacheFolder = './cache/'; # path to your cache folder, must be writeable by web server
        $remoteFolder = $cacheFolder . 'remote/'; # path to the folder you wish to download remote images into

        $defaults = array('crop' => false, 'scale' => 'false', 'thumbnail' => false, 'maxOnly' => false,
            'canvas-color' => 'transparent', 'output-filename' => false,
            'cacheFolder' => $cacheFolder, 'remoteFolder' => $remoteFolder, 'quality' => 90, 'cache_http_minutes' => 20);

        $opts = array_merge($defaults, $opts);

        $cacheFolder = $opts['cacheFolder'];
        $remoteFolder = $opts['remoteFolder'];

        $path_to_convert = 'convert'; # this could be something like /usr/bin/convert or /opt/local/share/bin/convert
        ## you shouldn't need to configure anything else beyond this point

        $purl = parse_url($imagePath);
        $finfo = pathinfo($imagePath);
        $ext = $finfo['extension'];

        # check for remote image..
        if (isset($purl['scheme']) && ($purl['scheme'] == 'http' || $purl['scheme'] == 'https')):
            # grab the image, and cache it so we have something to work with..
            list($filename) = explode('?', $finfo['basename']);
            $local_filepath = $remoteFolder . $filename;
            $download_image = true;
            if (file_exists($local_filepath)):
                if (filemtime($local_filepath) < strtotime('+' . $opts['cache_http_minutes'] . ' minutes')):
                    $download_image = false;
                endif;
            endif;
            if ($download_image == true):
                $img = file_get_contents($imagePath);
                file_put_contents($local_filepath, $img);
            endif;
            $imagePath = $local_filepath;
        endif;

        if (file_exists($imagePath) == false):
            $imagePath = $_SERVER['DOCUMENT_ROOT'] . $imagePath;
            if (file_exists($imagePath) == false):
                return 'image not found';
            endif;
        endif;

        if (isset($opts['w'])): $w = $opts['w'];
        endif;
        if (isset($opts['h'])): $h = $opts['h'];
        endif;

        $filename = md5_file($imagePath);

        // If the user has requested an explicit output-filename, do not use the cache directory.
        if (false !== $opts['output-filename']) :
            $newPath = $opts['output-filename'];
        else:
            if (!empty($w) and ! empty($h)):
                $newPath = $cacheFolder . $filename . '_w' . $w . '_h' . $h . (isset($opts['crop']) && $opts['crop'] == true ? "_cp" : "") . (isset($opts['scale']) && $opts['scale'] == true ? "_sc" : "") . '.' . $ext;
            elseif (!empty($w)):
                $newPath = $cacheFolder . $filename . '_w' . $w . '.' . $ext;
            elseif (!empty($h)):
                $newPath = $cacheFolder . $filename . '_h' . $h . '.' . $ext;
            else:
                return false;
            endif;
        endif;

        $create = true;

        if (file_exists($newPath) == true):
            $create = false;
            $origFileTime = date("YmdHis", filemtime($imagePath));
            $newFileTime = date("YmdHis", filemtime($newPath));
            if ($newFileTime < $origFileTime): # Not using $opts['expire-time'] ??
                $create = true;
            endif;
        endif;

        if ($create == true):
            if (!empty($w) and ! empty($h)):

                list($width, $height) = getimagesize($imagePath);
                $resize = $w;

                if ($width > $height):
                    $resize = $w;
                    if (true === $opts['crop']):
                        $resize = "x" . $h;
                    endif;
                else:
                    $resize = "x" . $h;
                    if (true === $opts['crop']):
                        $resize = $w;
                    endif;
                endif;

                if (true === $opts['scale']):
                    $cmd = $path_to_convert . " " . escapeshellarg($imagePath) . " -resize " . escapeshellarg($resize) .
                            " -quality " . escapeshellarg($opts['quality']) . " " . escapeshellarg($newPath);
                else:
                    $cmd = $path_to_convert . " " . escapeshellarg($imagePath) . " -resize " . escapeshellarg($resize) .
                            " -size " . escapeshellarg($w . "x" . $h) .
                            " xc:" . escapeshellarg($opts['canvas-color']) .
                            " +swap -gravity center -composite -quality " . escapeshellarg($opts['quality']) . " " . escapeshellarg($newPath);
                endif;

            else:
                $cmd = $path_to_convert . " " . escapeshellarg($imagePath) .
                        " -thumbnail " . (!empty($h) ? 'x' : '') . $w . "" .
                        (isset($opts['maxOnly']) && $opts['maxOnly'] == true ? "\>" : "") .
                        " -quality " . escapeshellarg($opts['quality']) . " " . escapeshellarg($newPath);
            endif;

            $c = exec($cmd, $output, $return_code);
            if ($return_code != 0) {
                error_log("Tried to execute : $cmd, return code: $return_code, output: " . print_r($output, true));
                return false;
            }
        endif;

        # return cache file path
        return str_replace($_SERVER['DOCUMENT_ROOT'], '', $newPath);
    }

}
?>