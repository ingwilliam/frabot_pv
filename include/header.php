<!-- Header Top -->
<div class="header-top compact-hidden">
    <div class="container">
        <div class="row">            
            <div class="header-top-left  col-lg-4  hidden-sm col-md-5 hidden-xs">
                <!--<ul class="list-inlines">
                    <li class="hidden-xs" >
                        <div class="welcome-msg"> 
                            <ul class="list-msg"> 
                                <li><label class="label-msg">This week</label> <a href="#">Sale special too good to miss in every gear</a></li> 
                                <li><label class="label-msg">Tomorrow</label> <a href="#">Laten ipsum dolor sit amet. In gravida pellen</a></li> 
                            </ul> 
                        </div>
                    </li>
                </ul>
                -->
            </div>            
            <div class="header-top-right collapsed-block col-lg-8 col-sm-12 col-md-7 col-xs-12 ">
                <h5 class="tabBlockTitle visible-xs">More<a class="expander " href="#TabBlock-1"><i class="fa fa-angle-down"></i></a></h5>
                <div class="tabBlock" id="TabBlock-1">
                    <ul class="top-link list-inline">
                        <li class="account" id="my_account">
                            <?php
                            if(isset($vars["dataUser"]))
                            {
                            ?>
                            <a href="#" title="Mi cuenta" class="btn btn-xs dropdown-toggle" data-toggle="dropdown"> <span >Mi cuenta <?php echo "(".$vars["dataUser"]["primer_nombre"]." ".$vars["dataUser"]["primer_apellido"].")";?></span> <span class="fa fa-angle-down"></span></a>
                            <ul class="dropdown-menu ">
                                <li><a href="index.php?controlador=Index&accion=perfil"><i class="fa fa-user"></i> Mi Perfil</a></li>
                                <li><a href="index.php?controlador=Index&accion=logout"><i class="fa fa-pencil-square-o"></i> Logout</a></li>
                            </ul>                            
                            <?php
                            }
                            else
                            {
                            ?>
                            <a href="#" title="Mi cuenta" class="btn btn-xs dropdown-toggle" data-toggle="dropdown"> <span >Mi cuenta </span> <span class="fa fa-angle-down"></span></a>
                            <ul class="dropdown-menu ">
                                <li><a href="index.php?controlador=Index&accion=registro"><i class="fa fa-user"></i> Registrar Cuenta</a></li>
                                <li><a href="index.php?controlador=Index&accion=login"><i class="fa fa-pencil-square-o"></i> Login</a></li>
                            </ul>
                            <?php
                            }
                            ?>                                                                                    
                        </li>
                        <li class="wishlist "><a href="index.php?controlador=Index&accion=micarrito" id="wishlist-total" class="top-link-wishlist" title="Mi Carrito (<?php echo count($vars["carrito"]);?>)">Mi Carrito (<span class="numero_carrito"><?php echo count($vars["carrito"]);?></span>)</a></li>                        
                        <!--
                        <li class="checkout hidden"><a href="checkout.html" class="top-link-checkout" title="Checkout"><span >Checkout</span></a></li>
                        <li class="login hidden"><a href="cart.html" title="Shopping Cart"><span >Shopping Cart</span></a></li>

                        <li class="form-group languages-block ">
                            <form action="index.html" method="post" enctype="multipart/form-data" id="bt-language">
                                <a class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
                                    <img src="image/demo/flags/gb.png" alt="English" title="English">
                                    <span class="">English</span>
                                    <span class="fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="index.html"><img class="image_flag" src="image/demo/flags/gb.png" alt="English" title="English" /> English </a></li>
                                    <li> <a href="index.html"> <img class="image_flag" src="image/demo/flags/lb.png" alt="Arabic" title="Arabic" /> Arabic </a> </li>
                                </ul>
                            </form>
                        </li>
                        <li class="form-group currency currencies-block">
                            <form action="index.html" method="post" enctype="multipart/form-data" id="currency">
                                <a class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
                                    <span class="icon icon-credit "></span> USD <span class="fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu btn-xs">
                                    <li> <a href="#">(€)&nbsp;Euro</a></li>
                                    <li> <a href="#">(£)&nbsp;Pounds	</a></li>
                                    <li> <a href="#">($)&nbsp;USD	</a></li>
                                </ul>
                            </form>
                        </li>
                        -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //Header Top --> 
<!-- Header center -->
<div class="header-center">
    <div class="container">
        <div class="row">
            <!-- Logo -->
            <div class="navbar-logo col-md-3 col-sm-4 col-xs-12">                
                <a href="<?php echo $vars["logo"]["url"]; ?>"><img src="<?php echo $vars["config"]->get('BANNERS_ROOT') . $vars["logo"]["archivo"]; ?>" title="<?php echo $vars["logo"]["nombre"]; ?>" alt="<?php echo $vars["logo"]["nombre"]; ?>" width="161" height="38" /></a>
            </div>
            <!-- //End Logo -->
            <div class="header-center-right col-md-9 col-sm-8 col-xs-12">			
                <!-- Cart Pro-->
                <div class="block-cart">
                    <div class="shopping_cart pull-right">
                        <div id="cart" class=" btn-group btn-shopping-cart">
                            <a data-loading-text="Loading..." class="btn-group top_cart dropdown-toggle" data-toggle="dropdown">
                                <div class="shopcart">
                                    <span class="handle pull-left"></span>
                                    <span class="numero_carrito"><?php echo count($vars["carrito"]);?></span><span class="total-shopping-cart cart-total-full"> Producto(s) - </span><span class="total_carrito">$<?php echo number_format($vars["total_cotizacion"]);?></span>
                                </div>
                            </a>
                            <ul class="tab-content content dropdown-menu pull-right shoppingcart-box" role="menu">							
                                <li>
                                    <table class="table table-striped">
                                        <tbody id="tabla_carrito">
                                            <?php
                                            foreach($vars["carrito"] as $clave => $valor)
                                            {
                                            $settings = array('w'=>50,'h'=>50,'canvas-color' => '#ffffff');
                                            ?>
                                            <tr>
                                                <td class="text-center" style="width:70px">
                                                    <img src="<?php echo $vars["formXhtml"]->resize($vars["config"]->get('ARTICULOS_ROOT') . $valor["archivo"],$settings) ?>" style="width:70px" alt="<?php echo $valor["nombre"];?>" title="<?php echo $valor["nombre"];?>" class="preview">
                                                </td>
                                                <td class="text-left"><?php echo $valor["nombre"];?></td>
                                                <td class="text-center"> x<?php echo $valor["cantidad"];?> </td>
                                                <td class="text-center"> $<?php echo number_format($valor["precio"]*$valor["cantidad"]);?> </td>
                                                <td class="text-right">
                                                    <a href="javascript::void(0)" onclick="cart.remove(<?php echo $valor["id"];?>,'<?php echo "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];?>');" class="fa fa-times fa-delete"></a>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                            ?>                                                                                        
                                        </tbody>
                                    </table>
                                </li>
                                <li>
                                    <div>
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td class="text-left"><strong>Total</strong>
                                                    </td>
                                                    <td class="text-right">
                                                        <input type="hidden" id="total_carrito" value="<?php echo $vars["total_cotizacion"];?>" /> 
                                                        <span class="total_carrito">$<?php echo number_format($vars["total_cotizacion"]);?></span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="text-center"> <a class="btn view-cart" href="index.php?controlador=Index&accion=micarrito"><i class="fa fa-shopping-cart"></i>Ver carrito</a></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>                    
                </div>                
                <!-- //End Cart Pro -->
                <!-- Phone -->
                <div class="phone-contact hidden-xs">
                    <div class="inner-info">
                        <h2><?php echo $vars["informativo"]["nombre"]; ?>:</h2><p><?php echo $vars["informativo"]["descripcion"]; ?></p>
                    </div>
                </div>
                <!-- //End Phone -->
            </div>
        </div>
    </div>
</div>
<!-- //Header center -->
<!-- Header Bottom -->
<div class="header-bottom compact-hidden">
    <div class="container">
        <div class="rows">
            <div class="header-bottom-inner">
                <div class="header-bottom-menu col-md-8 col-sm-2 col-xs-2">
                    <div class="responsive so-megamenu  megamenu-style-dev">
                        <nav class="navbar-default">
                            <div class=" container-megamenu  horizontal">
                                <div class="navbar-header">
                                    <button type="button" id="show-megamenu" data-toggle="collapse" class="navbar-toggle">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>		
                                </div>

                                <div class="megamenu-wrapper ">
                                    <span id="remove-megamenu" class="fa fa-times"></span>
                                    <div class="megamenu-pattern">
                                        <div class="container">
                                            <ul class="megamenu " data-transition="slide" data-animationtime="250">
                                                <?php
                                                foreach ($vars["menu_primero"] as $data) {
                                                    $class_padre = "";
                                                    if ($vars["menu_primero_categoria"] == $data["id"]) {
                                                        $class_padre = "home";
                                                    }
                                                    if ($data["url"] == "") {
                                                        $data["url"] = "index.php?controlador=Index&accion=categoria&id=".$data["id"];
                                                    }

                                                    $arraySubCategorias = $vars["indexModel"]->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion = 'MenuPrimero' AND padre = " . $data["id"] . " ORDER BY padre , orden");
                                                    ?>
                                                    <li class="<?php
                                                    if (count($arraySubCategorias) > 0) {
                                                        echo "with-sub-menu hover";
                                                    }
                                                    ?> <?php echo $class_padre; ?>">
                                                        <a href="<?php echo $data["url"]; ?>" class="<?php
                                                        if (count($arraySubCategorias) > 0) {
                                                            echo "clearfix";
                                                        }
                                                        ?>">
                                                            <strong><?php echo $data["nombre"]; ?></strong>
                                                            <?php
                                                            if (count($arraySubCategorias) > 0) {
                                                                ?>
                                                                <span class="label"></span>
                                                                <b class="caret"></b>
                                                                <?php
                                                            }
                                                            ?>                                                            
                                                        </a>
                                                        <?php
                                                        if (count($arraySubCategorias) > 0) {
                                                            ?>
                                                            <div class="sub-menu" style="width: 100%; display: none;">
                                                                <div class="content">
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="row">
                                                                                <?php
                                                                                $i = 1;
                                                                                foreach ($arraySubCategorias as $imgdata) {
                                                                                    if ($imgdata["url"] == "") {
                                                                                        $imgdata["url"] = "index.php?controlador=Index&accion=categoria&id=".$imgdata["id"];
                                                                                    }
                                                                                    ?>
                                                                                    <div class="col-md-3 img img<?php echo $i; ?>">
                                                                                        <a href="<?php echo $imgdata["url"]; ?>"><img src="<?php echo $vars["config"]->get('SECCION_ROOT') . $imgdata["archivo"]; ?>" alt="banner1" width="270" height="168"></a>
                                                                                    </div>
                                                                                    <?php
                                                                                    $i++;
                                                                                }
                                                                                ?>                                                                                                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <?php
                                                                        foreach ($arraySubCategorias as $titledata) {
                                                                            if ($titledata["url"] == "") {
                                                                                $titledata["url"] = "index.php?controlador=Index&accion=categoria&id=".$titledata["id"];
                                                                            }

                                                                            $arraySubItemCategorias = $vars["indexModel"]->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion = 'MenuPrimero' AND padre = " . $titledata["id"] . " ORDER BY padre , orden");
                                                                            ?>
                                                                            <div class="col-md-3">
                                                                                <a href="<?php echo $titledata["url"]; ?>" class="title-submenu"><?php echo $titledata["nombre"]; ?></a>
                                                                                <div class="row">
                                                                                    <div class="col-md-12 hover-menu">
                                                                                        <div class="menu">
                                                                                            <ul>
                                                                                                <?php
                                                                                                foreach ($arraySubItemCategorias as $datasubitem) {
                                                                                                    if ($datasubitem["url"] == "") {
                                                                                                        $datasubitem["url"] = "index.php?controlador=Index&accion=categoria&id=".$datasubitem["id"];
                                                                                                    }
                                                                                                    ?>
                                                                                                    <li><a href="<?php echo $datasubitem["url"]; ?>" class="main-menu"><?php echo $datasubitem["nombre"]; ?></a></li>
                                                                                                    <?php
                                                                                                }
                                                                                                ?>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                        }
                                                                        ?>                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?> 
                                                    </li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="col-md-4 col-sm-10 col-xs-10 header_search">
                    <div id="sosearchpro" class="search-pro">
                        <form method="GET" action="index.php?controlador=Index&accion=buscador">
                            <div id="search0" class="search input-group">
                                <div style="display: none" class="select_category filter_type  icon-select">
                                    <select class="no-border" name="seccion_id">
                                        <?php
                                        foreach ($vars["menu_segundo"] as $data) {
                                            $arraySubCategorias = $vars["indexModel"]->listArraySql("SELECT * FROM seccion WHERE activo = 1 AND ubicacion = 'MenuSegundo' AND padre = " . $data["id"] . " ORDER BY padre , orden");
                                            ?>
                                            <option value="<?php echo $data["id"]; ?>"><?php echo $data["nombre"]; ?></option>
                                            <?php
                                            if (count($arraySubCategorias) > 0) {
                                                foreach ($arraySubCategorias as $subdata) {
                                                ?>
                                                <option value="<?php echo $subdata["id"];?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $subdata["nombre"];?></option>
                                                <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>	
                                <input type="hidden" name="controlador" value="Index" />
                                <input type="hidden" name="accion" value="buscador" />
                                <input class="autosearch-input form-control" type="text" value="" size="50" autocomplete="off" placeholder="Buscar" name="search">
                                <span class="input-group-btn">
                                    <button type="submit" class="button-search btn btn-primary"><i class="fa fa-search"></i></button>
                                </span>
                            </div>                                 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>