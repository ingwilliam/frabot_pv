<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include 'include/head.php';
        ?>
    </head>
    <body class="common-home res layout-home7">
        <div id="wrapper" class="wrapper-full banners-effect-7">
            <!-- Header Container  -->
            <header id="header" class=" variantleft type_7">
                <?php
                include 'include/header.php';
                ?>
            </header>
            <!-- //Header Container  -->
            <!-- Main Container  -->
            <div class="main-container container">
                <ul class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                    <li><a href="#">Login</a></li>                    
                </ul>

                <div class="row">
                    <div id="content" class="col-sm-12">
                        <div class="page-login">
                            <?php
                            if($vars["msg"]!="")
                            {
                            ?>
                            <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i>Alerta- <?php echo $vars["msg"];?></div>
                            <?php
                            }
                            ?>
                            <div class="account-border">
                                <div class="row">
                                    <div class="col-sm-6 new-customer">
                                        <div class="well">
                                            <h2><i class="fa fa-file-o" aria-hidden="true"></i> SUSCRÍBETE Y COTIZA YA!!!</h2>
                                            <p>Al crear una cuenta, podrá comprar más rápido, estar actualizado sobre el estado de un pedido y realizar un seguimiento de los pedidos que realizó anteriormente.</p>
                                        </div>
                                        <div class="bottom-form">
                                            <a href="index.php?controlador=Index&accion=registro" class="btn btn-default pull-right">Suscribirme</a>
                                        </div>
                                    </div>

                                    <form action="index.php?controlador=Index&accion=recordar" method="post" enctype="multipart/form-data">                                        
                                        <div class="col-sm-6 customer-login">                                                                                        
                                            <div class="well">
                                                <h2><i class="fa fa-file-text-o" aria-hidden="true"></i> Ingresar correo electrónico con el que se registro</h2>
                                                <div class="form-group">
                                                    <label class="control-label " for="input-email">Correo electrónico</label>
                                                    <input type="text" name="email" value="" id="input-email" class="form-control" />
                                                </div>                                                
                                            </div>
                                            <div class="bottom-form">                                                
                                                <a href="index.php?controlador=Index&accion=login" class="forgot">Volver al login</a>
                                                <input type="hidden" id="insert" name="insert" value="1" />
                                                <input type="submit" value="Recordar contraseña" class="btn btn-default pull-right" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!--Middle Part End-->
            </div>
            <!-- //Main Container -->

            <!-- Footer Container -->
            <footer class="footer-container typefooter-1">
                <?php
                include 'include/footer.php';
                ?>                
            </footer>
            <!-- //end Footer Container -->

        </div>
        <!-- Social widgets -->
        <section class="social-widgets visible-lg">
            <?php
            include 'include/social.php';
            ?>                        
        </section>	
        <!-- End Social widgets -->
        <!-- Preloading Screen -->
        <div id="loader-wrapper">
            <div id="loader"></div>
            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
        </div>

</html>