<?php
$controlador = "Pension";
$accion = "index";
$titulo = "Pensiones";
?>
<!DOCTYPE html>
<html>
    <head>
        <?php
        include 'include/head.php';
        ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">

        <div class="wrapper">

            <header class="main-header">
                <?php
                include 'include/header.php';
                ?>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <?php
                include 'include/sidebar.php';
                ?>
            </aside>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <?php
                if (count($vars["arrayPermiso"]) > 0) {
                    ?>                
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <h1>
                            Directivos
                            <small>Pensiones del sistema</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li><a href="index.php?controlador=Index&accion=index"><i class="fa fa-home"></i> Inicio</a></li>
                            <li>Directivos</li>
                            <li class="active">Pensiones del sistema</li>
                        </ol>
                    </section>

                    <!-- Main content -->
                    <section class="content">
                        <?php
                        if ($vars["alerta"] == 1) {
                            ?>
                            <div class="alert alert-success alert-dismissible">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <h4><i class="icon fa fa-check"></i> Exitoso!</h4>
                                Registro creado.
                            </div>
                            <?php
                        }
                        if ($vars["alerta"] == 2) {
                            ?>
                            <div class="alert alert-info alert-dismissible">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <h4><i class="icon fa fa-info"></i> Exitoso!</h4>
                                Registro editado.
                            </div>
                            <?php
                        }
                        if ($vars["alerta"] == 3) {
                            ?>
                            <div class="alert alert-danger alert-dismissible">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                <?php echo $vars["error"] ?>
                            </div>                        
                            <?php
                        }
                        ?>                       
                        <div class="row">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Buscador</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form class="form-horizontal" action="index.php" method="get">
                                    <input type="hidden" name="controlador" value="<?php echo $controlador; ?>" />
                                    <input type="hidden" name="accion" value="<?php echo $accion; ?>" />
                                    <input type="hidden" name="busqueda" value="1" />
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="anio_matricula">Año matricula</label>
                                            <div class="col-sm-10">
                                                <?php $vars["formXhtml"]->select("anio", "anio", $vars["arrayRegistro"]["anio"], "validar form-control", "Año matricula", "", "", "", "", "", "", "", $vars["anios"]); ?>                                                
                                            </div>                                            
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="curso">Grado</label>
                                            <div class="col-sm-10">
                                                <?php $vars["formXhtml"]->select("curso", "curso", $vars["arrayRegistro"]["curso"], "validar form-control", "Grado", "", "curso", "id", "nombre", "", "1", " nombre ASC"); ?>                                                
                                            </div>                                            
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-info">Realizar busqueda</button>
                                        <button type="button" class="btn btn-primary" onclick="location.href = 'index.php?controlador=<?php echo $controlador; ?>&accion=<?php echo $accion; ?>'">Limpiar busqueda</button>
                                    </div>
                                    <!-- /.box-footer -->
                                </form>
                            </div>
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">El Sistema muestra solo las matriculas con estado <b>Matriculado</b></h3>
                                </div>
                                
                                <a target="_blank" style="font-size: 19px;text-decoration: none;color: red; float: right" href="index.php?controlador=Pension&accion=exportarMorosos&anio=<?php echo $vars["arrayRegistro"]["anio"];?>&curso=<?php echo $vars["arrayRegistro"]["curso"];?>" class="botonExcel"><img src="dist/img/clock.png" style="float: left;" /> Exportar Mosoros</a>                                
                                <div style="clear: both"></div>
                                <?php
                                if ($_GET["alerta"] == 1) {
                                    ?>
                                    <div class="alert alert-success alert-dismissible">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        <h4><i class="icon fa fa-check"></i> Exitoso!</h4>
                                        La pension se modifico correctamente.
                                    </div>
                                    <?php
                                }
                                ?>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table class="tabla_planilla" width="100%" border="1" cellpadding="0" cellspacing="0">
                                        <tbody >
                                            <tr>
                                                <td colspan="19" bgcolor="#E6E6FA">
                                        <center>                                            
                                            <b>AÑO:</b> <?php echo $vars["arrayRegistro"]["anio"]; ?> 
                                            <b>GRADO:</b> <?php echo $vars["arrayPaginador"][0]["curso"]; ?>
                                        </center>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#BDBDBD"><center>N°</center></th>
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
                                        <td bgcolor="#BDBDBD"><center>TOTAL</center></td>                                                                                                                                                        
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
                                                <td><?php echo strtoupper($item['primer_apellido']." ".$item['segundo_apellido']." ".$item['primer_nombre']." ".$item['segundo_nombre']); ?></td>                                                        
                                                <td style="text-align: center">
                                                    <?php
                                                    $pension_actual = $vars["pension"]->consultPensionWhere("mes=2 AND matricula = " . $item['id'] . "");
                                                    ?>                                                        
                                                    <input type="hidden" class="estado2<?php echo $item['id']; ?>" value="<?php echo $pension_actual["estado"]; ?>" />
                                                    <input type="hidden" class="observaciones2<?php echo $item['id']; ?>" value="<?php echo $pension_actual["observaciones"]; ?>" />
                                                    <button title="<?php echo $item['id']; ?>" dir="2"  data-toggle="modal" data-target="#opciones_pension" type="button" class="mod_pension">
                                                        <?php
                                                        if ($pension_actual["estado"] == "Cancelado") {
                                                            $canceladas++;
                                                            
                                                            $total_2= $total_2 + $item['valor_pension'];
                                                            ?>
                                                            <img src="dist/img/checked.png" alt=""/>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <img src="dist/img/delete.png" alt=""/>
                                                            <?php
                                                        }
                                                        ?>
                                                    </button>
                                                </td>
                                                <td style="text-align: center">
                                                    <?php
                                                    $pension_actual = $vars["pension"]->consultPensionWhere("mes=3 AND matricula = " . $item['id'] . "");
                                                    ?>                                                        
                                                    <input type="hidden" class="estado3<?php echo $item['id']; ?>" value="<?php echo $pension_actual["estado"]; ?>" />
                                                    <input type="hidden" class="observaciones3<?php echo $item['id']; ?>" value="<?php echo $pension_actual["observaciones"]; ?>" />
                                                    <button title="<?php echo $item['id']; ?>" dir="3"  data-toggle="modal" data-target="#opciones_pension" type="button" class="mod_pension">
                                                        <?php
                                                        if ($pension_actual["estado"] == "Cancelado") {
                                                            $canceladas++;
                                                            $total_3= $total_3 + $item['valor_pension'];
                                                            ?>
                                                            <img src="dist/img/checked.png" alt=""/>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <img src="dist/img/delete.png" alt=""/>
                                                            <?php
                                                        }
                                                        ?>
                                                    </button>
                                                </td>
                                                <td style="text-align: center">
                                                    <?php
                                                    $pension_actual = $vars["pension"]->consultPensionWhere("mes=4 AND matricula = " . $item['id'] . "");
                                                    ?>                                                        
                                                    <input type="hidden" class="estado4<?php echo $item['id']; ?>" value="<?php echo $pension_actual["estado"]; ?>" />
                                                    <input type="hidden" class="observaciones4<?php echo $item['id']; ?>" value="<?php echo $pension_actual["observaciones"]; ?>" />
                                                    <button title="<?php echo $item['id']; ?>" dir="4" data-toggle="modal" data-target="#opciones_pension" type="button" class="mod_pension">
                                                        <?php
                                                        if ($pension_actual["estado"] == "Cancelado") {
                                                            $canceladas++;
                                                            $total_4= $total_4 + $item['valor_pension'];
                                                            ?>
                                                            <img src="dist/img/checked.png" alt=""/>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <img src="dist/img/delete.png" alt=""/>
                                                            <?php
                                                        }
                                                        ?>
                                                    </button>
                                                </td>
                                                <td style="text-align: center">
                                                    <?php
                                                    $pension_actual = $vars["pension"]->consultPensionWhere("mes=5 AND matricula = " . $item['id'] . "");
                                                    ?>                                                        
                                                    <input type="hidden" class="estado5<?php echo $item['id']; ?>" value="<?php echo $pension_actual["estado"]; ?>" />
                                                    <input type="hidden" class="observaciones5<?php echo $item['id']; ?>" value="<?php echo $pension_actual["observaciones"]; ?>" />
                                                    <button title="<?php echo $item['id']; ?>" dir="5"  data-toggle="modal" data-target="#opciones_pension" type="button" class="mod_pension">
                                                        <?php
                                                        if ($pension_actual["estado"] == "Cancelado") {
                                                            $canceladas++;
                                                            $total_5= $total_5 + $item['valor_pension'];
                                                            ?>
                                                            <img src="dist/img/checked.png" alt=""/>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <img src="dist/img/delete.png" alt=""/>
                                                            <?php
                                                        }
                                                        ?>
                                                    </button>
                                                </td>
                                                <td style="text-align: center">
                                                    <?php
                                                    $pension_actual = $vars["pension"]->consultPensionWhere("mes=6 AND matricula = " . $item['id'] . "");
                                                    ?>                                                        
                                                    <input type="hidden" class="estado6<?php echo $item['id']; ?>" value="<?php echo $pension_actual["estado"]; ?>" />
                                                    <input type="hidden" class="observaciones6<?php echo $item['id']; ?>" value="<?php echo $pension_actual["observaciones"]; ?>" />
                                                    <button title="<?php echo $item['id']; ?>" dir="6"  data-toggle="modal" data-target="#opciones_pension" type="button" class="mod_pension">
                                                        <?php
                                                        if ($pension_actual["estado"] == "Cancelado") {
                                                            $canceladas++;
                                                            $total_6= $total_6 + $item['valor_pension'];
                                                            ?>
                                                            <img src="dist/img/checked.png" alt=""/>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <img src="dist/img/delete.png" alt=""/>
                                                            <?php
                                                        }
                                                        ?>
                                                    </button>
                                                </td>
                                                <td style="text-align: center">
                                                    <?php
                                                    $pension_actual = $vars["pension"]->consultPensionWhere("mes=7 AND matricula = " . $item['id'] . "");
                                                    ?>                                                        
                                                    <input type="hidden" class="estado7<?php echo $item['id']; ?>" value="<?php echo $pension_actual["estado"]; ?>" />
                                                    <input type="hidden" class="observaciones7<?php echo $item['id']; ?>" value="<?php echo $pension_actual["observaciones"]; ?>" />
                                                    <button title="<?php echo $item['id']; ?>" dir="7"  data-toggle="modal" data-target="#opciones_pension" type="button" class="mod_pension">
                                                        <?php
                                                        if ($pension_actual["estado"] == "Cancelado") {
                                                            $canceladas++;
                                                            $total_7= $total_7 + $item['valor_pension'];
                                                            ?>
                                                            <img src="dist/img/checked.png" alt=""/>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <img src="dist/img/delete.png" alt=""/>
                                                            <?php
                                                        }
                                                        ?>
                                                    </button>
                                                </td>
                                                <td style="text-align: center">
                                                    <?php
                                                    $pension_actual = $vars["pension"]->consultPensionWhere("mes=8 AND matricula = " . $item['id'] . "");
                                                    ?>                                                        
                                                    <input type="hidden" class="estado8<?php echo $item['id']; ?>" value="<?php echo $pension_actual["estado"]; ?>" />
                                                    <input type="hidden" class="observaciones8<?php echo $item['id']; ?>" value="<?php echo $pension_actual["observaciones"]; ?>" />
                                                    <button title="<?php echo $item['id']; ?>" dir="8"  data-toggle="modal" data-target="#opciones_pension" type="button" class="mod_pension">
                                                        <?php
                                                        if ($pension_actual["estado"] == "Cancelado") {
                                                            $canceladas++;
                                                            $total_8= $total_8 + $item['valor_pension'];
                                                            ?>
                                                            <img src="dist/img/checked.png" alt=""/>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <img src="dist/img/delete.png" alt=""/>
                                                            <?php
                                                        }
                                                        ?>
                                                    </button>
                                                </td>
                                                <td style="text-align: center">
                                                    <?php
                                                    $pension_actual = $vars["pension"]->consultPensionWhere("mes=9 AND matricula = " . $item['id'] . "");
                                                    ?>                                                        
                                                    <input type="hidden" class="estado9<?php echo $item['id']; ?>" value="<?php echo $pension_actual["estado"]; ?>" />
                                                    <input type="hidden" class="observaciones9<?php echo $item['id']; ?>" value="<?php echo $pension_actual["observaciones"]; ?>" />
                                                    <button title="<?php echo $item['id']; ?>" dir="9"  data-toggle="modal" data-target="#opciones_pension" type="button" class="mod_pension">
                                                        <?php
                                                        if ($pension_actual["estado"] == "Cancelado") {
                                                            $canceladas++;
                                                            $total_9= $total_9 + $item['valor_pension'];
                                                            ?>
                                                            <img src="dist/img/checked.png" alt=""/>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <img src="dist/img/delete.png" alt=""/>
                                                            <?php
                                                        }
                                                        ?>
                                                    </button>
                                                </td>
                                                <td style="text-align: center">
                                                    <?php
                                                    $pension_actual = $vars["pension"]->consultPensionWhere("mes=10 AND matricula = " . $item['id'] . "");
                                                    ?>                                                        
                                                    <input type="hidden" class="estado10<?php echo $item['id']; ?>" value="<?php echo $pension_actual["estado"]; ?>" />
                                                    <input type="hidden" class="observaciones10<?php echo $item['id']; ?>" value="<?php echo $pension_actual["observaciones"]; ?>" />
                                                    <button title="<?php echo $item['id']; ?>" dir="10"  data-toggle="modal" data-target="#opciones_pension" type="button" class="mod_pension">
                                                        <?php
                                                        if ($pension_actual["estado"] == "Cancelado") {
                                                            $canceladas++;
                                                            $total_10= $total_10 + $item['valor_pension'];
                                                            ?>
                                                            <img src="dist/img/checked.png" alt=""/>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <img src="dist/img/delete.png" alt=""/>
                                                            <?php
                                                        }
                                                        ?>
                                                    </button>
                                                </td>
                                                <td style="text-align: center">
                                                    <?php
                                                    $pension_actual = $vars["pension"]->consultPensionWhere("mes=11 AND matricula = " . $item['id'] . "");
                                                    ?>                                                        
                                                    <input type="hidden" class="estado11<?php echo $item['id']; ?>" value="<?php echo $pension_actual["estado"]; ?>" />
                                                    <input type="hidden" class="observaciones11<?php echo $item['id']; ?>" value="<?php echo $pension_actual["observaciones"]; ?>" />
                                                    <button title="<?php echo $item['id']; ?>" dir="11"  data-toggle="modal" data-target="#opciones_pension" type="button" class="mod_pension">
                                                        <?php
                                                        if ($pension_actual["estado"] == "Cancelado") {
                                                            $canceladas++;
                                                            $total_11= $total_11 + $item['valor_pension'];
                                                            ?>
                                                            <img src="dist/img/checked.png" alt=""/>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <img src="dist/img/delete.png" alt=""/>
                                                            <?php
                                                        }
                                                        ?>
                                                    </button>
                                                </td>
                                                <td>
                                                    $<?php echo number_format($item['valor_pension'] * $canceladas); ?>
                                                    <?php
                                                        $total_suma= $total_suma + ($item['valor_pension'] * $canceladas);
                                                    ?>
                                                </td>

                                            </tr>
                                            <?php
                                            $i++;
                                        }
                                        ?>
                                            <tr>
                                                <td colspan="2" style="text-align: right;font-weight: bold">Total</td>
                                                <td>$<?php echo number_format($total_2);?></td>
                                                <td>$<?php echo number_format($total_3);?></td>
                                                <td>$<?php echo number_format($total_4);?></td>
                                                <td>$<?php echo number_format($total_5);?></td>
                                                <td>$<?php echo number_format($total_6);?></td>
                                                <td>$<?php echo number_format($total_7);?></td>
                                                <td>$<?php echo number_format($total_8);?></td>
                                                <td>$<?php echo number_format($total_9);?></td>
                                                <td>$<?php echo number_format($total_10);?></td>
                                                <td>$<?php echo number_format($total_11);?></td>
                                                <td>$<?php echo number_format($total_suma);?></td>                                                
                                            </tr>
                                        </tbody>    
                                    </table>
                                    <!-- Modal -->
                                    <div class="modal fade" id="opciones_pension" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <form class="form-validar form-horizontal" action="index.php?controlador=<?php echo $controlador; ?>&accion=guardar" method="post" enctype="multipart/form-data">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Modificar pensión del estudiante</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label" for="estado">Estado</label>
                                                            <div class="col-sm-10">
                                                                <?php $vars["formXhtml"]->radio("estado", "estado", "Pendiente", "", "Estado de matricula", "", array("Cancelado" => "Cancelado", "Pendiente" => "Pendiente")); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label" for="observaciones">Observaciones</label>
                                                            <div class="col-sm-10">
                                                                <?php $vars["formXhtml"]->textarea("observaciones", "observaciones", "", "form-control", "Observaciones"); ?>
                                                            </div>
                                                        </div>
                                                        <div id="nota_observaciones" class="form-group" style="padding: 0px 15px">                                                                
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" value="" id="matricula" name="matricula" />
                                                        <input type="hidden" value="" id="mes" name="mes" />
                                                        <input type="hidden" value="<?php echo $_GET["anio"]; ?>" id="anio" name="anio" />
                                                        <input type="hidden" value="<?php echo $_GET["curso"]; ?>" id="curso" name="curso" />
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary">Guardar Estado</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>                                                                         
                            </div>
                        </div>
                        <!-- /.row -->                        
                    </section>
                    <!-- /.content -->
                    <?php
                } else {
                    ?>
                    <br/>
                    <div class="alert alert-info alert-dismissible">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <h4><i class="icon fa fa-info"></i> No tienen permisos para ingresar a este modulo!</h4>
                        Comunicarse con el administrador del sistema
                    </div>
                    <?php
                }
                ?>
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <?php
                include 'include/footer-main.php';
                ?>
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <?php
                include 'include/control-sidebar.php';
                ?>
            </aside>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->
        <?php
        include 'include/footer.php';
        ?>
    </body>
</html>