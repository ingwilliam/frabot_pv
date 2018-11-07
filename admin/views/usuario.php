<?php
$controlador = "Usuario";
$accion = "usuario";
$titulo = "Usuario";
?>
<!DOCTYPE html>
<html>
    <head>
        <?php
        include 'include/head.php';
        ?>
        <style>
            .divCheckBuscador{
                border: solid 2px #F39C12;
                padding: 10px;
                width: 100%;
                height: 200px;
                overflow: scroll;
                overflow-x: hidden;
            }

            .divCheckBuscador .divItemCheck{
                width: 150px;
                height: auto;    
                float: left;
            }
        </style>
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
                            Seguridad
                            <small>Usuarios del sistema</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li><a href="index.php?controlador=Index&accion=index"><i class="fa fa-home"></i> Inicio</a></li>
                            <li>Seguridad</li>
                            <li class="active">Usuarios del sistema</li>
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
                                <?php
                                if ($vars["accion"] == "editar") {
                                    ?>
                                    <div class="col-md-6">
                                        <?php
                                    }
                                    ?>
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
                                                    <label class="col-sm-2 control-label" for="tipo_documento">Tipo de documento</label>
                                                    <div class="col-sm-10">
                                                        <?php $vars["formXhtml"]->select("tipo_documento", "tipo_documento", $vars["arrayRegistro"]["tipo_documento"], "validar form-control", "Tipo de Documento", "", "tipo_documento", "id", "nombre", "", "1", " nombre ASC"); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="numero_documento">Numero de documento</label>
                                                    <div class="col-sm-10">
                                                        <?php $vars["formXhtml"]->inputtext("text", "numero_documento", "numero_documento", $vars["arrayRegistro"]["numero_documento"], "validar form-control numeric", "Numero de documento"); ?>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="primer_nombre">Primer nombre</label>
                                                    <div class="col-sm-10">
                                                        <?php $vars["formXhtml"]->inputtext("text", "primer_nombre", "primer_nombre", $vars["arrayRegistro"]["primer_nombre"], "validar form-control", "Primer nombre"); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="segundo_nombre">Segundo nombre</label>
                                                    <div class="col-sm-10">
                                                        <?php $vars["formXhtml"]->inputtext("text", "segundo_nombre", "segundo_nombre", $vars["arrayRegistro"]["segundo_nombre"], "form-control", "Segundo nombre"); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="primer_apellido">Primer apellido</label>
                                                    <div class="col-sm-10">
                                                        <?php $vars["formXhtml"]->inputtext("text", "primer_apellido", "primer_apellido", $vars["arrayRegistro"]["primer_apellido"], "validar form-control", "Primer apellido"); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="segundo_apellido">Segundo apellido</label>
                                                    <div class="col-sm-10">
                                                        <?php $vars["formXhtml"]->inputtext("text", "segundo_apellido", "segundo_apellido", $vars["arrayRegistro"]["segundo_apellido"], "form-control", "Segundo apellido"); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="usuario">Usuario</label>
                                                    <div class="col-sm-10">
                                                        <?php $vars["formXhtml"]->inputtext("text", "usuario", "usuario", $vars["arrayRegistro"]["usuario"], "validar form-control email", "Email"); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="clave">Clave</label>
                                                    <div class="col-sm-10">
                                                        <?php $vars["formXhtml"]->inputtext("password", "clave", "clave", $vars["arrayRegistro"]["clave"], "form-control", "Clave"); ?>
                                                    </div>
                                                </div>                                                
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="fecha_nacimiento">Fecha de nacimiento</label>
                                                    <div class="col-sm-10">
                                                        <?php $vars["formXhtml"]->inputtext("text", "fecha_nacimiento", "fecha_nacimiento", $vars["arrayRegistro"]["fecha_nacimiento"], "validar form-control calendario", "Fecha de nacimiento", "", "", "", "", "", "", true); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="celular">Numero de celular</label>
                                                    <div class="col-sm-10">
                                                        <?php $vars["formXhtml"]->inputtext("text", "celular", "celular", $vars["arrayRegistro"]["celular"], "validar numeric form-control", "Numero de celular"); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="telefono">Telefono</label>
                                                    <div class="col-sm-10">
                                                        <?php $vars["formXhtml"]->inputtext("text", "telefono", "telefono", $vars["arrayRegistro"]["telefono"], "validar numeric form-control", "Telefono"); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="ubicacion">Dirección de residencia</label>
                                                    <div class="col-sm-10">
                                                        <?php $vars["formXhtml"]->inputtext("text", "ubicacion", "ubicacion", $vars["arrayRegistro"]["ubicacion"], "validar form-control", "Dirección de residencia"); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="barrio">Barrio</label>
                                                    <div class="col-sm-10">
                                                        <?php $vars["formXhtml"]->select("barrio", "barrio", $vars["arrayRegistro"]["barrio"], "validar form-control", "Barrio", "", "barrio", "id", "nombre", "localidad", "1", " nombre ASC"); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="ciudad_ubicacion">Ciudad de Ubicacion</label>
                                                    <div class="col-sm-10">
                                                        <?php $vars["formXhtml"]->selectExtra("ciudad_ubicacion", "ciudad_ubicacion", $vars["arrayRegistro"]["ciudad_ubicacion"], "validar form-control", "Ciudad de nacimiento", "", "ciudad", "id", "nombre", "nombre", "1", " ciudad.nombre ASC", array(), "", ":: Seleccione ::", "", "departamento"); ?>
                                                    </div>    
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="activar">Activar?</label>
                                                    <div class="col-sm-10">
                                                        <?php $vars["formXhtml"]->radio("activo", "activo", $vars["arrayRegistro"]["activo"], "", "Activar?", "", array("1" => "Si", "0" => "No")); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="archivo">Foto Perfil</label>
                                                    <div class="col-sm-10">
                                                        <?php $vars["formXhtml"]->inputfile("archivo", "archivo", "archivo", $vars["arrayRegistro"]["archivo"], "form-control", "Foto Perfil","border:none !important;padding:0px !important","dist/img/usuario/"); ?>
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
                                    <?php
                                    if ($vars["accion"] == "editar") {
                                        ?>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- general form elements disabled -->
                                        <div class="box box-warning">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Perfiles</h3>
                                            </div>
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <form role="form" class="form-validar form-horizontal" action="index.php?controlador=<?php echo $controlador; ?>&accion=nuevoPerfil&id=<?php echo $vars["arrayRegistro"]["id"]; ?>" method="post" class="formvalidar" enctype="multipart/form-data">
                                                    <?php $vars["formXhtml"]->divCheckBuscador("perfil", "id", "activo=1", "nombre", "nombre", "Perfil", "buscarPerfil", $vars["arrayPerfiles"], "usuario", "perfil", $vars["arrayRegistro"]["id"]); ?>
                                                    <div class="box-footer">
                                                        <button class="btn btn-info pull-right" type="submit">Guardar</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.box -->
                                    </div>
                                    <?php
                                }
                                ?>
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
                                                <label class="col-sm-2 control-label" for="tipo_documento">Tipo de Documento</label>
                                                <div class="col-sm-10">
                                                    <?php $vars["formXhtml"]->select("tipo_documento", "tipo_documento", $vars["arrayRegistro"]["tipo_documento"], "validar form-control", "Tipo de Documento", "", "tipo_documento", "id", "nombre", "", "1", " nombre ASC"); ?>                                                
                                                </div>                                            
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="numero_documento">Numero de documento</label>
                                                <div class="col-sm-10">
                                                    <?php $vars["formXhtml"]->inputtext("text", "numero_documento", "numero_documento", $vars["arrayRegistro"]["numero_documento"], "validar form-control numeric", "Numero de documento"); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="primer_nombre">Primer nombre</label>
                                                <div class="col-sm-10">
                                                    <?php $vars["formXhtml"]->inputtext("text", "primer_nombre", "primer_nombre", $vars["arrayRegistro"]["primer_nombre"], "validar form-control", "Primer nombre"); ?>
                                                </div>
                                            </div>                                        
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="primer_apellido">Primer apellido</label>
                                                <div class="col-sm-10">
                                                    <?php $vars["formXhtml"]->inputtext("text", "primer_apellido", "primer_apellido", $vars["arrayRegistro"]["primer_apellido"], "validar form-control", "Primer apellido"); ?>
                                                </div>                                            
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label" for="perfil">Perfil</label>
                                                <div class="col-sm-10">
                                                    <?php $vars["formXhtml"]->select("perfil", "perfil", $vars["arrayRegistro"]["perfil"], "validar form-control", "Perfil", "", "perfil", "id", "nombre", "", "1", " nombre ASC"); ?>                                                
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
                                        <h3 class="box-title">Usuarios registrados en el Sistema</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th>Usuario Registro</th>
                                                    <th>Fecha Registro</th>                                                    
                                                    <th>Tipo de Documento</th>
                                                    <th>Numero de Documento</th>
                                                    <th>Nombres</th>
                                                    <th>Apellidos</th>
                                                    <th>Usuario</th>
                                                    <th>Activo</th>
                                                    <th>Editar</th>
                                                </tr>
                                                <?php
                                                foreach($vars["arrayPaginador"] as $item) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $item['usuario_crear']; ?></td>
                                                        <td><?php echo $item['fecha_crear']; ?></td>                                                        
                                                        <td><?php echo utf8_encode($item['tipo_documento']); ?></td>
                                                        <td><?php echo $item['numero_documento']; ?></td>
                                                        <td><?php echo $item['primer_nombre'] . " " . $item['segundo_nombre']; ?></td>
                                                        <td><?php echo $item['primer_apellido'] . " " . $item['segundo_apellido']; ?></td>
                                                        <td><?php echo $item['usuario']; ?></td>
                                                        <td>
                                                            <?php
                                                            if ($item["activo"]) {
                                                                ?>
                                                                <a href="index.php?controlador=<?php echo $controlador; ?>&accion=usuario&id=<?php echo $item['id']; ?>&a=0"><span class="fa fa-plus-circle"/></a>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <a href="index.php?controlador=<?php echo $controlador; ?>&accion=usuario&id=<?php echo $item['id']; ?>&a=1"><span class="fa fa-times"/></a>
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