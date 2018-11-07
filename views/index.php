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
            <main id="content" class="page-main">
                <!-- Block Spotlight1  -->
                <div class="so-spotlight1 ">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12 box_slider">
                                <div id="sohomepage-slider-home3">
                                    <div class="slider-container "> 
                                        <div id="so-slideshow" class="">
                                            <div class="module slideshow no-margin">
                                                <?php
                                                foreach ($vars["animacion"] as $data) {
                                                    $target = 'target="_blank"';
                                                    if ($data["url"] == "") {
                                                        $data["url"] = "#";
                                                        $target = '';
                                                    }                                                    
                                                    
                                                    if($data["seccion"])
                                                    {
                                                        $data["url"] = "index.php?controlador=Index&accion=categoria&id=".$data["seccion"];
                                                        $target = '';
                                                    }
                                                    
                                                    if($data["articulo"])
                                                    {
                                                        $data["url"] = "index.php?controlador=Index&accion=interna&id=".$data["seccion"]."&idp=".$data["articulo"];
                                                        $target = '';
                                                    }
                                                    
                                                    ?>
                                                    <div class="item" style="width:870px !important; height:433px !important;">
                                                        <?php $settings = array('w'=>870,'h'=>433,'canvas-color' => '#ffffff'); ?>
                                                        <a href="<?php echo $data["url"]; ?>" <?php echo $target;?> ><img src="<?php echo $vars["formXhtml"]->resize($vars["config"]->get('BANNERS_ROOT') . $data["archivo"],$settings) ?>" alt="<?php echo $data["nombre"]; ?>" class="img-responsive" width="870" height="433"></a>
                                                        <div class="sohomeslider-description">
                                                            <?php $settings = array('w'=>264,'h'=>206); ?>
                                                            <img class="image image-sl11 pos-right img-active" src="<?php echo $vars["formXhtml"]->resize($vars["config"]->get('BANNERS_ROOT') . $data["archivo2"],$settings) ?>" alt="<?php echo $data["nombre"]; ?>" width="264" height="206">
                                                            <div class="text pos-right text-sl11">
                                                                <h3 class="tilte modtitle-sl11  title-active"><?php echo $data["nombre"]; ?></h3>
                                                                <p class="des des-sl11 des-active"><?php echo $data["nombre_segundo"]; ?></p>      
                                                            </div> 					
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>                                                                                               
                                            </div>
                                            <div class="loadeding"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 box_banner">
                                <div class="module banner-right hidden-md  hidden-sm hidden-xs">
                                    <div class="banner-right">	
                                        <ul>
                                            <?php
                                            foreach ($vars["derecho"] as $data) {
                                                $target = 'target="_blank"';
                                                if ($data["url"] == "") {
                                                    $data["url"] = "#";
                                                    $target = '';
                                                }                                                    

                                                if($data["seccion"])
                                                {
                                                    $data["url"] = "index.php?controlador=Index&accion=categoria&id=".$data["seccion"];
                                                    $target = '';
                                                }

                                                if($data["articulo"])
                                                {
                                                    $data["url"] = "index.php?controlador=Index&accion=interna&id=".$data["seccion"]."&idp=".$data["articulo"];
                                                    $target = '';
                                                }
                                                ?>
                                                <?php $settings = array('w'=>290,'h'=>212,'canvas-color' => '#ffffff'); ?>
                                                <li><a title="<?php echo $data["nombre"]; ?>" href="<?php echo $data["url"]; ?>" <?php echo $target;?>><img src="<?php echo $vars["formXhtml"]->resize($vars["config"]->get('BANNERS_ROOT') . $data["archivo"],$settings) ?>" alt="<?php echo $data["nombre"]; ?>" width="290" height="212"></a></li>
                                                <?php
                                            }
                                            ?>                                                                                        
                                        </ul>
                                    </div>
                                </div>																		
                            </div>
                        </div>
                    </div>  
                </div>
                <!--Block Spotlight2  -->
                <div class="so-spotlight2">
                    <div class="container">
                        <ul class="mudule list-services row">
                            <?php
                            foreach ($vars["medio"] as $data) {
                                $target = 'target="_blank"';
                                if ($data["url"] == "") {
                                    $data["url"] = "#";
                                    $target = '';
                                }                                                    

                                if($data["seccion"])
                                {
                                    $data["url"] = "index.php?controlador=Index&accion=categoria&id=".$data["seccion"];
                                    $target = '';
                                }

                                if($data["articulo"])
                                {
                                    $data["url"] = "index.php?controlador=Index&accion=interna&id=".$data["seccion"]."&idp=".$data["articulo"];
                                    $target = '';
                                }
                                ?>
                                <?php $settings = array('w'=>364,'h'=>104,'canvas-color' => '#ffffff'); ?>
                                <li class="item-service col-lg-4 col-md-4 col-sm-4 col-xs-12"><a title="<?php echo $data["nombre"]; ?>" href="<?php echo $data["url"]; ?>" <?php echo $target;?>><img src="<?php echo $vars["formXhtml"]->resize($vars["config"]->get('BANNERS_ROOT') . $data["archivo"],$settings) ?>" alt="<?php echo $data["nombre"]; ?>" width="364" height="104"></a></li>
                                <?php
                            }
                            ?>                             
                        </ul>
                    </div>
                </div>
                <!-- Block Spotlight3  -->
                <div class="so-spotlight3">
                    <div class="container">
                        <!-- Mod Deals -->
                        <?php
                        foreach ($vars["mejores_ofertas"] as $data) {                            
                            $array_articulos = $vars["indexModel"]->listArraySql("SELECT articulo.*, (SELECT archivo AS archivo_galeria FROM galeria WHERE articulo = articulo.id ORDER BY id LIMIT 1 ) AS archivo_galeria FROM  articulo INNER JOIN articulo_seccion ON articulo_seccion.articulo = articulo.id WHERE activo = 1 AND articulo_seccion.seccion = '" . $data["id"] . "' ORDER BY orden");
                            ?>
                            <div class="module so-deals">
                                <h3 class="modtitle"><span><?php echo $data["nombre"]; ?></span></h3>
                                <div class="modcontent">
                                    <div id="so_deals_14513931681482050581" class="so-deal modcontent products-list grid clearfixbutton-type1 style2">
                                        <div class="extraslider-inner product-layout deal-slider-home7">   			
                                            <?php
                                            foreach ($array_articulos as $data_art) {
                                            $url_galeria="GALERIA_ROOT";    
                                            if($data_art["archivo_galeria"]==null || $data_art["archivo_galeria"]=="")
                                            {
                                                $data_art["archivo_galeria"]=$data_art["archivo"];
                                                $url_galeria="ARTICULOS_ROOT";
                                            }                                           
                                            ?>                                            
                                            <div class="product-thumb transition product-item-container">
                                                <div class="left-block">
                                                    <div class="product-image-container">
                                                        <div class="image">
                                                            <span class="label label-sale">Venta</span>
                                                            <a class="lt-image" href="index.php?controlador=Index&accion=interna&id=<?php echo $data["id"];?>&idp=<?php echo $data_art["id"];?>">
                                                                <?php $settings = array('w'=>600,'h'=>600,'canvas-color' => '#ffffff'); ?>
                                                                <img  src="<?php echo $vars["formXhtml"]->resize($vars["config"]->get('ARTICULOS_ROOT') . $data_art["archivo"],$settings) ?>" alt="<?php echo $data_art["nombre"];?>" title="<?php echo $data_art["nombre"];?>" class="img-1 img-responsive" width="600" height="600" />                                                                
                                                                <img  src="<?php echo $vars["formXhtml"]->resize($vars["config"]->get($url_galeria) . $data_art["archivo_galeria"],$settings) ?>" alt="<?php echo $data_art["nombre"];?>" title="<?php echo $data_art["nombre"];?>" class="img-2 img-responsive" width="600" height="600" />                                                                
                                                            </a>
                                                            <!--<div class="item-time">
                                                                <div class="item-timer">
                                                                    <div class="defaultCountdown-30"></div>
                                                                </div>
                                                            </div>-->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="right-block">
                                                    <div class="caption">
                                                        <!--
                                                        <div class="rating">
                                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                                            <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                                        </div>
                                                        -->
                                                        <h4><a href="index.php?controlador=Index&accion=interna&id=<?php echo $data["id"];?>&idp=<?php echo $data_art["id"];?>" title="<?php echo $data_art["nombre"];?>"><?php echo $data_art["nombre"];?></a></h4>
                                                        <p class="price">
                                                            <span class="price-new">$<?php echo number_format($data_art["precio"]);?></span> 
                                                            <?php
                                                            if($data_art["precio_publico"]!=""&&$data_art["precio_publico"]!=0&&$data_art["precio_publico"]!=null)
                                                            {
                                                            ?>
                                                            <span class="price-old">$<?php echo number_format($data_art["precio_publico"]);?></span>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <span class="price-old">$0</span>		 
                                                            <?php    
                                                            }
                                                            ?>                                                    
                                                            <?php
                                                            if($data_art["precio_publico"]!="" && $data_art["precio_publico"]!="0")
                                                            {
                                                            ?>
                                                            <span class="label label-percent">-<?php echo round((($data_art["precio_publico"]-$data_art["precio"])/$data_art["precio_publico"])*100,2);?>%</span>    
                                                            <?php
                                                            }
                                                            ?>                                                            
                                                        </p>							
                                                    </div>	
                                                </div>
                                                <div class="button-group">      
                                                        <button class="addToCart" type="button" data-toggle="tooltip" title="añadir al carrito de compras" onclick="cart.add(<?php echo $data_art["id"];?>, '1','<?php echo $vars["formXhtml"]->resize($vars["config"]->get('ARTICULOS_ROOT') . $data_art["archivo"],$settings);?>','<?php echo $data_art["nombre"];?>','index.php?controlador=Index&accion=interna&id=<?php echo $data["id"];?>&idp=<?php echo $data_art["id"];?>','<?php echo "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];?>','<?php echo $data_art["precio"];?>');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs"></span></button>                                                        
                                                </div>
                                                <!-- End right block -->
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div><!--/.modcontent-->
                            </div>
                            <?php
                        }
                        ?>
                        <!-- End Mod -->
                    </div>  
                </div>
                <!--Block Spotlight4  -->
                <div class="so-spotlight4" style="display: none">
                    <div class="container">
                        <div class="row">
                            <div class="module so-latest-blog latest-blog col-md-4 col-sm-6 col-xs-12">
                                <h3 class="modtitle"><span>News Updates</span></h3>
                                <div id="so_latest_blog_180" class="so-blog-external button-type2 button-type2">
                                    <div class="blog-external-simple">
                                        <div class="media">
                                            <div class="item">
                                                <div class="media-body">

                                                    <div class="media-date-added">28<br>
                                                        <span>Mar</span>
                                                    </div>
                                                    <div class="media-content">
                                                        <h4 class="media-heading">
                                                            <a href="blog-detail.html" title="Ac tincidunt Suspendisse malesuada" target="_blank">Pellentse tincidunt Suspendis malesu</a>
                                                        </h4>
                                                        <div class="description">
                                                            Commodo laoreet semper tincidunt lorem Vestibulum nunc at In 
                                                            Curabitur magna.....
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="item">
                                                <div class="media-body">

                                                    <div class="media-date-added">01<br>
                                                        <span>Sep</span>
                                                    </div>
                                                    <div class="media-content">
                                                        <h4 class="media-heading">
                                                            <a href="blog-detail.html" title="Biten demonstraverunt lector legere legunt saepius" target="_blank">Biten demonst raverunt lector legere </a>
                                                        </h4>
                                                        <div class="description">
                                                            Commodo laoreet semper tincidunt lorem Vestibulum nunc at In Curabitur magna. Eu.....
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bestseller col-md-4 col-sm-6 col-xs-12">
                                <div class="bestseller-inner">
                                    <div>
                                        <h3>Bestsellers</h3>
                                        <div class="product-layout ">
                                            <div class="product-thumb transition">
                                                <div class="image"><a href="product.html"><img  src="image/demo/shop/product/b1.jpg" alt="" title="Duidem rerum facilis" class="img-1 img-responsive" /></a></div>
                                                <div class="caption">
                                                    <div class="rating">
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                                    </div>
                                                    <h4><a href="product.html">Fuzan Sumata masen itcute</a></h4>

                                                    <p class="price">
                                                        <span class="price-new"> $88.00</span>
                                                        <span class="price-old">$129.00</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-layout ">
                                            <div class="product-thumb transition">
                                                <div class="image"><a href="product.html"><img  src="image/demo/shop/product/b2.png" alt="" title="Duidem rerum facilis" class="img-1 img-responsive" /></a></div>
                                                <div class="caption">
                                                    <div class="rating">
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                    </div>
                                                    <h4><a href="product.html">Duidem gokensie rerum facilis</a></h4>

                                                    <p class="price">
                                                        <span class="price-new"> $123.00</span>
                                                        <span class="price-old">$159.00</span>
                                                    </p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="module testimonial col-md-4 col-sm-12 col-xs-12">
                                <div class="clients_say">
                                    <div class="block-title"><h3>Testimonial</h3></div>
                                    <div class="slider-clients-say">
                                        <div class="block_content">
                                            <div class="image"><img src="image/demo/cms/clients_say.png" alt="">
                                            </div>
                                            <div class="block-info">
                                                <div class="text">"Aliquam ut tellus dignissim, cursus erat ultricies tellus cursus erat ultricies tellus.. Nulla tempus sollicitudin mauris cursus dictum. Commodo laoreet semper lorem."</div>
                                                <div class="info">
                                                    <div class="author">- BonBon Supper</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="block_content">
                                            <div class="image"><img src="image/demo/cms/clients_say.png" alt="">
                                            </div>
                                            <div class="block-info">
                                                <div class="text">"Dignissim ut tellus Aliquam, cursus erat ultricies tellus cursus erat ultricies tellus.. Nulla tempus sollicitudin mauris cursus dictum. Commodo laoreet semper  lorem."</div>
                                                <div class="info">
                                                    <div class="author">- Aliquam Tellus</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Block Spotlight5  -->
                <div class="so-spotlight5" style="display: none">
                    <div class="container">
                        <div class="block-brand">
                            <div class="brand-slider">
                                <div class="item-manu">
                                    <a href="#" title="Link">
                                        <img src="image/demo/brands/2.jpg" alt="img">
                                    </a>
                                </div>
                                <div class="item-manu">
                                    <a href="#" title="Link">
                                        <img src="image/demo/brands/3.jpg" alt="img">
                                    </a>
                                </div>
                                <div class="item-manu">
                                    <a href="#" title="Link">
                                        <img src="image/demo/brands/4.jpg" alt="img">
                                    </a>
                                </div>
                                <div class="item-manu">
                                    <a href="#" title="Link">
                                        <img src="image/demo/brands/5.jpg" alt="img">
                                    </a>
                                </div>
                                <div class="item-manu">
                                    <a href="#" title="Link">
                                        <img src="image/demo/brands/2.jpg" alt="img">
                                    </a>
                                </div>
                                <div class="item-manu">
                                    <a href="#" title="Link">
                                        <img src="image/demo/brands/3.jpg" alt="img">
                                    </a>
                                </div>
                                <div class="item-manu">
                                    <a href="#" title="Link">
                                        <img src="image/demo/brands/9.jpg" alt="img">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main >
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