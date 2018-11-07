<!-- Logo -->
<a href="index.php?controlador=Index&accion=index" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>FRA</b>BOT</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>FRABOT</b></span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                    <span class="hidden-xs"><?php echo $dataUser["primer_nombre"] . " " . $dataUser["primer_apellido"]; ?></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                        <p>
                            <?php echo $dataUser["primer_nombre"] . " " . $dataUser["segundo_nombre"] . " " . $dataUser["primer_apellido"] . " " . $dataUser["segundo_apellido"]; ?> - <?php echo $dataUser["profesion"]; ?>
                            <small><?php echo date("M j, Y, g:i a");?></small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-right">
                            <a href="index.php?controlador=Login&accion=salir" class="btn btn-default btn-flat">Cerrar sesión</a>
                        </div>
                    </li>
                </ul>
            </li>
            <!-- Control Sidebar Toggle Button
            <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
            -->
        </ul>
    </div>
</nav>
