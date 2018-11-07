<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include 'include/head.php';
        ?>
        <style>
            #tab-1 ol{
                list-style-type: decimal !important;
                margin-left: 50px !important;
            }
            
            #tab-1 ul{
                list-style-type: disc !important;
                margin-left: 50px !important;
            }
            
        </style>
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
                    <li><a href="#"><?php echo $vars["seccion"]["nombre"]; ?></a></li>
                    <li><a href="#"><?php echo $vars["producto"]["nombre"]; ?></a></li>
                </ul>

                <div class="row">
                    <!--Middle Part Start-->
                    <div id="content" class="col-md-12 col-sm-12">

                        <div class="product-view row">
                            <div class="left-content-product col-lg-10 col-xs-12">
                                <div class="row">
                                    <div class="content-product-left  col-sm-7 col-xs-12 ">
                                        <div id="thumb-slider-vertical" class="thumb-vertical-outer">
                                            <span class="btn-more prev-thumb nt"><i class="fa fa-chevron-up"></i></span>
                                            <span class="btn-more next-thumb nt"><i class="fa fa-chevron-down"></i></span>
                                            <ul class="thumb-vertical">
                                                <li class="owl2-item">
                                                    <a data-index="0" class="img thumbnail" data-image="<?php echo $vars["config"]->get('ARTICULOS_ROOT') . $vars["producto"]["archivo"]; ?>" title="Canon EOS 5D">
                                                        <img src="<?php echo $vars["config"]->get('ARTICULOS_ROOT') . $vars["producto"]["archivo"]; ?>" title="Canon EOS 5D" alt="Canon EOS 5D">
                                                    </a>
                                                </li>
                                                <?php
                                                $i = 1;
                                                foreach ($vars["galeria"] as $data) {
                                                    ?>
                                                    <li class="owl2-item">
                                                        <a data-index="<?php echo $i; ?>" class="img thumbnail " data-image="<?php echo $vars["config"]->get('GALERIA_ROOT') . $data["archivo"]; ?>" title="<?php echo $data["nombre"]; ?>">
                                                            <img src="<?php echo $vars["config"]->get('GALERIA_ROOT') . $data["archivo"]; ?>" title="<?php echo $data["nombre"]; ?>" alt="<?php echo $data["nombre"]; ?>">
                                                        </a>
                                                    </li>
                                                    <?php
                                                    $i++;
                                                }
                                                ?>                                                                                         																						
                                            </ul>


                                        </div>
                                        <div class="large-image  vertical">
                                            <?php $settings = array('w' => 600, 'h' => 600, 'canvas-color' => '#ffffff'); ?>
                                            <img itemprop="image" class="product-image-zoom" src="<?php echo $vars["formXhtml"]->resize($vars["config"]->get('ARTICULOS_ROOT') . $vars["producto"]["archivo"], $settings) ?>" data-zoom-image="<?php echo $vars["config"]->get('ARTICULOS_ROOT') . $vars["producto"]["archivo"]; ?>" title="<?php echo $vars["producto"]["nombre"]; ?>" alt="<?php echo $vars["producto"]["nombre"]; ?>" width="600" height="600">
                                        </div>
                                        <?php
                                        if ($vars["producto"]["video"] != "") {
                                            ?>
                                            <a class="thumb-video pull-left" href="<?php echo $vars["producto"]["video"]; ?>"><i class="fa fa-youtube-play"></i></a>
                                            <?php
                                        }
                                        ?>

                                    </div>

                                    <div class="content-product-right col-sm-5 col-xs-12">
                                        <div class="title-product">
                                            <h1><?php echo $vars["producto"]["nombre"]; ?></h1>
                                        </div>
                                        <!-- Review ---->
                                        <div class="box-review form-group">
                                            <div class="ratings">
                                                <div class="rating-box">
                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="product-box-desc">
                                            <div class="inner-box-desc">
                                                <div class="price-tax"><span>Precio Descuento:</span> $<?php echo $vars["producto"]["precio"]; ?>
                                                    <?php
                                                    if ($vars["producto"]["descuento"] != "" && $vars["producto"]["descuento"] != "0") {
                                                        ?>
                                                        <span class="label label-percent">-<?php echo $vars["producto"]["descuento"]; ?>%</span>    
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="price-tax"><span>Precio:</span> $<?php echo $vars["producto"]["precio_publico"]; ?></div>
                                                <div class="brand"><span>Marca:</span> <?php echo $vars["producto"]["marca"]; ?></div>
                                                <div class="model"><span>Codigo:</span> <?php echo $vars["producto"]["codigo"]; ?></div>											

                                            </div>
                                        </div>


                                        <div id="product">

                                            <div class="form-group box-info-product">
                                                <div class="cart">
                                                    <input type="button" data-toggle="tooltip" title="" value="Añadir a carrito de compras" data-loading-text="Loading..." id="button-cart" class="btn btn-mega btn-lg" onclick="cart.add(<?php echo $vars["producto"]["id"]; ?>, '1', '<?php echo $vars["formXhtml"]->resize($vars["config"]->get('ARTICULOS_ROOT') . $vars["producto"]["archivo"], $settings); ?>', '<?php echo $vars["producto"]["nombre"]; ?>', 'index.php?controlador=Index&accion=interna&id=<?php echo $data["id"]; ?>&idp=<?php echo $data_art["id"]; ?>', '<?php echo "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>', '<?php echo $vars["producto"]["precio"]; ?>');" data-original-title="Add to Cart">
                                                </div>                                                
                                            </div>


                                        </div>
                                        <!-- end box info product -->
                                    </div>
                                </div>
                            </div>

                            <!--
                            <section class="col-lg-2 hidden-sm hidden-md hidden-xs slider-products">
                                    <div class="module col-sm-12 four-block">
                                            <div class="modcontent clearfix">
                                                    <div class="policy-detail">
                                                            <div class="banner-policy">
                                                                    <div class="policy policy1">
                                                                            <a href="#"> <span class="ico-policy">&nbsp;</span>	90 day
                                                                            <br> money back </a>
                                                                    </div>
                                                                    <div class="policy policy2">
                                                                            <a href="#"> <span class="ico-policy">&nbsp;</span>	In-store exchange </a>
                                                                    </div>
                                                                    <div class="policy policy3">
                                                                            <a href="#"> <span class="ico-policy">&nbsp;</span>	lowest price guarantee </a>
                                                                    </div>
                                                                    <div class="policy policy4">
                                                                            <a href="#"> <span class="ico-policy">&nbsp;</span>	shopping guarantee </a>
                                                                    </div>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                            </section>
                            -->
                        </div>

                        <!-- Product Tabs -->
                        <div class="producttab ">
                            <div class="tabsslider  col-xs-12">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-1">Descripción</a></li>
                                    <li class="item_nonactive"><a data-toggle="tab" href="#tab-review">Comentarios (<?php echo count($vars['comentarios']); ?>)</a></li>
                                    <!--<li class="item_nonactive"><a data-toggle="tab" href="#tab-4">Tags</a></li>
                                    <li class="item_nonactive"><a data-toggle="tab" href="#tab-5">Custom Tab</a></li>
                                    -->
                                </ul>
                                <div class="tab-content col-xs-12">
                                    <div id="tab-1" class="tab-pane fade active in">
                                        <?php echo $vars["producto"]["html"]; ?>									
                                    </div>
                                    <div id="tab-review" class="tab-pane fade">
                                        <form>
                                            <h2 id="review-title" style="color: #009688;">Ingresar su comentario sobre este producto</h2>
                                            <div id="alerta-comentario" style="display: none" class="alert alert-info"><i class="fa fa-exclamation-circle"></i><span>wi</span></div>
                                            <div class="contacts-form">
                                                <div class="form-group"> <span class="icon icon-bubbles-2"></span>
                                                    <textarea id="comentario" class="form-control" name="text" ></textarea>
                                                </div>                                                 
                                                <div class="buttons clearfix"><a id="btn-comentar" class="btn buttonGray">Comentar</a></div>
                                            </div>
                                            <br/>
                                            <div id="review" class="comentarios">
                                                <?php
                                                foreach ($vars['comentarios'] as $clave => $valor) {
                                                    ?>
                                                    <table class="table table-striped table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width: 50%;"><strong><?php echo $valor["usuario_crear"]; ?></strong></td>
                                                                <td class="text-right"><?php echo $valor["fecha_crear"]; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <p><?php echo $valor["comentario"]; ?></p>                                                                
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="text-right"></div>
                                                    <?php
                                                }
                                                ?>                                                
                                            </div>                                            
                                        </form>
                                    </div>
                                    <div id="tab-4" class="tab-pane fade">
                                        <a href="#">Monitor</a>,
                                        <a href="#">Apple</a>				
                                    </div>
                                    <div id="tab-5" class="tab-pane fade">
                                        <table class="data-table" style="width: 100%;" border="1">
                                            <tbody>
                                                <tr>
                                                    <td>Brand</td>
                                                    <td><img  src="image/demo/shop/category/logo-client.png"  title="Apple Cinema 30&quot;" class="img-1 img-responsive" /></td>
                                                </tr>
                                                <tr>
                                                    <td>History</td>
                                                    <td>Color sit amet, consectetur adipiscing elit. In gravida pellentesque ligula, vel eleifend turpis blandit vel. Nam quis lorem ut mi mattis ullamcorper ac quis dui. Vestibulum et scelerisque ante, eu sodales mi. Nunc tincidunt tempus varius. Integer ante dolor, suscipit non faucibus a, scelerisque vitae sapien.</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- //Product Tabs -->
                        <!-- Related Products -->
                        <div style="display: none" class="related titleLine products-list grid module ">
                            <h3 class="modtitle"><span>Related Products</span></h3>
                            <div class="releate-products ">
                                <div class="product-layout">
                                    <div class="product-item-container">
                                        <div class="left-block">
                                            <div class="product-image-container second_img ">
                                                <img  src="image/demo/shop/product/1.png"  title="Apple Cinema 30&quot;" class="img-1 img-responsive" />
                                                <img  src="image/demo/shop/product/2.png"  title="Apple Cinema 30&quot;" class="img-2 img-responsive" />
                                            </div>
                                            <!--Sale Label-->
                                            <span class="label label-sale">Sale</span>
                                            <span class="label label-new">new</span>
                                        </div>
                                        <div class="button-group">
                                            <button class="wishlist btn-button" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('42');"><i class="fa fa-heart"></i></button>
                                            <button class="addToCart" type="button" data-toggle="tooltip" title="Add to Cart" onclick="cart.add('42', '1');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs"></span></button>
                                            <button class="compare" type="button" data-toggle="tooltip" title="Compare this Product" onclick="compare.add('42');"><i class="fa fa-exchange"></i></button>
                                            <a class="quickview iframe-link visible-lg btn-button" data-toggle="tooltip" title="" data-fancybox-type="iframe" href="quickview.html" data-original-title="Quickview"> <i class="fa fa-search"></i> </a>
                                        </div>

                                        <div class="right-block">
                                            <div class="caption">
                                                <h4><a href="product.html">Apple Cinema 30&quot;</a></h4>		
                                                <div class="ratings">
                                                    <div class="rating-box">
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                    </div>
                                                </div>

                                                <div class="price">
                                                    <span class="price-new">$74.00</span> 
                                                    <span class="price-old">$122.00</span>		 
                                                    <span class="label label-percent">-40%</span>    
                                                </div>
                                                <div class="description item-desc hidden">
                                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut l..</p>
                                                </div>
                                            </div>
                                        </div><!-- right block -->

                                    </div>
                                </div>
                                <div class="product-layout ">
                                    <div class="product-item-container">
                                        <div class="left-block">
                                            <div class="product-image-container second_img ">
                                                <img  src="image/demo/shop/product/f9.jpg"  title="Apple Cinema 30&quot;" class="img-1 img-responsive" />
                                                <img  src="image/demo/shop/product/1.png"  title="Apple Cinema 30&quot;" class="img-2 img-responsive" />

                                            </div>
                                            <!--Sale Label-->
                                            <span class="label label-sale">Sale</span>
                                            <span class="label label-new">new</span>
                                        </div>
                                        <div class="button-group">
                                            <button class="wishlist btn-button" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('42');"><i class="fa fa-heart"></i></button>
                                            <button class="addToCart" type="button" data-toggle="tooltip" title="Add to Cart" onclick="cart.add('42', '1');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs"></span></button>
                                            <button class="compare" type="button" data-toggle="tooltip" title="Compare this Product" onclick="compare.add('42');"><i class="fa fa-exchange"></i></button>
                                            <a class="quickview iframe-link visible-lg btn-button" data-toggle="tooltip" title="" data-fancybox-type="iframe" href="quickview.html" data-original-title="Quickview"> <i class="fa fa-search"></i> </a>
                                        </div>

                                        <div class="right-block">
                                            <div class="caption">
                                                <h4><a href="product.html">Apple Cinema 30&quot;</a></h4>		
                                                <div class="ratings">
                                                    <div class="rating-box">
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                    </div>
                                                </div>

                                                <div class="price">
                                                    <span class="price-new">$74.00</span> 
                                                    <span class="price-old">$122.00</span>		 
                                                    <span class="label label-percent">-40%</span>    
                                                </div>
                                                <div class="description item-desc hidden">
                                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut l..</p>
                                                </div>
                                            </div>
                                        </div><!-- right block -->

                                    </div>
                                </div>
                                <div class="product-layout ">
                                    <div class="product-item-container">
                                        <div class="left-block">
                                            <div class="product-image-container second_img ">
                                                <img  src="image/demo/shop/product/3.png"  title="Apple Cinema 30&quot;" class="img-1 img-responsive" />
                                                <img  src="image/demo/shop/product/34.jpg"  title="Apple Cinema 30&quot;" class="img-2 img-responsive" />
                                            </div>
                                            <!--Sale Label-->
                                            <span class="label label-sale">Sale</span>
                                        </div>
                                        <div class="button-group">
                                            <button class="wishlist btn-button" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('42');"><i class="fa fa-heart"></i></button>
                                            <button class="addToCart" type="button" data-toggle="tooltip" title="Add to Cart" onclick="cart.add('42', '1');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs"></span></button>
                                            <button class="compare" type="button" data-toggle="tooltip" title="Compare this Product" onclick="compare.add('42');"><i class="fa fa-exchange"></i></button>
                                            <a class="quickview iframe-link visible-lg btn-button" data-toggle="tooltip" title="" data-fancybox-type="iframe" href="quickview.html" data-original-title="Quickview"> <i class="fa fa-search"></i> </a>
                                        </div>

                                        <div class="right-block">
                                            <div class="caption">
                                                <h4><a href="product.html">Apple Cinema 30&quot;</a></h4>		
                                                <div class="ratings">
                                                    <div class="rating-box">
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                    </div>
                                                </div>

                                                <div class="price">
                                                    <span class="price-new">$74.00</span> 
                                                    <span class="price-old">$122.00</span>		 
                                                    <span class="label label-percent">-40%</span>    
                                                </div>
                                                <div class="description item-desc hidden">
                                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut l..</p>
                                                </div>
                                            </div>
                                        </div><!-- right block -->

                                    </div>
                                </div>
                                <div class="product-layout ">
                                    <div class="product-item-container">
                                        <div class="left-block">
                                            <div class="product-image-container second_img ">
                                                <img  src="image/demo/shop/product/11.jpg"  title="Apple Cinema 30&quot;" class="img-1 img-responsive" />
                                                <img  src="image/demo/shop/product/15.jpg"  title="Apple Cinema 30&quot;" class="img-2 img-responsive" />
                                            </div>
                                            <!--Sale Label-->
                                            <span class="label label-sale">Sale</span>

                                        </div>

                                        <div class="button-group">
                                            <button class="wishlist btn-button" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('42');"><i class="fa fa-heart"></i></button>
                                            <button class="addToCart" type="button" data-toggle="tooltip" title="Add to Cart" onclick="cart.add('42', '1');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs"></span></button>
                                            <button class="compare" type="button" data-toggle="tooltip" title="Compare this Product" onclick="compare.add('42');"><i class="fa fa-exchange"></i></button>
                                            <a class="quickview iframe-link visible-lg btn-button" data-toggle="tooltip" title="" data-fancybox-type="iframe" href="quickview.html" data-original-title="Quickview"> <i class="fa fa-search"></i> </a>
                                        </div>
                                        <div class="right-block">
                                            <div class="caption">
                                                <h4><a href="product.html">Apple Cinema 30&quot;</a></h4>		
                                                <div class="ratings">
                                                    <div class="rating-box">
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                    </div>
                                                </div>

                                                <div class="price">
                                                    <span class="price-new">$74.00</span> 
                                                    <span class="price-old">$122.00</span>		 
                                                    <span class="label label-percent">-40%</span>    
                                                </div>
                                                <div class="description item-desc hidden">
                                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut l..</p>
                                                </div>
                                            </div>

                                        </div><!-- right block -->

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Upsell Products -->
                        <div style="display: none" class="related upsell titleLine products-list grid module ">
                            <h3 class="modtitle"><span>Upsell Products</span></h3>
                            <div class="upsell-products ">
                                <div class="product-layout">
                                    <div class="product-item-container">
                                        <div class="left-block">
                                            <div class="product-image-container second_img ">
                                                <img  src="image/demo/shop/product/e11.jpg"  title="Apple Cinema 30&quot;" class="img-1 img-responsive" />
                                                <img  src="image/demo/shop/product/e12.jpg"  title="Apple Cinema 30&quot;" class="img-2 img-responsive" />
                                            </div>
                                            <!--Sale Label-->
                                            <span class="label label-sale">Sale</span>

                                        </div>
                                        <div class="button-group">
                                            <button class="wishlist btn-button" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('42');"><i class="fa fa-heart"></i></button>
                                            <button class="addToCart" type="button" data-toggle="tooltip" title="Add to Cart" onclick="cart.add('42', '1');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs"></span></button>
                                            <button class="compare" type="button" data-toggle="tooltip" title="Compare this Product" onclick="compare.add('42');"><i class="fa fa-exchange"></i></button>
                                            <a class="quickview iframe-link visible-lg btn-button" data-toggle="tooltip" title="" data-fancybox-type="iframe" href="quickview.html" data-original-title="Quickview"> <i class="fa fa-search"></i> </a>
                                        </div>

                                        <div class="right-block">
                                            <div class="caption">
                                                <h4><a href="product.html">Apple Cinema 30&quot;</a></h4>		
                                                <div class="ratings">
                                                    <div class="rating-box">
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                    </div>
                                                </div>

                                                <div class="price">
                                                    <span class="price-new">$74.00</span> 
                                                    <span class="price-old">$122.00</span>		 
                                                    <span class="label label-percent">-40%</span>    
                                                </div>
                                                <div class="description item-desc hidden">
                                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut l..</p>
                                                </div>
                                            </div>
                                        </div><!-- right block -->

                                    </div>
                                </div>
                                <div class="product-layout ">
                                    <div class="product-item-container">
                                        <div class="left-block">
                                            <div class="product-image-container second_img ">
                                                <img  src="image/demo/shop/product/11.jpg"  title="Apple Cinema 30&quot;" class="img-1 img-responsive" />
                                                <img  src="image/demo/shop/product/10.jpg"  title="Apple Cinema 30&quot;" class="img-2 img-responsive" />

                                            </div>
                                            <!--Sale Label-->
                                            <span class="label label-sale">Sale</span>
                                            <span class="label label-new">new</span>
                                        </div>
                                        <div class="button-group">
                                            <button class="wishlist btn-button" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('42');"><i class="fa fa-heart"></i></button>
                                            <button class="addToCart" type="button" data-toggle="tooltip" title="Add to Cart" onclick="cart.add('42', '1');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs"></span></button>
                                            <button class="compare" type="button" data-toggle="tooltip" title="Compare this Product" onclick="compare.add('42');"><i class="fa fa-exchange"></i></button>
                                            <a class="quickview iframe-link visible-lg btn-button" data-toggle="tooltip" title="" data-fancybox-type="iframe" href="quickview.html" data-original-title="Quickview"> <i class="fa fa-search"></i> </a>
                                        </div>

                                        <div class="right-block">
                                            <div class="caption">
                                                <h4><a href="product.html">Apple Cinema 30&quot;</a></h4>		
                                                <div class="ratings">
                                                    <div class="rating-box">
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                    </div>
                                                </div>

                                                <div class="price">
                                                    <span class="price-new">$74.00</span> 
                                                    <span class="price-old">$122.00</span>		 
                                                    <span class="label label-percent">-40%</span>    
                                                </div>
                                                <div class="description item-desc hidden">
                                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut l..</p>
                                                </div>
                                            </div>
                                        </div><!-- right block -->

                                    </div>
                                </div>
                                <div class="product-layout ">
                                    <div class="product-item-container">
                                        <div class="left-block">
                                            <div class="product-image-container second_img ">
                                                <img  src="image/demo/shop/product/35.jpg"  title="Apple Cinema 30&quot;" class="img-1 img-responsive" />
                                                <img  src="image/demo/shop/product/34.jpg"  title="Apple Cinema 30&quot;" class="img-2 img-responsive" />
                                            </div>
                                            <!--Sale Label-->
                                            <span class="label label-sale">Sale</span>
                                            <span class="label label-new">new</span>
                                        </div>
                                        <div class="button-group">
                                            <button class="wishlist btn-button" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('42');"><i class="fa fa-heart"></i></button>
                                            <button class="addToCart" type="button" data-toggle="tooltip" title="Add to Cart" onclick="cart.add('42', '1');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs"></span></button>
                                            <button class="compare" type="button" data-toggle="tooltip" title="Compare this Product" onclick="compare.add('42');"><i class="fa fa-exchange"></i></button>
                                            <a class="quickview iframe-link visible-lg btn-button" data-toggle="tooltip" title="" data-fancybox-type="iframe" href="quickview.html" data-original-title="Quickview"> <i class="fa fa-search"></i> </a>
                                        </div>

                                        <div class="right-block">
                                            <div class="caption">
                                                <h4><a href="product.html">Apple Cinema 30&quot;</a></h4>		
                                                <div class="ratings">
                                                    <div class="rating-box">
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                    </div>
                                                </div>

                                                <div class="price">
                                                    <span class="price-new">$74.00</span> 
                                                    <span class="price-old">$122.00</span>		 
                                                    <span class="label label-percent">-40%</span>    
                                                </div>
                                                <div class="description item-desc hidden">
                                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut l..</p>
                                                </div>
                                            </div>
                                        </div><!-- right block -->

                                    </div>
                                </div>
                                <div class="product-layout ">
                                    <div class="product-item-container">
                                        <div class="left-block">
                                            <div class="product-image-container second_img ">
                                                <img  src="image/demo/shop/product/14.jpg"  title="Apple Cinema 30&quot;" class="img-1 img-responsive" />
                                                <img  src="image/demo/shop/product/15.jpg"  title="Apple Cinema 30&quot;" class="img-2 img-responsive" />
                                            </div>
                                            <!--Sale Label-->
                                            <span class="label label-sale">Sale</span>

                                        </div>

                                        <div class="button-group">
                                            <button class="wishlist btn-button" type="button" data-toggle="tooltip" title="Add to Wish List" onclick="wishlist.add('42');"><i class="fa fa-heart"></i></button>
                                            <button class="addToCart" type="button" data-toggle="tooltip" title="Add to Cart" onclick="cart.add('42', '1');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs"></span></button>
                                            <button class="compare" type="button" data-toggle="tooltip" title="Compare this Product" onclick="compare.add('42');"><i class="fa fa-exchange"></i></button>
                                            <a class="quickview iframe-link visible-lg btn-button" data-toggle="tooltip" title="" data-fancybox-type="iframe" href="quickview.html" data-original-title="Quickview"> <i class="fa fa-search"></i> </a>
                                        </div>
                                        <div class="right-block">
                                            <div class="caption">
                                                <h4><a href="product.html">Apple Cinema 30&quot;</a></h4>		
                                                <div class="ratings">
                                                    <div class="rating-box">
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                    </div>
                                                </div>

                                                <div class="price">
                                                    <span class="price-new">$74.00</span> 
                                                    <span class="price-old">$122.00</span>		 
                                                    <span class="label label-percent">-40%</span>    
                                                </div>
                                                <div class="description item-desc hidden">
                                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut l..</p>
                                                </div>
                                            </div>

                                        </div><!-- right block -->

                                    </div>
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            $(document).ready(function () {

                                var zoomCollection = '.large-image img';
                                $(zoomCollection).elevateZoom({
                                    zoomType: "inner",
                                    lensSize: "200",
                                    easing: true,
                                    gallery: 'thumb-slider-vertical',
                                    cursor: 'pointer',
                                    galleryActiveClass: "active"
                                });
                                $('.large-image').magnificPopup({
                                    items: [
                                        {src: 'image/demo/shop/product/j9.jpg'},
                                        {src: 'image/demo/shop/product/j6.jpg'},
                                        {src: 'image/demo/shop/product/j5.jpg'},
                                        {src: 'image/demo/shop/product/j4.jpg'},
                                    ],
                                    gallery: {enabled: true, preload: [0, 2]},
                                    type: 'image',
                                    mainClass: 'mfp-fade',
                                    callbacks: {
                                        open: function () {

                                            var activeIndex = parseInt($('#thumb-slider-vertical .img.active').attr('data-index'));
                                            var magnificPopup = $.magnificPopup.instance;
                                            magnificPopup.goTo(activeIndex);
                                        }
                                    }
                                });
                                $("#thumb-slider-vertical .owl2-item").each(function () {
                                    $(this).find("[data-index='0']").addClass('active');
                                });

                                $('.thumb-video').magnificPopup({
                                    type: 'iframe',
                                    iframe: {
                                        patterns: {
                                            youtube: {
                                                index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
                                                id: 'v=', // String that splits URL in a two parts, second part should be %id%
                                                src: '//www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe. 
                                            },
                                        }
                                    }
                                });

                                $('.product-options li.radio').click(function () {
                                    $(this).addClass(function () {
                                        if ($(this).hasClass("active"))
                                            return "";
                                        return "active";
                                    });

                                    $(this).siblings("li").removeClass("active");
                                    $(this).parent().find('.selected-option').html('<span class="label label-success">' + $(this).find('img').data('original-title') + '</span>');
                                });

                                var _isMobile = {
                                    iOS: function () {
                                        return navigator.userAgent.match(/iPhone/i);
                                    },
                                    any: function () {
                                        return (_isMobile.iOS());
                                    }
                                };

                                $(".thumb-vertical-outer .next-thumb").click(function () {
                                    $(".thumb-vertical-outer .lSNext").trigger("click");
                                });

                                $(".thumb-vertical-outer .prev-thumb").click(function () {
                                    $(".thumb-vertical-outer .lSPrev").trigger("click");
                                });

                                /*
                                 $(".thumb-vertical-outer .thumb-vertical").lightSlider({
                                 item: 3,
                                 autoWidth: false,
                                 vertical: true,
                                 slideMargin: 15,
                                 verticalHeight: 345,
                                 pager: false,
                                 controls: true,
                                 prevHtml: '<i class="fa fa-angle-up"></i>',
                                 nextHtml: '<i class="fa fa-angle-down"></i>',
                                 responsive: [
                                 {
                                 breakpoint: 1199,
                                 settings: {
                                 verticalHeight: 330,
                                 item: 3,
                                 }
                                 },
                                 {
                                 breakpoint: 1024,
                                 settings: {
                                 verticalHeight: 235,
                                 item: 2,
                                 slideMargin: 5,
                                 }
                                 },
                                 {
                                 breakpoint: 768,
                                 settings: {
                                 verticalHeight: 340,
                                 item: 3,
                                 }
                                 }
                                 ,
                                 {
                                 breakpoint: 480,
                                 settings: {
                                 verticalHeight: 100,
                                 item: 1,
                                 }
                                 }
                                 
                                 ]
                                 
                                 });
                                 */


                                // Product detial reviews button
                                $(".reviews_button,.write_review_button").click(function () {
                                    var tabTop = $(".producttab").offset().top;
                                    $("html, body").animate({scrollTop: tabTop}, 1000);
                                });


                                // Product detial reviews button
                                $("#btn-comentar").click(function () {

                                    var comentario = $("#comentario").val();

                                    if (comentario == "")
                                    {
                                        $("#alerta-comentario span").html("El comentario es obligatorio");
                                        $("#alerta-comentario").css("display", "block");
                                    } else
                                    {
                                        $("#alerta-comentario span").html("");
                                        $("#alerta-comentario").css("display", "none");

                                        $.post("index.php?controlador=Index&accion=comentar", {
                                            comentario: comentario,
                                            articulo: <?php echo $vars["producto"]["id"]; ?>
                                        }, function (data) {
                                            if (data == "0")
                                            {
                                                $("#alerta-comentario span").html("Para poder comentar debe registrarse como cliente.");
                                                $("#alerta-comentario").css("display", "block");
                                            } else
                                            {
                                                $("#alerta-comentario span").html("Felicitaciones el comentario fue exitoso.");
                                                $("#alerta-comentario").css("display", "block");
                                                $(".comentarios").html(data);
                                            }
                                        });
                                    }
                                });
                            });
                        </script>
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