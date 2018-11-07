<?php
$controlador = "Seguridad";
$accion = "seguridad";
$titulo = "Seguridad";
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
                <!-- Content Header (Page header) -->                
                <?php
                if (count($vars["arrayPermiso"]) > 0) {
                ?>
                <section class="content-header">
                    <h1>
                        Seguridad
                        <small>Seguridad del sistema</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php?controlador=Index&accion=index"><i class="fa fa-home"></i> Inicio</a></li>
                        <li>Seguridad</li>
                        <li class="active">Seguridad del sistema</li>
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
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Administrador de seguridad</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form">
                            <?php
                            if ($vars["formularioNuevo"]) {
                                ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Modulos / Perfiles</th>
                                            <?php
                                            foreach ($vars["arrayPerfiles"] as $clave => $valor) {
                                                ?>
                                                <th><?php echo $valor["nombre"]; ?></th>
                                                <?php
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($vars["arrayModulos"] as $clave => $valor) {
                                            ?>
                                            <tr>
                                                <td><?php echo $valor["nombre"]; ?></td>
                                                <?php
                                                foreach ($vars["arrayPerfiles"] as $claveint => $valorint) {
                                                    ?>
                                                    <td>
                                                        <select onchange="GeneraPermiso(this.value, <?php echo $clave; ?>, <?php echo $claveint; ?>)">
                                                            <option value="0">::Seleccionar Permiso::</option>
                                                            <?php
                                                            foreach ($vars["arrayPermisos"] as $claveint2 => $valorint2) {
                                                                $PermisoActual = 0;
                                                                $PermisoActual = $vars["objSeguridad"]->confirmSeguridad("permiso", $claveint, $clave);
                                                                if ($PermisoActual == $claveint2)
                                                                    $selected = "selected";
                                                                else
                                                                    $selected = "";
                                                                ?>
                                                                <option value="<?php echo $claveint2; ?>" <?php echo $selected; ?>><?php echo $valorint2["nombre"]; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>                                        
                                                    </td>
                                                    <?php
                                                }
                                                ?>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>


                                </table>
                                <?php
                            }
                            ?>
                            <!-- /.box-body -->
                        </form>
                    </div>
                </section>
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
                <!-- /.content -->
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