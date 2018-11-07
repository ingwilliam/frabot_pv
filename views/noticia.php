<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include 'include/head.php';
        ?>
        <style>
            #map,#panorama {
                height:300px;
                background:#6699cc;
            }
        </style>                      
        <script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?key=AIzaSyBE-6-cyOoHc2wpAjkplELUOBPetQI5vnc'></script>        
        <script type="text/javascript" src="js/gmaps.js"></script>	                	        
        <script type="text/javascript">
            var map;
            $(document).ready(function () {
                map = new GMaps({
                    div: '#map',
                    zoom: 18,
                    lat: 4.603759,
                    lng: -74.0881626
                });
                map.addMarker({
                    lat: 4.603759,
                    lng: -74.0881626,
                    title: 'FRABOT',
                    infoWindow: {
                        content: '<p>HTML Content</p>'
                    }
                });
            });
        </script>
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
                    <!--Left Part Start -->
                    <aside class="col-sm-4 col-md-3" id="column-left">
                        <div class="module blog-category titleLine">
                            <h3 class="modtitle"><span>Otras Noticias</span></h3>
                            <div class="modcontent">

                                <ul class="list-group ">
                                    <?php
                                    foreach ($vars["otros_producto"] as $clave => $valor) {
                                        ?>
                                        <li class="list-group-item"><a href="index.php?controlador=Index&accion=noticia&id=<?php echo $valor["seccion"]; ?>&idp=<?php echo $valor["id"]; ?>" class="group-item"><?php echo $valor["nombre"]; ?></a></li>
                                        <?php
                                    }
                                    ?>                                                        
                                </ul>

                            </div>
                        </div>

                        <div style="display: none" class="module latest-product titleLine">
                            <h3 class="modtitle"><span>Latest Product</span></h3>
                            <div class="modcontent ">
                                <div class="product-latest-item">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#"><img src="image/demo/shop/product/m1.jpg"alt="Cisi Chicken"title="Cisi Chicken"class="img-responsive" style="width: 90px; height: 90px;"></a>
                                        </div>
                                        <div class="media-body">
                                            <div class="caption">
                                                <h4><a href="#">Sunt Molup</a></h4>

                                                <div class="price">
                                                    <span class="price-new">$100.00</span>
                                                </div>
                                                <div class="ratings">
                                                    <div class="rating-box">
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="product-latest-item">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#"><img src="image/demo/shop/product/m2.jpg"alt="Cisi Chicken"title="Cisi Chicken"class="img-responsive" style="width: 90px; height: 90px;"></a>
                                        </div>
                                        <div class="media-body">
                                            <div class="caption">
                                                <h4><a href="#">Et Spare</a></h4>

                                                <div class="price">
                                                    <span class="price-new">$99.00</span>
                                                </div>
                                                <div class="ratings">
                                                    <div class="rating-box">
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="product-latest-item">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#"><img src="image/demo/shop/product/18.jpg"alt="Cisi Chicken"title="Cisi Chicken"class="img-responsive" style="width: 90px; height: 90px;"></a>
                                        </div>
                                        <div class="media-body">
                                            <div class="caption">
                                                <h4><a href="#">Cisi Chicken</a></h4>

                                                <div class="price">
                                                    <span class="price-new">$59.00</span>
                                                </div>
                                                <div class="ratings">
                                                    <div class="rating-box">
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="product-latest-item transition">
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#"><img src="image/demo/shop/product/9.jpg"alt="Cisi Chicken"title="Cisi Chicken"class="img-responsive" style="width: 90px; height:90px;"></a>
                                        </div>
                                        <div class="media-body">
                                            <div class="caption">
                                                <h4><a href="#">Kevin Labor</a></h4>
                                                <div class="price">
                                                    <span class="price-new">$245.00</span>
                                                </div>
                                                <div class="ratings">
                                                    <div class="rating-box">
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>			
                    </aside>
                    <!--Left Part End -->

                    <!--Middle Part Start-->
                    <div id="content" class="col-md-9 col-sm-8">
                        <div class="article-info">
                            <div class="blog-header">
                                <h3><?php echo $vars["producto"]["nombre"]; ?></h3>
                            </div>
                            <div class="article-sub-title">
                                    <!--<span class="article-author">Post by: <a href="#"> Admin</a></span>-->
                                <span class="article-author">fecha de creación: <?php echo $vars["producto"]["fecha_crear"]; ?></span>
                                <!--<span class="article-comment">0  Comments</span>-->
                            </div>
                            <div class="form-group">

                            </div>

                            <div class="article-description">
                                <?php
                                if ($vars["producto"]["id"] == 83) {
                                    ?>
                                    <div id="map"></div>
                                    <?php
                                } else {
                                    ?>
                                    <p>
                                        <a href="<?php echo $vars["config"]->get('ARTICULOS_ROOT') . $vars["producto"]["archivo"]; ?>" class="image-popup"><img style="float: left;" src="<?php echo $vars["config"]->get('ARTICULOS_ROOT') . $vars["producto"]["archivo"]; ?>" alt="<?php echo $vars["producto"]["nombre"]; ?>" width="300px" height="300px"></a>
                                        <?php echo $vars["producto"]["html"]; ?>
                                    </p>
                                    <?php
                                }
                                ?>                                						                                
                            </div>

                            <div style="display: none" class="panel panel-default related-comment">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <div id="comments" class="blog-comment-info">

                                            <h3 id="review-title">Leave your comment  </h3>
                                            <input type="hidden" name="blog_article_reply_id" value="0" id="blog-reply-id">
                                            <div class="comment-left contacts-form row">
                                                <div class="col-md-6">
                                                    <b>Your Name:</b>
                                                    <br>
                                                    <input type="text" name="name" value="" class="form-control">
                                                    <br>
                                                </div>
                                                <div class="col-md-12">
                                                    <b>Your Comment:</b>
                                                    <br>
                                                    <textarea rows="6" cols="50" name="text" class="form-control"></textarea>
                                                    <span style="font-size: 11px;">Note: HTML is not translated!</span>
                                                    <br>
                                                    <br>
                                                </div>
                                                <div class="col-md-4">
                                                    <b>Enter the code in the box below:</b>
                                                    <br>
                                                    <input type="text" name="captcha" style=""
                                                           value="" class="form-control">
                                                    <br>
                                                    <div class="form-group">
                                                        <img src="image/demo/content/captcha.jpg" alt=""
                                                             id="captcha">
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="text-left"><a id="button-comment"
                                                                      class="btn buttonGray"><span>Submit</span></a>
                                            </div>
                                        </div>
                                    </div>
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
    </body>
</html>