<?php
$controlador = "Banner";
$accion = "banner";
$titulo = "Banner";
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
                        Pagina
                        <small>Banneres del sistema</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php?controlador=Index&accion=index"><i class="fa fa-home"></i> Inicio</a></li>
                        <li>Pagina</li>
                        <li class="active">Banner del sistema</li>
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
                                            <label class="col-sm-2 control-label" for="seccion">Categoria</label>
                                            <div class="col-sm-10">
                                                <?php $vars["formXhtml"]->select("seccion", "seccion", $vars["arrayRegistro"]["seccion"], "form-control", "Categoria", "", "seccion", "id", "nombre", "", "1", " nombre ASC"); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="articulo">Articulo</label>
                                            <div class="col-sm-10">
                                                <?php $vars["formXhtml"]->select("articulo", "articulo", $vars["arrayRegistro"]["articulo"], "form-control", "Articulo", "", "articulo", "id", "nombre", "", "1", " nombre ASC"); ?>
                                            </div>
                                        </div>                                        
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="nombre">Nombre</label>
                                            <div class="col-sm-10">
                                                <?php $vars["formXhtml"]->inputtext("text", "nombre", "nombre", $vars["arrayRegistro"]["nombre"], "validar form-control", "Nombre"); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="nombre_segundo">Segundo Nombre</label>
                                            <div class="col-sm-10">
                                                <?php $vars["formXhtml"]->inputtext("text", "nombre_segundo", "nombre_segundo", $vars["arrayRegistro"]["nombre_segundo"], "validar form-control", "Nombre Segundo"); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="descripcion">Descripción</label>
                                            <div class="col-sm-10">
                                                <?php $vars["formXhtml"]->textarea("descripcion", "descripcion", $vars["arrayRegistro"]["descripcion"], "form-control", "Descripción Padre");?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="url">Url</label>
                                            <div class="col-sm-10">
                                                <?php $vars["formXhtml"]->inputtext("text", "url", "url", $vars["arrayRegistro"]["url"], "form-control", "Url"); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="orden">Orden</label>
                                            <div class="col-sm-10">
                                                <?php $vars["formXhtml"]->inputtext("text", "orden", "orden", $vars["arrayRegistro"]["orden"], "validar numeric form-control", "Orden"); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="ubicacion">Ubicación</label>
                                            <div class="col-sm-10">                                                
                                                <?php $vars["formXhtml"]->select("ubicacion", "ubicacion", $vars["arrayRegistro"]["ubicacion"],"form-control", "Ubicación", "", "", "", "", "", "", "", array("Logo" => "Logo", "Informativo" => "Informativo", "Animacion" => "Animacion", "Derecho" => "Derecho", "Medio" => "Medio", "Centro" => "Centro", "Inferior" => "Inferior", "AnimacionInferior" => "Animacion Inferior"))?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="activar">Activar?</label>
                                            <div class="col-sm-10">
                                                <?php $vars["formXhtml"]->radio("activo", "activo", $vars["arrayRegistro"]["activo"], "", "Activar?", "", array("1" => "Si", "0" => "No")); ?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="archivo">Foto Banner</label>
                                            <div class="col-sm-10">
                                                <?php $vars["formXhtml"]->inputfile("archivo", "archivo", "archivo", $vars["arrayRegistro"]["archivo"], "form-control", "Foto Perfil","border:none !important;padding:0px !important","dist/img/banner/"); ?>
                                            </div>                                            
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="archivo2">Segunda Foto Banner</label>
                                            <div class="col-sm-10">
                                                <?php $vars["formXhtml"]->inputfile("archivo2", "archivo2", "archivo2", $vars["arrayRegistro"]["archivo2"], "form-control", "Segunda Foto Banner","border:none !important;padding:0px !important","dist/img/banner/"); ?>
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
                                            <label class="col-sm-2 control-label" for="seccion">Categoria</label>
                                            <div class="col-sm-10">
                                                <?php $vars["formXhtml"]->select("seccion", "seccion", $vars["arrayRegistro"]["seccion"], "form-control", "Categoria", "", "seccion", "id", "nombre", "", "1", " nombre ASC"); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="articulo">Articulo</label>
                                            <div class="col-sm-10">
                                                <?php $vars["formXhtml"]->select("articulo", "articulo", $vars["arrayRegistro"]["articulo"], "form-control", "Articulo", "", "articulo", "id", "nombre", "", "1", " nombre ASC"); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="ubicacion">Ubicación</label>
                                            <div class="col-sm-10">                                                
                                                <?php $vars["formXhtml"]->select("ubicacion", "ubicacion", $vars["arrayRegistro"]["ubicacion"],"form-control", "Ubicación", "", "", "", "", "", "", "", array("Logo" => "Logo", "Superior" => "Superior", "Informativo" => "Informativo", "Animacion" => "Animacion", "Derecho" => "Derecho", "Medio" => "Medio", "Centro" => "Centro", "Inferior" => "Inferior", "AnimacionInferior" => "Animacion Inferior"))?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="nombre">Nombre</label>
                                            <div class="col-sm-10">
                                                <?php $vars["formXhtml"]->inputtext("text", "nombre", "nombre", $vars["arrayRegistro"]["nombre"], "validar form-control", "Nombre"); ?>
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
                                    <h3 class="box-title">Banneres registrados en el Sistema</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Categoria</th>
                                                <th>Articulo</th>
                                                <th>Ubicacion</th>
                                                <th>Nombre</th>
                                                <th>Orden</th>
                                                <th>Activo</th>
                                                <th>Editar</th>
                                            </tr>
                                            <?php
                                            foreach($vars["arrayPaginador"] as $item) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $item['seccion']; ?></td>
                                                    <td><?php echo $item['articulo']; ?></td>
                                                    <td><?php echo $item['ubicacion']; ?></td>
                                                    <td><?php echo $item['nombre']; ?></td>
                                                    <td><?php echo $item['orden']; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($item["activo"]) {
                                                            ?>
                                                            <a href="index.php?controlador=<?php echo $controlador; ?>&accion=banner&id=<?php echo $item['id']; ?>&a=0"><span class="fa fa-plus-circle"/></a>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <a href="index.php?controlador=<?php echo $controlador; ?>&accion=banner&id=<?php echo $item['id']; ?>&a=1"><span class="fa fa-times"/></a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><a href="index.php?controlador=<?php echo $controlador; ?>&accion=editarRegistro&id=<?php echo $item['id']; ?>"><span class="fa fa-pencil-square-o"/> </a></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>    
                                    </table>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer clearfix">
                                    <ul class="pagination pagination-sm no-margin pull-right">
                                        <?php
                                            echo $vars["paginador"]->pages("btn");
                                            ?>
                                    </ul>
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
                        <h4><i class="icon fa fa-info"></i> No tienen permisos para ingresar a este banner!</h4>
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