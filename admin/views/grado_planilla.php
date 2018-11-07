<?php
$controlador = "Planilla";
$accion = "planilla_grado";
$titulo = "Grados";
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
                            Coodinadores
                            <small>Planillas del sistema</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li><a href="index.php?controlador=Index&accion=index"><i class="fa fa-home"></i> Inicio</a></li>
                            <li>Coodinadores</li>
                            <li class="active">Planillas del sistema</li>
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
                        <a href="index.php?controlador=<?php echo $controlador; ?>&accion=<?php echo $accion; ?>" class="btn btn-app"><i class="fa fa-list"></i>Listar</a>
                        <a href="index.php?controlador=<?php echo $controlador; ?>&accion=nuevo" class="btn btn-app"><i class="fa fa-file-o"></i>Nuevo</a>
                        <?php
                        if ($vars["formularioNuevo"]) {
                            ?>
                            <div class="row">                            
                                <div class="box box-primary">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><?php echo $vars["tituloMetodo"]; ?> <?php echo $titulo; ?></h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <!-- form start -->
                                    <form class="form-validar form-horizontal" action="index.php?controlador=<?php echo $controlador; ?>&accion=<?php echo $vars["accion"]; ?>Registro" method="post" class="formvalidar" enctype="multipart/form-data">
                                        <div id="mensajevalida" class="alert alert-warning alert-dismissible" style="display: none">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                            <h4 style="font-size: 14px"><i class="icon fa fa-warning"></i>Los siguientes campos son obligatorios</h4>
                                            <ul>

                                            </ul>
                                        </div>

                                        <div class="box-body">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="nombre">Nombre</label>
                                                <div class="col-sm-10">
                                                    <?php $vars["formXhtml"]->inputtext("text", "nombre", "nombre", $vars["arrayRegistro"]["nombre"], "validar form-control", "Nombre"); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="activar">Activar?</label>
                                                <div class="col-sm-10">
                                                    <?php $vars["formXhtml"]->radio("activo", "activo", $vars["arrayRegistro"]["activo"], "", "Activar?", "", array("1" => "Si", "0" => "No")); ?>
                                                </div>
                                            </div>

                                        </div><!-- /.box-body -->

                                        <!-- /.box-body -->
                                        <div class="box-footer">
                                            <input type="hidden" id="id" name="id" value="<?php echo $vars["arrayRegistro"]["id"] ?>" />
                                            <button type="submit" class="btn btn-info">Guardar</button>
                                        </div>
                                        <!-- /.box-footer -->
                                    </form>
                                </div>
                            </div>
                            <?php
                        } else {
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
                                        <h3 class="box-title">El Sistema muestra solo las estudiantes con estado <b>Matriculado</b></h3>
                                    </div>                                    
                                    <form action="exp_exc.php" method="post" target="_blank" id="FormularioExportacion">
                                        <a style="font-size: 19px;text-decoration: none" href="javascript:void(0)" class="botonExcel"><img src="dist/img/excel.png" style="float: left;" /> Exportar</a>
                                        <input type="hidden" id="datos_a_enviar" name="table" />
                                        <input type="hidden" id="name" name="name" value="planilla_notas_<?php echo $vars["arrayRegistro"]["anio"];?>" />
                                    </form>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table class="tabla_planilla tabla_exportar" width="100%" border="1" cellpadding="0" cellspacing="0">
                                            <tbody >
                                                <tr>
                                                    <td colspan="17" bgcolor="#E6E6FA">
                                                        <center>                                            
                                                            <b>AÑO:</b> <?php echo $vars["arrayRegistro"]["anio"];?> 
                                                            <b>PLANILLA PERIODO:</b> ______________________
                                                            <b>ASIGNATURA:</b> ____________________________
                                                            <b>GRADO:</b> <?php echo $vars["arrayPaginador"][0]["curso"];?>
                                                        </center>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td rowspan="2" bgcolor="#BDBDBD"><center>N°</center></th>
                                                    <!--<td rowspan="2" bgcolor="#BDBDBD"><center>TIPO DOCUMENTO</center></td>
                                                    <td rowspan="2" bgcolor="#BDBDBD"><center>NUMERO DOCUMENTO</center></td>
                                                    -->
                                                    <td rowspan="2" bgcolor="#BDBDBD"><center>APELLIDOS Y NOMBRES</center></td>                                                                                                    
                                                    <td colspan="3" bgcolor="#BDBDBD"><center>EXPLORACIÓN</center></td>                                                                                                    
                                                    <td colspan="3" bgcolor="#BDBDBD"><center>INVESTIGACIÓN</center></td>                                                                                                    
                                                    <td colspan="8" bgcolor="#BDBDBD"><center>SÍNTESIS</center></td>                                                                                                    
                                                    <td rowspan="2" bgcolor="#BDBDBD"><center>FALLAS</center></td>                                                                                                                                                        
                                                </tr>
                                                <tr>
                                                    <td bgcolor="#BDBDBD"><center>TAREAS</center></td>                                                                                                    
                                                    <td bgcolor="#BDBDBD"><center>CUADERNO</center></td>                                                                                                    
                                                    <td bgcolor="#BDBDBD"><center>PARTICIPACIÓN</center></td>                                                                                                                                                                                                                                                                                                                
                                                    <td bgcolor="#BDBDBD"><center>TRABAJO INDIVIDUAL</center></td>                                                                                                    
                                                    <td bgcolor="#BDBDBD"><center>TRABAJO GRUPAL</center></td>                                                                                                    
                                                    <td bgcolor="#BDBDBD"><center>TALLERES</center></td>                                                                                                                                                                                                                                                                                                                
                                                    <td bgcolor="#BDBDBD" colspan="5"><center>EVALUACIÓN</center></td>                                                                                                    
                                                    <td bgcolor="#BDBDBD"><center>EXPOSICIÓN</center></td>                                                                                                    
                                                    <td bgcolor="#BDBDBD"><center>AUTOEVALUACIÓN</center></td>                                                                                                                                                                                                                                                                                                                
                                                    <td bgcolor="#BDBDBD"><center>DEFINITIVA</center></td>                                                                                                                                                                                                                                                                                                                
                                                </tr>
                                                <?php
                                                $i=1;
                                                foreach($vars["arrayPaginador"] as $clave => $item) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>                                                                                                                
                                                        <!--<td>?php echo strtoupper($item['tipo_documento']); ?></td>                                                                                                                
                                                        <td>?php echo $item['numero_documento']; ?></td>                                                                                                                
                                                        -->
                                                        <td><?php echo strtoupper($item['primer_apellido']." ".$item['segundo_apellido']." ".$item['primer_nombre']." ".$item['segundo_nombre']); ?></td>                                                        
                                                        <td></td>                                                                                                    
                                                        <td></td>                                                                                                    
                                                        <td></td>                                                                                                                                                                                                                                                                                                                
                                                        <td></td>                                                                                                    
                                                        <td></td>                                                                                                    
                                                        <td></td>                                                                                                                                                                                                                                                                                                                
                                                        <td style="width: 20px;"></td>
                                                        <td style="width: 20px;"></td>                                                                                                                                                                                                                                                                                                                
                                                        <td style="width: 20px;"></td>                                                                                                    
                                                        <td style="width: 20px;"></td>                                                                                                    
                                                        <td style="width: 20px;"></td>                                                                                                                                                                                                                                                                                                                
                                                        <td></td>                                                                                                                                                                                                                                                                                                                
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                }
                                                ?>
                                            </tbody>    
                                        </table>
                                    </div>                                                                         
                                </div>
                            </div>
                            <!-- /.row -->
                            <?php
                        }
                        ?>
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