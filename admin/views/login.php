<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include 'include/head.php';
        ?>
        <!-- jQuery 2.2.0 -->
        <script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
        <script src="dist/js/jquery.backstretch.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function () {
                $.backstretch([
                    "dist/img/3.jpg",                            
                    "dist/img/2.png",
                    "dist/img/4.jpg"                    
                ], {duration: 5000, fade: 750});
            });
        </script>
        <!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <!--
            <div class="login-logo">
                <img id="logoLogin" alt="UEFM" src="dist/img/LogoTem.png">
            </div>
            <!-- /.login-logo -->
            <?php 
                if(isset($vars["mensajeerror"]))
                { 
                ?>
                <div class="alert alert-danger alert-dismissible">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <h4 style="font-size: 14px"><i class="icon fa fa-ban"></i> <?php echo $vars["mensajeerror"]?></h4>
                </div>
                <?php 
                }
                ?>
                <?php 
                if(isset($_GET["mensajeerror"]))
                {
                ?>
                <div class="alert alert-danger alert-dismissible">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <h4 style="font-size: 14px"><i class="icon fa fa-ban"></i> <?php echo $_GET["mensajeerror"]?></h4>
                </div>
                <?php 
                }
                ?>
                <?php 
                if(isset($_GET["mensajeok"]))
                { 
                ?>
                <div class="alert alert-success alert-dismissible">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <h4 style="font-size: 14px"><i class="icon fa fa-check"></i> <?php echo $_GET["mensajeok"]?></h4>
                </div>
                <?php 
                }
                ?>
            <div class="login-box-body" style="margin-top: 185px">
                <p class="login-box-msg">Inicie sesión</p>
                <form method="post" action="index.php?controlador=Login&accion=autenticar">
                    <div class="form-group has-feedback">
                        <input name="email" type="text" class="form-control" placeholder="Email" required />
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input name='clave' type="password" class="form-control" placeholder="Password" required />
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                            
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->
    </body>
</html>
