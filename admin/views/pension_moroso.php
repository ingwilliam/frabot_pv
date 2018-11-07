<?php
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=morosos_" . $_GET["anio"] . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table class="tabla_planilla" width="100%" border="1" cellpadding="0" cellspacing="0">
    <tbody >
        <tr>
            <td colspan="12" bgcolor="#E6E6FA">
    <center>                                            
        <b><?php echo utf8_decode("AÑO:") ?></b> <?php echo $vars["arrayRegistro"]["anio"]; ?> 
        <b>GRADO:</b> <?php echo utf8_decode($vars["arrayPaginador"][0]["curso"]); ?>
    </center>
</td>
</tr>
<tr>
    <td bgcolor="#BDBDBD"><center><?php echo utf8_decode(N°); ?></center></th>
    <!--<td bgcolor="#BDBDBD"><center>TIPO DOCUMENTO</center></td>
    <td bgcolor="#BDBDBD"><center>NUMERO DOCUMENTO</center></td>-->
<td bgcolor="#BDBDBD"><center>APELLIDOS Y NOMBRES</center></td>                                                                                                    
<td bgcolor="#BDBDBD"><center>FEB</center></td>                                                                                                    
<td bgcolor="#BDBDBD"><center>MAR</center></td>                                                                                                    
<td bgcolor="#BDBDBD"><center>ABR</center></td>                                                                                                                                                        
<td bgcolor="#BDBDBD"><center>MAY</center></td>                                                                                                    
<td bgcolor="#BDBDBD"><center>JUN</center></td>                                                                                                    
<td bgcolor="#BDBDBD"><center>JUL</center></td>                                                                                                    
<td bgcolor="#BDBDBD"><center>AGO</center></td>                                                                                                                                                        
<td bgcolor="#BDBDBD"><center>SEP</center></td>                                                                                                    
<td bgcolor="#BDBDBD"><center>OCT</center></td>                                                                                                    
<td bgcolor="#BDBDBD"><center>NOV</center></td>                                                                                                    
</tr>

<?php
$i = 1;
foreach ($vars["arrayPaginador"] as $clave => $item) {
    $canceladas = "0";
    ?>
    <tr>
        <td><?php echo $i; ?></td>                                                                                                                
        <!--<td><php echo strtoupper($item['tipo_documento']); ?></td>                                                                                                                
        <td><php echo $item['numero_documento']; ?></td>-->                                                                                                                
        <td><?php echo utf8_decode(strtoupper($item['primer_apellido'] . " " . $item['segundo_apellido'] . " " . $item['primer_nombre'] . " " . $item['segundo_nombre'])); ?></td>                                                        
        <td style="text-align: center">
            <?php
            $pension_actual = $vars["pension"]->consultPensionWhere("mes=2 AND matricula = " . $item['id'] . "");
            if ($pension_actual["estado"] == "Cancelado") {
                echo $pension_actual["estado"];
            } else {
                echo "Debe";
            }
            ?>
        </td>
        <td style="text-align: center">
            <?php
            $pension_actual = $vars["pension"]->consultPensionWhere("mes=3 AND matricula = " . $item['id'] . "");
            if ($pension_actual["estado"] == "Cancelado") {
                echo $pension_actual["estado"];
            } else {
                echo "Debe";
            }
            ?>
        </td>
        <td style="text-align: center">
            <?php
            $pension_actual = $vars["pension"]->consultPensionWhere("mes=4 AND matricula = " . $item['id'] . "");
            if ($pension_actual["estado"] == "Cancelado") {
                echo $pension_actual["estado"];
            } else {
                echo "Debe";
            }
            ?>
        </td>
        <td style="text-align: center">
            <?php
            $pension_actual = $vars["pension"]->consultPensionWhere("mes=5 AND matricula = " . $item['id'] . "");
            if ($pension_actual["estado"] == "Cancelado") {
                echo $pension_actual["estado"];
            } else {
                echo "Debe";
            }
            ?>
        </td>
        <td style="text-align: center">
            <?php
            $pension_actual = $vars["pension"]->consultPensionWhere("mes=6 AND matricula = " . $item['id'] . "");
            if ($pension_actual["estado"] == "Cancelado") {
                echo $pension_actual["estado"];
            } else {
                echo "Debe";
            }
            ?>
        </td>
        <td style="text-align: center">
            <?php
            $pension_actual = $vars["pension"]->consultPensionWhere("mes=7 AND matricula = " . $item['id'] . "");
            if ($pension_actual["estado"] == "Cancelado") {
                echo $pension_actual["estado"];
            } else {
                echo "Debe";
            }
            ?>
        </td>
        <td style="text-align: center">
            <?php
            $pension_actual = $vars["pension"]->consultPensionWhere("mes=8 AND matricula = " . $item['id'] . "");
            if ($pension_actual["estado"] == "Cancelado") {
                echo $pension_actual["estado"];
            } else {
                echo "Debe";
            }
            ?>
        </td>
        <td style="text-align: center">
            <?php
            $pension_actual = $vars["pension"]->consultPensionWhere("mes=9 AND matricula = " . $item['id'] . "");
            if ($pension_actual["estado"] == "Cancelado") {
                echo $pension_actual["estado"];
            } else {
                echo "Debe";
            }
            ?>
        </td>
        <td style="text-align: center">
            <?php
            $pension_actual = $vars["pension"]->consultPensionWhere("mes=10 AND matricula = " . $item['id'] . "");
            if ($pension_actual["estado"] == "Cancelado") {
                echo $pension_actual["estado"];
            } else {
                echo "Debe";
            }
            ?>
        </td>
        <td style="text-align: center">
            <?php
            $pension_actual = $vars["pension"]->consultPensionWhere("mes=11 AND matricula = " . $item['id'] . "");
            if ($pension_actual["estado"] == "Cancelado") {
                echo $pension_actual["estado"];
            } else {
                echo "Debe";
            }
            ?>
        </td>
    </tr>
    <?php
    $i++;
}
?>
</tbody>    
</table>