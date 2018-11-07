<!-- Basic page needs
            ============================================ -->
<title> FRABOT <?php echo $vars["title"]; ?></title>
<meta charset="utf-8">
<meta name="keywords" content="<?php echo $vars["keywords"]; ?>" />
<meta name="author" content="Magentech">
<meta name="robots" content="index, follow" />
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-124335200-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-124335200-1');
</script>
<script>
    window.fbAsyncInit = function () {
        FB.init({
            appId: '95100348886',
            xfbml: true,
            version: 'v2.6'
        });
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<!-- Mobile specific metas
============================================ -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- Favicon
============================================ -->

<link rel="shortcut icon" href="ico/favicon.png">

<!-- Google web fonts
============================================ -->
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700|Roboto:400,500,700,900' rel='stylesheet' type='text/css'>

<!-- Libs CSS
    ============================================ -->
<link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
<link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="js/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
<link href="js/owl-carousel/owl.carousel.css" rel="stylesheet">
<link href="css/themecss/lib.css" rel="stylesheet">
<link href="js/jquery-ui/jquery-ui.min.css" rel="stylesheet">
<!-- Date Picker -->
<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">

<!-- Theme CSS
============================================ -->
<link href="css/themecss/so_megamenu.css" rel="stylesheet">
<link href="css/themecss/so-categories.css" rel="stylesheet">
<link href="css/themecss/so-listing-tabs.css" rel="stylesheet">
<link href="css/themecss/slider.css" rel="stylesheet">
<link id="color_scheme" href="css/home7.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">

<!-- End Preloading Screen -->

<!-- Include Libs & Plugins
============================================ -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="js/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/owl-carousel/owl.carousel.js"></script>
<script type="text/javascript" src="js/themejs/libs.js"></script>
<script type="text/javascript" src="js/unveil/jquery.unveil.js"></script>
<script type="text/javascript" src="js/countdown/jquery.countdown.min.js"></script>
<script type="text/javascript" src="js/dcjqaccordion/jquery.dcjqaccordion.2.8.min.js"></script>
<script type="text/javascript" src="js/datetimepicker/moment.js"></script>
<script type="text/javascript" src="js/datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="js/jquery-ui/jquery-ui.min.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>


<!-- Theme files
============================================ -->
<script type="text/javascript" src="js/themejs/application.js"></script>
<script type="text/javascript" src="js/themejs/toppanel.js"></script>
<script type="text/javascript" src="js/themejs/so_megamenu.js"></script>
<script type="text/javascript" src="js/themejs/addtocart.js"></script>

<script type="text/javascript" src="js/themejs/accordion.js"></script>	
<script type="text/javascript" src="js/cod.js"></script>	