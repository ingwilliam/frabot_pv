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
                    <li><a href="#">Registrar Cuenta</a></li>                    
                </ul>

                <div class="row">
                    <!--Middle Part Start-->
                    <div id="content" class="col-sm-12">                        
                        <h2 class="title">Registrar Cuenta</h2>
                        <p>Si ya tiene una cuenta con nosotros, inicie sesión en la <a href="index.php?controlador=Index&accion=login"> página de inicio de sesión </a>.</p>
                        <form action="index.php?controlador=Index&accion=registro" method="post" enctype="multipart/form-data" class="form-horizontal account-register clearfix form-validar">
                            <div id="mensajevalida" class="alert alert-warning alert-dismissible" style="display: none">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <h4 style="font-size: 14px"><i class="icon fa fa-warning"></i>Los siguientes campos son obligatorios</h4>
                                <ul>

                                </ul>
                            </div>
                            <?php
                            if($vars["msg"]!="")
                            {
                            ?>
                            <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i>Alerta- <?php echo $vars["msg"];?></div>
                            <?php
                            }
                            ?>
                            <fieldset id="account">
                                <legend>Datos Personales</legend>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="tipo_documento">Tipo de documento</label>
                                    <div class="col-sm-10">
                                        <?php $vars["formXhtml"]->select("tipo_documento", "tipo_documento", $vars["arrayRegistro"]["tipo_documento"], "validar form-control", "Tipo de Documento", "", "tipo_documento", "id", "nombre", "", "1", " nombre ASC"); ?>                                        
                                    </div>
                                </div>                                                                
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="numero_documento">Numero de documento</label>
                                    <div class="col-sm-10">
                                        <?php $vars["formXhtml"]->inputtext("text", "numero_documento", "numero_documento", $vars["arrayRegistro"]["numero_documento"], "validar form-control numeric", "Numero de documento"); ?>                                        
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="primer_nombre">Primer nombre</label>
                                    <div class="col-sm-10">
                                        <?php $vars["formXhtml"]->inputtext("text", "primer_nombre", "primer_nombre", $vars["arrayRegistro"]["primer_nombre"], "validar form-control", "Primer nombre"); ?>                                                                                
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="segundo_nombre">Segundo nombre</label>
                                    <div class="col-sm-10">
                                        <?php $vars["formXhtml"]->inputtext("text", "segundo_nombre", "segundo_nombre", $vars["arrayRegistro"]["segundo_nombre"], "form-control", "Segundo nombre"); ?>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="primer_apellido">Primer apellido</label>
                                    <div class="col-sm-10">
                                        <?php $vars["formXhtml"]->inputtext("text", "primer_apellido", "primer_apellido", $vars["arrayRegistro"]["primer_apellido"], "validar form-control", "Primer apellido"); ?>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="segundo_apellido">Segundo apellido</label>
                                    <div class="col-sm-10">
                                        <?php $vars["formXhtml"]->inputtext("text", "segundo_apellido", "segundo_apellido", $vars["arrayRegistro"]["segundo_apellido"], "form-control", "Segundo apellido"); ?>
                                    </div>
                                </div>                                
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="usuario">Correo electrónico</label>
                                    <div class="col-sm-10">
                                        <?php $vars["formXhtml"]->inputtext("text", "usuario", "usuario", $vars["arrayRegistro"]["usuario"], "validar form-control email", "Correo electrónico"); ?>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="clave">Contraseña</label>
                                    <div class="col-sm-10">
                                        <?php $vars["formXhtml"]->inputtext("password", "clave", "clave", $vars["arrayRegistro"]["clave"], "validar form-control", "Contraseña"); ?>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="fecha_nacimiento">Fecha de nacimiento</label>
                                    <div class="col-sm-10">
                                        <?php $vars["formXhtml"]->inputtext("text", "fecha_nacimiento", "fecha_nacimiento", $vars["arrayRegistro"]["fecha_nacimiento"], "validar form-control calendario", "Fecha de nacimiento", "", "", "", "", "", "", true); ?>
                                    </div>
                                </div>                                
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="celular">Numero de celular</label>
                                    <div class="col-sm-10">
                                        <?php $vars["formXhtml"]->inputtext("text", "celular", "celular", $vars["arrayRegistro"]["celular"], "validar numeric form-control", "Numero de celular"); ?>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="telefono">Telefono de contacto</label>
                                    <div class="col-sm-10">
                                        <?php $vars["formXhtml"]->inputtext("text", "telefono", "telefono", $vars["arrayRegistro"]["telefono"], "validar numeric form-control", "Telefono de contacto"); ?>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="ubicacion">Dirección de contacto</label>
                                    <div class="col-sm-10">
                                        <?php $vars["formXhtml"]->inputtext("text", "ubicacion", "ubicacion", $vars["arrayRegistro"]["ubicacion"], "validar form-control", "Dirección de contacto"); ?>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="barrio">Barrio</label>
                                    <div class="col-sm-10">
                                        <?php $vars["formXhtml"]->select("barrio", "barrio", $vars["arrayRegistro"]["barrio"], "validar form-control", "Barrio", "", "barrio", "id", "nombre", "localidad", "1", " nombre ASC"); ?>
                                    </div>
                                </div>                                
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="ciudad_ubicacion">Ciudad de Ubicacion</label>
                                    <div class="col-sm-10">
                                        <?php $vars["formXhtml"]->selectExtra("ciudad_ubicacion", "ciudad_ubicacion", $vars["arrayRegistro"]["ciudad_ubicacion"], "validar form-control", "Ciudad de nacimiento", "", "ciudad", "id", "nombre", "nombre", "1", " ciudad.nombre ASC", array(), "", ":: Seleccione ::", "", "departamento"); ?>
                                    </div>    
                                </div>
                            </fieldset>

                            <div class="buttons" style="text-align: right">
                                <input type="hidden" id="insert" name="insert" value="1" />
                                <input type="submit" value="Continue" class="btn btn-primary">                                
                            </div>
                        </form>
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