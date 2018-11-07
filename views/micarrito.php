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
                    <li><a href="#">Mi carrito</a></li>                    
                </ul>

                <div class="row">
                    <!--Middle Part Start-->
                    <div id="content" class="col-md-12 col-sm-12">
                        <?php
                        if($vars["msg"]!="")
                        {
                        ?>
                        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i>Alerta- <?php echo $vars["msg"];?></div>
                        <?php
                        }                            
                        ?>
                        <?php
                        if($vars["msg2"]!="")
                        {
                        ?>
                        <div class="alert alert-success"><i class="fa fa-exclamation-circle"></i>Alerta- <?php echo $vars["msg2"];?></div>
                        <?php
                        }                            
                        ?>
                        <h2 class="title">Mis productos cotizados</h2>
                        <div class="table-responsive" style="margin: 0 auto">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td class="text-center">Imagen</td>
                                        <td class="text-left">Nombre del producto</td>
                                        <td class="text-left">Marca</td>
                                        <td class="text-right">Código</td>
                                        <td class="text-right">Precio</td>
                                        <td class="text-right">Cantidad</td>
                                        <td class="text-right">Total</td>
                                        <td class="text-right"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($vars["carrito"] as $clave => $valor)
                                    {
                                    $settings = array('w'=>70,'h'=>70,'canvas-color' => '#ffffff');
                                    ?>
                                    <tr>
                                        <td class="text-center">                                            
                                            <img src="<?php echo $vars["formXhtml"]->resize($vars["config"]->get('ARTICULOS_ROOT') . $valor["archivo"],$settings) ?>" style="width:70px" alt="<?php echo $valor["nombre"];?>" title="<?php echo $valor["nombre"];?>">
                                        </td>
                                        <td class="text-left"><?php echo $valor["nombre"];?></td>
                                        <td class="text-left"><?php echo $valor["marca"];?></td>
                                        <td class="text-right"><?php echo $valor["codigo"];?></td>
                                        <td class="text-right"><div class="price"> <span class="price-new">$<?php echo number_format($valor["precio"]);?></span> <span class="price-old">$<?php echo number_format($valor["precio_publico"]);?></span></div></td>
                                        <td class="text-right">
                                                <div class="input-group number-spinner">
                                                        <span class="input-group-btn">
                                                                <button class="btn btn-default" data-dir="dwn"><span class="glyphicon glyphicon-minus"></span></button>
                                                        </span>
                                                        <input alt="<?php echo $valor["id"];?>" type="text" class="form-control text-center" value="<?php echo $valor["cantidad"];?>" readonly="readonly">
                                                        <span class="input-group-btn">
                                                                <button class="btn btn-default" data-dir="up"><span class="glyphicon glyphicon-plus"></span></button>
                                                        </span>
                                                </div> 
                                                <input type="hidden" id="precio_<?php echo $valor["id"];?>" value="<?php echo $valor["precio"];?>" />
                                        </td>
                                        <td class="text-right total_cantidad_carrito_<?php echo $valor["id"];?>">$<?php echo number_format($valor["cantidad"]*$valor["precio"]);?></td>
                                        <td class="text-right">                                            
                                            <a class="btn btn-danger" title="" data-toggle="tooltip" href="javascript::void(0)" onclick="cart.remove(<?php echo $valor["id"];?>,'<?php echo "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];?>');" data-original-title="Remove"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <form action="index.php?controlador=Index&accion=micarrito" method="post" enctype="multipart/form-data" class="form-horizontal account-register clearfix form-validar">
                            <div id="mensajevalida" class="alert alert-warning alert-dismissible" style="display: none">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <h4 style="font-size: 14px"><i class="icon fa fa-warning"></i>Los siguientes campos son obligatorios</h4>
                                <ul>

                                </ul>
                            </div>                            
                            <fieldset id="account">
                                <legend>Detalle de la cotización</legend>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="tipo_documento">Tipo de pago *</label>
                                    <div class="col-sm-10">
                                        <?php $vars["formXhtml"]->select("tipo_pago", "tipo_pago", "", "validar form-control", "Tipo de pago", "", "", "", "", "", "", "",array("Contra entrega"=>"Contra entrega","Efectivo en bodega"=>"Efectivo en bodega","Tarjeta de credito"=>"Tarjeta de credito")); ?>                                        
                                    </div>
                                </div>                                                                
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="celular">Numero de celular</label>
                                    <div class="col-sm-10">
                                        <?php $vars["formXhtml"]->inputtext("text", "celular", "celular", $vars["dataUser"]["celular"], "validar numeric form-control", "Numero de celular"); ?>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="telefono">Telefono de contacto</label>
                                    <div class="col-sm-10">
                                        <?php $vars["formXhtml"]->inputtext("text", "telefono", "telefono", $vars["dataUser"]["telefono"], "validar numeric form-control", "Telefono de contacto"); ?>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="ubicacion">Dirección de contacto</label>
                                    <div class="col-sm-10">
                                        <?php $vars["formXhtml"]->inputtext("text", "ubicacion", "ubicacion", $vars["dataUser"]["ubicacion"], "validar form-control", "Dirección de contacto"); ?>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="barrio">Barrio</label>
                                    <div class="col-sm-10">
                                        <?php $vars["formXhtml"]->select("barrio", "barrio", $vars["dataUser"]["barrio"], "validar form-control", "Barrio", "", "barrio", "id", "nombre", "localidad", "1", " nombre ASC"); ?>
                                    </div>
                                </div>                                
                                <div class="form-group required">
                                    <label class="col-sm-2 control-label" for="ciudad_ubicacion">Ciudad de Ubicacion</label>
                                    <div class="col-sm-10">
                                        <?php $vars["formXhtml"]->selectExtra("ciudad", "ciudad", $vars["dataUser"]["ciudad_ubicacion"], "validar form-control", "Ciudad de nacimiento", "", "ciudad", "id", "nombre", "nombre", "1", " ciudad.nombre ASC", array(), "", ":: Seleccione ::", "", "departamento"); ?>
                                    </div>    
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="descripcion">Descripción de la cotización</label>
                                    <div class="col-sm-10">
                                        <?php $vars["formXhtml"]->textarea("descripcion", "descripcion", "", "validar form-control", "Descripción de la cotización"); ?>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="buttons" style="text-align: right">
                                <input type="hidden" id="insert" name="insert" value="1" />
                                <input type="submit" value="Enviar cotización" class="btn btn-primary">                                
                            </div>
                        </form>
                            
                            
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