<?php
$controlador = "Matricula";
$accion = "matricula";
$titulo = "Matricula";
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
                            <small>Matriculas del sistema</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li><a href="index.php?controlador=Index&accion=index"><i class="fa fa-home"></i> Inicio</a></li>
                            <li class="active">Matriculas del sistema</li>
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
                        if (isset($vars["estudiante"]) && $vars["accion"] != "editar") {
                            ?>
                            <div class="alert alert-success alert-dismissible">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <h4><i class="icon fa fa-check"></i> Datos importado correctamente!</h4>
                                Como es información importada por favor actualizar y confirmar con el padre de familia, los campos habilitados. <br/>
                                SI ALGUN DATO ESTA MAL SE DEBE ACTUALIZAR EN EL MODULO USUARIOS.
                            </div>
                            <?php
                        }
                        ?>


                        <a href="index.php?controlador=<?php echo $controlador; ?>&accion=<?php echo $accion; ?>" class="btn btn-app"><i class="fa fa-list"></i>Listar</a>
                        <a href="index.php?controlador=<?php echo $controlador; ?>&accion=nuevo" class="btn btn-app"><i class="fa fa-file-o"></i>Nuevo</a>
                        <?php
                        if ($vars["formularioNuevo"]) {
                            if ($vars["accion"] == "nuevoConfirmar") {
                                ?>
                                <div class="row">                            
                                    <div class="box box-danger">
                                        <div class="box-header with-border">
                                            <h3 class="box-title"><?php echo "Importar estudiante a la nueva " . $titulo; ?></h3>
                                        </div>
                                        <!-- /.box-header -->
                                        <!-- form start -->
                                        <form class="form-validar form-horizontal" action="index.php" method="get">
                                            <div id="mensajevalida" class="alert alert-warning alert-dismissible" style="display: none">
                                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                                <h4 style="font-size: 14px"><i class="icon fa fa-warning"></i>Los siguientes campos son obligatorios</h4>
                                                <ul>

                                                </ul>
                                            </div>
                                            <input type="hidden" name="controlador" value="<?php echo $controlador; ?>" />
                                            <input type="hidden" name="accion" value="nuevo" />
                                            <input type="hidden" name="busqueda" value="1" />
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="anio_matricula">Año matricula</label>
                                                    <div class="col-sm-10">
                                                        <?php $vars["formXhtml"]->select("anio", "anio", $vars["arrayRegistro"]["anio"], "form-control", "Año matricula", "", "", "", "", "", "", "", $vars["anios"]); ?>                                                
                                                    </div>                                            
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="curso">Grado</label>
                                                    <div class="col-sm-10">
                                                        <?php $vars["formXhtml"]->select("curso", "curso", $vars["arrayRegistro"]["curso"], "form-control", "Grado", "", "curso", "id", "nombre", "", "1", " nombre ASC"); ?>                                                
                                                    </div>                                            
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="numero_documento">Numero de documento</label>
                                                    <div class="col-sm-10">
                                                        <?php $vars["formXhtml"]->inputtext("text", "numero_documento", "numero_documento", $vars["arrayRegistro"]["numero_documento"], "validar form-control numeric", "Numero de documento"); ?>
                                                    </div>
                                                </div>                                           
                                            </div>
                                            <!-- /.box-body -->
                                            <div class="box-footer">
                                                <button type="submit" class="btn btn-danger">Buscar para importar</button>
                                                <button type="button" class="btn btn-warning" onclick="location.href = 'index.php?controlador=<?php echo $controlador; ?>&accion=nuevo'">Limpiar busqueda</button>
                                            </div>
                                            <!-- /.box-footer -->
                                        </form>
                                    </div>
                                    <?php
                                    if (isset($vars["paginador"])) {
                                        if ($vars["paginador"]->total == 0) {
                                            ?>
                                            <div class="box box-info">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">No hay estudiantes registrados con sus filtros</h3>
                                                </div>
                                                <!-- /.box-header -->
                                                <div class="box-body">
                                                    <button class="btn btn-block btn-info btn-lg" type="button" onclick="location.href = 'index.php?controlador=<?php echo $controlador; ?>&accion=registroConfirmado'">Crear nuevo estudiante</button>
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <div class="box box-info">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">Estudiantes encontrados para importar</h3>
                                                </div>
                                                <!-- /.box-header -->
                                                <div class="box-body">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <th>Usuario Registro</th>
                                                                <th>Fecha Registro</th>
                                                                <th>Año matricula</th>
                                                                <th>Grado</th>
                                                                <th>Tipo de Documento</th>
                                                                <th>Numero de Documento</th>
                                                                <th>Nombres</th>
                                                                <th>Apellidos</th>
                                                                <th>Matriculado?</th>
                                                                <th>Importar</th>
                                                            </tr>
                                                            <?php
                                                            foreach($vars["arrayPaginador"] as $item) {
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $item['usuario_crear']; ?></td>
                                                                    <td><?php echo $item['fecha_crear']; ?></td>
                                                                    <td><?php echo $item['anio']; ?></td>
                                                                    <td><?php echo $item['curso']; ?></td>
                                                                    <td><?php echo $item['tipo_documento']; ?></td>
                                                                    <td><?php echo $item['numero_documento']; ?></td>
                                                                    <td><?php echo $item['primer_nombre'] . " " . $item['segundo_nombre']; ?></td>
                                                                    <td><?php echo $item['primer_apellido'] . " " . $item['segundo_apellido']; ?></td>
                                                                    <td>
                                                                        <?php
                                                                        if ($item["activo"]) {
                                                                            echo "Si";
                                                                        } else {
                                                                            echo "No";
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td><a href="index.php?controlador=<?php echo $controlador; ?>&accion=registroConfirmado&id=<?php echo $item['id']; ?>&estudiante=<?php echo $item['usuario']; ?>"><span class="fa fa-pencil-square-o"/> </a></td>
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
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <?php
                            } else {
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
                                                        <label class="col-sm-2 control-label" for="anio_matricula">Año matricula</label>
                                                        <div class="col-sm-10">
                                                            <?php $vars["formXhtml"]->select("anio", "anio", $vars["arrayRegistro"]["anio"], "validar form-control", "Año matricula", "", "", "", "", "", "", "", $vars["anios"]); ?>                                                
                                                        </div>                                            
                                                    </div>
                                                    <?php
                                                    if($vars["dataUser"]["array_perfil"]["1"]||$vars["dataUser"]["array_perfil"]["2"])
                                                    {
                                                    ?>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="estado">Estado matricula</label>
                                                        <div class="col-sm-10">
                                                            <?php $vars["formXhtml"]->radio("estado", "estado", $vars["arrayRegistro"]["estado"], "", "Estado de matricula", "", array("Matriculado" => "Matriculado", "Revisado" => "Revisado", "Inscrito" => "Inscrito")); ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="valor_matricula">Valor matricula</label>
                                                        <div class="col-sm-10">
                                                            <?php $vars["formXhtml"]->inputtext("text", "valor_matricula", "valor_matricula", $vars["arrayRegistro"]["valor_matricula"], "validar numeric form-control", "Valor matricula"); ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="valor_pension">Valor pensión</label>
                                                        <div class="col-sm-10">
                                                            <?php $vars["formXhtml"]->inputtext("text", "valor_pension", "valor_pension", $vars["arrayRegistro"]["valor_pension"], "validar numeric form-control", "Valor pensión"); ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="valor_pension">Valor Formulario</label>
                                                        <div class="col-sm-10">
                                                            <?php $vars["formXhtml"]->inputtext("text", "valor_formulario", "valor_formulario", $vars["arrayRegistro"]["valor_formulario"], "validar numeric form-control", "Valor Formulario"); ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="valor_agenda">Valor Agenda</label>
                                                        <div class="col-sm-10">
                                                            <?php $vars["formXhtml"]->inputtext("text", "valor_agenda", "valor_agenda", $vars["arrayRegistro"]["valor_agenda"], "validar numeric form-control", "Valor Agenda"); ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="observaciones_matricula">Observaciones matricula</label>
                                                        <div class="col-sm-10">
                                                            <?php $vars["formXhtml"]->textarea("observaciones_matricula", "observaciones_matricula", $vars["arrayRegistro"]["observaciones_matricula"], "form-control", "Observaciones matricula");?>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>                                                    
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="curso">Grado</label>
                                                        <div class="col-sm-10">
                                                            <?php $vars["formXhtml"]->select("curso", "curso", $vars["arrayRegistro"]["curso"], "validar form-control", "Grado", "", "curso", "id", "nombre", "", "1", " nombre ASC"); ?>
                                                        </div>
                                                    </div>

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
                                                        <label class="col-sm-2 control-label" for="ciudad_expedicion">Ciudad de expedicion del documento</label>
                                                        <div class="col-sm-10">
                                                            <?php $vars["formXhtml"]->selectExtra("ciudad_expedicion", "ciudad_expedicion", $vars["arrayRegistro"]["ciudad_expedicion"], "validar form-control", "Ciudad de expedicion Documento", "", "ciudad", "id", "nombre", "nombre", "1", " ciudad.nombre ASC", array(), "", ":: Seleccione ::", "", "departamento"); ?>
                                                        </div>    
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="primer_nombre">Primer nombre</label>
                                                        <div class="col-sm-10">
                                                            <?php
                                                            //if (isset($vars["estudiante"])) {
                                                            //    echo $vars["arrayRegistro"]["primer_nombre"];
                                                            //} else {
                                                                $vars["formXhtml"]->inputtext("text", "primer_nombre", "primer_nombre", $vars["arrayRegistro"]["primer_nombre"], "validar form-control", "Primer nombre");
                                                            //}
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="segundo_nombre">Segundo nombre</label>
                                                        <div class="col-sm-10">
                                                            <?php
                                                            //if (isset($vars["estudiante"])) {
                                                            //    echo $vars["arrayRegistro"]["segundo_nombre"];
                                                            //} else {
                                                                $vars["formXhtml"]->inputtext("text", "segundo_nombre", "segundo_nombre", $vars["arrayRegistro"]["segundo_nombre"], "form-control", "Segundo nombre");
                                                            //}
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="primer_apellido">Primer apellido</label>
                                                        <div class="col-sm-10">
                                                            <?php
                                                            //if (isset($vars["estudiante"])) {
                                                              //  echo $vars["arrayRegistro"]["primer_apellido"];
                                                            //} else {
                                                                $vars["formXhtml"]->inputtext("text", "primer_apellido", "primer_apellido", $vars["arrayRegistro"]["primer_apellido"], "validar form-control", "Primer apellido");
                                                            //}
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="segundo_apellido">Segundo apellido</label>
                                                        <div class="col-sm-10">
                                                            <?php
                                                            //if (isset($vars["estudiante"])) {
                                                            //    echo $vars["arrayRegistro"]["segundo_apellido"];
                                                            //} else {
                                                                $vars["formXhtml"]->inputtext("text", "segundo_apellido", "segundo_apellido", $vars["arrayRegistro"]["segundo_apellido"], "form-control", "Segundo apellido");
                                                            //}
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="genero">Genero</label>
                                                        <div class="col-sm-10">
                                                            <?php
                                                            //if (isset($vars["estudiante"])) {
                                                            //    echo $vars["arrayRegistro"]["genero"];
                                                            //} else {
                                                                $vars["formXhtml"]->radio("genero", "genero", $vars["arrayRegistro"]["genero"], "validar", "Genero", "", array("M" => "M", "F" => "F"));
                                                            //}
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="ciudad_nacimiento">Ciudad de nacimiento</label>
                                                        <div class="col-sm-10">
                                                            <?php
                                                            if (isset($vars["estudiante"])) {
                                                                echo $vars["arrayRegistro"]["ciudad_nacimiento"];
                                                            } else {
                                                                $vars["formXhtml"]->select("ciudad_nacimiento", "ciudad_nacimiento", $vars["arrayRegistro"]["ciudad_nacimiento"], "validar form-control", "Ciudad de nacimiento", "", "ciudad", "id", "nombre", "nombre", "1", " ciudad.nombre ASC", array(), "", ":: Seleccione ::", "", $tableextra = "departamento");
                                                            }
                                                            ?>
                                                        </div>    
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="fecha_nacimiento">Fecha de nacimiento</label>
                                                        <div class="col-sm-10">
                                                            <?php
                                                            //if (isset($vars["estudiante"])) {
                                                            //    echo $vars["arrayRegistro"]["fecha_nacimiento"];
                                                            //} else {
                                                                $vars["formXhtml"]->inputtext("text", "fecha_nacimiento", "fecha_nacimiento", $vars["arrayRegistro"]["fecha_nacimiento"], "validar form-control calendario", "Fecha de nacimiento", "", "", "", "", "", "", true);
                                                            //}
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    if (isset($vars["estudiante"])) {
                                                        ?>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label" for="usuario">Usuario</label>
                                                            <div class="col-sm-10"><?php echo $vars["arrayRegistro"]["usuario"]; ?></div>
                                                        </div>
                                                        <?php
                                                    } else {
                                                        if ($vars["accion"] == "editar") {
                                                            ?>
                                                            <div class="form-group">
                                                                <label class="col-sm-2 control-label" for="usuario">Usuario</label>
                                                                <div class="col-sm-10"><?php echo $vars["arrayRegistroUsuario"]["usuario"]; ?></div>
                                                            </div>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <div class="form-group">
                                                                <label class="col-sm-2 control-label" for="usuario">Usuario</label>
                                                                <div class="col-sm-10" style="color: red; font-size: 16px">
                                                                    El usuario se compone de la primera letra de cada nombre mas el primer apellido completo, mas la primera letra del segundo apellido
                                                                    <br/>
                                                                    <span style="color: black">
                                                                        Ejemplos
                                                                        <br/>
                                                                        Maria Sagrario Barbosa Fuentes el usuario seria 
                                                                    </span>
                                                                    <span style="color: blue">
                                                                        msbarbosaf@colegioelfuturo.edu.co
                                                                    </span>
                                                                    <br/>
                                                                    <span style="color: black">
                                                                        Juanito Campos el usuario seria 
                                                                    </span>
                                                                    <span style="color: blue">
                                                                        jcampos@colegioelfuturo.edu.co
                                                                    </span>
                                                                    <br/>
                                                                    <span style="color: black">
                                                                        Pepito Quintero Rodriguez el usuario seria 
                                                                    </span>
                                                                    <span style="color: blue">
                                                                        pquinteror@colegioelfuturo.edu.co
                                                                    </span>
                                                                    <br/>
                                                                    <span style="color: black">
                                                                        Carlos Andres Peinado el usuario seria 
                                                                    </span>
                                                                    <span style="color: blue">
                                                                        capeinado@colegioelfuturo.edu.co
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="clave">Clave</label>
                                                        <div class="col-sm-10" style="color: red; font-size: 16px">
                                                            La clave es automática y es el numero de documento, por favor explicarles que por seguridad deben cambiarla al momento de ingresar al sistema.
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="tipo_discapacidad">Tipo de discapacidad</label>
                                                        <div class="col-sm-10">
                                                            <?php $vars["formXhtml"]->select("tipo_discapacidad", "tipo_discapacidad", $vars["arrayRegistro"]["tipo_discapacidad"], "form-control", "Tipo de discapacidad", "", "tipo_discapacidad", "id", "nombre", "", "1", " nombre ASC"); ?>
                                                        </div>    
                                                    </div>  
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="rh">RH</label>
                                                        <div class="col-sm-10">
                                                            <?php
                                                            //if (isset($vars["estudiante"])) {
                                                            //    echo $vars["arrayRegistro"]["rh"];
                                                            //} else {
                                                                $vars["formXhtml"]->inputtext("text", "rh", "rh", $vars["arrayRegistro"]["rh"], "validar form-control", "RH");
                                                            //}
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="eps">EPS</label>
                                                        <div class="col-sm-10">
                                                            <?php $vars["formXhtml"]->inputtext("text", "eps", "eps", $vars["arrayRegistro"]["eps"], "validar form-control", "EPS"); ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="ips">IPS</label>
                                                        <div class="col-sm-10">
                                                            <?php $vars["formXhtml"]->inputtext("text", "ips", "ips", $vars["arrayRegistro"]["ips"], "form-control", "IPS"); ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="ars">ARS</label>
                                                        <div class="col-sm-10">
                                                            <?php $vars["formXhtml"]->inputtext("text", "ars", "ars", $vars["arrayRegistro"]["ars"], "form-control", "ARS"); ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label" for="sisben">Sisben</label>
                                                        <div class="col-sm-10">
                                                            <?php $vars["formXhtml"]->inputtext("text", "sisben", "sisben", $vars["arrayRegistro"]["sisben"], "validar form-control", "Sisben"); ?>
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
                                                            <?php $vars["formXhtml"]->inputtext("text", "telefono", "telefono", $vars["arrayRegistro"]["telefono"], "numeric form-control", "Telefono"); ?>
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
                                                        <label class="col-sm-2 control-label" for="estrato">Estrato</label>
                                                        <div class="col-sm-10">
                                                            <?php $vars["formXhtml"]->inputtext("text", "estrato", "estrato", $vars["arrayRegistro"]["estrato"], "validar form-control", "Estrato"); ?>
                                                        </div>
                                                    </div>
                                                </div><!-- /.box-body -->

                                                <!-- /.box-body -->
                                                <div class="box-footer">
                                                    <input type="hidden" id="id" name="id" value="<?php echo $vars["arrayRegistro"]["id"] ?>" />
                                                    <?php
                                                    if (isset($vars["estudiante"])) {
                                                        ?>
                                                        <input type="hidden" id="estudiante" name="estudiante" value="<?php echo $vars["estudiante"] ?>" />
                                                        <?php
                                                    }
                                                    ?>

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
                                            <!-- Horizontal Form -->
                                            <div class="box box-success">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">Historia Academica</h3>
                                                </div>
                                                <!-- /.box-header -->
                                                <!-- form start -->
                                                <form class="form-validar form-horizontal" action="index.php?controlador=<?php echo $controlador; ?>&accion=nuevoDocumentoCertificado&id=<?php echo $vars["arrayRegistro"]["id"]; ?>" method="post" class="formvalidar" enctype="multipart/form-data">
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label" for="anio">Año</label>
                                                            <div class="col-sm-10">
                                                                <?php $vars["formXhtml"]->select("anio", "anio", $vars["arrayRegistroDocumento"]["anio"], "form-control", "matricula", "", "", "", "", "", "", "", $vars["anios"]); ?>                                                
                                                            </div>                                            
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label" for="archivo">Archivo</label>
                                                            <input type="file" id="archivo" name="archivo">                                                    
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label" for="eps">Descripción</label>
                                                            <div class="col-sm-10">
                                                                Grado-Institución-Naturaleza(Privado,Distrital)<br/>
                                                                <?php $vars["formXhtml"]->inputtext("text", "descripcion", "descripcion", $vars["arrayRegistroDocumento"]["descripcion"], "validar form-control", "Descripción"); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="box-footer">                                                
                                                        <button class="btn btn-info pull-right" type="submit">Guardar</button>
                                                    </div>
                                                </form>
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <th>Año</th>                                                    
                                                            <th>Tipo</th>                                                    
                                                            <th>Documento</th>                                                
                                                            <th>Descripción</th>                                                
                                                            <th>Activo</th>
                                                        </tr>

                                                        <?php
                                                        foreach ($vars["arrayDocumentosCertificados"] AS $clave => $valor) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $valor["anio"]; ?></td>    
                                                                <td><?php echo $valor["tipo"]; ?></td>    
                                                                <td><a target="_blank" href="<?php echo $vars["URLROOT"] . "admin/dist/img/usuario/" . $valor["archivo"]; ?>"><span class="fa fa-folder-open"/></a></td>
                                                                <td><?php echo $valor["descripcion"]; ?></td>
                                                                <td>
                                                                    <?php
                                                                    if ($valor["activo"]) {
                                                                        ?>
                                                                        <a href="index.php?controlador=<?php echo $controlador; ?>&accion=desactivarDocumento&id=<?php echo $vars["arrayRegistro"]["id"]; ?>&idd=<?php echo $clave; ?>"><span class="fa fa-plus-circle"/></a>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <a href="index.php?controlador=<?php echo $controlador; ?>&accion=activarDocumento&id=<?php echo $vars["arrayRegistro"]["id"]; ?>&idd=<?php echo $clave; ?>"><span class="fa fa-times"/></a>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </td>                                                    
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>                                                
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="box box-info">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">Documentos</h3>
                                                </div>
                                                <!-- /.box-header -->
                                                <!-- form start -->
                                                <form class="form-validar form-horizontal" action="index.php?controlador=<?php echo $controlador; ?>&accion=nuevoDocumento&id=<?php echo $vars["arrayRegistro"]["id"]; ?>" method="post" class="formvalidar" enctype="multipart/form-data">
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label" for="anio">Año</label>
                                                            <div class="col-sm-10">
                                                                <?php $vars["formXhtml"]->select("anio", "anio", $vars["arrayRegistroDocumento"]["anio"], "form-control", "matricula", "", "", "", "", "", "", "", $vars["anios"]); ?>                                                
                                                            </div>                                            
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label" for="tipo_documento">Tipo</label>
                                                            <div class="col-sm-10">
                                                                <?php $vars["formXhtml"]->select("tipo", "tipo", $vars["arrayRegistroDocumento"]["tipo"], "validar form-control", "Tipo", "", "", "", "", "", "", "", array("Acta de Grado" => "Acta de Grado","Afiliación AFP" => "Afiliaci&oacute;n AFP","Afiliaci&oacute;n ARL" => "Afiliaci&oacute;n ARL","Afiliaci&oacute;n EPS" => "Afiliaci&oacute;n EPS","Certificado Medico" => "Certificado Medico","Contrato" => "Contrato","Diploma" => "Diploma","Escalafon" => "Escalafon", "Foto" => "Foto", "Hoja de Vida" => "Hoja de Vida")); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label" for="archivo">Archivo</label>
                                                            <input type="file" id="archivo" name="archivo">                                                    
                                                        </div>
                                                    </div>
                                                    <div class="box-footer">                                                
                                                        <button class="btn btn-info pull-right" type="submit">Guardar</button>
                                                    </div>
                                                </form>
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <th>Año</th>                                                    
                                                            <th>Tipo</th>                                                    
                                                            <th>Documento</th>                                                
                                                            <th>Activo</th>
                                                        </tr>

                                                        <?php
                                                        foreach ($vars["arrayDocumentos"] AS $clave => $valor) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $valor["anio"]; ?></td>    
                                                                <td><?php echo $valor["tipo"]; ?></td>    
                                                                <td><a target="_blank" href="<?php echo $vars["URLROOT"] . "admin/dist/img/matricula/" . $valor["archivo"]; ?>"><span class="fa fa-folder-open"/></a></td>
                                                                <td>
                                                                    <?php
                                                                    if ($valor["activo"]) {
                                                                        ?>
                                                                        <a href="index.php?controlador=<?php echo $controlador; ?>&accion=desactivarDocumento&id=<?php echo $vars["arrayRegistro"]["id"]; ?>&idd=<?php echo $clave; ?>"><span class="fa fa-plus-circle"/></a>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <a href="index.php?controlador=<?php echo $controlador; ?>&accion=activarDocumento&id=<?php echo $vars["arrayRegistro"]["id"]; ?>&idd=<?php echo $clave; ?>"><span class="fa fa-times"/></a>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </td>                                                    
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>                                                
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.box -->
                                            <!-- general form elements disabled -->
                                            <div class="box box-warning">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">Acudientes</h3>
                                                </div>

                                                <div class="box-footer">                                                
                                                    <button id="cerrar" class="btn btn-danger" type="button">Mis acudientes</button>
                                                    <button id="buscar_acudiente" class="btn btn-info" type="button">Buscar Acudiente</button>
                                                    <button id="nuevo_acudiente" class="btn btn-warning" type="button">Crear Acudiente</button>                                                
                                                </div>
                                            </div>

                                            <?php
                                            $style_mis_acudiente = "display: block";
                                            $style_buscar_acudiente = "display: none";
                                            $style_nuevo_acudiente = "display: none";

                                            if (isset($vars["dinamico_crear"])) {
                                                $style_mis_acudiente = "display: none";
                                                $style_buscar_acudiente = "display: none";
                                                $style_nuevo_acudiente = "display: block";
                                            }
                                            ?>

                                            <div id="form_buscar_acudiente" style="<?php echo $style_buscar_acudiente; ?>" class="box box-primary">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">Buscador Acudientes</h3>
                                                </div>                                            
                                                <!-- /.box-header -->
                                                <form class="form-validar" action="index.php?controlador=<?php echo $controlador; ?>&accion=nuevoDocumento&id=<?php echo $vars["arrayRegistro"]["id"]; ?>" method="post" class="formvalidar" enctype="multipart/form-data">
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label for="numero_documento">Numero de documento</label>
                                                            <div>
                                                                <?php $vars["formXhtml"]->inputtext("text", "numero_documento_buscador", "numero_documento", "", "validar form-control", "Numero de documento"); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="primer_nombre">Primer nombre</label>
                                                            <div>
                                                                <?php $vars["formXhtml"]->inputtext("text", "primer_nombre_buscador", "primer_nombre", "", "validar form-control", "Primer nombre"); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="primer_apellido">Primer apellido</label>
                                                            <div>
                                                                <?php $vars["formXhtml"]->inputtext("text", "primer_apellido_buscador", "primer_apellido", "", "validar form-control", "Primer apellido"); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="box-footer">                                                
                                                        <button id="btn_buscar_acudiente" class="btn pull-right btn-warning" type="button">Buscar</button>
                                                    </div>
                                                </form>

                                                <div id="content_acudientes" class="box">

                                                </div>
                                                <div class="modal fade" id="asignar_acudiente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title" id="myModalLabel">Asignar Acudiente</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label" for="parentesco">Parentesco</label>
                                                                    <div class="col-sm-10">
                                                                        <?php $vars["formXhtml"]->select("edit_parentesco", "edit_parentesco", "", "validar form-control", "Parentesco", "", "", "", "", "", "", "", array("Padre" => "Padre", "Madre" => "Madre", "Acudiente" => "Acudiente")); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" id="idm" /> 
                                                                <input type="hidden" id="idu" />                                                                 
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                                <button id="cargar_acudiente" type="button" class="btn btn-primary">Guardar Acudiente</button>
                                                            </div>
                                                        </div>                                                        
                                                    </div>
                                                </div>



                                                <!-- /.box-body -->
                                            </div>

                                            <div id="form_nuevo_acudiente" style="<?php echo $style_nuevo_acudiente; ?>" class="box box-warning">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">Crear Acudiente</h3>
                                                </div>                                            
                                                <!-- /.box-header -->
                                                <form class="form-validar form-horizontal" action="index.php?controlador=<?php echo $controlador; ?>&accion=crearAcudiente&id=<?php echo $vars["arrayRegistro"]["id"]; ?>" method="post" class="formvalidar" enctype="multipart/form-data">
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label" for="parentesco">Parentesco</label>
                                                            <div class="col-sm-10">
                                                                <?php $vars["formXhtml"]->select("parentesco", "parentesco", $vars["arrayRegistroDocumento"]["parentesco"], "validar form-control", "Parentesco", "", "", "", "", "", "", "", array("Padre" => "Padre", "Madre" => "Madre", "Acudiente" => "Acudiente")); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label" for="tipo_documento">Tipo de documento</label>
                                                            <div class="col-sm-10">
                                                                <?php $vars["formXhtml"]->select("tipo_documento", "tipo_documento", $vars["arrayRegistroAcudiente"]["tipo_documento"], "validar form-control", "Tipo de Documento", "", "tipo_documento", "id", "nombre", "", "1", " nombre ASC"); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label" for="numero_documento">Numero de documento</label>
                                                            <div class="col-sm-10">
                                                                <?php $vars["formXhtml"]->inputtext("text", "numero_documento", "numero_documento", $vars["arrayRegistroAcudiente"]["numero_documento"], "validar form-control", "Numero de documento"); ?>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label" for="primer_nombre">Primer nombre</label>
                                                            <div class="col-sm-10">
                                                                <?php $vars["formXhtml"]->inputtext("text", "primer_nombre", "primer_nombre", $vars["arrayRegistroAcudiente"]["primer_nombre"], "validar form-control", "Primer nombre"); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label" for="segundo_nombre">Segundo nombre</label>
                                                            <div class="col-sm-10">
                                                                <?php $vars["formXhtml"]->inputtext("text", "segundo_nombre", "segundo_nombre", $vars["arrayRegistroAcudiente"]["segundo_nombre"], "form-control", "Segundo nombre"); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label" for="primer_apellido">Primer apellido</label>
                                                            <div class="col-sm-10">
                                                                <?php $vars["formXhtml"]->inputtext("text", "primer_apellido", "primer_apellido", $vars["arrayRegistroAcudiente"]["primer_apellido"], "validar form-control", "Primer apellido"); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label" for="segundo_apellido">Segundo apellido</label>
                                                            <div class="col-sm-10">
                                                                <?php $vars["formXhtml"]->inputtext("text", "segundo_apellido", "segundo_apellido", $vars["arrayRegistroAcudiente"]["segundo_apellido"], "form-control", "Segundo apellido"); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label" for="usuario">Usuario</label>
                                                            <div class="col-sm-10">
                                                                <?php $vars["formXhtml"]->inputtext("text", "usuario", "usuario", $vars["arrayRegistroAcudiente"]["usuario"], "validar form-control email", "Email"); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label" for="clave">Clave</label>
                                                            <div class="col-sm-10">
                                                                <?php $vars["formXhtml"]->inputtext("password", "clave", "clave", $vars["arrayRegistroAcudiente"]["clave"], "form-control", "Clave"); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label" for="ciudad_nacimiento">Ciudad de nacimiento</label>
                                                            <div class="col-sm-10">
                                                                <?php $vars["formXhtml"]->select("ciudad_nacimiento", "ciudad_nacimiento", $vars["arrayRegistroAcudiente"]["ciudad_nacimiento"], "validar form-control", "Ciudad de nacimiento", "", "ciudad", "id", "nombre", "nombre", "1", " ciudad.nombre ASC", array(), "", ":: Seleccione ::", "", $tableextra = "departamento"); ?>
                                                            </div>    
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label" for="fecha_nacimiento">Fecha de nacimiento</label>
                                                            <div class="col-sm-10">
                                                                <?php $vars["formXhtml"]->inputtext("text", "fecha_nacimiento", "fecha_nacimiento", $vars["arrayRegistroAcudiente"]["fecha_nacimiento"], "validar form-control calendario", "Fecha de nacimiento", "", "", "", "", "", "", true); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label" for="profesion">Profesión</label>
                                                            <div class="col-sm-10">
                                                                <?php $vars["formXhtml"]->inputtext("text", "profesion", "profesion", $vars["arrayRegistroAcudiente"]["profesion"], "form-control", "Profesion"); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label" for="rh">RH</label>
                                                            <div class="col-sm-10">
                                                                <?php $vars["formXhtml"]->inputtext("text", "rh", "rh", $vars["arrayRegistroAcudiente"]["rh"], "validar form-control", "RH"); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label" for="genero">Genero</label>
                                                            <div class="col-sm-10">
                                                                <?php $vars["formXhtml"]->radio("genero", "genero", $vars["arrayRegistroAcudiente"]["genero"], "validar", "Genero", "", array("M" => "M", "F" => "F")); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label" for="celular">Numero de celular</label>
                                                            <div class="col-sm-10">
                                                                <?php $vars["formXhtml"]->inputtext("text", "celular", "celular", $vars["arrayRegistroAcudiente"]["celular"], "validar numeric form-control", "Numero de celular"); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label" for="telefono">Telefono</label>
                                                            <div class="col-sm-10">
                                                                <?php $vars["formXhtml"]->inputtext("text", "telefono", "telefono", $vars["arrayRegistroAcudiente"]["telefono"], "numeric form-control", "Telefono"); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label" for="ubicacion">Dirección de residencia</label>
                                                            <div class="col-sm-10">
                                                                <?php $vars["formXhtml"]->inputtext("text", "ubicacion", "ubicacion", $vars["arrayRegistroAcudiente"]["ubicacion"], "validar form-control", "Dirección de residencia"); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label" for="barrio">Barrio</label>
                                                            <div class="col-sm-10">
                                                                <?php $vars["formXhtml"]->select("barrio", "barrio", $vars["arrayRegistroAcudiente"]["barrio"], "validar form-control", "Barrio", "", "barrio", "id", "nombre", "localidad", "1", " nombre ASC"); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label" for="activar">Activar?</label>
                                                            <div class="col-sm-10">
                                                                <?php $vars["formXhtml"]->radio("activo", "activo", $vars["arrayRegistroAcudiente"]["activo"], "", "Activar?", "", array("1" => "Si", "0" => "No")); ?>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="box-footer">
                                                        <button type="submit" class="btn btn-info">Guardar</button>
                                                    </div>
                                                </form>
                                                <!-- /.box-body -->
                                            </div>

                                            <div id="form_mis_acudiente" style="<?php echo $style_mis_acudiente; ?>" class="box box-danger">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">Mis acudientes</h3>
                                                </div>                                            
                                                <!-- /.box-header -->
                                                <form class="form-validar" action="index.php?controlador=<?php echo $controlador; ?>&accion=nuevoDocumento&id=<?php echo $vars["arrayRegistro"]["id"]; ?>" method="post" class="formvalidar" enctype="multipart/form-data">
                                                    <div class="box-body">
                                                        <table class="table table-bordered">
                                                            <tbody>
                                                                <tr>
                                                                    <th>Parentesco</th>
                                                                    <th>Numero de Documento</th>
                                                                    <th>Nombres</th>
                                                                    <th>Apellidos</th>
                                                                    <th>Telefono - Celular</th>
                                                                    <th>Ubicacion</th>
                                                                    <th>Eliminar</th>
                                                                </tr>
                                                                <?php
                                                                foreach ($vars["arrayAcudientes"] as $clave => $item) {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $item['parentesco']; ?></td>
                                                                        <td><?php echo $item['numero_documento']; ?></td>
                                                                        <td><?php echo $item['primer_nombre'] . " " . $item['segundo_nombre']; ?></td>
                                                                        <td><?php echo $item['primer_apellido'] . " " . $item['segundo_apellido']; ?></td>
                                                                        <td><?php echo $item['telefono'] . " - " . $item['celular']; ?></td>
                                                                        <td><?php echo $item['ubicacion']; ?></td>
                                                                        <td>
                                                                            <a href="index.php?controlador=<?php echo $controlador; ?>&accion=eliminarAcudiente&id=<?php echo $vars["arrayRegistro"]["id"]; ?>&idd=<?php echo $item['id']; ?>"><span class="fa fa-times"/></a>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </tbody>    
                                                        </table>
                                                    </div>                                                    
                                                </form>
                                                <!-- /.box-body -->
                                            </div>
                                            <!-- /.box -->
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                            }
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
                                            <div class="col-md-6">
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
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="tipo_documento">Tipo de documento</label>
                                                    <div class="col-sm-10">
                                                        <?php $vars["formXhtml"]->select("tipo_documento", "tipo_documento", $vars["arrayRegistro"]["tipo_documento"], "validar form-control", "Tipo de Documento", "", "tipo_documento", "id", "nombre", "", "1", " nombre ASC"); ?>                                                
                                                    </div>                                            
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="estado">Estado matricula</label>
                                                    <div class="col-sm-10">
                                                        <?php $vars["formXhtml"]->radio("estado", "estado", $vars["arrayRegistro"]["estado"], "", "Estado de matricula", "", array("2" => "No aplica", "Matriculado" => "Matriculado", "Revisado" => "Revisado", "Inscrito" => "Inscrito")); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label" for="numero_documento">Numero de documento</label>
                                                    <div class="col-sm-10">
                                                        <?php $vars["formXhtml"]->inputtext("text", "numero_documento", "numero_documento", $vars["arrayRegistro"]["numero_documento"], "validar form-control", "Numero de documento"); ?>
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
                            </div>
                            <div class="row">
                                <!-- /.col -->
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box bg-green">
                                        <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Matriculados</span>
                                            <span class="info-box-number"><?php echo $vars["matriculados"];?></span>

                                            <div class="progress">
                                                <div style="width: <?php echo $vars["matriculadosp"];?>%" class="progress-bar"></div>
                                            </div>
                                            <span class="progress-description">
                                                El <?php echo $vars["matriculadosp"];?>%, del <?php echo $vars["arrayRegistro"]["anio"]?>
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box bg-yellow">
                                        <span class="info-box-icon"><i class="fa fa-eye"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Revisados</span>
                                            <span class="info-box-number"><?php echo $vars["revisados"];?></span>

                                            <div class="progress">
                                                <div style="width: <?php echo $vars["revisadosp"];?>%" class="progress-bar"></div>
                                            </div>
                                            <span class="progress-description">
                                                El <?php echo $vars["revisadosp"];?>%, del <?php echo $vars["arrayRegistro"]["anio"]?>
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box bg-red">
                                        <span class="info-box-icon"><i class="fa  fa-pencil"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Inscritos</span>
                                            <span class="info-box-number"><?php echo $vars["inscritos"];?></span>

                                            <div class="progress">
                                                <div style="width: <?php echo $vars["inscritosp"];?>%" class="progress-bar"></div>
                                            </div>
                                            <span class="progress-description">
                                                El <?php echo $vars["inscritosp"];?>%, del <?php echo $vars["arrayRegistro"]["anio"]?>
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Matriculas registrados en el Sistema</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Usuario y Fecha Crear</th>
                                                <th>Usuario y Fecha Editar </th>
                                                <th>Año matricula</th>
                                                <th>Grado</th>
                                                <th>Tipo de Documento</th>
                                                <th>Numero de Documento</th>
                                                <th>Nombres</th>
                                                <th>Apellidos</th>
                                                <th>Hoja Matricula</th>
                                                <th>Pago Matricula</th>
                                                <th>Estado matricula</th>
                                                <th>Activo</th>
                                                <th>Editar</th>
                                            </tr>
                                            <?php
                                           foreach($vars["arrayPaginador"] as $item) {
                                                if ($item['estado'] == "" || $item['estado'] == null || $item['estado'] == "Inscrito" || $item['estado'] == "null") {
                                                    $color = "btn-danger";
                                                }

                                                if ($item['estado'] == "Revisado") {
                                                    $color = "btn-warning";
                                                }

                                                if ($item['estado'] == "Matriculado") {
                                                    $color = "btn-success";
                                                }
                                                ?>
                                                <tr>
                                                    <td><?php echo $item['usuario_crear']; ?> <b><?php echo $item['fecha_crear']; ?></b></td>
                                                    <td><?php echo $item['usuario_editar']; ?> <b><?php echo $item['fecha_editar']; ?></b></td>
                                                    <td><?php echo $item['anio']; ?></td>
                                                    <td><?php echo $item['curso']; ?></td>
                                                    <td><?php echo utf8_encode($item['tipo_documento']); ?></td>
                                                    <td><?php echo $item['numero_documento']; ?></td>
                                                    <td><?php echo $item['primer_nombre'] . " " . $item['segundo_nombre']; ?></td>
                                                    <td><?php echo $item['primer_apellido'] . " " . $item['segundo_apellido']; ?></td>
                                                    <td><a href="libs/TCPDF-master/examples/formato_matricula.php?id=<?php echo $item['id']; ?>"><span class="fa fa-file-pdf-o"/> </a></td>
                                                    <td><a href="libs/TCPDF-master/examples/formato_matricula.php?id=<?php echo $item['id']; ?>"><span class="fa fa-file-pdf-o"/> </a></td>
                                                    <td><button title="<?php echo $item['id']; ?>" data-toggle="modal" data-target="#opciones_matricula" class="btn_estado btn <?php echo $color; ?> btn-flat" type="button"><i class="fa fa-cogs"></i></button></td>
                                                    <td>
                                                        <?php
                                                        if ($item["activo"]) {
                                                            ?>
                                                            <a href="index.php?controlador=<?php echo $controlador; ?>&accion=matricula&id=<?php echo $item['id']; ?>&a=0"><span class="fa fa-plus-circle"/></a>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <a href="index.php?controlador=<?php echo $controlador; ?>&accion=matricula&id=<?php echo $item['id']; ?>&a=1"><span class="fa fa-times"/></a>
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

                                    <!-- Modal -->
                                    <div class="modal fade" id="opciones_matricula" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <form class="form-validar form-horizontal" action="index.php?controlador=<?php echo $controlador; ?>&accion=matricula" method="post" enctype="multipart/form-data">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Editar el estado de la matricula</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <h2 class="page-header">El perfil <b>Directivos</b> es el unico que moficar el estado a <b>Matriculado</b>, El perfil <b>Coordinador</b> solo puede modificar el estado a <b>Revisado y/o Inscritos</b>.</h2>
                                                    <?php 
                                                    if(in_array("1", $vars["dataUser"]["array_perfil"]) == true||in_array("2", $vars["dataUser"]["array_perfil"]) == true)
                                                    {
                                                        $vars["formXhtml"]->radio("estadoEditar", "estadoEditar", "", "", "Estado de matricula", "", array("Matriculado" => "Matriculado", "Revisado" => "Revisado", "Inscrito" => "Inscrito")); 
                                                    }
                                                    else
                                                    {
                                                        $vars["formXhtml"]->radio("estadoEditar", "estadoEditar", "", "", "Estado de matricula", "", array("Revisado" => "Revisado", "Inscrito" => "Inscrito"));
                                                    }                                                    
                                                    ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" value="" id="idEstado" name="idEstado" />
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary">Guardar Estado</button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>

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