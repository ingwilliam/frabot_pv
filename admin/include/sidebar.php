

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p><?php echo $dataUser["primer_nombre"] . " " . $dataUser["primer_apellido"]; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li class="header">Menu de Navegación</li>
        <li class="<?php echo ( $controlador == 'Index' ) ? 'active' : '';?>"><a href="index.php?controlador=Index&accion=index"><i class="fa fa-home"></i> <span>Inicio</span></a></li>        
        <li class="treeview <?php echo ( $controlador == 'Seguridad' || $controlador == 'Usuario' || $controlador == 'Modulo' || $controlador == 'Perfil' || $controlador == 'Permiso') ? 'active' : '';?>">
            <a href="#">
                <i class="fa fa-unlock-alt"></i>
                <span>Panel de Seguridad</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a class="<?php echo ( $controlador == 'Seguridad') ? 'a_activo' : '';?>" href="index.php?controlador=Seguridad&accion=seguridad"><i class="fa fa-circle-o"></i> Seguridad</a></li>
                <li><a class="<?php echo ( $controlador == 'Usuario') ? 'a_activo' : '';?>" href="index.php?controlador=Usuario&accion=usuario"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                <li><a class="<?php echo ( $controlador == 'Modulo') ? 'a_activo' : '';?>" href="index.php?controlador=Modulo&accion=modulo"><i class="fa fa-circle-o"></i> Modulos</a></li>
                <li><a class="<?php echo ( $controlador == 'Perfil') ? 'a_activo' : '';?>" href="index.php?controlador=Perfil&accion=perfil"><i class="fa fa-circle-o"></i> Perfiles</a></li>
                <li><a class="<?php echo ( $controlador == 'Permiso') ? 'a_activo' : '';?>" href="index.php?controlador=Permiso&accion=permiso"><i class="fa fa-circle-o"></i> Permisos</a></li>                
            </ul>
        </li>
        <li class="treeview <?php echo ( $controlador == 'Seccion' || $controlador == 'Banner' || $controlador == 'Articulo' || $controlador == 'Galeria' || $controlador == 'Comentario') ? 'active' : '';?>">
            <a href="#">
                <i class="fa fa-cloud"></i>
                <span>Pagina</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">                
                <li><a class="<?php echo ( $controlador == 'Banner') ? 'a_activo' : '';?>" href="index.php?controlador=Banner&accion=banner"><i class="fa fa-circle-o"></i> Banner</a></li>                
                <li><a class="<?php echo ( $controlador == 'Seccion') ? 'a_activo' : '';?>" href="index.php?controlador=Seccion&accion=seccion"><i class="fa fa-circle-o"></i> Categoria</a></li>                
                <li><a class="<?php echo ( $controlador == 'Articulo') ? 'a_activo' : '';?>" href="index.php?controlador=Articulo&accion=articulo"><i class="fa fa-circle-o"></i> Producto</a></li>                
                <li><a class="<?php echo ( $controlador == 'Galeria') ? 'a_activo' : '';?>" href="index.php?controlador=Galeria&accion=galeria"><i class="fa fa-circle-o"></i> Galeria</a></li>                
                <li><a class="<?php echo ( $controlador == 'Comentario') ? 'a_activo' : '';?>" href="index.php?controlador=Comentario&accion=comentario"><i class="fa fa-circle-o"></i> Comentario</a></li>                
            </ul>
        </li>                
    </ul>
</section>
<!-- /.sidebar -->