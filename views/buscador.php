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
                    <li><a href="#">Buscador</a></li>                    
                </ul>

                <div class="row">
                    <!--Middle Part Start-->
                    <div id="content" class="col-md-12 col-sm-12">
                        <div class="products-category">						
                            <!-- Filters -->
                            <div style="display: none" class="product-filter filters-panel">
                                <div class="row">
                                    <div class="col-md-2 visible-lg">
                                        <div class="view-mode">
                                            <div class="list-view">
                                                <button class="btn btn-default grid " data-view="grid" data-toggle="tooltip"  data-original-title="Grid"><i class="fa fa-th"></i></button>
                                                <button class="btn btn-default list active" data-view="list" data-toggle="tooltip" data-original-title="List"><i class="fa fa-th-list"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="short-by-show form-inline text-right col-md-7 col-sm-8 col-xs-12">
                                        <div class="form-group short-by">
                                            <label class="control-label" for="input-sort">Sort By:</label>
                                            <select id="input-sort" class="form-control"
                                                    onchange="location = this.value;">
                                                <option value="" selected="selected">Default</option>
                                                <option value="">Name (A - Z)</option>
                                                <option value="">Name (Z - A)</option>
                                                <option value="">Price (Low &gt; High)</option>
                                                <option value="">Price (High &gt; Low)</option>
                                                <option value="">Rating (Highest)</option>
                                                <option value="">Rating (Lowest)</option>
                                                <option value="">Model (A - Z)</option>
                                                <option value="">Model (Z - A)</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="input-limit">Show:</label>
                                            <select id="input-limit" class="form-control" onchange="location = this.value;">
                                                <option value="" selected="selected">9</option>
                                                <option value="">25</option>
                                                <option value="">50</option>
                                                <option value="">75</option>
                                                <option value="">100</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="box-pagination col-md-3 col-sm-4 col-xs-12 text-right">
                                        <ul class="pagination">
                                            <li class="active"><span>1</span></li>
                                            <li><a href="#">2</a></li><li><a href="">&gt;</a></li>
                                            <li><a href="#">&gt;|</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- //end Filters -->

                            <!--changed listings-->
                            <div class="products-list row list">
                                <?php
                                foreach ($vars["productos"] as $data_art) {
                                $url_galeria="GALERIA_ROOT";    
                                if($data_art["archivo_galeria"]==null || $data_art["archivo_galeria"]=="")
                                {
                                    $data_art["archivo_galeria"]=$data_art["archivo"];
                                    $url_galeria="ARTICULOS_ROOT";
                                }    
                                ?>
                                <div class="product-layout col-md-3 col-sm-4 col-xs-12 ">
                                    <div class="product-item-container">
                                        <div class="left-block">
                                            <a class="lt-image" href="index.php?controlador=Index&accion=interna&id=<?php echo $data["id"];?>&idp=<?php echo $data_art["id"];?>">
                                            <div class="product-image-container lazy second_img ">
                                                <?php $settings = array('w'=>600,'h'=>600,'canvas-color' => '#ffffff'); ?>
                                                <img data-src="<?php echo $vars["formXhtml"]->resize($vars["config"]->get('ARTICULOS_ROOT') . $data_art["archivo"],$settings) ?>" src="<?php echo $vars["formXhtml"]->resize($vars["config"]->get('ARTICULOS_ROOT') . $data_art["archivo"],$settings) ?>"  alt="<?php echo $data_art["nombre"];?>" class="img-1 img-responsive" />
                                                <img data-src="<?php echo $vars["formXhtml"]->resize($vars["config"]->get($url_galeria) . $data_art["archivo_galeria"],$settings) ?>" src="<?php echo $vars["formXhtml"]->resize($vars["config"]->get('ARTICULOS_ROOT') . $data_art["archivo"],$settings) ?>"  alt="<?php echo $data_art["nombre"];?>" class="img-2 img-responsive" />
                                            </div>
                                            </a>
                                            <!--Sale Label-->
                                            <span class="label label-sale">Venta</span>
                                            <!--countdown box-->
                                            <div style="display: none" class="countdown_box">
                                                <div class="countdown_inner">
                                                    <div class="title">This limited offer ends</div>

                                                    <div class="defaultCountdown-30"></div>
                                                </div>
                                            </div>
                                            <!--end countdown box-->
                                        </div>
                                        <div class="right-block">
                                            <div class="caption">
                                                <h4><a href="index.php?controlador=Index&accion=interna&id=<?php echo $data["id"];?>&idp=<?php echo $data_art["id"];?>"><?php echo substr($data_art["nombre"], 0, 34);?></a></h4>		
                                                <div style="display: none" class="ratings">
                                                    <div class="rating-box">
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
                                                    </div>
                                                </div>

                                                <div class="price">
                                                    <span class="price-new">$<?php echo $data_art["precio"];?></span>                                                     
                                                    <?php
                                                    if($data_art["precio_publico"]!=""&&$data_art["precio_publico"]!=0&&$data_art["precio_publico"]!=null)
                                                    {
                                                    ?>
                                                    <span class="price-old">$<?php echo $data_art["precio_publico"];?></span>		 
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
                                                </div>
                                                <div style="display: none" class="description item-desc hidden">
                                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est . </p>
                                                </div>
                                            </div>
                                        </div><!-- right block -->
                                        <div class="button-group">
                                            <button class="addToCart" type="button" data-toggle="tooltip" title="Add to Cart" onclick="cart.add(<?php echo $data_art["id"];?>, '1','<?php echo $vars["formXhtml"]->resize($vars["config"]->get('ARTICULOS_ROOT') . $data_art["archivo"],$settings);?>','<?php echo $data_art["nombre"];?>','index.php?controlador=Index&accion=interna&id=<?php echo $data["id"];?>&idp=<?php echo $data_art["id"];?>','<?php echo "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];?>','<?php echo $data_art["precio"];?>');"><i class="fa fa-shopping-cart"></i> <span class="hidden-xs name-cart">Add to Cart</span></button>                                                                                        
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>                                
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