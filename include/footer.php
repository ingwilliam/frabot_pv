<!-- Footer Top -->
<div class="footer-top">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="module social_block col-md-3 col-sm-12 col-xs-12" >
                    <ul class="social-block ">
                        <li class="facebook"><a class="_blank" href="https://www.facebook.com/comercializadorafrabot/" target="_blank"><i class="fa fa-facebook"></i></a></li>                        
                    </ul>
                </div>
                <div class="module news-letter col-md-9 col-sm-12 col-xs-12">
                    <div class="newsletter">
                        <div class="title-block">
                            <div class="page-heading">SUSCRÍBETE Y COTIZA YA!!!</div>
                            <div class="pre-text">
                                Podrá obtener los mejores producto con descuentos especiales
                            </div>
                        </div>
                        <div class="block_content">
                            <form method="post" action="index.php?controlador=Index&accion=registro" name="signup" id="signup" class="btn-group form-inline signup">
                                <div class="form-group required send-mail">
                                    <div class="input-box">
                                        <input type="email" placeholder="Tu correo electrónico..." value="" class="form-control" id="email" name="email" size="55">
                                    </div>
                                    <div class="subcribe">
                                        <button class="btn btn-default btn-lg" type="submit" name="SUSCRIBIRME">
                                            SUSCRIBIRME						</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
<!-- Footer Center -->
<div class="footer-center">
    <div class="container content">
        <div class="row">
            <!-- Box Info -->
            <div class="col-md-3 col-sm-6 col-xs-12 collapsed-block footer-links box-footer">
                <div class="module ">
                    <div class="content-block-footer">
                        <div class="footer-logo">
                            <a href="<?php echo $vars["logo"]["url"]; ?>"><img src="<?php echo $vars["config"]->get('BANNERS_ROOT') . $vars["logo"]["archivo"]; ?>" title="<?php echo $vars["logo"]["nombre"]; ?>" alt="<?php echo $vars["logo"]["nombre"]; ?>" width="161" height="38" /></a>
                        </div>
                        <p><?php echo $vars["logo"]["descripcion"]; ?></p>
                    </div>
                </div>				
            </div>
            <!-- Box Accout -->
            <?php
            foreach ($vars["pie_pagina"] as $clave => $valor) {
                $array_articulos = $vars["indexModel"]->listArraySql("SELECT * FROM articulo INNER JOIN articulo_seccion ON articulo_seccion.articulo = articulo.id WHERE activo = 1 AND articulo_seccion.seccion = '" . $valor["id"] . "' ORDER BY orden");
                ?>
                <div class="col-md-3 col-sm-6 box-account box-footer">
                    <div class="module clearfix">
                        <h3 class="modtitle"><?php echo $valor["nombre"]; ?></h3>
                        <div class="modcontent">
                            <ul class="menu">
                                <?php
                                foreach ($array_articulos as $data_art) {
                                    ?>
                                    <li><a href="index.php?controlador=Index&accion=noticia&id=<?php echo $valor["id"]; ?>&idp=<?php echo $data_art["id"]; ?>"><?php echo $data_art["nombre"]; ?></a></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>                                                
            <!-- Box About -->
            <div class="col-md-3  col-sm-6 collapsed-block box-footer">
                <div class="module ">
                    <h3 class="modtitle">Sobre nosotros</h3>
                    <div class="modcontent">
                        <ul class="contact-address">
                            <li><span class="fa fa-home"></span>www.frabot.co</li>
                            <li><span class="fa fa-envelope"></span> Email: <a href="javascript:void(0);"> francisco.botero@frabot.co</a></li>
                            <li><span class="fa fa-phone">&nbsp;</span> <?php echo $vars["informativo"]["nombre"]; ?>: <?php echo $vars["informativo"]["descripcion"]; ?></li>
                        </ul>
                        <ul class="payment-method">
                            <li><a title="Payment Method" href="javascript:void(0);"><img src="image/demo/cms/payment/payment-1.png" alt="Payment"></a></li>
                            <li><a title="Payment Method" href="javascript:void(0);"><img src="image/demo/cms/payment/payment-2.png" alt="Payment"></a></li>
                            <li><a title="Payment Method" href="javascript:void(0);"><img src="image/demo/cms/payment/payment-3.png" alt="Payment"></a></li>
                            <li><a title="Payment Method" href="javascript:void(0);"><img src="image/demo/cms/payment/payment-4.png" alt="Payment"></a></li>
                            <li><a title="Payment Method" href="javascript:void(0);"><img src="image/demo/cms/payment/payment-5.png" alt="Payment"></a></li>
                        </ul>
                    </div>
                </div>				
            </div>
        </div>
    </div>
</div>		
<!-- FOOTER BOTTOM -->
<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                Maxshop © 2016 - 2016. MAGENTECH Store. All Rights Reserved.				
            </div>
            <div class="back-to-top"><i class="fa fa-angle-up"></i><span> Top </span></div>
        </div>
    </div>
</div>